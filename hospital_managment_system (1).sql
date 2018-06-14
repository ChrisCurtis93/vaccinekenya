-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 09:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_managment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_counties`
--

CREATE TABLE `tb_counties` (
  `county_id` int(11) NOT NULL,
  `county_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_counties`
--

INSERT INTO `tb_counties` (`county_id`, `county_name`) VALUES
(1, 'Mombasa'),
(2, 'Kwale'),
(3, 'Kilifi'),
(4, 'Tana River'),
(5, 'Lamu'),
(6, 'Taita-Taveta'),
(7, 'Garissa'),
(8, 'Wajir'),
(9, 'Mandera'),
(10, 'Marsabit'),
(11, 'Isiolo'),
(12, 'Meru'),
(13, 'Tharaka-Nithi'),
(14, 'Embu'),
(15, 'Kitui'),
(16, 'Machakos'),
(17, 'Makueni'),
(18, 'Nyandarua'),
(19, 'Nyeri'),
(20, 'Kirinyaga'),
(21, 'Murang''a'),
(22, 'Kiambu'),
(23, 'Turkana'),
(24, 'West Pokot'),
(25, 'Samburu'),
(26, 'Trans-Nzoia'),
(27, 'Uasin Gishu'),
(28, 'Elgeyo-Marakwet'),
(29, 'Nandi'),
(30, 'Baringo'),
(31, 'Laikipia'),
(32, 'Nakuru'),
(33, 'Narok'),
(34, 'Kajiado'),
(35, 'Kericho'),
(36, 'Bomet'),
(37, 'Kakamega');

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventory_stocks_in`
--

CREATE TABLE `tb_inventory_stocks_in` (
  `stock_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantity_moved` int(11) NOT NULL,
  `movement_by` int(11) NOT NULL,
  `date_of_movement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventory_stocks_out`
--

CREATE TABLE `tb_inventory_stocks_out` (
  `stock_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantity_moved` int(11) NOT NULL,
  `movement_by` int(11) NOT NULL,
  `date_of_movement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventory_vaccines`
--

CREATE TABLE `tb_inventory_vaccines` (
  `vaccine_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders`
--

CREATE TABLE `tb_orders` (
  `order_id` int(11) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `processed_by` int(11) NOT NULL,
  `waiting_type` int(11) NOT NULL,
  `date_of_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders_waiting_type`
--

CREATE TABLE `tb_orders_waiting_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_items`
--

CREATE TABLE `tb_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `active_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users_admins`
--

CREATE TABLE `tb_users_admins` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users_admins`
--

INSERT INTO `tb_users_admins` (`user_id`, `username`, `email`, `password`, `active_status`) VALUES
(1, 'Admin', 'admin@admin.com', '700c8b805a3e2a265b01c77614cd8b21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users_hospitals`
--

CREATE TABLE `tb_users_hospitals` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(50) NOT NULL,
  `person_in_charge_name` varchar(50) NOT NULL,
  `hospital_county` int(11) NOT NULL,
  `hospital_email` varchar(100) NOT NULL,
  `hospital_password` varchar(100) NOT NULL,
  `hospital_phonenumber` int(11) NOT NULL,
  `active_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_counties`
--
ALTER TABLE `tb_counties`
  ADD PRIMARY KEY (`county_id`);

--
-- Indexes for table `tb_inventory_stocks_in`
--
ALTER TABLE `tb_inventory_stocks_in`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `tb_inventory_stocks_out`
--
ALTER TABLE `tb_inventory_stocks_out`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tb_inventory_vaccines`
--
ALTER TABLE `tb_inventory_vaccines`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- Indexes for table `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_orders_waiting_type`
--
ALTER TABLE `tb_orders_waiting_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tb_order_items`
--
ALTER TABLE `tb_order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `tb_users_admins`
--
ALTER TABLE `tb_users_admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_users_hospitals`
--
ALTER TABLE `tb_users_hospitals`
  ADD PRIMARY KEY (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_counties`
--
ALTER TABLE `tb_counties`
  MODIFY `county_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tb_inventory_stocks_in`
--
ALTER TABLE `tb_inventory_stocks_in`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_inventory_stocks_out`
--
ALTER TABLE `tb_inventory_stocks_out`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_inventory_vaccines`
--
ALTER TABLE `tb_inventory_vaccines`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_orders_waiting_type`
--
ALTER TABLE `tb_orders_waiting_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_order_items`
--
ALTER TABLE `tb_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users_admins`
--
ALTER TABLE `tb_users_admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_users_hospitals`
--
ALTER TABLE `tb_users_hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
