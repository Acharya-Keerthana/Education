
const semesterSelect = document.getElementById("semester");
const subjectSelect = document.getElementById("subject");
const uploadBtn = document.getElementById("upload-btn");

semesterSelect.addEventListener("change", () => {
    const semester = semesterSelect.value;
    if (semester === "") {
        subjectSelect.innerHTML = "<option value=''>--Select Subject--</option>";
        uploadBtn.disabled = true;
    } else {
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
