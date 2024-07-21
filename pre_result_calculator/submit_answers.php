<?php
header('Content-Type: application/json');  // Ensure JSON output
include '../db_connect.php';

session_start();

if (!isset($_POST['setId'])) {
    echo json_encode(['error' => 'Set ID not provided']);
    exit;
}

$setId = $_POST['setId'];
$responses = $_POST['responses'] ?? [];
$totalQuestions = 100;
$correctCount = 0;
$wrongCount = 0;
$notAttempted = $totalQuestions;

$query = "SELECT question_number, correct_answer FROM pre_questions WHERE set_id = ?";
$stmt = $conn->prepare($query);
if (false === $stmt) {
    echo json_encode(['error' => $conn->error]);
    exit;
}

$stmt->bind_param("s", $setId);
$stmt->execute();
$result = $stmt->get_result();
$correctAnswers = [];

while ($row = $result->fetch_assoc()) {
    $correctAnswers[$row['question_number']] = $row['correct_answer'];
}

foreach ($correctAnswers as $questionNumber => $correctAnswer) {
    if (!array_key_exists($questionNumber, $responses)) {
        continue;
    }
    $notAttempted--;
    if ($responses[$questionNumber] === $correctAnswer) {
        $correctCount++;
    } else {
        $wrongCount++;
    }
}

$stmt->close();
$conn->close();

echo json_encode([
    'correct' => $correctCount,
    'wrong' => $wrongCount,
    'notAttempted' => $notAttempted
]);
?>
