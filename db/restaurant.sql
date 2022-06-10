-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 01:36 AM
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
-- Table structure for table `breadstock`
--

CREATE TABLE `breadstock` (
  `BreadID` int(10) NOT NULL,
  `BreadName` varchar(10) NOT NULL,
  `BreadPrice` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breadstock`
--

INSERT INTO `breadstock` (`BreadID`, `BreadName`, `BreadPrice`) VALUES
(1, 'Tortilla', 30),
(2, 'White', 35),
(3, 'Peta', 40);

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
-- Table structure for table `componentstock`
--

CREATE TABLE `componentstock` (
  `VegetableID` int(10) NOT NULL,
  `VegetableName` varchar(10) NOT NULL,
  `VegetablePrice` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `componentstock`
--

INSERT INTO `componentstock` (`VegetableID`, `VegetableName`, `VegetablePrice`) VALUES
(1, 'Tomato', 20),
(2, 'Lettuce', 20),
(3, 'Cucumber', 20);

-- --------------------------------------------------------

--
-- Table structure for table `credit_code`
--

CREATE TABLE `credit_code` (
  `ID` int(11) NOT NULL,
  `Code` varchar(128) NOT NULL,
  `Amount` int(11) NOT NULL DEFAULT 10,
  `Used` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_code`
--

INSERT INTO `credit_code` (`ID`, `Code`, `Amount`, `Used`) VALUES
(1, 'sHadY%cOdE', 10, 0),
(2, 'ShadyCodeTest', 10, 0),
(3, 'PandaPoints', 10, 1),
(4, 'Test123456', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mainstock`
--

CREATE TABLE `mainstock` (
  `MainID` int(10) NOT NULL,
  `MainName` varchar(10) NOT NULL,
  `MainPrice` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mainstock`
--

INSERT INTO `mainstock` (`MainID`, `MainName`, `MainPrice`) VALUES
(1, 'Meat', 50),
(2, 'Chicken', 60),
(3, 'Fish', 70);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `OrderDetails` longtext NOT NULL,
  `Total` int(11) NOT NULL,
  `Method` int(11) NOT NULL,
  `Processed` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `Customer_ID`, `OrderDetails`, `Total`, `Method`, `Processed`, `Date`) VALUES
(1, 1, '\r\n            <b>Product:</b> Burger<br>\r\n            <b>Quantity:</b> 1<br><br>', 82, 1, 0, '2022-06-10 23:33:05'),
(2, 2, '\r\n            <b>Product:</b>Pizza<br>\r\n            <b>Quantity:</b>1<br><br>', 60, 1, 0, '2022-06-10 23:23:38'),
(4, 1, '\r\n            <b>Product:</b> Kebda<br>\r\n            <b>Quantity:</b> 5<br><br>', 100, 1, 0, '2022-06-10 23:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(256) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `cat_id`, `image`, `price`) VALUES
(1, 'Burger', 'Chargrilled premium 100% beef, topped with American cheese.', 4, 'burger.png', 82),
(2, 'Pizza', 'Thin-crust pizza topped with chicken and mushrooms.', 4, 'pizza.png', 60),
(3, 'Pasta', 'Italian Pasta covered in red sauce and topped with fried chicken & cheese.', 3, 'pasta.png', 50),
(4, 'Kebda', 'Alexandrian Kebda topped with tahini sauce and chopped peppers in ficelle bread.', 3, 'kebda.png', 20);

-- --------------------------------------------------------

--
-- Table structure for table `saucestock`
--

CREATE TABLE `saucestock` (
  `SauceID` int(10) NOT NULL,
  `SauceName` varchar(10) NOT NULL,
  `SaucePrice` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saucestock`
--

INSERT INTO `saucestock` (`SauceID`, `SauceName`, `SaucePrice`) VALUES
(1, 'Ketchup', 10),
(2, 'Mayo', 10),
(3, 'Mustard', 10);

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
  `Role` int(11) NOT NULL COMMENT 'User (0), Waiter (1), QC (2)',
  `Access` int(11) NOT NULL,
  `National_ID` int(14) NOT NULL,
  `National_ID_Image` text NOT NULL,
  `ProfilePicture` text NOT NULL,
  `Wallet` int(50) NOT NULL,
  `Governorate` varchar(20) NOT NULL,
  `Comments` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Username`, `Email`, `Pass`, `Role`, `Access`, `National_ID`, `National_ID_Image`, `ProfilePicture`, `Wallet`, `Governorate`, `Comments`) VALUES
(1, 'Shady', 'Amr', 'shady', 'shady@shady.com', '$2y$10$KCfG.wUz0s2X5wky.NzE1uAfcSxn8ZnL0FYrwpGw2IJFbg9WPEK8S', 2, 1, 2315, 'shady.jpg', 'shady.jpg', 0, 'Cairo', 'None'),
(2, 'Ahmed', 'Hossam', 'xik', 'xik@xik.com', '$2y$10$Z2mgJgO6BuN0LaSBOxx5q.GbCm9qJ1Z4ETAo1fW5iL2W30spUQcaC', 0, 1, 123, '', 'default.jpg', 0, 'Suez', 'None'),
(3, 'Seif', 'Hisham', 'seif', 'seif@seif.com', '$2y$10$lqjWHrmhia4FHuaczpgCluV9EyOkABNZ9PVVVk.PQWFQMmUlrUkP6', 0, 1, 123, '', 'default.jpg', 0, 'Cairo', 'None'),
(4, 'Mostafa', 'Saleh', 'mo', 'mostafa@mostafa.com', '$2y$10$YnIah8kezGRB0ldZ58lR5eVdLB85xYLUeHfFagIScCY4b/ouXll5u', 1, 1, 123, '', 'default.jpg', 0, 'Cairo', 'None'),
(5, 'Mahmoud', 'Osama', 'na3k4a', 'mahmoud@mahmoud.com', '$2y$10$MooTfCQJ/agPdgTSVTY83uAmLoCeFcTv6mRrFQ8s9EUzCHVFnM4j6', 1, 1, 123, '', 'default.jpg', 0, 'Cairo', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breadstock`
--
ALTER TABLE `breadstock`
  ADD PRIMARY KEY (`BreadID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `componentstock`
--
ALTER TABLE `componentstock`
  ADD PRIMARY KEY (`VegetableID`);

--
-- Indexes for table `credit_code`
--
ALTER TABLE `credit_code`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mainstock`
--
ALTER TABLE `mainstock`
  ADD PRIMARY KEY (`MainID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saucestock`
--
ALTER TABLE `saucestock`
  ADD PRIMARY KEY (`SauceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breadstock`
--
ALTER TABLE `breadstock`
  MODIFY `BreadID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `componentstock`
--
ALTER TABLE `componentstock`
  MODIFY `VegetableID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_code`
--
ALTER TABLE `credit_code`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mainstock`
--
ALTER TABLE `mainstock`
  MODIFY `MainID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `saucestock`
--
ALTER TABLE `saucestock`
  MODIFY `SauceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
