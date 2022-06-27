-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2022 at 04:18 PM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slumber6_slumshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(5) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(40) NOT NULL,
  `admin_role` varchar(20) NOT NULL,
  `admin_datereg` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_role`, `admin_datereg`) VALUES
(1, 'Ahmad Hanis', 'slumberjer@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'super', '2022-04-21 13:11:49.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `cart_qty` int(6) NOT NULL,
  `cart_status` varchar(10) DEFAULT NULL,
  `receipt_id` varchar(10) DEFAULT NULL,
  `cart_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`cart_id`, `product_id`, `customer_email`, `cart_qty`, `cart_status`, `receipt_id`, `cart_date`) VALUES
(40, 38, 'slumberjer@gmail.com', 5, 'paid', '4gckykzo', '2022-06-07 19:43:58.221716'),
(42, 41, 'slumberjer@gmail.com', 1, 'paid', 'c9krknnp', '2022-06-07 19:49:59.455433'),
(44, 26, 'slumberjer@gmail.com', 2, 'paid', 'c9krknnp', '2022-06-07 20:10:39.647663'),
(45, 27, 'slumberjer@gmail.com', 2, 'paid', 'c9krknnp', '2022-06-07 20:10:42.897907'),
(47, 48, 'slumberjer@gmail.com', 1, 'paid', 'c9krknnp', '2022-06-07 20:21:00.343546'),
(52, 5, 'slumberjer@gmail.com', 1, 'paid', 'c9krknnp', '2022-06-07 22:29:43.707169'),
(53, 15, 'slumberjer@gmail.com', 2, 'paid', 'c9krknnp', '2022-06-07 22:29:58.639412'),
(54, 10, 'slumberjer@gmail.com', 2, 'paid', 'c9krknnp', '2022-06-08 06:58:33.615336'),
(55, 4, 'slumberjer@gmail.com', 2, 'paid', '8mufnh1t', '2022-06-08 17:47:11.136710'),
(56, 8, 'slumberjer@gmail.com', 1, 'paid', '8mufnh1t', '2022-06-08 17:48:34.737146'),
(57, 12, 'slumberjer@gmail.com', 2, 'paid', '8mufnh1t', '2022-06-08 17:51:20.414338'),
(59, 35, 'slumberjer@gmail.com', 1, 'paid', '71ir4vqw', '2022-06-08 19:37:38.412017'),
(60, 49, 'slumberjer@gmail.com', 1, 'paid', '71ir4vqw', '2022-06-09 07:20:29.187953'),
(61, 42, 'slumberjer@gmail.com', 1, 'paid', '71ir4vqw', '2022-06-09 10:36:17.076460'),
(62, 50, 'slumberjer@gmail.com', 1, 'paid', '71ir4vqw', '2022-06-09 10:36:17.076585'),
(63, 52, 'slumberjer@gmail.com', 1, 'paid', '71ir4vqw', '2022-06-09 10:41:45.554297'),
(65, 48, 'slumberjer@gmail.com', 1, 'paid', 'vyrgeams', '2022-06-09 11:25:59.273117'),
(66, 11, 'slumberjer@gmail.com', 1, 'paid', 'vyrgeams', '2022-06-09 11:42:29.979032'),
(67, 33, 'slumberjer@gmail.com', 1, 'paid', 'vyrgeams', '2022-06-09 12:00:13.788365'),
(69, 49, 'slumberjer@gmail.com', 3, 'paid', 'v5wyniu0', '2022-06-09 12:22:24.186302'),
(70, 48, 'slumberjer@gmail.com', 1, 'paid', 'v5wyniu0', '2022-06-09 12:22:40.261584'),
(71, 25, 'slumberjer@gmail.com', 3, 'paid', 'v5wyniu0', '2022-06-09 12:23:04.209356'),
(74, 12, 'slumberjer@gmail.com', 2, 'paid', '1o9wqfts', '2022-06-09 13:01:03.637183'),
(75, 8, 'slumberjer@gmail.com', 2, 'paid', '1o9wqfts', '2022-06-09 13:02:28.481180'),
(76, 4, 'slumberjer@gmail.com', 2, 'paid', '1o9wqfts', '2022-06-09 13:03:20.559842'),
(77, 8, 'slumberjer@gmail.com', 1, 'paid', 'c5b4sq44', '2022-06-09 21:35:32.114439'),
(78, 6, 'slumberjer@gmail.com', 1, 'paid', 'c5b4sq44', '2022-06-09 21:35:34.624482'),
(79, 17, 'slumberjer@gmail.com', 1, 'paid', 'xawn0zya', '2022-06-09 21:50:18.138785'),
(80, 14, 'slumberjer@gmail.com', 1, 'paid', 'xawn0zya', '2022-06-09 21:50:20.337089'),
(81, 15, 'slumberjer@gmail.com', 1, 'paid', 'xawn0zya', '2022-06-09 21:50:22.773840'),
(82, 19, 'slumberjer@gmail.com', 1, 'paid', 'xawn0zya', '2022-06-09 21:50:24.783229'),
(83, 5, 'slumberjer@gmail.com', 1, 'paid', 'ryzyk3x0', '2022-06-09 21:54:00.885084'),
(84, 6, 'slumberjer@gmail.com', 1, 'paid', 'ryzyk3x0', '2022-06-09 21:54:02.963396'),
(85, 7, 'slumberjer@gmail.com', 1, 'paid', 'ryzyk3x0', '2022-06-09 21:54:05.389232'),
(86, 8, 'slumberjer@gmail.com', 1, 'paid', 'ryzyk3x0', '2022-06-09 21:54:07.807742'),
(87, 9, 'slumberjer@gmail.com', 1, 'paid', 'ryzyk3x0', '2022-06-09 21:54:11.116543'),
(88, 5, 'slumberjer@gmail.com', 2, 'paid', 'odt9fsg2', '2022-06-09 22:02:31.737958'),
(89, 7, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:34.821321'),
(90, 8, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:36.851368'),
(91, 6, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:38.635208'),
(92, 9, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:40.582943'),
(93, 10, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:42.550611'),
(94, 12, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:45.809803'),
(95, 13, 'slumberjer@gmail.com', 1, 'paid', 'odt9fsg2', '2022-06-09 22:02:47.910673'),
(96, 5, 'slumberjer@gmail.com', 1, 'paid', '8r3d40kx', '2022-06-09 22:05:03.832659'),
(97, 6, 'slumberjer@gmail.com', 1, 'paid', '8r3d40kx', '2022-06-09 22:05:06.258697'),
(98, 7, 'slumberjer@gmail.com', 1, 'paid', '8r3d40kx', '2022-06-09 22:05:08.016278'),
(99, 9, 'slumberjer@gmail.com', 1, 'paid', '8r3d40kx', '2022-06-09 22:05:11.044457'),
(100, 10, 'slumberjer@gmail.com', 1, 'paid', '8r3d40kx', '2022-06-09 22:05:12.919923'),
(101, 6, 'slumberjer@gmail.com', 1, 'paid', 'v0ulea5c', '2022-06-09 22:06:41.365149'),
(102, 5, 'slumberjer@gmail.com', 1, 'paid', 'v0ulea5c', '2022-06-09 22:06:43.264819'),
(103, 7, 'slumberjer@gmail.com', 1, 'paid', 'v0ulea5c', '2022-06-09 22:06:44.911904'),
(104, 9, 'slumberjer@gmail.com', 1, 'paid', 'v0ulea5c', '2022-06-09 22:06:46.946170'),
(105, 10, 'slumberjer@gmail.com', 1, 'paid', 'v0ulea5c', '2022-06-09 22:06:48.873257'),
(106, 13, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:06.825218'),
(107, 12, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:09.065841'),
(108, 20, 'slumberjer@gmail.com', 2, 'paid', '0juvg5dp', '2022-06-09 22:21:15.113437'),
(109, 16, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:17.618245'),
(110, 18, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:20.144251'),
(111, 23, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:22.577051'),
(112, 22, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:24.327428'),
(113, 21, 'slumberjer@gmail.com', 1, 'paid', '0juvg5dp', '2022-06-09 22:21:26.515250'),
(114, 52, 'slumberjer@gmail.com', 1, 'paid', 'dpjmnovd', '2022-06-10 07:04:53.633952'),
(115, 51, 'slumberjer@gmail.com', 1, 'paid', 'dpjmnovd', '2022-06-10 07:04:54.743177'),
(116, 50, 'slumberjer@gmail.com', 1, 'paid', 'dpjmnovd', '2022-06-10 07:04:57.513571'),
(117, 52, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:30.656384'),
(118, 46, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:34.649346'),
(119, 47, 'slumberjer@gmail.com', 2, 'paid', 'cd894n3u', '2022-06-10 09:28:35.548041'),
(120, 35, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:40.954717'),
(121, 36, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:41.888400'),
(122, 49, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:53.461971'),
(123, 42, 'slumberjer@gmail.com', 1, 'paid', 'cd894n3u', '2022-06-10 09:28:54.707999'),
(124, 38, 'slumberjer@gmail.com', 2, 'paid', 'qzogypbl', '2022-06-10 09:58:13.992944'),
(125, 34, 'slumberjer@gmail.com', 1, 'paid', 'qzogypbl', '2022-06-10 09:58:23.869176'),
(126, 4, 'slumberjer@gmail.com', 2, 'paid', 'qzogypbl', '2022-06-10 09:58:31.533259'),
(127, 36, 'slumberjer@gmail.com', 1, 'paid', 'qzogypbl', '2022-06-10 09:58:39.818257'),
(128, 37, 'slumberjer@gmail.com', 1, 'paid', 'qzogypbl', '2022-06-10 09:58:43.196778'),
(130, 49, 'slumberjer@gmail.com', 1, 'paid', 'qzogypbl', '2022-06-10 09:58:46.571052'),
(131, 50, 'slumberjer@gmail.com', 2, 'paid', 'niedvgj2', '2022-06-10 12:03:20.682483'),
(132, 36, 'slumberjer@gmail.com', 3, 'paid', 'niedvgj2', '2022-06-10 12:03:25.588291'),
(133, 16, 'slumberjer@gmail.com', 1, 'paid', 'niedvgj2', '2022-06-13 11:02:36.155041'),
(134, 28, 'slumberjer@gmail.com', 2, 'paid', 'sl07hrtq', '2022-06-13 12:41:11.303047'),
(135, 52, 'slumberjer@gmail.com', 1, 'paid', 'sl07hrtq', '2022-06-13 12:42:06.657973'),
(136, 50, 'slumberjer@gmail.com', 2, 'paid', 'quk0ceoc', '2022-06-13 13:36:38.371128'),
(137, 46, 'slumberjer@gmail.com', 1, 'paid', 'quk0ceoc', '2022-06-13 13:36:39.368966'),
(138, 25, 'slumberjer@gmail.com', 1, 'paid', 'quk0ceoc', '2022-06-13 14:22:50.086308'),
(139, 24, 'slumberjer@gmail.com', 1, 'paid', 'quk0ceoc', '2022-06-13 14:22:52.589583'),
(140, 21, 'slumberjer@gmail.com', 1, 'paid', 'quk0ceoc', '2022-06-13 14:22:53.989500'),
(141, 15, 'slumberjer@gmail.com', 1, 'paid', 'quk0ceoc', '2022-06-13 14:22:55.715810'),
(142, 29, 'slumberjer@gmail.com', 2, 'paid', '4l11dh0z', '2022-06-13 15:01:13.124838'),
(143, 32, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 15:01:19.306780'),
(144, 50, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 15:31:14.374353'),
(145, 36, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:14.709582'),
(146, 13, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:22.031791'),
(147, 18, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:24.010078'),
(148, 17, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:25.172123'),
(149, 19, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:26.832964'),
(150, 20, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:27.538497'),
(151, 22, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:29.156303'),
(152, 21, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:30.716613'),
(153, 24, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:32.242239'),
(154, 23, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:33.247405'),
(155, 25, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:34.235361'),
(156, 26, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:35.138367'),
(157, 5, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:39.643096'),
(158, 6, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:40.808968'),
(159, 8, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:43.040049'),
(160, 7, 'slumberjer@gmail.com', 1, 'paid', '4l11dh0z', '2022-06-13 21:28:44.737759'),
(161, 48, 'slumberjer@gmail.com', 1, 'paid', 'gkvyww7t', '2022-06-13 22:08:49.499602'),
(162, 51, 'slumberjer@gmail.com', 1, 'paid', 'gkvyww7t', '2022-06-13 23:00:33.342457'),
(163, 34, 'slumberjer@gmail.com', 1, 'paid', 'gkvyww7t', '2022-06-13 23:01:12.512747'),
(164, 33, 'slumberjer@gmail.com', 1, 'paid', 'gkvyww7t', '2022-06-13 23:01:15.736888'),
(165, 8, 'slumberjer@gmail.com', 1, 'paid', 'eghfdtg8', '2022-06-14 11:02:29.759844'),
(166, 4, 'slumberjer@gmail.com', 1, 'paid', 'eghfdtg8', '2022-06-14 11:02:36.327950'),
(167, 7, 'slumberjer@gmail.com', 2, 'paid', 'eghfdtg8', '2022-06-14 11:18:24.366322'),
(168, 43, 'slumberjer@gmail.com', 1, 'paid', '4qy6d8cm', '2022-06-14 11:45:51.256605'),
(169, 40, 'slumberjer@gmail.com', 1, 'paid', '4qy6d8cm', '2022-06-14 11:48:41.395526'),
(170, 46, 'slumberjer@gmail.com', 1, 'paid', '4qy6d8cm', '2022-06-14 14:26:25.303683'),
(171, 49, 'slumberjer@gmail.com', 1, 'paid', '4qy6d8cm', '2022-06-14 14:26:29.289000'),
(172, 9, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:53:27.133864'),
(173, 7, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:55:47.209494'),
(174, 8, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:55:53.506408'),
(175, 13, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:55:58.108075'),
(176, 10, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:56:08.125335'),
(177, 38, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 14:57:34.911522'),
(178, 42, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 15:02:53.261726'),
(179, 4, 'slumberjer@gmail.com', 1, 'paid', 'taqkxju3', '2022-06-14 15:13:46.627112'),
(181, 11, 'slumberjer@gmail.com', 3, 'paid', 'hensf980', '2022-06-14 16:16:33.535001'),
(182, 6, 'slumberjer@gmail.com', 2, 'paid', 'hensf980', '2022-06-14 16:31:29.211145'),
(183, 13, 'slumberjer@gmail.com', 2, 'paid', 'hensf980', '2022-06-14 16:53:14.393386'),
(184, 25, 'slumberjer@gmail.com', 3, 'paid', 'hensf980', '2022-06-14 16:53:18.761133'),
(185, 10, 'slumberjer@gmail.com', 1, 'paid', 'hensf980', '2022-06-14 17:50:10.749112'),
(186, 48, 'slumberjer@gmail.com', 1, 'paid', 'hensf980', '2022-06-14 20:44:57.105386'),
(187, 34, 'slumberjer@gmail.com', 1, 'paid', 'hensf980', '2022-06-15 13:40:53.131100'),
(188, 51, 'slumberjer@gmail.com', 1, NULL, NULL, '2022-06-17 19:10:37.969101'),
(189, 50, 'slumberjer@gmail.com', 1, NULL, NULL, '2022-06-17 19:10:39.816340'),
(190, 48, 'slumberjer@gmail.com', 1, NULL, NULL, '2022-06-17 19:10:41.420073');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(5) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_state` varchar(30) NOT NULL,
  `customer_address` varchar(300) NOT NULL,
  `customer_password` varchar(40) NOT NULL,
  `customer_otp` varchar(5) NOT NULL,
  `customer_credit` float NOT NULL,
  `customer_datereg` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_state`, `customer_address`, `customer_password`, `customer_otp`, `customer_credit`, `customer_datereg`) VALUES
(2, 'Yesaya', 'yesawa4851@lockaya.com', '60333428682', 'Pulau Pinang', '6 Ibu Pejabat Risda Jln Ampang Batu 4 1/2\r\nKuala Lumpur, Wilayah Persekutuan,\r\n50734 ', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '69920', 5, '2022-06-01 09:51:40.782327'),
(3, 'A. Hanis M. Shabli', 'slumberjer@gmail.com', '0124702493', 'Kedah', '597 Jalan Teja 21\nTaman Teja Fasa 2\n06010 Changlun', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '1', 5, '2022-06-02 13:09:32.457745');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(5) NOT NULL,
  `receipt_id` varchar(10) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `order_paid` float NOT NULL,
  `order_status` varchar(15) DEFAULT NULL,
  `order_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `receipt_id`, `customer_email`, `order_paid`, `order_status`, `order_date`) VALUES
(1, 'niedvgj2', 'slumberjer@gmail.com', 27.35, 'Paid', '2022-06-13 11:58:47.893094'),
(2, 'sl07hrtq', 'slumberjer@gmail.com', 23.6, 'Paid', '2022-06-13 13:08:57.856085'),
(3, 'quk0ceoc', 'slumberjer@gmail.com', 55.4, 'Paid', '2022-06-13 14:23:38.743745'),
(4, '4l11dh0z', 'slumberjer@gmail.com', 128.99, 'Paid', '2022-06-13 21:29:50.245980'),
(5, 'gkvyww7t', 'slumberjer@gmail.com', 26.49, 'Paid', '2022-06-13 23:01:35.414938'),
(6, 'eghfdtg8', 'slumberjer@gmail.com', 17.3, 'Paid', '2022-06-14 11:44:40.995509'),
(7, 'eghfdtg8', 'slumberjer@gmail.com', 17.3, 'Paid', '2022-06-14 11:44:57.812670'),
(8, '4qy6d8cm', 'slumberjer@gmail.com', 27.09, 'Paid', '2022-06-14 14:26:49.149822'),
(9, 'taqkxju3', 'slumberjer@gmail.com', 62.48, 'Paid', '2022-06-14 16:14:34.551545'),
(10, 'taqkxju3', 'slumberjer@gmail.com', 62.48, 'Paid', '2022-06-14 16:14:41.152564'),
(11, 'hensf980', 'slumberjer@gmail.com', 60.47, 'Paid', '2022-06-17 11:39:33.632059');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_desc` varchar(300) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_qty` int(5) NOT NULL,
  `product_price` float NOT NULL,
  `product_barcode` varchar(14) NOT NULL,
  `product_status` varchar(15) NOT NULL,
  `product_weight` varchar(5) DEFAULT NULL,
  `product_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_desc`, `product_type`, `product_qty`, `product_price`, `product_barcode`, `product_status`, `product_weight`, `product_date`) VALUES
(4, 'Cheezels Cheese', 'Enjoy with family and friends', 'Snack', 92, 2.8, '955607208005', 'available', NULL, '2022-05-26 17:39:25.532545'),
(5, 'Kurma Ajwa', 'Delicious and nutritious dates ', 'Dried Food', 23, 9.8, '9555632101119', 'available', NULL, '2022-05-26 17:42:17.016501'),
(6, 'Twisties Curry BBq', 'Corn snack with bbq curry flavour', 'Snack', 56, 2.8, '7622210270092', 'available', NULL, '2022-05-26 17:43:34.326049'),
(7, 'Aluminum Foil', '37.5 square feet aluminium foil ', 'Household', 92, 2.8, '4894514010817', 'available', NULL, '2022-05-26 17:44:56.307886'),
(8, 'Barnosz Popcorn', 'Totally coated extra caramel popcorn', 'Snack', 43, 8.9, '9555701014784', 'available', NULL, '2022-05-26 17:46:20.254530'),
(9, 'Pure Honey', 'pure honey ced with no added preservatives', 'Breakfast', 47, 12.5, '9557378002347', 'available', NULL, '2022-05-26 17:48:50.937110'),
(10, 'Bihun Kampung', 'Twenty bihun kampung 400 gram', 'Dried Food', 26, 1.8, '9555064200046', 'available', NULL, '2022-05-26 20:34:43.274600'),
(11, 'Mi Sedap', 'Wingsfood Singapore Laksa 83g x 5', 'Dried Food', 26, 4.3, '8998866501576', 'available', NULL, '2022-05-26 20:36:27.367645'),
(12, 'Tomato Paste ', 'San Remo tomato paste', 'Condiment', 47, 11.25, '9310155002042', 'available', NULL, '2022-05-26 20:38:00.465049'),
(13, 'Mushroom Cheese', 'Mushroom cheese bt Campbell with croutons', 'Condiment', 44, 3.79, '9556191061616', 'available', NULL, '2022-05-26 20:40:24.468737'),
(14, 'Pasta', 'Makarna pasta Tat', 'Dried Food', 28, 4.8, '8690325106017', 'available', NULL, '2022-05-26 20:42:52.767255'),
(15, 'Saji Cooking Oil', 'Saji cooking oil 5kg', 'Produce', 47, 25.5, '95575611004', 'available', NULL, '2022-05-26 20:44:35.484562'),
(16, 'Kobis Cameron', 'Kobis half from Cameron Highlands', 'Produce', 23, 3.75, '288225200370', 'available', NULL, '2022-05-26 20:46:16.635849'),
(17, 'Spreadable', 'Anchor dairy blend 200 g', 'Produce', 47, 12, '9415007044376', 'available', NULL, '2022-05-26 20:47:56.039613'),
(18, 'Chesdale', '6 slices chesdale', 'Dairy', 98, 7.6, '9415007000617', 'available', NULL, '2022-05-26 20:48:55.372772'),
(19, 'Chedar', 'Perfect pizza cheddar', 'Dairy', 22, 3.9, '9310052115104', 'available', NULL, '2022-05-26 20:50:04.054939'),
(20, 'Softlan', 'Softan Charcoal Soft 1.6l', 'Household', 17, 12.9, '9556031313622', 'available', NULL, '2022-05-26 20:51:20.273441'),
(21, 'Captain Oatmeal', 'Captains oatmeal 1kg', 'Breakfast', 17, 12.8, '9556183960750', 'available', NULL, '2022-05-26 20:52:39.997833'),
(22, 'Nona Sos Char', 'Nona sos char keayteaw 510g', 'Condiment', 48, 5.9, '9556277401015', 'available', NULL, '2022-05-26 20:53:56.545940'),
(23, 'Ridsect Advance', 'Ridsect 600ml two unit per set', 'Household', 48, 5.6, '9555222607311', 'available', NULL, '2022-05-26 20:56:06.331357'),
(24, 'Gula Prai', 'Coarse grain sugar 1kg', 'Produce', 48, 1.5, '9556058000031', 'available', NULL, '2022-05-26 20:58:21.721572'),
(25, 'Vermicelli', 'Premiere rice vermicelli low gi', 'Grains', 17, 4.5, '9557483590036', 'available', NULL, '2022-05-26 23:58:13.658859'),
(26, 'Strawberry Jam', 'Sedap Strawberry Jem', 'Breakfast', 49, 6.5, '9557277320474', 'available', NULL, '2022-05-27 00:00:20.209126'),
(27, 'Pepsi Bold', 'Pepsi zero', 'Beverage', 50, 3.5, '9556404120246', 'available', NULL, '2022-05-27 00:01:34.274261'),
(28, 'Sesame Paste', 'Fufan Sesame paste 250g ', 'Breakfast', 23, 8.6, '4714478302516', 'available', NULL, '2022-05-29 06:47:51.894109'),
(29, 'Pringles Sour', 'Pringles sour cream and onion', 'Snack', 48, 4.9, '8886467100024', 'available', NULL, '2022-05-29 06:49:34.325820'),
(30, 'Double mint Gum', 'Peppermint flavor', 'Miscellaneous', 50, 2.9, '9555192501909', 'available', NULL, '2022-05-30 10:11:51.960282'),
(31, 'Milo Whole Grain', 'Milo whole grain 36g', 'Breakfast', 50, 2.5, '9556001264596', 'available', NULL, '2022-05-30 10:13:06.686195'),
(32, 'Lipton Yellow Label', 'Lipton tea yellow label 50 bags', 'Beverage', 99, 8.9, '8888086022008', 'available', NULL, '2022-05-30 11:15:55.495346'),
(33, 'Vida ', 'Carbonated drinks lemon taste zero calories', 'Beverage', 23, 2.9, '9551001410295', 'available', NULL, '2022-05-30 11:17:35.299763'),
(34, 'Jade fragrance', 'Jade lavendar lasted 3000 sprays ', 'Household', 47, 4.8, '9555085407974', 'available', NULL, '2022-05-30 11:19:32.731135'),
(35, 'Drawer', 'Multipurpose drawer 4 layers', 'Household', 14, 30.5, '9555063901319', 'available', NULL, '2022-05-30 11:20:42.935078'),
(36, 'Hand sanitizer', '75% alcohol vased hand sanitizer', 'Household', 19, 5.6, '6925670136665', 'available', NULL, '2022-05-30 11:22:01.508134'),
(37, 'Tepung beras', 'Erawan brand 500g', 'Grains', 24, 4.5, '9556362050012', 'available', NULL, '2022-06-02 16:50:43.421239'),
(38, 'Beras Siam Super', '10kg Thai white rice super special', 'Grains', 6, 24.99, '4542484210026', 'available', NULL, '2022-06-02 16:52:17.293329'),
(39, 'Daisy corn oil', '5kg daisy corn oil', 'Miscellaneous', 15, 32.59, 'C18880955604', 'available', NULL, '2022-06-02 16:55:49.696377'),
(40, 'Mi Goreng Maggi', 'Dengan ikan bilis', 'Miscellaneous', 14, 5.9, '9556001276650', 'available', NULL, '2022-06-02 17:00:08.684930'),
(41, 'Pama Bihun', 'Bihun beras wangi pama', 'Dried Food', 15, 4.5, '9557128102327', 'available', NULL, '2022-06-02 17:01:48.986376'),
(42, 'Vitagen', '5 set ', 'Beverage', 7, 4.9, '9557305000088', 'available', NULL, '2022-06-02 17:03:38.823420'),
(43, 'Kacang Botor', 'lotul kacang botor', 'Vegetables', 9, 3.99, 'C18880955560', 'available', NULL, '2022-06-02 17:06:58.676427'),
(44, 'Serai', 'serai 10 btg', 'Vegetables', 15, 3.5, '9555604802143', 'available', NULL, '2022-06-02 17:07:53.185215'),
(45, 'Kobis bulat', 'per kg', 'Vegetables', 50, 3.25, '9555349101143', 'available', NULL, '2022-06-02 17:08:56.396254'),
(46, 'FnN Orange', '1.5 liter orange', 'Beverage', 12, 4.3, 'C18880955657', 'available', NULL, '2022-06-02 17:11:21.066556'),
(47, 'Mushroom Oyster', 'Grey oyster mushroom', 'Vegetables', 13, 3.5, '9557288100126', 'available', NULL, '2022-06-02 17:12:35.334776'),
(48, 'Froot Loops', 'Kellogs fruit loops', 'Breakfast', 11, 14.29, '8852756304046', 'available', NULL, '2022-06-02 17:14:17.602001'),
(49, 'Creamy latte', 'NescafÃ© creamy latte 12 sticks', 'Beverage', 9, 12.9, '9556001271624', 'available', NULL, '2022-06-02 17:16:45.649830'),
(50, 'Butterscotch Cheese', 'Butterscotch Cheese bun 160g', 'Bread', 4, 3.4, '9556996333208', 'available', NULL, '2022-06-08 14:09:36.202317'),
(51, 'Cheese Sugar Bun', 'Mighty white cheese sugar bun', 'Bread', 13, 4.5, '9556996333215', 'available', NULL, '2022-06-08 14:10:31.503410'),
(52, 'Ambi pur Room', 'relaxing lavender', 'Household', 47, 6.4, '955607601267', 'available', NULL, '2022-06-08 14:12:41.150073');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
