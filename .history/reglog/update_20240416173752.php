<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
 
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