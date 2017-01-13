-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2015 at 03:28 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smarthome`
--

-- --------------------------------------------------------

--
-- Table structure for table `actuator`
--

CREATE TABLE IF NOT EXISTS `actuator` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `system_id` int(11) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL,
  `value_fields` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `actuator`
--

INSERT INTO `actuator` (`aid`, `type`, `state`, `name`, `com_id`, `system_id`, `date_created`, `value_fields`, `serial`) VALUES
(4, '13', 'on', 'frontswitch', '', 6, '2015-08-14 14:01:28', 'pin3,pin5', '192168222'),
(5, '14', '1', 'porch', '::1', 6, '2015-07-30 13:37:25', '', ''),
(21, '30', '1', 'porch', '::1', 6, '2015-07-30 14:05:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `actuator_type`
--

CREATE TABLE IF NOT EXISTS `actuator_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `actuator_type`
--

INSERT INTO `actuator_type` (`id`, `value`, `type_name`) VALUES
(1, 'SWITCH', 'Switch'),
(3, 'SWITCH', 'Switch'),
(13, 'A', 'HOMEFRONT2'),
(14, 'A', 'SWITCH'),
(30, 'H', 'SWITCH');

-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE IF NOT EXISTS `alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scheduled_on` timestamp NOT NULL,
  `triggered_by` int(11) NOT NULL,
  `trigger_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(3) NOT NULL,
  `date_created` timestamp NOT NULL,
  `actuator_id` int(11) DEFAULT NULL,
  `actuator_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `alert`
--

INSERT INTO `alert` (`id`, `action`, `scheduled_on`, `triggered_by`, `trigger_value`, `enabled`, `date_created`, `actuator_id`, `actuator_state`) VALUES
(1, 'Start sprinkler system', '2015-07-25 17:43:44', 1, '29', 1, '2015-07-25 17:43:44', 3, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE IF NOT EXISTS `device_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `treshold` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theshold_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`id`, `type`, `description`, `treshold`, `theshold_state`) VALUES
(1, 'TEMP', 'Temperature', '', ''),
(2, 'HUM', 'Humidity', '', ''),
(3, 'ACT', 'Actuator', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE IF NOT EXISTS `measurement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_measured` timestamp NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sensor` int(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`id`, `sensor_id`, `value`, `date_measured`, `message`, `sensor`) VALUES
(1, 1, '12.5', '2015-07-20 13:58:41', '', 1),
(2, 2, '25', '2015-07-20 13:58:41', '', 1),
(3, 1, '15', '2015-07-20 13:58:41', '', 1),
(4, 2, '22', '2015-07-20 13:58:41', '', 1),
(5, 1, '13', '2015-07-20 13:58:41', '', 1),
(6, 2, '1', '2015-07-22 13:44:19', '', 0),
(7, 1, '0', '2015-07-22 13:44:19', '', 0),
(8, 1, '1', '2015-07-22 13:53:13', '', 0),
(9, 2, '0', '2015-07-22 13:53:23', '', 0),
(10, 16, '25', '2015-07-28 14:04:32', '', 1),
(11, 16, '19', '2015-07-28 14:04:32', '', 1),
(12, 4, '0', '2015-07-29 14:04:02', '', 0),
(13, 4, '1', '2015-07-29 14:04:30', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE IF NOT EXISTS `sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL,
  `value_fields` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id`, `type`, `unit`, `name`, `com_id`, `system_id`, `date_created`, `value_fields`, `serial`) VALUES
(16, '18', 'C', 'frontswitch', '192.168.2.22', 6, '2015-08-17 07:37:17', 'pin1,pin2', '10271918'),
(55, '57', 'C', 'porch', '::1', 6, '2015-07-30 14:05:00', '', ''),
(56, 'S', '%', 'My Sensor', '192.168.2.22', 6, '0000-00-00 00:00:00', '', ''),
(58, 'S', '%', 'My Sensor 212', '192.168.2.221', 6, '2015-08-31 16:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_type`
--

CREATE TABLE IF NOT EXISTS `sensor_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Dumping data for table `sensor_type`
--

INSERT INTO `sensor_type` (`id`, `value`, `type_name`) VALUES
(1, 'TEMP', 'Temperature'),
(2, 'HUM', 'Humidity'),
(5, 'S', 'temperature'),
(6, 'S', 'TEMPERATURE'),
(18, 'S', 'HOMEFRONT2'),
(55, 'H', 'SWITCH');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sensor_count` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outer_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prim_key` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`prim_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `sensor_count`, `key`, `outer_key`, `prim_key`) VALUES
('1', 'Home', 2, '123456', '123456', 1),
('bojan123 - system', 'bojan123 - system', 0, '12345', '12345', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`) VALUES
(16, 'bojan1@bojan.com', 'e0a35d8b43806377a1ee29d802270f94', 'bojan123');

-- --------------------------------------------------------

--
-- Table structure for table `user_system`
--

CREATE TABLE IF NOT EXISTS `user_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `system_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_system`
--

INSERT INTO `user_system` (`id`, `user_id`, `system_id`) VALUES
(1, 16, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
