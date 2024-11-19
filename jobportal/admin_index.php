<?php
session_start();
require 'db.php'; // Include your database connection file

// Delete alumni user
if (isset($_GET['delete_alumni_id'])) {
    $delete_id = $_GET['delete_alumni_id'];
    $stmt = $conn->prepare("DELETE FROM alumni_user WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Delete student user
if (isset($_GET['delete_student_id'])) {
    $delete_id = $_GET['delete_student_id'];
    $stmt = $conn->prepare("DELETE FROM student_user WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch alumni users
$alumni_result = $conn->query("SELECT * FROM alumni_user");

// Fetch student users
$student_result = $conn->query("SELECT * FROM student_user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
    
        .section {
            display: none;
            padding: 20px;
            background: white;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
    </style>
    <script>
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block'; // Show selected section
            }
        }
    </script>
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
        <a href="javascript:void(0);" onclick="toggleSection('manageStudents');">Manage Students</a>
        <a href="javascript:void(0);" onclick="toggleSection('manageAlumni');">Manage Alumni</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div id="manageStudents" class="section">
    <h2>Manage Students</h2>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Register No</th>
            <th>Passed Out Year</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        <?php while ($student = $student_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['name']); ?></td>
            <td><?php echo htmlspecialchars($student['register_no']); ?></td>
            <td><?php echo htmlspecialchars($student['passed_out_year']); ?></td>
            <td><?php echo htmlspecialchars($student['department']); ?></td>
            <td>
                <a href="?delete_student_id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<div id="manageAlumni" class="section">
    <h2>Manage Alumni</h2>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Register No</th>
            <th>Passed Out Year</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        <?php while ($alumni = $alumni_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($alumni['name']); ?></td>
            <td><?php echo htmlspecialchars($alumni['register_no']); ?></td>
            <td><?php echo htmlspecialchars($alumni['passed_out_year']); ?></td>
            <td><?php echo htmlspecialchars($alumni['department']); ?></td>
            <td>
                <a href="?delete_alumni_id=<?php echo $alumni['id']; ?>" onclick="return confirm('Are you sure you want to delete this alumni?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
