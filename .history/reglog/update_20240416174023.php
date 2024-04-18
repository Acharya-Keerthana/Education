<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .container:hover {
            background-color: #e0e0e0;  /* Subtle background shift */
        }
        h2 {
            color: #333;
            transition: color 0.3s ease;
        }
        h2:hover {
            color: #00b894;  /* Refreshing green on hover */
        }
        label {
            display: block;
            margin-top: 10px;
            text-align: left;
            color: #777;
            transition: color 0.3s ease;
        }
        label:hover {
            color: #388e3c;  /* Soft green on hover */
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
        input:hover {
            background-color: #f8f8f8;
            border-color: #428bca;  /* Blue border on hover */
        }
        input:focus {
            outline: none;
            border-color: #428bca;
        }
        input[type="submit"] {
            background-color: #4CAF50;  /* Keep green for submit button */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);  /* Subtle shadow */
        }
        input[type="submit"]:hover {
            background-color: #40a049;
        }
        .login-link {
            margin-top: 10px;
            font-size: 14px;
            color: #4CAF50;  /* Keep green for login link */
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }
        .login-link:hover {
            color: #00b894;  /* Refreshing green on hover */
            text-shadow: 0 0 2px rgba(0, 0, 0, 0.2);  /* Subtle text shadow */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Record</h2>
        <?php
        include("config.php");

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM tb_user WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
        ?>
        <form action="update_process.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $row['password']; ?>" required><br>
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" value="<?php echo $row['confirmpassword']; ?>" required><br>
            <input type="submit" value="Update">
        </form>
        <?php } else { ?>
        <p>No record selected.</p>
        <?php } ?>
    </div>
</body>
</html>