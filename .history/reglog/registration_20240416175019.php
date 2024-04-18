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
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    h2 {
        font-size: 2.5rem;
        color: #5d5d5d;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 2rem;
        animation: fadeIn 1s ease-in-out;
    }

    form {
        background-color: #fff;
        padding: 2rem;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        width: 30rem;
        animation: slideIn 1s ease-in-out;
    }

    label {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: #5d5d5d;
        animation: fadeIn 1s ease-in-out;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 0.5rem;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        font-size: 1.1rem;
        animation: fadeIn 1s ease-in-out;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        animation: pulse 1s ease-in-out;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2rem;
        margin-top: 1rem;
        animation: fadeIn 1s ease-in-out;
    }

    button[type="submit"]:hover {
        background-color: #3e8e41;
        animation: shake 0.5s ease-in-out;
    }

    a {
        color: #4CAF50;
        text-decoration: none;
        margin-top: 1rem;
        font-size: 1.2rem;
        animation: fadeIn 1s ease-in-out;
    }

    a:hover {
        text-decoration: underline;
        animation: pulse 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        0% {
            transform: translateY(-50px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        50% {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        100% {
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }
        10% {
            transform: translateX(-10px);
        }
        20% {
            transform: translateX(10px);
        }
        30% {
            transform: translateX(-10px);
        }
        40% {
            transform: translateX(10px);
        }
        50% {
            transform: translateX(-10px);
        }
        60% {
            transform: translateX(10px);
        }
        70% {
            transform: translateX(-10px);
        }
        80% {
            transform: translateX(10px);
        }
        90% {
            transform: translateX(-10px);
        }
        100% {
            transform: translateX(0);
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
