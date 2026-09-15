-- Ki Khabo Full Database Dump
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('28', '123', '123', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('33', 'Saad', 'saad', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('37', 'Saadman', 'fuad', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('38', 'Rezwaan', 'rez', 'd33bc499ca0acd0cdf659b4ad190dcec');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('52', 'x6', 'x6', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('53', 'user10', 'user10', '990d67a9f94696b1abe2dccf06900322');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('54', 'Saadman Fuad', 'x11', '6d865d85813b1261953b3e79cdb04716');
INSERT INTO `admin` (`id`, `full_name`, `user_name`, `password`) VALUES ('56', 'Rezwaan', 'Rezwan', '26a93d6f7afe19a1f4ef9d17229d1900');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('13', 'Burger', 'Food_Category_746.jpeg', 'Yes', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('14', 'Pizza', 'Food_Category_702.jpeg', 'Yes', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('15', 'Hotdog', 'Food_Category_672.jpeg', 'No', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('17', 'Kacchi', 'Food_Category_823.jpeg', 'Yes', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('19', 'Subway Sandwich', 'Food_Category_665.jpeg', 'Yes', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('23', 'Meat Box', 'Food_Category_173.jpeg', 'Yes', 'Yes');
INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES ('24', 'fuchka', 'Food_Category_127.jpeg', 'Yes', 'Yes');

DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('2', 'Mixed Vege Pizza', 'Mixed Vegetables Pizza', '425.00', 'Food-Name-7389.jpeg', '14', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('3', 'Chicken Burger', 'Tinder and Juicy Chicken Patty Burger', '250.00', 'Food_Category_810.jpg', '13', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('4', 'Bashmati Kacchi', 'Tasty and Spicy Bashmati Kacchi', '450.00', 'Food_Item_374.jpeg', '17', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('5', 'Classic Pizza', 'Classic Pizza with Cheese and Crusty', '400.00', 'Food_Category_352.jpg', '14', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('6', 'Chicken Pizza', 'Chicken Pizza with vegetables', '450.00', 'Food_Category_178.webp', '14', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('7', 'Tandoori Chicken Pizza', 'Tandoori Chicken and little Vege', '450.00', 'Food_Category_275.jpeg', '14', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('8', 'Ultimate Vege Burger', 'Burger with Vegetables', '250.00', 'Food_Category_925.jpg', '13', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('9', 'Beef Burger', 'Burger with Beef Patty', '300.00', 'Food-Name-6518.jpeg', '13', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('10', 'Biriyani', 'Beef Biriyani', '300.00', 'Food_Category_584.jpeg', '17', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('11', 'Plane Kacchi Combo', '2:1 Plane Kacchi with Salad and Drinks', '600.00', 'Food_Category_672.jpeg', '17', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('12', 'Subway Sandwich', 'Best Subway', '400.00', 'Food_Category_485.jpeg', '19', 'No', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('15', 'Mutton Burger', 'Burger with Mutton Patty', '400.00', 'Food_Category_632.jpeg', '13', 'Yes', 'Yes');
INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('16', 'fuchka ', 'what', '30.00', 'Food_Category_252.jpeg', '24', 'Yes', 'No');

DROP TABLE IF EXISTS `order_table`;
CREATE TABLE `order_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('1', 'Kacchi', '450.00', '2', '900.00', '2025-03-28 10:22:36', 'Ordered', 'Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'Kawla, Dhaka-1229');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('2', 'Pizza', '255.00', '3', '765.00', '2025-03-28 10:58:09', 'On Delivery', 'Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'Nikunja, Dhaka-1229');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('3', 'Pizza', '255.00', '4', '1020.00', '2025-03-28 10:59:08', 'Cancelled', 'Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'Kawla, Dhaka-1229');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('4', 'Kacchi', '450.00', '5', '2250.00', '2025-03-28 11:03:06', 'Ordered', 'Kawsar Ahmed', '01716582601', 'Kawsar@gmail.com', 'Nikunja, Dhaka-1229\r\n');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('5', 'Pizza', '255.00', '4', '1020.00', '2025-03-28 11:04:04', 'Delivered', 'Niyam', '01918736724', 'niyam@yahoo.com', 'Kawla, Dhaka');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('6', 'Tandoori Chicken Pizza', '450.00', '2', '900.00', '2025-06-21 03:03:26', 'Ordered', 'Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'Dhaka, Bangladesh');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('7', 'Mixed Vege Pizza', '425.00', '1', '425.00', '2025-06-24 20:29:49', 'Ordered', 'Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'Dhaka');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('8', 'Tandoori Chicken Pizza', '450.00', '1', '450.00', '2026-09-15 11:32:37', 'Ordered', 'MD. Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'hgsfdhfdghfdsg');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('9', 'Mixed Vege Pizza', '425.00', '2', '850.00', '2026-09-15 11:46:59', 'Ordered', 'MD. Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'chewcking');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('10', 'Bashmati Kacchi', '450.00', '1', '450.00', '2026-09-15 11:46:59', 'Ordered', 'MD. Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'chewcking');
INSERT INTO `order_table` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('11', '1x Mixed Vege Pizza, 1x Chicken Burger', '675.00', '2', '725.00', '2026-09-15 20:03:28', 'Ordered', 'MD. Saadman Fuad', '01914995953', 'md.saadman.fuad@gmail.com', 'checking1');

SET FOREIGN_KEY_CHECKS=1;
