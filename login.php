
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <style>

    *{
        box-sizing: border-box;
    }
    body{
        margin: 0;
        padding: 0;
        font-family: 'Raleway', sans-serif;
        background: url(loginPage2.jpg) no-repeat;
        background-size: cover;
        height: 100vh;
    }

    .box{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        padding: 40px;
        background: rgba(0,0,0,0.8);
        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
        border-radius: 10px;
    }

    .box h2{
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .box .inputBox{
        position: relative;
    }
    .box .inputBox input{
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        letter-spacing: 1px;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .box .inputBox label{
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: top 0.5s ease;
    }

    .box .inputBox input:focus ~ label,
    .box .inputBox input:valid ~ label{
        top: -18px;
        left: 0;
        color: rgba(199,102,178, 1);
        font-size: 12px;
    }

    .box input[type="submit"]{
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        background: rgba(199,102,178, 0.8);
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    
    .box input[type="submit"]:hover, 
    .box input[type="submit"]:active{
        background: rgba(199,102,178, 1);
       
    }
    
    .box .message{
        margin: 15px 0 0;
        color: #fff;
    }
    
    .box .message a{
        text-decoration: none;
        color:rgba(199,102,178, 0.8);
        padding-left: 5px;
    }
    
    .registration{
        display: none;
    }

    .form-message{
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        text-align: center;
        font-weight: bold;
    }
    
    
    </style>
</head>
<body>
    <!-- <?php if($msg != ''): ?>
            <div class="<?php echo $msgClass?>"><?php echo $msg ?></div>
        <?php endif?>
    <div class="box">
         -->
    <?php 
        if(isset($_GET['q'])){
            $q = $_GET['q'];
            
            if ($q == "invaliduser"): ?>
            <p class="form-message" style="font-weight:bold; color:blue;">User does not exist</p> 
     <?php 
            elseif($q == 'invalidpassword'): ?>
             <p class="form-message" style="font-weight:bold; color:blue;">Password is invalid</p> 
    <?php 
            endif ?>  
     <?php   
        }
        
    ?>
    <div class="form-message" ></div>
    <div class="box">
        
        <form class="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2>Sign Up</h2>
             <div class="inputBox">
                <input id="email" type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="inputBox">
                <input id="name" type="text" name="name" required>
                <label>Username</label>
            </div>
            
            <div class="inputBox">
                <input id="pwd" type="password" name="pwd" required>
                <label>Password</label>
            </div>

           
            <input id="submit" type="submit" name="submit" value="Create">
            <p class="message">Already Registered?<a href="#">Login</a></p>

        </form>

        <form class="login" action="scripts/signin.php" method="POST">
                <h2>Sign In</h2>
                <div class="inputBox">
                        <input id="login_name" type="text" name="name" required>
                        <label>Username</label>
                </div>
                    
                <div class="inputBox">
                        <input id="login_pwd" type="password" name="pwd" required>
                        <label>Password</label>
                </div>
                <input id="login_submit" type="submit" name="submit" value="Login">
                <p class="message">Not Registered?<a href="#">Register</a></p>
        </form>
    </div>
    
        <script src="jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $('.message a').click(function(){
            $('form').animate({height:"toggle", opacity:"toggle"}, "slow");
            })
            $('.registration').submit(function(event){
                event.preventDefault();
                let name = $('#name').val();
                let email = $('#email').val();
                let pwd = $('#pwd').val();
                let submit = $('#submit').val();
                $('.form-message').load('scripts/register.php', {
                    name: name,
                    email: email,
                    pwd: pwd,
                    submit: submit
                })

            })

            // $('.login').submit(function(event){
            //     event.preventDefault();
            //     let name = $('#login_name').val();
            //     let pwd = $('#login_pwd').val();
            //     let submit = $('#login_submit').val();
            //     $('.form-message').load('scripts/signin.php', {
            //         name: name,
            //         pwd: pwd,
            //         submit: submit
            //     })

            // })

        })
       
    </script>
</body>
</html>