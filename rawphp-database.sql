-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 03:57 PM
-- Server version: 5.7.9-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raw-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'john@doe.com', 'johndoe', NULL, NULL),
(2, 'Dave', 'Partner', 'dave@gmail.com', '$2y$10$w4RlqCfGIGa4wYRHISDSK.6FvpSK4/VYhheo9s614RxJNOSX8Bv0i', '2017-06-29 06:39:52', '2017-06-29 06:39:52'),
(3, 'Dave P', 'John', 'davep@gmail.com', '$2y$10$Ph5X2xWD8TBAhUFbcAVwe.wkEH42RaUB7ievzWa1Q/fc.znLwNfwO', '2017-06-29 12:46:07', '2017-06-29 12:46:07'),
(4, 'Doe', 'John', 'doeJohn@gmail.com', '$2y$10$e5W4qMJNOYYqiWxDArTuWO9yk6Q/sZNN2BfW7HELavGk2BkjQ6lI6', '2017-06-30 14:14:12', '2017-06-30 14:14:12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
