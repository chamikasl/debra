-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2023 at 04:51 PM
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
-- Database: `theater_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `cover_img` text NOT NULL,
  `description` text NOT NULL,
  `duration` float NOT NULL,
  `date_showing` date NOT NULL,
  `end_date` date NOT NULL,
  `location` text NOT NULL,
  `price` text NOT NULL,
  `partner_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `cover_img`, `description`, `duration`, `date_showing`, `end_date`, `location`, `price`, `partner_id`) VALUES
(13, 'Event Rebel', 'event1.jpg', 'There are many different kinds of music festivals around the globe. From big ones like Coachella to small intimate ones like Glastonbury, there are lots of opportunities to host your own event. However, planning a successful music festival takes a lot of work and preparation.', 20, '2023-10-05', '2023-10-19', 'Colombo, Sri Lanka', '2500', '00815'),
(14, 'Symphony Shindig', 'event2.jpg', 'There are many different kinds of music festivals around the globe. From big ones like Coachella to small intimate ones like Glastonbury, there are lots of opportunities to host your own event. However, planning a successful music festival takes a lot of work and preparation.', 22, '2023-10-08', '2023-10-22', 'Kurunegala, Sri Lanka', '6000', '00011'),
(15, 'Freedom Frequency Festival', 'event3.jpg', 'Luckily, we’ve got a great solution for you. In this article, we’ve collected a bunch of amazing music festival names that you can easily adapt to create your own event. So, what are you waiting for? Let’s jump right in.', 20, '2023-10-17', '2023-10-21', 'Negambo, Sri Lanka', '10000', '00815'),
(16, 'Soundtrack Supper', 'event4.jpg', 'easiestwill be able to use your business name for marketing andwill be able to use your business name for marketing and way to register a music festival name is to go online to the U.S. Small Business Administration website and fill out the required paperwork. You will need to provide basic information about your business, such as the business name, contact information, and business purpose. Once you have completed the registration process, you will be able to use your business name for marketing and will be able to use your business name for marketing and', 22, '2023-10-21', '2023-10-21', 'Malborne , Australia', '49', '00637'),
(17, 'Gigscape', 'event5.jpg', 'ould consider when coming up with a music festival name. First, you want to make sure the name is memorable and easy to spell. Second, you want to choose a name that reflects the type of music you play. For example, if you play rock music, you might want to include the word ‘roc', 22, '2023-10-27', '2023-10-29', 'Colarado', '100', '00637'),
(18, 'Tempo Treats', 'event6.jpg', 'A good name should not only tell people how they can contact you but also provide an insight into your services. You need to communicate clearly through your name.', 24, '2023-10-27', '2023-10-27', 'Misisipi', '111', '00011'),
(19, 'Boooze', 'event7.jpg', 'For example, if you sell paint products, you can call your company “Paint by ABC” instead of simply calling it ‘ABC Paint’. The former implies more than just selling paints.', 12, '2023-10-22', '2023-10-23', 'Galle, Sri Lanka', '1200', '00011');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `event_id`, `email`, `name`, `phone`, `qty`) VALUES
(203, 17, 'ts@gmail.com', 'Tharuka Sheshan', '0743434567', 10),
(324, 13, 'csl211005@gmail.com', 'Renuka Jayawardana', '0750844633', 1),
(389, 19, 'chamikalansa@gmail.com', 'Chamika Supun', '0773544836', 2),
(566, 20, 'TestBuy@gmail.com', 'TestBuy', '0773544836', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `email` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `phone`, `email`, `type`) VALUES
('00011', 'Debra', 'debra', '', 'debra@gmail.com', 'Admin'),
('00382', 'TestPartner', 'TestPartner', NULL, 'TestPartner@gmail.com', 'Partner'),
('00637', 'Chamika', 'chamika', NULL, 'chamika@gmail.com', 'Partner'),
('00815', 'Supun', 'supun', NULL, 'supun@gmail.com', 'Partner');

-- --------------------------------------------------------

--
-- Table structure for table `__EFMigrationsHistory`
--

CREATE TABLE `__EFMigrationsHistory` (
  `MigrationId` varchar(150) NOT NULL,
  `ProductVersion` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `__EFMigrationsHistory`
--

INSERT INTO `__EFMigrationsHistory` (`MigrationId`, `ProductVersion`) VALUES
('20231007061328_Migrations', '7.0.12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `__EFMigrationsHistory`
--
ALTER TABLE `__EFMigrationsHistory`
  ADD PRIMARY KEY (`MigrationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
