-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 12:13 AM
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
-- Database: `cakeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `sessionid` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `picture`) VALUES
(2, 'Redvelvet ', 2000, 'frosted redvelvet cupcake', 'uploads/03.jpg'),
(3, 'Redvelvet ', 3000, 'frosted redvelvet cupcake', 'uploads/02.jpg'),
(4, 'chocolate cake', 4500, 'chocolate x caramel', 'uploads/01.jpg'),
(6, 'chocolate cake', 1200, 'chocolate fudge', 'uploads/08.jpg'),
(7, 'Redvelvet ', 2000, 'frosted redvelvet cupcake', 'uploads/04.jpg'),
(9, 'chocolate cookies', 2000, 'chocolate chip cookies', 'uploads/IMG-20240527-WA0005.jpg'),
(11, 'chocoflan', 10000, 'chocolate cake x flan', 'uploads/IMG-20240527-WA0012.jpg'),
(12, 'cake', 25000, 'birthday cake', 'uploads/IMG-20240527-WA0010.jpg'),
(14, 'flowers', 12000, 'red velvet frosted', 'uploads/IMG-20240527-WA0004.jpg'),
(15, 'tiramisu', 3000, 'italian dessert', 'uploads/IMG-20240527-WA0009.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(100) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `payment`, `date`, `quantity`, `notes`, `userid`, `itemid`, `status`) VALUES
(1, '0', '2024-05-28', 1, '', 1, 4, 'Pending'),
(2, '0', '2024-05-28', 1, 'xcvbnm', 1, 3, 'Pending'),
(3, '0', '2024-05-28', 4, 'xcvbn', 1, 12, 'Pending'),
(4, '0', '2024-05-28', 7, 'hgfdc', 1, 15, 'Pending'),
(5, 'paid', '0000-00-00', 5, 'for a party', 1, 3, 'Pending'),
(6, 'paid', '2024-05-31', 4, 'yellow frosting', 1, 4, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `address`, `city`, `state`, `zipcode`, `email`, `password`, `usertype`, `phone`) VALUES
(1, 'Zainab', 'Mohammed', 'G2 Ilorin road marafa estate', 'Kaduna', 'Kaduna', 800283, 'shaheeda.nazif@gmail.com', '$2y$10$aM9IgPwcFeyACRp2uAr64O3PJ/xQdEPtrS0GuSvUU/udOYczddRZm', 'customer', 2147483647),
(2, 'abul', 'nazif', 'G2 ilorin road', 'kaduna', 'Choose...', 800800, 'walid@gmail.com', '$2a$12$RNstWIwBwx83b.PZLgzC2ON0ystoTUC0FRfK9hXPxHKE.djLvxwlS', 'staff', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `itemid` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
