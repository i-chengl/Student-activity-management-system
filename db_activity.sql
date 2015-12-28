-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-12-27 10:21:56
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_activity`
--

-- --------------------------------------------------------

--
-- 表的结构 `act_admin`
--

CREATE TABLE IF NOT EXISTS `act_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `admin_name` varchar(20) NOT NULL COMMENT '账号',
  `admin_pass` varchar(20) NOT NULL COMMENT '密码',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `act_category`
--

CREATE TABLE IF NOT EXISTS `act_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动类别ID',
  `cat_name` varchar(20) NOT NULL COMMENT '活动类别名',
  `has_child` tinyint(1) NOT NULL DEFAULT '0' COMMENT '有无子类',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `act_sub_category`
--

CREATE TABLE IF NOT EXISTS `act_sub_category` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '子类ID',
  `sub_name` varchar(20) NOT NULL COMMENT '子类名字',
  `parent_id` int(11) DEFAULT NULL COMMENT '父类ID',
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `act_user`
--

CREATE TABLE IF NOT EXISTS `act_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pass` varchar(20) NOT NULL COMMENT '用户密码',
  `user_Email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `user_depart` text NOT NULL COMMENT '学院',
  `user_class` text NOT NULL COMMENT '班级',
  `user_num` int(20) NOT NULL COMMENT '学号/工号',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_num` (`user_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;