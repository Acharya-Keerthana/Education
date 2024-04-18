<?php
// Include database connection
include("database.php");

// Check if material ID is provided via GET parameter
if (isset($_GET['material_id'])) {
  $materialId = $_GET['material_id'];

  // Fetch study material details from database
  $sql = "SELECT sm.material_id, sm.file_name, sm.file_path, sm.upload_date, s.subject_name
          FROM study_materials sm
          JOIN subjects s ON sm.subject_id = s.subject_id
          WHERE sm.material_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $materialId);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if study material exists
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Display form for updating study material details
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Update Study Material</title>
      <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
      <div class="form-container">
        <h2>Update Study Material</h2>
        <form action="updateprocess.php" method="post">
          <input type="hidden" name="material_id" value="<?php echo $row['material_id']; ?>">
          <div class="form-group">
            <label for="file_name">File Name:</label>
            <input type="text" id="file_name" name="file_name" value="<?php echo $row['file_name']; ?>">
          </div>
          <div class="form-group">
            <label for="file_path">File Path:</label>
            <input type="text" id="file_path" name="file_path" value="<?php echo $row['file_path']; ?>">
          </div>
          <div class="form-group">
            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" value="<?php echo $row['subject_name']; ?>">
          </div>
          <input type="submit" value="Update">
        </form>
      </div>
    </body>
    </html>
    <?php
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
updateprocess
<?php
// Include database connection
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $materialId = $_POST['material_id'];
    $fileName = $_POST['file_name'];
    $filePath = $_POST['file_path'];

    // Validate form data (you can add more validation here)

    // Update study material details in the database
    $sql = "UPDATE study_materials
            SET file_name = ?, file_path = ?
            WHERE material_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fileName, $filePath, $materialId);

    if ($stmt->execute()) {
        // Update successful
        echo "Study material updated successfully.";
    } else {
        // Update failed
        echo "Error updating study material: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Invalid request method
    echo "Invalid request method.";
}

// Close database connection
$conn->close();
?>
