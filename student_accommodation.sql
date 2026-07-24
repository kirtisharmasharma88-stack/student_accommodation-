-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2026 at 01:15 PM
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
-- Database: `student_accommodation`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interested_users`
--

CREATE TABLE `interested_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interested_users`
--

INSERT INTO `interested_users` (`id`, `user_id`, `property_id`) VALUES
(3, 1, 3),
(6, 2, 3),
(7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `gender` enum('Boys','Girls','Both') DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `city`, `address`, `price`, `gender`, `rating`, `description`, `image`) VALUES
(1, 'Sunrise PG', 'Delhi', 'Laxmi Nagar', 6500, '', 4.5, 'Fully Furnished PG', 'pg1.jpg'),
(2, 'Green Villa', 'Noida', 'Sector 62', 8500, '', 4.8, 'AC Room Available', 'pg2.jpg'),
(3, 'Royal Stay', 'Dehradun', 'Prem Nagar', 6000, '', 4.3, 'Near Uttaranchal University', 'pg3.jpg'),
(4, 'Comfort PG', 'Meerut', 'Shastri Nagar', 5500, '', 4.2, 'Affordable Rooms', 'pg4.jpg'),
(5, 'Green Valley PG', 'Noida', 'Sector 62, Noida', 6500, 'Boys', 4.5, 'Comfortable PG with WiFi, Mess, Laundry and CCTV security.', 'pg1.jpg'),
(6, 'Sunrise Girls Hostel', 'Delhi', 'Laxmi Nagar, Delhi', 7000, 'Girls', 4.6, 'Safe girls hostel with 24x7 security, WiFi and healthy meals.', 'pg2.jpg'),
(7, 'Royal Residency', 'Ghaziabad', 'Raj Nagar, Ghaziabad', 6000, 'Boys', 4.3, 'Affordable accommodation with furnished rooms and parking.', 'pg3.jpg'),
(8, 'Urban Nest PG', 'Greater Noida', 'Knowledge Park, Greater Noida', 7500, 'Both', 4.7, 'Modern PG with AC rooms, WiFi and study area.', 'pg4.jpg'),
(9, 'Campus Inn', 'Meerut', 'Shastri Nagar, Meerut', 5500, 'Boys', 4.2, 'Budget-friendly student accommodation near colleges.', 'pg5.jpg'),
(10, 'Elite Residency', 'Gurugram', 'Sector 14, Gurugram', 9000, 'Both', 4.8, 'Premium PG with gym, WiFi, laundry and housekeeping.', 'pg6.jpg'),
(11, 'Happy Homes PG', 'Faridabad', 'Sector 15, Faridabad', 6200, 'Girls', 4.4, 'Clean and secure girls PG with CCTV and meals.', 'pg7.jpg'),
(12, 'Student Paradise', 'Lucknow', 'Aliganj, Lucknow', 5800, 'Both', 4.3, 'Comfortable rooms with study desk and high-speed internet.', 'pg8.jpg'),
(13, 'Blue Sky Hostel', 'Jaipur', 'Malviya Nagar, Jaipur', 6800, 'Girls', 4.5, 'Spacious hostel with parking and recreational area.', 'pg9.jpg'),
(14, 'Smart Living PG', 'Chandigarh', 'Sector 22, Chandigarh', 8500, 'Boys', 4.7, 'Luxury student accommodation with modern facilities.', 'pg10.jpg'),
(15, 'Dream Stay Hostel', 'Dehradun', 'Rajpur Road, Dehradun', 7200, 'Girls', 4.6, 'Peaceful hostel with WiFi, meals and security.', 'pg11.jpg'),
(16, 'Comfort Stay PG', 'Agra', 'Sanjay Place, Agra', 5600, 'Both', 4.2, 'Affordable PG with furnished rooms and friendly environment.', 'pg12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_amenities`
--

CREATE TABLE `property_amenities` (
  `property_id` int(11) DEFAULT NULL,
  `amenity_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'Savita sharma', 'Savitasharma89@gmail.com', '9684560953', '$2y$10$SbkaUSG7uZZTep/MQfHgPO98EQIrvYHPSaYyXcmO5yi4/WIV4qv1C', '2026-07-21 18:53:31'),
(2, 'PANKAJ SHARMA', 'PANKAJ@gmail.com', '8938836349', '$2y$10$8h8yaF1MD8V6..GnNlAJiOHXE87.kqqm6jG8GuUNifh.HCwCjlCPS', '2026-07-21 18:54:33'),
(3, 'KRISHNA', 'SHARMA@GMAIL.COM', '7453725479', '$2y$10$snCWChkL7NJV6sFkIZxDCOqyXU4j/U76vGNfVHP01RJn79iKmdkU6', '2026-07-21 19:04:01'),
(4, 'shiv', 'shiv@gmail.com', '783478489934', '$2y$10$OBHV55IfZIaWZfFHE6.4oer7dXjXgwBHejuQdlx9OMSedpRBv2sL6', '2026-07-23 16:49:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interested_users`
--
ALTER TABLE `interested_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD KEY `property_id` (`property_id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interested_users`
--
ALTER TABLE `interested_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interested_users`
--
ALTER TABLE `interested_users`
  ADD CONSTRAINT `interested_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `interested_users_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD CONSTRAINT `property_amenities_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `property_amenities_ibfk_2` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
