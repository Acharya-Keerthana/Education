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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.5s ease forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
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
    </form>
    <br>
    <a href="login.php">Login</a>
</body>
</html>

