<?php

if(isset($_POST['submit'])){
	include_once 'database.php';
	$username = mysqli_real_escape_string($conn, $_POST['name']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	
	//Error handlers
	//Check for empty fields
	if(empty($username) || empty($password) || empty($email)){
			header("Location: ../index.php?signup=empty");
			exit();
		}else{
			//check if input are valid
			if(!preg_match("/^[a-zA-Z]*$/", $username)){
				header("Location: ../index.php?signup=username");
				exit();
			}else{
				//check if email is not valid
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					header("Location: ../index.php?signup=email");
					exit();
				}else{
					$sql = "SELECT * FROM users WHERE user_id = '$username'";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);
					if($resultCheck > 0){
						header("Location: ../index.php?signup=usertaken");
						exit();
					}else{
						//hashing the password
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						//insert the user into the database
						$sql = "INSERT INTO users(user_name, user_password, user_email) VALUES ('$username', '$hashedPwd', '$email');";
						mysqli_query($conn, $sql);
						header("Location: ../index.php?signup=success");

					}
				}
			}
		}
}else{
	header("Location: ../index.php");
	exit();
}