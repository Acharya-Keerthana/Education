<?php
include("database.php");
?>
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
if(isset($_POST['submit'])){
    $targetDir="uploads/";
    $targetFile= $targetDir.basename($_FILES["file"]["name"]);
    $fileType= strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    if( $fileType!='.pdf, .doc, .docx, .jpg, .jpeg, .png,.ppt,.pptx'|| $_FILES["file"]["size"]>2000000){
        echo "error only files";
    }
    else{
if(move_uploaded_file($_FILES["file"]["temp_name"],$targetFile)){
    $filename=$_FILES["file"]["name"];
    $folder_path=$targetDir;
    $upload_time=date('Y-m-d-H:i:s');
    $sql = "INSERT INTO study_materials (filename,folder_path,upload_time) VALUES ('$filename','$folder_path','$upload_time')";
    if(mysqli_query($conn,$sql)){
        echo "inserted";
    }
    else{
        echo "error";
    }
}
else{
    echo "error uploading files";
}
    }
}
?>



