<?php
session_start();
$sender = $_SESSION['user'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];

// Database connection
$host = 'localhost';
$db = 'webbase';
$user = 'root';
$pass = 'admin';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Insert message into database
$sql = "INSERT INTO messages (sender_username, receiver_username, message) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$sender, $receiver, $message])) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to store message"]);
}
?>
