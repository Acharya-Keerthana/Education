<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password != $confirmpassword) {
        echo "<script>alert('Passwords do not match');</script>";
        exit;
    }

    // Update query
    $query = "UPDATE tb_user SET name=?, username=?, email=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $username, $email, $password, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record updated successfully');</script>";
        header("Location: display.php"); // Redirect to a page showing updated records
        exit;
    } else {
        echo "<script>alert('Failed to update record');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request');</script>";
}
?>
