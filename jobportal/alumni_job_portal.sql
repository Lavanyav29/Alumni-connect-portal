-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 12:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `alluser`
--
use alumni_job_portal;
CREATE TABLE `alluser` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login_value` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alluser`
--

INSERT INTO `alluser` (`id`, `name`, `login_value`) VALUES
(1, 'Gokul', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumni_profile`
--

CREATE TABLE `alumni_profile` (
  `alumni_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `currently_working_company` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `passed_out_from_pu` year(4) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `linkedin_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni_profile`
--

INSERT INTO `alumni_profile` (`alumni_id`, `full_name`, `currently_working_company`, `designation`, `experience`, `passed_out_from_pu`, `department`, `domain`, `dob`, `profile_pic`, `linkedin_id`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(5, 'sivakumar', 'TCS', 'Senior java Developer', 4, '2013', 'MCA', 'CS', '2024-11-12', '0', 'http://localhost/jobportal/alumni_profile.php', 'siva@gmail.com', '99393939', '2024-10-28 17:01:52', '2024-11-04 23:00:02'),
(8, 'Prakash', 'Google', 'Senior Developer', 10, '2012', 'Msc.CS', 'CS', '1996-06-04', NULL, 'https://www.linkedin.com/', 'prakash@gmail.com', '9600484309', '2024-11-03 13:45:52', '2024-11-03 13:46:06'),
(10, 'Ram', 'TCS', 'HR', 3, '2011', 'MCA', 'CS', '2024-11-03', NULL, 'https://www.youtube.com/', 'ram@gmail.com', '93939', '2024-11-03 09:37:48', '2024-11-03 13:37:22'),
(11, 'vicky', 'TCS', 'Senior java Developer', 8, '2010', 'Msc.CS', 'CS', '1992-10-14', NULL, 'https://www.linkedin.com/', 'vicky@gmail.com', '9192939495', '2024-11-03 16:54:00', '2024-11-03 16:54:00'),
(12, 'Neema', 'TCS', 'Java developer', 4, '2019', 'MCA', 'CS', '1999-05-23', NULL, 'https://www.linkedin.com/', 'neema@gmail.com', '912934956', '2024-11-03 17:12:00', '2024-11-03 17:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_user`
--

CREATE TABLE `alumni_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `register_no` varchar(50) NOT NULL,
  `passed_out_year` year(4) NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni_user`
--

INSERT INTO `alumni_user` (`id`, `name`, `register_no`, `passed_out_year`, `department`, `password`) VALUES
(5, 'sivakumar', '13352092', '2013', 'MCA', '$2y$10$4.ZqFd2zm/o4B9SRPlbPgOaaBWEZ5eA6iCUX9M94mrqn3olL7QPfi'),
(8, 'Prakash', '12352092', '2012', 'MCA', '$2y$10$oBHgl02MFMV8KmnWMDYuHe9h/KgCIqyVdp5flmMxTdGMStQGzcj/6'),
(10, 'ram', '11152092', '2011', 'MCA', '$2y$10$LRcNanBtGwXuUuBvJJYPYONt2wqDuEB9DgMsFEc6TbYl.x0V4nUyS'),
(11, 'vicky', '10352092', '2010', 'MSc.CS', '$2y$10$ffbNPGS1JwrNtf1JTMdVQu7MO/VHvFU2uB1UezkY7d4LWQp7mr0V.'),
(12, 'neema', '19352092', '2019', 'MCA', '$2y$10$racCMJytnLOoxQC2E793R.tMXxU2hISUO8qpFn/gpkQM/sIkdWpoO');

-- --------------------------------------------------------

--
-- Table structure for table `internship_applications`
--

CREATE TABLE `internship_applications` (
  `id` int(11) NOT NULL,
  `internship_id` int(11) NOT NULL,
  `internship_title` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `alumni_id` int(11) DEFAULT NULL,
  `application_status` enum('approved','null') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship_applications`
--

INSERT INTO `internship_applications` (`id`, `internship_id`, `internship_title`, `student_id`, `student_name`, `cover_letter`, `resume`, `posted_by`, `application_date`, `alumni_id`, `application_status`) VALUES
(1, 1, 'java Intern', 5, 'Gokul', 'like to work as intern', 'Gokul S Resume.pdf', 'sivakumar', '2024-11-03 18:05:20', 5, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `internship_postings`
--

CREATE TABLE `internship_postings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `admin_user_name` varchar(255) NOT NULL,
  `application_deadline` date NOT NULL,
  `internship_duration` varchar(50) NOT NULL,
  `interview_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `internship_type` enum('Full-time','Part-time','Work from Home') NOT NULL,
  `internship_category` enum('Software Development','Web Development','Data Science','Cybersecurity','Mobile App Development','DevOps','Machine Learning','Game Development') NOT NULL,
  `poster_image` varchar(255) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship_postings`
--

INSERT INTO `internship_postings` (`id`, `title`, `company_name`, `description`, `admin_user_name`, `application_deadline`, `internship_duration`, `interview_date`, `location`, `internship_type`, `internship_category`, `poster_image`, `posted_by`, `posted_date`) VALUES
(1, 'java Intern', 'MSG Tech', 'core java \r\nspring boot', 'sivakumar', '2024-11-10', '3 Month', '2024-11-05', 'Chennai', 'Full-time', 'Web Development', 'java poster.png', 'sivakumar', '2024-11-03 17:48:59'),
(2, 'Mern Stack Intern', 'TCS', 'MongoDB, React,Express,Nodejs', 'sivakumar', '2024-11-06', '3 Month', '2024-11-07', 'chennai', 'Part-time', 'Web Development', 'Mern poster.png', 'sivakumar', '2024-11-03 18:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `posted_by` int(11) NOT NULL,
  `posted_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `alumni_id` int(11) DEFAULT NULL,
  `application_status` enum('approved','null') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `job_title`, `student_id`, `student_name`, `cover_letter`, `resume`, `posted_by`, `application_date`, `alumni_id`, `application_status`) VALUES
(10, 12, 'Java Developer', 5, 'Gokul', 'I m Gokul , i m Willing to work in your company as a java Developer. ', 'Gokul S-Resume(2024).pdf', 'neema', '2024-11-03 17:15:25', 12, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `admin_user_name` varchar(255) NOT NULL,
  `application_deadline` date NOT NULL,
  `job_type` enum('Full-time','Part-time','Contract','Internship') NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `posted_by` varchar(255) NOT NULL,
  `poster_image` varchar(255) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` enum('Developing','Testing','Digital Marketing','Editor','Customer Support','Project Management','Design','Data Science') NOT NULL,
  `alumni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `title`, `company_name`, `description`, `admin_user_name`, `application_deadline`, `job_type`, `location`, `salary`, `posted_by`, `poster_image`, `posted_date`, `category`, `alumni_id`) VALUES
(12, 'Java Developer', 'MSG Tech', 'Skill in Spring Boot\r\nExperience in JDBC\r\nExtensive knowledge in Core java', 'neema', '2024-11-04', 'Full-time', 'Chennai', '10000', 'neema', 'java poster.png', '2024-11-03 17:13:40', 'Developing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `passout_year` year(4) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `department`, `passout_year`, `dob`, `address`, `mobile_no`, `email`, `profile_pic`, `user_id`) VALUES
(1, 'gokul1', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '9600484309', 'gokul08ms@gmail.com', 'uploads/Gokul S.jpg', NULL),
(2, 'gokul1', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '9600484309', 'gokul08ms@gmail.com', 'uploads/Gokul S.jpg', NULL),
(3, 'gokul1', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '9600484309', 'gokul08ms@gmail.com', 'uploads/Gokul S.jpg', NULL),
(4, 'gokul1', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '9600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201526.jpg', NULL),
(5, 'Gokul S', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '9600484309', 'gokul08ms@gmail.com', 'uploads/Gokul S.jpg', 4),
(6, 'hema', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '09600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201630.jpg', 5),
(7, 'hema', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '09600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201630.jpg', 5),
(8, 'hema', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '09600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201630.jpg', 5),
(9, 'hema', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '09600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201630.jpg', 5),
(10, 'hema', 'MCA', '2025', '2003-05-23', '7A/1, Soorasamhara Street,New Vandipalayam', '09600484309', 'gokul08ms@gmail.com', 'uploads/SAVE_20220911_201630.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `student_id` int(11) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `profession` enum('Student','Work') DEFAULT 'Student',
  `work_experience` varchar(50) DEFAULT NULL,
  `highest_education` varchar(100) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `current_job_company` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `linkedin_id` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`student_id`, `profile_pic`, `name`, `email`, `dob`, `profession`, `work_experience`, `highest_education`, `university`, `current_job_company`, `designation`, `experience`, `linkedin_id`, `resume`) VALUES
(5, 'student_profile_pic/4NiS.gif', 'Gokul S', 'gokul@gmail.com', '2003-05-23', 'Work', '3', 'MCA', 'PU', 'Fresher', 'deva', '4', 'http://localhost/jobportal3/student_profile.php', 'student_profile_pic/PU_University_Event_Management_System_Abstract (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `register_no` varchar(50) NOT NULL,
  `passed_out_year` year(4) NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`id`, `name`, `register_no`, `passed_out_year`, `department`, `password`) VALUES
(5, 'Gokul', '23352092', '2025', 'MCA', '$2y$10$NwQ2l7ieAIWeDtTlYSKj6./4aB7FPh0cWmC18hXGCS0/aeO300SuK'),
(6, 'Lavanya', '23352036', '2025', 'MCA', '$2y$10$k63WiPzGwgqzb54dsPQiyuOOMyjSEul.7T2k5pWx07PW9eIjoxstC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alluser`
--
ALTER TABLE `alluser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `alumni_profile`
--
ALTER TABLE `alumni_profile`
  ADD PRIMARY KEY (`alumni_id`);

--
-- Indexes for table `alumni_user`
--
ALTER TABLE `alumni_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_no` (`register_no`);

--
-- Indexes for table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internship_id` (`internship_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `internship_postings`
--
ALTER TABLE `internship_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posted_by` (`posted_by`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_user`
--
ALTER TABLE `student_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_no` (`register_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alluser`
--
ALTER TABLE `alluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alumni_user`
--
ALTER TABLE `alumni_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `internship_applications`
--
ALTER TABLE `internship_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `internship_postings`
--
ALTER TABLE `internship_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_user`
--
ALTER TABLE `student_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni_profile`
--
ALTER TABLE `alumni_profile`
  ADD CONSTRAINT `alumni_profile_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni_user` (`id`);

--
-- Constraints for table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD CONSTRAINT `internship_applications_ibfk_1` FOREIGN KEY (`internship_id`) REFERENCES `internship_postings` (`id`),
  ADD CONSTRAINT `internship_applications_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `alumni_user` (`id`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`posted_by`) REFERENCES `alumni_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`id`),
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `alumni_user` (`id`);

--
-- Constraints for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
