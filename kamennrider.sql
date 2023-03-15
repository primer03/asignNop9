-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 02:50 AM
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
-- Database: `kamennrider`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_charector`
--

CREATE TABLE `tbl_charector` (
  `char_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `char_kamen_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `char_name` varchar(255) NOT NULL,
  `char_height` varchar(255) NOT NULL,
  `char_weight` varchar(255) NOT NULL,
  `char_eyesight` varchar(255) DEFAULT NULL,
  `char_hearing` varchar(255) DEFAULT NULL,
  `char_enemysensing` varchar(255) DEFAULT NULL,
  `char_PunchingPower` varchar(255) DEFAULT NULL,
  `char_GrippingPower` varchar(255) DEFAULT NULL,
  `char_KickingPower` varchar(255) DEFAULT NULL,
  `char_MaximumJumpHeight` varchar(255) DEFAULT NULL,
  `char_MaximumJumpDistance` varchar(255) DEFAULT NULL,
  `char_MaximumRunningSpeed` varchar(255) DEFAULT NULL,
  `char_MaximumSwimmingSpeed` varchar(255) DEFAULT NULL,
  `char_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_charector`
--

INSERT INTO `tbl_charector` (`char_id`, `char_kamen_id`, `char_name`, `char_height`, `char_weight`, `char_eyesight`, `char_hearing`, `char_enemysensing`, `char_PunchingPower`, `char_GrippingPower`, `char_KickingPower`, `char_MaximumJumpHeight`, `char_MaximumJumpDistance`, `char_MaximumRunningSpeed`, `char_MaximumSwimmingSpeed`, `char_img`) VALUES
(00001, 001, 'Kamen Rider 1', '180 cm', '70 kg', '15 km', '4 km', '100 m', '15 t', '10-15 times human', ' Approx. 11.3 t → 22.5 t', '15.3 m', '48.7 m', '100 m per 12 seconds', 'Approx. 100 m per 9.7 seconds', 'https://i.imgur.com/e6BWTBr.png'),
(00002, 001, 'Kamen Rider 2', '172 cm', '65 kg', NULL, '4 km', '100 m', '25 t', NULL, '30 t', '15.3 m', NULL, NULL, NULL, 'https://i.imgur.com/49u3Eur.png'),
(00003, 002, 'Kamen Rider V3', '180 cm', '78 kg', 'Approx. 16.7 km', '2 km', '2 km', '90 t', NULL, '100 t', '30 m.→ 60 m', NULL, '100 m per 1.6 seconds', '100 m per 1.8 seconds', 'https://i.imgur.com/bHJ6I4u.png'),
(00004, 002, 'Riderman', '175 cm', '70 kg', NULL, NULL, NULL, '5 t', '', '10 t', '10 t', NULL, NULL, NULL, 'https://i.imgur.com/153rEJk.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_era`
--

CREATE TABLE `tbl_era` (
  `era_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `era_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_era`
--

INSERT INTO `tbl_era` (`era_id`, `era_name`) VALUES
(001, 'Showa'),
(002, 'Heisei'),
(003, 'Reiwa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kamenrider`
--

CREATE TABLE `tbl_kamenrider` (
  `kamen_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kamen_name` varchar(255) NOT NULL,
  `kamen_datestart` date NOT NULL,
  `kamen_datesend` date NOT NULL,
  `kamen_img` text NOT NULL,
  `kamen_era` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kamen_ep` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_kamenrider`
--

INSERT INTO `tbl_kamenrider` (`kamen_id`, `kamen_name`, `kamen_datestart`, `kamen_datesend`, `kamen_img`, `kamen_era`, `kamen_ep`) VALUES
(001, 'Kamen Rider', '1973-04-03', '1973-02-10', 'https://i.imgur.com/AVOW69h.jpg', 001, 98),
(002, 'Kamen Rider V3', '1973-02-17', '1974-02-09', 'https://i.imgur.com/eAUzikD.png', 001, 52);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` text NOT NULL,
  `u_favorite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `u_username`, `u_email`, `u_password`, `u_favorite`) VALUES
(1, 'asdasd', 'avjapan.srisunan20@gmail.com', '$2y$10$OR/YL6RRe2M7XSYuUWjsVOm.7/54s.dFUDThNqDn1w5TwnApIYi12', 'Kamen Rider'),
(2, 'asdasdasdasd', 'avjaspan.srisunan20@gmail.com', '$2y$10$tmgg6cKl6KcVl.mQZ.PHE.jfGnGsVTOIeOvsKxKsN6LXntteW9EgG', 'Kamen Rider'),
(3, 'Primo03', 'Panupong.person@gmail.com', '$2y$10$Aoch8aPi65JDtNoAaMdgY.tv9c13ht.Ov6hnz9JN3pSW9BiLtI6cK', 'Kamen Rider V3'),
(7, 'Panupong_2303', 'Panupong.2686@gmail.com', '$2y$10$5MlpPbuVBggGi1y1QkUFAuN4gkh1XoFGmH.IyLjfML0Z7TTb5pllO', 'Kamen Rider V3'),
(8, 'Primo023', 'Hentai.srisunan24@gmail.com', '$2y$10$fSp7GogCyEznkJxszeRBdu4AwD47XCRxcN5y2j/kp8rE9zBkqJBGW', 'Kamen Rider');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_charector`
--
ALTER TABLE `tbl_charector`
  ADD PRIMARY KEY (`char_id`);

--
-- Indexes for table `tbl_era`
--
ALTER TABLE `tbl_era`
  ADD PRIMARY KEY (`era_id`);

--
-- Indexes for table `tbl_kamenrider`
--
ALTER TABLE `tbl_kamenrider`
  ADD PRIMARY KEY (`kamen_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_charector`
--
ALTER TABLE `tbl_charector`
  MODIFY `char_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_era`
--
ALTER TABLE `tbl_era`
  MODIFY `era_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kamenrider`
--
ALTER TABLE `tbl_kamenrider`
  MODIFY `kamen_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
