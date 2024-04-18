<?php
require 'database.php'; // Assuming this file contains the $conn object for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize input data
    $firstName = mysqli_real_escape_string($conn, $_POST["first-name"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["last-name"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phone-number"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // SQL query to insert the data into a database (assumes you have a table called `contacts`)
    $query = "INSERT INTO contacts (first_name, last_name, phone_number, email, message) VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$message')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Thank you for contacting us!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='contact.php';</script>";
    }
}