<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = intval($_POST['question_id']);
    $user_answer = intval($_POST['answer']);
    $user_id = $_SESSION['user_id'];

    // Recursive function to find the main subject tag
    function findMainSubjectTag($conn, $tag_id) {
        $sql = "SELECT parentTagId, tagName FROM tags WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $tag_id);
        $stmt->execute();
        $stmt->bind_result($parentTagId, $tagName);
        $stmt->fetch();
        $stmt->close();
        // Main subjects
        $main_subjects = ['History', 'Society', 'Geography', 'Indian Polity', 'Governance', 'International Relations', 'Indian Economy', 'Agriculture', 'Science & Technology', 'Environment & DM', 'Internal Security'];
        if (in_array($tagName, $main_subjects)) {
            return $tagName;
        } elseif ($parentTagId) {
            return findMainSubjectTag($conn, $parentTagId);
        } else {
            return null;
        }
    }

    try {
        // Start transaction
        $conn->begin_transaction();

        // Get the correct answer, question rating, and taglist ID from the database
        $sql = "SELECT correct_answer, question_rating, taglist_id, successful_attempts, no_of_attempts FROM questions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->bind_result($correct_answer, $question_rating, $taglist_id, $successful_attempts, $no_of_attempts);
        $stmt->fetch();
        $stmt->close();

        // Get the user's current ratings
        $sql = "SELECT globalRating, history_rating, society_rating, geography_rating, polity_rating, governance_rating, international_relations_rating, economy_rating, agriculture_rating, science_tech_rating, environment_dm_rating, internal_security_rating FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($globalRating, $history_rating, $society_rating, $geography_rating, $polity_rating, $governance_rating, $international_relations_rating, $economy_rating, $agriculture_rating, $science_tech_rating, $environment_dm_rating, $internal_security_rating);
        $stmt->fetch();
        $stmt->close();

        // Determine win result
        if ($user_answer == $correct_answer) {
            $winresult = 2; // correct answer
            $successful_attempts += 1;
        } else {
            $winresult = 0; // wrong answer
        }

        // Calculate probability of success
        $probabilityOfSuccess = 1 / (1 + pow(10, ($question_rating - $globalRating) / 25));

        // Calculate new global rating
        $newGlobalRating = 2 * ($winresult - $probabilityOfSuccess) + $globalRating;

        // Update user's global rating
        $sql = "UPDATE users SET globalRating = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $newGlobalRating, $user_id);
        $stmt->execute();
        $stmt->close();

        // Update question attempts
        $no_of_attempts += 1;

        // Avoid log(0) scenario and calculate new question rating
        if ($successful_attempts == 0 || $no_of_attempts == 0) {
            $new_question_rating = 0;
        } else {
            $new_question_rating = (-500 / 3) * log10($successful_attempts / $no_of_attempts);
        }

        // Log the values for debugging
        error_log("Question ID: $question_id, Successful Attempts: $successful_attempts, No of Attempts: $no_of_attempts, New Question Rating: $new_question_rating");

        $update_sql = "UPDATE questions SET no_of_attempts = ?, successful_attempts = ?, question_rating = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("iidi", $no_of_attempts, $successful_attempts, $new_question_rating, $question_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Determine the main subject tag
        $main_subject = findMainSubjectTag($conn, $taglist_id);
        if ($main_subject) {
            // Fetch the subject rating dynamically based on the main subject
            $subject_column = strtolower(str_replace(' ', '_', $main_subject)) . '_rating';
            $subject_rating = ${$subject_column}; // Dynamically get the subject rating

            // Calculate new subject-wise rating
            $newSubjectRating = 2 * ($winresult - $probabilityOfSuccess) + $subject_rating;

            // Update user's subject-wise rating
            $sql = "UPDATE users SET $subject_column = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("di", $newSubjectRating, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();

        // Return the result to the user
        if ($user_answer == $correct_answer) {
            echo "<div class='alert alert-success'>Correct! The answer is option $correct_answer. Your new global rating is " . round($newGlobalRating, 2) . " and your new $main_subject rating is " . round($newSubjectRating, 2) . ".</div>";
        } else {
            echo "<div class='alert alert-danger'>Incorrect. The correct answer is option $correct_answer. Your new global rating is " . round($newGlobalRating, 2) . " and your new $main_subject rating is " . round($newSubjectRating, 2) . ".</div>";
        }
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        error_log("Error: " . $e->getMessage());
        echo "<div class='alert alert-danger'>An error occurred. Please try again later.</div>";
    }

    $conn->close();
}
?>
