<?php
require 'config.php';
if(isset($_POST["submit"])){
    $usernameemail=$_POST["usernameemail"];
    $password=$_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email='$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["login"]=true;
            $_SESSION["id"]= $row["id"];
            header("Location:http://localhost/education/Education/index.html");
            exit();//ensure that no other ouput is send before redirecting.
        }
        else{
            echo "<script> alert('Wrong Password'); </script>";
        }
    }
    else{
        echo "<script> alert('User not registerd'); </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      background-size: 400% 400%;
      animation: gradientAnimation 10s ease infinite alternate;
    }

    @keyframes gradientAnimation {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    .login-container {
      position: relative;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
      text-align: center;
      animation: fadeInUp 1s ease;
      max-width: 400px;
      width: 90%;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      color: #4e54c8;
      font-size: 24px;
      margin-bottom: 20px;
      animation: textShadow 2s ease infinite alternate;
    }

    @keyframes textShadow {
      0% {
        text-shadow: 0 0 5px #8f94fb;
      }
      50% {
        text-shadow: 0 0 10px #4e54c8;
      }
      100% {
        text-shadow: 0 0 5px #8f94fb;
      }
    }

    input[type="text"],
    input[type="password"] {
      width: calc(100% - 24px);
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: none;
      border-bottom: 2px solid #4e54c8;
      background-color: transparent;
      transition: all 0.3s ease;
      font-size: 16px;
      color: #fff;
      outline: none;
    }

    input[type="text"]::placeholder,
    input[type="password"]::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #8f94fb;
    }

    input[type="submit"] {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      color: white;
      padding: 14px 20px;
      margin: 20px 0;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
      background: linear-gradient(to right, #8f94fb, #4e54c8);
    }

    .forget-password {
      font-size: 14px;
      color: #fff;
      text-align: right;
      margin-bottom: 20px;
      transition: color 0.3s ease;
    }

    .forget-password:hover {
      color: #4e54c8;
      cursor: pointer;
    }

    .new-member {
      font-size: 14px;
      color: #fff;
      transition: color 0.3s ease;
    }

    .new-member .sign-up {
      color: #4e54c8;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .new-member .sign-up:hover {
      color: #8f94fb;
    }

    .password-strength {
      font-size: 14px;
      color: #fff;
      text-align: left;
      margin-top: 10px;
      transition: color 0.3s ease;
    }

    .weak {
      color: #ff0000;
    }

    .strong {
      color: #00ff00;
    }

    .password-recommendation {
      font-size: 14px;
      color: #fff;
      text-align: left;
      margin-top: 10px;
    }

    .password-recommendation p {
      margin-bottom: 5px;
    }

    .password-recommendation ul {
      list-style-type: none;
      padding: 0;
    }

    .password-recommendation ul li {
      margin-bottom: 5px;
    }

    .password-recommendation .icon {
      margin-right: 5px;
    }

    .password-recommendation .strong {
      color: #00ff00;
    }

    .password-recommendation .highlight {
      color: #ffcc00;
    }

    /* Notification Styles */
    .notification {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #00ff00;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      animation: fadeInOut 2s ease-in-out;
      z-index: 999;
      display: none;
    }

    @keyframes fadeInOut {
      0% {
        opacity: 0;
      }

      10% {
        opacity: 1;
      }

      90% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }
  </style>
</head>

<body>

  <div class="login-container">
    <h2>Welcome Back!</h2>
    <form action="" class="" method="post" autocomplete="off" id="login-form">
      <input type="text" id="usernameemail" name="usernameemail" placeholder="Username or email" required value="">
      <input type="password" id="password" name="password" placeholder="Password" required onkeyup="checkPasswordStrength()">
      <div class="forget-password">Forget Password?</div>
      <button type="submit" name="submit" onclick="showNotification()">Login</button>
    </form>
    <div class="password-strength" id="password-strength">Password Strength: <span id="password-strength-indicator"></span></div>
    <div class="new-member">New here? <a href="registration.php" class="sign-up">Sign up now</a></div>
  </div>

  <div class="notification" id="notification">Login Successful!</div>

  <script>
    function checkPasswordStrength() {
      let password = document.getElementById("password").value;
      let strengthIndicator = document.getElementById("password-strength-indicator");

      let strength = "Weak";
      let colorClass = "weak";
      let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})");
      let mediumRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");

      if (strongRegex.test(password)) {
        strength = "Strong";
        colorClass = "strong";
      } else if (mediumRegex.test(password)) {
        strength = "Medium";
      }

      strengthIndicator.innerText = strength;
      strengthIndicator.className = colorClass;
    }

    function showNotification() {
      let notification = document.getElementById("notification");
      notification.style.display = "block";
      setTimeout(function() {
        notification.style.display = "none";
      },3000); // Hide notification after 3 seconds
    }
  </script>

</body>

</html>