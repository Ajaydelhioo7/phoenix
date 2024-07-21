<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require './db.php'; // Single connection for combined database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];
    $taglist_id = $_POST['taglist_id'];
    $addedby = $_SESSION['admin_id'];

    // Initialize success_attempts and no_of_attempts to 0 for new questions
    $successful_attempts = 0;
    $no_of_attempts = 0;

    // Calculate initial question_rating
    $question_rating = -500 / 3 * log(($successful_attempts + 1) / ($no_of_attempts + 1));

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, taglist_id, question_rating, addedby, successful_attempts, no_of_attempts) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters
    $stmt->bind_param("sssssiisiii", $question, $option1, $option2, $option3, $option4, $correct_answer, $taglist_id, $question_rating, $addedby, $successful_attempts, $no_of_attempts);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Question added successfully.";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include './includes/header.php' ?>
    <div class="container mt-5">
        <h2>Add Question</h2>
        <form action="add_question.php" method="post">
            <div class="form-group">
                <label for="question">Question:</label>
                <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="option1">Option 1:</label>
                <input type="text" class="form-control" id="option1" name="option1" required>
            </div>
            <div class="form-group">
                <label for="option2">Option 2:</label>
                <input type="text" class="form-control" id="option2" name="option2" required>
            </div>
            <div class="form-group">
                <label for="option3">Option 3:</label>
                <input type="text" class="form-control" id="option3" name="option3" required>
            </div>
            <div class="form-group">
                <label for="option4">Option 4:</label>
                <input type="text" class="form-control" id="option4" name="option4" required>
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct Answer:</label>
                <select class="form-control" id="correct_answer" name="correct_answer" required>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="taglist_id">Tag:</label>
                <select class="form-control" id="taglist_id" name="taglist_id" required>
                    <?php
                    require './db.php'; // Single connection for combined database

                    $sql = "SELECT id, tagName FROM tags";
                    $result = $conn->query($sql);
                    if ($result === false) {
                        echo "Error: " . htmlspecialchars($conn->error);
                    } elseif ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['tagName']}</option>";
                        }
                    } else {
                        echo "<option value=''>No tags available</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
