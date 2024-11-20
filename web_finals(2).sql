-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 04:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_finals`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_section`
--

CREATE TABLE `aboutus_section` (
  `id` int(11) NOT NULL,
  `mission_title` varchar(255) NOT NULL,
  `mission_desc` text NOT NULL,
  `vision_title` varchar(255) NOT NULL,
  `vision_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aboutus_section`
--

INSERT INTO `aboutus_section` (`id`, `mission_title`, `mission_desc`, `vision_title`, `vision_desc`) VALUES
(1, 'Our Mission', 'To provide exceptional education and foster intellectual growth through innovative teaching, research, and community engagement. We are committed to developing well-rounded individuals who contribute positively to society through academic excellence, critical thinking, and ethical leadership.', '31231212', 'To be a leading institution of higher learning recognized globally for academic excellence, innovative research, and producing graduates who are prepared to address the challenges of tomorrow. We aspire to create an inclusive environment that promotes creativity, diversity, and sustainable development.'),
(4, 'dasd', 'dsad', 'dasd', 'dasdas');

-- --------------------------------------------------------

--
-- Table structure for table `department_programs`
--

CREATE TABLE `department_programs` (
  `id` int(11) NOT NULL,
  `department_title` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_programs`
--

INSERT INTO `department_programs` (`id`, `department_title`, `course_title`, `button_text`) VALUES
(1, 'College of Engineering', 'BS in Computer Engineering', 'asd'),
(2, 'College of Engineering', 'BS in Civil Engineering', 'Learn More'),
(3, 'College of Engineering', 'BS in Electrical Engineering', 'Enroll Today'),
(4, 'College of Business', 'BS in Business Administration', 'Register Now'),
(5, 'College of Business', 'BS in Accountancy', 'View Details'),
(6, 'College of Arts and Sciences', 'BA in Psychology', 'Discover More'),
(7, 'College of Arts and Sciences', 'BA in Communication', 'Join Us'),
(8, 'College of Education', 'Bachelor in Secondary Education', 'Start Here'),
(11, 'dasd', 'das', 'dasd'),
(12, 'das', 'das', 'das');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `loc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `img`, `title`, `description`, `date`, `loc`) VALUES
(6, 'img/1732045893_graduation.jpg', '12', '12', '3121-12-12 23:12:00', '13'),
(7, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(8, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(9, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(10, 'img/273910525_2269162686592736_3572107067754403761_n.jpg', 'Royal Rumble', 'SUNTUKAN FREE FOR ALL', '2024-11-21 17:45:00', 'OSA'),
(11, 'img/file (2).png', 'Walang Pasok', 'adsadasdad', '2024-11-22 06:44:00', 'adasdasd'),
(12, 'img/file (3).png', 'Walang Pasok', 'sdasdasd', '2024-11-06 04:43:00', 'sdasdasd'),
(13, 'img/file (1).png', 'fuck this', '321', '2024-11-19 21:30:00', '123'),
(14, 'img/message.jpg', 'ssda', 'lol', '1111-11-11 11:11:00', 'calolo'),
(15, 'img/recognition.jpg', '123', '123', '2312-12-31 03:12:00', '312312');

-- --------------------------------------------------------

--
-- Table structure for table `facilities_section`
--

CREATE TABLE `facilities_section` (
  `id` int(11) NOT NULL,
  `facility_title` varchar(255) NOT NULL,
  `facility_desc` text NOT NULL,
  `facility_image1` varchar(255) DEFAULT NULL,
  `facility_image2` varchar(255) DEFAULT NULL,
  `facility_image3` varchar(255) DEFAULT NULL,
  `facility_image4` varchar(255) DEFAULT NULL,
  `facility_image5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities_section`
--

INSERT INTO `facilities_section` (`id`, `facility_title`, `facility_desc`, `facility_image1`, `facility_image2`, `facility_image3`, `facility_image4`, `facility_image5`) VALUES
(4, '313', '31231', 'img/facilities/1732116442_1_college.jpg', 'img/facilities/1732116442_2_assessment_form.jpg', 'img/facilities/1732116442_3_acquaintance.jpg', 'img/facilities/1732116442_4_college.jpg', 'img/facilities/1732116442_5_wika.jpg'),
(5, 'dasd', 'dasd', 'img/facilities/1732116848_1_frosh.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hero_section`
--

CREATE TABLE `hero_section` (
  `id` int(11) NOT NULL,
  `hero_img` varchar(255) NOT NULL,
  `hero_title` varchar(255) NOT NULL,
  `hero_desc` text NOT NULL,
  `button_text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_section`
--

INSERT INTO `hero_section` (`id`, `hero_img`, `hero_title`, `hero_desc`, `button_text`) VALUES
(1, 'img/hero/campus1.jpg', 'Welcome to Our University', 'Empowering minds, shaping futures. Join our community of innovative learners and world-class educators.', 'Learn More'),
(2, 'img/hero/students.jpg', 'Discover Your Potential', 'Access quality education, state-of-the-art facilities, and diverse learning opportunities.', 'Apply Now'),
(3, 'img/hero/library.jpg', 'Excellence in Education', 'Experience academic excellence with our comprehensive programs and dedicated faculty.', 'Explore Programs'),
(4, 'img/hero/graduation.jpg', 'Your Future Starts Here', 'Join thousands of successful alumni who started their journey with us.', 'Get Started');

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `title`, `description`, `image_path`, `video_path`, `button_text`, `button_url`, `is_active`) VALUES
(1, 'Welcome to Our Website', 'Discover amazing features and services we offer', '/uploads/hero/hero-image.jpg', NULL, 'Learn More', '/about', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `title`, `caption`, `photo`, `date_posted`) VALUES
(14, 'wew', 'fuck accounting', 'img/Screenshot_26-10-2024_181814_www.facebook.com.jpeg', '2024-11-19'),
(15, '312312123123', '321', 'img/file (2).png', '2024-11-19'),
(16, 'mahina ron', '123', 'img/graduation.jpg', '2024-11-19'),
(17, 'olo', 'qwe', 'img/alumni.jpg', '2024-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `program_info`
--

CREATE TABLE `program_info` (
  `id` int(11) NOT NULL,
  `program_title` varchar(255) NOT NULL,
  `program_desc` text NOT NULL,
  `curriculum_title` varchar(255) NOT NULL,
  `curriculum_image_title` varchar(255) DEFAULT NULL,
  `curriculum_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_info`
--

INSERT INTO `program_info` (`id`, `program_title`, `program_desc`, `curriculum_title`, `curriculum_image_title`, `curriculum_image`) VALUES
(1, 'Bachelor of Science in Information Technology', 'The BSIT program prepares students for careers in software development, networking, and systems administration.', 'BSIT Curriculum 2024', 'IT Curriculum Overview', 'img/curriculum/bsit_2024.jpg'),
(2, 'Bachelor of Science in Computer Science', 'Focuses on theoretical and practical aspects of computer systems and software development.', 'BSCS Curriculum 20231231', 'CS Curriculum Map', 'img/curriculum/bscs_2024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `social_section`
--

CREATE TABLE `social_section` (
  `id` int(11) NOT NULL,
  `social_title` varchar(255) NOT NULL,
  `social_desc` text NOT NULL,
  `social_icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_section`
--

INSERT INTO `social_section` (`id`, `social_title`, `social_desc`, `social_icon`) VALUES
(1, 'Follow Us on Facebook', 'Stay connected with our university community on Facebook for latest updates and events.', 'fab fa-facebook'),
(2, 'Join Us on LinkedIn', 'Connect with alumni and explore career opportunities through our professional network.', 'fab fa-linkedin'),
(3, 'Watch on YouTube', 'Subscribe to our channel for virtual tours, lectures, and campus life videos.', 'fab fa-youtube'),
(4, 'Follow on Instagram', 'Experience campus life through photos and stories from our community.', 'fab fa-instagram'),
(5, 'Connect on Twitter', 'Get real-time updates and engage in university discussions.', 'fab fa-twitter');

-- --------------------------------------------------------

--
-- Table structure for table `top_programs`
--

CREATE TABLE `top_programs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `page_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_programs`
--

INSERT INTO `top_programs` (`id`, `title`, `description`, `page_url`) VALUES
(1, 'COLLEGE OF ENGINEERING', 'Lyceum of Subic Bay Inc. (LSBI) offers Engineering Programs which equips graduates with the necessary knowledge and skills for the application, analysis, innovation, design, development, improvement, installation, integration, synthesis, and maintenance of software and hardware, electronic components, devices, products, apparatus, instruments, equipment, systems, networks operations; as well as sustainable generation, transmission, distribution and utilization of electrical energy; and integrated systems of people, material and information, equipment and energy as required by the industry in the field of\r\nComputer, Electronics, Electrical, and Industrial Engineering field.', 'programs/coe/civil.php'),
(2, 'COLLEGE OF COMPUTER STUDIES', 'VISION:\r\n\r\n\r\nA committed department that produces well-disciplined and technically well-equipped professionals\r\nwho could respond to the challenges of modern technology.\r\n\r\nMISSION:\r\n\r\nNurture the intellectual growth of students with their needs, interests and abilities to understand\r\nthe advancement of technology and its significance and relevance and innovate solutions that could best\r\nsupport their own development and progress, as well as that of their communities in this information era.\r\n\r\nOBJECTIVES:\r\n\r\n1. Inculcate strong technological foundation of students through the provision of effective and efficient learning experiences;\r\n2. Promote supportive learning environment for both teachers, and students, to enhance the teaching-learning process; and\r\n3. Imbibe moral responsibilities among students through the integration in identified subject lessons on moral and ethical\r\nvalues and standards, notwithstanding technological advances in their field of studies.', 'programs/ccs.it.php'),
(3, 'COLLEGE OF ACCOUNTANCY', 'VISION:\r\nProduce competitive accountancy student-graduates, who aspire to become valuable assets\r\nin the workplace and embody ethical standards demanded by the profession.\r\n\r\nMISSION:\r\nBe proactive accountancy students and enthusiasts, by participating productively in the Junior Philippine Institute\r\nof Accountants (JPIA), organization activities, both at the local, regional and national levels and\r\nshare/learn best professional practices with other members and colleagues, particularly in the\r\nareas of integrity, objectivity, transparency and consistency.', 'programs/cba/business.php');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `ID` int(11) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`ID`, `fName`, `lName`, `username`, `password`) VALUES
(1, 'Dan', 'Llenares', '2022010396', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_section`
--
ALTER TABLE `aboutus_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_programs`
--
ALTER TABLE `department_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `facilities_section`
--
ALTER TABLE `facilities_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_section`
--
ALTER TABLE `hero_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `program_info`
--
ALTER TABLE `program_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_section`
--
ALTER TABLE `social_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_programs`
--
ALTER TABLE `top_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_section`
--
ALTER TABLE `aboutus_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department_programs`
--
ALTER TABLE `department_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `facilities_section`
--
ALTER TABLE `facilities_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hero_section`
--
ALTER TABLE `hero_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `program_info`
--
ALTER TABLE `program_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_section`
--
ALTER TABLE `social_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `top_programs`
--
ALTER TABLE `top_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
