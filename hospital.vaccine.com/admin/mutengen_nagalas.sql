-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2017 at 07:31 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mutengen_nagalas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`mutengen`@`localhost` PROCEDURE `pb_app_createmenu`(IN `_userdepartmentid` INT(100))
    NO SQL
BEGIN
DECLARE _count INT;
DECLARE _tempmenuid INT DEFAULT 0;
DECLARE _tempmenuname VARCHAR(50);
DECLARE _tempmeicon VARCHAR(50);
DECLARE _temppriorityvalue INT DEFAULT 0;
SET _count = (SELECT COUNT(DISTINCT(MenuID)) FROM pb_app_menuusers WHERE DepartmentID = _userdepartmentid ORDER BY MenuID);
DROP TABLE IF EXISTS _tempmenu;
CREATE TEMPORARY TABLE IF NOT EXISTS _tempmenu (tempmenuid INT, tempmenuname VARCHAR(50), tempicon VARCHAR(50), temppriorityvalue INT);
WHILE _count > 0 DO
SET _tempmenuid = (SELECT MenuID FROM pb_app_menuusers WHERE MenuID > _tempmenuid AND DepartmentID = _userdepartmentid ORDER BY MenuID LIMIT 1);
SET _tempmenuname = (SELECT Menu FROM pb_app_menu WHERE MenuID = _tempmenuid);
SET _temppriorityvalue = (SELECT priorityvalue FROM pb_app_menu WHERE MenuID = _tempmenuid);
SET _tempmeicon = (SELECT Icon FROM pb_app_menu WHERE MenuID = _tempmenuid);
INSERT INTO _tempmenu (tempmenuid, tempmenuname, tempicon, temppriorityvalue) values (_tempmenuid, _tempmenuname, _tempmeicon, _temppriorityvalue);
SET _count = _count - 1;
END WHILE;
SELECT tempmenuid AS Id, tempmenuname AS Menu, tempicon AS Icon FROM _tempmenu  ORDER BY temppriorityvalue;
END$$

CREATE DEFINER=`mutengen`@`localhost` PROCEDURE `pb_app_createsubmenu`(IN `_userdepartmentid` INT(100), IN `_menuid` INT(100))
    NO SQL
BEGIN
DECLARE _count INT;
DECLARE _tempmenulistid INT DEFAULT 0;
DECLARE _tempmenulistname VARCHAR(50);
DECLARE _tempfilename VARCHAR(50);
SET _count = (SELECT COUNT(DISTINCT(MenuListID)) FROM pb_app_menuusers WHERE DepartmentID = _userdepartmentid AND MenuID = _menuid ORDER BY MenuListID);
DROP TABLE IF EXISTS _tempmenulist;
CREATE TEMPORARY TABLE IF NOT EXISTS _tempmenulist (tempmenulistid INT, tempmenulistname VARCHAR(50), tempfilename VARCHAR(50));
WHILE _count > 0 DO
SET _tempmenulistid = (SELECT MenuListID FROM pb_app_menuusers WHERE MenuListID > _tempmenulistid AND MenuID = _menuid AND DepartmentID = _userdepartmentid ORDER BY MenuListID LIMIT 1);
SET _tempmenulistname = (SELECT MenuListName FROM pb_app_menulist WHERE MenuListID = _tempmenulistid);
SET _tempfilename = (SELECT FileName FROM pb_app_menulist WHERE MenuListID = _tempmenulistid);
INSERT INTO _tempmenulist (tempmenulistid, tempmenulistname, tempfilename) values (_tempmenulistid, _tempmenulistname, _tempfilename);
SET _count = _count - 1;
END WHILE;
SELECT tempmenulistid AS Id, tempmenulistname AS SubMenu, tempfilename AS FileName FROM _tempmenulist;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_code` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_code`) VALUES
(1, 'Gateway', 'gate-way'),
(2, '2 Rivers', '2-riv');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
  `menu_category_id` int(11) NOT NULL,
  `menu_category_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menu_category_id`, `menu_category_name`) VALUES
