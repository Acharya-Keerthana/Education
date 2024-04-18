<?php
include("database.php");
$sql1 = "SELECT * FROM upload";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div >
        <h1>Download</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>file name</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $count=1;
                    if($result->num_rows>0){
                    while($data=mysqli_fetch_array($sql1)){
                    echo "<tr>";
                    echo "<td>".$count."</td>";
                    echo "<td>".$data['filename']."</td>";
                    echo '<td><a href="uploads/"'.$data['filename'].'"class="btn btn info" download>Download</a></td>';
                    echo "</tr>";
                    $count++;
                    }
                    }
                    else{
                    echo "no records found";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

