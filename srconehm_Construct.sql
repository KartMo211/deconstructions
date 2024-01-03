-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2021 at 03:24 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srconehm_Construct`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `email_id` varchar(150) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FPlan`
--

CREATE TABLE `FPlan` (
  `projName` longtext NOT NULL,
  `FPlan1` longtext NOT NULL,
  `FPlan2` longtext NOT NULL,
  `FPlan3` longtext NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `FPlan`
--

INSERT INTO `FPlan` (`projName`, `FPlan1`, `FPlan2`, `FPlan3`, `id`) VALUES
('SR Homes', 'SR Homes.projFPlan1.png', 'SR Homes.projFPlan2.png', 'SR Homes.projFPlan3.png', 1),
('SR Nest', 'SR Nest.projFPlan1.png', 'SR Nest.projFPlan2.png', 'SR Nest.projFPlan3.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prevProj`
--

CREATE TABLE `prevProj` (
  `id` int(11) NOT NULL,
  `prevProjName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prevProjImg` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prevProj`
--

INSERT INTO `prevProj` (`id`, `prevProjName`, `prevProjImg`) VALUES
(1, 'SR Projects 1', 'SR Projects 1.projImg.jpeg'),
(2, 'SR Projects 2', 'SR Projects 2.projImg.jpeg'),
(3, 'SR Projects 3', 'SR Projects 3.projImg.jpeg'),
(4, 'SR Projects 4', 'SR Projects 4.projImg.jpeg'),
(5, 'SR Projects 5', 'SR Projects 5.projImg.jpeg'),
(6, 'SR Projects 6', 'SR Projects 6.projImg.jpeg'),
(7, 'SR Projects 7', 'SR Projects 7.projImg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projName` longtext NOT NULL,
  `projCapt` longtext NOT NULL,
  `projDesc` longtext NOT NULL,
  `projPrice` int(11) NOT NULL,
  `projImg` longtext NOT NULL,
  `projPrime` text NOT NULL,
  `projConfig` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projName`, `projCapt`, `projDesc`, `projPrice`, `projImg`, `projPrime`, `projConfig`, `id`) VALUES
('SR Homes', 'The Home for Every Sweet Dream', 'Come visit our luxurious appartments which are built to help you obtain the serenity which you desire. Also, enjoy the magnificent ventilation along with nature view.', 3500, 'SR Homes.projImg.jpg', 'yes', '2 and 3BHK', 1),
('SR Nest', 'Everything you need. All right here.', 'Come visit our luxurious apartments which are built to help you obtain the serenity which you desire. Also, enjoy the magnificent ventilation along with nature view.', 3100, 'SR Nest.projImg.jpeg', 'yes', '2BHK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projHighlight`
--

CREATE TABLE `projHighlight` (
  `projName` longtext NOT NULL,
  `adv1` longtext NOT NULL,
  `adv2` longtext NOT NULL,
  `adv3` longtext NOT NULL,
  `adv4` longtext NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projHighlight`
--

INSERT INTO `projHighlight` (`projName`, `adv1`, `adv2`, `adv3`, `adv4`, `id`) VALUES
('SR Homes', 'We respect your religious beliefs and follow them to help boost your comfortability. Therefore, SR Homes have been designed as per vasthu.', 'Enjoy the landscape or the breeze of fresh air Along with quality and pleasant location, anyone could also feel ,explicitly, the magnificent ventilation.', 'Water is crucial for everyone and we believe that a continuous supply of water without wasting a bit makes it sustainable. Therefore we have installed a rainwater harvesting system.', 'Security is one of the major things which people look forward to and we haven\'t dissapointed them. Our gated communities have an installed CCTV coverage in parking areas.', 1),
('SR Nest', 'We respect your religious beliefs and follow them to help boost your comfortability. Therefore, SR Homes have been designed as per vasthu.', 'Enjoy the landscape or the breeze of fresh air Along with quality and pleasant location, anyone could also feel ,explicitly, the magnificent ventilation.', 'Water is crucial for everyone and we believe that a continuous supply of water without wasting a bit makes it sustainable. Therefore we have installed a rainwater harvesting system.', 'Security is one of the major things which people look forward to and we haven\'t dissapointed them. Our gated communities have an installed CCTV coverage in parking areas.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projLocality`
--

CREATE TABLE `projLocality` (
  `projName` longtext NOT NULL,
  `localAdv` longtext NOT NULL,
  `id` int(11) NOT NULL,
  `googMapLoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projLocality`
--

INSERT INTO `projLocality` (`projName`, `localAdv`, `id`, `googMapLoc`) VALUES
('SR Homes', 'SR Homes is located close to the Outer Ring Road so it is a 10 minute drive to reputed International Schools & Engineering Colleges; a 10 minute drive to Miyapur Metro Station; a 30 minute drive to Hitech city and a 40 minute drive to Gachibowli.', 1, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3803.8511110765903!2d78.36457831524686!3d17.56227398797409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb8d76bdf73785%3A0xf8d8fbf0bfb92033!2sSR%20HOMES!5e0!3m2!1sen!2sin!4v1608371137896!5m2!1sen!2sin\" height=\"450\" frameborder=\"0\" style=\"border:0;width:90%;max-width:800px;” allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
('SR Nest', 'SR Nest is located close to the Outer Ring Road so it is a 10 minute drive to reputed International Schools & Engineering Colleges; a 10 minute drive to Miyapur Metro Station; a 30 minute drive to Hitech city and a 40 minute drive to Gachibowli.', 2, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3803.913618627769!2d78.35891271524689!3d17.55929888797578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb8dbc0a2c8bd7%3A0xa0dd31edb8611017!2sSR%20NEST!5e0!3m2!1sen!2sin!4v1608438958452!5m2!1sen!2sin\" height=\"450\" frameborder=\"0\" style=\"border:0; width:90%; max-width:800px;” allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `FPlan`
--
ALTER TABLE `FPlan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prevProj`
--
ALTER TABLE `prevProj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projHighlight`
--
ALTER TABLE `projHighlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projLocality`
--
ALTER TABLE `projLocality`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `FPlan`
--
ALTER TABLE `FPlan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prevProj`
--
ALTER TABLE `prevProj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projHighlight`
--
ALTER TABLE `projHighlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projLocality`
--
ALTER TABLE `projLocality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
