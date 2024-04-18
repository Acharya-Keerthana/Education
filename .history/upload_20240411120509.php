<?php
error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$database="education";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
die ("connection error".mysqli_connect_error());
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body>
    <div class="nav_bar">
        <div class="logo"><i class="fas fa-book-open"></i>STUDY HUB </div>
        <nav>
            <a href="index.html"><i class="fa fa-home"></i>Home</a>
            <a href="#upload"><i class="fa fa-cloud-upload"></i>Upload</a>
            <a href="index.html#study-material"><i class="fa fa-graduation-cap"></i>Study Material</a>
            <a href="index.html#contact"><i class="fa fa-users"></i>Contact</a>
        </nav>
    </div>
   
    <section class="study_sec" id="upload">
        <div class="studymaterial">
            <h1 class="study_heading">Upload Study Material</h1>
            <p>Please select the semester and subject before uploading the file.</p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester">
                    <option value="not selected">--Select Semester--</option>
                    <option value="3">3rd Semester</option>
                    <option value="4">4th Semester</option>
                    <option value="5">5th Semester</option>
                    <option value="6">6th Semester</option>
                    <option value="7">7th Semester</option>
                    <option value="8">8th Semester</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <select id="subject" name="subject">
                    <option value="">--Select Subject--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" id="file" name="file" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png,.ppt,.pptx">
            </div>
            <button type="submit" id="upload-btn" class="submit-btn" disabled>Upload</button>
        </form>
        </div>
    </section>
    <hr>
    <footer>
    &copy;2024 ISE B
    </footer>
<script src="upload.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $semester = $_POST["semester"];
    $subject = $_POST["subject"];
    $file = $_FILES["file"];

   
    $stmt = $pdo->prepare("SELECT subject_id FROM subjects WHERE subject_name = :subject AND semester = :semester");
    $stmt->execute(['subject' => $subject, 'semester' => $semester]);
    $subjectId = $stmt->fetchColumn();

    if ($subjectId) {
   
        $fileName = $file["name"];
        $filePath = "uploads/" . $fileName; 
        $uploadedBy = 1;

        $stmt = $pdo->prepare("INSERT INTO study_materials (subject_id, file_name, file_path, uploaded_by) VALUES (:subjectId, :fileName, :filePath, :uploadedBy)");
        $stmt->execute(['subjectId' => $subjectId, 'fileName' => $fileName, 'filePath' => $filePath, 'uploadedBy' => $uploadedBy]);

        echo "File uploaded successfully.";
    } 
    else {
        echo "Invalid subject or semester.";
    }

}
?>
<?php

$semester = $_GET['semester']; 
$stmt = $pdo->prepare("
    SELECT s.semester, sub.subject_name, sm.file_name, sm.file_path
    FROM study_materials sm
    JOIN subjects sub ON sm.subject_id = sub.subject_id
    WHERE sub.semester = ?
    ORDER BY sub.semester, sub.subject_name, sm.upload_date DESC;
");

$stmt->execute([$semester]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {
    echo "Semester: " . $result['semester'] . "<br>";
    echo "Subject: " . $result['subject_name'] . "<br>";
    echo "File Name: " . $result['file_name'] . "<br>";
    echo "File Path: " . $result['file_path'] . "<br><br>";
}
?>






