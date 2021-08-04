-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 04:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_entryway`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `adm_mobile` varchar(25) NOT NULL,
  `adm_type` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `adm_mobile`, `adm_type`, `status`, `date`) VALUES
(1, 'admin', '0788888888', 1, 'Active', '2021-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` longtext DEFAULT NULL,
  `mobile_no` longtext DEFAULT NULL,
  `place_status` int(11) NOT NULL DEFAULT 1,
  `place_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `mobile_no`, `place_status`, `place_reg_date`) VALUES
(1, 'gate1', '078888888', 1, '2021-07-20 23:25:10'),
(2, 'gate2', '078000000', 1, '2021-07-22 17:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_records`
--

CREATE TABLE `tbl_records` (
  `rec_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `place_out` int(11) DEFAULT NULL,
  `entrance_time` time DEFAULT NULL,
  `exit_time` time DEFAULT NULL,
  `stuffs` varchar(255) NOT NULL,
  `rec_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_records`
--

INSERT INTO `tbl_records` (`rec_id`, `user_id`, `place_id`, `place_out`, `entrance_time`, `exit_time`, `stuffs`, `rec_date`) VALUES
(1, 1, 1, 1, '10:19:03', '11:55:49', 'dndjdb', '2021-07-23'),
(2, 2, 1, 1, '10:19:27', '12:02:33', '', '2021-07-23'),
(4, 1, 1, 1, '13:05:04', '13:10:00', 'dndjdb', '2021-07-23'),
(5, 2, 1, 2, '10:19:27', '13:07:25', '3jkbk3rn', '2021-07-23'),
(6, 1, 1, 2, '13:10:57', '13:11:18', 'dndjdb', '2021-07-23'),
(7, 1, 1, 1, '16:11:08', '16:11:56', '', '2021-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `f_name` longtext DEFAULT NULL,
  `l_name` longtext DEFAULT NULL,
  `mobile_no` longtext DEFAULT NULL,
  `id_no` longtext DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1,
  `user_type` int(11) DEFAULT 1,
  `user_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `f_name`, `l_name`, `mobile_no`, `id_no`, `user_status`, `user_type`, `user_reg_date`) VALUES
