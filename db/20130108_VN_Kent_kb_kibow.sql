-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2013 at 07:40 AM
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
  `language_id` int(11) DEFAULT NULL,
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
  `language_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_reference_code`
--

CREATE TABLE IF NOT EXISTS `kb_reference_code` (
  `reference_code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL COMMENT 'user_id of Creator',
  `language_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`reference_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `user_group_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privacy_status` tinyint(1) DEFAULT NULL COMMENT '[1=>Only owner] [2=>Contact list] [3=>Public]',
  `language_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
