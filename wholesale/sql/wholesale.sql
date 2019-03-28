-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2019 at 06:05 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wholesale`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `product_name`, `quantity`, `price`, `customer_id`) VALUES
(2, 'Pepsi', 71, 2485, 'praveen');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Cold Drinks'),
(2, 'Biscuits and Cookies'),
(3, 'Chips and Wafers');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(20) NOT NULL,
  `cust_name` varchar(25) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `email_id`, `password`) VALUES
('akshay', 'Akshay Bhat', 'akshayavbhat@gmail.com', 'akshay'),
('mugalkhod', 'shridhar mugalkhod', 'shree', 'shree'),
('nikhil', 'nikhil', 'nikkamath@gmail.com', 'nikhil'),
('praveen', 'Praveen YT', 'praveenyt@gmail.com', 'praveen'),
('saket', 'Saket Kumar', 'saketk@gmail.com', 'saket'),
('shivu', 'shivaprasad', 'shiva@gmail.com', 'shivu'),
('shrinidhi', 'Shrinidhi MK', 'shrinidhimk@gmail.com', 'shrinidhi'),
('swamy', 'swamy', 'swamydm@gmail.com', 'swamy');

-- --------------------------------------------------------

--
-- Table structure for table `depleted_products`
--

CREATE TABLE `depleted_products` (
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `quantity_left` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `price`, `quantity`) VALUES
(1, 'Coca Cola', 1, 40, 11),
(2, 'Pepsi', 1, 35, 9),
(3, 'Maaza', 1, 35, 50),
(4, 'Sprite', 1, 20, 20),
(5, 'Good Day', 2, 20, 20),
(6, 'Unibic', 2, 30, 70),
(7, 'Hide n Seek', 2, 20, 100),
(8, 'Oreo', 2, 40, 70),
(9, 'Bingo Mad Angles', 3, 10, 100),
(10, 'Lays', 3, 20, 95),
(11, 'Kurkure', 3, 20, 100),
(12, 'Kurkure Puffcorn', 3, 20, 50),
(13, 'Parle-G', 2, 10, 50),
(14, '7-Up', 1, 30, 30),
(15, 'Fanta', 1, 35, 100),
(16, 'Mirinda', 1, 30, 80),
(17, 'Mountain Dew', 1, 40, 1000);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `depleted` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
IF(new.quantity<=10) THEN
if (new.product_id not in (select product_id from   depleted_products)) THEN
INSERT INTO depleted_products 				  VALUES(new.product_id,new.product_name,new.quantity);
ELSE
update depleted_products set quantity_left=new.quantity where product_id=new.product_id;
end if;
ELSE
delete from depleted_products where product_id=new.product_id;
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL,
  `transaction_amount` int(11) DEFAULT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer_id`, `transaction_amount`, `payment`, `phone`, `address`, `date`) VALUES
(0, 'swamy', 600, 'COD', '8787', 'sdsd', '2019-03-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
