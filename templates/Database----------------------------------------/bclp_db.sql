-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 09:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bclp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int(5) NOT NULL,
  `userid` int(11) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `activity` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `userid`, `userType`, `Name`, `activity`, `date`) VALUES
(1, 6, 'Instructor', 'cabungcal', 'Login', '2024-10-12 04:17:46'),
(2, 1, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:18:24'),
(3, 4, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:18:44'),
(4, 2, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:20:39'),
(5, 3, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:22:48'),
(6, 5, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:25:01'),
(7, 6, 'Instructor', 'cabungcal', 'Add Student', '2024-10-12 04:29:28'),
(8, 0, 'Instructor', 'cabungcal', 'Log Out', '2024-10-13 12:16:51'),
(9, 6, 'Instructor', 'cabungcal', 'Login', '2024-10-17 02:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `assess_score`
--

CREATE TABLE `assess_score` (
  `assessId` int(10) NOT NULL,
  `enrolleeId` int(10) NOT NULL,
  `score` int(5) NOT NULL,
  `totalquestion` int(3) NOT NULL,
  `recommend` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` varchar(6) NOT NULL,
  `courseLvl` varchar(15) NOT NULL,
  `courseTitle` varchar(100) NOT NULL,
  `courseDesc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseLvl`, `courseTitle`, `courseDesc`) VALUES
('CRS01', 'level 1', 'Basic, Intermediate & Advance Computer Concepts', 'Microsoft Office for enrollees without prior knowledge equips them with essential skills, enhances their employability, increase efficiency, fosters confidence and independence, facilitates collaboration, promotes lifelong learning, and provide access to valuable support and resources for ongoing development.'),
('CRS02', 'level 2', 'Photo and Graphic Enhancement Program', 'Adobe Photoshop CC (Creative Cloud) offers enrollees several significant benefits, especially for those involved in digital design, photography, and creative industries.\r\nEnrolling in Adobe Photoshop CC empowers enrollees with advanced image editing capabilities, enhances their creative skills and workflow efficieny, and prepares them to excel in professions that require proficiency in digital design and photography.'),
('CRS03', 'level 3', 'Internet Essetials & Basic, Webpage Design', 'Internet enhances individuals ability to access information, communicate effectively, conduct transactions securely, develop skills, and engage meaningfully in the digital age, contributing to personal growth and professional success.\r\nlearning Webpage design equips enrollees with valuable technical, creative, and professional skills that are essential for pursuing careers in digital design, web development, and related fields, offering opportunities for growth, innovation, and professinal fulfillment.');

-- --------------------------------------------------------

--
-- Table structure for table `enrollee`
--

CREATE TABLE `enrollee` (
  `enrolleeId` int(5) NOT NULL,
  `branch` varchar(25) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `time` varchar(25) NOT NULL,
  `sem` varchar(5) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `age` varchar(3) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `contact` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `educational` varchar(50) NOT NULL,
  `lastSchoolAttend` varchar(50) NOT NULL,
  `schoolYear` int(5) NOT NULL,
  `eduBackground` varchar(25) NOT NULL,
  `barangay` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `province` varchar(50) NOT NULL,
  `completeAddress` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `totalquestion` int(3) NOT NULL,
  `recommend` varchar(100) NOT NULL,
  `batch` int(5) NOT NULL,
  `isStudent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollee`
--

INSERT INTO `enrollee` (`enrolleeId`, `branch`, `courseId`, `time`, `sem`, `lastname`, `firstname`, `middlename`, `suffix`, `dob`, `age`, `sex`, `status`, `contact`, `email`, `educational`, `lastSchoolAttend`, `schoolYear`, `eduBackground`, `barangay`, `district`, `province`, `completeAddress`, `score`, `totalquestion`, `recommend`, `batch`, `isStudent`) VALUES
(1, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Gamiz', 'Ana', 'D', 'N/A', '1963-04-12', '61', 'Female', 'Married', 2147483647, 'gamiz@yahoo.com', 'College', 'Arellano', 1988, 'Graduate', 'DelaPaz', 'District1', 'Pasig City', 'zxdfghjgfds', 0, 24, 'Good', 2024, 'Student'),
(2, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Duterte', 'Kitty', 'M', 'N/A', '2002-08-14', '22', 'Female', 'Single', 2147483647, 'duterte@yahoo.com', 'College', 'UST', 2015, 'Graduate', 'DelaPaz', 'District2', 'Pasig City', 'kuytrret', 54, 24, 'Excel Formulas, Data Analysis', 2024, 'Student'),
(3, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Cruz', 'Donna', 'A', 'Ma', '1989-08-13', '35', 'Female', 'Married', 2147483647, 'cruz@yahoo.com', 'Elementary', 'Pasig Elementary School', 1998, 'Undergraduate', 'Kalawaan', 'District2', 'Pasig City', 'asdfasf', 67, 24, 'Understanding Windows, Windows History', 2024, 'Student'),
(4, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Dimaculangan', 'James', 'D', 'N/A', '1964-08-14', '60', 'Male', 'Married', 2147483647, 'dimaculangan@yahoo.com', 'College', 'PUP', 1984, 'Graduate', 'Kalawaan', 'District2', 'Pasig City', 'fadsfadfs', 0, 24, 'Good', 2024, 'Student'),
(5, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Prayol', 'Dan', 'L', 'N/A', '1973-08-21', '51', 'Male', 'Married', 2147483647, 'prayol@yahoo.com', 'College', 'U.E', 1983, 'Graduate', 'DelaPaz', 'District2', 'Pasig City', 'dsafasd', 75, 24, 'Macros, Windows History', 2024, 'Student'),
(6, 'Dela Paz', 'CRS01', '8:00 - 10:00 am', '2nd', 'Daya', 'Maricel', 'L', 'N/A', '1962-10-09', '62', 'Female', 'Married', 2147483647, 'daya@yahoo.com', 'Highschool', 'Pinagbuhatan', 1987, 'Graduate', 'Kalawaan', 'District1', 'Pasig City', 'asdfasfdsadsfdsfdsf', 0, 24, 'Good', 2024, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(5) NOT NULL,
  `question` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `question`) VALUES
(1, 'I CAN OPEN A COMPUTER DESKTOP'),
(2, 'I KNOW HOW TO USE THE KEYBOARD'),
(3, 'I KNOW HOW TO USE THE MOUSE'),
(4, 'I CAN CONNECT THE MONITOR'),
(5, 'DO YOU KNOW HOW TO SAVE A FILE?'),
(6, 'DO YOU HAVE AN EMAIL ACCOUNT'),
(7, 'CAN YOU TURN OFF AND ON THE COMPUTER?'),
(8, 'ARE YOU FAMILIAR WITH THE WINDOWS ENVIRONMENT?'),
(9, 'CAN YOU HIGHLIGHT USING YOUR MOUSE OR SELECT WORDS AND SENTENCES?'),
(10, 'DO YOU KNOW USING MS WORD?'),
(11, 'DO YOU KNOW USING MS EXCEL?'),
(12, 'DO YOU KNOW USING MS POWERPOINT?'),
(13, 'I HAVE A BASIC KNOWLEDGE OF COMPUTERS'),
(14, 'I HAVE A WORKING KNOWLEDGE OF COMPUTER TERMINOLOGY'),
(15, 'I FEEL CONFIDENT ABOUT USING COMPUTERS'),
(16, 'I KNOW HOW TO USE INTERNET LIKE GOOGLE, YAHOO ETC.'),
(17, 'TURN OFF THE MONITOR AND PRINTER'),
(18, 'CAN COPY FILES'),
(19, 'INSTALL NEW SOFTWARE ON A COMPUTER'),
(20, 'SET UP A COMPUTER NETWORK'),
(21, 'ARE YOU FAMILIAR IN ADOBE PHOTOSHOP?'),
(22, 'DO YOU KNOW HOW TO MAKE A WEBSITE?'),
(23, 'DO YOU KNOW HOW TO CREATE A BROCHURE IN PHOTOSHOP'),
(24, 'CAN CREATE PRESENTATION SKILLS USING MS POWERPOINT?');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `courseId` varchar(6) NOT NULL,
  `courseTitle` varchar(100) NOT NULL,
  `time` varchar(20) NOT NULL,
  `day` varchar(15) NOT NULL,
  `sem` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedId`, `userid`, `courseId`, `courseTitle`, `time`, `day`, `sem`, `status`) VALUES
(1, 6, 'CRS01', 'Basic, Intermediate & Advance Computer Concepts', '8:00 - 10:00 am', 'monday - friday', '3rd', 'Open'),
(2, 6, 'CRS01', 'Basic, Intermediate & Advance Computer Concepts', '1:00 - 3:00 pm', 'monday - friday', '3rd', 'Open'),
(3, 6, 'CRS02', 'Photo and Graphic Enhancement Program', '3:00 - 5:00 pm', 'monday - friday', '3rd', 'Open'),
(4, 6, 'CRS03', 'Internet Essetials & Basic, Webpage Design', '10:00 - 12:00 noon', 'M-W-F', '2nd', 'Close'),
(5, 6, 'CRS03', 'Internet Essetials & Basic, Webpage Design', '8:00 - 10:00 am', 'monday - friday', '1st', 'Close'),
(6, 6, 'CRS01', 'Basic, Intermediate & Advance Computer Concepts', '8:00 - 10:00 am', 'monday - friday', '2nd', 'Close'),
(7, 6, 'CRS02', 'Photo and Graphic Enhancement Program', '8:00 - 10:00 am', 'monday - friday', '1st', 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(5) NOT NULL,
  `branch` varchar(25) NOT NULL,
  `sem` varchar(5) NOT NULL,
  `courseId` varchar(6) NOT NULL,
  `time` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `age` varchar(3) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` int(13) NOT NULL,
  `educational` varchar(25) NOT NULL,
  `barangay` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `completeAddress` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `recommend` varchar(100) NOT NULL,
  `batch` int(5) NOT NULL,
  `isStudent` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `branch`, `sem`, `courseId`, `time`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `sex`, `status`, `email`, `contact`, `educational`, `barangay`, `district`, `province`, `completeAddress`, `score`, `recommend`, `batch`, `isStudent`) VALUES
(1, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'Ana', 'D', 'Gamiz', 'N/A', '1963-04-12', '61', 'Female', 'Married', 'gamiz@yahoo.com', 2147483647, 'College', 'DelaPaz', 'District1', 'Pasig City', 'zxdfghjgfds', 0, 'Good', 2024, 'Drop-Out'),
(2, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'James', 'D', 'Dimaculangan', 'N/A', '1964-08-14', '60', 'Male', 'Married', 'dimaculangan@yahoo.com', 2147483647, 'College', 'Kalawaan', 'District2', 'Pasig City', 'fadsfadfs', 0, 'Good', 2024, 'Graduate'),
(3, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'Kitty', 'M', 'Duterte', 'N/A', '2002-08-14', '22', 'Female', 'Single', 'duterte@yahoo.com', 2147483647, 'College', 'DelaPaz', 'District2', 'Pasig City', 'kuytrret', 54, 'Excel Formulas, Data Analysis', 2024, 'Student'),
(4, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'Donna', 'A', 'Cruz', 'Ma', '1989-08-13', '35', 'Female', 'Married', 'cruz@yahoo.com', 2147483647, 'Elementary', 'Kalawaan', 'District2', 'Pasig City', 'asdfasf', 67, 'Understanding Windows, Windows History', 2024, 'Student'),
(5, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'Dan', 'L', 'Prayol', 'N/A', '1973-08-21', '51', 'Male', 'Married', 'prayol@yahoo.com', 2147483647, 'College', 'DelaPaz', 'District2', 'Pasig City', 'dsafasd', 75, 'Macros, Windows History', 2024, 'Student'),
(6, 'Dela Paz', '2nd', 'CRS01', '8:00 - 10:00 am', 'Maricel', 'L', 'Daya', 'N/A', '1962-10-09', '62', 'Female', 'Married', 'daya@yahoo.com', 2147483647, 'Highschool', 'Kalawaan', 'District1', 'Pasig City', 'asdfasfdsadsfdsfdsf', 0, 'Good', 2024, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(75) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `userType`, `barangay`, `fname`, `mname`, `lname`, `email`, `image`, `username`, `password`) VALUES
(1, 'Instructor', 'Malinao', 'Sample', 'Sample', 'Sample', 'Sample1@gmail.com', '66aa44b7c6bff.jpg', 'Sample1', '393a1f9c2571c39966ad4d9c3df06040'),
(2, 'Administrator', 'Dela Paz', 'Sample2', 'Sample2', 'Sample2', 'Sample2@gmail.com', '66977cb43bd14.png', 'sample2', 'Sample2'),
(6, 'Instructor', 'Dela Paz', 'Aiah', 'G', 'Cabungcal', 'cabungcal_aiah@gmail.com', '66ac411181ba2.png', 'cabungcal', 'c1fb398d3b18e29aa5283fa3a90f545a'),
(7, 'Instructor', 'Sto. Tomas', 'John Christopher', 'N', 'Orlanes', 'orlanes@gmail.com', '66ac3296a1dc3.jpg', 'orlanes', '06afe521980d565671b53eb41d6228db'),
(8, 'Instructor', 'malinao', 'Rv', 'P', 'Oniadia', 'oniada_rayvincent@plpasig.edu.ph', '66ac4c39836ff.png', 'oniadia', '24255f03591452833c0b995751b95c8a'),
(9, 'Administrator', 'malinao', 'Rv', 'P', 'Oniadia', 'oniada_rayvincent@plpasig.edu.ph', '66ac4c81092cd.jpg', 'admin', '24255f03591452833c0b995751b95c8a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `assess_score`
--
ALTER TABLE `assess_score`
  ADD PRIMARY KEY (`assessId`),
  ADD KEY `enrolleeId` (`enrolleeId`);

--
-- Indexes for table `enrollee`
--
ALTER TABLE `enrollee`
  ADD PRIMARY KEY (`enrolleeId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedId`),
  ADD KEY `schedule_ibfk_1` (`userid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assess_score`
--
ALTER TABLE `assess_score`
  MODIFY `assessId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollee`
--
ALTER TABLE `enrollee`
  MODIFY `enrolleeId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