(1, 'Vegeterian'),
(2, 'Non-Vegeterian'),
(3, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category_submenu`
--

CREATE TABLE IF NOT EXISTS `menu_category_submenu` (
  `main_menu_sub_id` int(11) NOT NULL,
  `main_menu_sub_name` varchar(50) NOT NULL,
  `menu_category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category_submenu`
--

INSERT INTO `menu_category_submenu` (`main_menu_sub_id`, `main_menu_sub_name`, `menu_category_id`) VALUES
(1, 'Bitings', 2),
(2, 'Soups', 2),
(3, 'Fast Meal', 2),
(4, 'Salad', 2),
(5, 'Fruits Salad', 2),
(6, 'Wraps', 2),
(7, 'Meals', 2),
(8, 'Bitings', 1),
(9, 'Soups', 1),
(10, 'Meals', 1),
(11, 'Noodles', 1),
(12, 'Seafood', 2),
(13, 'Soft drinks', 3),
(14, 'Fresh juice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `menu_item_id` int(11) NOT NULL,
  `menu_item_name` varchar(50) NOT NULL,
  `sub_menu_item_id` int(11) NOT NULL,
  `main_menu_sub_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `item_description` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_item_id`, `menu_item_name`, `sub_menu_item_id`, `main_menu_sub_id`, `price`, `item_description`) VALUES
(1, 'Chicken Drumstick', 0, 3, 450, 'chicken drumsticks, onion in garlic sauce or dry pan fried'),
(2, 'Sundry Honey Beef', 0, 3, 450, 'shredded beef, onions, green pepper ,garlicand honey drops in dry sauce'),
(3, 'Chicken Drumstick', 0, 3, 450, 'chicken drumsticks, onion in garlic sauce or dry pan fried'),
(4, 'Sundry Honey Beef', 0, 3, 450, 'shredded beef, onions, green pepper ,garlicand honey drops in dry sauce'),
(5, 'Stir fried paneer ', 0, 3, 400, 'paneer, onions, green pepper, carrots, stirred with garlic'),
(6, 'Thai terrayaki chicken salad', 0, 4, 350, 'lettuce, cucumber, carrots, tomatoes, seasoning with mayonaise'),
(7, 'Sea food light and refreshing', 0, 4, 500, 'lettuce, cucumber, carrots, tomatoes both prawns and fish with lemon juice in ginger and garlic saucee'),
(8, 'Sweet corn vegetable salad', 0, 4, 350, 'lettuce, cucumber, carrots, tomatoes, sweet corn seasoning with mayonaise'),
(9, 'Fruit Salad', 0, 5, 350, 'Mango, Banana, Watermelon, Avacodo, with Yogurt and NUTS'),
(10, 'Fruit Salad', 0, 6, 450, 'lettuce, cucumber, wrapped with marinated chicken in chapati'),
(11, 'Fruit Salad', 0, 6, 450, 'lettuce, cucumber, tomatoes wrapped with sweet and sour chicken in a chapati'),
(12, 'Fruit Salad', 0, 6, 450, 'lettuce, cucumber, tomatoes wrapped with ginger and garlic chicken in chapati'),
(13, 'Fruit Salad', 0, 6, 600, 'lettuce, cucumber, tomatoes wrapped with ginger and garlic chicken in chapati'),
(14, 'Chicken springrolls', 0, 1, 65, ''),
(15, 'Chicken wings', 0, 1, 450, ''),
(16, 'Chicken satay', 0, 1, 450, ''),
(17, 'Beef Satay', 0, 1, 450, ''),
(18, 'Pork spareribs', 0, 1, 450, ''),
(19, 'Dry chilli fish', 0, 1, 495, ''),
(20, 'Dry garlic prawns', 0, 1, 595, ''),
(21, 'Golden fried prawns', 0, 1, 595, ''),
(22, 'Chicken Dumblings', 0, 1, 400, ''),
(23, 'Seafood Dumplings', 0, 1, 500, ''),
(24, 'Mushroom Dumplings', 0, 1, 400, ''),
(25, 'Hot and sour chicken soup', 0, 2, 300, ''),
(26, 'Sweet corn chicken soup', 0, 2, 300, ''),
(27, 'Chicken noodles soup', 0, 2, 350, ''),
(28, 'Chicken mushroom soup', 0, 2, 300, ''),
(29, 'Wontons soup', 0, 2, 400, ''),
(30, 'Seafood soup', 0, 2, 600, ''),
(31, 'Kung Pao chicken', 3, 0, 650, 'Diced chicken, stir fried with carrots, green peppers, red bullet chillies, onions and cashew nuts'),
(32, 'Chilli chicken', 3, 0, 650, 'Diced boneless chicken stir fried with bullet chillies, onions in garlic sauce'),
(33, 'Thai Chicken Curry(Green or Red or Yellow)', 3, 0, 650, 'Cubed Chicken coconut powder with some vegetables in garlic sauce'),
(34, 'Chicken Szhechuan', 3, 0, 650, 'Boneless chicken, stir fried with green peppers, carrots and onions'),
(35, 'Chicken mushroom', 3, 0, 650, 'Boneless chicken, fresh button mushrooms and onions'),
(36, 'Dry garlic chicken', 3, 0, 650, 'Dry fried boneless chicken in extra garlic and red onions'),
(37, 'Sweet and sour chicken', 3, 0, 650, 'Butter fried cubes of chicken stir fried with carrots, green pepper and onions in sweet and sour sauce.'),
(38, 'Chicken Bambooshoots and green pepper', 3, 0, 650, 'Stir fried cubes of bonelss chicken green pepper and bamboo shoots.'),
(39, 'Shanghai chicken', 3, 0, 650, 'Shredded chicken, carrots, green pepper, red bullet chillies and onions.'),
(40, 'Ginger chicken', 3, 0, 650, 'Diced pieces of boneless chicken,onions in ginger sauce.'),
(41, 'Kung Pao beef', 4, 0, 650, 'Soft beef fillet, stir fried with carrots, green peppers, red bullet chillies, onion and cashewnuts'),
(42, 'Chilly Beef', 4, 0, 650, 'Beef, stirfried with bullet chillies and onions in ginger garlic sauce.'),
(43, 'Beef Szhechuan', 4, 0, 650, 'Diced beef, stir fried with green peppers, carrots and onions'),
(44, 'Dry garlic Beef', 4, 0, 650, 'Dry fried beef with extra garlic and onions'),
(45, 'Beef mushrooms', 4, 0, 650, 'Beef with fresh button mushrooms and onions'),
(46, 'Shanghai beef', 4, 0, 650, 'Strips of beef fillet, carrots, green pepper, onions and red bullet chillies.'),
(47, 'Beef ginger', 4, 0, 650, 'Beef and onions in ginger sauce'),
(48, 'Chilly Beef', 4, 0, 650, 'Beef, stirfried with bullet chillies and onions in ginger garlic sauce.'),
(49, 'Beef brocolli', 4, 0, 650, 'Beef with fresh brocolli and onions'),
(50, 'Beef Oyster', 4, 0, 650, 'Stir fried beef with onions in oyster sauce'),
(51, 'Beef in black bean sauce', 4, 0, 650, 'Stir fried beef with onions, carrots and chinese cabbagee in black bean sauce.'),
(52, 'Kung Pao pork', 5, 0, 650, 'Shredded pork with carrots, green peppers, red bullet chillies, onion and cashewnuts'),
(53, 'Chilly Pork', 5, 0, 650, 'Pork,  stirfried with bullet chillies and onions in ginger garlic sauce.'),
(54, 'Pork Szhechuan', 5, 0, 650, 'Pork, stir fried with green peppers, carrots and onions'),
(55, 'Dry garlic Pork,', 5, 0, 650, 'Dry fried Pork, with extra garlic and onions'),
(56, 'Pork mushrooms', 5, 0, 650, 'Shredded pork with fresh button mushrooms and onions'),
(57, 'Shanghai Pork', 5, 0, 650, 'Shredded pork with carrots, green pepper, onions and red bullet chillies.'),
(58, 'Pork in black bean sauce', 5, 0, 650, 'Pork with onions, carrots and chinese cabbagee in black bean sauce.'),
(59, 'Sweet and sour pork', 5, 0, 650, 'Butter fried pork stir fried with carrots, green pepper and onions in sweet and sour sauce.'),
(60, 'Vegetable springrolls', 0, 8, 60, ''),
(61, 'Butter fried baby corn', 0, 8, 450, ''),
(62, 'Butter fried mushroom', 0, 8, 450, ''),
(63, 'Ladyfinger in pepper salt', 0, 8, 450, ''),
(64, 'Vegetable Satay', 0, 8, 450, ''),
(65, 'Hot and sour vegetable soup', 0, 9, 300, ''),
(66, 'Sweet corn vegetable soup', 0, 9, 300, ''),
(67, 'Mushroom vegetable soup', 0, 9, 300, ''),
(68, 'Vegetables noodle soup', 0, 9, 350, ''),
(69, 'Chilli corn Szhechuan', 0, 10, 600, 'Corn, carrots,green peppers and onion in Szhechuan sauce'),
(70, 'Chilli Baby corn', 0, 10, 600, 'Baby corn, bullet chillies, onions in garlic sauce.'),
(71, 'Mixed Vegetable in Deason', 0, 10, 600, 'Assorted vegetables, e.g. brocolli carrots, snowpeas, cauliflower, french beans, chinese cabbage and green pepper'),
(72, 'Mushroom/bean sprouts and bambooshoots', 0, 10, 600, 'Stirfried mushrooms, beans sprouts and bambooshoots in garlic soya sauce.'),
(73, 'Hot spiced vegetables', 0, 10, 600, 'Mixed vegetables in Szhechuan spicy sauce.'),
(74, 'Chilli Baby corn', 0, 10, 600, 'Baby corn, bullet chillies, onions in garlic sauce.'),
(75, 'Bean curd with vegetables', 0, 10, 600, 'cubes of bean curd with assorted vegetables in garlic sauce'),
(76, 'Chilli fried mushrooms', 0, 10, 600, 'Fresh button mushrooms stirfried with onions and bullet chillies..'),
(77, 'Vegetable Manchurian', 0, 10, 600, 'Chooped vegetables moulded into balls and stirfried in our special spicy sauce.'),
(78, 'Sweet and sour vegetables', 0, 10, 600, 'Assorted vegetables cooked in sweet and sour sauce'),
(79, 'Chicken Chowmein', 10, 0, 550, 'Fried noodles with chicken, shredded carrots, green peppers, chinese cabbage and onions'),
(80, 'Beef Chowmein', 10, 0, 550, 'Fried noodles with beef, shredded carrots, green peppers, chinese cabbage and onions'),
(81, 'Chicken Chowmein', 10, 0, 550, 'Fried noodles with shredded pork, shredded carrots, green peppers, chinese cabbage and onions'),
(82, '', 0, 0, 0, ''),
(83, 'Vegetable Chowmein', 12, 0, 500, 'Noodles with shredded assorted vegetables'),
(84, 'Plain Chowmein', 12, 0, 400, 'Plain fried noodles'),
(85, 'Chilli garlic noodles', 12, 0, 500, 'Hot spiced noodles with extra spicy garlic'),
(86, 'Shanghai Chowmein', 10, 0, 600, 'Crispy fried noodles with gravy of your choice on top e.g. chicken/beef/pork or vegetable and cashewnuts.'),
(87, 'Hot spiced vegetable noodles', 12, 0, 550, 'Soft noodles with mixed vegetables and red bullet chillies.'),
(88, 'Vegetable Chowmein', 12, 0, 500, 'Noodles with shredded assorted vegetables'),
(89, 'Plain Chowmein', 12, 0, 400, 'Plain fried noodles'),
(90, 'Chilli garlic noodles', 12, 0, 500, 'Hot spiced noodles with extra spicy garlic'),
(91, 'Shanghai Chowmein', 10, 0, 600, 'Crispy fried noodles with gravy of your choice on top e.g. chicken/beef/pork or vegetable and cashewnuts.'),
(92, 'Hot spiced vegetable noodles', 12, 0, 550, 'Soft noodles with mixed vegetables and red bullet chillies.'),
(93, 'Fish fillet in soy sauce', 7, 0, 680, ''),
(94, 'sweet and sour fish', 7, 0, 680, ''),
(95, 'Chilli fish', 7, 0, 680, ''),
(96, 'Dry garlic fish', 7, 0, 680, ''),
(97, 'Fish in spring onions', 7, 0, 680, ''),
(98, 'Fish in ginger sauce', 7, 0, 680, ''),
(99, 'Fish vegetables (assorted)', 7, 0, 680, ''),
(100, 'Chilli fried prawns', 12, 0, 795, ''),
(101, 'Prawns in Szhechuan sauce', 12, 0, 795, ''),
(102, 'Prawns in hot bean sauce', 12, 0, 795, ''),
(103, 'Sweet and sour prawns', 12, 0, 795, ''),
(104, 'Special finese prawns', 12, 0, 795, ''),
(105, 'Chicken fried rice', 6, 0, 500, ''),
(106, 'Beef fried rice', 6, 0, 500, ''),
(107, 'Pork fried rice', 6, 0, 500, ''),
(108, 'Vegetable fried rice', 13, 0, 300, ''),
(109, 'Young chow rice', 13, 0, 595, ''),
(110, 'Egg fried rice', 6, 0, 350, ''),
(111, 'Plain fried rice', 13, 0, 250, ''),
(112, 'Stewed rice', 13, 0, 200, ''),
(113, 'Sizzling chicken', 8, 0, 750, ''),
(114, 'Sizzling beef', 8, 0, 750, ''),
(115, 'Sizzling pork', 8, 0, 750, ''),
(116, 'Sizzling fish', 8, 0, 750, ''),
(117, 'Sizzling prawns', 8, 0, 895, ''),
(118, 'plain chips', 11, 0, 120, ''),
(119, 'special garlic chips', 11, 0, 250, ''),
(120, 'special massala chips', 11, 0, 200, ''),
(121, 'special possion chips', 11, 0, 250, ''),
(122, 'special shanghai chips', 11, 0, 300, ''),
(123, 'Soda 300ml', 0, 13, 70, ''),
(124, 'Soda 500ml', 0, 13, 100, ''),
(125, 'Diet coke 300ml', 0, 13, 80, ''),
(126, 'Diet Coke 500ml', 0, 13, 130, ''),
(127, 'Tonic water 300ml', 0, 13, 100, ''),
(128, 'Tonic water 500ml', 0, 13, 130, ''),
(129, 'Mineral water 500ml', 0, 13, 80, ''),
(130, 'Mineral water 1ltr', 0, 13, 150, ''),
(131, 'Sparkling water 300ml', 0, 13, 100, ''),
(132, 'Mango juice 300ml', 0, 14, 150, ''),
(133, 'Mango juice 500ml', 0, 14, 200, ''),
(134, 'Passion juice  300ml', 0, 14, 150, ''),
(135, 'Passion juice  500ml', 0, 14, 200, ''),
(136, 'Tree tomato  300ml', 0, 14, 150, ''),
(137, 'Tree Tomato 500ml', 0, 14, 200, ''),
(138, 'Orange juice  300ml', 0, 14, 150, ''),
(139, 'Orange juice  500ml', 0, 14, 200, ''),
(140, 'Cocktail  300ml', 0, 14, 150, ''),
(141, 'Cocktail  500ml', 0, 14, 200, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id_no` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `order time` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=277 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id_no`, `order_id`, `user_id`, `branch_id`, `order time`) VALUES
(119, 11933243, 3, 1, '2017-05-25 05:33:24'),
(118, 11831483, 3, 1, '2017-05-25 05:31:48'),
(117, 11729143, 3, 1, '2017-05-25 05:29:14'),
(116, 11618433, 3, 1, '2017-05-25 05:18:44'),
(115, 11517103, 3, 1, '2017-05-25 05:17:10'),
(114, 11428382, 2, 1, '2017-05-24 23:28:38'),
(113, 11328132, 2, 1, '2017-05-24 15:28:13'),
(112, 11206163, 3, 1, '2017-05-24 11:06:16'),
(111, 11105353, 3, 1, '2017-05-24 11:05:35'),
(110, 11003493, 3, 1, '2017-05-24 11:03:49'),
(109, 10930303, 3, 1, '2017-05-24 07:30:30'),
(108, 10829353, 3, 1, '2017-05-24 07:29:35'),
(107, 10720253, 3, 1, '2017-05-24 07:20:25'),
(106, 10618583, 3, 1, '2017-05-24 07:18:58'),
(105, 10504093, 3, 1, '2017-05-24 07:04:09'),
(104, 10452233, 3, 1, '2017-05-24 06:52:23'),
(103, 10348143, 3, 1, '2017-05-24 06:48:14'),
(102, 10233473, 3, 1, '2017-05-24 06:33:47'),
(101, 10100433, 3, 1, '2017-05-24 06:00:43'),
(100, 10035343, 3, 1, '2017-05-24 05:35:34'),
(99, 9924233, 3, 1, '2017-05-24 05:24:23'),
(98, 9822103, 3, 1, '2017-05-24 05:22:10'),
(97, 9717563, 3, 1, '2017-05-24 05:17:56'),
(96, 9616202, 2, 1, '2017-05-24 05:16:20'),
(95, 9508043, 3, 1, '2017-05-24 05:08:04'),
(94, 9402132, 2, 1, '2017-05-24 05:02:13'),
(93, 9301162, 2, 1, '2017-05-24 05:01:16'),
(92, 100511, 1, 1, '2017-05-24 05:00:51'),
(120, 12034593, 3, 1, '2017-05-25 05:34:59'),
(121, 12127303, 3, 1, '2017-05-25 06:27:30'),
(122, 12242563, 3, 1, '2017-05-25 06:42:56'),
(123, 12351343, 3, 1, '2017-05-25 06:51:34'),
(124, 12459093, 3, 1, '2017-05-25 06:59:09'),
(125, 12520343, 3, 1, '2017-05-25 07:20:34'),
(126, 12621313, 3, 1, '2017-05-25 07:21:31'),
(127, 12746483, 3, 1, '2017-05-25 07:46:48'),
(128, 12848322, 2, 1, '2017-05-25 07:48:32'),
(129, 12935152, 2, 1, '2017-05-25 08:35:15'),
(130, 13056152, 2, 1, '2017-05-25 08:56:15'),
(131, 13147222, 2, 1, '2017-05-25 10:47:22'),
(132, 13252372, 2, 1, '2017-05-25 10:52:37'),
(133, 13302302, 2, 1, '2017-05-25 11:02:30'),
(134, 13402422, 2, 1, '2017-05-25 11:02:42'),
(135, 13513172, 2, 1, '2017-05-25 11:13:17'),
(136, 13650382, 2, 1, '2017-05-25 11:50:38'),
(137, 13718492, 2, 1, '2017-05-25 12:18:49'),
(138, 13832542, 2, 1, '2017-05-25 12:32:54'),
(139, 13902372, 2, 1, '2017-05-25 13:02:37'),
(140, 14020202, 2, 1, '2017-05-25 13:20:20'),
(141, 14131002, 2, 1, '2017-05-25 13:31:00'),
(142, 14209052, 2, 1, '2017-05-26 04:09:06'),
(143, 14311432, 2, 1, '2017-05-26 04:11:43'),
(144, 14420493, 3, 1, '2017-05-26 04:20:49'),
(145, 14548283, 3, 1, '2017-05-26 04:48:28'),
(146, 14649353, 3, 1, '2017-05-26 04:49:35'),
(147, 14728563, 3, 1, '2017-05-26 05:28:56'),
(148, 14811313, 3, 1, '2017-05-26 06:11:31'),
(149, 14912173, 3, 1, '2017-05-26 06:12:17'),
(150, 15014093, 3, 1, '2017-05-26 06:14:09'),
(151, 15115003, 3, 1, '2017-05-26 06:15:00'),
(152, 15215203, 3, 1, '2017-05-26 06:15:20'),
(153, 15337073, 3, 1, '2017-05-26 06:37:07'),
(154, 15441013, 3, 1, '2017-05-26 06:41:01'),
(155, 15541483, 3, 1, '2017-05-26 06:41:48'),
(156, 15645013, 3, 1, '2017-05-26 06:45:01'),
(157, 15731173, 3, 1, '2017-05-26 07:31:18'),
(158, 15833082, 2, 1, '2017-05-26 07:33:08'),
(159, 15938422, 2, 1, '2017-05-26 07:38:42'),
(160, 16052113, 3, 1, '2017-05-26 07:52:11'),
(161, 16141243, 3, 1, '2017-05-26 08:41:24'),
(162, 16217572, 2, 1, '2017-05-27 04:17:57'),
(163, 16318352, 2, 1, '2017-05-27 04:18:35'),
(164, 16454493, 3, 1, '2017-05-27 04:54:49'),
(165, 16555193, 3, 1, '2017-05-27 04:55:19'),
(166, 16619503, 3, 1, '2017-05-27 06:19:50'),
(167, 16720263, 3, 1, '2017-05-27 06:20:26'),
(168, 16858063, 3, 1, '2017-05-28 05:58:07'),
(169, 16959063, 3, 1, '2017-05-28 05:59:06'),
(170, 17059213, 3, 1, '2017-05-28 05:59:21'),
(171, 17100112, 2, 1, '2017-05-28 06:00:11'),
(172, 17208473, 3, 1, '2017-05-28 06:08:47'),
(173, 17337173, 3, 1, '2017-05-28 06:37:17'),
(174, 17412353, 3, 1, '2017-05-28 07:12:35'),
(175, 17527323, 3, 1, '2017-05-28 07:27:32'),
(176, 17631563, 3, 1, '2017-05-28 07:31:56'),
(177, 17728463, 3, 1, '2017-05-28 08:28:46'),
(178, 17829083, 3, 1, '2017-05-28 08:29:08'),
(179, 17929383, 3, 1, '2017-05-28 08:29:38'),
(180, 18038253, 3, 1, '2017-05-28 08:38:25'),
(181, 18130542, 2, 1, '2017-05-28 09:30:54'),
(182, 18246433, 3, 1, '2017-05-28 11:46:43'),
(183, 18348352, 2, 1, '2017-05-28 11:48:35'),
(184, 18450582, 2, 1, '2017-05-28 11:50:58'),
(185, 18552442, 2, 2, '2017-05-28 11:52:44'),
(186, 18624242, 2, 0, '2017-05-29 00:24:24'),
(187, 18700303, 3, 1, '2017-05-29 12:00:30'),
(188, 18802063, 3, 1, '2017-05-29 12:02:06'),
(189, 18902243, 3, 1, '2017-05-29 12:02:24'),
(190, 19017203, 3, 1, '2017-05-29 12:17:20'),
(191, 19120373, 3, 1, '2017-05-29 12:20:37'),
(192, 19225213, 3, 1, '2017-05-29 12:25:21'),
(193, 19344133, 3, 1, '2017-05-29 12:44:13'),
(194, 19453003, 3, 1, '2017-05-30 04:53:00'),
(195, 19554303, 3, 1, '2017-05-30 04:54:30'),
(196, 19602293, 3, 0, '2017-05-31 00:02:29'),
(197, 19743553, 3, 1, '2017-05-31 03:43:55'),
(198, 19817063, 3, 1, '2017-05-31 04:17:06'),
(199, 19930153, 3, 1, '2017-05-31 04:30:15'),
(200, 20030223, 3, 1, '2017-05-31 04:30:22'),
(201, 20103203, 3, 1, '2017-05-31 05:03:20'),
(202, 20207493, 3, 1, '2017-05-31 05:07:49'),
(203, 20310423, 3, 1, '2017-05-31 05:10:42'),
(204, 20412523, 3, 1, '2017-05-31 05:12:52'),
(205, 20515482, 2, 2, '2017-05-31 05:15:48'),
(206, 20617253, 3, 1, '2017-05-31 05:17:25'),
(207, 20729453, 3, 1, '2017-05-31 05:29:45'),
(208, 20849253, 3, 1, '2017-05-31 05:49:25'),
(209, 20959233, 3, 1, '2017-05-31 05:59:23'),
(210, 21003203, 3, 1, '2017-05-31 06:03:20'),
(211, 21106433, 3, 1, '2017-05-31 06:06:43'),
(212, 21223423, 3, 1, '2017-05-31 09:23:42'),
(213, 21332273, 3, 1, '2017-05-31 11:32:27'),
(214, 21407493, 3, 1, '2017-05-31 12:07:49'),
(215, 21512083, 3, 1, '2017-05-31 12:12:08'),
(216, 21614443, 3, 1, '2017-05-31 12:14:44'),
(217, 21724593, 3, 1, '2017-05-31 12:24:59'),
(218, 21856573, 3, 1, '2017-06-01 03:56:57'),
(219, 21900033, 3, 1, '2017-06-01 08:00:03'),
(220, 22048373, 3, 1, '2017-06-01 10:48:37'),
(221, 22104053, 3, 1, '2017-06-01 11:04:05'),
(222, 22205533, 3, 1, '2017-06-01 11:05:53'),
(223, 22306123, 3, 1, '2017-06-01 11:06:12'),
(224, 22441072, 2, 0, '2017-06-02 03:41:07'),
(225, 22534423, 3, 1, '2017-06-03 07:34:42'),
(226, 22627063, 3, 1, '2017-06-04 10:27:06'),
(227, 22727393, 3, 1, '2017-06-04 10:27:39'),
(228, 22812443, 3, 1, '2017-06-04 11:12:44'),
(229, 22916063, 3, 1, '2017-06-04 11:16:06'),
(230, 23021173, 3, 1, '2017-06-04 11:21:17'),
(231, 23153443, 3, 1, '2017-06-04 11:53:44'),
(232, 23204173, 3, 1, '2017-06-04 12:04:17'),
(233, 23314563, 3, 1, '2017-06-04 12:14:56'),
(234, 23415273, 3, 1, '2017-06-04 12:15:27'),
(235, 23528453, 3, 1, '2017-06-04 12:28:45'),
(236, 23631313, 3, 1, '2017-06-04 13:31:31'),
(237, 23744283, 3, 1, '2017-06-04 13:44:28'),
(238, 23844293, 3, 1, '2017-06-04 13:44:29'),
(239, 23953193, 3, 1, '2017-06-04 13:53:19'),
(240, 24058173, 3, 1, '2017-06-04 13:58:17'),
(241, 24103303, 3, 1, '2017-06-04 14:03:30'),
(242, 24209013, 3, 1, '2017-06-04 14:09:01'),
(243, 24312513, 3, 1, '2017-06-04 14:12:51'),
(244, 24417533, 3, 1, '2017-06-04 14:17:53'),
(245, 24519183, 3, 1, '2017-06-04 14:19:18'),
(246, 24629283, 3, 1, '2017-06-04 14:29:28'),
(247, 24732573, 3, 1, '2017-06-04 14:32:57'),
(248, 24833313, 3, 1, '2017-06-04 14:33:31'),
(249, 24934023, 3, 1, '2017-06-04 14:34:02'),
(250, 25041123, 3, 1, '2017-06-04 14:41:12'),
(251, 25118103, 3, 1, '2017-06-04 15:18:10'),
(252, 25221343, 3, 1, '2017-06-04 15:21:34'),
(253, 25308012, 2, 0, '2017-06-05 01:08:01'),
(254, 25439542, 2, 0, '2017-06-05 01:39:54'),
(255, 25543142, 2, 0, '2017-06-05 01:43:14'),
(256, 25643212, 2, 0, '2017-06-05 01:43:21'),
(257, 25743282, 2, 0, '2017-06-05 01:43:28'),
(258, 25844082, 2, 0, '2017-06-05 01:44:08'),
(259, 25946332, 2, 0, '2017-06-05 01:46:33'),
(260, 26047562, 2, 0, '2017-06-05 01:47:56'),
(261, 26152052, 2, 0, '2017-06-05 01:52:05'),
(262, 26209212, 2, 0, '2017-06-05 03:09:21'),
(263, 26308433, 3, 1, '2017-06-08 13:08:43'),
(264, 26411333, 3, 1, '2017-06-08 13:11:33'),
(265, 26519063, 3, 1, '2017-06-08 13:19:06'),
(266, 26642353, 3, 1, '2017-06-10 10:42:35'),
(267, 26746313, 3, 0, '2017-06-10 10:46:31'),
(268, 26848503, 3, 1, '2017-06-10 10:48:50'),
(269, 26958463, 3, 1, '2017-06-10 11:58:46'),
(270, 27058243, 3, 1, '2017-06-10 12:58:24'),
(271, 27102033, 3, 1, '2017-06-11 04:02:03'),
(272, 27251163, 3, 1, '2017-06-12 03:51:16'),
(273, 27302573, 3, 1, '2017-06-12 04:02:57'),
(274, 27411373, 3, 1, '2017-06-12 11:11:37'),
(275, 27511593, 3, 1, '2017-06-12 11:11:59'),
(276, 27612113, 3, 1, '2017-06-12 11:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `menu_item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=535 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `menu_item_id`) VALUES
(170, 8939193, 60),
(171, 9042133, 60),
(172, 9508043, 60),
(173, 9717563, 60),
(174, 9822103, 34),
(175, 9924233, 123),
(176, 10035343, 65),
(177, 10035343, 61),
(178, 10100433, 60),
(179, 10618583, 60),
(180, 10720253, 101),
(181, 10720253, 102),
(182, 11003493, 34),
(183, 11206163, 9),
(184, 11328132, 21),
(185, 11328132, 7),
(186, 11328132, 127),
(187, 11428382, 60),
(188, 11428382, 60),
(189, 11428382, 60),
(190, 11428382, 61),
(191, 11428382, 62),
(192, 11428382, 62),
(193, 11517103, 60),
(194, 11517103, 61),
(195, 11517103, 60),
(196, 11618433, 60),
(197, 11618433, 61),
(198, 11618433, 61),
(199, 11618433, 61),
(200, 11729143, 119),
(201, 11729143, 120),
(202, 11831483, 11),
(203, 11933243, 43),
(204, 11933243, 120),
(205, 12242563, 65),
(206, 12351343, 60),
(207, 12351343, 60),
(208, 12351343, 60),
(209, 12351343, 61),
(210, 12351343, 61),
(211, 12351343, 61),
(212, 12351343, 62),
(213, 12351343, 62),
(214, 12459093, 60),
(215, 12459093, 61),
(216, 12459093, 62),
(217, 12520343, 60),
(218, 12520343, 61),
(219, 12520343, 62),
(220, 12520343, 62),
(221, 12621313, 60),
(222, 12621313, 61),
(223, 12746483, 60),
(224, 12746483, 61),
(225, 12746483, 62),
(226, 12746483, 62),
(227, 12746483, 61),
(228, 12746483, 123),
(229, 12746483, 123),
(230, 12746483, 124),
(231, 12935152, 60),
(232, 12935152, 61),
(233, 12935152, 62),
(234, 13056152, 123),
(235, 13056152, 124),
(236, 13056152, 124),
(237, 13056152, 124),
(238, 13056152, 129),
(239, 13147222, 60),
(240, 13147222, 61),
(241, 13147222, 61),
(242, 13147222, 118),
(243, 13252372, 61),
(244, 13252372, 61),
(245, 13252372, 62),
(246, 13302302, 61),
(247, 13513172, 123),
(248, 13513172, 123),
(249, 13513172, 123),
(250, 13650382, 60),
(251, 13650382, 61),
(252, 13650382, 62),
(253, 13650382, 63),
(254, 13650382, 62),
(255, 13718492, 60),
(256, 13718492, 61),
(257, 13718492, 61),
(258, 13718492, 60),
(259, 13832542, 14),
(260, 13832542, 15),
(261, 13832542, 15),
(262, 13902372, 60),
(263, 13902372, 60),
(264, 13902372, 60),
(265, 13902372, 60),
(266, 13902372, 60),
(267, 13902372, 61),
(268, 13902372, 62),
(269, 13902372, 63),
(270, 13902372, 63),
(271, 13902372, 22),
(272, 13902372, 21),
(273, 13902372, 20),
(274, 13902372, 9),
(275, 13902372, 95),
(276, 13902372, 96),
(277, 13902372, 97),
(278, 13902372, 94),
(279, 13902372, 93),
(280, 13902372, 114),
(281, 13902372, 115),
(282, 13902372, 116),
(283, 13902372, 117),
(284, 14020202, 60),
(285, 14020202, 61),
(286, 14020202, 62),
(287, 14020202, 63),
(288, 14020202, 64),
(289, 14131002, 60),
(290, 14131002, 63),
(291, 14131002, 63),
(292, 14131002, 63),
(293, 14209052, 110),
(294, 14209052, 106),
(295, 14311432, 12),
(296, 14311432, 13),
(297, 14420493, 60),
(299, 14548283, 15),
(300, 14649353, 62),
(301, 14649353, 64),
(302, 14728563, 10),
(303, 14728563, 13),
(304, 15337073, 41),
(305, 15441013, 2),
(306, 15441013, 4),
(307, 15541483, 7),
(308, 15541483, 8),
(309, 15645013, 25),
(310, 15645013, 30),
(311, 15645013, 31),
(312, 15645013, 36),
(313, 15833082, 106),
(314, 15833082, 105),
(315, 15833082, 107),
(316, 15833082, 110),
(317, 15938422, 25),
(318, 15938422, 28),
(319, 15938422, 30),
(320, 15938422, 32),
(321, 15938422, 34),
(322, 15938422, 36),
(323, 15938422, 31),
(324, 15938422, 6),
(325, 15938422, 8),
(326, 16052113, 119),
(327, 16052113, 121),
(328, 16217572, 60),
(329, 16217572, 61),
(330, 16217572, 61),
(331, 16318352, 65),
(332, 16318352, 66),
(333, 16217572, 123),
(334, 16217572, 124),
(335, 10035343, 61),
(336, 10035343, 60),
(337, 10035343, 61),
(338, 16720263, 60),
(339, 16720263, 61),
(340, 16720263, 123),
(341, 16720263, 124),
(342, 10035343, 61),
(343, 17059213, 38),
(344, 17059213, 7),
(345, 17100112, 118),
(346, 17100112, 119),
(347, 17100112, 119),
(348, 17059213, 7),
(349, 17100112, 135),
(350, 17100112, 135),
(351, 17100112, 140),
(352, 17208473, 61),
(353, 17208473, 61),
(354, 17208473, 132),
(355, 17208473, 132),
(356, 17337173, 66),
(357, 17412353, 60),
(358, 17412353, 60),
(359, 17412353, 60),
(360, 17527323, 7),
(361, 17527323, 9),
(362, 17527323, 9),
(363, 17527323, 9),
(364, 17527323, 9),
(365, 17527323, 9),
(366, 17527323, 9),
(367, 17527323, 9),
(368, 17527323, 9),
(369, 17527323, 9),
(370, 17527323, 9),
(371, 17631563, 61),
(373, 17728463, 61),
(374, 17829083, 15),
(375, 17829083, 15),
(376, 17829083, 16),
(377, 17929383, 14),
(378, 17929383, 15),
(379, 17929383, 15),
(380, 121, 16),
(381, 121, 17),
(382, 18130542, 119),
(383, 18130542, 120),
(384, 122, 123),
(385, 122, 124),
(386, 18246433, 32),
(387, 18348352, 62),
(388, 18450582, 64),
(389, 18552442, 133),
(390, 18624242, 44),
(391, 18624242, 123),
(392, 18700303, 123),
(393, 18700303, 123),
(394, 18902243, 60),
(395, 18902243, 60),
(396, 18902243, 61),
(397, 19017203, 124),
(398, 19017203, 125),
(399, 19120373, 14),
(400, 19120373, 15),
(401, 19225213, 132),
(402, 19225213, 133),
(403, 19225213, 132),
(404, 19225213, 133),
(405, 19344133, 133),
(406, 19453003, 60),
(407, 141, 66),
(408, 141, 133),
(409, 141, 134),
(410, 141, 136),
(411, 19743553, 118),
(412, 19743553, 119),
(413, 19743553, 120),
(414, 19743553, 61),
(415, 19817063, 32),
(416, 19817063, 33),
(417, 19817063, 35),
(418, 20030223, 100),
(419, 20103203, 41),
(420, 20103203, 44),
(421, 20103203, 42),
(422, 20103203, 46),
(423, 20207493, 32),
(424, 20207493, 37),
(425, 20207493, 37),
(426, 20207493, 42),
(427, 20207493, 45),
(428, 20207493, 45),
(429, 20207493, 45),
(430, 20310423, 106),
(431, 20310423, 107),
(432, 20310423, 36),
(433, 20310423, 36),
(434, 20310423, 36),
(435, 20310423, 25),
(436, 20412523, 36),
(437, 20412523, 36),
(438, 20412523, 35),
(439, 20515482, 12),
(440, 20617253, 25),
(441, 20617253, 26),
(442, 20617253, 27),
(443, 20617253, 42),
(444, 20515482, 93),
(445, 149, 1),
(446, 148, 6),
(447, 148, 8),
(448, 20729453, 14),
(449, 20729453, 15),
(450, 20849253, 61),
(451, 20849253, 64),
(452, 20959233, 133),
(453, 21106433, 132),
(454, 21106433, 133),
(455, 21106433, 134),
(456, 21223423, 14),
(457, 21223423, 15),
(458, 21223423, 17),
(459, 21223423, 80),
(460, 21332273, 31),
(461, 21332273, 32),
(462, 21407493, 123),
(463, 21512083, 60),
(464, 21614443, 120),
(465, 21724593, 10),
(466, 21724593, 13),
(467, 21900033, 62),
(468, 22048373, 128),
(469, 22104053, 111),
(470, 22104053, 111),
(471, 22205533, 134),
(472, 22306123, 118),
(473, 22441072, 9),
(474, 22534423, 32),
(475, 22534423, 34),
(476, 22727393, 32),
(477, 22727393, 35),
(478, 22812443, 123),
(479, 22916063, 93),
(480, 23021173, 119),
(481, 23153443, 135),
(482, 23204173, 133),
(483, 23415273, 31),
(484, 23528453, 109),
(485, 23631313, 134),
(486, 23744283, 3),
(487, 23844293, 124),
(488, 23953193, 133),
(489, 24058173, 134),
(490, 24312513, 135),
(491, 24417533, 133),
(492, 24519183, 119),
(493, 24629283, 12),
(494, 24732573, 13),
(495, 24833313, 66),
(496, 24833313, 68),
(497, 24934023, 121),
(498, 24934023, 118),
(499, 25118103, 94),
(500, 26308433, 60),
(501, 26308433, 64),
(502, 26308433, 64),
(503, 26308433, 65),
(504, 26308433, 68),
(505, 26308433, 83),
(506, 26308433, 101),
(507, 26308433, 101),
(508, 26411333, 31),
(509, 26411333, 33),
(510, 26411333, 33),
(511, 26411333, 14),
(512, 26519063, 1),
(513, 26519063, 5),
(514, 26519063, 5),
(515, 26519063, 93),
(516, 26519063, 95),
(517, 26519063, 97),
(518, 26642353, 31),
(519, 26642353, 33),
(520, 26746313, 25),
(521, 26746313, 26),
(522, 26746313, 26),
(523, 26848503, 121),
(524, 26958463, 106),
(525, 26958463, 107),
(526, 204, 7),
(527, 27058243, 14),
(528, 27058243, 15),
(529, 27102033, 140),
(530, 27251163, 65),
(531, 27251163, 68),
(532, 27302573, 14),
(533, 27302573, 19),
(534, 27302573, 17);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_status`
--

CREATE TABLE IF NOT EXISTS `order_payment_status` (
  `payment_status_id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `amount_given` int(11) NOT NULL,
  `cashout_time` datetime NOT NULL,
  `closed_status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_payment_status`
