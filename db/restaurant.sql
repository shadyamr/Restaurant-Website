-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 10:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Category` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Category`) VALUES
(1, 'Drinks'),
(2, 'Breakfast'),
(3, 'Lunch'),
(4, 'Dinner'),
(5, 'Compose a Sandwich');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(256) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`) VALUES
(1, 'Burger', 'Chargrilled premium 100% beef, topped with American cheese.', 'burger.png', 82),
(2, 'Pizza', 'Thin-crust pizza topped with chicken and mushrooms.', 'pizza.png', 60),
(3, 'Pasta', 'Italian Pasta covered in red sauce and topped with fried chicken & cheese.', 'pasta.png', 50),
(4, 'Kebda', 'Alexandrian Kebda topped with tahini sauce and chopped peppers in ficelle bread.', 'kebda.png', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `LastName` varchar(128) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Pass` varchar(256) NOT NULL,
  `Role` int(11) NOT NULL COMMENT 'User (0), Waiter (1), QC (2), Admin (3)',
  `Access` int(11) NOT NULL,
  `National_ID` int(14) NOT NULL,
  `National_ID_Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Username`, `Email`, `Pass`, `Role`, `Access`, `National_ID`, `National_ID_Image`) VALUES
(1, 'Shady', 'Amr', 'admin', 'shady@shady.com', '$2y$10$0FWzXKHPiuLfcHMzgOWpCuRv0mTbpNwLty2q0CXN0MLXscn1ejfxy', 0, 1, 2147483647, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
