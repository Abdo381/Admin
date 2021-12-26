-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 10:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronic_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Moving_line` varchar(50) NOT NULL,
  `Service_Price` decimal(10,0) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `name`, `email`, `password`, `Moving_line`, `Service_Price`, `id_rol`) VALUES
(1, 'zXZXZ', 'arafa@sadasd.com', 'f1b708bba17f1ce948dc979f4d7092bc', 'asdasd', '23423', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`) VALUES
(14, 'abdullah ahmed'),
(25, 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `name`, `email`, `password`, `image`) VALUES
(4, 'abdo', 'abdok7374@gmail.com', '2d6b21d6623bd1ad16276f85578d0221', '4793530971640109109.png');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Purchasing_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `Product_Picture` varchar(50) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`id`, `name`, `Description`, `Purchasing_price`, `selling_price`, `profit`, `Product_Picture`, `id_item`) VALUES
(6, 'ajfhsagdjbsahd', '0', 7786876, 7687687, 76876, '3549913691640210101.png', 14);

-- --------------------------------------------------------

--
-- Table structure for table `rel_dil_sel`
--

CREATE TABLE `rel_dil_sel` (
  `id_sel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rel_prod_dil`
--

CREATE TABLE `rel_prod_dil` (
  `id` int(11) NOT NULL,
  `id_prod_mo` varchar(11) NOT NULL,
  `id_mov_dil` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `id_roo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `email`, `password`, `City`, `id_roo`) VALUES
(1, 'asdasdads', 'arafa@sdasd.com', '660719b4a7591769583a7c8d20c6dfa4', 'zxczxc', 0),
(2, 'arafa', 'aasas@sasas.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'dasdasd', 0),
(3, 'asdsadsads', 'arafa@vcvbvcbv.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'giza', 0),
(4, 'agsfdgasfd', 'arafa@xbzvbc.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'gfhgfhgfh', 0),
(5, 'fdsfdsfd', 'fcfbvcv@gfcvcb.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'vcbvcb', 0),
(6, 'abdo', 'abdo@gmail.com', '1bbd886460827015e5d605ed44252251', 'cairo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `singup_team`
--

CREATE TABLE `singup_team` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singup_team`
--

INSERT INTO `singup_team` (`id`, `type`) VALUES
(0, 'seller'),
(1, 'delivery');

-- --------------------------------------------------------

--
-- Table structure for table `singup_user`
--

CREATE TABLE `singup_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `image` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singup_user`
--

INSERT INTO `singup_user` (`id`, `name`, `email`, `password`, `image`, `phone`) VALUES
(2, 'abdo', 'abdok7384@gmail.com', '2d6b21d6623bd1ad', '9849913131640487471.png', '1067035416'),
(3, 'abdo', 'abdok7384@gmail.com', '2d6b21d6623bd1ad', '2615010931640487662.png', '1067035416'),
(4, 'abdo', 'abd7374@gmail.com', 'dd4b21e9ef71e129', '4030448831640487833.png', '102102100'),
(5, 'abdo', 'abdok@gmail.com', '29c3eea3f305d6b8', '14538176711640488407.png', '1010102010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `rel_prod_dil`
--
ALTER TABLE `rel_prod_dil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seller` (`id_seller`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_r` (`id_roo`);

--
-- Indexes for table `singup_team`
--
ALTER TABLE `singup_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singup_user`
--
ALTER TABLE `singup_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `singup_user`
--
ALTER TABLE `singup_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `idd` FOREIGN KEY (`id_rol`) REFERENCES `singup_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prod`
--
ALTER TABLE `prod`
  ADD CONSTRAINT `id_item` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `id_r` FOREIGN KEY (`id_roo`) REFERENCES `singup_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
