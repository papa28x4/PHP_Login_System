<?php 
   
    $msgClass = 'red';
    if(isset($_POST['submit'])){
        $msg = '';
        require_once 'dbconnect.php';
        $username = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        if(empty($username) || empty($email) || empty($password)){
            $msg = "one or more fields are empty";
            
        }else{
            if(!preg_match("/^[\w]{3,}$/", $username)){
                $msg = "Username should have at least 3 characters";
                
            }else{
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $msg = "Enter a valid email";
                    
                }else{
                    $sql = "SELECT * FROM users WHERE user_name='$username' OR user_email = '$email';";
                    $query = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($query) > 0){
                        $msg = "Username or Email has been taken";
                        
                    }else{
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                        $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES('$username', '$email', '$hashedPwd');";
                        $query = mysqli_query($conn, $sql);
                        if($query){
                            $msg = "Registration Successful";
                            $msgClass = 'red';
                            
                        }
                    }
                }
            }
        }
        echo $msg;
    }
?>
