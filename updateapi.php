<?php
session_start();
require_once 'dbinfo.php';
$conn = new mysqli($host, $user, $pass, $database);


if ($conn->connect_error)
    die($conn->connect_error);

if(isset($_POST['email'])) {
$username=htmlspecialchars($_POST['username']);
$email=htmlspecialchars($_POST['email']);
}
$sql = "UPDATE userinfo SET username = '$username' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
    echo "SUCCESS";
    $_SESSION['user'] = $username;
    $_SESSION['email'] = $email;
} else {
    echo "Error updating record: ";
}

/* close connection */
$conn->close();

