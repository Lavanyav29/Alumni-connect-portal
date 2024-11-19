<?php
session_start();
require 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$alumni_id = $_SESSION['user_id'];

// Fetch the alumni's name
$alumni_stmt = $conn->prepare("SELECT name FROM alumni_user WHERE id = ?");
$alumni_stmt->bind_param("i", $alumni_id);
$alumni_stmt->execute();
$alumni_result = $alumni_stmt->get_result();

if ($alumni_result->num_rows === 0) {
    die("Alumni not found.");
}

$alumni = $alumni_result->fetch_assoc();
$alumni_name = $alumni['name'];

// Fetch internships posted by this alumni
$posted_internships = $conn->prepare("SELECT * FROM internship_postings WHERE posted_by = ?");
$posted_internships->bind_param("s", $alumni_name);
$posted_internships->execute();
$internships_result = $posted_internships->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posted Internships</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table styling */
        .application-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .application-table th, .application-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .application-table th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            padding: 5px 10px;
            color: white;
            background-color: #dc3545; /* Red for delete */
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #c82333;
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
            <a href="alumni_index.php">Home</a>
            <a href="./alumini_dashboard.php">Dashboard</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="posted_jobs.php">Posted Jobs</a> <!-- New "Posted Jobs" link -->
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
<h2>Your Posted Internships</h2>

<table class="application-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Company</th>
            <th>Internship Type</th>
            <th>Location</th>
            <th>Category</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($internship = $internships_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($internship['title']); ?></td>
                <td><?php echo htmlspecialchars($internship['company_name']); ?></td>
                <td><?php echo htmlspecialchars($internship['internship_type']); ?></td>
                <td><?php echo htmlspecialchars($internship['location']); ?></td>
                <td><?php echo htmlspecialchars($internship['internship_category']); ?></td>
                <td><?php echo htmlspecialchars($internship['application_deadline']); ?></td>
                <td>
                    <a href="delete.php?type=internship&id=<?php echo $internship['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this internship?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
