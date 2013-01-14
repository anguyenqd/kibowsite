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
-- Table structure for table `kb_language`
--

CREATE TABLE IF NOT EXISTS `kb_language` (
  `language_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_office`
--

CREATE TABLE IF NOT EXISTS `kb_office` (
  `office_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_order` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT '1',
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `kb_reference_code`
--

CREATE TABLE IF NOT EXISTS `kb_reference_code` (
  `reference_code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL COMMENT 'user_id of Creator',
  `language_id` int(11) DEFAULT '1',
  PRIMARY KEY (`reference_code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kb_reference_code`
--

INSERT INTO `kb_reference_code` (`reference_code_id`, `reference_code`, `email`, `date_create`, `creator_id`, `language_id`) VALUES
(1, 'asdfsfWdoifsdkfsdsk##', NULL, NULL, 133, 233),
(2, 'asdfsfWdoifsdkfsdsk', NULL, NULL, 1, 2),
(3, 'asdfsfWdoifsdkfsdsk', NULL, NULL, 1, 2),
(4, 'ac15bc175d304ca0435f0031066f6afd', NULL, '1357724743', 1, 1),
(5, '1d27fdd6860c832f53eab2d2f3a6dd1e', NULL, '1357725940', 1, 1),
(6, '644a7d051da238b56574f494afb7ccc3', 'namvuonghcm@gmail.com', '1357807492', 1, 1),
(7, 'fca1508efeb0bdbe882324213f322a88', 'vuongngocnam@gmail.com', '1357812518', 1, 1),
(8, 'ca1f9e493813004c3ed666857f3cbed4', 'idvvn90@gmail.com', '1357871570', 1, 1),
(14, 'b51a3a85604cf3e54a2f34c914789056', 'abc@gmail.com', '1357905876', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kb_user`
--

CREATE TABLE IF NOT EXISTS `kb_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'unique username that will be used in url to easy to indentify someone',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_code_id` int(11) DEFAULT NULL COMMENT 'Reference code that create randomly when one user send invitaion. This code stored in reference_code table',
  `date_create` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_update` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_group_id` int(11) DEFAULT '1',
  `office_id` int(11) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privacy_status` tinyint(1) DEFAULT NULL COMMENT '[1=>Only owner] [2=>Contact list] [3=>Public]',
  `language_id` int(11) DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kb_user`
--

INSERT INTO `kb_user` (`user_id`, `username`, `password`, `email`, `reference_code_id`, `date_create`, `date_update`, `user_group_id`, `office_id`, `avatar`, `address`, `phone`, `display_name`, `biography`, `twitter`, `facebook`, `privacy_status`, `language_id`) VALUES
(1, NULL, '698d51a19d8a121ce581499d7b701668', 'namvuonghcm@gmail.com', 6, '1357810336', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, NULL, '698d51a19d8a121ce581499d7b701668', 'namvuonghcm@gmail.com', 6, '1357810867', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, NULL, '698d51a19d8a121ce581499d7b701668', 'vuongngocnam@gmail.com', 7, '1357812600', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, NULL, '698d51a19d8a121ce581499d7b701668', 'idvvn90@gmail.com', 8, '1357872252', NULL, 2, NULL, NULL, NULL, NULL, 'Clark', NULL, NULL, NULL, NULL, 1),
(5, NULL, '698d51a19d8a121ce581499d7b701668', 'abc@gmail.com', 14, '1357906015', NULL, 1, NULL, NULL, NULL, NULL, 'Ted', NULL, NULL, NULL, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
