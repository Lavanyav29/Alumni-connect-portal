<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Student Index</title>
    <style>
     /* Global Styles */
body {

font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
font-weight: bold;
margin: 0;
padding: 0;
background: linear-gradient(to bottom right, #a8c8e0, #d0e7f2);
color: #333;
line-height: 1.6;
overflow-x: hidden;
transition: background-color 0.5s ease;
animation: fadeInBackground 0.5s ease-in-out;
}

/* Navbar Slide-in Animation */
header {   
text-align: center;
box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);

top: 0;
z-index: 10;
animation: slideDownNav 0.8s ease-out;
background: linear-gradient(45deg, #6a49a0, #4c5594);

text-align: center;
}

@keyframes slideDownNav {
0% {
    transform: translateY(-100%);
}
100% {
    transform: translateY(0);
}
}

header h1 {
margin: 0;
font-size: 2.5em;
}

header h2 {
margin: 0;
font-size: 1.5em;
}
.header-container {
display: flex;
justify-content: center;
align-items: center;
height: 100px; /* Adjust this height as needed */
}
nav {
background: linear-gradient(45deg, #6a49a0, #4c5594);
padding: 4px;
text-align: center;
}

nav a {
color: white;
padding: 14px 20px;
text-decoration: none;
display: inline-block;
}

nav a:hover {

color: gold;

transition: color 0.3s ease-in-out;
}

.college-logo {
width: 250px; /* Adjust the width to match the previous h1 size */
height: auto; /* Maintain aspect ratio */
/* Optional: add border-radius if you want rounded corners */
/* border-radius: 10px; */
}
.college-title h2 {
font-size: 1.5em;
color: white;
margin: 0;
display: block;
}
    

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        section {
            margin: 20px 0;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        section h3 {
            font-size: 1.8em;
            color: #00539C;
        }

        .news-item, .story-card, .job-card {
            padding: 15px;
            background: #f4f4f4;
            margin: 10px 0;
            border-radius: 5px;
        }

        .alumni-meet {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .alumni-meet img {
            width: 250px;
            height: 150px;
            border-radius: 5px;
            margin-right: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #00539C;
            color: white;
            font-size: 0.9em;
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
    
<main>
    <section class="welcome-section">
        <h2>Welcome Student!</h2>
        <p>Your one-stop platform to connect, engage, and explore opportunities with Pondicherry University Alumni Network.</p>
    </section>

    <section class="news-events">
        <h3>University News & Events</h3>
        <div class="news-item">
            <h4>Annual Alumni Meet 2024</h4>
            <p>Join us for our annual alumni meet and reconnect with your batchmates. Register to participate in panel discussions, workshops, and a gala dinner.</p>
        </div>
        <div class="news-item">
            <h4>Upcoming Webinar on Career Growth</h4>
            <p>Get insights from industry leaders on how to advance your career. Save the date and expand your professional network.</p>
        </div>
    </section>

    <section class="alumni-meet">
        <img src="./img/al.jpg" alt="Alumni Meet Image">
        <div>
            <h3>Join Us for the Annual Alumni Meet!</h3>
            <p>Reconnect with your peers, network with industry professionals, and engage in inspiring discussions. Don't miss out!</p>
            <a href="#" style="text-decoration: none; color: #00539C; font-weight: bold;">Register Now</a>
        </div>
    </section>

    <section class="alumni-stories">
        <h3>Success Stories</h3>
        <p>Get inspired by our alumni who have made significant impacts in their fields. Their journeys can motivate you on your career path.</p>
        <div class="story-card">
            <h4>Dr. Anjali Menon - Leading Researcher</h4>
            <p>From Pondicherry University to pioneering cancer research, Dr. Menon's story is one of resilience and dedication.</p>
        </div>
        <div class="story-card">
            <h4>Mr. Rajesh Kumar - CEO of Fintech Startup</h4>
            <p>An entrepreneur at heart, Rajesh shares his journey from our campus to leading a multi-million dollar startup.</p>
        </div>
    </section>

    <section class="connect-network">
        <h3>Connect & Network</h3>
        <p>Engage with fellow alumni in your domain. Use this platform to share knowledge, organize meetups, or collaborate on projects.</p>
        <ul>
            <li><a href="#">Alumni Directory</a></li>
            <li><a href="#">Mentorship Program</a></li>
            <li><a href="#">Discussion Forums</a></li>
        </ul>
    </section>
</main>

<footer>
    <p>&copy; 2024 Pondicherry University Alumni Network. All rights reserved.</p>
</footer>

</body>
</html>

