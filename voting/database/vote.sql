-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 09:20 AM
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
-- Database: `vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidate_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `party` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `position`, `firstname`, `lastname`, `year_level`, `gender`, `img`, `party`) VALUES
(23, 'Student Representative', 'Bhuvan', 'H M', '4th Year', 'Male', 'upload/demo.jpg', 'Democratic Party'),
(24, 'Student Representative', 'Sushma', 'K N', '4th Year', 'Female', 'upload/liberal.jpg', 'Liberal Party'),
(25, 'Student Representative', 'Subhas Basappa', 'Khanatti', '4th Year', 'Male', 'upload/cons.jpg', 'Conservative Party'),
(26, 'Cultural Representative', 'Bhuvan', 'H M', '4th Year', 'Male', 'upload/demo.jpg', 'Democratic Party'),
(27, 'Cultural Representative', 'Sushma', 'K N', '4th Year', 'Female', 'upload/liberal.jpg', 'Liberal Party'),
(28, 'Sports Representative', 'Bhuvan', 'H M', '4th Year', 'Male', 'upload/demo.jpg', 'Democratic Party'),
(29, 'Sports Representative', 'Subhas Basappa', 'Khanatti', '4th Year', 'Male', 'upload/cons.jpg', 'Conservative Party');

-- --------------------------------------------------------

--
-- Table structure for table `ids`
--

CREATE TABLE `ids` (
  `id_number` varchar(100) NOT NULL,
  `names` varchar(225) NOT NULL,
  `started` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ids`
--

INSERT INTO `ids` (`id_number`, `names`, `started`) VALUES
('4HG21CS001', 'Abdul Affan', '2024-12-10'),
('4HG21CS006', 'Bhuvan H M', '2024-12-12'),
('4HG21CS019', 'Kallesh G K', '2021-12-15'),
('4HG21CS022', 'Kumar Swamy  T G', '2021-12-18'),
('4HG21CS024', 'Madan H J', '2021-12-29'),
('4HG21CS033', 'Pruthvi Raj M Y', '2021-12-22'),
('4HG21CS046', 'Sinchana K', '2021-12-15'),
('4HG21CS047', 'Subhas Basappa Khanatti', '2021-12-23'),
('4HG21CS051', 'Sushma K N', '2021-12-21'),
('4HG21CS60', 'Umme Hani', '2021-12-22'),
('4HG22CS400', 'Bharathi N D', '2022-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `Phone` int(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `lastname`, `Phone`, `email`) VALUES
(1, 'admin', 'admin', 'Mr.', 'Admin', 977112458, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `voters_id` int(11) NOT NULL,
  `id_number` varchar(12) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(1000) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `chng_col_name` varchar(500) NOT NULL,
  `prog_study` varchar(10) NOT NULL,
  `pre_prog_study` varchar(50) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `sec_question` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `account` varchar(100) NOT NULL DEFAULT 'Inactive',
  `date` date DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`voters_id`, `id_number`, `firstname`, `lastname`, `gender`, `dob`, `address`, `col_name`, `chng_col_name`, `prog_study`, `pre_prog_study`, `year_level`, `sec_question`, `status`, `account`, `date`, `password`, `phone_number`) VALUES
(80, '4HG21CS006', 'Bhuvan', 'H M', 'Male', '2003-10-31', 'Hassan', 'GECM', 'GECH', 'CSE', 'ME', '4th Year', '03c017f682085142f3b60f56673e22dc', 'Voted', 'Active', '2024-12-17', '202cb962ac59075b964b07152d234b70', '9535582588'),
(79, '4HG21CS003', 'Altafulla', 'Hurkadli', 'Male', '2024-11-17', 'Haveri', 'GECM', 'NO', 'CSE', 'NO', '4th Year', 'c3450340e0b3dd7ac2d862582bcd22b9', 'Voted', 'Active', '2024-12-17', '250cf8b51c773f3f8dc8b4be867a9a02', '9631214345'),
(78, '4HG21CS001', 'Abdul', 'Affan', 'Male', '2024-10-29', 'Hassan', 'GECM', 'NO', 'CSE', 'NO', '4th Year', '5a0ada6ecb516498c85623ed0da2b631', 'Voted', 'Active', '2024-12-17', '202cb962ac59075b964b07152d234b70', '9435454443'),
(77, '4HG21CS008', 'Darshan', 'M V', 'Male', '2024-11-05', 'Hassan', 'GECM', 'NO', 'CSE', 'NO', '4th Year', '48562433ea508fb417158cee45759d12', 'Voted', 'Active', '2024-12-17', '202cb962ac59075b964b07152d234b70', '9352243232');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(255) NOT NULL,
  `candidate_id` varchar(255) NOT NULL,
  `voters_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `candidate_id`, `voters_id`) VALUES
(161, '23', '77'),
(162, '26', '77'),
(163, '29', '77'),
(164, '25', '78'),
(165, '27', '78'),
(166, '29', '78'),
(167, '23', '79'),
(168, '27', '79'),
(169, '29', '79'),
(170, '23', '80'),
(171, '27', '80'),
(172, '29', '80'),
(173, '23', '81'),
(174, '27', '81'),
(175, '29', '81');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `ids`
--
ALTER TABLE `ids`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`voters_id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `voters_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
