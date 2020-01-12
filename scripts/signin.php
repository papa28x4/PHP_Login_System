<?php 
   
    $msgClass = 'red';
    if(isset($_POST['submit'])){
        $msg = '';
        include_once 'dbconnect.php';
        $username = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        if(empty($username) || empty($password)){
            $msg = "one or more fields are empty";
            header('Location: ../login.php?q=empty');
        }else{
            $sql = "SELECT * FROM users WHERE user_name = '$username';";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) < 1){
                 $msg = "Username or password is invalid";
                 header('Location: ../login.php?q=invaliduser');
            }else{
                if($row = mysqli_fetch_assoc($query)){
                    $hashedPwdCheck = password_verify($password, $row['user_password']);
                    if($hashedPwdCheck == false){
                        $msg = "Username or password is invalid";
                        header('Location: ../login.php?q=invalidpassword');
                    }elseif($hashedPwdCheck == true){
                        $_SESSION['username'] = $row['user_name'];
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['emali'] = $row['user_email'];
                        header('Location: ../index.php');
                        // exit();
                    }
                }
            }

        }
    }
