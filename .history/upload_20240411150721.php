<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$database = "education";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection success<br>";
}

$targetDir = "uploads/";

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        $sql = "INSERT INTO files (filename, filepath) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $fileName, $targetPath);
        
        if ($stmt->execute()) {
            echo "File uploaded and saved to DB";
        } else {
            echo "Error: " . $conn->error;
        }
        
        $stmt->close();
    } else {
        echo "Error in moving the file";
    }
} else {
    echo "File not uploaded";
}

$conn->close();
?>
