-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2016 at 07:56 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biznow_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `street_address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `zip` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `street_address`, `city`, `state`, `zip`, `phone`, `email`) VALUES
(1, 'michaelho-lung', '56 Leonard Street', 'New York', 'NY', '', '703.549.0977', 'michaelho-lung@fortuneintlgroup.com'),
(2, 'daniel.MCGIVNEY', '', 'Leigh', 'NE', '', '610-248-4389', 'daniel.MCGIVNEY@ryan.com\n'),
(3, '', '', '\n', '', '', '', ''),
(4, 'leslie.jones', '', 'Robert Lee', 'TX', '', '252-8915', 'leslie.jones@transform.net'),
(5, 'john_lego', '', 'Miles City', 'MT', '', '2817994800\n', 'john_lego@bigo.co.uk'),
(6, 'anna.obrien', '', 'Gonzales', 'CA', '', '32740-32898', 'anna.obrien@gmail.com'),
(7, 'jonvandixon', '', 'Lutz', 'FL', '', '(750)899-8496', 'jonvandixon@semot.media\n'),
(8, '', '', '\n', '', '', '', ''),
(9, '', '', '\n', '', '', '', ''),
(10, '', '', '\n', '', '', '', ''),
(11, '', '', '\n', '', '', '', ''),
(12, '', '', '\n', '', '', '', ''),
(13, '', '', '\n', '', '', '', ''),
(14, 'michaelho-lung', '56 Leonard Street', 'New York', 'NY', '10013', '703.549.0977', 'michaelho-lung@fortuneintlgroup.com'),
(15, 'daniel.MCGIVNEY', '', 'Leigh', 'NE', '68643', '610-248-4389', 'daniel.MCGIVNEY@ryan.com\n'),
(16, '', '', '\n', '', '', '', ''),
(17, 'leslie.jones', '', 'Robert Lee', 'TX', '76945', '252-8915', 'leslie.jones@transform.net'),
(18, 'john_lego', '', 'Miles City', 'MT', '59301', '2817994800\n', 'john_lego@bigo.co.uk'),
(19, 'anna.obrien', '', 'Gonzales', 'CA', '93926', '32740-32898', 'anna.obrien@gmail.com'),
(20, 'jonvandixon', '', 'Lutz', 'FL', '33558', '(750)899-8496', 'jonvandixon@semot.media\n'),
(21, '', '', '\n', '', '', '', ''),
(22, '', '', '\n', '', '', '', ''),
(23, '', '', '\n', '', '', '', ''),
(24, '', '', '\n', '', '', '', ''),
(25, '', '', '\n', '', '', '', ''),
(26, '', '', '\n', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
