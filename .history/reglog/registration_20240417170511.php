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
</head>
<body>
  <div class="container">
    <h2>Registration</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
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
</body>
</html>
