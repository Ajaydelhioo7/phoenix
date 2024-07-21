<?php
include 'db.php';
session_start();

// Process Master Tag Form
if (isset($_POST['masterTag']) && !empty($_POST['masterTag'])) {
    $masterTag = $_POST['masterTag'];
    $stmt = $conn->prepare("INSERT INTO master_tags (masterTag) VALUES (?)");
    $stmt->bind_param("s", $masterTag);

    if ($stmt->execute()) {
        echo "Master tag inserted successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Process Additional Inputs Form
if (isset($_POST['tagName'], $_POST['ismastertag'])) {
    $parentTagName = $_POST['parentTagName'] ?? null;
    $parentTagId = $_POST['parentTagId'] ?? null;
    $tagName = $_POST['tagName'];
    $ismastertag = $_POST['ismastertag'];

    // Assuming the 'addedBy' and 'updatedBy' will be taken from the session or a default value
    $user_id = $_SESSION['user_id'] ?? 1; // Example: defaulting to user with ID 1

    // Assuming status is true when a new tag is created
    $status = 1; // Status is active (1) when created

    // Getting the current timestamp for 'updatedTime'
    $updatedTime = date('Y-m-d H:i:s'); // Current timestamp in Y-m-d H:i:s format (hours:minutes:seconds)

    $stmt = $conn->prepare("INSERT INTO tags (parentTagId, parentTagName, tagName, addedBy, updatedBy, status, ismastertag, updatedTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiiisi", $parentTagId, $parentTagName, $tagName, $user_id, $user_id, $status, $ismastertag, $updatedTime);

    if ($stmt->execute()) {
        echo "Additional details inserted successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

$conn->close();
?>
