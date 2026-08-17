-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 12:32 PM
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
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `subcategory` varchar(45) DEFAULT NULL,
  `unit_price` float(8,2) DEFAULT NULL,
  `unit_quantity` varchar(15) DEFAULT NULL,
  `in_stock` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `category`, `subcategory`, `unit_price`, `unit_quantity`, `in_stock`) VALUES
(1000, 'Fish Fingers', '/poti assignment 1/assets/images/fish fingers s.png', 'PMS', 'Seafood', 2.55, '500 gram', 0),
(1001, 'Fish Fingers', '/poti assignment 1/assets/images/fish fingers l.png', 'PMS', 'Seafood', 5.00, '1000 gram', 749),
(1002, 'Hamburger Patties', '/poti assignment 1/assets/images/hamburger patties.png', 'PMS', 'Meat', 2.35, 'Pack 10', 1198),
(1003, 'Shelled Prawns', '/poti assignment 1/assets/images/prawns.png', 'PMS', 'Seafood', 6.90, '250 gram', 293),
(1004, 'Tub Ice Cream', '/poti assignment 1/assets/images/ice cream s.png', 'Dairy', '', 1.80, 'I Litre', 796),
(1005, 'Tub Ice Cream', '/poti assignment 1/assets/images/ice cream l.png', 'Dairy', '', 3.40, '2 Litre', 1199),
(2000, 'Panadol', '/poti assignment 1/assets/images/panadol capsules.png', 'Pantry', '', 3.00, 'Pack 24', 0),
(2001, 'Panadol', '/poti assignment 1/assets/images/panadol dissolve.png', 'Pantry', '', 5.50, 'Bottle 50', 1000),
(2002, 'Bath Soap', '/poti assignment 1/assets/images/soap.png', 'HL', 'Home', 2.60, 'Pack 6', 500),
(2003, 'Garbage Bags Small', '/poti assignment 1/assets/images/bag s.png', 'HL', 'Home', 1.50, 'Pack 10', 499),
(2004, 'Garbage Bags Large', '/poti assignment 1/assets/images/bag l.png', 'HL', 'Home', 5.00, 'Pack 50', 299),
(2005, 'Washing Powder', '/poti assignment 1/assets/images/washing powder.png', 'HL', 'Home', 4.00, '1000 gram', 800),
(3000, 'Cheddar Cheese', '/poti assignment 1/assets/images/cheddar s.png', 'Dairy', '', 8.00, '500 gram', 999),
(3001, 'Cheddar Cheese', '/poti assignment 1/assets/images/cheddar l.png', 'Dairy', '', 15.00, '1000 gram', 1000),
(3002, 'T Bone Steak', '/poti assignment 1/assets/images/t bone.png', 'PMS', 'Meat', 7.00, '1000 gram', 199),
(3003, 'Navel Oranges', '/poti assignment 1/assets/images/oranges.png', 'FV', 'Fruits', 3.99, 'Bag 20', 199),
(3004, 'Bananas', '/poti assignment 1/assets/images/bananas.png', 'FV', 'Fruits', 1.49, 'Kilo', 400),
(3005, 'Peaches', '/poti assignment 1/assets/images/peaches.png', 'FV', 'Fruits', 2.99, 'Kilo', 500),
(3006, 'Grapes', '/poti assignment 1/assets/images/grapes.png', 'FV', 'Fruits', 3.50, 'Kilo', 200),
(3007, 'Apples', '/poti assignment 1/assets/images/apples.png', 'FV', 'Fruits', 1.99, 'Kilo', 1),
(4000, 'Earl Grey Tea Bags', '/poti assignment 1/assets/images/tea s.png', 'Drinks', '', 2.49, 'Pack 25', 1200),
(4001, 'Earl Grey Tea Bags', '/poti assignment 1/assets/images/tea m.png', 'Drinks', '', 7.25, 'Pack 100', 1200),
(4002, 'Earl Grey Tea Bags', '/poti assignment 1/assets/images/tea l.png', 'Drinks', '', 13.00, 'Pack 200', 800),
(4003, 'Instant Coffee', '/poti assignment 1/assets/images/coffee s.png', 'Drinks', '', 2.89, '200 gram', 2),
(4004, 'Instant Coffee', '/poti assignment 1/assets/images/coffee l.png', 'Drinks', '', 5.10, '500 gram', 500),
(4005, 'Chocolate Bar', '/poti assignment 1/assets/images/chocolate.png', 'Pantry', '', 2.50, '500 gram', 299),
(5000, 'Dry Dog Food', '/poti assignment 1/assets/images/dog food l.png', 'Pet', '', 5.95, '5 kg Pack', 400),
(5001, 'Dry Dog Food', '/poti assignment 1/assets/images/dog food s.png', 'Pet', '', 1.95, '1 kg Pack', 400),
(5002, 'Bird Food', '/poti assignment 1/assets/images/bird food.png', 'Pet', '', 3.99, '500g packet', 200),
(5003, 'Cat Food', '/poti assignment 1/assets/images/cat food.png', 'Pet', '', 2.00, '500g tin', 200),
(5004, 'Fish Food', '/poti assignment 1/assets/images/fish food.png', 'Pet', '', 3.00, '500g packet', 200),
(2006, 'Laundry Bleach', '/poti assignment 1/assets/images/laundry bleach.png', 'HL', 'Home', 3.55, '2 Litre Bottle', 500);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
