<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email='$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email Has Already Taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            $query = "INSERT INTO tb_user (name, username, email, password,confirmpassword) VALUES ('$name', '$username', '$email', '$password','$confirmpassword')";

            if (mysqli_query($conn, $query)) {
                echo "<script> alert('Registration successful'); </script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script> alert('Passwords do not match'); </script>";
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
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h2 {
    font-size: 2.5rem;
    color: #333;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    margin-bottom: 2rem;
    animation: fadeIn 0.8s ease-out;
}

form {
    background-color: #fff;
    padding: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 30rem;
    animation: slideIn 0.8s ease-out;
}

label {
    display: block;
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 0.5rem;
    animation: fadeIn 0.8s ease-out;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    transition: border-color 0.3s ease-in-out;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
}

button[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 0.8rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background-color 0.3s ease-in-out;
}

button[type="submit"]:hover {
    background-color: #388E3C;
}

a {
    color: #4CAF50;
    text-decoration: none;
    font-size: 1.2rem;
    transition: color 0.3s ease-in-out;
}

a:hover {
    color: #388E3C;
    text-decoration: underline;
}

/* Keyframe animations */

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(-50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>
<body>
    <h2>Registration</h2>
    <form action="" method="post" autocomplete="off">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required value=""><br><br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required value=""><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required value=""><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required value=""><br><br>
        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" name="confirmpassword" id="confirmpassword" required value=""><br><br>
        <button type="submit" name="submit">Registration</button>
    </form><br>
    <a href="login.php">Login</a>
</body>
</html>
