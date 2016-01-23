-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-14 13:05:15
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
  `act_id_submit` bigint(11) unsigned NOT NULL COMMENT '活动所有者(该活动表提交者)',
  `act_host` varchar(80) CHARACTER SET utf8 DEFAULT NULL COMMENT '主办方',
  `act_partici` text CHARACTER SET utf8 NOT NULL COMMENT '活动参与者(存储参与者id，函数分割/查询/统计)',
  `act_id_cat` bigint(11) unsigned NOT NULL COMMENT '活动所属类别id',
  `act_state` bigint(4) NOT NULL DEFAULT '0' COMMENT '活动状态(待审核/审核未通过/完结)',
  `act_attach` varchar(80) CHARACTER SET utf8 DEFAULT NULL COMMENT '附件',
  `act_comment` text CHARACTER SET utf8 COMMENT '备注',
  `act_detail` text CHARACTER SET utf8 NOT NULL COMMENT '详情(指导老师，描述，介绍，总结...)',
  PRIMARY KEY (`act_id`),
  KEY `id_submit` (`act_id_submit`) COMMENT '外键约束',
  KEY `id_cat` (`act_id_cat`) COMMENT '外键约束'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='活动表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `act_activity`
--

INSERT INTO `act_activity` (`act_id`, `act_name`, `act_date_beg`, `act_date_end`, `act_time_submit`, `act_time_update`, `act_is_personal`, `act_id_submit`, `act_host`, `act_partici`, `act_id_cat`, `act_state`, `act_attach`, `act_comment`, `act_detail`) VALUES
(1, '江苏高校传媒新闻奖', '2013-04-03', '2013-10-09', '2016-01-09 23:12:24', '2016-01-09 23:12:24', 1, 3120602001, '江苏高校传媒', '王丽珍、3120602019、3120602001', 8, 0, NULL, NULL, 'phpmyadmin 输入测试'),
(2, '测试添加活动', '2013-01-01', '2013-12-01', '2016-01-12 20:45:51', '2016-01-12 20:45:51', 1, 2000000001, '测试举办方', '测试用户 空格隔开', 6, 0, '无', '', '详情测试'),
(3, '测试集体活动', '2016-01-06', '2016-01-08', '2016-01-13 23:14:09', '2016-01-13 23:14:09', 0, 3120602019, '测试集体活动', '计算机1201、计算机科学与通信工程学院、3120602038', 5, 0, NULL, NULL, ''),
(8, '测试活动提交', '2016-01-04', '2016-01-08', '2016-01-14 00:05:06', '2016-01-14 00:05:06', 1, 3120602019, NULL, '倒萨', 6, 0, NULL, NULL, '的撒倒萨');

-- --------------------------------------------------------

--
-- 表的结构 `act_category`
--

CREATE TABLE IF NOT EXISTS `act_category` (
  `cat_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动类别id',
  `cat_name` varchar(40) NOT NULL COMMENT '活动类别名称',
  `cat_level` int(4) NOT NULL COMMENT '类别深度(1，2...级分类)',
  `cat_id_parent` bigint(11) unsigned NOT NULL COMMENT '父类别id(level为1时此处为NULL)',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='活动类别表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `act_category`
--

INSERT INTO `act_category` (`cat_id`, `cat_name`, `cat_level`, `cat_id_parent`) VALUES
(1, '社会实践', 1, 0),
(2, '科研立项', 1, 0),
(3, '学生学习指导', 1, 0),
(4, '学术竞赛', 1, 0),
(5, '团日活动', 1, 0),
(6, '其他', 1, 0),
(7, '校内竞赛', 2, 4),
(8, '校外竞赛', 2, 4),
(9, '入学教育', 2, 3),
(10, '就业指导', 2, 3);

-- --------------------------------------------------------

--
-- 表的结构 `act_user`
--

CREATE TABLE IF NOT EXISTS `act_user` (
  `usr_id` bigint(11) unsigned NOT NULL COMMENT '学号/工号',
  `usr_group` smallint(2) NOT NULL DEFAULT '1' COMMENT '角色：2-管理员 1-普通用户',
  `usr_name` varchar(10) NOT NULL COMMENT '用户名',
  `usr_passwd` varchar(20) NOT NULL COMMENT '密码',
  `usr_state` tinyint(1) NOT NULL COMMENT '身份：1-teacher 0-student',
  `usr_depart` varchar(40) DEFAULT NULL COMMENT '所属院系(教师可为NULL)',
  `usr_class` varchar(20) DEFAULT NULL COMMENT '所属班级(教师为NULL)',
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `act_user`
--

INSERT INTO `act_user` (`usr_id`, `usr_group`, `usr_name`, `usr_passwd`, `usr_state`, `usr_depart`, `usr_class`) VALUES
(1000000000, 2, 'admin', 'admin', 0, '计算机科学与通信工程学院', '科学系'),
(2000000000, 1, '马悦峰', '12345', 0, '计算机科学与通信工程学院', '计算机1201'),
(2000000001, 1, '潘雨青', '12345', 1, '计算机科学与通信工程学院', ''),
(2321321321, 1, '测试', '12345', 1, NULL, NULL),
(3120602001, 1, '王丽珍', '12345', 0, '计算机科学与通信工程学院', '计算机1201'),
(3120602003, 1, '李成倩', '12345', 0, '计算机科学与通信工程学院', '计算机1201'),
(3120602019, 1, '陈林', '12345', 0, '计算机科学与通信工程学院', '计算机1201'),
(3120602038, 1, '陈娇倩', '12345', 0, '计算机科学与通信工程学院', '计算机1203');

--
-- 限制导出的表
--

--
-- 限制表 `act_activity`
--
ALTER TABLE `act_activity`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`act_id_cat`) REFERENCES `act_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usr_id` FOREIGN KEY (`act_id_submit`) REFERENCES `act_user` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
