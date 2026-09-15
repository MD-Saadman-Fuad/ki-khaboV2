-- Ki Khabo Database Schema & Sample Data

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `ki-khabo`
CREATE DATABASE IF NOT EXISTS `ki-khabo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ki-khabo`;

-- --------------------------------------------------------

-- Table structure for table `admin`
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin (username: admin, password: admin)
INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

-- Table structure for table `category`
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) DEFAULT '',
  `featured` varchar(10) NOT NULL DEFAULT 'No',
  `active` varchar(10) NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample categories
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Burger', 'Food_Category_Burger.jpg', 'Yes', 'Yes'),
(2, 'Pizza', 'Food_Category_Pizza.jpg', 'Yes', 'Yes'),
(3, 'Biryani', 'Food_Category_Biryani.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

-- Table structure for table `food`
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) DEFAULT '',
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL DEFAULT 'No',
  `active` varchar(10) NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample foods
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Cheeseburger', 'Juicy beef patty topped with melted cheddar cheese, lettuce, tomato, and special sauce.', '250.00', 'Food-Name-Burger.jpg', 1, 'Yes', 'Yes'),
(2, 'Pepperoni Pizza', 'Classic thin-crust pizza topped with spicy pepperoni slices and mozzarella cheese.', '650.00', 'Food-Name-Pizza.jpg', 2, 'Yes', 'Yes'),
(3, 'Kacchi Biryani', 'Aromatic basmati rice cooked with tender marinated mutton and rich spices.', '350.00', 'Food-Name-Biryani.jpg', 3, 'Yes', 'Yes');

-- --------------------------------------------------------

-- Table structure for table `order_table`
CREATE TABLE IF NOT EXISTS `order_table` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Ordered',
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
