-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` bigint(20) NOT NULL,
  `receipt_id` varchar(20) DEFAULT NULL,
  `amount` int(10) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `buyer_email` varchar(50) DEFAULT NULL,
  `buyer_ip` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `entry_at` date DEFAULT NULL,
  `entry_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `receipt_id`, `amount`, `buyer`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(29, 'RECONE', 100, 'Buyer 1', 'Item one,Item two,Item three', 'buyer_1@gmail.com', '::1', 'Note for receipt one', 'Dhaka', '8801625181702', 'o+MJfm/1hN4IYQjUuMOP+D2+f35ji/HjrxekRnu5hHoGb+Q8N5Ir80RpQzYla9iPs9EzTNaD5RS5xpjYxS7eVg==', '2024-01-22', 1),
(30, 'RECTWO', 200, 'Buyer Two', 'Item four', 'buyer_2@gmail.com', '::1', 'Test Note', 'Mirpur', '8801625181703', 'bjOVBc5s16wtli9IYAIDK/SjhlRbdF/Le35xv0EkKmDS+mf7YcEaXSv//LeN3tWXCEeKKKGvgjkdC3b/AP5V6A==', '2024-01-22', 2),
(31, 'RECTHREE', 250, 'Buyer Three', 'Item five', 'buyer_3@gmail.com', '::1', 'Test Note', 'Ajimpur', '8801625181704', 'khusdMMN48IF0zluX96hgXbI6fiJ3uqQQo0QNpYHE6LMPCfNSnwFsFc/uiIcltH2hRtDIt8xbMy4Df25TqH4gA==', '2024-01-22', 1),
(32, 'RECFOUR', 300, 'Buyer Four', 'Item six', 'buyer_4@gmail.com', '::1', 'Test Note', 'Meherpur', '8801625181705', 'DNy7KSk5p04J9jjZiPDHjWeoAXLrJ+P31+L5urSYRfO25QoMWmcBWRtspWf864lZJPymFI3RhLiqTuh53iT4dw==', '2024-01-12', 2),
(33, 'RECFIVE', 350, 'Buyer Five', 'Item Seven', 'buyer_5@gmail.com', '::1', 'Test Note', 'Kuril', '8801625181706', '+scAzo8rG9TGPTDvZTjV3grEUrm2kRnWqNuCgeM43lQJvFDA7slb5FPcTF3AFzeXgD8kMldQl7zMKAlMY5jFpQ==', '2024-01-12', 1),
(34, 'RECSIX', 450, 'Buyer Six', 'Item Eight', 'buyer_6@gmail.com', '::1', 'Test Note', 'New Market', '8801625181707', 'WLNDsSZh6PdXgTpjvcFg7xrLPIo3N0SHX05Pxz+4qyTvX0XlcBa6yNHs/+cRvZ2GF01jPsVox/kkyL0ppkadHQ==', '2024-01-12', 2),
(35, 'RECSEVEN', 550, 'Buyer Seven', 'Item Nine', 'buyer_7@gmail.com', '::1', 'Test Note', 'New Market', '8801625181707', 'QPwYTqdkXqU7TM1ThsPw6sNa5AfQwDhBgb1+1vVebPrXiYABsoFtgeb0S/D4ijCb6wJYbrVp+TThiqvHt+o4cA==', '2024-01-15', 3),
(36, 'RECEIGHT', 850, 'Buyer Eight', 'Item Ten', 'buyer_8@gmail.com', '::1', 'Test Note', 'New Market', '8801625181708', 'OqGlK1TIAhO7lQCYuFkp8WgZ7WMDsoF/uPVgSf6DlVn41OMwrp5T+rE2Z3GyLywkODUJovgv5w1ZMhzbZgL7Vw==', '2024-01-15', 3),
(37, 'RECNINE', 850, 'Buyer Nine', 'Item Eleven', 'buyer_9@gmail.com', '::1', 'Test Note', 'New Market', '8801625181709', '3yBF6qt6yk6VvLEViKekO0BGhUDDf2e/pt4/FaJEGy5EVdBK4p0Pv2bJuaGKuNouEbl3L9GYV2rEbVyqTDc6hA==', '2024-01-15', 2),
(38, 'RECTEN', 850, 'Buyer Ten', 'Item Twelve', 'buyer_10@gmail.com', '::1', 'Test Note', 'New Market', '8801625181710', 'lW/p22qd/xhHAeyXW99TCc0QVc4sLzy25b5fWM9nHMeqbRwYp2fPh0WR0xQ+RmOGwioL15TTseler5xweMZX2Q==', '2024-01-15', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
