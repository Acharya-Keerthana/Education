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

