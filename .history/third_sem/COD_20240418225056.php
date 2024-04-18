<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="table-container">
        <h2>List of Study Materials</h2>
        <table>
            <tr>
                <th>Material ID</th>
                <th>Subject Name</th>
                <th>File Name</th>
                <th>Upload Date</th>
                <th>Delete</th>
                <th>Update</th>
                <th>Download</th>
            </tr>
            <?php
            require 'database.php';

            $sql = "SELECT sm.material_id, sm.file_name,sm.file_path,sm.upload_date, s.subject_name
                    FROM study_materials sm
                    JOIN subjects s ON sm.subject_id = s.subject_id WHERE s.subject_id=2";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch each row and populate the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["material_id"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["file_name"] . "</td>";
                    echo "<td>" . $row["upload_date"] . "</td>";
                    echo "<td>" . $row["Update"] . "</td>";
                    echo "<td>" . $row["Download"] . "</td>";
                    echo "<td><a href='http://localhost/education/Education/delete.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to delete this study material?');\">Delete</a></td>";
                    echo "<td><a href='http://localhost/education/Education/updateup.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to update this study material?');\">Update</a></td>";
                    echo "<td><a href='http://localhost/education/Education/download.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to Download this study material?');\">Download</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
