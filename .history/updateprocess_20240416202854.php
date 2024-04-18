<?php
// Include database connection
include("database.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate and retrieve form data
  $materialId = $_POST['material_id'];
  $fileName = $_POST['file_name'];
  $filePath = $_POST['file_path'];
  $subjectName = $_POST['subject_name'];

  // Update study material details in the database
  $sql = "UPDATE study_materials 
          SET file_name = ?, file_path = ?, subject_name = ?
          WHERE material_id = ?";
  
  // Prepare the SQL statement
  $stmt = $conn->prepare($sql);

  // Bind parameters
  $stmt->bind_param("sssi", $fileName, $filePath, $subjectName, $materialId);

  // Execute the update query
  if ($stmt->execute()) {
    // Update successful, redirect to a success page
    header("Location: update_success.php");
    exit();
  } else {
    // Update failed, display an error message
    echo "Failed to update study material. Error: " . $conn->error;
  }
} else {
  // Invalid request if not submitted via POST method
  echo "Invalid request.";
}

// Close database connection
$conn->close();
?>
