-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 21, 2017 at 06:51 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `restful`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_New`
--

CREATE TABLE `t_New` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `birth` varchar(10) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_New`
--

INSERT INTO `t_New` (`id`, `name`, `birth`, `create_time`, `status`) VALUES
(12, 'zhangna', '1996', '2017-05-10 02:49:48', 1),
(16, 'zhanglin', '1993', '2017-06-21 03:10:58', 1),
(19, 'zhangyongxin', '1998', '2017-06-21 03:11:20', 1),
(20, 'zhangna', '1996', '2017-05-10 02:49:48', 1),
(21, 'zhanglin', '1993', '2017-06-21 03:10:58', 1),
(22, 'zhangyongxin', '1998', '2017-06-21 03:11:20', 1),
(23, 'chenshaomin', '2000', '2017-06-21 09:51:21', 0),
(24, 'chenshaomin', '2000', '2017-06-21 09:51:21', 0),
(25, 'chenshaomin', '2000', '2017-06-21 09:51:21', 0),
(26, 'chenshaomin', '2000', '2017-06-21 09:51:21', 0),
(27, 'chenshaomin', '2000', '2017-06-21 09:51:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `uuid` int(11) NOT NULL,
  `open` varchar(50) NOT NULL,
  `timestamp` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`uuid`, `open`, `timestamp`) VALUES
(1, '测试1', ''),
(2, '测试1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_New`
--
ALTER TABLE `t_New`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_New`
--
ALTER TABLE `t_New`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `uuid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;