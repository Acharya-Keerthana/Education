<?php
error_reporting(0);
// $servername="localhost";
// $username="root";
// $password="";
// $database="education";

// $conn=mysqli_connect($servername,$username,$password,$database);
// if(!$conn){
// die ("connection error".mysqli_connect_error());
// }

if (isset($_POST['semester'], $_POST['subject']) && !empty($_FILES['file']['name'])) {
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];
}

//php
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['semester'], $_POST['subject']) && !empty($_FILES['file']['name'])) {
        $semester = $_POST['semester'];
        $subject = $_POST['subject'];

        // File upload path
        $targetDirectory = "uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedExtensions = array("pdf", "doc", "docx", "jpg", "jpeg", "png", "ppt", "pptx");

        if (in_array($fileType, $allowedExtensions)) {
            // Check if file already exists
            if (!file_exists($targetFilePath)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // File uploaded successfully, now insert file details into database
                    $servername="localhost";
                    $username="root";
                    $password="";
                    $dbname="education";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if(!$conn){
                    die ("connection error".mysqli_connect_error());
                    }

                    // Prepare SQL statement to insert file details into database
                    $sql = "INSERT INTO se (filename, subject, semester) VALUES (?, ?, ?)";

                    echo "File uploaded successfully.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File already exists.";
            }
        } else {
            echo "Invalid file format. Allowed file types are: " . implode(", ", $allowedExtensions);
        }
    } else {
        echo "Please select semester, subject, and file.";
    }
} else {
    echo "Invalid request.";
}
?>