(1, 'john', 'doe', '0722334455', '21', 1, 1, '2021-07-21 11:25:20'),
(2, 'jane', 'doe', '0755443322', '12', 1, 2, '2021-07-21 11:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_login`
--

CREATE TABLE `tbl_users_login` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status_login` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users_login`
--

INSERT INTO `tbl_users_login` (`login_id`, `user_id`, `username`, `password`, `role_id`, `date`, `status_login`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-07-20', 1),
(2, 1, 'gate1', '682395ac2dd8c3575f32a3549862918a', 2, '2021-07-21', 1),
(3, 2, 'gate2', 'c903bdc44f69fc4f1e8cd2ff0bc6886d', 2, '2021-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_session`
--

CREATE TABLE `tbl_user_session` (
  `id` int(5) NOT NULL,
  `sess_id` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `time_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_logout` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` char(3) NOT NULL DEFAULT 'ON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_session`
--

INSERT INTO `tbl_user_session` (`id`, `sess_id`, `username`, `ip`, `time_login`, `time_logout`, `status`) VALUES
(1, 'e9fa27c548ee7ec3b3adb21215dc37a7', 'admin', '::1', '2021-07-20 21:57:57', '2021-07-20 23:04:06', 'OFF'),
(2, 'a993f4265f378eade7882b80568af7cc', 'admin', '::1', '2021-07-20 23:04:38', '0000-00-00 00:00:00', 'ON'),
(3, '35866ec23e1a514b5c3668e990e250ae', 'admin', '::1', '2021-07-20 23:39:28', '2021-07-21 01:56:17', 'OFF'),
(4, '3654dbbcdd591efbcb44d6f29f487441', 'admin', '::1', '2021-07-21 09:57:14', '2021-07-21 10:06:44', 'OFF'),
(5, '6c052987d532af0c64292b38541801e8', 'admin', '::1', '2021-07-21 10:06:57', '2021-07-21 10:31:19', 'OFF'),
(6, 'ccab5e2f14d7ec638dc819ffd0137f2a', 'janedoe', '::1', '2021-07-21 10:31:31', '2021-07-21 10:31:38', 'OFF'),
(7, 'b0107fb7e214f602017a96857bb0f2c4', 'janedoe', '::1', '2021-07-21 10:31:57', '2021-07-21 10:32:11', 'OFF'),
(8, '2bc3900bff210b080e6bd19c10331244', 'admin', '::1', '2021-07-21 10:32:30', '2021-07-21 11:25:14', 'OFF'),
(9, 'fc34fe66583aa4e9ba927c7895b529f7', 'admin', '::1', '2021-07-21 11:28:11', '2021-07-21 11:29:32', 'OFF'),
(10, 'e71ad22eed10d8f6f8242f67695b215f', 'gate1', '::1', '2021-07-21 11:29:43', '2021-07-21 11:32:24', 'OFF'),
(11, '7bf8fdd3d0fc0cc83d24038721fe0ad4', 'gate1', '::1', '2021-07-21 11:32:30', '2021-07-21 11:40:34', 'OFF'),
(12, 'a5c6ae0687033939cbc32062b2d641cd', 'gate1', '::1', '2021-07-21 12:18:04', '0000-00-00 00:00:00', 'ON'),
(13, 'ad1386b8a4d6ffae8e04314540d60ab2', 'gate1', '192.168.43.1', '2021-07-21 23:56:12', '0000-00-00 00:00:00', 'ON'),
(14, 'ca44e9f31c7cda23cf7b17285adfae46', 'gate1', '192.168.43.1', '2021-07-21 23:56:12', '0000-00-00 00:00:00', 'ON'),
(15, '5731e731412229360a12f521c08406ff', 'gate1', '192.168.43.1', '2021-07-22 00:19:46', '0000-00-00 00:00:00', 'ON'),
(16, 'ccf06aedd9a2ec3278857f71a2072b3a', 'gate1', '192.168.43.1', '2021-07-22 00:19:48', '0000-00-00 00:00:00', 'ON'),
(17, '56dca95d7ba63bbb4b7908423f2a6ad3', 'gate1', '192.168.43.1', '2021-07-22 01:19:26', '0000-00-00 00:00:00', 'ON'),
(18, '1bf4e745eb0f969eedc1b53fe7e48b04', 'gate1', '192.168.43.1', '2021-07-22 01:19:26', '0000-00-00 00:00:00', 'ON'),
(19, 'c945c2422e045d8626ded70043cfea2b', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(20, 'dec5a9d81ccfc1849d2c1a7e13f50f84', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(21, '20871c898021c21955be8f695426b145', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(22, '8914d892cadb745af22520c3a8d93adf', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(23, '00653e1c588c7b4bc7e9a6be7a43a843', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(24, '8914d892cadb745af22520c3a8d93adf', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(25, '822e86354ff1f03adbda3fe01babb78b', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(26, '3e61b643a38a41f1a81fdba5bb968b4f', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(27, '00653e1c588c7b4bc7e9a6be7a43a843', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(28, '7407a6147152e86f3dc65896a9f9bc3d', 'gate1', '192.168.43.1', '2021-07-22 02:08:38', '0000-00-00 00:00:00', 'ON'),
(29, '485b1292dd3caf0f5a5cedea2bf31892', 'gate1', '192.168.43.1', '2021-07-22 11:31:23', '0000-00-00 00:00:00', 'ON'),
(30, '8a8da2b4f4dda685a0fa2635e3bb3e96', 'gate1', '192.168.43.1', '2021-07-22 11:31:23', '0000-00-00 00:00:00', 'ON'),
(31, '3d71a784bc2de32f43fbf5a6bbfe493e', 'gate1', '192.168.43.1', '2021-07-22 11:31:33', '0000-00-00 00:00:00', 'ON'),
(32, '40297b103a00d837cb5a91a9cac23441', 'gate1', '192.168.43.1', '2021-07-22 11:50:34', '0000-00-00 00:00:00', 'ON'),
(33, '8d674040b8f5318f6a4c3e0dd5e2ac61', 'gate1', '192.168.43.1', '2021-07-22 11:50:35', '0000-00-00 00:00:00', 'ON'),
(34, '47e75b7086f2068dcd2dc1fb70724747', 'gate1', '192.168.43.1', '2021-07-22 11:53:03', '0000-00-00 00:00:00', 'ON'),
(35, '227971af9115d97a2a9ca4d76040e0a4', 'gate1', '192.168.43.1', '2021-07-22 11:53:03', '0000-00-00 00:00:00', 'ON'),
(36, '7e1787e803de78c3e874685d9b78eee0', 'gate1', '192.168.43.1', '2021-07-22 11:53:15', '0000-00-00 00:00:00', 'ON'),
(37, 'a0f3ca40248c4aa0fab29668a235092d', 'gate1', '192.168.43.1', '2021-07-22 15:47:15', '0000-00-00 00:00:00', 'ON'),
(38, '64a6f92c0be382d7524e19e128878b30', 'gate1', '192.168.43.1', '2021-07-22 15:47:15', '0000-00-00 00:00:00', 'ON'),
(39, 'c93f4b099646514b331343beecb76eec', 'gate1', '192.168.43.1', '2021-07-22 15:47:24', '0000-00-00 00:00:00', 'ON'),
(40, 'd5b232943548b3e85a1d8a26e1fa04fd', 'gate1', '192.168.43.1', '2021-07-22 15:47:25', '0000-00-00 00:00:00', 'ON'),
(41, '1020f69dcf6fab14fec780ed46187fcc', 'gate1', '::1', '2021-07-22 19:22:37', '2021-07-22 19:24:55', 'OFF'),
(42, '0a36a2e9a3596952f55962413149389f', 'admin', '::1', '2021-07-22 19:25:11', '2021-07-22 19:26:37', 'OFF'),
(43, 'db2cb87607c92c7ec6ed74183f3a6c33', 'gate1', '::1', '2021-07-22 19:26:48', '0000-00-00 00:00:00', 'ON'),
(44, 'a13f2d57d791fa249fd4fd01a3a428a3', 'gate1', '192.168.43.1', '2021-07-23 01:09:46', '0000-00-00 00:00:00', 'ON'),
(45, '08a96fdc63db7146d057e00d91cd5a72', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(46, 'c4fda4ee5c05eddd707a40b618218efa', 'gate1', '192.168.43.1', '2021-07-23 01:09:43', '0000-00-00 00:00:00', 'ON'),
(47, 'ed17837848e6a710660920ad817f416e', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(48, '9388fa76097e9faea69362339a4dbb0f', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(49, '08a96fdc63db7146d057e00d91cd5a72', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(50, '444490670fe5e8bb9f48dc6b37941c5a', 'gate1', '192.168.43.1', '2021-07-23 01:09:47', '0000-00-00 00:00:00', 'ON'),
(51, 'af71f92d28d633a0897b307e4558c53b', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(52, '1235217866f0fb481d3b49537a5f880b', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(53, '7b22d710305202b24c7f166c78fa4326', 'gate1', '192.168.43.1', '2021-07-23 01:09:36', '0000-00-00 00:00:00', 'ON'),
(54, '0cb4d6a5e052b237ef3d852b3e6e39d4', 'gate1', '192.168.43.1', '2021-07-23 01:09:50', '0000-00-00 00:00:00', 'ON'),
(55, '92f9c177fc753fe50313564342ad6604', 'gate1', '192.168.43.1', '2021-07-23 01:09:52', '0000-00-00 00:00:00', 'ON'),
(56, 'ff3ea74c79e7ff6234632a0497035636', 'gate1', '192.168.43.1', '2021-07-23 01:10:00', '0000-00-00 00:00:00', 'ON'),
(57, '08b1d805c8c5e3e469a7c2181efe7dda', 'gate1', '192.168.43.1', '2021-07-23 09:40:07', '0000-00-00 00:00:00', 'ON'),
(58, '761d1f5eabce2506cf6f889c41338659', 'gate1', '192.168.43.1', '2021-07-23 09:42:10', '0000-00-00 00:00:00', 'ON'),
(59, 'fbb2907f541ae490fd37cf7ae32eed08', 'gate1', '::1', '2021-07-23 12:50:13', '2021-07-23 12:50:49', 'OFF'),
(60, 'be24ee08d3fac7ea00db8649d5f0a292', 'admin', '::1', '2021-07-23 12:51:01', '2021-07-23 13:02:45', 'OFF'),
(61, 'b19559a5e532d6324b41c471a9ebdd58', 'admin', '::1', '2021-07-23 13:03:43', '2021-07-23 13:05:30', 'OFF'),
(62, 'fefa2ca0a6f4c4fb60cfeb7e3869b2e5', 'gate2', '192.168.43.1', '2021-07-23 13:04:09', '0000-00-00 00:00:00', 'ON'),
(63, 'f070db2433d6cacc45ca7f9674e98df3', 'gate1', '192.168.43.1', '2021-07-23 13:04:53', '0000-00-00 00:00:00', 'ON'),
(64, '448a3f83cd4bf335e0da53b8bf029d2f', 'gate1', '::1', '2021-07-23 13:05:39', '2021-07-23 13:06:38', 'OFF'),
(65, '71e0c3f3461f7ca4e13eaa28f4b83cdf', 'gate2', '::1', '2021-07-23 13:06:45', '0000-00-00 00:00:00', 'ON'),
(66, '7020e8099aee76b8c5f9c2fd33a3a7e2', 'gate2', '192.168.43.1', '2021-07-23 13:11:11', '0000-00-00 00:00:00', 'ON'),
(67, 'fcde14913c766cf307c75059e0e89af5', 'admin', '::1', '2021-07-23 16:07:17', '2021-07-23 16:08:22', 'OFF'),
(68, 'db4275f410317c13e5f30f9d0b38d276', 'gate1', '::1', '2021-07-23 16:08:31', '0000-00-00 00:00:00', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `adminname` (`admin_name`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_records`
--
ALTER TABLE `tbl_records`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_users_login`
--
ALTER TABLE `tbl_users_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_user_session`
--
ALTER TABLE `tbl_user_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_records`
--
ALTER TABLE `tbl_records`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users_login`
--
ALTER TABLE `tbl_users_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_session`
--
ALTER TABLE `tbl_user_session`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
