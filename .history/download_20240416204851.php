<?php
// Include database connection
include("database.php");

// Check if material ID is provided via GET parameter
if (isset($_GET['material_id'])) {
    $materialId = $_GET['material_id'];

    // Fetch study material details from database
    $sql = "SELECT file_name, file_path FROM study_materials WHERE material_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $materialId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if study material exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get file details
        $fileName = $row['file_name'];
        $filePath = $row['file_path'];

        // Define the path to the file
        $file = __DIR__ . '/' . $filePath;

        // Check if the file exists
        if (file_exists($file)) {
            // Set headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        } else {
            // File not found
            echo "File not found.";
        }
    } else {
        // Study material not found
        echo "Study material not found.";
    }
} else {
    // Invalid request. Material ID not provided.
    echo "Invalid request. Material ID not provided.";
}

// Close database connection
$conn->close();
?>
