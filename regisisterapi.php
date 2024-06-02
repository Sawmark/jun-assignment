<?php
session_start();
$username=htmlspecialchars($_POST['username']);
$email=htmlspecialchars($_POST['email']);
$pass2=htmlspecialchars($_POST['pass']);

require_once 'dbinfo.php';
$conn = new mysqli($host,$user,$pass,$database);
if($conn->connect_error) 
die($conn->connect_error);
$stmt=$conn->prepare("INSERT into user(name,email,password) VALUES(?,?,?)");
$stmt->bind_param("sss",$username,$email,$pass2);
$stmt->execute();
if($stmt->affected_rows == 1)
{
    $query = "SELECT * FROM user WHERE Email = '$email'";
    $result = $conn->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['userID'] = $row['user_id'];
    $_SESSION['user'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    echo 'SUCCESS';
}
else 
{
    echo 'Unable to register';
}

$stmt->close();
$conn->close();
?>