<?php
include("database.php");
$sql1 = "SELECT * FROM study_materials";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggQyR0iXCbMQv3Xipma34MD+dH/1FQ784/j6cY/1JTQU0hcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

