<?php
include("database.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .studymaterial {
    align-items: center;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column;
    height: 90vh;
    justify-content: center;
}

.studymaterial p {
    color: #e4d0d0;
    line-height: 1.5rem;
    margin: 20px 0;
    max-width: 500px;
    text-align: center;
}

.study_heading {
    color: #f5f5dc;
    font-size: 2rem;
}

.sem {
    align-items: center;
    background-color: hsla(0, 0%, 100%,0.2);
    border-radius: 40px;
    display: flex;
    flex-wrap: wrap;
    height: 30%;
    justify-content: center;
    overflow: hidden;
    width: 50%;
}

.sem_sec {
    box-sizing: border-box;
    padding: 10px;
    text-align: center;
    width: calc(100% / 3);
}

.sem_sec a {
    color: beige;
    display: block;
    font-size: 17px;
    letter-spacing: 0.5px;
    padding: 25px;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 0;
}

.sem_sec:hover {
    background: linear-gradient(to bottom, rgb(85, 10, 128), rgba(94, 4, 97, 0.979));
    color: white;
}

.form {
    background: linear-gradient(to bottom, rgba(45, 11, 100, 0.986), rgba(66, 5, 66, 0.5), rgba(86, 10, 105, 0.884));
    padding: 2rem;
    float: right;
   margin: 10px 100px 10px 0px ;
  border-radius: 20px;
  box-shadow: inset 0px 0px 25px rgba(0,0,0,0.2), 0 0 40px rgba(0,0,0,0.3);
}

.container {
    margin: 0 auto;
    width: 100%;
}

.heading {
    margin-bottom: 30px;
    padding-top: 10px;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: inline-block;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 8px;
    width: 100%;
}

.form-group textarea {
    resize: vertical;
}
.form_img {
        width: calc(50% - 20px);
        margin-left: 50px;
    }
.form_img img{
    max-width: 100%;
    height: auto;
    border-radius: 10px; 
    object-fit: cover;
}

.submit-btn {
    background: linear-gradient(to right, #FA4B37, #DF2771);
    border: none;
    border-radius: 7px;
    color: black;
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
    padding: 8px;
    width: 20rem;
}

.submit-btn:hover {
    background: rgba(255, 255, 255, 0.767);
    color: #141414;
}
    </style>
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
                    <option value="">--Select Semester--</option>
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
    <script>
        const semesterSelect = document.getElementById("semester");
        const subjectSelect = document.getElementById("subject");
        const uploadBtn = document.getElementById("upload-btn");

        semesterSelect.addEventListener("change", () => {
            const semester = semesterSelect.value;
            if (semester === "") {
                subjectSelect.innerHTML = "<option value=''>--Select Subject--</option>";
                uploadBtn.disabled = true;
            } else {
                // You can replace this dummy data with actual data from your server.
                const subjectsBySemester = {
                    "3": ["Statistics and Probability Theory", "Object oriented language", "Introduction to Data Science", "Unix Shell and System Programming", "Previous year paper"],
                    "4": ["Linear Algerbra and its application", "Design and Analysis of Algorithm", "Internet and web programming", "Database management system", "Previous year paper"],
                    // Add subjects for other semesters as needed
                };

                subjectSelect.innerHTML = "<option value=''>--Select Subject--</option>";
                subjectsBySemester[semester].forEach(subject => {
                    subjectSelect.innerHTML += `<option value="${subject}">${subject}</option>`;
                });
                uploadBtn.disabled = false;
            }
        });

        subjectSelect.addEventListener("change", () => {
            if (subjectSelect.value === "") {
                uploadBtn.disabled = true;
            } else {
                uploadBtn.disabled = false;
            }
        });
    </script>
</body>
</html>

