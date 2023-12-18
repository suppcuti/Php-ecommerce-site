-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 12:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `category` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `info`) VALUES
(2, 'Guest Watch', 2500, 'watch', 'An Luxury watch'),
(3, 'Panerai Watch', 3500, 'watch', 'An Luxury watch'),
(4, 'Nonos Watch', 1800, 'watch', 'An Luxury watch'),
(5, 'Levis', 1800, 'watch', 'An Luxury watch'),
(6, 'louis philippe t-shirt', 2500, 't-shirt', 'An good T-shirt'),
(7, 'Highlander t-shirt', 500, 't-shirt', 'An good T-shirt'),
(8, 'GUCCI White t-Shirt', 2300, 't-shirt', 'An good T-shirt'),
(9, 'Nike White Sneaker', 8000, 'shoe', 'The radiance live on in the Nike Air Force 1,07 the basketball original that puts a fresh spin on what you know the best.'),
(10, 'Nike White Shoes', 7500, 'shoe', 'The radiance live on in the Nike Air Force 1,07 the basketball original that puts a fresh spin on what you know the best.'),
(11, 'Nike Yellow Sneaker', 7000, 'shoe', 'The radiance live on in the Nike Air Force 1,07 the basketball original that puts a fresh spin on what you know the best.'),
(12, 'Nike Brown Sneaker', 6000, 'shoe', 'The radiance live on in the Nike Air Force 1,07 the basketball original that puts a fresh spin on what you know the best.'),
(13, 'Beats Headphone', 22500, 'headphone', 'A Lux'),
(14, 'Zolo Headphone', 4500, 'headphone', 'A Lux'),
(15, 'Sony Speaker', 10500, 'headphone', 'A Lux'),
(24, 'Puma RBD Game Low trainers in ', 4800, 'shoe', 'Disrupting the game since 1948, Puma is out to set and smash goals in its bid to be the fastest sports brand in the world. Scroll the Puma at ASOS edit for the pieces we’re rating right now, from staple comfies like joggers, hoodies and sweatshirts to cap'),
(25, 'Puma Slipstream trainers in wh', 5200, 'shoe', 'Disrupting the game since 1948, Puma is out to set and smash goals in its bid to be the fastest sports brand in the world. Scroll the Puma at ASOS edit for the pieces we’re rating right now, from staple comfies like joggers, hoodies and sweatshirts to cap'),
(28, 'ASOS DESIGN boat shoes in navy', 2700, 'shoe', 'This is ASOS DESIGN – your go-to for all the latest trends, no matter who you are, where you’re from and what you’re up to. Exclusive to ASOS, our universal brand is here for you, and comes in Plus and Tall. Created by us, styled by you.'),
(29, 'ASOS DESIGN mule slippers in f', 1100, 'shoe', 'This is ASOS DESIGN – your go-to for all the latest trends, no matter who you are, where you’re from and what you’re up to. Exclusive to ASOS, our universal brand is here for you, and comes in Plus and Tall. Created by us, styled by you.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `first_name`, `last_name`, `phone`, `registration_time`, `password`) VALUES
(65, 'sharew5m123@gmail.com', 'reys', 'rudt', 0, '2019-03-18 13:46:33', 'e4f194cba29960e12d8b8f1bfedc972b'),
(66, 'sgah234@gmail.com', 'werty', 'erty', 0, '2019-03-18 13:55:46', 'e10adc3949ba59abbe56e057f20f883e'),
(67, 'sham1234@gmail.com', 'Sham', 'das', 0, '2019-03-19 07:37:46', 'e10adc3949ba59abbe56e057f20f883e'),
(68, 'khongdotot2@gmail.com', 'TÀI', 'TÀI', 0, '2023-12-14 05:55:14', '0e2c098f477a1ac527d969bd8701dd0d'),
(69, 'admin@gmail.com', 'Admin', 'Yes', 0, '2023-12-14 06:07:27', '0e2c098f477a1ac527d969bd8701dd0d');

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE `users_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` enum('Added To Cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
