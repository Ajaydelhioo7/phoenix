<?php
// Database credentials
$host = '127.0.0.1'; // Hostname for localhost
$dbname = 'pheonix'; // Database name
$user = 'pheonix'; // Default username for localhost
$password = 'WebDev@99N#'; // Default is no password for localhost

// Setting up the DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Creating the PDO instance
    $pdo = new PDO($dsn, $user, $password);
    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // This line can be commented out in production
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>