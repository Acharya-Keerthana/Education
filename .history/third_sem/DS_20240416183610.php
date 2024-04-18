<?php
require 'database.php';

$sql = "SELECT sm.material_id, sm.file_name, sm.file_path, sm.upload_date, s.subject_name
        FROM study_materials sm
        JOIN subjects s ON sm.subject_id = s.subject_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch each row and populate the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["material_id"] . "</td><td>" . $row["subject_name"] . "</td><td>" . $row["file_name"] . "</td><td>" . $row["file_path"] . "</td><td>" . $row["upload_date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}
?>