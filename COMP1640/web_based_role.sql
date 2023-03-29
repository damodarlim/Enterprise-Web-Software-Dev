-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 06:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_based_role`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `cateID` int(11) NOT NULL,
  `cateName` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`cateID`, `cateName`, `dateCreated`, `userID`) VALUES
(1, 'Testing', '2023-02-23 14:48:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `commentID` int(11) NOT NULL,
  `commentContent` varchar(255) NOT NULL,
  `ideaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`commentID`, `commentContent`, `ideaID`, `userID`, `dateTime`) VALUES
(1, 'Aaverell so cute', 3, 2, '2023-03-05 15:19:23'),
(2, 'Testing 123', 3, 2, '2023-03-05 15:21:49'),
(3, 's', 3, 2, '2023-03-05 15:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `document_table`
--

CREATE TABLE `document_table` (
  `docID` int(11) NOT NULL,
  `docName` varchar(255) NOT NULL,
  `docPath` varchar(255) NOT NULL,
  `ideaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_table`
--

INSERT INTO `document_table` (`docID`, `docName`, `docPath`, `ideaID`) VALUES
(1, 'New Text Document.txt', 'Document/', 1),
(2, 'New Text Document.txt', 'Document/', 2),
(3, '1677552210336.jpg', 'Document/', 3);

-- --------------------------------------------------------

--
-- Table structure for table `idea_table`
--

CREATE TABLE `idea_table` (
  `ideaID` int(11) NOT NULL,
  `ideaTitle` varchar(255) NOT NULL,
  `ideaDesc` varchar(255) NOT NULL,
  `agreeTnc` tinyint(1) NOT NULL,
  `cateID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `finalClosureDate` date NOT NULL,
  `anoymous` tinyint(1) NOT NULL,
  `topicID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idea_table`
--

INSERT INTO `idea_table` (`ideaID`, `ideaTitle`, `ideaDesc`, `agreeTnc`, `cateID`, `userID`, `startDate`, `endDate`, `finalClosureDate`, `anoymous`, `topicID`) VALUES
(1, 'COMP1640 Testing', 'COMP1640', 1, 1, 2, '2023-02-23', '2023-02-24', '2023-02-25', 1, 1),
(2, 'dsadsad', 'dasdasdad', 1, 1, 2, '2023-02-24', '2023-02-27', '2023-02-28', 1, 2),
(3, 'Atest', 'test', 1, 1, 2, '2023-03-05', '2023-03-07', '2023-03-09', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

CREATE TABLE `like_table` (
  `likeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ideaID` int(11) NOT NULL,
  `likeDislike` varchar(30) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`likeID`, `userID`, `ideaID`, `likeDislike`, `dateTime`) VALUES
(174, 1, 1, 'dislike', '2023-03-05 09:01:32'),
(245, 2, 1, 'like', '2023-03-05 09:43:38'),
(268, 2, 2, 'like', '2023-03-05 10:16:41'),
(294, 2, 3, 'dislike', '2023-03-05 16:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `topic_table`
--

CREATE TABLE `topic_table` (
  `topicID` int(11) NOT NULL,
  `topicName` varchar(255) NOT NULL,
  `cateID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `finalClosureDate` date NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic_table`
--

INSERT INTO `topic_table` (`topicID`, `topicName`, `cateID`, `userID`, `startDate`, `endDate`, `finalClosureDate`, `dateTime`) VALUES
(1, 'Testing 123', 1, 1, '2023-02-23', '2023-02-24', '2023-02-25', '2023-02-23 14:48:44'),
(2, 'A12345', 1, 1, '2023-02-24', '2023-02-27', '2023-02-28', '2023-02-24 09:15:51'),
(3, 'A123', 1, 1, '2023-03-05', '2023-03-07', '2023-03-09', '2023-03-05 09:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userID` int(10) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userContact` varchar(50) NOT NULL,
  `role` enum('Staff','Quality Assurance Coordinator','Quality Assurance Manager') NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` enum('Student Affair','Bursary','Information Technology','Business','Tourism and Hospitality Management') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userID`, `userName`, `userEmail`, `userContact`, `role`, `password`, `department`) VALUES
(1, 'Testing', 'aronchan0924@gmail.com', '014-7895412', 'Quality Assurance Manager', '25d55ad283aa400af464c76d713c07ad', 'Information Technology'),
(2, 'Staff Testing', 'staff@gmail.com', '014-1452145', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Business');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`cateID`);

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `document_table`
--
ALTER TABLE `document_table`
  ADD PRIMARY KEY (`docID`);

--
-- Indexes for table `idea_table`
--
ALTER TABLE `idea_table`
  ADD PRIMARY KEY (`ideaID`);

--
-- Indexes for table `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `topic_table`
--
ALTER TABLE `topic_table`
  ADD PRIMARY KEY (`topicID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `cateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document_table`
--
ALTER TABLE `document_table`
  MODIFY `docID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `idea_table`
--
ALTER TABLE `idea_table`
  MODIFY `ideaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `like_table`
--
ALTER TABLE `like_table`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `topic_table`
--
ALTER TABLE `topic_table`
  MODIFY `topicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
