<?php
session_start();
$sv = $_POST['seval'];

//$ans = "The entered date was:" . $thedate . "<br>";
//echo json_encode($ans);
$currentuser = $_SESSION['user'];

// Insert selected date to database
require_once 'dbinfo.php';
$conn = new mysqli($host, $user, $pass, $database);

if($conn->connect_error) 
die($conn->connect_error);
    //echo json_encode("<br>Rows inserted:". $stmt->affected_rows);
    
$query = "SELECT name FROM user WHERE name LIKE '%".$sv."%' AND name != '$currentuser' ORDER BY name;";

$result = $conn->query($query);
$all_rows = $result->fetch_all(MYSQLI_ASSOC);
$json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
echo $json_string;

//     /* close connection */
$conn->close();
    
?>