-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 04:35 AM
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
-- Database: `mbainventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `simcard_list`
--

CREATE TABLE `simcard_list` (
  `id` int(11) NOT NULL,
  `sim_gateway` varchar(200) NOT NULL,
  `sim_id` varchar(200) NOT NULL,
  `sim_no` varchar(200) NOT NULL,
  `operator` varchar(200) NOT NULL,
  `direction` varchar(200) NOT NULL,
  `call_to` varchar(200) NOT NULL,
  `sms_to` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simcard_list`
--

INSERT INTO `simcard_list` (`id`, `sim_gateway`, `sim_id`, `sim_no`, `operator`, `direction`, `call_to`, `sms_to`, `date`) VALUES
(3, '0', '', '9088185138', 'SMART', '', '', '', '2026-03-30'),
(4, '1', '', '9088185130', 'SMART', '', '', '', '2026-03-30'),
(5, '2', '', '9985994225', 'SMART', '', '', '', '2026-03-30'),
(6, '3', '', '9985994239', 'SMART', '', '', '', '2026-03-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simcard_list`
--
ALTER TABLE `simcard_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simcard_list`
--
ALTER TABLE `simcard_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
