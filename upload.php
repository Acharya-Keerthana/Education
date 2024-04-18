<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$database = "education";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $semester = $_POST['semester'];
    $subjectName = $_POST['subject'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    // Validate form fields
    if (!empty($semester) && !empty($subjectName) && !empty($fileName)) {
        // Get subject ID based on subject name and semester
        $sql = "SELECT 	subject_id FROM subjects WHERE subject_name = ? AND semester = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $subjectName, $semester);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $subjectId = $row['subject_id'];

            // Directory where uploaded files will be stored
            $uploadDirectory = "uploads/";

            // Check if file upload was successful
            if ($fileError === 0) {
                // Generate a unique filename to prevent overwriting
                $uploadedFileName = uniqid() . '_' . $fileName;
                $targetPath = $uploadDirectory . $uploadedFileName;

                // Move the uploaded file to the desired location
                if (move_uploaded_file($fileTmpName, $targetPath)) {
                    // Insert file details into material table
                    $insertSql = "INSERT INTO study_materials (subject_id, file_name, file_path) VALUES (?, ?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("iss", $subjectId, $fileName, $targetPath);
                    
                    if ($insertStmt->execute()) {
                        echo "File uploaded successfully.";
                    } else {
                        echo "Error uploading file: " . $insertStmt->error;
                    }
                    $insertStmt->close();
                } else {
                    echo "Error moving file to destination.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Subject not found for the selected semester.";
        }
        $stmt->close();
    } else {
        echo "Please select semester, subject, and upload a file.";
    }
}
$conn->close();
?>
