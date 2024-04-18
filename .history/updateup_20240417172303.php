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
  <script>
    window.onload = function() {
      var hue = Math.floor(Math.random() * 360);
      var saturation = Math.floor(Math.random() * 100) + 50;
      var lightness = Math.floor(Math.random() * 50) + 50;
      document.body.style.backgroundColor = "hsl(" + hue + ", " + saturation + "%, " + lightness + "%)";
    };
  </script>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  transition: background-color 0.5s;
}

.form-container {
  background-color: #f9f9f9; /* Light gray background color */
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

input[type="text"],
input[type="file"] {
  border-color: #ccc;
  border-radius: 5px;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s, box-shadow 0.3s;
}

input[type="submit"]:hover {
  background-color: #0056b3;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

  </style>

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
