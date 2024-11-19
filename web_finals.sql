-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 09:35 PM
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
-- Table structure for table `curriculum_images`
--

CREATE TABLE `curriculum_images` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum_images`
--

INSERT INTO `curriculum_images` (`id`, `program_id`, `image_path`, `image_title`, `created_at`) VALUES
(1, 1, 'img/curriculum/ce_year1.jpg', 'First Year', '2024-11-19 17:59:09'),
(2, 1, 'img/curriculum/ce_year2.jpg', 'Second Year', '2024-11-19 17:59:09'),
(3, 1, 'img/curriculum/ce_year3.jpg', 'Third Year', '2024-11-19 17:59:09'),
(4, 1, 'img/curriculum/ce_year4.jpg', 'Fourth Year', '2024-11-19 17:59:09'),
(5, 2, 'img/curriculum/cpe_year1.jpg', 'First Year', '2024-11-19 17:59:09'),
(6, 2, 'img/curriculum/cpe_year2.jpg', 'Second Year', '2024-11-19 17:59:09'),
(7, 2, 'img/curriculum/cpe_year3.jpg', 'Third Year', '2024-11-19 17:59:09'),
(8, 2, 'img/curriculum/cpe_year4.jpg', 'Fourth Year', '2024-11-19 17:59:09'),
(9, 3, 'img/curriculum/me_year1.jpg', 'First Year', '2024-11-19 17:59:09'),
(10, 3, 'img/curriculum/me_year2.jpg', 'Second Year', '2024-11-19 17:59:09'),
(11, 3, 'img/curriculum/me_year3.jpg', 'Third Year', '2024-11-19 17:59:09'),
(12, 3, 'img/curriculum/me_year4.jpg', 'Fourth Year', '2024-11-19 17:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `department_programs`
--

CREATE TABLE `department_programs` (
  `id` int(11) NOT NULL,
  `program_title` varchar(100) NOT NULL,
  `program_description` text NOT NULL,
  `curriculum_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_programs`
--

INSERT INTO `department_programs` (`id`, `program_title`, `program_description`, `curriculum_title`, `created_at`, `updated_at`) VALUES
(1, 'Civil Engineering', 'The Civil Engineering program prepares students for careers in infrastructure development and construction management.', 'CE Curriculum 2024', '2024-11-19 17:59:09', '2024-11-19 17:59:09'),
(2, 'Computer Engineering', 'Comprehensive program combining computer science and electronic engineering principles.', 'CPE Curriculum 2024', '2024-11-19 17:59:09', '2024-11-19 17:59:09'),
(3, 'Mechanical Engineering', 'Program focused on design, manufacturing, and maintenance of mechanical systems.', 'ME Curriculum 2024', '2024-11-19 17:59:09', '2024-11-19 17:59:09');

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
(15, 'img/recognition.jpg', '123', '123', '2312-12-31 03:12:00', '312312'),
(16, 'img/recognition.jpg', '123', '123', '2312-12-31 03:12:00', '312312'),
(17, 'img/section_offering.jpg', '32131', '31231221', '3211-03-11 23:12:00', '321'),
(18, 'img/graduation.jpg', '213', '1231', '3123-03-21 12:31:00', 'DASDSA');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_path`, `uploaded_at`) VALUES
(1, '	\r\nimg/file (2).png', '2024-11-18 15:37:57'),
(2, '	\r\nimg/file (2).png', '2024-11-18 15:38:00');

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
(17, 'olo', 'qwe', 'img/alumni.jpg', '2024-11-19'),
(18, '313', 'ADSAD', 'img/assessment_form.jpg', '2024-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `curriculum_img` varchar(255) NOT NULL,
  `curriculum_desc` text NOT NULL,
  `img_caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_social`
--

CREATE TABLE `program_social` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `social_title` varchar(100) DEFAULT NULL,
  `social_description` text DEFAULT NULL,
  `social_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_social`
--

INSERT INTO `program_social` (`id`, `program_id`, `social_title`, `social_description`, `social_icon`, `created_at`) VALUES
(1, 1, 'CE Department', 'Follow us for Civil Engineering updates and events', 'fab fa-facebook-f', '2024-11-19 17:59:09'),
(2, 2, 'CPE Department', 'Stay connected with Computer Engineering department', 'fab fa-facebook-f', '2024-11-19 17:59:09'),
(3, 3, 'ME Department', 'Join the Mechanical Engineering community', 'fab fa-facebook-f', '2024-11-19 17:59:09');

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
-- Indexes for table `curriculum_images`
--
ALTER TABLE `curriculum_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

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
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_social`
--
ALTER TABLE `program_social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

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
-- AUTO_INCREMENT for table `curriculum_images`
--
ALTER TABLE `curriculum_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department_programs`
--
ALTER TABLE `department_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_social`
--
ALTER TABLE `program_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curriculum_images`
--
ALTER TABLE `curriculum_images`
  ADD CONSTRAINT `curriculum_images_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `department_programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_social`
--
ALTER TABLE `program_social`
  ADD CONSTRAINT `program_social_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `department_programs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
