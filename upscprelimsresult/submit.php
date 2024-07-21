<?php
include 'db.php';  // Include your DB connection

header('Content-Type: text/plain');

// Function to update the counter and calculate new average
function updateCounterAndCalculateAverage($pdo, $newScore) {
    $stmt = $pdo->prepare("SELECT count FROM submission_counter");
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Calculate new average
    $average = ((50 * $count) + $newScore) / ($count + 1);
    $cutoff = $average + 50;

    // Update the average_score table (assuming you might want to keep all historical records)
    $stmt = $pdo->prepare("INSERT INTO average_score (average, cutoff) VALUES (?, ?)");
    $stmt->execute([$average, $cutoff]);

    // Update the counter
    $stmt = $pdo->prepare("UPDATE submission_counter SET count = count + 1");
    $stmt->execute();

    return [$average, $cutoff];
}

// Securely fetch and validate input data
$year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
$rollNumber = filter_input(INPUT_POST, 'rollNumber', FILTER_SANITIZE_STRING);
$score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_FLOAT);
$cleared = filter_input(INPUT_POST, 'cleared', FILTER_SANITIZE_STRING);
$cutoffEstimate = filter_input(INPUT_POST, 'cutoffEstimate', FILTER_VALIDATE_FLOAT);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($rollNumber)) {
    if ($year && $score !== false && $cleared && $cutoffEstimate !== false && empty($name)) {  // Initial score submission
        $sql = "INSERT INTO upsc_prelims (year, roll_number, score, cleared, cutoff_estimate) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$year, $rollNumber, $score, $cleared, $cutoffEstimate])) {
            list($average, $cutoff) = updateCounterAndCalculateAverage($pdo, $score);
            echo "Prelims data saved successfully. Average score: $average. Cutoff for UPSC CSE Prelims should be: $cutoff.";
        } else {
            http_response_code(500);
            echo "Failed to save prelims data.";
        }
    } elseif ($name && $email) { // Updating additional information
        $sql = "UPDATE upsc_prelims SET name = ?, email = ? WHERE roll_number = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$name, $email, $rollNumber])) {
            echo "We will mail you as soon as we get at least 10,000 inputs.";
        } else {
            http_response_code(500);
            echo "Failed to update additional information.";
        }
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Roll number is required.";
}
?>