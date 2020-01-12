<?php 
	$msg = '';
	$msgClass = 'red';
	if(isset($_POST['submit'])){

		include_once 'scripts/dbconnect.php';
		$username = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['pwd']);
		if(empty($username) || empty($email) || empty($password)){
			$msg = "one or more fields are empty";
			header('location: ../login.php');
    		exit();
		}else{
			if(!preg_match("/^[\w]{3,}$/", $username)){
				$msg = "username should have at least 3 characters";
				header('location: ../login.php');
    			exit();
			}else{
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$msg = "Enter a valid email";
					header('location: ../login.php');
    				exit();
				}else{
					$sql = "SELECT * FROM users WHERE user_name='$username' OR user_email = '$email';";
					$query = mysqli_query($conn, $sql);
					if(sqli_num_rows($query) > 0){
						$msg = "Username or Email has been taken";
						header('location: ../login.php');
    					exit();
					}else{
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

						$sql = "INSERT INTO users (user_name, user_email, user_password) VALUES('$username', '$email', '$hashedPwd');";
						$query = mysqli_query($conn, $sql);
						if($query){
							$msg = "Registration Successful";
							header('location: ../login.php');
	    					exit();
						}
					}
				}
			}
		}
	}
	

