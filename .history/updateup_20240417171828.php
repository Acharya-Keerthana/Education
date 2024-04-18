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
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      transition: background-color 0.5s; /* Smooth transition for background color change */
    }

    .form-container {
      width: 80%;
      max-width: 600px; /* Fit to one desktop */
      margin: 5% auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s; /* Smooth transition for button hover effect */
    }

    input[type="submit"]:hover {
      background-color: #0056b3; /* Highlighting effect on hover */
    }

    /* Dynamic background color based on time */
    <script>
      var currentHour = new Date().getHours();
      var body = document.querySelector('body');
      if (currentHour < 10) {
          body.style.backgroundColor = '#f9f9f9'; // Morning
      } else if (currentHour < 20) {
          body.style.backgroundColor = '#f0f0f0'; // Day
      } else {
          body.style.backgroundColor = '#e0e0e0'; // Night
      }
    </script>
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
