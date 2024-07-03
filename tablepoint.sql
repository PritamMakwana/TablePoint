-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 07:22 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tablepoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `a_l_id` int(12) NOT NULL,
  `a_l_mobile` varchar(13) COLLATE latin1_general_cs NOT NULL,
  `a_l_uname` varchar(30) COLLATE latin1_general_cs NOT NULL,
  `a_l_pwd` varchar(40) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`a_l_id`, `a_l_mobile`, `a_l_uname`, `a_l_pwd`) VALUES
(1, '1010101010', 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `admin_manage`
--

CREATE TABLE `admin_manage` (
  `a_manag_id` int(12) NOT NULL,
  `min_table_book_time` varchar(100) COLLATE latin1_general_cs NOT NULL DEFAULT '09:00',
  `max_table_book_time` varchar(100) COLLATE latin1_general_cs NOT NULL DEFAULT '21:00',
  `max_day_book` int(12) NOT NULL DEFAULT 0,
  `table_person_max` int(12) NOT NULL DEFAULT 4,
  `discount` int(12) NOT NULL DEFAULT 0,
  `restaurant_name` varchar(200) COLLATE latin1_general_cs NOT NULL,
  `restaurant_address` varchar(5000) COLLATE latin1_general_cs NOT NULL,
  `restaurant_mobile` varchar(20) COLLATE latin1_general_cs NOT NULL,
  `restaurant_email` varchar(1000) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `admin_manage`
--

INSERT INTO `admin_manage` (`a_manag_id`, `min_table_book_time`, `max_table_book_time`, `max_day_book`, `table_person_max`, `discount`, `restaurant_name`, `restaurant_address`, `restaurant_mobile`, `restaurant_email`) VALUES
(1, '06:00', '22:10', 5, 4, 10, 'TablePoint', ' Lathi Rd, Madhuvan  Park, Amreli, Gujarat 365601', '1010101010', 'admin123@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin_report`
--

CREATE TABLE `admin_report` (
  `a_r_id` int(12) NOT NULL,
  `cus_bill_id` int(12) NOT NULL,
  `a_r_date` date NOT NULL,
  `a_r_discount` int(12) NOT NULL,
  `a_r_total` int(12) NOT NULL,
  `a_r_final_total` int(12) NOT NULL,
  `op_id` int(12) NOT NULL,
  `op_uname` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `admin_report`
--

INSERT INTO `admin_report` (`a_r_id`, `cus_bill_id`, `a_r_date`, `a_r_discount`, `a_r_total`, `a_r_final_total`, `op_id`, `op_uname`) VALUES
(73, 196, '2022-09-13', 10, 180, 162, 14, 'user000'),
(74, 197, '2022-09-13', 10, 200, 180, 14, 'user000'),
(75, 198, '2022-09-13', 10, 400, 360, 14, 'user000'),
(76, 199, '2022-09-13', 10, 2000, 1800, 26, 'user123'),
(77, 200, '2022-09-13', 10, 60, 54, 24, 'admin000'),
(78, 201, '2022-09-13', 10, 300, 270, 28, 'user000'),
(79, 203, '2022-09-13', 10, 1600, 1440, 28, 'user000'),
(80, 205, '2022-09-13', 10, 2200, 1980, 28, 'user000'),
(81, 206, '2022-09-13', 10, 800, 720, 28, 'user000'),
(82, 207, '2022-09-13', 10, 1700, 1530, 28, 'user000'),
(83, 208, '2022-09-13', 10, 1600, 1440, 28, 'user000'),
(84, 209, '2022-09-13', 10, 600, 540, 28, 'user000'),
(85, 210, '2022-09-14', 10, 1200, 1080, 28, 'user000'),
(86, 211, '2022-09-18', 10, 920, 828, 28, 'user000'),
(87, 212, '2022-09-18', 10, 780, 702, 28, 'user000'),
(88, 213, '2022-09-18', 10, 1600, 1440, 28, 'user000');

-- --------------------------------------------------------

--
-- Table structure for table `bill_customer_info`
--

CREATE TABLE `bill_customer_info` (
  `cus_bill_id` int(12) NOT NULL,
  `cus_name` varchar(1000) COLLATE latin1_general_cs NOT NULL,
  `cus_bill_unique` varchar(1000) COLLATE latin1_general_cs NOT NULL,
  `cus_date` date NOT NULL,
  `cus_time` time NOT NULL,
  `op_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `bill_customer_info`
--

INSERT INTO `bill_customer_info` (`cus_bill_id`, `cus_name`, `cus_bill_unique`, `cus_date`, `cus_time`, `op_id`) VALUES
(196, 'admin2', '2022-09-13 15:19:19 14', '2022-09-13', '15:19:19', 14),
(197, 'admin123', '2022-09-13 15:19:34 14', '2022-09-13', '15:19:34', 14),
(198, 'admin 3', '2022-09-13 15:19:50 14', '2022-09-13', '15:19:50', 14),
(199, 'gopal makwan', '2022-09-13 15:27:15 26', '2022-09-13', '15:27:15', 26),
(200, 'admin 0000', '2022-09-13 16:55:37 24', '2022-09-13', '16:55:37', 24),
(201, 'user 00000', '2022-09-13 16:56:01 28', '2022-09-13', '16:56:01', 28),
(203, 'pritam makwan', '2022-09-13 19:34:03 28', '2022-09-13', '19:34:03', 28),
(205, 'makwana pritam', '2022-09-13 21:01:20 28', '2022-09-13', '21:01:20', 28),
(206, 'gopal makwan', '2022-09-13 21:13:44 28', '2022-09-13', '21:13:44', 28),
(207, 'user 2', '2022-09-13 21:14:16 28', '2022-09-13', '21:14:16', 28),
(208, 'user 2', '2022-09-13 21:38:11 28', '2022-09-13', '21:38:11', 28),
(209, 'gopal makwan', '2022-09-13 22:13:26 28', '2022-09-13', '22:13:26', 28),
(210, 'admin', '2022-09-14 16:11:23 28', '2022-09-14', '16:11:23', 28),
(211, 'john cena', '2022-09-18 16:22:29 28', '2022-09-18', '16:22:29', 28),
(212, 'salaman khan', '2022-09-18 16:23:33 28', '2022-09-18', '16:23:33', 28),
(213, 'ajay devgan', '2022-09-18 16:24:12 28', '2022-09-18', '16:24:12', 28);

-- --------------------------------------------------------

--
-- Table structure for table `bill_order_items`
--

CREATE TABLE `bill_order_items` (
  `boi_id` int(12) NOT NULL,
  `boi_item` varchar(200) COLLATE latin1_general_cs NOT NULL,
  `boi_qty` int(12) NOT NULL,
  `boi_price` int(12) NOT NULL,
  `boi_items_amount` int(12) NOT NULL,
  `cus_bill_id` int(12) NOT NULL,
  `op_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `bill_order_items`
--

INSERT INTO `bill_order_items` (`boi_id`, `boi_item`, `boi_qty`, `boi_price`, `boi_items_amount`, `cus_bill_id`, `op_id`) VALUES
(203, 'Parantha', 1, 180, 180, 196, 14),
(204, 'Chicken Manchurian', 1, 200, 200, 197, 14),
(205, 'Chole-Bhature', 1, 400, 400, 198, 14),
(206, 'Lilva Kachori ', 1, 800, 800, 199, 26),
(207, 'Chowmein', 3, 400, 1200, 199, 26),
(208, 'Lassi', 1, 60, 60, 200, 24),
(209, 'Chillichicken', 1, 300, 300, 201, 28),
(210, 'Lilva Kachori ', 2, 800, 1600, 203, 28),
(213, 'Lilva Kachori ', 1, 800, 800, 205, 28),
(214, 'Khandvi ', 2, 300, 600, 205, 28),
(215, 'Handvo', 2, 400, 800, 205, 28),
(216, 'Handvo', 2, 400, 800, 206, 28),
(217, 'Handvo', 2, 400, 800, 207, 28),
(218, 'Handvo', 2, 400, 800, 207, 28),
(219, ' Thepla', 1, 100, 100, 207, 28),
(220, 'Lilva Kachori ', 2, 800, 1600, 208, 28),
(221, 'Khandvi ', 2, 300, 600, 209, 28),
(222, 'Handvo', 1, 400, 400, 210, 28),
(223, 'Lilva Kachori ', 1, 800, 800, 210, 28),
(224, 'Handvo', 2, 400, 800, 211, 28),
(225, 'Lassi', 2, 60, 120, 211, 28),
(226, 'Chillichicken', 2, 300, 600, 212, 28),
(227, 'Parantha', 1, 180, 180, 212, 28),
(228, 'Lilva Kachori ', 2, 800, 1600, 213, 28);

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `l_id` int(12) NOT NULL,
  `l_mobile` varchar(13) COLLATE latin1_general_cs NOT NULL,
  `l_uname` varchar(30) COLLATE latin1_general_cs NOT NULL,
  `l_pwd` varchar(40) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`l_id`, `l_mobile`, `l_uname`, `l_pwd`) VALUES
(4, '1122334455', 'rock123', 'rock123'),
(5, '1231231231', 'roman123', 'roman123'),
(6, '1111122222', 'john123', 'john123'),
(7, '9090909090', 'user000', 'user000'),
(10, '1111111111', 'user111', 'user111'),
(11, '9988776655', 'pritam', 'pritam');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(12) NOT NULL,
  `f_cus_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `f_timedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `f_desc` varchar(100) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `f_cus_name`, `f_timedate`, `f_desc`) VALUES
(24, 'rock123', '2022-09-18 10:42:22', 'We are so fortunate to have this place just a few minutes drive away from home. '),
(25, 'roman123', '2022-09-18 10:43:18', 'Food is stunning, both the tapas and downstairs restaurant.'),
(26, 'john123', '2022-09-18 10:43:55', 'Cocktails wow, wine great and lovely selection of beers.'),
(27, 'user000', '2022-09-18 10:44:32', 'Love this place and will continue to visit.'),
(28, 'pritam', '2022-09-18 10:45:32', ' Excellent food.'),
(29, 'user111', '2022-09-18 10:46:23', 'There was also plenty of room for bigger groups.');

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `cate_id` int(12) NOT NULL,
  `cate_name` varchar(100) COLLATE latin1_general_cs NOT NULL,
  `items` int(12) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`cate_id`, `cate_name`, `items`) VALUES
(29, 'Gujarati', 5),
(33, 'Punjabi', 3),
(34, 'Chinese', 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(12) NOT NULL,
  `item_title` varchar(200) COLLATE latin1_general_cs NOT NULL,
  `item_img` varchar(5000) COLLATE latin1_general_cs NOT NULL,
  `item_price` int(12) NOT NULL,
  `item_desc` varchar(5000) COLLATE latin1_general_cs DEFAULT NULL,
  `food_category` varchar(100) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_title`, `item_img`, `item_price`, `item_desc`, `food_category`) VALUES
(71, 'Khaman', '1662986833-khaman.jpg', 200, 'Khaman - The Sponge Snack\r\n A tasty and healthy steamed snack made from freshly ground lentils and chickpea flour, it is very similar to its humble cousin, the world-famous -dhokla. To prepare the khaman, the khaman flour mix is boiled along with turmeric, salt and baking soda to make it light and fluffy. It is then cut up into cubes and usually garnished with mustard seeds, coriander leaves, sev and chopped onions. Traditionally served on a large green leaf called the Kesuda, the modern, urban version is served in newspapers in farsan (snack) shops with tangy chutneys and several pieces of green chillies. Popular adaptations of the khaman include Ameri khaman (mashed up khaman garnished with sev and pomegranate), Nylon khaman (softer and fast-cooking khaman) and Masala khaman (khaman served with hot and spicy chilly powder)                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '29'),
(72, ' Thepla', '1662982565-Tehepla.jpg', 100, 'Thepla - A Snack that every Gujarati Swear by!\r\nNo Gujarati journeys, picnics, foreign trips or even business trips are complete without this ubiquitous snack. Made from gram flour, whole wheat flour, fresh fenugreek leaves and spices, these flatbreads are healthy snacking options with a long shelf life. Usually served piping hot with fresh curd, pickles or chundo, they make wholesome meals. When accompanied by a cup of steaming hot tea, they also make a sumptuous breakfast or a great snack during the monsoon. Although the methi (fenugreek) ones are the most common, other varieties include palak (spinach), amaranth or muli (raddish) theplas-specially recommended for fussy eaters.                                                                                                                                                                                                                                                                                                                ', '29'),
(73, 'Khandvi ', '1662982634-Khandavi.jpg', 300, '   Khandvi - The Delectable Gujarati Naashta\r\n Thin layers of gram flour cooked with buttermilk and rolled up in mushy goodness, seasoned with sautéed sesame seeds and a few other spices, that\'s khandvi for you. The simple but aromatic garnishing of curry leaves, coriander, sautéed cumin, mustard and coconut makes it simply irresistible.  Also called \'suralichya wadya\' in Maharashtra, it is a popular snack among Gujaratis and Maharashtrians alike. Although loved by all, no one can deny that this dish is a little tricky to cook, especially getting the consistency of the batter right. Light on the stomach and pleasing on the tongue, khandvi can be a perfect breakfast item or a delectable evening snack.                                                                                                                  ', '29'),
(74, 'Handvo', '1662990516-Handavo.jpg', 400, 'Traditionally prepared over charcoal or in a pressure cooker, handvo is essentially a savoury cake. To prepare handvo, a batter of lentils and rice is prepared and fermented overnight, and then baked. They are sometimes also pan-fried to make them crispy and golden, and the sesame seed seasoning makes them just irresistible! These nutritious pan-fried or baked lentil cakes are a very popular one-dish meal in Gujarati households. Like most other Gujarati snacks, they are best enjoyed with tangy green chutney and a hot cuppa.', '29'),
(75, 'Lilva Kachori ', '1662990628-LilvaKachori.jpg', 800, 'A great winter and monsoon tea-time snack, kachoris are balls made of flour and stuffed with any filling of your choice. They are a popular delicacy in the western and northern part of India. Lilva Kachori is a special Gujarati dish, made with a filling of pigeon peas. To prepare these the kachori dough is prepared from white flour and semolina, rolled out and filled with the lilva mixture (pigeon peas, green chilies, coriander and spices), rolled into balls and then fried off. Best served with tangy chutney or sauce, this is a crunchy, tasty snack that can make the cold evenings warmer and more enjoyable.', '29'),
(76, 'Lassi', '1662990886-lassi.jpg', 60, '   A drink known far and wide, lassi is something Punjabi\'s pride themselves in. Though it can be salty, the original lassi as it became famous, is sweet with a dollop of cream and butter to make it as rich as you can. Flavours like mango rose or strawberry are added these days to give it a twist while beating the summer heat. Almost all restaurants serve this even if they\'re not Punjabi joints which show the popularity of this humble drink.                                                                                                                  ', '33'),
(77, 'Chole-Bhature', '1662990968-CholeBhature.jpg', 400, 'It\'s a standard Punjabi dish in most fast-food restaurants now. And these two accompany each other like a dream when you feel like indulging a little. Made with flour and milk rather than wheat flour, it\'s different from a poori. And although it\'s much larger than a poori, you can\'t just eat one because it\'s that tasty! The soft, slightly fermented bhatura should be your Go-to when you are craving some hardcore, spicy food of Punjab.', '33'),
(78, 'Parantha', '1662991019-Parantha.jpg', 180, 'No matter who you are, chances are that you\'ve had a parantha at least once in your life. This delectable offering has come to India through the annals of Punjabi cuisine, and what a discovery that was! Be it plain or stuffed, this bread is a staple of most Punjabi households. Even while travelling, the most preferred item to eat at a Dhaba is mostly always a paratha. Fried in desi ghee is the way most people in Punjab like it. Have with some cold curd and pickle, it is quite a humble match made in gastronomic heaven.\r\n\r\nThe possibilities of the stuffings are endless. Be it potatoes, onions, cottage cheese, keema to newer variants like bottle gourd, mangoes and almost anything you could imagine! The popularity is a testament is a fact that the national capital also has an area \'parathewali gali\' dedicated to serving up all possible varieties of it. Plus, like a roti, it doesn\'t even have to be round so you can definitely make it at home without being taunted about making a \'world map\' in the name of food!', '33'),
(79, 'Chillichicken', '1662991175-chillichicken.jpg', 300, ' Chilli chicken is probably most common Chinese dish readily available in all parts of the nation. In fact, it is so famous, that most roadside street food stalls even sell Chilli Chicken. It is prepared with a Soy Sauce Marinade forthe chicken. The Chicken marinade is cooked with Garlic, Ginger, and spices and stir-fried with Onions and Green Chillies.                                      ', '34'),
(80, 'Chicken Manchurian', '1662991241-chicken-manchurian.jpg', 200, 'Chicken Manchurian was supposedly created by the chef of China Garden in Mumbai in the year 1975, as he experimented with a variety of ingredients like Garlic, Chilli, and Ginger. The occasional use of Garam masala was replaced with soy Sauce. This mixture later became so famous that it even was attempted with Gobi, Mutton and Paneer.', '34'),
(81, 'Chowmein', '1662991281-chowmein.jpg', 400, 'Chowmein is a common dish in China as well as India. Over there, it is only boiled and served with Soy Sauce, Scrambled Eggs over the top resting on a layer of green vegetables. But in the Indian variant, it is prepared by stir-frying the boiled Noodles with Soy Sauce, Vinegar, and sometimes even MSG.', '34');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `op_id` int(12) NOT NULL,
  `op_uname` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `op_mobile` varchar(20) COLLATE latin1_general_cs NOT NULL,
  `op_pwd` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`op_id`, `op_uname`, `op_mobile`, `op_pwd`) VALUES
(24, 'admin000', '2020202020', 'admin000'),
(25, 'user999', '9099990999', 'user999'),
(26, 'user123', '8080808080', 'user123'),
(28, 'user000', '1020304050', 'user000');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_media`
--

CREATE TABLE `restaurant_media` (
  `m_id` int(12) NOT NULL,
  `m_logo` varchar(5000) COLLATE latin1_general_cs NOT NULL,
  `m_fav` varchar(5000) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `restaurant_media`
--

INSERT INTO `restaurant_media` (`m_id`, `m_logo`, `m_fav`) VALUES
(1, '16631515301-only logo.png', '1663151530-only logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_time_manage`
--

CREATE TABLE `restaurant_time_manage` (
  `res_time_id` int(11) NOT NULL,
  `res_days` varchar(200) COLLATE latin1_general_cs NOT NULL,
  `res_time_info` varchar(1000) COLLATE latin1_general_cs NOT NULL DEFAULT 'holiday'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `restaurant_time_manage`
--

INSERT INTO `restaurant_time_manage` (`res_time_id`, `res_days`, `res_time_info`) VALUES
(1, 'Monday', '11:00AM - 11:00PM'),
(2, 'Tuesday', '11:00AM - 11:00PM'),
(3, 'Wednesday', '11:00AM - 11:00PM'),
(4, 'Thursday', '11:00AM - 11:00PM'),
(5, 'Friday', '11:00AM - 11:00PM'),
(6, 'Saturday', '10:00AM - 12:00PM'),
(7, 'Sunday', 'holiday');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `t_id` int(12) NOT NULL,
  `t_name_or_num` varchar(3000) COLLATE latin1_general_cs NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`t_id`, `t_name_or_num`, `t_status`) VALUES
(56, 'Table 1', 0),
(57, 'Table 2', 0),
(59, 'Table 3', 1),
(60, 'Table 4', 0),
(61, 'Table 5', 1),
(74, 'Table 6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_booking`
--

CREATE TABLE `table_booking` (
  `tb_id` int(12) NOT NULL,
  `tb_book_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tb_date` date NOT NULL,
  `tb_time` time NOT NULL,
  `table_name_or_num` varchar(3000) COLLATE latin1_general_cs NOT NULL,
  `tb_num_of_people` int(12) NOT NULL,
  `tb_cus_name` varchar(1000) COLLATE latin1_general_cs NOT NULL,
  `l_mobile` varchar(13) COLLATE latin1_general_cs NOT NULL,
  `l_uname` varchar(30) COLLATE latin1_general_cs NOT NULL,
  `l_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `table_booking`
--

INSERT INTO `table_booking` (`tb_id`, `tb_book_time`, `tb_date`, `tb_time`, `table_name_or_num`, `tb_num_of_people`, `tb_cus_name`, `l_mobile`, `l_uname`, `l_id`) VALUES
(67, '2022-09-18 10:50:32', '2022-09-18', '17:20:00', 'Table 3', 3, 'gopal makwana', '1111111111', 'user111', 10),
(68, '2022-09-18 10:52:04', '2022-09-19', '18:10:00', 'Table 2', 2, 'pritam makwana', '9988776655', 'pritam', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`a_l_id`);

--
-- Indexes for table `admin_manage`
--
ALTER TABLE `admin_manage`
  ADD PRIMARY KEY (`a_manag_id`);

--
-- Indexes for table `admin_report`
--
ALTER TABLE `admin_report`
  ADD PRIMARY KEY (`a_r_id`);

--
-- Indexes for table `bill_customer_info`
--
ALTER TABLE `bill_customer_info`
  ADD PRIMARY KEY (`cus_bill_id`);

--
-- Indexes for table `bill_order_items`
--
ALTER TABLE `bill_order_items`
  ADD PRIMARY KEY (`boi_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `restaurant_media`
--
ALTER TABLE `restaurant_media`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `restaurant_time_manage`
--
ALTER TABLE `restaurant_time_manage`
  ADD PRIMARY KEY (`res_time_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `table_booking`
--
ALTER TABLE `table_booking`
  ADD PRIMARY KEY (`tb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `a_l_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_manage`
--
ALTER TABLE `admin_manage`
  MODIFY `a_manag_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_report`
--
ALTER TABLE `admin_report`
  MODIFY `a_r_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `bill_customer_info`
--
ALTER TABLE `bill_customer_info`
  MODIFY `cus_bill_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `bill_order_items`
--
ALTER TABLE `bill_order_items`
  MODIFY `boi_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `l_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `cate_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `op_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `restaurant_media`
--
ALTER TABLE `restaurant_media`
  MODIFY `m_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant_time_manage`
--
ALTER TABLE `restaurant_time_manage`
  MODIFY `res_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `t_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `table_booking`
--
ALTER TABLE `table_booking`
  MODIFY `tb_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
