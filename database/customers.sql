-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 01:35 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customers`
--
CREATE DATABASE IF NOT EXISTS `customers` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `customers`;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `todo_body` text NOT NULL,
  `todo_date` date NOT NULL,
  `date_added` date NOT NULL,
  `is_done` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `username`, `todo_body`, `todo_date`, `date_added`, `is_done`) VALUES
(6, 'andras_margittai', 'Buy food', '2021-01-26', '2021-01-18', 'no'),
(7, 'andras_margittai', 'Cook dinner', '2021-01-19', '2021-01-18', 'yes'),
(15, 'andras_margittai', 'Learning php', '2021-01-21', '2021-01-19', 'yes'),
(17, 'andras_margittai', 'New todo', '2021-01-25', '2021-01-20', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_pictures`
--

CREATE TABLE `uploaded_pictures` (
  `id` int(11) NOT NULL,
  `label` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `picture_path` varchar(120) NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploaded_pictures`
--

INSERT INTO `uploaded_pictures` (`id`, `label`, `username`, `picture_path`, `upload_date`) VALUES
(1, 'my cat', 'andras_margittai', 'uploads/images/cat.jpg', '2021-01-21'),
(2, 'dav', 'andras_margittai', 'uploads/images/cat2.jpeg', '2021-01-21'),
(3, 'third cat', 'andras_margittai', 'uploads/images/cat3.jpg', '2021-01-21'),
(4, 'Cat 4', 'andras_margittai', 'uploads/images/cat4.jpg', '2021-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(120) NOT NULL,
  `date_added` date NOT NULL,
  `username` varchar(120) NOT NULL,
  `address` varchar(150) NOT NULL,
  `country` varchar(60) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `city` varchar(60) NOT NULL,
  `role` varchar(8) NOT NULL,
  `activation_code` varchar(32) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `is_blocked` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_pic`, `date_added`, `username`, `address`, `country`, `zip`, `city`, `role`, `activation_code`, `is_active`, `is_blocked`) VALUES
(12, 'Andras', 'Margittai', 'thunder6230@gmail.com', 'b16938e4e5044ee7bebcfec5113ef7c2', 'uploads/images/cat4.jpg', '2021-01-14', 'andras_margittai', '', '', '', '', 'admin', '2d6cc4b2d139a53512fb8cbb3086ae2e', 'yes', 'no'),
(13, 'Cherry', 'Margittai', 'cherryhillcanupin@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'assets/images/profile_pics/defaults/head_belize_hole.png', '2021-01-14', 'cherry_margittai', '', '', '', '', 'operator', '97e8527feaf77a97fc38f34216141515', 'no', 'no'),
(15, 'Andras', 'Margittai', 'andrasmargittai@gmail.com', 'b16938e4e5044ee7bebcfec5113ef7c2', 'assets/images/profile_pics/defaults/head_belize_hole.png', '2021-01-17', 'andras_margittai_1', '', '', '', '', 'generic', '25ddc0f8c9d3e22e03d3076f98d83cb2', 'no', 'yes'),
(16, 'Ken', 'Block', 'block@me.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'assets/images/profile_pics/defaults/head_belize_hole.png', '2021-01-18', 'ken_block', '', '', '', '', 'generic', '0f96613235062963ccde717b18f97592', 'no', 'yes'),
(17, 'Test', 'Test', 'test1@gmail.com', 'a152e841783914146e4bcd4f39100686', 'assets/images/profile_pics/defaults/head_belize_hole.png', '2021-01-20', 'test_test', '', '', '', '', 'generic', '6c3cf77d52820cd0fe646d38bc2145ca', 'no', 'no'),
(18, 'Admin', 'Root', 'admin@root.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'assets/images/profile_pics/defaults/head_pomegranate.png', '2021-01-22', 'admin_root', '', '', '', '', 'admin', 'd07e70efcfab08731a97e7b91be644de', 'no', 'no'),
(19, 'Opera', 'Tor', 'operator@root.com', '4b583376b2767b923c3e1da60d10de59', 'assets/images/profile_pics/defaults/head_emerald.png', '2021-01-22', 'opera_tor', '', '', '', '', 'operator', 'd707329bece455a462b58ce00d1194c9', 'no', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_pictures`
--
ALTER TABLE `uploaded_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `uploaded_pictures`
--
ALTER TABLE `uploaded_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
