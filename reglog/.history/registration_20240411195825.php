<?php
require 'config.php';
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirmpassword =$_POST["comfirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email='$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo "<script> alert('Username or Email Has Already Taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            $query = "INSERT INTO tb_user VALUES('','$name','$username','$email','$password')";
            mysqli_query($conn,$query);
            echo "<script> alert('Registration successful'); </script>";
        }
        else{
            echo "<script> alert('Password Doesn't match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        label{
            display: block;
            margin-bottom: 10px;
        }
        input{
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }
        button{
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        a{
            text-align: center;
            display: block;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h2>Registration</h2>
    <form action="" class="" method="post" autocomplete="off">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"  required value=""><br><br>
    <label for="username">Username:</label>
    <input type="text" name="usernamename" id="username"  required value=""><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"  required value=""><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"  required value=""><br><br>
    <label for="comfirmpassword">Password:</label>
    <input type="password" name="comfirmpassword" id="comfirmpassword"  required value=""><br><br>
    <button type="submit" name="submit">Registration</button>
    </form><br>
    <a href="login.php">Login</a>
</body>
</html>
