<?php
error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$database="education";

$conn=new mysqli($servername,$username,$password,$database);
if(!$conn->connect_error){
die ("connection error".$conn->connect_error);
}
$targetDir="uploads/";
if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $targetDir.$filename;
    if(move_uploaded_file($_FILES['file']['temp_name'],$targetPath)){
        $sql="INSERT INTO files (filename,filepath) VALUES ('$fileName','$targetPath')";
        if($conn->query($sql)== true){
            echo "File uploaded and saved to DB";
        }
        else{
            echo "error";
        }
    }
    else{
        echo "error in moving the file";
    }
}
else{
       echo "file not uploaded"; 
}
$conn->close();