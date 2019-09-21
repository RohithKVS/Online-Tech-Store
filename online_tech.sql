-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 03:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `company_name` varchar(40) NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `image_id` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `quantity_available` int(5) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `company_name`, `product_type`, `product_name`, `image_id`, `description`, `category`, `price`, `quantity_available`, `deleted`) VALUES
(1, 'hp', 'laptop', 'envy x360', '1_image.jpg', '15.6 FHD Touchscreen Laptop Computer, 4-Core Intel Core i7 1.8GHz, 8GB|16GB|32GB RAM, Up to 1TB SSD|2TB HDD, Backlit Keyboard, Wi-Fi|Bluetooth|Webcam|HDMI|Windows 10', 'Computers', 700, 0, 0),
(2, 'hp', 'pendrive', '32gb pendrive', '2_image.jpg', 'Model_Number - P-FD32GHP255-EF', 'Electronics', 40, 12, 0),
(3, 'hp', 'pendrive', '64gb pendrive', '3_image.jpg', 'HP USB 3.0 Flash Memory. Store and transfer images, music, documents, games, and more!', 'Electronics', 60, 20, 0),
(4, 'sony', 'pendrive', '32gb pendrive', '4_image.jpg', 'USB3.0 compatible. Up to 226MB/s transfer speed good for quick back up or large sized files. Click style design with bright and visible LED indicator. Easy Lock downloadable data security software', 'Electronics', 40, 20, 0),
(5, 'fujitsu', 'laptop', 'Lifebook T936', '5_image.jpg', '13.3\\\\\\\' Tablet Intel Core i5 6200U 2.3GHz 8GB Ram 256GB SSD Touchscreen Windows 10 Pro', 'Computers', 349, 20, 0),
(6, 'hp', 'laptop', 'Premium Pavilion 15.6 Inch Touchscreen L', '6_image.jpg', 'Intel Pentium 4-Core N5000 1.10 GHz, up to 2.70 GHz Turbo, 4GB/8GB/16GB RAM, 128GB to 1TB SSD, 500GB to 2TB HDD, WiFi, Bluetooth, Windows 10', 'Computers', 499, 20, 0),
(7, 'lenovo', 'laptop', 'Premium ThinkPad E480 14 Inch 1080p Lapt', '7_image.jpg', 'Intel i5-7200U up to 3.1GHz, 8GB/12GB/16GB/32GB RAM, 512GB PCIe NVMe SSD, 1TB/2TB HDD, Intel HD 620, WiFi, Bluetooth, HDMI, USB-C, Windows 10', 'Computers', 620, 20, 0),
(8, 'dell', 'laptop', 'inspiron', '8_image.jpg', '15.6 HD Touchscreen 2019 Laptop Notebook Computer, Intel Core i5-7200U up to 3.1GHz, 8GB/16GB/32GB DDR4, Up to 2TB HDD, 1TB SSD, Wi-Fi, HDMI, Webcam, Bluetooth, USB 3.0, Windows 10', 'Computers', 600, 20, 0),
(9, 'transcend', 'memory card', '32GB memory card', '9_image.jpg', 'Specially developed for high endurance applications. High durability, ideal for long-hours of video recordings and playbacks. Ideal for automotive recorders and surveillance systems.', 'Electronics', 21, 20, 0),
(10, 'hp', 'pendrive', '4gb pendrive', '10_image.jpg', 'Store your important data with a brand you trust! With HP, you are worry free. Store, erase and reuse. HP USB drives can be reused over and over without loss of quality.', 'Electronics', 73, 20, 0),
(11, 'hp', 'pendrive', '64GB USB 3.0 Metal Hook Flash Drive', '11_image.jpg', 'HP USB 3.0 Flash Memory. Metal body with secure hook mechanism.Securely attaches to key chains, backpacks. USB 3.0 Speed. Body Size: 46.6 x 15.8 x 5mm / Weight: 11.5g', 'Electronics', 60, 19, 0),
(12, 'hp', 'pendrive', 'HP 64GB x900w USB 3.0 Flash Drive', '12_image.jpg', 'Store and transfer large files faster than ever with USB 3.0 technology. Ultra portable, compact, and light-weight for maximum convenience and life on the go.', 'Electronics', 16, 19, 0),
(13, 'seagate', 'hard drive', '2TB External Hard Drive', '13_image.jpg', 'External portable hard drive formatted for Windows out of the box Drag-and-drop file saving; Up to 1,000 hours of digital video USB 3.0 powered', 'Electronics', 60, 20, 0),
(14, 'western digital', 'hard drive', '4TB External Hard Drive', '14_image.jpg', 'Auto backup with included WD Backup software Password protection with hardware encryption Trusted drive built with WD reliability USB 3.0 port; USB 2.0 compatible. 3-year manufacturer\\\\\\\'s limited warranty', 'Electronics', 50, 19, 0),
(15, 'microsoft', 'operating system', 'windows 10 Pro', '15_image.jpg', 'Windows 10 gives you the best experience for starting fast and getting things done Windows Hello is the password-free sign-in that gives you the fastest, most secure way to unlock your Windows devices', 'Software', 189, 20, 0),
(16, 'kaspersky', 'antivirus', 'internet security', '16_image.jpg', 'WINS MORE AWARDS THAN ANYONE: Kaspersky Lab placed first in 55 independent tests and reviews, making it the worldâ€™s most tested and awarded security. GETS RAVE REVIEWS FROM EXPERTS: Choose protectio', 'Software', 50, 19, 0),
(17, 'bitdefender', 'antivirus', 'total security', '17_image.jpg', 'Complete protection for Windows, Mac OS, iOS and Android Unbeatable malware detection Better privacy with Webcam Protection and Bitdefender VPN - New! Multi-layer ransomware protection to keep your fi', 'Software', 50, 20, 0),
(18, 'Apple', 'phone', 'IPhone X', '18_image.jpg', '5. 8-inch Super Retina display (OLED) with HDR IP67 water and dust resistant (max depth of 1m up to 30 mines). 12MP dual cameras with dual OIS and 7MP True Depth front cameraâ€”Portrait mode and Portrait Lighting.Face ID for secure authentication and Apple Pay â´. A11 Bionic with Neural Engine. Wireless chargingâ€”works with Qi chargers ', 'Electronics', 900, 20, 0),
(19, 'microsoft', 'office', 'Microsoft Office 365 Home', '19_image.jpg', '12-month subscription for up to 6 people. 1TB OneDrive cloud storage per person. Premium versions of Word, Excel, PowerPoint, OneDrive, OneNote and Outlook; plus, Publisher and Access for PC only', 'Software', 80, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `order_id` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity_purchased` int(3) NOT NULL,
  `date_purchased` varchar(10) NOT NULL,
  `transaction_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL,
  `address1` varchar(40) NOT NULL,
  `address2` varchar(40) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(12) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `salt` int(8) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `email_join` (`email`),
  ADD KEY `product_join` (`product_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `email_join` FOREIGN KEY (`email`) REFERENCES `user_details` (`email`),
  ADD CONSTRAINT `product_join` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
