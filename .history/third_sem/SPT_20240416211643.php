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
                <th colspan="1">Material ID</th>
                <th colspan="1">Subject Name</th>
                <th colspan="1">File Name</th>
                <th colspan="1">Upload Date</th>
                <th colspan="1">Delete</th>
                <th colspan="1">Update</th>
                <th colspan="1">Download</th>
            </tr>
            <?php
            require 'database.php';

            $sql = "SELECT sm.material_id, sm.file_name,sm.file_path,sm.upload_date, s.subject_name
                    FROM study_materials sm
                    JOIN subjects s ON sm.subject_id = s.subject_id WHERE s.subject_id=1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch each row and populate the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td colspan='1'>" . $row["material_id"] . "</td>";
                    echo "<td colspan='1'>" . $row["subject_name"] . "</td>";
                    echo "<td colspan='1'>" . $row["file_name"] . "</td>";
                    echo "<td colspan='1'>" . $row["upload_date"] . "</td>";
                    echo "<td colspan='1'>" . $row["Update"] . "</td>";
                    echo "<td colspan='1'>" . $row["Download"] . "</td>";
                    echo "<td colspan='1'><a href='http://localhost/education/delete.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to delete this study material?');\">Delete</a></td>";
                    echo "<td colspan='1'><a href='http://localhost/education/updateup.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to update this study material?');\">Update</a></td>";
                    echo "<td colspan='1'><a href='http://localhost/education/download.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to Download this study material?');\">Download</a></td>";
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
