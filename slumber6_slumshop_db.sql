-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2022 at 07:24 AM
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
  `cart_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`cart_id`, `product_id`, `customer_email`, `cart_qty`, `cart_date`) VALUES
(14, 5, 'slumberjer@gmail.com', 4, '2022-06-04 20:28:17.351724'),
(16, 6, 'slumberjer@gmail.com', 1, '2022-06-04 20:30:15.520591'),
(17, 10, 'slumberjer@gmail.com', 3, '2022-06-04 20:33:55.482700');

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
(3, 'Ahmad Hanis Mohd Shabli', 'slumberjer@gmail.com', '0194702493', 'Kedah', '597 Jalan Teja 21\nTaman Teja Fasa 2\n06010 Changlun', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '1', 5, '2022-06-02 13:09:32.457745');

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
  `product_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_desc`, `product_type`, `product_qty`, `product_price`, `product_barcode`, `product_status`, `product_date`) VALUES
(4, 'Cheezels Cheese', 'Enjoy with family and friends', 'Snack', 100, 2.8, '955607208005', 'available', '2022-05-26 17:39:25.532545'),
(5, 'Kurma Ajwa', 'Delicious and nutritious dates ', 'Dried Food', 25, 9.8, '9555632101119', 'available', '2022-05-26 17:42:17.016501'),
(6, 'Twisties Curry BBq', 'Corn snack with bbq curry flavour', 'Snack', 60, 2.8, '7622210270092', 'available', '2022-05-26 17:43:34.326049'),
(7, 'Aluminum Foil', '37.5 square feet aluminium foil ', 'Household', 100, 2.8, '4894514010817', 'available', '2022-05-26 17:44:56.307886'),
(8, 'Barnosz Popcorn', 'Totally coated extra caramel popcorn', 'Snack', 50, 8.9, '9555701014784', 'available', '2022-05-26 17:46:20.254530'),
(9, 'Pure Honey', 'pure honey ced with no added preservatives', 'Breakfast', 50, 12.5, '9557378002347', 'available', '2022-05-26 17:48:50.937110'),
(10, 'Bihun Kampung', 'Twenty bihun kampung 400 gram', 'Dried Food', 30, 1.8, '9555064200046', 'available', '2022-05-26 20:34:43.274600'),
(11, 'Mi Sedap', 'Wingsfood Singapore Laksa 83g x 5', 'Dried Food', 30, 4.3, '8998866501576', 'available', '2022-05-26 20:36:27.367645'),
(12, 'Tomato Paste ', 'San Remo tomato paste', 'Condiment', 50, 11.25, '9310155002042', 'available', '2022-05-26 20:38:00.465049'),
(13, 'Mushroom Cheese', 'Mushroom cheese bt Campbell with croutons', 'Condiment', 50, 3.79, '9556191061616', 'available', '2022-05-26 20:40:24.468737'),
(14, 'Pasta', 'Makarna pasta Tat', 'Dried Food', 30, 4.8, '8690325106017', 'available', '2022-05-26 20:42:52.767255'),
(15, 'Saji Cooking Oil', 'Saji cooking oil 5kg', 'Produce', 50, 25.5, '95575611004', 'available', '2022-05-26 20:44:35.484562'),
(16, 'Kobis Cameron', 'Kobis half from Cameron Highlands', 'Produce', 25, 3.75, '288225200370', 'available', '2022-05-26 20:46:16.635849'),
(17, 'Spreadable', 'Anchor dairy blend 200 g', 'Produce', 50, 12, '9415007044376', 'available', '2022-05-26 20:47:56.039613'),
(18, 'Chesdale', '6 slices chesdale', 'Dairy', 100, 7.6, '9415007000617', 'available', '2022-05-26 20:48:55.372772'),
(19, 'Chedar', 'Perfect pizza cheddar', 'Dairy', 25, 3.9, '9310052115104', 'available', '2022-05-26 20:50:04.054939'),
(20, 'Softlan', 'Softan Charcoal Soft 1.6l', 'Household', 20, 12.9, '9556031313622', 'available', '2022-05-26 20:51:20.273441'),
(21, 'Captain Oatmeal', 'Captains oatmeal 1kg', 'Breakfast', 20, 12.8, '9556183960750', 'available', '2022-05-26 20:52:39.997833'),
(22, 'Nona Sos Char', 'Nona sos char keayteaw 510g', 'Condiment', 50, 5.9, '9556277401015', 'available', '2022-05-26 20:53:56.545940'),
(23, 'Ridsect Advance', 'Ridsect 600ml two unit per set', 'Household', 50, 5.6, '9555222607311', 'available', '2022-05-26 20:56:06.331357'),
(24, 'Gula Prai', 'Coarse grain sugar 1kg', 'Produce', 50, 1.5, '9556058000031', 'available', '2022-05-26 20:58:21.721572'),
(25, 'Vermicelli', 'Premiere rice vermicelli low gi', 'Grains', 25, 4.5, '9557483590036', 'available', '2022-05-26 23:58:13.658859'),
(26, 'Strawberry Jam', 'Sedap Strawberry Jem', 'Breakfast', 50, 6.5, '9557277320474', 'available', '2022-05-27 00:00:20.209126'),
(27, 'Pepsi Bold', 'Pepsi zero', 'Beverage', 50, 3.5, '9556404120246', 'available', '2022-05-27 00:01:34.274261'),
(28, 'Sesame Paste', 'Fufan Sesame paste 250g ', 'Breakfast', 25, 8.6, '4714478302516', 'available', '2022-05-29 06:47:51.894109'),
(29, 'Pringles Sour', 'Pringles sour cream and onion', 'Snack', 50, 4.9, '8886467100024', 'available', '2022-05-29 06:49:34.325820'),
(30, 'Double mint Gum', 'Peppermint flavor', 'Miscellaneous', 50, 2.9, '9555192501909', 'available', '2022-05-30 10:11:51.960282'),
(31, 'Milo Whole Grain', 'Milo whole grain 36g', 'Breakfast', 50, 2.5, '9556001264596', 'available', '2022-05-30 10:13:06.686195'),
(32, 'Lipton Yellow Label', 'Lipton tea yellow label 50 bags', 'Beverage', 100, 8.9, '8888086022008', 'available', '2022-05-30 11:15:55.495346'),
(33, 'Vida ', 'Carbonated drinks lemon taste zero calories', 'Beverage', 25, 2.9, '9551001410295', 'available', '2022-05-30 11:17:35.299763'),
(34, 'Jade fragrance', 'Jade lavendar lasted 3000 sprays ', 'Household', 50, 4.8, '9555085407974', 'available', '2022-05-30 11:19:32.731135'),
(35, 'Drawer', 'Multipurpose drawer 4 layers', 'Household', 15, 30.5, '9555063901319', 'available', '2022-05-30 11:20:42.935078'),
(36, 'Hand sanitizer', '75% alcohol vased hand sanitizer', 'Household', 25, 5.6, '6925670136665', 'available', '2022-05-30 11:22:01.508134'),
(37, 'Tepung beras', 'Erawan brand 500g', 'Grains', 25, 4.5, '9556362050012', 'available', '2022-06-02 16:50:43.421239'),
(38, 'Beras Siam Super', '10kg Thai white rice super special', 'Grains', 10, 24.99, '4542484210026', 'available', '2022-06-02 16:52:17.293329'),
(39, 'Daisy corn oil', '5kg daisy corn oil', 'Miscellaneous', 15, 32.59, 'C18880955604', 'available', '2022-06-02 16:55:49.696377'),
(40, 'Mi Goreng Maggi', 'Dengan ikan bilis', 'Miscellaneous', 15, 5.9, '9556001276650', 'available', '2022-06-02 17:00:08.684930'),
(41, 'Pama Bihun', 'Bihun beras wangi pama', 'Dried Food', 15, 4.5, '9557128102327', 'available', '2022-06-02 17:01:48.986376'),
(42, 'Vitagen', '5 set ', 'Beverage', 10, 4.9, '9557305000088', 'available', '2022-06-02 17:03:38.823420'),
(43, 'Kacang Botor', 'lotul kacang botor', 'Vegetables', 10, 3.99, 'C18880955560', 'available', '2022-06-02 17:06:58.676427'),
(44, 'Serai', 'serai 10 btg', 'Vegetables', 15, 3.5, '9555604802143', 'available', '2022-06-02 17:07:53.185215'),
(45, 'Kobis bulat', 'per kg', 'Vegetables', 50, 3.25, '9555349101143', 'available', '2022-06-02 17:08:56.396254'),
(46, 'FnN Orange', '1.5 liter orange', 'Beverage', 15, 4.3, 'C18880955657', 'available', '2022-06-02 17:11:21.066556'),
(47, 'Mushroom Oyster', 'Grey oyster mushroom', 'Vegetables', 15, 3.5, '9557288100126', 'available', '2022-06-02 17:12:35.334776'),
(48, 'Froot Loops', 'Kellogs fruit loops', 'Breakfast', 15, 14.29, '8852756304046', 'available', '2022-06-02 17:14:17.602001'),
(49, 'Creamy latte', 'NescafÃ© creamy latte 12 sticks', 'Beverage', 15, 12.9, '9556001271624', 'available', '2022-06-02 17:16:45.649830');

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
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
