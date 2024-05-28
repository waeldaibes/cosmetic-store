-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 01:17 PM
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
-- Database: `cosmetic-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `FullName`, `Username`, `Position`, `Password`) VALUES
(1, 'Admin', 'Admin', 'Manager', '202cb962ac59075b964b07152d234b70'),
(8, 'joussy', 'joussy', 'Employee', '202cb962ac59075b964b07152d234b70'),
(9, 'wael daibes', 'wael', 'Manager', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `product`, `quantity`, `price`, `subtotal`, `product_image`) VALUES
(44, 'bx effect', 1, 33.00, 33.00, 'beauty-picture8455.jpg'),
(45, 'welnut scrub', 1, 23.00, 23.00, 'beauty-picture5223.jpg'),
(46, 'bx effect', 1, 33.00, 33.00, 'beauty-picture8455.jpg'),
(47, 'wave curle 1', 1, 10.00, 10.00, 'beauty-picture8676.jpg'),
(48, 'glosco volume mask', 1, 23.00, 23.00, 'beauty-picture3139.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(43, 'My skin care', 'product_category_618.avif', 'Yes', 'Yes'),
(44, 'My hair and personal care', 'product_category_550.avif', 'Yes', 'Yes'),
(45, 'My makeup', 'product_category_559.jpg', 'Yes', 'Yes'),
(48, 'perfume', 'product_category_771.jpg', 'Yes', 'Yes'),
(49, 'My baby', 'product_category_397.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE `tbl_contactus` (
  `id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contactus`
--

INSERT INTO `tbl_contactus` (`id`, `FullName`, `email`, `phonenumber`, `text`, `created_at`) VALUES
(1, 'Robil Sabek', 'robilsabek00@gmail.com', '81259374', 'acss', '2024-05-21 09:49:37'),
(3, 'bahaa', 'bahaa@gmail.com', '70677123', 'bahaa', '2024-05-22 16:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `product`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(17, '', 0.00, 0, 0.00, '2024-05-24 21:59:24', 'Ordered', 'wael', '03218035', 'waelandbahaa@gmail.com', 'beruit'),
(18, '', 0.00, 0, 0.00, '2024-05-24 22:00:26', 'Ordered', 'bahaa', '03218035', 'waelandbahaa@gmail.com', 'hsbaya'),
(19, '', 0.00, 0, 0.00, '2024-05-24 22:01:15', 'Ordered', 'joslynnn', '03218035', 'waelandbahaa@gmail.com', 'shwya'),
(20, '', 0.00, 0, 0.00, '2024-05-24 22:01:51', 'Ordered', 'wael', '03218035', 'waelandbahaa@gmail.com', '445'),
(21, '', 0.00, 0, 0.00, '2024-05-24 22:06:55', 'Cancelled', 'war', '213', 'waelandbahaa@gmail.com', '123'),
(22, 'papaya', 18.00, 2, 36.00, '2024-05-24 09:08:46', 'Ordered', 'wael', '23232', 'waelandbahaa@gmail.com', 'sdfsd'),
(23, '', 0.00, 0, 0.00, '2024-05-24 22:09:22', 'Ordered', 'wael', '213', 'waelandbahaa@gmail.com', 'shwya'),
(24, '', 0.00, 0, 0.00, '2024-05-24 22:18:14', 'Ordered', 'bahaa', '03218035', 'waelandbahaa@gmail.com', 'hasbaya'),
(25, 'scrub cream', 23.00, 1, 23.00, '2024-05-24 22:42:40', 'Ordered', 'wae', '03218035', 'waelandbahaa@gmail.com', 'shwya'),
(26, 'dead sea', 30.00, 2, 60.00, '2024-05-24 22:43:37', 'Ordered', 'joslynnn', '03218035', 'waelandbahaa@gmail.com', 'hasbaya'),
(27, 'keratin', 15.00, 2, 30.00, '2024-05-24 22:43:37', 'Delivered', 'joslynnn', '03218035', 'waelandbahaa@gmail.com', 'hasbaya'),
(28, 'glosco volume mask', 23.00, 2, 46.00, '2024-05-24 22:46:33', 'Ordered', 'bahaa', '03218035', 'waelandbahaa@gmail.com', 'beruit'),
(29, 'hair serum', 12.00, 1, 12.00, '2024-05-24 22:46:33', 'Delivered', 'bahaa', '03218035', 'waelandbahaa@gmail.com', 'beruit'),
(30, 'welnut scrub', 23.00, 1, 23.00, '2024-05-24 22:48:05', 'Delivered', 'wael', '03218035', 'waelandbahaa@gmail.com', 'hsbaya'),
(31, 'activa baby', 12.00, 1, 12.00, '2024-05-27 08:02:04', 'Ordered', 'w', '0', 'waelandbahaa@gmail.com', 'ghfhh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `tittle` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `tittle`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(11, 'scrub cream', 'dead sea product', 23.00, 'beauty-picture3774.jpg', 44, 'Yes', 'Yes'),
(12, 'bx effect', 'for strong hair', 33.00, 'beauty-picture8455.jpg', 44, 'Yes', 'Yes'),
(13, 'dead sea', 'dead sea', 30.00, 'beauty-picture7154.jpg', 44, 'Yes', 'Yes'),
(14, 'hair serum', 'for careful hair', 12.00, 'beauty-picture473.jpg', 44, 'Yes', 'Yes'),
(15, 'keratin', 'after shower', 15.00, 'beauty-picture4586.jpg', 44, 'Yes', 'Yes'),
(16, 'welnut scrub', 'for black hair', 23.00, 'beauty-picture5223.jpg', 44, 'Yes', 'Yes'),
(17, 'wave curle 1', 'for curle', 10.00, 'beauty-picture8676.jpg', 44, 'Yes', 'Yes'),
(18, 'glosco repair', 'for long hair', 43.00, 'beauty-picture4624.jpg', 44, 'Yes', 'Yes'),
(19, 'glosco volume mask', 'after shower', 23.00, 'beauty-picture3139.jpg', 44, 'Yes', 'Yes'),
(20, 'juman organ rose', 'for dry skin', 12.00, 'beauty-picture8393.jpg', 43, 'Yes', 'Yes'),
(21, 'juman organ honey', 'for skin', 12.00, 'beauty-picture4752.jpg', 43, 'Yes', 'Yes'),
(23, 'papaya', 'for skin', 18.00, 'beauty-picture3213.jpg', 43, 'Yes', 'Yes'),
(24, 'soap lemon', 'for more refreshness', 5.00, 'beauty-picture7007.jpg', 43, 'Yes', 'Yes'),
(25, 'activa lequid hand', 'liquid hand', 4.00, 'beauty-picture3426.jpg', 43, 'Yes', 'Yes'),
(26, 'juman sun block', 'sun care', 26.00, 'beauty-picture1156.jpg', 43, 'Yes', 'Yes'),
(27, 'nourshing shower rgel', 'shower gel', 10.00, 'beauty-picture7908.jpg', 43, 'Yes', 'Yes'),
(28, 'juman hunovera', 'for more silky skin', 29.00, 'beauty-picture9671.jpg', 43, 'Yes', 'Yes'),
(29, 'onlu yuo', 'for skin before makeup', 18.00, 'beauty-picture8069.jpg', 45, 'Yes', 'Yes'),
(30, 'juman cleaning', 'clean makeup', 3.00, 'beauty-picture8509.jpg', 45, 'Yes', 'Yes'),
(31, 'lovely', 'for lovely perfume', 70.00, 'beauty-picture5525.jpg', 48, 'Yes', 'Yes'),
(32, 'passion', 'passion secret', 100.00, 'beauty-picture1144.jpg', 48, 'Yes', 'Yes'),
(33, 'sensual', 'for memory perfume', 110.00, 'beauty-picture5717.jpg', 48, 'Yes', 'Yes'),
(34, 'suerte', 'for long time', 60.00, 'beauty-picture7773.jpg', 48, 'Yes', 'Yes'),
(35, 'hawa', 'for your style', 66.00, 'beauty-picture5360.jpg', 48, 'Yes', 'Yes'),
(36, 'activa baby', 'for your baby', 12.00, 'beauty-picture2579.jpg', 49, 'Yes', 'Yes'),
(37, 'activa bath gel', 'for your baby shower', 12.00, 'beauty-picture9044.jpg', 43, 'Yes', 'Yes'),
(38, 'juman baby', 'smell well', 14.00, 'beauty-picture1754.jpg', 49, 'Yes', 'Yes'),
(39, 'cremne baby', 'for your baby', 44.00, 'beauty-picture8887.jpg', 49, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE `tbl_tasks` (
  `Task` varchar(100) NOT NULL,
  `EmployeeUsername` varchar(100) NOT NULL,
  `Deadline` date NOT NULL,
  `Status` enum('completed','inProgress') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tasks`
--

INSERT INTO `tbl_tasks` (`Task`, `EmployeeUsername`, `Deadline`, `Status`) VALUES
('market', 'joussy', '2024-05-31', 'completed'),
('wael', 'wael', '2024-06-06', 'inProgress');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`Task`,`EmployeeUsername`),
  ADD KEY `EmployeeUsername` (`EmployeeUsername`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
