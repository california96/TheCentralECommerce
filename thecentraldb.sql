-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 02:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thecentraldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `category`) VALUES
(1, 'Clothing'),
(2, 'Services'),
(3, 'Accessories'),
(4, 'Books'),
(5, 'Food'),
(6, 'Beauty'),
(7, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productPrice` double NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productImage`, `productPrice`, `productDescription`, `productQuantity`, `userID`, `categoryID`, `status`) VALUES
(1, 'Canon AE-1 Program', 'img/product/canonae1program.png', 4500, 'Includes Canon FD Lens\r\nISO 12 to 3200\r\nAperture f1.8 - f16', 1, 4, 7, 0),
(2, 'YashicaFlex 80 mm 3.5', 'img/product/yashicaflex.png', 4800, 'Good condition.\r\nCLA\'d recently\r\nReady to use\r\nShutter Speed okay', 1, 4, 7, 0),
(3, 'Legendary Demon Hunting Jacket', 'img/product/legendarydemonhunterjacket.png', 400000, 'The jacket of a legendary demon hunter. \r\nIt is said that deadweights hate wearing this.', 5, 4, 1, 0),
(4, 'Tees', 'Tees', 1200, 'Its a tee', 1, 8, 1, 0),
(5, 'Secretssasa', 'Secret', 1500, 'Its a secret', 1, 8, 2, 0),
(6, 'Accessory of the Gods', 'Accessory of the Gods', 2500, 'Its an accessory', 199, 8, 3, 0),
(7, 'sad', 'sad', 12, 'xd', 12, 8, 1, 0),
(8, 'sad', '21', 23, 'd', 12, 8, 4, 0),
(9, 'sad', 'sad', 12, 'sadasdasdasd', 12, 8, 1, 0),
(10, 'car>', 'img/product/product7.png', 23, 'sad', 213, 8, 2, 1),
(12, 'sad', 'Sad', 12, 'sad', 12, 10, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Customer'),
(2, 'Merchant'),
(3, 'Multi'),
(4, 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `transactionAmount` double NOT NULL,
  `amountTendered` double NOT NULL,
  `amountChange` double NOT NULL,
  `customerID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `dateOrdered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `businessName` varchar(150) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstName`, `lastName`, `businessName`, `address`, `roleID`) VALUES
(1, 'tonystark@starkindustries.com', 'iamironman', 'Tony', 'Stark', NULL, '', 1),
(2, 'brucewayne@wayneenterprises.com', 'notbatman', 'Bruce', 'Wayne', 'Wayne Enterprises', '', 3),
(3, 'haljordan@iacademy.edu.ph', '$2y$10$W1aAYt5e5x41mhJOU1rOnOA9.r7SP6Pu0gewYxvHzJgtXmvPTSIu2', 'Hal', 'Jordan', NULL, '', 1),
(4, 'barryallen@iacademy.edu.ph', '$2y$10$ojW/LLkO1QblHI2dsvCvRO3ragHVmHsFr/INtyzRr2FQWVR4Rnrnu', 'Barry', 'Allen', 'Star Labs', '', 3),
(5, 'jonathancrane@iacademy.edu.ph', '$2y$10$gYb.PRjCGJNazXsQS5i7E.iHeLr/jEt29coRShbNwWa/D.q2ycG26', 'Jonathan', 'Crane', NULL, '', 1),
(6, 'harveydent@iacademy.edu.ph', '$2y$10$sjhGl4WfupcfZcFMvCQ3Ye8Y8s5Dep/Bz5DU8y8PnKdleXKDkWaku', 'Harvey', 'Dent', NULL, '', 1),
(8, 'ak@iacademy.edu.ph', '$2y$10$t4qNyXeWqljzq1MksSgAAuqetQ/Ma5Af8cmxJ.YZrPONJ9I.QyVm6', 'Aaron', 'Kwek', 'Kwek', '', 2),
(9, 'ka@iacademy.edu.ph', '$2y$10$50SLXiffzDrLrTouAnGF..xYlPNFdHr/4WLQuawUuijPmWgCdVr.q', 'Kwek', 'Aaron', NULL, 'Universe 7, Planet Earth', 1),
(10, 'akm@iacademy.edu.ph', '$2y$10$wrX.e1dBuAH0dNDNL4xkueDuo0N2RpKnTAu5NGZ2GGPlcRdJigQQ6', 'AaronM', 'KwekM', 'The Business', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
