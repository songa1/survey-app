<?php include('./php/connect/php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Ask Public</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="account">
        <a href="./index.html" class="back">Back</a>
        <div class="right">
            <img class="logo-img" src="./assets/logo/ask public.png" alt="Ask Public Logo">
            <div class="navig">
                <div id="logBtn">Login</div>
                <div id="regBtn">Register</div>
            </div>
            <div class="login" id="login">
                <form method="POST">
                    <div class="input-field">
                        <label>Email</label>
                        <input type="email" name="email_login" id="email" required/>
                    </div>
                    <div class="input-field">
                        <label>Password</label>
                        <input type="password" name="password_login" id="password" required/>
                    </div>
                    <div class="input-submit row">
                        <input type="submit" class="btn" name="login_submit" value="Login">
                        <a href="#">Forgot password?</a>
                    </div>
                </form>
            </div>
            <?php  

                if(isset($_POST['login_submit'])){
                    $email = $_POST['email_login'];
                    $password = $_POST['password_login'];

                    $username = stripcslashes($username);  
                    $password = stripcslashes($password);  
                    $username = mysqli_real_escape_string($con, $email);  
                    $password = mysqli_real_escape_string($con, $password);  

                    $sql = "SELECT * FROM users WHERE email= '$email' AND password = '$password'";
                    $result = mysqli_query($con, $sql);  
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                    $count = mysqli_num_rows($result); 
                    
                    if($count == 1){  
                        echo "<script>alert('Successfully logged in, click OK to continue!')</script>"; 
                        echo "<script>window.location.href = './dashboard/listing.php';</script>";  
                    }  
                    else{  
                        echo "<script> alert('Login failed. Invalid username or password.')</script>";  
                    }

                    $con->close();
                }
                
            ?>
            <div class="register" id="register">
                <form method="POST">
                    <div class="input-field">
                        <label>Names</label>
                        <input type="text" name="names"/>
                    </div>
                    <div class="input-field">
                        <label>Email</label>
                        <input type="email" name="email_reg"/>
                    </div>
                    <div class="input-field">
                        <label>Password</label>
                        <input type="password" name="password_reg"/>
                    </div>
                    <div class="input-submit row">
                        <input type="submit" value="Register" name="register_button">
                    </div>
                </form>
            </div>
            <?php

                if(isset($_POST['register_button'])){
                    $email = $_POST['email_reg'];
                    $password = $_POST['password_reg'];
                    $names = $_POST['names'];

                    $sql = "INSERT INTO users (`user_name`, `email`, `password`, `creation_date`) VALUES ('$names', '$email', '$password', $today)";
                    $regres= mysqli_query($con, $sql);  
                    
                    if($regres === true){  
                        echo "<script>alert('Successfully registered! Login to continue!')</script>"; 
                        echo "<script>window.location.reload();</script>";  
                    }  
                    else{  
                        echo "<script> alert('Register failed. Try again.')</script>";  
                    }

                    $con->close();
                }
            ?>
        </div>
    </div>
    <script src="./js/account.js"></script>
</body>
</html>