<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="./style.css">
    <style>
        /* CSS file (e.g., styles.css) */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .focus-areas {
            padding: 40px 20px;
            text-align: center;
            background-color: #fff;
        }

        .focus-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .focus-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 10px;
            width: calc(30% - 20px); /* Adjust width for responsiveness */
        }

        .focus-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .focus-card h3 {
            margin-top: 10px;
            font-size: 1.2em;
        }

        .focus-card p {
            font-size: 13px;
            line-height: 1.5;
            text-align: justify;
        }

        .focus-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
        }

        .hero .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .hero .btn:hover {
            background-color: #45a049;
            box-shadow: 0px 0px 15px rgba(76, 175, 80, 0.7);
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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="./about.php">about</a>
        
        </nav>
    </header>
    <h2>About Alumni Connect</h2><!-- about.php -->
<section class="focus-areas">
    <h2>Our Focus</h2>
    <div class="focus-cards">
        <div class="focus-card">
            <img src="job_posting_icon.png" alt="Job Posting">
            <h3>Job Postings</h3>
            <p>Alumni can post job openings and internships, allowing students to explore career opportunities and apply easily. Our platform serves as a bridge between alumni and current students, fostering professional growth and connections.</p>
        </div>
        <div class="focus-card">
            <img src="mentorship_icon.png" alt="Mentorship">
            <h3>Mentorship</h3>
            <p>Alumni provide guidance and mentorship to students, helping them navigate their career paths. Through this platform, alumni can offer valuable advice, share industry experiences, and support students in their professional journeys.</p>
        </div>
        <div class="focus-card">
            <img src="networking_icon.png" alt="Networking">
            <h3>Networking</h3>
            <p>Our platform encourages strong networking among alumni and students. Alumni can reconnect with the university community while students can build professional connections, preparing them for the competitive job market.</p>
        </div>
    </div>
</section>



</body>
</html>

