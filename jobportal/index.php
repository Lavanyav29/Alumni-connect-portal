<?php
session_start();
require 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register_no = $_POST['register_no'];
    $password = $_POST['password'];

      // Admin credentials
      if ($register_no === '5858' && $password === 'admin') {
        $_SESSION['user'] = 'admin'; // Set session variable
        header("Location: admin_index.php"); // Redirect to admin dashboard
        exit(); // Stop script execution
    } else {
        // Handle invalid credentials
        $error = "Invalid register number or password.";
    }
    // Check in the student_user table
    $stmt = $conn->prepare("SELECT * FROM student_user WHERE register_no = ?");
    $stmt->bind_param("s", $register_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify student credentials
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'student';
            header("Location: student_index.php"); // Redirect to student dashboard
            exit();
        }
    }

    // If not found in student_user, check in alumni_user table
    $stmt = $conn->prepare("SELECT * FROM alumni_user WHERE register_no = ?");
    $stmt->bind_param("s", $register_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify alumni credentials
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'alumni';
            header("Location: alumni_index.php"); // Redirect to alumni dashboard
            exit();
        }
    }

    // If no match found, show error
    $error = "Invalid credentials";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
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
            <a href="./about.php">about</a>
        
        </nav>
    </header>
<form action="" method="post">
        <h2>Login</h2>
        
        <label for="register_no">Register No:</label>
        <input type="text" id="register_no" name="register_no" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
        <a href="./register.php" class="button1">Register</a>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
