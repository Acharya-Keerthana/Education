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
                <th>File Path</th>
                <th>Upload Date</th>
                <th>Delete</th>
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
                    echo "<td>" . $row["material_id"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["file_name"] . "</td>";
                    echo "<td>" . $row["file_path"] . "</td>";
                    echo "<td>" . $row["upload_date"] . "</td>";
                    echo "<td><a href='http://localhost/education/delete.php?material_id=" . $row['material_id'] . "' onclick=\"return confirm('Are you sure you want to delete this study material?');\">Delete</a></td>";
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
