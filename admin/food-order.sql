-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 01:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(16, 'zeer', 'reez', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(13, 'Burgers', 'Food_Category_553.jpg', 'Yes', 'Yes'),
(14, 'Pizza', 'Food_Category_399.jpg', 'Yes', 'Yes'),
(15, 'Rice Meals', 'Food_Category_459.jpg', 'Yes', 'Yes'),
(16, 'Juices', 'Food_Category_869.jpg', 'No', 'Yes'),
(17, 'Milk Tea', 'Food_Category_726.jpg', 'No', 'Yes'),
(18, 'Pasta', 'Food_Category_565.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(35, 'BM1', 'Regular Burger w/ Fries, and Coke.', 90.00, 'Food-Name-3590.jpg', 13, 'Yes', 'Yes'),
(36, 'BM2', 'Cheese Burger, w/ Fries, and Coke.', 100.00, 'Food-Name-3952.jpg', 13, 'Yes', 'Yes'),
(37, 'Federicos Big Bite Finale', 'Overload Patty Burger w/ Fries and Coke.', 180.00, 'Food-Name-672.jpg', 13, 'Yes', 'Yes'),
(38, 'BM3', 'Ham and Cheese Muffin w/ Fries and Coke.', 105.00, 'Food-Name-762.jpg', 13, 'No', 'Yes'),
(39, 'BM4', 'Footlong and Coleslaw w/ Fries and Coke.', 110.00, 'Food-Name-482.jpg', 13, 'No', 'Yes'),
(40, 'BM5', 'Crispy Chicken Sandwich w/ Fries and Coke.', 130.00, 'Food-Name-607.jpg', 13, 'No', 'Yes'),
(41, 'Mozzarella Pizza', 'Mozzarella Pizza Family size 12inches (12 Slices).', 550.00, 'Food-Name-7757.jpg', 14, 'Yes', 'Yes'),
(43, 'Hawaiian', 'Hawaiian Family size 12inches (12 Slices).', 570.00, 'Food-Name-6238.jpg', 14, 'Yes', 'Yes'),
(44, 'Cheese & Cheesy', 'Cheesy Pizza Family size 12inches (12 Slices).', 540.00, 'Food-Name-4122.jpg', 14, 'No', 'Yes'),
(45, 'Spinach Pizza', 'Spinach Pizza Family size 12inch (12 Slices).', 570.00, 'Food-Name-957.jpg', 14, 'Yes', 'Yes'),
(46, 'YC Regular', 'Fried Rice with sausage, and ham. w/ any drinks.', 100.00, 'Food-Name-657.jpg', 15, 'No', 'Yes'),
(47, 'YC Siomai on top', 'Fried Rice with Somai on top. w/ any drinks.', 110.00, 'Food-Name-566.jpg', 15, 'No', 'Yes'),
(48, 'Glazed Pork', 'Glazed Pork with rice and any drinks.', 120.00, 'Food-Name-635.jpg', 15, 'No', 'Yes'),
(49, 'Fried Tilapia', 'Fried Tilapia with rice and any drinks.', 125.00, 'Food-Name-378.jpg', 15, 'No', 'Yes'),
(50, 'Orange Juice', 'Refreshing Orange Juice.', 30.00, 'Food-Name-302.jpg', 16, 'No', 'Yes'),
(51, 'Lemon Juice', 'Refreshing Lemon Juice.', 30.00, 'Food-Name-6853.jpg', 16, 'No', 'Yes'),
(52, 'Raspberry Juice', 'Refreshing Raspberry Juice.', 35.00, 'Food-Name-477.jpg', 16, 'No', 'Yes'),
(53, 'Lemon Ice Tea', 'Refreshing Lemon Ice Tea Juice.', 30.00, 'Food-Name-801.jpg', 16, 'No', 'Yes'),
(54, 'Four Season Juice', 'Refreshing Four Season Juice.', 30.00, 'Food-Name-772.jpg', 16, 'No', 'Yes'),
(55, 'Pineapple Juice', 'Refreshing Pineapple Juice.', 30.00, 'Food-Name-269.jpg', 16, 'No', 'Yes'),
(56, 'Choco Milk Tea', 'Delicious Choco Milk Tea.', 80.00, 'Food-Name-383.jpg', 17, 'No', 'Yes'),
(57, 'Wintermelon Milk Tea', 'Delicious Wintermelon Milk Tea.', 80.00, 'Food-Name-132.jpg', 17, 'No', 'Yes'),
(58, 'Blueberry Milk Tea', 'Delicious Blueberry Milk Tea.', 85.00, 'Food-Name-353.jpg', 17, 'No', 'Yes'),
(59, 'Taro Milk Tea', 'Delicious Taro Milk Tea.', 80.00, 'Food-Name-8920.jpg', 17, 'No', 'Yes'),
(60, 'Strawberry Milk Tea', 'Delicious Strawberry Milk Tea.', 85.00, 'Food-Name-248.jpg', 17, 'No', 'Yes'),
(61, 'Okinawa Milk Tea', 'Delicious Okinawa Milk Tea.', 80.00, 'Food-Name-867.jpg', 17, 'No', 'Yes'),
(62, 'Macaroni Salad', 'Delicious appetizer food.', 70.00, 'Food-Name-17.jpg', 18, 'No', 'Yes'),
(63, 'Lasagna Pasta', 'Delicious meal for pasta lover.', 90.00, 'Food-Name-572.jpg', 18, 'No', 'Yes'),
(64, 'Rigatoni Pasta', 'Short, wide tubes of pasta that have ridges on the outside. but are smooth on the inside.', 130.00, 'Food-Name-172.jpg', 18, 'No', 'Yes'),
(65, 'Manicotti Pasta', 'It is a very large tube-shaped pasta, usually ridged, that is stuffed and baked.', 120.00, 'Food-Name-184.jpg', 18, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manager`
--

CREATE TABLE `tbl_manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `u_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `u_id`) VALUES
(19, 'BM1', 100.00, 1, 100.00, '2025-01-17 05:45:48', 'Delivered', 25),
(20, 'BM1', 90.00, 1, 90.00, '2025-01-17 08:52:21', 'On Delivery', 25),
(21, 'Mozzarella Pizza', 550.00, 1, 550.00, '2025-01-17 10:56:14', 'Ordered', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_contact` bigint(25) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `customer_name`, `customer_email`, `customer_contact`, `customer_address`, `created_at`) VALUES
(25, 'zeer', '$2y$10$pUlBcAPUZJ7WFL70zAVNMe.PiW5KxbLCIrlqOED3gKxPPkKlgsJl2', 'zeer seer', 'titenaman@gmail.com', 9297617613, 'Manila Sta. Ana         ', '2025-01-17 12:33:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
