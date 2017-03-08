-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2017 at 05:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbtonline_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(20) NOT NULL,
  `board_title` varchar(70) NOT NULL,
  `board_description` longtext NOT NULL,
  `board_courses` text NOT NULL,
  `board_img` varchar(400) NOT NULL,
  `publish` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `board_title`, `board_description`, `board_courses`, `board_img`, `publish`) VALUES
(115, 'Jamb', 'fyjytkjyfrjufyr', 'physics', '', 'N'),
(116, 'NECO', 'kuyfrdzfaaqewgfrtimpt', 'physics', '', 'Y'),
(117, 'WAEC', 'sqwwww', 'chemisry', '', 'Y'),
(118, 'Icanw', 'www', 'physics', '', 'N'),
(119, 'new', 'new ', 'chemisry', '', 'Y'),
(120, 'new1', 'new1', 'chemisry', '', 'N'),
(121, 'new2', 'dfgd', 'physics', '', 'N'),
(122, 'new3', 'egehuykum8', 'physics', '', 'Y'),
(123, 'new6', 'jlkj', 'chemisry', '', 'Y'),
(124, 'new5', 'ljkjkl', 'chemisry', '', 'Y'),
(125, 'new7;', 'kjl;kklkjlk', 'chemisry', '', 'Y'),
(126, 'jhgjhgj', 'ddd', 'physics', '', 'Y'),
(127, 'der', 'eget', 'physics', '', 'Y'),
(128, 'khkjhk', 'kjlj;', 'physics', '', 'Y'),
(129, 'jjhgjhg', 'gjgjg', 'physics', '', 'Y'),
(130, 'kjhn,khg', 'mnb,b', 'chemisry', '', 'Y'),
(131, 'l;kjjjj', 'lkjjlkjlk', 'chemisry', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(20) NOT NULL,
  `course_title` varchar(70) NOT NULL,
  `course_description` text NOT NULL,
  `course_sets` text NOT NULL,
  `publish` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `course_description`, `course_sets`, `publish`) VALUES
(14, 'chemisry', '', '2000', 'N'),
(15, 'physics', '', '1999', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

CREATE TABLE `sets` (
  `id` int(50) NOT NULL,
  `questionset_title` varchar(200) NOT NULL,
  `questionset_description` text NOT NULL,
  `publish` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`id`, `questionset_title`, `questionset_description`, `publish`) VALUES
(40, '2000', '', 'N'),
(41, '1999', '', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `set_1999`
--

CREATE TABLE `set_1999` (
  `id` int(11) NOT NULL,
  `question_content` varchar(10000) NOT NULL,
  `option1` varchar(2000) NOT NULL,
  `option2` varchar(2000) NOT NULL,
  `option3` varchar(2000) NOT NULL,
  `option4` varchar(2000) NOT NULL,
  `option5` varchar(2000) NOT NULL,
  `course` varchar(100) NOT NULL,
  `board` varchar(100) NOT NULL,
  `answer` int(2) NOT NULL,
  `question_img` varchar(100) DEFAULT NULL,
  `publish` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_1999`
--

INSERT INTO `set_1999` (`id`, `question_content`, `option1`, `option2`, `option3`, `option4`, `option5`, `course`, `board`, `answer`, `question_img`, `publish`) VALUES
(1, ';giug', 'igkg', 'gjkhgjkhg', 'gjhg', 'jhgjgkj', '', 'physics', 'NECO', 4, 'none', 'N'),
(2, 'klghhlkjhi', 'h kjhjh', 'gjhgjg', 'hgjkhgkjhg', 'jkhgjhgh', '', 'physics', 'Jamb', 3, 'none', 'N'),
(3, 'hkgfhf', 'hdhgjdf', 'l;k;', 'kjlkjlk', 'lkkjlkjlk', '', 'physics', 'Jamb', 4, 'none', 'Y'),
(4, ',jh,mmmmmmmmm', 'hnm,h.j', 'hk,mk.jjh,', 'mhmj,nh,', 'nh,mhkmh', '', 'physics', 'Jamb', 1, 'none', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `set_2000`
--

CREATE TABLE `set_2000` (
  `id` int(11) NOT NULL,
  `question_content` varchar(10000) NOT NULL,
  `option1` varchar(2000) NOT NULL,
  `option2` varchar(2000) NOT NULL,
  `option3` varchar(2000) NOT NULL,
  `option4` varchar(2000) NOT NULL,
  `option5` varchar(2000) NOT NULL,
  `course` varchar(100) NOT NULL,
  `board` varchar(100) NOT NULL,
  `answer` int(2) NOT NULL,
  `question_img` varchar(100) DEFAULT NULL,
  `publish` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_2000`
--

INSERT INTO `set_2000` (`id`, `question_content`, `option1`, `option2`, `option3`, `option4`, `option5`, `course`, `board`, `answer`, `question_img`, `publish`) VALUES
(1, 'hfhgjfghffh', 'jfjhgfghjf', 'hjghjfghjfh', 'fgfj', 'fhgjf', '', 'chemisry', 'WAEC', 3, 'none', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sets`
--
ALTER TABLE `sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_1999`
--
ALTER TABLE `set_1999`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_2000`
--
ALTER TABLE `set_2000`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sets`
--
ALTER TABLE `sets`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `set_1999`
--
ALTER TABLE `set_1999`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `set_2000`
--
ALTER TABLE `set_2000`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
