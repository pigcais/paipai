-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 29 日 10:47
-- 服务器版本: 5.1.51-community
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `paidui`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `pwd` varchar(32) NOT NULL DEFAULT '',
  `power` varchar(32) NOT NULL DEFAULT '',
  `create_date` varchar(32) NOT NULL DEFAULT '',
  `invalid` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `describe` text,
  `create_date` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `to_id` int(32) unsigned DEFAULT NULL,
  `uid` int(8) DEFAULT NULL,
  `mid` int(8) DEFAULT NULL,
  `content` varchar(128) DEFAULT NULL,
  `score` int(4) unsigned DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `invalid` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `merchant`
--

CREATE TABLE IF NOT EXISTS `merchant` (
  `mid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `merchant_name` varchar(64) NOT NULL DEFAULT '',
  `contact` varchar(128) DEFAULT NULL,
  `province` varchar(32) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `county` varchar(32) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `invalid` int(1) unsigned NOT NULL DEFAULT '0',
  `business_theme` text,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `merchant`
--

INSERT INTO `merchant` (`mid`, `merchant_name`, `contact`, `province`, `city`, `county`, `url`, `create_date`, `invalid`, `business_theme`) VALUES
(2, 'xuwei', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(4, 'liufx121', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(5, 'wyn_merchant', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(11, 'abc123', '', '', '', '', '', NULL, 0, ''),
(18, 'test', '', '', '', '', '', NULL, 0, ''),
(20, 'tyugguusee', '', '', '', '', '', NULL, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `queue_count`
--

CREATE TABLE IF NOT EXISTS `queue_count` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(8) unsigned DEFAULT NULL,
  `business_id` int(16) unsigned DEFAULT NULL,
  `count` int(16) unsigned DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `update_date` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `queue_log`
--

CREATE TABLE IF NOT EXISTS `queue_log` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(8) unsigned DEFAULT NULL,
  `mid` int(8) DEFAULT NULL,
  `business_id` int(16) DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `invalid` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `queue_merchant`
--

CREATE TABLE IF NOT EXISTS `queue_merchant` (
  `mid` int(8) unsigned NOT NULL DEFAULT '0',
  `current_serve` int(8) unsigned DEFAULT '0',
  `current_num` int(8) unsigned DEFAULT '1',
  `business_id` int(16) unsigned NOT NULL DEFAULT '0',
  `serve_count` int(8) DEFAULT NULL,
  `created_date` varchar(32) DEFAULT NULL,
  `empty_num` text,
  `state` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`business_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `queue_merchant`
--

INSERT INTO `queue_merchant` (`mid`, `current_serve`, `current_num`, `business_id`, `serve_count`, `created_date`, `empty_num`, `state`) VALUES
(4, 14, 137, 3, NULL, NULL, NULL, 1),
(20, 2, 1, 35, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `queue_user`
--

CREATE TABLE IF NOT EXISTS `queue_user` (
  `uid` int(8) unsigned NOT NULL DEFAULT '0',
  `current_num` int(8) NOT NULL DEFAULT '0',
  `mid` int(8) unsigned NOT NULL DEFAULT '0',
  `business_id` int(16) unsigned NOT NULL DEFAULT '0',
  `code` int(4) unsigned NOT NULL DEFAULT '0',
  `old_length` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`current_num`,`business_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `queue_user`
--

INSERT INTO `queue_user` (`uid`, `current_num`, `mid`, `business_id`, `code`, `old_length`) VALUES
(0, 109, 4, 3, 0, 100),
(0, 110, 4, 3, 0, 101),
(0, 111, 4, 3, 0, 102),
(0, 112, 4, 3, 0, 103),
(0, 113, 4, 3, 0, 104),
(0, 114, 4, 3, 0, 105),
(0, 115, 4, 3, 0, 106),
(0, 116, 4, 3, 0, 107),
(0, 117, 4, 3, 0, 108),
(0, 118, 4, 3, 0, 109),
(0, 119, 4, 3, 0, 110),
(0, 120, 4, 3, 0, 111),
(4, 122, 4, 3, 0, 113),
(0, 123, 4, 3, 0, 114),
(0, 124, 4, 3, 0, 115),
(0, 125, 4, 3, 0, 116),
(3, 127, 4, 3, 0, 118),
(4, 130, 4, 3, 0, 120),
(4, 134, 4, 3, 0, 120),
(0, 135, 4, 3, 0, 121),
(3, 136, 4, 3, 0, 122),
(17, 137, 4, 3, 0, 123),
(0, 887, 3, 1, 0, 886);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `pwd` varchar(32) NOT NULL DEFAULT '',
  `gender` char(1) DEFAULT NULL,
  `mail` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `qq` varchar(16) DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `invalid` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `name`, `pwd`, `gender`, `mail`, `address`, `phone`, `qq`, `create_date`, `invalid`) VALUES
(3, 'liufx', '1234', '', '', '', '', '', '2013-04-04 14:08:35', 0),
(4, 'liufx121', '1234', '', '', '', '', '', '2013-04-05 15:15:29', 0),
(5, 'wyn', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-05 15:15:39', 0),
(7, 'a', '123', '', '', '', '', '', '2013-04-05 16:15:41', 0),
(8, 'b', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-05 16:15:45', 0),
(9, 'c', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-05 16:15:46', 0),
(10, 'd', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-05 16:15:47', 0),
(11, 'fuck', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-19 16:34:27', 0),
(12, 'root', '123', '男', '603165424@qq.com', '', '', '', '2013-04-23 10:20:19', 0),
(13, 'ctm', '123', NULL, NULL, NULL, NULL, NULL, '2013-04-24 01:51:57', 0),
(14, 'wee', '1234', NULL, NULL, NULL, NULL, NULL, '2013-06-29 08:22:47', 0),
(15, 'yhh', '1234', NULL, NULL, NULL, NULL, NULL, '2013-06-29 08:23:47', 0),
(16, 'yho', '1234', NULL, NULL, NULL, NULL, NULL, '2013-06-29 08:25:26', 0),
(17, 'RRR', '1234', NULL, NULL, NULL, NULL, NULL, '2013-06-29 08:28:56', 0),
(18, 'test', '1234', '', '', '', '', '', '2013-06-29 08:31:38', 0),
(19, 'TTT', '123', NULL, NULL, NULL, NULL, NULL, '2013-06-29 09:09:39', 0),
(20, 'tyu', '123', NULL, NULL, NULL, NULL, NULL, '2013-06-29 09:10:26', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
