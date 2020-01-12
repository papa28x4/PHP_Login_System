<?php 
session_start();
$dbServer = "localhost";
$dbUser = "root";
$dbPassword = "lIy1JJvRD5G4MfY1";
$dbname = "test";


$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbname);

// if($conn){
// 	echo "connected successfully";
// }else{
// 	echo "connection failed";
// }


if(!$conn){
	die("Connection failed: ".mysqli_connect_error());
}