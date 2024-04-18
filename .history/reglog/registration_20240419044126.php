<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);

    // Check if username or email already exists
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or Email already taken');</script>";
    } else {
        if ($password !== $confirmpassword) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $query = "INSERT INTO tb_user (name, username, email, password) VALUES ('$name', '$username', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration successful');</script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
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
    /* Animation properties for background color change */
    animation: backgroundChange 10s infinite alternate ease-in-out;
  }

  @keyframes backgroundChange {
    0% {
      background: linear-gradient(to right, #f00, #ff0); /* Start with red to orange */
    }
    25% {
      background: linear-gradient(to right, #ff0, #ff90); /* Orange to yellow */
    }
    50% {
      background: linear-gradient(to right, #ff90, rgb(135, 135, 237)); /* Yellow to green */
    }
    75% {
      background: linear-gradient(to right, rgb(109, 109, 251), #81b9f0); /* Green to blue */
    }
    100% {
      background: linear-gradient(to right, #79b4ef, #f00); /* Blue to red, coming full circle */
    }
  }

  /* Added container with background for slight contrast with the animating background */
  .container {
    max-width: 400px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }





  @keyframes colorChange {
    0% { background-color: #f0f0f0; }
    25% { background-color: #e0e0e0; }
    50% { background-color: #d0d0d0; }
    75% { background-color: #c0c0c0; }
    100% { background-color: #f0f0f0; }
  }

  .container {
    max-width: 400px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    /* Added 3D effect properties */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transform: perspective(200px);
    transition: transform 0.3s ease-in-out;
    text-align: left;
  }

  .container h2 {
    text-align: center; /* Center "Registration" text */
  }

  .container:hover {
    transform: translateZ(5px) scale(1.01); /* Slight zoom on hover */
  }

  h2,
  label {
    color: #333;
    margin-bottom: 10px;
    /* Animation properties for text effects */
    animation: textEffects 5s infinite alternate ease-in-out;
    position: relative;
  }

  @keyframes textEffects {
    0% {
      text-shadow: 0 0 0px #d4e765;
    }
    50% {
      text-shadow: 0 0 5px #ffffff,
                   0 0 10px #ff6347,
                   0 0 15px #ffa07a;
    }
    100% {
      text-shadow: 0 0 0px #d9f829;
    }
  }

  label:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Animation properties for sparkle effects */
    animation: sparkle 2s infinite alternate ease-in-out;
    background-image: radial-gradient(circle at 50%, transparent 0%, transparent 50%);
  }

  @keyframes sparkle {
    0% {
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }

  input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }

  input:focus {
    outline: none;
    border-color: #428bca;
    animation: popUp 0.3s ease;
  }

  @keyframes popUp {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    margin-top: 10px;
  }

  input[type="submit"]:hover {
    background-color: #40a049;
  }

  .login-link {
    margin-top: 10px;
    font-size: 14px;
    color: #4CAF50;
    text-decoration: none;
    display: block;
  }

  .login-link:hover {
    color: #00b894;
  }


</style>
</head>
<body>
  <div class="container">
   
    <h2>Registration</h2>
    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required><br>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required><br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required><br>
      <label for="confirmpassword">Confirm Password:</label>
      <input type="password" name="confirmpassword" id="confirmpassword" required><br>
      <input type="submit" name="submit" value="Register">
    </form>
    <a href="login.php" class="login-link">Already have an account? Login</a>
  </div>
  <script>
        function nameValid() {
            let name = document.forms.name.value;
            let nameReg = /^[a-zA-Z]+$/;
            if (!nameReg.test(name)) {
                alert("Field cannot be empty and name should contain alphabets only");
                return false;
            }
            return true;
        }

        function ageValid() {
            let age = document.forms.age.value;
            if (isNaN(age)) {
                alert("Age should be numeric value only");
                return false;
            }
            return true;
        }

        function passwordValid() {
            let pass = document.forms.pass.value;
            let cpass = document.forms.cpass.value;
            if (pass !== cpass || pass.length < 6) {
                alert("Please confirm the password and enter at least 6 characters");
                return false;
            }
            return true;
        }

        function phoneValid() {
            let ph = document.forms.ph.value;
            let phReg = /^[0-9]{10}$/;
            if (!phReg.test(ph)) {
                alert("Phone number should contain 10 digits only");
                return false;
            }
            return true;
        }

        function emailValid() {
            let x = document.forms.email.value;
            let atpos = x.indexOf("@");
            let dotpos = x.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 1 >= x.length) {
                alert("Please enter a valid email address");
                return false;
            }
            return true;
        }

        function validate() {
            if (ageValid() && nameValid() && passwordValid() && emailValid() && phoneValid()) {
                return true;
            }
            return false;
        }
    </script>
</body>
</html>
