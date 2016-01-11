-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-11 12:36:30
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
-- 表的结构 `act_activity`
--

CREATE TABLE IF NOT EXISTS `act_activity` (
  `act_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动id',
  `act_name` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '活动名称',
  `act_date_beg` date NOT NULL COMMENT '活动起始日期',
  `act_date_end` date NOT NULL COMMENT '活动结束日期',
  `act_time_submit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '活动提交时间',
  `act_time_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '活动最后更新时间',
  `act_is_personal` tinyint(1) NOT NULL COMMENT '是否个人活动(参与者可数)',
  `act_id_submit` bigint(11) NOT NULL COMMENT '提交人',
  `act_host` varchar(80) CHARACTER SET utf8 DEFAULT NULL COMMENT '主办方',
  `act_partici` text CHARACTER SET utf8 NOT NULL COMMENT '参与者(以空格分隔)',
  `act_id_cat` int(11) NOT NULL COMMENT '所属类别',
  `act_state` int(4) NOT NULL COMMENT '活动状态(待审核/审核未通过/完结)',
  `act_attach` varchar(80) CHARACTER SET utf8 DEFAULT NULL COMMENT '附件',
  `act_comment` text CHARACTER SET utf8 COMMENT '备注',
  `act_detail` text CHARACTER SET utf8mb4 NOT NULL COMMENT '详情(指导老师，描述，介绍，总结...)',
  PRIMARY KEY (`act_id`),
  KEY `id_submit` (`act_id_submit`) COMMENT '外键约束',
  KEY `id_cat` (`act_id_cat`) COMMENT '外键约束'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='活动表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `act_admin`
--

CREATE TABLE IF NOT EXISTS `act_admin` (
  `adm_id` bigint(11) unsigned NOT NULL COMMENT 'id',
  `adm_name` varchar(10) NOT NULL COMMENT '管理员',
  `adm_passwd` varchar(20) NOT NULL COMMENT '密码',
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- --------------------------------------------------------

--
-- 表的结构 `act_category`
--

CREATE TABLE IF NOT EXISTS `act_category` (
  `cat_id` bigint(11) unsigned NOT NULL COMMENT '活动类别id',
  `cat_name` varchar(40) NOT NULL COMMENT '活动类别',
  `cat_level` int(4) NOT NULL COMMENT '类别深度(1，2...级分类)',
  `cat_id_parent` bigint(11) DEFAULT NULL COMMENT '父类别（level为1时此处为NULL)',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动类别表';

-- --------------------------------------------------------

--
-- 表的结构 `act_user`
--

CREATE TABLE IF NOT EXISTS `act_user` (
  `usr_id` bigint(11) unsigned NOT NULL COMMENT '学号/工号',
  `usr_name` varchar(10) NOT NULL COMMENT '用户名',
  `usr_passwd` varchar(20) NOT NULL COMMENT '密码',
  `usr_state` tinyint(1) NOT NULL COMMENT '身份：1-teacher 0-student',
  `usr_depart` varchar(40) DEFAULT NULL COMMENT '所属院系(教师可为NULL)',
  `usr_class` varchar(20) DEFAULT NULL COMMENT '所属班级/系',
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
