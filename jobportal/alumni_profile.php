<?php
session_start();
require 'db.php';

$alumni_id = $_SESSION['user_id'];
$profile = null;

// Check if profile exists
$stmt = $conn->prepare("SELECT * FROM alumni_profile WHERE alumni_id = ?");
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $currently_working_company = $_POST['currently_working_company'];
    $designation = $_POST['designation'];
    $experience = $_POST['experience'];
    $passed_out_from_pu = $_POST['passed_out_from_pu'];
    $department = $_POST['department'];
    $domain = $_POST['domain'];
    $dob = $_POST['dob'];
    $linkedin_id = $_POST['linkedin_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Handle file upload for profile picture
    $profile_pic = $_FILES['profile_pic']['name'];
    $target_dir = "alumni_profile_pic/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    
    if ($profile_pic && move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $profile_pic = $target_file;
    } else {
        $profile_pic = $profile['profile_pic'] ?? null;
    }

    // Update if profile exists, else insert new profile
    if ($profile) {
        $stmt = $conn->prepare("UPDATE alumni_profile SET full_name = ?, currently_working_company = ?, designation = ?, experience = ?, passed_out_from_pu = ?, department = ?, domain = ?, dob = ?, linkedin_id = ?, email = ?, phone = ?, profile_pic = ? WHERE alumni_id = ?");
        $stmt->bind_param("sssisssssssii", $full_name, $currently_working_company, $designation, $experience, $passed_out_from_pu, $department, $domain, $dob, $linkedin_id, $email, $phone, $profile_pic, $alumni_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO alumni_profile (alumni_id, full_name, currently_working_company, designation, experience, passed_out_from_pu, department, domain, dob, linkedin_id, email, phone, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssisssssssi", $alumni_id, $full_name, $currently_working_company, $designation, $experience, $passed_out_from_pu, $department, $domain, $dob, $linkedin_id, $email, $phone, $profile_pic);
    }

    if ($stmt->execute()) {
        echo "Profile saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $profile = compact('full_name', 'currently_working_company', 'designation', 'experience', 'passed_out_from_pu', 'department', 'domain', 'dob', 'linkedin_id', 'email', 'phone', 'profile_pic');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>/* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}

/* Container for profile display and form */
.container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Profile display styles */
.profile-display {
    text-align: center;
}

.profile-display img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 2px solid #007BFF; /* Blue border for profile picture */
    margin-bottom: 20px;
}

/* Form styles */
form {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Spacing between form elements */
    margin-top: 20px;
}

form label {
    font-weight: bold;
}

form input[type="text"],
form input[type="email"],
form input[type="url"],
form input[type="tel"],
form input[type="date"],
form input[type="number"],
form input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    background-color: #007BFF; /* Primary button color */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3; /* Darker shade on hover */
}

/* Mobile responsiveness */
@media (max-width: 600px) {
    body {
        padding: 10px;
    }

    .container {
        padding: 15px;
    }
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
                <h2>Alumni Connect</h2>    
            </div>
            <a href="./alumini_dashboard.php">Dashboard</a>
            <a href="alumni_index.php">Home</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="container">

        <h2>Alumni Profile</h2>
        <?php if ($profile): ?>
            <div class="profile-display">
                <center><img src="<?php echo $profile['profile_pic']; ?>" alt="Profile Picture"></center>
                <p><strong>Full Name:</strong> <?php echo $profile['full_name']; ?></p>
                <p><strong>Currently Working Company:</strong> <?php echo $profile['currently_working_company']; ?></p>
                <p><strong>Designation:</strong> <?php echo $profile['designation']; ?></p>
                <p><strong>Experience:</strong> <?php echo $profile['experience']; ?> years</p>
                <p><strong>Passed Out From PU:</strong> <?php echo $profile['passed_out_from_pu']; ?></p>
                <p><strong>Department:</strong> <?php echo $profile['department']; ?></p>
                <p><strong>Domain:</strong> <?php echo $profile['domain']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $profile['dob']; ?></p>
                <p><strong>LinkedIn ID:</strong> <a href="<?php echo $profile['linkedin_id']; ?>" target="_blank"><?php echo $profile['linkedin_id']; ?></a></p>
                <p><strong>Email:</strong> <?php echo $profile['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $profile['phone']; ?></p>
                <button onclick="document.getElementById('profileForm').style.display='block'">Edit Profile</button>
            </div>
            <?php else: ?>
                <p>No profile found. Please create your profile.</p>
                <?php endif; ?>
                
                <!-- Profile Form -->
                <form id="profileForm" action="alumni_profile.php" method="POST" enctype="multipart/form-data" style="<?php echo $profile ? 'display:none;' : ''; ?>">
    <label>Full Name:</label>
    <input type="text" name="full_name" required value="<?php echo $profile['full_name'] ?? ''; ?>">
    
    <label>Currently Working Company:</label>
    <input type="text" name="currently_working_company" value="<?php echo $profile['currently_working_company'] ?? ''; ?>">
    
    <label>Designation:</label>
    <input type="text" name="designation" value="<?php echo $profile['designation'] ?? ''; ?>">
    
    <label>Experience (years):</label>
    <input type="number" name="experience" value="<?php echo $profile['experience'] ?? ''; ?>">
    
    <label>Passed Out From PU:</label>
    <input type="year" name="passed_out_from_pu" required value="<?php echo $profile['passed_out_from_pu'] ?? ''; ?>">
    
    <label>Department:</label>
    <input type="text" name="department" required value="<?php echo $profile['department'] ?? ''; ?>">
    
    <label>Domain:</label>
    <input type="text" name="domain" value="<?php echo $profile['domain'] ?? ''; ?>">
    
    <label>Date of Birth:</label>
    <input type="date" name="dob" required value="<?php echo $profile['dob'] ?? ''; ?>">
    
    <label>LinkedIn ID:</label>
    <input type="url" name="linkedin_id" value="<?php echo $profile['linkedin_id'] ?? ''; ?>">
    
    <label>Email:</label>
    <input type="email" name="email" required value="<?php echo $profile['email'] ?? ''; ?>">
    
    <label>Phone:</label>
    <input type="tel" name="phone" required value="<?php echo $profile['phone'] ?? ''; ?>">
    
    <label>Profile Picture:</label>
    <input type="file" name="profile_pic">
    
    <button type="submit">Save Profile</button>
</form>
</div>
</body>
</html>
