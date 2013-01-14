-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2013 at 04:27 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kb_kibow`
--

-- --------------------------------------------------------

--
-- Table structure for table `kb_post`
--

CREATE TABLE IF NOT EXISTS `kb_post` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_caption` text COLLATE utf8_unicode_ci,
  `post_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'User_id of Creator',
  `post_status` tinyint(1) DEFAULT NULL,
  `language_id` int(11) DEFAULT '1',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kb_post`
--

INSERT INTO `kb_post` (`post_id`, `post_picture`, `post_caption`, `post_time`, `user_id`, `post_status`, `language_id`) VALUES
(3, 'upload/file-1358132004.jpg', 'asdfasdf', '1358132004', 1, 1, 1),
(4, 'upload/file-1358132014.jpg', 'asdfasdf', '1358132014', 1, 1, 1),
(5, 'upload/file-1358135514.JPG', 'awdawdawd', '1358135514', 1, 1, 1),
(6, 'upload/file-1358137152.jpg', 'adfadfdsf', '1358137152', 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
