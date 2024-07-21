<?php
session_start();

// Authentication check here
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php'); // Adjust path as necessary
    exit;
}

include '../db-connect.php'; // Adjust path to your database connection file

$setId = $_POST['setId'];
$answers = $_POST['answers'];

foreach ($answers as $questionNumber => $answer) {
    $sql = "INSERT INTO pre_questions (set_id, question_number, correct_answer) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE correct_answer = VALUES(correct_answer)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('MySQL prepare error: ' . $conn->error);
    }
    $stmt->bind_param('sis', $setId, $questionNumber, $answer);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute error: ' . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
echo "Answers have been successfully updated.";
?>
