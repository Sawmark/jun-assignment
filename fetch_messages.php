<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    http_response_code(403); // Forbidden
    exit;
}

// Database connection
$host = 'localhost'; // your database host
$dbname = 'webbase'; // your database name
$username = 'root'; // your database username
$password = 'admin'; // your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Function to fetch messages from the database
function fetchMessages() {
    global $pdo;

    // Fetch messages ordered by timestamp
    $stmt = $pdo->prepare("SELECT * FROM messages ORDER BY timestamp ASC");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $messages;
}

// Long polling loop
$start_time = time();
while (true) {
    // Fetch new messages
    $messages = fetchMessages();

    // If there are new messages or a timeout occurs, respond to the client
    if (!empty($messages) || (time() - $start_time) > 30) { // Adjust timeout as needed
        header('Content-Type: application/json');
        echo json_encode($messages);
        break;
    }

    // Sleep for a short duration before checking for new messages again
    usleep(500000); // 0.5 seconds
}
?>