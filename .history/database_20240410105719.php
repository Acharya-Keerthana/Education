<?php
$servername="localhost";
$username="root";
$password="";
$database="student";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
die ("connection error".mysqli_connect_error());
}
else{
echo "conection successful<br>";
}
