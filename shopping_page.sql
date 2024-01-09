-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 09:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_page`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_date` date NOT NULL,
  `in_cart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `cart_date`, `in_cart`) VALUES
(5, 3, '2024-01-09', 1),
(5, 1, '2024-01-09', 1),
(1, 3, '2024-01-09', 1),
(1, 1, '2024-01-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sender` varchar(15) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL,
  `seen` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`message_id`, `user_id`, `admin_id`, `sender`, `subject`, `message`, `seen`, `date`) VALUES
(18, 1, 4, 'USER', 'adresa', 'Ju lutem  mund te vendosni nje adrese me te sakte.\r\nFaleminderit', 0, '2024-01-09 20:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_rating` float NOT NULL,
  `publish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `product_id`, `comment_rating`, `publish_date`) VALUES
(14, 'super ', 1, 1, 5, '2023-12-30'),
(15, 'mesatar', 1, 1, 3, '2023-12-30'),
(16, 'cka', 1, 1, 1, '2023-12-30'),
(17, 'yll fare', 1, 2, 5, '2023-12-30'),
(18, 'Super', 7, 1, 5, '2024-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `brand` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rating` float NOT NULL,
  `no_of_comments` int(11) NOT NULL,
  `tag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `brand`, `description`, `price`, `quantity`, `rating`, `no_of_comments`, `tag`) VALUES
(1, 'T-Shirt', 'adidas', 'The shirt offers a comfortable and versatile fit, making it suitable for various occasions. Its soft and breathable fabric ensures all-day comfort, while the understated style makes it a wardrobe essential for casual and laid-back looks.', 40, 3, 3.5, 4, 'f1'),
(2, 'Shirt', 'ZARA', 'The shirt offers a comfortable and versatile fit, making it suitable for various occasions. Its soft and breathable fabric ensures all-day comfort, while the understated style makes it a wardrobe essential for casual and laid-back looks.', 50, 88, 5, 1, 'f2'),
(3, 'Shoes', 'puma', 'Sleek and stylish athletic shoes designed for both performance and fashion-forward appeal.Step into confidence with these dynamic and on-trend shoes.', 50, 87, 0, 0, 'f3'),
(4, 'White hoodie', 'adidas', '\r\nA cozy and versatile white hoodie that effortlessly combines comfort with contemporary style. Crafted from soft cotton blend fabric, this hoodie offers a snug and warm feel.', 80, 96, 0, 0, 'f4'),
(5, 'Full-Zip Jacket', 'adidas', ' This jacket features a contemporary silhouette with a full-length zipper, allowing for easy adjustment and layering.', 70, 97, 0, 0, 'f5'),
(6, 'Puffer Jacket', 'adidas', 'This puffer jacket is a cozy, quilted outerwear piece designed for warmth in cold weather. Typically featuring a zippered front, elasticized cuffs, and functional pockets. ', 120, 100, 0, 0, 'f6');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`user_id`, `product_id`, `purchase_date`, `quantity`) VALUES
(1, 3, '2022-03-03', 2),
(1, 5, '2024-01-09', 2),
(1, 3, '2024-01-09', 4),
(1, 4, '2024-01-09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'USER'),
(2, 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `role_relate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `points`, `role_relate`) VALUES
(1, 'Kleardo', 'Dura', 'kleo@kleo.com', '$2y$10$Zixqwl4CZXJhxsUB1zXLjeNMWNwLC4UZ8UJkeZ.E/8gzRrdkK3uIG', 177, 1),
(2, 'Klei', 'd', 'kl@kl.com', '$2y$10$5vQyggvSV0kAdYMy/0oxFepwvvVACOd/K59H5MFXWdDmUA97RzCEu', 0, 1),
(4, 'Kleardo', 'Dura', 'kleardodura13@gmail.com', '$2y$10$FjBy1jI7WFTG/jbk7tB3kuPqDGnk3jJ9lsb4Fp3d0cmvih4qBO6uG', 0, 2),
(5, 'Erjon', 'Zyka', 'j@z.com', '$2y$10$oTeL0ioBkNbolOpuDngNseZkcclqt7O5rR1PpE7mxBJ02gn0p3yqm', 0, 1),
(6, 'Aldin', 'Xhaxamani', 'a@xh.com', '$2y$10$P9Ge2PT.PzQ6rvYgByvcxeddVbCaRy5f61cLQzPcToSdlFUmiI/q6', 0, 1),
(7, 'Endri', 'Gjini', 'e@gj.com', '$2y$10$pDB/WkIW6oDSrqBDIk3VRO3xcqGuSv.ad3wE3yeq2MqgH.b/Ny3fu', 25, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role_relate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_relate`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
