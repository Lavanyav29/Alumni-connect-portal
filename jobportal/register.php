<?php
session_start();
require 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $register_no = $_POST['register_no'];
    $passed_out_year = $_POST['passed_out_year'];
    $department = $_POST['department'];
    $password = $_POST['password'];
    
    // Check the passed out year to determine the table
    if ($passed_out_year >= 2025 && $passed_out_year <= 2026) {
        // Register as a student
        $table = 'student_user';
    } elseif ($passed_out_year < 2025) {
        // Register as an alumni
        $table = 'alumni_user';
    } else {
        // Invalid passed out year
        $error = "Invalid passed out year.";
    }

    if (!isset($error)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement for the respective table
        $stmt = $conn->prepare("INSERT INTO $table (name, register_no, passed_out_year, department, password) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("ssiss", $name, $register_no, $passed_out_year, $department, $hashed_password);
            // Execute the query and check if successful
            if ($stmt->execute()) {
                // Redirect to login page on successful registration
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
            $stmt->close();
        } else {
            $error = "Error preparing statement: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
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
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="about.php">About</a>
    </nav>
</header>
<form action="" method="post">
    <h2>Register</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="register_no">Register No:</label>
    <input type="text" id="register_no" name="register_no" required>
    
    <label for="passed_out_year">Passed Out Year:</label>
    <input type="number" id="passed_out_year" name="passed_out_year" required>
    
    <label for="department">Department:</label>
    <select id="department" name="department">
        <option value="MCA">MCA</option>
        <option value="MSc.CS">MSc.CS</option>
        <option value="M.Tech">M.Tech</option>
    </select>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Register</button>
    <p><?php if (isset($error)) echo $error; ?></p>
</form>
</body>
</html>
