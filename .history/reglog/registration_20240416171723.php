<?php
require 'config.php';
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirmpassword =$_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email='$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo "<script> alert('Username or Email Has Already Taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            $query = "INSERT INTO tb_user VALUES('','$name','$username','$email','$password','$confirmpassword')";
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
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
 
</head>
<body>
    <h2>Registration</h2>
    <form action="" class="" method="post" autocomplete="off">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"  required value=""><br><br>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"  required value=""><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"  required value=""><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"  required value=""><br><br>
    <label for="confirmpassword">Confirm Password:</label>
    <input type="password" name="confirmpassword" id="confirmpassword"  required value=""><br><br>
    <button type="submit" name="submit">Registration</button>
    </form><br>
    <a href="login.php">Login</a>
</body>
</html>
