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
            $query = "INSERT INTO tb_user (name, username, email, password) VALUES('$name','$username','$email','$password','$confirmpassword')";
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
    <style>
/* General Body Styles */
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif; /* Ensures font consistency */
    animation: backgroundChange 30s infinite alternate;
}

/* Keyframes for background color animation */
@keyframes backgroundChange {
    0% { background-color: #85FFBD; }
    25% { background-color: #FFFB7D; }
    50% { background-color: #B28DFF; }
    75% { background-color: #FF7EB7; }
    100% { background-color: #85FFBD; }
}

/* Form Styling */
.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 4px;
}

.form-group input, .form-group textarea {
    width: 100%; /* Full width of parent */
    padding: 10px;
    margin: 8px 0;
    box-sizing: border-box; /* Includes padding and border in the element's width and height */
    border: 2px solid #ccc; /* Default border */
    border-radius: 4px; /* Rounded corners */
    transition: border 0.3s ease-in-out, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transition for border color change */
}

.form-group input:hover, .form-group textarea:hover {
    border: 2px solid #444; /* Darker border on hover */
    transform: translateY(-2px); /* Move the element up slightly on hover */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow on hover */
}

/* Button Styling */
.submit-btn {
    background-color: #4CAF50; /* Green background */
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transition for background color change */
}

.submit-btn:hover {
    background-color: #45a049; /* Darker green on hover */
    transform: translateY(-2px); /* Move the button up slightly on hover */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow on hover */
}

/* Container and Heading Styling */
.container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    max-width: 500px;
    margin: 0 auto;
    animation: pulse 2s infinite; /* Add a subtle pulse animation to the container */
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.1); }
    50% { box-shadow: 0 0 0 10px rgba(0, 0, 0, 0); }
    100% { box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.1); }
}

.heading {
    color: #333;
}

/* Center the "Already have an account?" link */
.login-link {
    display: block;
    text-align: center;
    margin: 16px auto;
    font-size: 14px;
    text-decoration: none;
    color: #333;
}
</style>
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
