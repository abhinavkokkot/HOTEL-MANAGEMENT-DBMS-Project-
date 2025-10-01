
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 07:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_id`, `customer_email`, `checkin`, `checkout`) VALUES
(16, 11, 'vishu@gmil.com', '2025-09-18', '2025-09-30'),
(27, 2, 'vyshak@123', '2025-09-23', '2025-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`name`, `email`, `phone`, `address`, `password`) VALUES
('Abhinav k', 'abhinavkokkot@gmail.com', 2147483647, 'Pilicode', '$2y$10$6Y5/ug671OnQ8.k4orZePOejJNiQz78RODnipLb6sEmWiYQiopr0S'),
('Abhinav k', 'himhsdhs@gmail.com', 75107545, 'Pilicode', '$2y$10$GnkUp3H//Ybk3wu/5NPtCOPg6MdvUQ8fOXGR/hRKckSeujukOHpCi'),
('vishal', 'vishal@123', 1123, '123', '$2y$10$oXzo2nPr8CHGc91qY0qWgO3Fk0jCOvFHT6XRhgWIMdliKbnGX1k3G'),
('vishu', 'vishu@gmil.com', 656675766, 'ggh', '$2y$10$SEkgsv3gUdofWpAw0lpPIeTqtZwF5NsoJPVuWne7yvs/eutqzQHAW'),
('vyshak vivek', 'vyshak@123', 987654321, 'naduvil don', '$2y$10$fXe/QJ4VtVev76I.BkUb6eiBi.ukVAmrdLdhX5mfjYeTUYEiEEAzi');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(226) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `title`, `description`, `price`, `image`, `type`) VALUES
(2, 'Premium Single Room', 'Larger room with modern furniture and city view.', 2500, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single'),
(3, 'Economy Single Room', 'Compact room, perfect for short stays.', 1800, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single'),
(4, 'Deluxe Single Room', 'Elegant room with premium linens and decor.', 3000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single'),
(5, 'Suite Single Room', 'Spacious single suite with living area.', 3500, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single'),
(6, 'Luxury Single Room', 'Top-class room with luxury amenities and view.', 4000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single'),
(7, 'Standard Double Room', 'Cozy double room with all essential amenities.', 3000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(8, 'Premium Double Room', 'Larger room with modern furniture and city view.', 3500, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(9, 'Economy Double Room', 'Compact room, perfect for short stays.', 2800, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(10, 'Deluxe Double Room', 'Elegant room with premium linens and decor.', 4000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(11, 'Suite Double Room', 'Spacious double suite with living area.', 4500, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(12, 'Luxury Double Room', 'Top-class room with luxury amenities and view.', 5000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'double'),
(13, 'Standard Luxury Room', 'Elegant luxury room with all essential amenities.', 5000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(14, 'Premium Luxury Room', 'Spacious luxury room with modern furniture and city view.', 6000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(15, 'Economy Luxury Room', 'Affordable luxury room, perfect for short stays.', 4500, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(16, 'Deluxe Luxury Room', 'Premium luxury room with elegant decor and linens.', 7000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(17, 'Suite Luxury Room', 'Large luxury suite with separate living area.', 8000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(18, 'Presidential Luxury Room', 'Top-class luxury room with exclusive amenities and view.', 10000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'luxury'),
(19, 'wewe', 'roooooom', 12, 'https://i.pinimg.com/736x/2c/7d/d4/2c7dd4eae0ac6acf12fdeff7326958f9.jpg', 'single'),
(21, 'Standard single Room', 'Elegant luxury room with all essential amenities.', 4000, 'https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg', 'single');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `customer_email` (`customer_email`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_email`) REFERENCES `customers` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
>>>>>>> ec1b4f0 (contact)
