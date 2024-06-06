-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 06, 2024 at 08:34 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `postid` int(11) DEFAULT '0',
  `username` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `content`, `userid`, `timestamp`, `postid`, `username`) VALUES
(1, 'eee', 3, '2024-06-06 12:28:20', 3, 'Mariah3'),
(2, 'love it', 3, '2024-06-06 12:32:08', 7, 'Mariah3'),
(3, 'lol\r\n', 3, '2024-06-06 12:35:24', 7, 'Mariah3'),
(4, 'omg', 3, '2024-06-06 14:07:29', 3, 'Mariah3'),
(5, 'omg', 3, '2024-06-06 14:07:46', 3, 'Mariah3'),
(11, '3', 3, '2024-06-06 14:16:57', 3, 'Mariah3'),
(12, 'fantasticcc\r\n', 3, '2024-06-06 14:42:43', 3, 'Mariah3'),
(13, 'ooo\r\n', 3, '2024-06-06 14:43:24', 4, 'Mariah3'),
(14, 'omg', 3, '2024-06-06 18:30:22', 7, 'Mariah3'),
(15, 'looks amazing', 4, '2024-06-06 18:31:11', 7, 'Candy'),
(16, 'did u made it urself\r\n', 4, '2024-06-06 18:36:37', 3, 'Candy'),
(17, 'love it\r\n', 4, '2024-06-06 18:44:29', 3, 'Candy');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `followid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followid`, `userid`, `timestamp`) VALUES
(1, 3, '2024-06-06 16:55:59'),
(2, 3, '2024-06-06 16:56:01'),
(3, 3, '2024-06-06 16:56:02'),
(4, 3, '2024-06-06 16:56:02'),
(5, 3, '2024-06-06 16:56:02'),
(6, 3, '2024-06-06 16:56:03'),
(7, 3, '2024-06-06 16:56:03'),
(8, 3, '2024-06-06 16:56:03'),
(9, 3, '2024-06-06 14:59:08'),
(10, 3, '2024-06-06 14:59:10'),
(11, 3, '2024-06-06 15:02:25'),
(12, 3, '2024-06-06 15:05:15'),
(13, 3, '2024-06-06 15:05:16'),
(14, 3, '2024-06-06 15:05:17'),
(15, 3, '2024-06-06 15:05:17'),
(16, 3, '2024-06-06 15:05:17'),
(17, 3, '2024-06-06 15:05:21'),
(18, 3, '2024-06-06 16:34:21'),
(19, 3, '2024-06-06 18:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `love`
--

CREATE TABLE `love` (
  `loveId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `username` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `love`
--

INSERT INTO `love` (`loveId`, `userid`, `postid`, `username`) VALUES
(3, 3, 3, NULL),
(4, 3, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationId` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationId`, `message`, `userid`, `createdAt`) VALUES
(1, 'New comment posted on your post.', 4, '2024-06-06 16:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `Userid` int(11) NOT NULL,
  `Typeoffood` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postId`, `title`, `description`, `image`, `Userid`, `Typeoffood`) VALUES
(3, 'Amazing', 'healthy', 'uploads/food.jpeg', 3, 'healthy'),
(4, 'Korean', 'Korean food ', 'uploads/korean.jpeg', 3, 'Worldwide'),
(7, 'breakfastboard', 'my type of breakfast', 'uploads/ood.jpeg', 3, 'healthy'),
(8, 'Valentine dinner', 'made by love', 'uploads/most.jpeg', 3, 'healthy'),
(11, 'Spring roll', 'Tastyyyyyyy', 'uploads/fec98d2ce04894b03cf5d039e52d59cf.jpg', 4, 'healthy');

-- --------------------------------------------------------

--
-- Table structure for table `postrecipe`
--

CREATE TABLE `postrecipe` (
  `recipeId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text NOT NULL,
  `instruction` text NOT NULL,
  `userid` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `saveid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`saveid`, `userid`, `postid`) VALUES
(8, 3, 3),
(9, 3, 8),
(10, 3, 7),
(11, 4, 7),
(12, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `searchid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `searchbytitle` varchar(500) NOT NULL,
  `recipeId` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sharelink`
--

CREATE TABLE `sharelink` (
  `shareid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `sharedby` varchar(566) NOT NULL,
  `linkurl` varchar(566) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `profilepicture_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `email`, `password`, `profilepicture_url`) VALUES
(1, 'mariah', 'Mariahbugeja82@gmail.com', 'MARIAH03', NULL),
(3, 'Mariah3', 'Mariahbugeja2@gmail.com', 'Mariah02', NULL),
(4, 'Candy', 'candybrown.2@gmail.com', 'Candy02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `comment_ibfk_1` (`postid`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`followid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `love`
--
ALTER TABLE `love`
  ADD PRIMARY KEY (`loveId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `love_ibfk_2` (`postid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationId`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `Userid` (`Userid`);

--
-- Indexes for table `postrecipe`
--
ALTER TABLE `postrecipe`
  ADD PRIMARY KEY (`recipeId`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`saveid`),
  ADD KEY `postid` (`postid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD KEY `postid` (`postid`),
  ADD KEY `recipeId` (`recipeId`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `sharelink`
--
ALTER TABLE `sharelink`
  ADD PRIMARY KEY (`shareid`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `followid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `love`
--
ALTER TABLE `love`
  MODIFY `loveId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `postrecipe`
--
ALTER TABLE `postrecipe`
  MODIFY `recipeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `saveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sharelink`
--
ALTER TABLE `sharelink`
  MODIFY `shareid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `love`
--
ALTER TABLE `love`
  ADD CONSTRAINT `love_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `post` (`postId`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `love_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `postrecipe`
--
ALTER TABLE `postrecipe`
  ADD CONSTRAINT `postrecipe_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `save`
--
ALTER TABLE `save`
  ADD CONSTRAINT `save_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `save_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `search`
--
ALTER TABLE `search`
  ADD CONSTRAINT `search_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `search_ibfk_2` FOREIGN KEY (`recipeId`) REFERENCES `postrecipe` (`recipeId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `search_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `sharelink`
--
ALTER TABLE `sharelink`
  ADD CONSTRAINT `sharelink_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
