-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 10:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(3, 'Improvement ', '2023-04-14 08:41:34', 1),
(4, 'Facility ', '2023-04-14 08:42:02', 1);

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
(4, 'i think that would be a bit of an unnecessary expense.', 4, 6, '2023-04-14 08:48:47'),
(6, 'Yes, we should get an upgrade.', 5, 6, '2023-04-14 08:49:44'),
(7, 'Yea, my chair is worn out already :( ', 6, 7, '2023-04-14 08:51:36');

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
(4, 'Upgrade.png', 'Document/', 5);

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
(4, 'We can have more Free food!', 'Maybe if we get free for in the canteen, then our productivity would improve', 1, 3, 4, '2023-04-14', '2023-04-21', '2023-04-22', 1, 4),
(5, 'Maybe Better equipment? ', 'I think its time for us to get an upgrade in our devices. ', 1, 4, 5, '2023-04-14', '2023-04-21', '2023-04-23', 0, 5),
(6, 'Get better chairs ', 'the Current chair are abit uncomfortable to be honest.', 1, 3, 8, '2023-04-14', '2023-04-21', '2023-04-22', 0, 4);

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
(295, 4, 4, 'like', '2023-04-14 08:45:57'),
(296, 6, 4, 'dislike', '2023-04-14 08:48:22'),
(297, 6, 5, 'like', '2023-04-14 08:49:26'),
(298, 7, 6, 'like', '2023-04-14 08:51:19'),
(299, 7, 4, 'dislike', '2023-04-14 08:52:01'),
(300, 7, 5, 'like', '2023-04-14 08:52:05');

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
(4, 'What can be done as an improvement ', 3, 1, '2023-04-14', '2023-04-21', '2023-04-22', '2023-04-14 08:42:32'),
(5, 'How can we make the facility better?', 4, 1, '2023-04-14', '2023-04-21', '2023-04-23', '2023-04-14 08:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userID` int(10) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userContact` varchar(50) NOT NULL,
  `role` enum('Staff','Quality Assurance Coordinator','Quality Assurance Manager','Admin') NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` enum('Student Affair','Bursary','Information Technology','Business','Tourism and Hospitality Management') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userID`, `userName`, `userEmail`, `userContact`, `role`, `password`, `department`) VALUES
(1, 'Aron Chan', 'aronchan0924@gmail.com', '014-7895412', 'Quality Assurance Manager', '25d55ad283aa400af464c76d713c07ad', 'Information Technology'),
(2, 'Zhi Hong', 'tan23@gmail.com', '017-1678641', 'Quality Assurance Coordinator', '25d55ad283aa400af464c76d713c07ad', 'Information Technology'),
(3, 'adminGuy', 'admin@gmail.com', '012-1234567', 'Admin', '25d55ad283aa400af464c76d713c07ad', 'Student Affair'),
(4, 'Ryan', 'ryan11@gmail.com', '017-1423139', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Bursary'),
(5, 'William', 'will.lim12@gmail.com', '017-1421411', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Information Technology'),
(6, 'Prakash', 'prakash2@gmail.com', '014-1432422', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Student Affair'),
(7, 'Adam', 'adam1@gmail.com', '014-1452145', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Business'),
(8, 'Damo', 'damodar.lim25@gmail.com', '014-1452145', 'Staff', '25d55ad283aa400af464c76d713c07ad', 'Tourism and Hospitality Management');

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
  MODIFY `cateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `document_table`
--
ALTER TABLE `document_table`
  MODIFY `docID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `idea_table`
--
ALTER TABLE `idea_table`
  MODIFY `ideaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `like_table`
--
ALTER TABLE `like_table`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `topic_table`
--
ALTER TABLE `topic_table`
  MODIFY `topicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
