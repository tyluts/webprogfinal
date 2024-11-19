-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 02:18 PM
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
-- Database: `web_finals`
--

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
(6, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', '1', '1', '2024-11-16 20:00:00', '1'),
(7, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(8, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(9, 'img/Screenshot_6-11-2024_18648_www.instagram.com.jpeg', 'Walang Pasok', 'RRRRRRRRRRRRRR', '2024-11-15 16:40:00', 'Sa bahay'),
(10, 'img/273910525_2269162686592736_3572107067754403761_n.jpg', 'Royal Rumble', 'SUNTUKAN FREE FOR ALL', '2024-11-21 17:45:00', 'OSA'),
(11, 'img/file (2).png', 'Walang Pasok', 'adsadasdad', '2024-11-22 06:44:00', 'adasdasd'),
(12, 'img/file (3).png', 'Walang Pasok', 'sdasdasd', '2024-11-06 04:43:00', 'sdasdasd'),
(13, 'img/file (1).png', 'fuck this', '321', '2024-11-19 21:30:00', '123');

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
(14, 'tara suntukan', 'fuck accounting', 'img/Screenshot_26-10-2024_181814_www.facebook.com.jpeg', '2024-11-18'),
(15, '123', '321', 'img/file (2).png', '2024-11-18');

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
