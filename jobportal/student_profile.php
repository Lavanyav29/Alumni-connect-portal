<?php
session_start();
require 'db.php';

$student_id = $_SESSION['user_id'];
$profile = null;

// Check if profile exists
$stmt = $conn->prepare("SELECT * FROM student_profile WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $profession = $_POST['profession'];
    $work_experience = $_POST['work_experience'];
    $highest_education = $_POST['highest_education'];
    $university = $_POST['university'];
    $current_job_company = $_POST['current_job_company'];
    $designation = $_POST['designation'];
    $experience = $_POST['experience'];
    $linkedin_id = $_POST['linkedin_id'];

    // Handle file uploads for profile picture and resume
    $profile_pic = $_FILES['profile_pic']['name'];
    $resume = $_FILES['resume']['name'];
    $target_dir = "student_profile_pic/";
    
    // Upload profile picture
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    if ($profile_pic && move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $profile_pic = $target_file;
    } else {
        $profile_pic = $profile['profile_pic'] ?? null;
    }

    // Upload resume
    $resume_file = $target_dir . basename($_FILES["resume"]["name"]);
    if ($resume && move_uploaded_file($_FILES["resume"]["tmp_name"], $resume_file)) {
        $resume = $resume_file;
    } else {
        $resume = $profile['resume'] ?? null;
    }

    // Update if profile exists, else insert new profile
    if ($profile) {
        $stmt = $conn->prepare("UPDATE student_profile SET name = ?, email = ?, dob = ?, profession = ?, work_experience = ?, highest_education = ?, university = ?, current_job_company = ?, designation = ?, experience = ?, linkedin_id = ?, profile_pic = ?, resume = ? WHERE student_id = ?");
        $stmt->bind_param("sssssssssssssi", $name, $email, $dob, $profession, $work_experience, $highest_education, $university, $current_job_company, $designation, $experience, $linkedin_id, $profile_pic, $resume, $student_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO student_profile (student_id, name, email, dob, profession, work_experience, highest_education, university, current_job_company, designation, experience, linkedin_id, profile_pic, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssssssss", $student_id, $name, $email, $dob, $profession, $work_experience, $highest_education, $university, $current_job_company, $designation, $experience, $linkedin_id, $profile_pic, $resume);
    }

    if ($stmt->execute()) {
        echo "Profile saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $profile = compact('name', 'email', 'dob', 'profession', 'work_experience', 'highest_education', 'university', 'current_job_company', 'designation', 'experience', 'linkedin_id', 'profile_pic', 'resume');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* style.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
  
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

h2 {
    text-align: center;
    color: #333;
}

.profile-display, #profileForm {
    width: 90%;
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    text-align: left;
}

.profile-display img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 2px solid #ddd;
}

.profile-display p {
    font-size: 1rem;
    margin: 5px 0;
    color: #555;
}

.profile-display button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.profile-display button:hover {
    background-color: #45a049;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form label {
    color: #333;
    font-weight: bold;
    text-align: left;
}

form input[type="text"],
form input[type="number"],
form input[type="year"],
form input[type="date"],
form input[type="url"],
form input[type="email"],
form input[type="tel"],
form input[type="file"] {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
    width: 100%;
    box-sizing: border-box;
}

form button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

form button[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
<header>
    <div class="header-container">
        <img src="https://www.pondiuni.edu.in/wp-content/uploads/2020/05/PU_Logo_Full.png" alt="College Logo">
    </div>
    <nav>
        <div class="college-title">
        <h2>Alumni Connect </h2>    
        </div>
      <a href="./student_index.php">Home</a>
        <a href="job_show.php">Jobs</a>
        <a href="internship_show.php">Internships</a>
        <a href="student_profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<h2>Student Profile</h2>
<?php if ($profile): ?>
    <div class="profile-display">
        <center><img src="<?php echo $profile['profile_pic']; ?>" alt="Profile Picture"></center>
        <p><strong>Name:</strong> <?php echo $profile['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $profile['email']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $profile['dob']; ?></p>
        <p><strong>Profession:</strong> <?php echo $profile['profession']; ?></p>
        <p><strong>Work Experience:</strong> <?php echo $profile['work_experience']; ?></p>
        <p><strong>Highest Education:</strong> <?php echo $profile['highest_education']; ?></p>
        <p><strong>University:</strong> <?php echo $profile['university']; ?></p>
        <p><strong>Current Job Company:</strong> <?php echo $profile['current_job_company']; ?></p>
        <p><strong>Designation:</strong> <?php echo $profile['designation']; ?></p>
        <p><strong>Experience:</strong> <?php echo $profile['experience']; ?> years</p>
        <p><strong>LinkedIn ID:</strong> <a href="<?php echo $profile['linkedin_id']; ?>" target="_blank"><?php echo $profile['linkedin_id']; ?></a></p>
        <a href="<?php echo $profile['resume']; ?>" target="_blank">Download Resume</a>
        <button onclick="document.getElementById('profileForm').style.display='block'">Edit Profile</button>
    </div>
<?php else: ?>
    <p>No profile found. Please create your profile.</p>
<?php endif; ?>

<!-- Profile Form -->
<form id="profileForm" action="student_profile.php" method="POST" enctype="multipart/form-data" style="<?php echo $profile ? 'display:none;' : ''; ?>">
    <label>Name:</label>
    <input type="text" name="name" required value="<?php echo $profile['name'] ?? ''; ?>">

    <label>Email:</label>
    <input type="email" name="email" required value="<?php echo $profile['email'] ?? ''; ?>">

    <label>Date of Birth:</label>
    <input type="date" name="dob" required value="<?php echo $profile['dob'] ?? ''; ?>">

    <label>Profession:</label>
    <select name="profession" required>
        <option value="Student" <?php echo ($profile['profession'] ?? '') == 'Student' ? 'selected' : ''; ?>>Student</option>
        <option value="Work" <?php echo ($profile['profession'] ?? '') == 'Work' ? 'selected' : ''; ?>>Work</option>
    </select>

    <label>Work Experience:</label>
    <input type="text" name="work_experience" value="<?php echo $profile['work_experience'] ?? ''; ?>">

    <label>Highest Education:</label>
    <input type="text" name="highest_education" required value="<?php echo $profile['highest_education'] ?? ''; ?>">

    <label>University:</label>
    <input type="text" name="university" required value="<?php echo $profile['university'] ?? ''; ?>">

    <label>Current Job Company:</label>
    <input type="text" name="current_job_company" value="<?php echo $profile['current_job_company'] ?? ''; ?>">

    <label>Designation:</label>
    <input type="text" name="designation" value="<?php echo $profile['designation'] ?? ''; ?>">

    <label>Experience (years):</label>
    <input type="text" name="experience" value="<?php echo $profile['experience'] ?? ''; ?>">

    <label>LinkedIn ID:</label>
    <input type="url" name="linkedin_id" required value="<?php echo $profile['linkedin_id'] ?? ''; ?>">

    <label>Profile Picture:</label>
    <input type="file" name="profile_pic">

    <label>Resume:</label>
    <input type="file" name="resume">

    <button type="submit">Save Profile</button>
</form>
</body>
</html>
