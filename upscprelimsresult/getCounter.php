<?php
include 'db.php'; // Include your DB connection

header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT count FROM submission_counter");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['count' => $result['count']]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => "Failed to retrieve counter: " . $e->getMessage()]);
}