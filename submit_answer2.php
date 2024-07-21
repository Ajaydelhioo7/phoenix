<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = intval($_POST['question_id']);
    $user_answer = intval($_POST['answer']);
    $user_id = $_SESSION['user_id'];

    // Get the correct answer and question rating from the database
    $sql = "SELECT correct_answer, question_rating, successful_attempts, no_of_attempts FROM questions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->bind_result($correct_answer, $question_rating, $successful_attempts, $no_of_attempts);
    $stmt->fetch();
    $stmt->close();

    // Get the user's current globalRating
    $sql = "SELECT globalRating FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($globalRating);
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

    // Calculate new globalRating
    $newGlobalRating = 2 * ($winresult - $probabilityOfSuccess) + $globalRating;

    // Update user's globalRating
    $sql = "UPDATE users SET globalRating = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $newGlobalRating, $user_id);  // Note: 'd' for float
    $stmt->execute();
    $stmt->close();

    // Update question attempts
    $no_of_attempts += 1;

    // Avoid log(0) scenario and calculate new question_rating
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

    // Return the result to the user
    if ($user_answer == $correct_answer) {
        echo "<div class='alert alert-success'>Correct! The answer is option $correct_answer. Your new global rating is " . round($newGlobalRating, 2) . ".</div>";
    } else {
        echo "<div class='alert alert-danger'>Incorrect. The correct answer is option $correct_answer. Your new global rating is " . round($newGlobalRating, 2) . ".</div>";
    }
}

$conn->close();
?>
