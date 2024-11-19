<?php
session_start();
require 'db.php';

// Get current user (alumni) ID
$alumni_id = $_SESSION['user_id'];

// Query to fetch internship applications where the logged-in alumni posted the internship
$query = "SELECT id, internship_title, student_name, cover_letter, resume, application_date 
          FROM internship_applications 
          WHERE alumni_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internship Applications</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        /* Table styling */
        .application-table {
            width: 100%;
            border-collapse: collapse;
        }
        .application-table th {
            background-color: #007bff;
            color: white;
            padding: 8px;
            text-align: left;
        }
        .application-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .btn {
            padding: 5px 10px;
            color: white;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn.delete { background-color: #dc3545; }
        .btn.approve { background-color: #28a745; }
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
            <a href="alumini_index.php">Home</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
<h2>Internship Applications</h2>
<table class="application-table">
    <thead>
        <tr>
            <th>Internship Title</th>
            <th>Student Name</th>
            <th>Cover Letter</th>
            <th>Resume</th>
            <th>Application Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['internship_title']); ?></td>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td>
                    <button onclick="showCoverLetter(<?php echo $row['id']; ?>)">View</button>
                    <div id="coverLetterModal-<?php echo $row['id']; ?>" class="modal" style="display:none;">
                        <div class="modal-content">
                            <span onclick="closeCoverLetter(<?php echo $row['id']; ?>)" class="close">&times;</span>
                            <p><?php echo nl2br(htmlspecialchars($row['cover_letter'])); ?></p>
                        </div>
                    </div>
                </td>
                <td><a href="resumes/<?php echo htmlspecialchars($row['resume']); ?>" download>Download</a></td>
                <td><?php echo htmlspecialchars($row['application_date']); ?></td>
                <td>
                    <button class="btn delete" onclick="deleteApplication(<?php echo $row['id']; ?>)">Delete</button>
                    <button class="btn approve" onclick="approveApplication(<?php echo $row['id']; ?>)">Approve</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
function showCoverLetter(id) {
    document.getElementById("coverLetterModal-" + id).style.display = "block";
}

function closeCoverLetter(id) {
    document.getElementById("coverLetterModal-" + id).style.display = "none";
}

function deleteApplication(id) {
    if (confirm("Are you sure you want to delete this application?")) {
        window.location.href = "delete_internship_application.php?id=" + id;
    }
}

function approveApplication(id) {
    if (confirm("Do you want to approve this application?")) {
        window.location.href = "approve_internship_application.php?id=" + id;
    }
}
</script>

</body>
</html>
