-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-08 11:00:07
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `act_admin`
--

INSERT INTO `act_admin` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', 'admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `act_category`
--

INSERT INTO `act_category` (`cat_id`, `cat_name`, `has_child`) VALUES
(1, '学术竞赛', 1),
(2, '社会实践', 0),
(3, '科研立项', 0),
(4, '学习指导', 1),
(5, '团日活动', 0),
(6, '其他', 0);

-- --------------------------------------------------------

--
-- 表的结构 `act_detail`
--

CREATE TABLE IF NOT EXISTS `act_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动ID',
  `name` varchar(40) NOT NULL COMMENT '活动名称',
  `manger_id` int(11) NOT NULL COMMENT '活动组织者id',
  `cat_id` int(11) NOT NULL COMMENT '分类id',
  `cat_sub_id` int(11) DEFAULT NULL COMMENT '子类id',
  `submit_time` datetime NOT NULL COMMENT '提交时间',
  `update_time` datetime DEFAULT NULL COMMENT '最近更新时间',
  `beg_date` date NOT NULL COMMENT '活动开始时间',
  `end_time` date NOT NULL COMMENT '活动结束时间',
  `detail_add_id` int(11) DEFAULT NULL COMMENT '活动详情附加项id',
  `status` int(1) NOT NULL COMMENT '活动状态（0,待审核1,通过2,未通过3.完结）',
  `is_personal` tinyint(1) DEFAULT NULL COMMENT '是否个人活动',
  `count_participants` int(10) NOT NULL COMMENT '参与者人数',
  PRIMARY KEY (`id`),
  KEY `user_id` (`manger_id`) COMMENT '用户id',
  KEY `cat_id` (`cat_id`) COMMENT '分类id外键',
  KEY `add_id` (`detail_add_id`) COMMENT '附加项id'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `act_detail`
--

INSERT INTO `act_detail` (`id`, `name`, `manger_id`, `cat_id`, `cat_sub_id`, `submit_time`, `update_time`, `beg_date`, `end_time`, `detail_add_id`, `status`, `is_personal`, `count_participants`) VALUES
(1, '基于web的院系监考安排发布系统', 2, 1, 1, '2013-01-08 00:00:00', NULL, '2013-01-08', '2013-01-08', NULL, 0, 1, 1),
(2, '节能环保，倡导低碳生活', 5, 2, NULL, '2016-01-07 00:00:00', NULL, '2016-01-14', '2016-01-22', 1, 0, 1, 1),
(3, '江苏高校传媒联盟新闻奖三等奖 ', 7, 6, NULL, '2013-01-08 00:00:00', NULL, '2013-03-05', '2013-03-08', 2, 3, 1, 1),
(4, '江苏大学第11批大学生科研立项资助项目', 8, 3, NULL, '2012-01-13 00:00:00', NULL, '2011-01-13', '2012-01-13', NULL, 3, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `act_detail_add`
--

CREATE TABLE IF NOT EXISTS `act_detail_add` (
  `det_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动详情id',
  `techer_id` varchar(8) DEFAULT NULL COMMENT '指导老师',
  `summary` text NOT NULL COMMENT '活动总结',
  `participants` text COMMENT '参与者详情',
  `attachment` int(11) DEFAULT NULL COMMENT '附件',
  `comment` text COMMENT '备注',
  PRIMARY KEY (`det_id`),
  KEY `teacher_id` (`techer_id`) COMMENT '指导老师id'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `act_detail_add`
--

INSERT INTO `act_detail_add` (`det_id`, `techer_id`, `summary`, `participants`, `attachment`, `comment`) VALUES
(1, NULL, '', '', 0, NULL),
(2, NULL, '新闻奖三等奖', '', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `act_sub_category`
--

CREATE TABLE IF NOT EXISTS `act_sub_category` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '子类ID',
  `sub_name` varchar(20) NOT NULL COMMENT '子类名字',
  `parent_id` int(11) DEFAULT NULL COMMENT '父类ID',
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `act_sub_category`
--

INSERT INTO `act_sub_category` (`sub_id`, `sub_name`, `parent_id`) VALUES
(1, '校内竞赛', 1),
(2, '校外竞赛', 1),
(3, '入学教育', 4),
(4, '就业指导', 4);

-- --------------------------------------------------------

--
-- 表的结构 `act_user`
--

CREATE TABLE IF NOT EXISTS `act_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pass` varchar(20) NOT NULL COMMENT '用户密码',
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否老师',
  `user_Email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `user_depart` text NOT NULL COMMENT '学院',
  `user_class` text NOT NULL COMMENT '班级',
  `user_num` bigint(20) NOT NULL COMMENT '学号/工号',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_num` (`user_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `act_user`
--

INSERT INTO `act_user` (`user_id`, `user_name`, `user_pass`, `is_teacher`, `user_Email`, `user_depart`, `user_class`, `user_num`) VALUES
(1, 'chenlin', 'admin', 0, '615362333@qq.com', 'Computer science and communication engineering institute', '1201 computer science and technology ', 3120602019),
(2, '孙亚楠', '12345', 0, NULL, '计算机科学与通信工程学院', '', 3120601002),
(4, '潘雨清', '12345', 1, NULL, '计算机科学与通信工程学院', '', 1000000000),
(5, '马悦峰', '12345', 0, NULL, '计算机科学与通信工程学院', '', 3120601001),
(6, '马学文', '12345', 1, NULL, '计算机科学与通信工程学院', '', 1000000001),
(7, '王丽珍', '12345', 0, NULL, '计算机科学与通信工程学院', '计算机1201', 3120602001),
(8, '李露', '12345', 0, NULL, '计算机科学与通信工程学院', '计算机1001', 3100602001);

--
-- 限制导出的表
--

--
-- 限制表 `act_detail`
--
ALTER TABLE `act_detail`
  ADD CONSTRAINT `detail_id` FOREIGN KEY (`detail_add_id`) REFERENCES `act_detail_add` (`det_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`cat_id`) REFERENCES `act_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`manger_id`) REFERENCES `act_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
