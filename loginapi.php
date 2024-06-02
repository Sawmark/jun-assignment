<?php
session_start();
require_once 'dbinfo.php';
$conn = new mysqli($host,$user,$pass,$database);
if($conn->connect_error) 
    die($conn->connect_error);
$email = $_POST['email'];
$pass = $_POST['pass'];
$query = "select * from user where email = '$email' AND password = '$pass'";
$result = $conn->query($query);
$rows = $result->num_rows;
if ($rows != 0) {
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['userID'] = $row['user_id'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['user'] = $row['name'];
    echo 'SUCCESS';
} else {
    echo 'Invalid email, password';
}

$conn->close();
?>