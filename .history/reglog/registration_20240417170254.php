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
</head>
<body>
  <div class="container">
    <h2>Registration</h2>
    <form class="" action="login.php" method="post" autocomplete="off">
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
      <input type="submit" value="Register">
    </form>
    <a href="login.php" class="login-link">Already have an account? Login</a>
  </div>
</body>
</html>


