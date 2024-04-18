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

        .new-member.sign-up {
            color: #4e54c8;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .new-member.sign-up:hover {
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

        .password-recommendation.icon {
            margin-right: 5px;
        }

        .password-recommendation.strong {
            color: #00ff00;
        }

        .password-recommendation.highlight {
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
    <h2>Registration</h2>
    <form action="" method="post" autocomplete="off" class="login-container">
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
    <a href="login.php" class="new-member">Already have an account? <span class="sign-up">Sign in</span></a>
</body>
</html>


