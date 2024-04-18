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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $semester = $_POST["semester"];
    $subject = $_POST["subject"];
    $file = $_FILES["file"];

    $stmt = $pdo->prepare("SELECT subject_id FROM subjects WHERE subject_name = :subject AND semester = :semester");
    $stmt->execute(['subject' => $subject, 'semester' => $semester]);
    $subjectId = $stmt->fetchColumn();

    if ($subjectId) {
        $fileName = $file["name"];
        $filePath = "uploads/". $fileName; 
        $uploadedBy = 1;

        $stmt = $pdo->prepare("INSERT INTO study_materials (subject_id, file_name, file_path, uploaded_by) VALUES (:subjectId, :fileName, :filePath, :uploadedBy)");
        $stmt->execute(['subjectId' => $subjectId, 'fileName' => $fileName, 'filePath' => $filePath, 'uploadedBy' => $uploadedBy]);

        echo "File uploaded successfully.";
    } else {
        echo "Invalid subject or semester.";
    }

}

$semester = $_GET['semester']; 
$stmt = $pdo->prepare("
    SELECT s.semester, sub.subject_name, sm.file_name, sm.file_path
    FROM study_materials sm
    JOIN subjects sub ON sm.subject_id = sub.subject_id
    WHERE sub.semester =?
    ORDER BY sub.semester, sub.subject_name, sm.upload_date DESC;
");

$stmt->execute([$semester]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {
    echo "Semester: ". $result['semester']. "<br>";
    echo "Subject: ". $result['subject_name']. "<br>";
    echo "File Name: ". $result['file_name']. "<br>";
    echo "File Path: ". $result['file_path']. "<br><br>";
}
?>