--

INSERT INTO `order_payment_status` (`payment_status_id`, `order_id`, `status`, `user_id`, `checkout_time`, `amount`, `amount_given`, `cashout_time`, `closed_status`) VALUES
(66, 10035343, 'PAID', 6, '2017-05-24 05:57:08', 2160, 3000, '2017-05-27 06:24:35', 1),
(67, 10035343, 'PAID', 6, '2017-05-24 05:57:58', 2160, 3000, '2017-05-27 06:24:35', 1),
(68, 10100433, 'PAID', 0, '2017-05-24 06:00:53', 60, 100, '2017-05-24 06:27:33', 1),
(69, 10618583, 'PAID', 0, '2017-05-24 07:19:21', 60, 0, '2017-05-24 15:26:21', 1),
(70, 11003493, 'PAID', 0, '2017-05-24 11:04:35', 650, 0, '2017-05-24 15:27:09', 1),
(71, 11206163, 'PAID', 0, '2017-05-24 11:06:51', 350, 350, '2017-05-25 05:15:07', 1),
(72, 11328132, 'PAID', 6, '2017-05-24 15:29:22', 1195, 1200, '2017-05-25 05:11:43', 1),
(73, 11428382, 'PAID', 6, '2017-05-24 23:28:59', 1530, 0, '2017-05-24 23:30:01', 1),
(74, 11517103, 'PAID', 0, '2017-05-25 05:17:29', 570, 600, '2017-05-25 05:17:42', 1),
(75, 11618433, 'PAID', 0, '2017-05-25 05:19:00', 1410, 1500, '2017-05-25 05:22:29', 1),
(76, 11729143, 'PAID', 0, '2017-05-25 05:29:44', 450, 500, '2017-05-25 05:34:57', 1),
(77, 11933243, 'PAID', 7, '2017-05-25 05:33:55', 1700, 1700, '2017-05-25 06:10:43', 1),
(78, 11933243, 'PAID', 0, '2017-05-25 05:34:38', 1700, 1700, '2017-05-25 06:10:43', 1),
(79, 12242563, 'PAID', 0, '2017-05-25 06:43:05', 300, 300, '2017-05-25 06:43:31', 1),
(80, 12351343, 'PAID', 0, '2017-05-25 06:51:48', 2430, 2500, '2017-05-25 06:56:07', 1),
(81, 12459093, 'PAID', 0, '2017-05-25 06:59:25', 960, 1000, '2017-05-25 07:10:45', 1),
(82, 12621313, 'PAID', 6, '2017-05-25 07:21:45', 510, 600, '2017-05-25 07:31:14', 1),
(83, 12746483, 'PAID', 6, '2017-05-25 07:47:26', 2100, 2100, '2017-05-25 07:50:54', 1),
(84, 12935152, 'PAID', 0, '2017-05-25 08:36:02', 960, 1000, '2017-05-25 08:37:05', 1),
(85, 13056152, 'PAID', 7, '2017-05-25 08:57:05', 450, 500, '2017-05-25 08:57:31', 1),
(86, 13147222, 'PAID', 6, '2017-05-25 10:47:48', 1080, 2000, '2017-05-25 10:48:24', 1),
(87, 13252372, 'PAID', 6, '2017-05-25 10:52:51', 1350, 1500, '2017-05-25 10:59:25', 1),
(88, 13302302, 'PAID', 6, '2017-05-25 11:02:39', 450, 500, '2017-05-25 11:02:59', 1),
(89, 13513172, 'PAID', 6, '2017-05-25 11:13:34', 210, 250, '2017-05-25 11:21:27', 1),
(90, 13650382, 'PAID', 6, '2017-05-25 11:50:56', 1860, 2000, '2017-05-25 11:52:58', 1),
(91, 13718492, 'PAID', 6, '2017-05-25 12:19:00', 1020, 1100, '2017-05-25 12:20:21', 1),
(92, 13832542, 'PAID', 6, '2017-05-25 12:33:28', 965, 1000, '2017-05-25 12:48:38', 1),
(93, 13902372, 'PAID', 6, '2017-05-25 13:04:07', 10585, 11000, '2017-05-25 13:18:07', 1),
(94, 14020202, 'PAID', 6, '2017-05-25 13:20:32', 1860, 2000, '2017-05-25 13:21:17', 1),
(95, 14131002, 'PAID', 6, '2017-05-25 13:31:24', 1410, 1410, '2017-05-25 13:33:46', 1),
(96, 14311432, 'PAID', 6, '2017-05-26 04:12:56', 2100, 2200, '2017-05-26 04:15:35', 1),
(97, 14311432, 'PAID', 6, '2017-05-26 04:13:15', 2100, 2200, '2017-05-26 04:15:35', 1),
(98, 14420493, 'PAID', 6, '2017-05-26 04:22:25', 60, 500, '2017-05-26 04:25:12', 1),
(99, 14548283, 'PAID', 6, '2017-05-26 04:48:51', 450, 500, '2017-05-26 05:25:39', 1),
(100, 14649353, 'PAID', 6, '2017-05-26 04:50:21', 900, 1000, '2017-05-26 05:28:09', 1),
(101, 14728563, 'PAID', 6, '2017-05-26 05:29:11', 1050, 1200, '2017-05-26 05:29:35', 1),
(102, 15337073, 'PAID', 6, '2017-05-26 06:37:50', 650, 700, '2017-05-26 06:38:07', 1),
(103, 15541483, 'PAID', 6, '2017-05-26 06:42:05', 850, 900, '2017-05-26 06:43:16', 1),
(104, 15645013, 'PAID', 6, '2017-05-26 06:46:01', 2200, 2500, '2017-05-26 07:50:43', 1),
(105, 15833082, 'PAID', 6, '2017-05-26 07:36:17', 1850, 2000, '2017-05-26 07:49:55', 1),
(106, 15938422, 'PAID', 6, '2017-05-26 07:39:44', 4500, 5000, '2017-05-26 07:42:58', 1),
(107, 16052113, 'PAID', 6, '2017-05-26 07:52:36', 500, 500, '2017-05-26 07:53:30', 1),
(108, 16217572, 'PAID', 6, '2017-05-27 04:18:22', 2260, 2300, '2017-05-27 06:25:17', 1),
(109, 16318352, 'PAID', 6, '2017-05-27 04:18:58', 600, 600, '2017-05-27 06:28:49', 1),
(110, 16217572, 'PAID', 6, '2017-05-27 04:28:42', 2260, 2300, '2017-05-27 06:25:17', 1),
(111, 16720263, 'PAID', 6, '2017-05-27 06:20:43', 680, 700, '2017-05-27 07:48:31', 1),
(112, 17100112, 'PAID', 6, '2017-05-28 06:01:06', 1170, 1200, '2017-05-28 06:04:12', 1),
(113, 17208473, 'PAID', 6, '2017-05-28 06:09:34', 1200, 1500, '2017-05-28 06:09:56', 1),
(114, 17337173, 'PAID', 6, '2017-05-28 06:37:26', 300, 1500, '2017-05-28 06:40:59', 1),
(115, 17412353, 'PAID', 6, '2017-05-28 07:12:47', 180, 200, '2017-05-28 07:13:33', 1),
(116, 17728463, 'PAID', 6, '2017-05-28 08:29:04', 450, 450, '2017-05-28 14:26:35', 1),
(117, 17829083, 'PAID', 6, '2017-05-28 08:29:35', 1350, 1400, '2017-05-29 12:06:18', 1),
(118, 17929383, 'PAID', 6, '2017-05-28 08:37:03', 1930, 2000, '2017-05-30 04:59:34', 1),
(119, 17929383, 'PAID', 6, '2017-05-28 08:38:21', 1930, 2000, '2017-05-30 04:59:34', 1),
(120, 18130542, 'PAID', 6, '2017-05-28 09:32:28', 450, 450, '2017-05-30 05:00:06', 1),
(121, 18246433, 'PAID', 6, '2017-05-28 11:47:07', 650, 650, '2017-05-30 05:00:48', 1),
(122, 18348352, 'PAID', 6, '2017-05-28 11:48:49', 450, 500, '2017-05-30 05:04:48', 1),
(123, 18450582, 'PAID', 6, '2017-05-28 11:51:17', 450, 450, '2017-05-30 05:04:23', 1),
(124, 18552442, 'UNPAID', 0, '2017-05-28 11:53:26', 0, 0, '0000-00-00 00:00:00', 0),
(125, 18624242, 'UNPAID', 0, '2017-05-29 00:25:19', 0, 0, '0000-00-00 00:00:00', 0),
(126, 18700303, 'PAID', 6, '2017-05-29 12:00:57', 140, 200, '2017-05-30 05:04:11', 1),
(127, 18902243, 'PAID', 6, '2017-05-29 12:02:40', 570, 570, '2017-05-30 05:03:11', 1),
(128, 19017203, 'PAID', 6, '2017-05-29 12:17:55', 540, 600, '2017-05-30 05:02:48', 1),
(129, 19017203, 'PAID', 6, '2017-05-29 12:18:41', 540, 600, '2017-05-30 05:02:48', 1),
(130, 19017203, 'PAID', 6, '2017-05-29 12:19:15', 540, 600, '2017-05-30 05:02:48', 1),
(131, 19120373, 'PAID', 6, '2017-05-29 12:20:59', 1030, 1030, '2017-05-30 05:02:08', 1),
(132, 19120373, 'PAID', 6, '2017-05-29 12:24:08', 1030, 1030, '2017-05-30 05:02:08', 1),
(133, 19225213, 'PAID', 6, '2017-05-29 12:25:53', 3500, 3500, '2017-05-30 05:01:40', 1),
(134, 19225213, 'PAID', 6, '2017-05-29 12:28:54', 3500, 3500, '2017-05-30 05:01:40', 1),
(135, 19225213, 'PAID', 6, '2017-05-29 12:29:43', 3500, 3500, '2017-05-30 05:01:40', 1),
(136, 19225213, 'PAID', 6, '2017-05-29 12:30:34', 3500, 3500, '2017-05-30 05:01:40', 1),
(137, 19225213, 'PAID', 6, '2017-05-29 12:31:07', 3500, 3500, '2017-05-30 05:01:40', 1),
(138, 19344133, 'PAID', 6, '2017-05-29 12:44:43', 200, 200, '2017-05-30 05:01:28', 1),
(139, 19453003, 'PAID', 6, '2017-05-30 04:53:21', 60, 60, '2017-05-30 05:01:12', 1),
(140, 19743553, 'PAID', 6, '2017-05-31 03:46:12', 3060, 3100, '2017-05-31 03:51:05', 1),
(141, 19743553, 'PAID', 6, '2017-05-31 03:46:40', 3060, 3100, '2017-05-31 03:51:05', 1),
(142, 19743553, 'PAID', 6, '2017-05-31 03:47:05', 3060, 3100, '2017-05-31 03:51:05', 1),
(143, 19817063, 'PAID', 6, '2017-05-31 04:17:57', 1950, 2000, '2017-05-31 04:20:56', 1),
(144, 20030223, 'PAID', 6, '2017-05-31 04:34:57', 795, 800, '2017-05-31 05:38:06', 1),
(145, 20103203, 'PAID', 6, '2017-05-31 05:03:57', 5200, 5200, '2017-05-31 11:37:57', 1),
(146, 20103203, 'PAID', 6, '2017-05-31 05:04:41', 5200, 5200, '2017-05-31 11:37:57', 1),
(147, 20207493, 'PAID', 6, '2017-05-31 05:09:05', 4550, 4600, '2017-05-31 05:57:31', 1),
(148, 20310423, 'PAID', 6, '2017-05-31 05:12:07', 3250, 3300, '2017-05-31 12:27:37', 1),
(149, 20515482, 'UNPAID', 0, '2017-05-31 05:16:55', 0, 0, '0000-00-00 00:00:00', 0),
(150, 20617253, 'PAID', 6, '2017-05-31 05:17:54', 1600, 1700, '2017-06-01 03:44:02', 1),
(151, 20729453, 'PAID', 6, '2017-05-31 05:30:07', 1030, 1030, '2017-05-31 12:28:11', 1),
(152, 20729453, 'PAID', 6, '2017-05-31 05:30:10', 1030, 1030, '2017-05-31 12:28:11', 1),
(153, 20849253, 'PAID', 6, '2017-05-31 05:49:47', 1800, 2000, '2017-05-31 05:54:32', 1),
(154, 20849253, 'PAID', 6, '2017-05-31 05:49:49', 1800, 2000, '2017-05-31 05:54:32', 1),
(155, 20959233, 'PAID', 6, '2017-05-31 05:59:51', 400, 400, '2017-06-01 03:45:28', 1),
(156, 20959233, 'PAID', 6, '2017-05-31 05:59:55', 400, 400, '2017-06-01 03:45:28', 1),
(157, 21106433, 'PAID', 6, '2017-05-31 06:07:22', 500, 600, '2017-06-01 03:47:16', 1),
(158, 21223423, 'PAID', 6, '2017-05-31 09:25:20', 6060, 6100, '2017-06-01 03:35:38', 1),
(159, 21223423, 'PAID', 6, '2017-05-31 09:25:21', 6060, 6100, '2017-06-01 03:35:38', 1),
(160, 21223423, 'PAID', 6, '2017-05-31 09:25:22', 6060, 6100, '2017-06-01 03:35:38', 1),
(161, 21223423, 'PAID', 6, '2017-05-31 09:28:57', 6060, 6100, '2017-06-01 03:35:38', 1),
(162, 21332273, 'PAID', 6, '2017-05-31 11:33:09', 2600, 5000, '2017-05-31 11:40:56', 1),
(163, 21332273, 'PAID', 6, '2017-05-31 11:33:59', 2600, 5000, '2017-05-31 11:40:56', 1),
(164, 21407493, 'PAID', 6, '2017-05-31 12:08:45', 70, 70, '2017-06-01 03:50:56', 1),
(165, 21512083, 'PAID', 6, '2017-05-31 12:12:31', 60, 60, '2017-06-01 03:51:25', 1),
(166, 21614443, 'PAID', 6, '2017-05-31 12:15:14', 200, 300, '2017-06-01 03:49:25', 1),
(167, 21724593, 'PAID', 6, '2017-05-31 12:25:29', 1050, 1100, '2017-06-01 03:48:33', 1),
(168, 21900033, 'PAID', 6, '2017-06-01 08:00:13', 450, 450, '2017-06-04 11:01:45', 1),
(169, 22048373, 'PAID', 6, '2017-06-01 10:49:46', 260, 260, '2017-06-01 10:57:41', 1),
(170, 22048373, 'PAID', 6, '2017-06-01 10:51:24', 260, 260, '2017-06-01 10:57:41', 1),
(171, 22104053, 'PAID', 6, '2017-06-01 11:04:40', 500, 1000, '2017-06-04 11:02:16', 1),
(172, 22205533, 'PAID', 6, '2017-06-01 11:06:07', 150, 200, '2017-06-04 11:03:21', 1),
(173, 22441072, 'UNPAID', 0, '2017-06-02 03:41:45', 0, 0, '0000-00-00 00:00:00', 0),
(174, 22534423, 'PAID', 6, '2017-06-03 07:35:24', 1300, 1500, '2017-06-03 07:39:00', 1),
(175, 22727393, 'PAID', 6, '2017-06-04 10:30:04', 1300, 1300, '2017-06-04 10:56:28', 1),
(176, 22812443, 'PAID', 6, '2017-06-04 11:13:05', 70, 100, '2017-06-04 11:14:37', 1),
(177, 22916063, 'PAID', 6, '2017-06-04 11:16:24', 680, 700, '2017-06-04 11:20:12', 1),
(178, 23021173, 'PAID', 6, '2017-06-04 11:21:35', 250, 250, '2017-06-04 11:24:31', 1),
(179, 23153443, 'PAID', 6, '2017-06-04 11:54:19', 200, 200, '2017-06-04 12:22:59', 1),
(180, 23204173, 'PAID', 6, '2017-06-04 12:04:32', 200, 200, '2017-06-04 12:23:25', 1),
(181, 23415273, 'PAID', 6, '2017-06-04 12:16:05', 650, 700, '2017-06-04 14:01:26', 1),
(182, 23528453, 'PAID', 6, '2017-06-04 12:29:51', 595, 600, '2017-06-04 14:01:50', 1),
(183, 23631313, 'PAID', 6, '2017-06-04 13:31:47', 150, 200, '2017-06-04 13:32:52', 1),
(184, 23844293, 'PAID', 6, '2017-06-04 13:44:58', 100, 100, '2017-06-04 14:02:20', 1),
(185, 23744283, 'PAID', 6, '2017-06-04 13:45:08', 450, 450, '2017-06-04 14:02:06', 1),
(186, 23953193, 'PAID', 6, '2017-06-04 13:53:40', 200, 200, '2017-06-04 13:57:49', 1),
(187, 24058173, 'PAID', 6, '2017-06-04 13:58:32', 150, 200, '2017-06-04 14:02:34', 1),
(188, 24312513, 'PAID', 6, '2017-06-04 14:13:03', 200, 200, '2017-06-04 14:32:17', 1),
(189, 24417533, 'PAID', 6, '2017-06-04 14:18:03', 200, 200, '2017-06-04 14:32:30', 1),
(190, 24519183, 'PAID', 6, '2017-06-04 14:19:41', 250, 250, '2017-06-04 14:20:38', 1),
(191, 24629283, 'PAID', 6, '2017-06-04 14:29:47', 450, 450, '2017-06-04 14:31:27', 1),
(192, 24732573, 'PAID', 6, '2017-06-04 14:33:27', 600, 600, '2017-06-04 14:39:29', 1),
(193, 24833313, 'PAID', 6, '2017-06-04 14:33:52', 650, 700, '2017-06-04 14:39:33', 1),
(194, 24934023, 'PAID', 6, '2017-06-04 14:35:04', 370, 400, '2017-06-04 14:39:12', 1),
(195, 25118103, 'PAID', 6, '2017-06-04 15:18:36', 680, 680, '2017-06-04 15:20:59', 1),
(196, 26411333, 'PAID', 6, '2017-06-08 13:12:12', 4030, 5288855, '2017-06-09 14:51:47', 1),
(197, 26411333, 'PAID', 6, '2017-06-08 13:12:54', 4030, 5288855, '2017-06-09 14:51:47', 1),
(198, 26519063, 'PAID', 6, '2017-06-08 13:19:59', 3290, 3300, '2017-06-10 00:33:36', 1),
(199, 26642353, 'PAID', 6, '2017-06-10 10:43:01', 1300, 1300, '2017-06-10 10:45:55', 0),
(200, 26848503, 'PAID', 6, '2017-06-10 10:49:05', 250, 250, '2017-06-10 12:06:14', 0),
(201, 26958463, 'PAID', 6, '2017-06-10 11:59:16', 2000, 2000, '2017-06-10 12:04:54', 0),
(202, 26958463, 'PAID', 6, '2017-06-10 12:00:41', 2000, 2000, '2017-06-10 12:04:54', 0),
(203, 27058243, 'PAID', 6, '2017-06-10 12:59:18', 515, 600, '2017-06-10 13:02:24', 0),
(204, 27251163, 'PAID', 6, '2017-06-12 03:52:00', 650, 700, '2017-06-12 03:55:16', 0),
(205, 27302573, 'PAID', 6, '2017-06-12 04:03:25', 1010, 1100, '2017-06-12 04:06:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `paid_status` tinyint(4) NOT NULL,
  `Checkout` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `table_id`, `order_id`, `user_id`, `status`, `paid_status`, `Checkout`) VALUES
