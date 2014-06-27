-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2012 at 06:53 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admin_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `scgfx_ban_list`
--

CREATE TABLE IF NOT EXISTS `scgfx_ban_list` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(16) DEFAULT NULL,
  `fbname` varchar(128) DEFAULT NULL,
  `banned_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `scgfx_ban_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `scgfx_chats`
--

CREATE TABLE IF NOT EXISTS `scgfx_chats` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(512) DEFAULT NULL,
  `fbid` varchar(64) DEFAULT NULL,
  `msg_type` varchar(8) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `scgfx_chats`
--


-- --------------------------------------------------------

--
-- Table structure for table `scgfx_user_accounts`
--

CREATE TABLE IF NOT EXISTS `scgfx_user_accounts` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(36) DEFAULT NULL,
  `fbname` varchar(128) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `acctype` varchar(16) DEFAULT NULL,
  `ses_id` varchar(64) DEFAULT NULL,
  `active` int(8) DEFAULT NULL,
  `sign_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_request_time` varchar(36) DEFAULT NULL,
  `ip_address` varchar(36) DEFAULT NULL,
  `points` float NOT NULL,
  `ranks` int(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scgfx_user_accounts`
--

INSERT INTO `scgfx_user_accounts` (`user_id`, `fbid`, `fbname`, `gender`, `acctype`, `ses_id`, `active`, `sign_time`, `last_request_time`, `ip_address`, `points`, `ranks`) VALUES
(1, '', 'Mike_Manila', 'male', '0', '1e9a2830c6fd544befd4499c2418a4b0', 0, '2012-10-25 18:05:15', '1351159673', '111.222.333.444', 0, 0);