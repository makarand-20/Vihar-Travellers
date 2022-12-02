-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 06:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maku_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'maku', 'maku');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(38, 'IMG_61186.jpg'),
(39, 'IMG_25681.jpg'),
(41, 'IMG_50995.jpg'),
(43, 'IMG_61446.jpg'),
(44, 'IMG_79859.jpg'),
(46, 'IMG_33601.jpg'),
(47, 'IMG_40878.jpg'),
(48, 'IMG_39622.jpg'),
(49, 'IMG_11925.jpg'),
(50, 'IMG_45053.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `con_email` varchar(50) NOT NULL,
  `pn1` varchar(20) NOT NULL,
  `op_hour` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `iframe` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `con_email`, `pn1`, `op_hour`, `gmap`, `iframe`) VALUES
(1, 'A108 Viit, kondhawa, Pune', 'makarandkhiste123@gmail.com', '7666251955', 'Mon-Sat: 12AM - 24PM', 'https://goo.gl/maps/8tKpzhnTdNqXGcMc7', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d121059.04360431962!2d73.79292691953974!3d18.524603553454465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf2e67461101:0x828d43bf9d9ee343!2sPune, Maharashtra!5e0!3m2!1sen!2sin!4v1668754395787!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `extra_carousel`
--

CREATE TABLE `extra_carousel` (
  `sr_no` int(11) NOT NULL,
  `images` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extra_carousel`
--

INSERT INTO `extra_carousel` (`sr_no`, `images`) VALUES
(7, 'IMG_96463.jpg'),
(8, 'IMG_82019.jpg'),
(9, 'IMG_11786.jpg'),
(10, 'IMG_54092.jpg'),
(11, 'IMG_90509.jpg'),
(12, 'IMG_98539.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `sr_no` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`sr_no`, `icon`, `name`, `description`) VALUES
(9, 'IMG_52158.svg', 'Accomodation', 'Comfortable &amp; convenient hotels cherry picked by our hotel management team.'),
(10, 'IMG_50382.svg', 'Meals', 'Eat to your heart&#039;s content Breakfast, Lunch, Dinner.'),
(11, 'IMG_79922.svg', 'Money', 'Our research team spends hours curating the best value for money itineraries.'),
(12, 'IMG_32156.svg', 'Transport', 'Our itineraries include all rail, sea and road transport as part of the itinerary so you can enjoy tension free.'),
(14, 'IMG_97519.svg', 'Plane', 'maku World tours are inclusive of airfare from many hubs within India unless you pick the joining-leaving option.'),
(16, 'IMG_93295.svg', 'Flag', 'We have an exclusive team of 350 tour managers specialising in India and World tours, who taking care of our clients.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`sr_no`, `name`) VALUES
(10, 'Meal'),
(11, 'Sightseeing'),
(13, 'Hotel'),
(16, 'Flight &amp; Visa');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(500) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Maku', 'The oldest classical British and Latin writing had little or no space between words and could be written in boustrophedon alternating ways.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(47, 'Makarand Khiste', 'IMG_95199.jpg'),
(48, 'Mahima Herkar', 'IMG_90516.jpg'),
(49, 'Saloni Wagh', 'IMG_68189.jpg'),
(53, 'Siddharth Sir', 'IMG_32688.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(50) NOT NULL,
  `package_type` varchar(50) NOT NULL,
  `speciality_tour` varchar(50) NOT NULL,
  `days` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `feature_name`, `package_type`, `speciality_tour`, `days`, `price`, `location`, `description`, `quantity`, `status`, `removed`) VALUES
(13, 'Kashmir Vibes', 'Customized', 'Honeymoon', 500, 858470, 'Kulu Manali', 'Best Trip', 4, 1, 0),
(14, 'Goa Rocks', 'Guest', 'Friends', 14, 40000, 'Goa', 'Very Nice Trip!', 2, 1, 0),
(15, 'Gujarat special', 'Customized', 'Guest', 44, 1, 'Gujarat', 'Enjoy!', 100, 1, 0),
(16, 'Kokan Special', 'Friends', 'Friends', 5, 45000, 'Kokann', 'Habibi, Come to Kokan', 10, 1, 0),
(17, 'Bahamas op', 'Customized', 'Honeymoon', 12, 2, 'bahamas', 'Love you 3000!', 1, 1, 0),
(18, 'sdf', 'sdfa', 'sdf', 3, 3, 'asdf', 'sdf', 3, 1, 1),
(19, 'Saloni Patil', 'customzed', 'honeymoon', 12, 1500000, 'Manali', 'sadfasfasegaegf', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_features`
--

CREATE TABLE `tour_features` (
  `sr_no` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_features`
--

INSERT INTO `tour_features` (`sr_no`, `tour_id`, `features_id`) VALUES
(110, 16, 10),
(111, 16, 16),
(140, 17, 11),
(141, 17, 13),
(142, 13, 10),
(143, 13, 11),
(144, 13, 13),
(145, 13, 16),
(155, 14, 10),
(156, 14, 11),
(157, 14, 13),
(158, 14, 16),
(159, 15, 10),
(160, 15, 11),
(161, 15, 13),
(162, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tour_images`
--

CREATE TABLE `tour_images` (
  `sr_no` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_images`
--

INSERT INTO `tour_images` (`sr_no`, `tour_id`, `image`, `thumb`) VALUES
(15, 13, 'IMG_50612.jpg', 0),
(16, 14, 'IMG_91435.jpg', 0),
(19, 17, 'IMG_42666.jpg', 1),
(21, 17, 'IMG_78377.jpg', 0),
(22, 15, 'IMG_66493.jpg', 0),
(23, 15, 'IMG_57924.jpg', 0),
(24, 15, 'IMG_73087.jpg', 0),
(25, 15, 'IMG_54656.jpg', 1),
(26, 15, 'IMG_72155.jpg', 0),
(27, 15, 'IMG_38825.jpg', 0),
(28, 15, 'IMG_21725.jpg', 0),
(29, 15, 'IMG_46083.jpg', 0),
(31, 14, 'IMG_52248.jpg', 0),
(32, 14, 'IMG_66187.jpg', 0),
(36, 16, 'IMG_51125.jpg', 0),
(37, 16, 'IMG_80399.jpg', 0),
(38, 14, 'IMG_31899.jpg', 1),
(39, 16, 'IMG_31700.jpg', 1),
(40, 13, 'IMG_17763.jpg', 0),
(41, 13, 'IMG_37124.jpg', 0),
(42, 13, 'IMG_94717.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `pass` varchar(200) NOT NULL,
  `profile` varchar(150) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `phonenum`, `address`, `pincode`, `dob`, `pass`, `profile`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(15, 'Mahima', 'herkarmahima2003@gmail.com', '9579536421', 'Pune', 413047, '2022-11-28', '$2y$10$J3HcCweeguWtiJpACRjNf.ZjmJhdj9mSZ6FKAy/5chRWq6d6OU9NK', 'IMG_85287.jpeg', 1, '89686c9d5062685403cddbd6852adad2', '2022-12-02', 1, '2022-12-02 07:29:35'),
(16, 'Saloni', 'saloniwagh2@gmail.com', '9322491834', 'Pune', 413047, '2022-11-28', '$2y$10$1bOyX298sEJO2r0KmDggxeE3eW/aH1NjeUj1cDF6dsyjHVg2aarUe', 'IMG_51475.jpeg', 0, '5d92ae6ea4e8198d08e4279362b6a010', NULL, 1, '2022-12-02 07:36:33'),
(18, 'Sid', 'sid.block4@gmail.com', '1023045698', 'Pune', 413047, '2022-12-06', '$2y$10$MO8bbmW2iV4yzXeQQ.6jkeWNDWdzPrfuFsETIu5K.RIPMBlFdvObG', 'IMG_72161.jpeg', 1, '6da1954b48cbe953990892a845d3aaf9', '2022-12-02', 1, '2022-12-02 10:15:07'),
(22, 'Makarand', 'makarand.code@gmail.com', '7666251951', 'Pune', 413304, '2022-12-01', '$2y$10$sc4ZYk2tiC3s0o88c8dkX.oMaViElGk1DzSJB0GM2WzyBWAhoHt5q', 'IMG_61010.jpeg', 1, NULL, NULL, 1, '2022-12-02 11:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(49, 'Makarand', 'makarandkhiste123@gmail.com', 'Debugging', 'on going project', '2022-11-19', 0),
(50, 'Saloni', 'salo@gmail.com', 'Checking', 'Still going on', '2022-11-19', 0),
(51, 'Siddharth', 'sid@gmail.com', 'Trying', 'Just trying to add it.', '2022-11-19', 0),
(52, 'Mahima', 'mahi@gamil.com', 'Checkout', 'We are the best!', '2022-11-19', 0),
(53, 'Arkam', 'arkam@gamil.com', 'ContactUs', 'Contact Us page', '2022-11-19', 0),
(55, 'You Tube', 'youtube@google.com', 'Admin', 'admin did good', '2022-11-19', 1),
(56, 'Shop Details', 'shopdetail@gamil.com', 'Enter Subject', 'mobile number 7666251951', '2022-11-19', 0),
(57, 'Firebase', 'firebase@gmail.com', 'best database', 'best database ever used', '2022-11-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `extra_carousel`
--
ALTER TABLE `extra_carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_features`
--
ALTER TABLE `tour_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `tour id` (`tour_id`),
  ADD KEY `features id` (`features_id`);

--
-- Indexes for table `tour_images`
--
ALTER TABLE `tour_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extra_carousel`
--
ALTER TABLE `extra_carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tour_features`
--
ALTER TABLE `tour_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tour_images`
--
ALTER TABLE `tour_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tour_features`
--
ALTER TABLE `tour_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`sr_no`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tour id` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `tour_images`
--
ALTER TABLE `tour_images`
  ADD CONSTRAINT `tour_images_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