(68, 1, 10035343, 3, '3', 1, NULL),
(69, 6, 10035343, 3, '3', 1, NULL),
(70, 7, 10100433, 3, '3', 1, '2017-05-24 06:00:53'),
(71, 9, 10618583, 3, '1', 1, '2017-05-24 07:19:21'),
(72, 8, 11003493, 3, '1', 1, '2017-05-24 11:04:35'),
(73, 10, 11206163, 3, '1', 1, '2017-05-24 11:06:51'),
(74, 6, 11328132, 2, '3', 1, '2017-05-24 15:29:22'),
(75, 7, 11428382, 2, '1', 1, '2017-05-24 23:28:59'),
(76, 8, 11517103, 3, '1', 1, '2017-05-25 05:17:29'),
(77, 9, 11618433, 3, '1', 1, '2017-05-25 05:19:00'),
(78, 10, 11729143, 3, '1', 1, '2017-05-25 05:29:43'),
(79, 7, 11933243, 3, '1', 1, '2017-05-25 05:33:55'),
(80, 6, 11933243, 3, '1', 1, '2017-05-25 05:34:38'),
(81, 8, 12242563, 3, '1', 1, '2017-05-25 06:43:05'),
(82, 9, 12351343, 3, '1', 1, '2017-05-25 06:51:48'),
(83, 10, 12459093, 3, '1', 1, '2017-05-25 06:59:25'),
(84, 6, 12621313, 3, '1', 1, '2017-05-25 07:21:45'),
(85, 7, 12746483, 3, '1', 1, '2017-05-25 07:47:26'),
(86, 8, 12935152, 2, '1', 1, '2017-05-25 08:36:02'),
(87, 9, 13056152, 2, '1', 1, '2017-05-25 08:57:05'),
(88, 10, 13147222, 2, '1', 1, '2017-05-25 10:47:48'),
(89, 6, 13252372, 2, '1', 1, '2017-05-25 10:52:51'),
(90, 7, 13302302, 2, '1', 1, '2017-05-25 11:02:39'),
(91, 8, 13513172, 2, '1', 1, '2017-05-25 11:13:34'),
(92, 9, 13650382, 2, '1', 1, '2017-05-25 11:50:55'),
(93, 10, 13718492, 2, '1', 1, '2017-05-25 12:19:00'),
(94, 6, 13832542, 2, '1', 1, '2017-05-25 12:33:28'),
(95, 7, 13902372, 2, '1', 1, '2017-05-25 13:04:07'),
(96, 8, 14020202, 2, '1', 1, '2017-05-25 13:20:32'),
(97, 9, 14131002, 2, '1', 1, '2017-05-25 13:31:24'),
(98, 6, 14311432, 2, '1', 1, '2017-05-26 04:12:56'),
(99, 7, 14311432, 2, '1', 1, '2017-05-26 04:13:15'),
(100, 6, 14420493, 3, '1', 1, '2017-05-26 04:22:25'),
(101, 7, 14548283, 3, '1', 1, '2017-05-26 04:48:51'),
(102, 9, 14649353, 3, '1', 1, '2017-05-26 04:50:21'),
(103, 8, 14728563, 3, '1', 1, '2017-05-26 05:29:11'),
(104, 10, 15337073, 3, '1', 1, '2017-05-26 06:37:50'),
(105, 7, 15541483, 3, '1', 1, '2017-05-26 06:42:05'),
(106, 10, 15645013, 3, '1', 1, '2017-05-26 06:46:01'),
(107, 6, 15833082, 2, '1', 1, '2017-05-26 07:36:17'),
(108, 8, 15938422, 2, '3', 1, '2017-05-26 07:39:44'),
(109, 9, 16052113, 3, '1', 1, '2017-05-26 07:52:36'),
(110, 6, 16217572, 2, '3', 1, '2017-05-27 04:18:22'),
(111, 7, 16318352, 2, '3', 1, '2017-05-27 04:18:58'),
(112, 8, 16217572, 2, '3', 1, '2017-05-27 04:28:42'),
(113, 6, 16720263, 3, '3', 1, '2017-05-27 06:20:43'),
(114, 7, 17100112, 2, '3', 1, '2017-05-28 06:01:06'),
(115, 6, 17208473, 3, '3', 1, '2017-05-28 06:09:34'),
(116, 0, 17337173, 3, '1', 1, '2017-05-28 06:37:26'),
(117, 8, 17412353, 3, '3', 1, '2017-05-28 07:12:47'),
(118, 9, 17728463, 3, '3', 1, '2017-05-28 08:29:04'),
(119, 10, 17829083, 3, '3', 1, '2017-05-28 08:29:35'),
(120, 6, 17929383, 3, '3', 1, '2017-05-28 08:37:03'),
(121, 6, 17929383, 3, '3', 1, '2017-05-28 08:38:21'),
(122, 9, 18130542, 2, '3', 1, '2017-05-28 09:32:28'),
(123, 6, 18246433, 3, '3', 1, '2017-05-28 11:47:07'),
(124, 7, 18348352, 2, '3', 1, '2017-05-28 11:48:49'),
(125, 8, 18450582, 2, '3', 1, '2017-05-28 11:51:17'),
(126, 4, 18552442, 2, '3', 1, '2017-05-28 11:53:26'),
(127, 5, 18624242, 2, '3', 1, '2017-05-29 00:25:19'),
(128, 6, 18700303, 3, '3', 1, '2017-05-29 12:00:56'),
(129, 6, 18902243, 3, '3', 1, '2017-05-29 12:02:40'),
(130, 7, 19017203, 3, '3', 1, '2017-05-29 12:17:55'),
(131, 8, 19017203, 3, '3', 1, '2017-05-29 12:18:41'),
(132, 9, 19017203, 3, '3', 1, '2017-05-29 12:19:15'),
(133, 10, 19120373, 3, '3', 1, '2017-05-29 12:20:59'),
(134, 6, 19120373, 3, '3', 1, '2017-05-29 12:24:08'),
(135, 6, 19225213, 3, '3', 1, '2017-05-29 12:25:53'),
(136, 6, 19225213, 3, '3', 1, '2017-05-29 12:28:54'),
(137, 6, 19225213, 3, '3', 1, '2017-05-29 12:29:43'),
(138, 6, 19225213, 3, '3', 1, '2017-05-29 12:30:34'),
(139, 6, 19225213, 3, '3', 1, '2017-05-29 12:31:06'),
(140, 6, 19344133, 3, '3', 1, '2017-05-29 12:44:43'),
(141, 6, 19453003, 3, '3', 1, '2017-05-30 04:53:21'),
(142, 6, 19743553, 3, '3', 1, '2017-05-31 03:46:12'),
(143, 7, 19743553, 3, '3', 1, '2017-05-31 03:46:40'),
(144, 8, 19743553, 3, '3', 1, '2017-05-31 03:47:05'),
(145, 6, 19817063, 3, '3', 1, '2017-05-31 04:17:57'),
(146, 8, 20030223, 3, '2', 1, '2017-05-31 04:34:57'),
(147, 9, 20103203, 3, '3', 1, '2017-05-31 05:03:56'),
(148, 10, 20103203, 3, '3', 1, '2017-05-31 05:04:41'),
(149, 6, 20207493, 3, '1', 1, '2017-05-31 05:09:05'),
(150, 9, 20310423, 3, '2', 1, '2017-05-31 05:12:07'),
(151, 4, 20515482, 2, '3', 1, '2017-05-31 05:16:55'),
(152, 6, 20617253, 3, '3', 1, '2017-05-31 05:17:54'),
(153, 6, 20729453, 3, '1', 1, '2017-05-31 05:30:07'),
(154, 6, 20729453, 3, '1', 1, '2017-05-31 05:30:10'),
(155, 7, 20849253, 3, '3', 1, '2017-05-31 05:49:47'),
(156, 7, 20849253, 3, '3', 1, '2017-05-31 05:49:49'),
(157, 9, 20959233, 3, '3', 1, '2017-05-31 05:59:51'),
(158, 9, 20959233, 3, '3', 1, '2017-05-31 05:59:55'),
(159, 6, 21106433, 3, '3', 1, '2017-05-31 06:07:22'),
(160, 8, 21223423, 3, '3', 1, '2017-05-31 09:25:20'),
(161, 8, 21223423, 3, '3', 1, '2017-05-31 09:25:21'),
(162, 8, 21223423, 3, '3', 1, '2017-05-31 09:25:22'),
(163, 10, 21223423, 3, '3', 1, '2017-05-31 09:28:57'),
(164, 10, 21332273, 3, '3', 1, '2017-05-31 11:33:09'),
(165, 10, 21332273, 3, '3', 1, '2017-05-31 11:33:59'),
(166, 6, 21407493, 3, '3', 1, '2017-05-31 12:08:45'),
(167, 8, 21512083, 3, '3', 1, '2017-05-31 12:12:31'),
(168, 9, 21614443, 3, '3', 1, '2017-05-31 12:15:14'),
(169, 7, 21724593, 3, '3', 1, '2017-05-31 12:25:29'),
(170, 6, 21900033, 3, '3', 1, '2017-06-01 08:00:13'),
(171, 7, 22048373, 3, '3', 1, '2017-06-01 10:49:46'),
(172, 8, 22048373, 3, '3', 1, '2017-06-01 10:51:24'),
(173, 9, 22104053, 3, '3', 1, '2017-06-01 11:04:40'),
(174, 10, 22205533, 3, '2', 1, '2017-06-01 11:06:07'),
(175, 1, 22441072, 2, '3', 1, '2017-06-02 03:41:44'),
(176, 9, 22534423, 3, '3', 1, '2017-06-03 07:35:24'),
(177, 9, 22727393, 3, '3', 1, '2017-06-04 10:30:04'),
(178, 9, 22812443, 3, '2', 1, '2017-06-04 11:13:05'),
(179, 9, 22916063, 3, '2', 1, '2017-06-04 11:16:24'),
(180, 9, 23021173, 3, '3', 1, '2017-06-04 11:21:35'),
(181, 9, 23153443, 3, '1', 1, '2017-06-04 11:54:19'),
(182, 7, 23204173, 3, '1', 1, '2017-06-04 12:04:32'),
(183, 7, 23415273, 3, '3', 1, '2017-06-04 12:16:05'),
(184, 6, 23528453, 3, '3', 1, '2017-06-04 12:29:51'),
(185, 7, 23631313, 3, '3', 1, '2017-06-04 13:31:47'),
(186, 6, 23844293, 3, '3', 1, '2017-06-04 13:44:58'),
(187, 9, 23744283, 3, '3', 1, '2017-06-04 13:45:08'),
(188, 6, 23953193, 3, '3', 1, '2017-06-04 13:53:40'),
(189, 7, 24058173, 3, '3', 1, '2017-06-04 13:58:32'),
(190, 6, 24312513, 3, '3', 1, '2017-06-04 14:13:03'),
(191, 6, 24417533, 3, '3', 1, '2017-06-04 14:18:03'),
(192, 6, 24519183, 3, '3', 1, '2017-06-04 14:19:41'),
(193, 6, 24629283, 3, '3', 1, '2017-06-04 14:29:47'),
(194, 9, 24732573, 3, '3', 1, '2017-06-04 14:33:27'),
(195, 10, 24833313, 3, '3', 1, '2017-06-04 14:33:52'),
(196, 7, 24934023, 3, '3', 1, '2017-06-04 14:35:04'),
(197, 9, 25118103, 3, '3', 1, '2017-06-04 15:18:36'),
(198, 6, 26411333, 3, '3', 1, '2017-06-08 13:12:12'),
(199, 7, 26411333, 3, '3', 1, '2017-06-08 13:12:54'),
(200, 8, 26519063, 3, '3', 1, '2017-06-08 13:19:59'),
(201, 9, 26642353, 3, '3', 1, '2017-06-10 10:43:01'),
(202, 10, 26848503, 3, '3', 1, '2017-06-10 10:49:05'),
(203, 6, 26958463, 3, '3', 1, '2017-06-10 11:59:16'),
(204, 7, 26958463, 3, '3', 1, '2017-06-10 12:00:41'),
(205, 6, 27058243, 3, '3', 1, '2017-06-10 12:59:18'),
(206, 6, 27251163, 3, '3', 1, '2017-06-12 03:52:00'),
(207, 7, 27302573, 3, '3', 1, '2017-06-12 04:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_types`
--

CREATE TABLE IF NOT EXISTS `order_status_types` (
  `order_status_type_id` int(11) NOT NULL,
  `order_status_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status_types`
--

INSERT INTO `order_status_types` (`order_status_type_id`, `order_status_name`) VALUES
(1, 'PENDING'),
(2, 'PROCESSING'),
(3, 'PROCESSED');

-- --------------------------------------------------------

--
-- Table structure for table `pb_app_menu`
--

CREATE TABLE IF NOT EXISTS `pb_app_menu` (
  `MenuID` int(11) NOT NULL,
  `Menu` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Icon` varchar(100) NOT NULL,
  `MenuGroupID` varchar(100) NOT NULL,
  `priorityvalue` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_app_menu`
--

INSERT INTO `pb_app_menu` (`MenuID`, `Menu`, `Status`, `Icon`, `MenuGroupID`, `priorityvalue`) VALUES
(1, 'Users', 'true', 'people', '1', 1),
(2, 'Orders', 'true', 'shopping cart', '2', 2),
(3, 'Tables', 'true', 'people', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pb_app_menulist`
--

CREATE TABLE IF NOT EXISTS `pb_app_menulist` (
  `MenuListID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `MenuListName` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `FileName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_app_menulist`
--

INSERT INTO `pb_app_menulist` (`MenuListID`, `MenuID`, `MenuListName`, `Status`, `FileName`) VALUES
(1, 1, 'Add User', 'true', './modules/users/new.php'),
(2, 1, 'Users', 'true', './modules/users/all.php'),
(3, 2, 'Orders List', 'true', './modules/orders/all.php'),
(4, 3, 'Table list', '', ''),
(5, 3, 'Add Table', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pb_app_menuusers`
--

CREATE TABLE IF NOT EXISTS `pb_app_menuusers` (
  `DepartmentID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `MenuListID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_app_menuusers`
--

INSERT INTO `pb_app_menuusers` (`DepartmentID`, `MenuID`, `MenuListID`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 2, 3),
(1, 3, 4),
(1, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pb_app_userdepartments`
--

CREATE TABLE IF NOT EXISTS `pb_app_userdepartments` (
  `DepartmentID` int(11) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_app_userdepartments`
--

INSERT INTO `pb_app_userdepartments` (`DepartmentID`, `Department`, `Status`) VALUES
(-1, 'System', 'true'),
(1, 'Administrator', 'true'),
(2, 'Director', 'true'),
(3, 'Head Teacher', 'true'),
(4, 'Teacher', 'true'),
(5, 'Academics Master', 'true'),
(6, 'Deputy Primary', 'true'),
(7, 'Deputy Nursery', 'true'),
(8, 'Boarding Master', 'true'),
(9, 'Accounts', 'true'),
(10, 'Secretary', 'true'),
(11, 'Stores', 'true'),
(12, 'ADMIN', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `pb_app_users`
--

CREATE TABLE IF NOT EXISTS `pb_app_users` (
  `UserID` int(11) NOT NULL,
  `names` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nationalid` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `gender` varchar(10) DEFAULT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_app_users`
--

INSERT INTO `pb_app_users` (`UserID`, `names`, `email`, `mobile`, `address`, `nationalid`, `dob`, `department`, `password`, `state`, `gender`, `photo`) VALUES
(1, 'System (Zalego)', 'systems@zalegoinstitute.ac.ke', '0712584102', '0000000', '00000000', '2017-04-23', 'System', '700c8b805a3e2a265b01c77614cd8b21', 1, 'M', 'admin.png'),
(2, 'Developers (Zalego)', 'developers@zalegoinstitute.ac.ke', '0706828557', '0000000', '00000000', '2017-04-23', 'System', '700c8b805a3e2a265b01c77614cd8b21', 1, 'M', 'admin.png'),
(3, 'Nancy Mutai Muthama', 'nancymutai@gmail.com', '0706828557', '0000000', '00000000', '2017-03-21', 'Teacher', '700c8b805a3e2a265b01c77614cd8b21', 1, 'F', 'default.png'),
(4, 'Admin', 'admin', '0712584102', '0000000', '00000000', '2017-06-07', 'Administrator', '700c8b805a3e2a265b01c77614cd8b21', 1, 'M', 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu_category`
--

CREATE TABLE IF NOT EXISTS `sub_menu_category` (
  `sub_menu_category_id` int(11) NOT NULL,
  `sub_menu_category_name` varchar(11) NOT NULL,
  `menu_category_submenu_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu_category`
--

INSERT INTO `sub_menu_category` (`sub_menu_category_id`, `sub_menu_category_name`, `menu_category_submenu_id`) VALUES
(3, 'Chicken', 7),
(4, 'Beef', 7),
(5, 'Pork', 7),
(6, 'Rice Dishes', 7),
(7, 'Fish', 12),
(8, 'Sizzlers', 7),
(9, 'Prawns', 12),
(10, 'Noodles', 7),
(11, 'Chips', 10),
(12, 'Noodles', 10),
(13, 'Rice Dishes', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu_items`
--

CREATE TABLE IF NOT EXISTS `sub_menu_items` (
  `sub_menu_item_id` int(11) NOT NULL,
  `sub_menu_item_name` varchar(50) NOT NULL,
  `sub_menu_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE IF NOT EXISTS `system_logs` (
  `system_logs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `log_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `table_id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `table_status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_name`, `branch_id`, `table_status`) VALUES
(1, 'Table 1', 2, 'ACTIVE'),
(2, 'Table 2', 2, 'ACTIVE'),
(3, 'Table 3', 2, 'ACTIVE'),
(4, 'Table 4', 2, 'ACTIVE'),
(5, 'Table 5', 2, 'NOT-ACTIVE'),
(6, 'Table 1', 1, 'NOT-ACTIVE'),
(7, 'Table 2', 1, 'NOT-ACTIVE'),
(8, 'Table 3', 1, 'NOT-ACTIVE'),
(9, 'Table 4', 1, 'NOT-ACTIVE'),
(10, 'Table 5', 1, 'NOT-ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `taken_orders`
--

CREATE TABLE IF NOT EXISTS `taken_orders` (
  `taken_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `gender` int(1) NOT NULL,
  `residence` text NOT NULL,
  `addedby` int(11) NOT NULL,
  `acstatus` int(1) NOT NULL,
  `branchId` int(11) NOT NULL,
  `actype` int(1) NOT NULL,
  `activationcode` text NOT NULL,
  `timeadded` datetime NOT NULL,
  `password` text NOT NULL,
  `user_category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `email`, `phone`, `gender`, `residence`, `addedby`, `acstatus`, `branchId`, `actype`, `activationcode`, `timeadded`, `password`, `user_category_id`) VALUES
(1, 'Jamesh', 'krishnababu@nlske.com', '9962189111', 1, 'Redhills', 1, 1, 1, 1, '1-cb3-1', '2016-07-11 21:00:39', '700c8b805a3e2a265b01c77614cd8b21', 1),
(2, 'roy ', 'roy@test.com', '9972827282', 1, 'Wood Avenue', 1, 1, 2, 2, '1-fc5-1', '2016-07-11 21:06:15', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(3, 'chris', 'chris@test.com', '998383838', 1, 'Wood Avenue', 1, 1, 1, 3, '1-cb9-1', '2016-07-11 21:06:58', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'Joseph Komba', 'a@test.com', '0726712505', 1, 'krishnababu@nlske.com', 1, 1, 1, 1, '1-f16-1', '2016-07-12 16:38:27', 'e10adc3949ba59abbe56e057f20f883e', 2),
(5, 'Joseph Komba', 'kombajoseph@gmail.com', '0726712505', 1, 'krishnababu@nlske.com', 1, 1, 1, 1, '1-8447-1', '2016-07-13 13:12:25', 'e10adc3949ba59abbe56e057f20f883e', 2),
(6, 'This is a test user', 'c', '0726712505', 1, 'krishnababu@nlske.com', 1, 1, 1, 2, '1-f276-2', '2016-07-13 16:12:25', 'e10adc3949ba59abbe56e057f20f883e', 3),
(7, 'Hari', 'c@test.com', '0710586887', 1, 'Google', 1, 1, 2, 1, '1-958-3', '2016-07-20 13:49:17', 'e10adc3949ba59abbe56e057f20f883e', 3),
(8, 'Stella', 'bhavaniks31@gmail.com', '0786574134', 2, 'wood avenu', 1, 1, 3, 2, '1-11e-3', '2016-07-20 13:50:03', 'e10adc3949ba59abbe56e057f20f883e', 0),
(9, 'KRISHNABABU', 'info@nlske.com', '09962189111', 1, 'wood avenu', 1, 1, 3, 3, '1-f24-3', '2016-07-20 13:50:40', 'e10adc3949ba59abbe56e057f20f883e', 0),
(10, 'KRISHNABABU', 'gkrishnababu@nlske.com', '0710586887', 1, 'Hari', 1, 1, 4, 1, '1-7ed-4', '2016-07-20 18:14:50', 'e10adc3949ba59abbe56e057f20f883e', 0),
(11, 'Meera', 'ggkrishnababu@nlske.com', '0710586887', 2, 'Wood Avenue', 1, 1, 4, 2, '1-2a7-4', '2016-07-20 18:15:23', 'e10adc3949ba59abbe56e057f20f883e', 0),
(12, 'Mabeya ', 'conseay@nlske.com', '0710586887', 1, 'wood Avenue', 1, 1, 4, 3, '1-088-4', '2016-07-20 18:16:02', 'e10adc3949ba59abbe56e057f20f883e', 0),
(13, 'suresh', 'sureshseenis@gmail.com', '9585273771', 1, 'Velachery', 1, 1, 1, 1, '1-e27-1', '2016-07-21 15:33:28', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE IF NOT EXISTS `user_category` (
  `user_category_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`user_category_id`, `user_type`) VALUES
(1, 'waiter'),
(2, 'kitchen'),
(3, 'cashier'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_homepage`
--

CREATE TABLE IF NOT EXISTS `user_homepage` (
  `user_homepage_id` int(11) NOT NULL,
  `homepage_item` varchar(50) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `image_path` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_homepage`
--

INSERT INTO `user_homepage` (`user_homepage_id`, `homepage_item`, `user_category_id`, `image_path`) VALUES
(1, 'New Order', 1, '02-05-2017-1493737036.png'),
(2, 'Add Item', 1, '02-05-2017-1493737043.png'),
(3, 'Clear table', 1, '02-05-2017-1493737494.png'),
(4, 'View Orders', 1, '03-05-2017-1493827669.png'),
(5, 'Pending orders', 2, ''),
(6, 'Processing orders', 2, ''),
(7, 'Processed Orders', 2, ''),
(8, 'Make payment', 3, ''),
(10, 'View paid orders', 3, ''),
(14, 'Generate Bill', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`menu_category_id`);

--
-- Indexes for table `menu_category_submenu`
--
ALTER TABLE `menu_category_submenu`
  ADD PRIMARY KEY (`main_menu_sub_id`), ADD KEY `menu_category_id` (`menu_category_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`), ADD UNIQUE KEY `order_id_no` (`order_id_no`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `order_payment_status`
--
ALTER TABLE `order_payment_status`
  ADD PRIMARY KEY (`payment_status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `order_status_types`
--
ALTER TABLE `order_status_types`
  ADD PRIMARY KEY (`order_status_type_id`);

--
-- Indexes for table `pb_app_menu`
--
ALTER TABLE `pb_app_menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indexes for table `pb_app_menulist`
--
ALTER TABLE `pb_app_menulist`
  ADD PRIMARY KEY (`MenuListID`);

--
-- Indexes for table `pb_app_menuusers`
--
ALTER TABLE `pb_app_menuusers`
  ADD PRIMARY KEY (`DepartmentID`,`MenuListID`,`MenuID`);

--
-- Indexes for table `pb_app_userdepartments`
--
ALTER TABLE `pb_app_userdepartments`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `pb_app_users`
--
ALTER TABLE `pb_app_users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `sub_menu_category`
--
ALTER TABLE `sub_menu_category`
  ADD PRIMARY KEY (`sub_menu_category_id`), ADD KEY `menu_category_submenu_id` (`menu_category_submenu_id`);

--
-- Indexes for table `sub_menu_items`
--
ALTER TABLE `sub_menu_items`
  ADD PRIMARY KEY (`sub_menu_item_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`system_logs_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `taken_orders`
--
ALTER TABLE `taken_orders`
  ADD PRIMARY KEY (`taken_order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`user_category_id`);

--
-- Indexes for table `user_homepage`
--
ALTER TABLE `user_homepage`
  ADD PRIMARY KEY (`user_homepage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `menu_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu_category_submenu`
--
ALTER TABLE `menu_category_submenu`
  MODIFY `main_menu_sub_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=277;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=535;
--
-- AUTO_INCREMENT for table `order_payment_status`
--
ALTER TABLE `order_payment_status`
  MODIFY `payment_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=208;
--
-- AUTO_INCREMENT for table `order_status_types`
--
ALTER TABLE `order_status_types`
  MODIFY `order_status_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pb_app_users`
--
ALTER TABLE `pb_app_users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sub_menu_category`
--
ALTER TABLE `sub_menu_category`
  MODIFY `sub_menu_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sub_menu_items`
--
ALTER TABLE `sub_menu_items`
  MODIFY `sub_menu_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `system_logs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `taken_orders`
--
ALTER TABLE `taken_orders`
  MODIFY `taken_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `user_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_homepage`
--
ALTER TABLE `user_homepage`
  MODIFY `user_homepage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_category_submenu`
--
ALTER TABLE `menu_category_submenu`
ADD CONSTRAINT `menu_category_submenu_ibfk_1` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_category` (`menu_category_id`),
ADD CONSTRAINT `menu_category_submenu_ibfk_2` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_category_submenu` (`main_menu_sub_id`);

--
-- Constraints for table `sub_menu_category`
--
ALTER TABLE `sub_menu_category`
ADD CONSTRAINT `sub_menu_category_ibfk_1` FOREIGN KEY (`menu_category_submenu_id`) REFERENCES `menu_category_submenu` (`main_menu_sub_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
