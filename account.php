<?php include('php/connect.php'); ?>

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
    <style>
        #logo-img {
            text-align: center;
            padding: 20px;
            color: white;
        }

        #back {
            text-align: center;
            padding: 20px auto;
            margin: 50px 0 0 0;
        }

        .right {
            min-width: 40%;
            margin: 50px auto;
            background-color: rgb(9, 54, 83);
            color: white;
            height: fit-content;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: rgba(0, 0, 0, 0.25) 0 54px 55px, rgba(0, 0, 0, 0.12) 0 -12px 30px, rgba(0, 0, 0, 0.12) 0 4px 6px, rgba(0, 0, 0, 0.17) 0 12px 13px, rgba(0, 0, 0, 0.09) 0 -3px 5px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="account">
        <a href="./index.html" id="back">Back</a>
        <div class="right">
            <p id="logo-img">Ask Public</p>
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
                    $email_log = $_POST['email_login'];
                    $password = $_POST['password_login'];

                    $email_log = stripcslashes($email_log);  
                    $password = stripcslashes($password);  
                    $email_log = mysqli_real_escape_string($con, $email_log);  
                    $password = mysqli_real_escape_string($con, $password);  

                    $sql = "SELECT * FROM users WHERE email= '$email_log' AND password = '$password'";
                    $result = mysqli_query($con, $sql);  
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                    $count = mysqli_num_rows($result); 
                    $cookie_name = "name";
                    $cookie_value = $row['user_name'];
                    $cookie_two = "id";
                    $cookie_id = $row['id'];
                    
                    if($count == 1){  
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                        setcookie($cookie_two, $cookie_id, time() + (86400 * 30), "/");
                        echo "<script>alert('Successfully logged in, click OK to continue!')</script>";
                        echo "<script>localStorage.setItem('auth', 'Logged in, true')</script>";
                        echo "<script>localStorage.setItem('username', '')</script>"; 
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
                        <input type="submit" value="Register" class="btn" name="register_button">
                    </div>
                </form>
            </div>
            <?php

                if(isset($_POST['register_button'])){
                    $email = $_POST['email_reg'];
                    $password = $_POST['password_reg'];
                    $names = $_POST['names'];
                    $today = date('Y-m-d H:i:s');

                    $email = stripcslashes($email);    
                    $email = mysqli_real_escape_string($con, $email);   

                    $sqlb = "SELECT * FROM users WHERE email= '$email'";
                    $resultone = mysqli_query($con, $sqlb);  
                    $rowone = mysqli_fetch_array($resultone, MYSQLI_ASSOC);  
                    $countone = mysqli_num_rows($resultone); 

                    if($countone == 1){  
                        echo "<script>alert('Email already registered!')</script>";
                    }else {

                        $sqle = "INSERT INTO users (`user_name`, `email`, `password`, `creation_date`) VALUES ('$names', '$email', '$password', '$today')";  
                        
                        if($con->query($sqle) === TRUE){  
                            echo "<script>alert('Successfully registered! Login to continue!')</script>"; 
                            echo "<script>window.location.href = './account.php'</script>";  
                        }  
                        else{  
                            echo "<script> alert('Register failed. Try again.')</script>";  
                        }
                    }
                    $con->close();
                }
            ?>
        </div>
    </div>
    <script src="./js/account.js"></script>
</body>
</html>