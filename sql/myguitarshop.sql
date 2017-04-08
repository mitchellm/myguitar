-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2017 at 01:14 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myguitarshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `AddressID` int(11) NOT NULL,
  `Line1` varchar(60) NOT NULL,
  `Line2` varchar(60) DEFAULT NULL,
  `City` varchar(40) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZipCode` varchar(10) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Disabled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`AddressID`, `Line1`, `Line2`, `City`, `State`, `ZipCode`, `Phone`, `Disabled`) VALUES
(1, '231 Lamar Lane', NULL, 'Jamestown', 'JA', '4342', '4785508357', 0),
(3, '85 Zame Street', NULL, 'Oreant', 'LA', '777', '888888888', 0);

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `EmailAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`EmailAddress`) VALUES
('mitchell.murphy96@gmail.com'),
('root@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `banner_news`
--

CREATE TABLE `banner_news` (
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_news`
--

INSERT INTO `banner_news` (`title`, `body`) VALUES
('Sed ut perspiciatis', 'Lorem Ipsum is not simply random text. Contrary to popular belief, It has roots in a piece of classical Latin literature from 45 BC.'),
('There are many', 'Popular belief Contrary to , Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.'),
('Lorem Ipsum is', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(2, 'Basses'),
(3, 'Drums'),
(1, 'Guitars'),
(4, 'Keyboards');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `FirstName` varchar(60) NOT NULL,
  `LastName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `EmailAddress`, `Password`, `FirstName`, `LastName`) VALUES
(3, 'mitchell.murphy96@gmail.com', '296e5205c231053ca4080da1da5b032d36146c4a', 'Mitchell', 'Mitchell'),
(4, 'poop@gmail.com', 'f3af33db76ed6fa493dd4a2e90d9767e4d1c128d', 'A', 'A'),
(5, 'root@admin.com', '4a8b2def427a0fa35a75697761e5eaf3e2b3264b', 'Root', 'Root');

-- --------------------------------------------------------

--
-- Table structure for table `customers_addresses`
--

CREATE TABLE `customers_addresses` (
  `CustomerID` int(11) NOT NULL,
  `AddressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_addresses`
--

INSERT INTO `customers_addresses` (`CustomerID`, `AddressID`) VALUES
(1, 1),
(2, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `LineID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ItemPrice` decimal(10,0) NOT NULL,
  `DiscountAmount` decimal(10,0) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`LineID`, `OrderID`, `ProductID`, `ItemPrice`, `DiscountAmount`, `Quantity`) VALUES
(1, 6, 2, '1199', '30', 2),
(3, 3, 3, '2517', '1309', 1),
(4, 3, 6, '415', '162', 1),
(5, 4, 2, '1199', '360', 2),
(6, 5, 5, '299', '0', 1),
(7, 6, 5, '299', '0', 1),
(8, 7, 1, '699', '210', 1),
(9, 7, 7, '800', '240', 1),
(10, 7, 9, '700', '210', 1),
(11, 8, 10, '800', '120', 1),
(12, 9, 1, '699', '210', 1),
(13, 6, 2, '1199', '30', 2),
(14, 6, 2, '1199', '30', 2),
(15, 6, 2, '1199', '30', 1),
(16, 6, 1, '6994', '30', 1),
(17, 6, 5, '299', '0', 1),
(18, 30, 2, '1199', '30', 1),
(19, 30, 4, '490', '38', 1),
(20, 31, 1, '6994', '30', 2),
(21, 31, 6, '415', '39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ShipAmount` decimal(10,0) DEFAULT NULL,
  `TaxAmount` decimal(10,0) DEFAULT NULL,
  `ShipDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `ShipAmount`, `TaxAmount`, `ShipDate`) VALUES
(3, 1, '2012-03-29 09:44:58', '10', '90', '2012-03-31 09:11:41'),
(4, 3, '2012-03-30 15:22:31', '5', '0', '2012-04-03 16:32:21'),
(5, 4, '2012-03-31 05:43:11', '5', '0', '2012-04-02 14:21:12'),
(6, 5, '2012-03-31 18:37:22', '5', '0', NULL),
(7, 6, '2012-04-01 23:11:12', '15', '0', '2012-04-03 10:21:35'),
(8, 7, '2012-04-02 11:26:38', '5', '0', NULL),
(9, 4, '2012-04-03 12:22:31', '5', '0', NULL),
(29, 5, '2017-04-08 06:58:33', NULL, NULL, NULL),
(30, 5, '2017-04-08 07:04:48', NULL, NULL, NULL),
(31, 5, '2017-04-08 07:13:58', '2160', '1008', '2017-04-08 07:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `ProductCode` varchar(10) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `ListPrice` decimal(10,0) NOT NULL,
  `DiscountPercent` decimal(10,0) NOT NULL DEFAULT '0',
  `DateAdded` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'direct link to img'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `CategoryID`, `ProductCode`, `ProductName`, `Description`, `ListPrice`, `DiscountPercent`, `DateAdded`, `image`) VALUES
(1, 1, 'strat', 'Fender Stratocaster', 'The Fender Stratocaster is the electric guitar design that changed the world. New features include a tinted neck, parchment pickguard and control knobs, and a \'70s-style logo. Includes select alder body, 21-fret maple neck with your choice of a rosewood or maple fretboard, 3 single-coil pickups, vintage-style tremolo, and die-cast tuning keys. This guitar features a thicker bridge block for increased sustain and a more stable point of contact with the strings. At this low price, why play anything but the real thing?\r\n\r\nFeatures:\r\n\r\n* New features:\r\n* Thicker bridge block\r\n* 3-ply parchment pick guard\r\n* Tinted neck', '6994', '30', '2011-10-30 09:32:40', 'images/products/fender_strat.jpg'),
(2, 1, 'les_paul', 'Gibson Les Paul', 'This Les Paul guitar offers a carved top and humbucking pickups. It has a simple yet elegant design. Cutting-yet-rich tone?the hallmark of the Les Paul?pours out of the 490R and 498T Alnico II magnet humbucker pickups, which are mounted on a carved maple top with a mahogany back. The faded finish models are equipped with BurstBucker Pro pickups and a mahogany top. This guitar includes a Gibson hardshell case (Faded and satin finish models come with a gig bag) and a limited lifetime warranty.\r\n\r\nFeatures:\r\n\r\n* Carved maple top and mahogany back (Mahogany top on faded finish models)\r\n* Mahogany neck, \'59 Rounded Les Paul\r\n* Rosewood fingerboard (Ebony on Alpine white)\r\n* Tune-O-Matic bridge with stopbar\r\n* Chrome or gold hardware\r\n* 490R and 498T Alnico 2 magnet humbucker pickups (BurstBucker Pro on faded finish models)\r\n* 2 volume and 2 tone knobs, 3-way switch', '1199', '30', '2011-12-05 16:33:13', 'images/products/les_paul.jpg'),
(3, 1, 'sg', 'Gibson SG', 'This Gibson SG electric guitar takes the best of the \'62 original and adds the longer and sturdier neck joint of the late \'60s models. All the classic features you\'d expect from a historic guitar. Hot humbuckers go from rich, sweet lightning to warm, tingling waves of sustain. A silky-fast rosewood fretboard plays like a dream. The original-style beveled mahogany body looks like a million bucks. Plus, Tune-O-Matic bridge and chrome hardware. Limited lifetime warranty. Includes hardshell case.\r\n\r\nFeatures:\r\n\r\n* Double-cutaway beveled mahogany body\r\n* Set mahogany neck with rounded \'50s profile\r\n* Bound rosewood fingerboard with trapezoid inlays\r\n* Tune-O-Matic bridge with stopbar tailpiece\r\n* Chrome hardware\r\n* 490R humbucker in the neck position\r\n* 498T humbucker in the bridge position\r\n* 2 volume knobs, 2 tone knobs, 3-way switch\r\n* 24-3/4\" scale', '2517', '52', '2012-02-04 11:04:31', 'images/products/fender_strat.jpg'),
(4, 1, 'fg700s', 'Yamaha FG700S', 'The Yamaha FG700S solid top acoustic guitar has the ultimate combo for projection and pure tone. The expertly braced spruce top speaks clearly atop the rosewood body. It has a rosewood fingerboard, rosewood bridge, die-cast tuners, body and neck binding, and a tortoise pickguard.\r\n\r\nFeatures:\r\n\r\n* Solid Sitka spruce top\r\n* Rosewood back and sides\r\n* Rosewood fingerboard\r\n* Rosewood bridge\r\n* White/black body and neck binding\r\n* Die-cast tuners\r\n* Tortoise pickguard\r\n* Limited lifetime warranty', '490', '38', '2012-06-01 11:12:59', 'images/products/les_paul.jpg'),
(5, 1, 'washburn', 'Washburn D10S', 'The Washburn D10S acoustic guitar is superbly crafted with a solid spruce top and mahogany back and sides for exceptional tone. A mahogany neck and rosewood fingerboard make fretwork a breeze, while chrome Grover-style machines keep you perfectly tuned. The Washburn D10S comes with a limited lifetime warranty.\r\n\r\nFeatures:\r\n\r\n    * Spruce top\r\n    * Mahogany back, sides\r\n    * Mahogany neck Rosewood fingerboard\r\n    * Chrome Grover-style machines', '299', '0', '2012-07-30 13:58:35', 'images/products/fender_strat.jpg'),
(6, 1, 'rodriguez', 'Rodriguez Caballero 11', 'Featuring a carefully chosen, solid Canadian cedar top and laminated bubinga back and sides, the Caballero 11 classical guitar is a beauty to behold and play. The headstock and fretboard are of Indian rosewood. Nickel-plated tuners and Silver-plated frets are installed to last a lifetime. The body binding and wood rosette are exquisite.\r\n\r\nThe Rodriguez Guitar is hand crafted and glued to create precise balances. From the invisible careful sanding, even inside the body, that ensures the finished instrument\'s purity of tone, to the beautifully unique rosette inlays around the soundhole and on the back of the neck, each guitar is a credit to its luthier and worthy of being handed down from one generation to another.\r\n\r\nThe tone, resonance and beauty of fine guitars are all dependent upon the wood from which they are made. The wood used in the construction of Rodriguez guitars is carefully chosen and aged to guarantee the highest quality. No wood is purchased before the tree has been cut down, and at least 2 years must elapse before the tree is turned into lumber. The wood has to be well cut from the log. The grain must be close and absolutely vertical. The shop is totally free from humidity.', '415', '39', '2012-07-30 14:12:41', 'images/products/les_paul.jpg'),
(7, 2, 'precision', 'Fender Precision', 'The Fender Precision bass guitar delivers the sound, look, and feel today\'s bass players demand. This bass features that classic P-Bass old-school design. Each Precision bass boasts contemporary features and refinements that make it an excellent value. Featuring an alder body and a split single-coil pickup, this classic electric bass guitar lives up to its Fender legacy.\r\n\r\nFeatures:\r\n\r\n* Body: Alder\r\n* Neck: Maple, modern C shape, tinted satin urethane finish\r\n* Fingerboard: Rosewood or maple (depending on color)\r\n* 9-1/2\" Radius (241 mm)\r\n* Frets: 20 Medium-jumbo frets\r\n* Pickups: 1 Standard Precision Bass split single-coil pickup (Mid)\r\n* Controls: Volume, Tone\r\n* Bridge: Standard vintage style with single groove saddles\r\n* Machine heads: Standard\r\n* Hardware: Chrome\r\n* Pickguard: 3-Ply Parchment\r\n* Scale Length: 34\" (864 mm)\r\n* Width at Nut: 1-5/8\" (41.3 mm)\r\n* Unique features: Knurled chrome P Bass knobs, Fender transition logo', '800', '30', '2012-06-01 11:29:35', 'images/products/fender_strat.jpg'),
(8, 2, 'hofner', 'Hofner Icon', 'With authentic details inspired by the original, the Hofner Icon makes the legendary violin bass available to the rest of us. Don\'t get the idea that this a just a \"nowhere man\" look-alike. This quality instrument features a real spruce top and beautiful flamed maple back and sides. The semi-hollow body and set neck will give you the warm, round tone you expect from the violin bass.\r\n\r\nFeatures:\r\n\r\n* Authentic details inspired by the original\r\n* Spruce top\r\n* Flamed maple back and sides\r\n* Set neck\r\n* Rosewood fretboard\r\n* 30\" scale\r\n* 22 frets\r\n* Dot inlay', '500', '25', '2012-07-30 14:18:33', 'images/products/les_paul.jpg'),
(9, 3, 'ludwig', 'Ludwig 5-piece Drum Set with Cymbals', 'This product includes a Ludwig 5-piece drum set and a Zildjian starter cymbal pack.\r\n\r\nWith the Ludwig drum set, you get famous Ludwig quality. This set features a bass drum, two toms, a floor tom, and a snare?each with a wrapped finish. Drum hardware includes LA214FP bass pedal, snare stand, cymbal stand, hi-hat stand, and a throne.\r\n\r\nWith the Zildjian cymbal pack, you get a 14\" crash, 18\" crash/ride, and a pair of 13\" hi-hats. Sound grooves and round hammer strikes in a simple circular pattern on the top surface of these cymbals magnify the basic sound of the distinctive alloy.\r\n\r\nFeatures:\r\n\r\n* Famous Ludwig quality\r\n* Wrapped finishes\r\n* 22\" x 16\" kick drum\r\n* 12\" x 10\" and 13\" x 11\" toms\r\n* 16\" x 16\" floor tom\r\n* 14\" x 6-1/2\" snare drum kick pedal\r\n* Snare stand\r\n* Straight cymbal stand hi-hat stand\r\n* FREE throne', '700', '30', '2012-07-30 12:46:40', 'images/products/fender_strat.jpg'),
(10, 3, 'tama', 'Tama 5-Piece Drum Set with Cymbals', 'The Tama 5-piece Drum Set is the most affordable Tama drum kit ever to incorporate so many high-end features.\r\n\r\nWith over 40 years of experience, Tama knows what drummers really want. Which is why, no matter how long you\'ve been playing the drums, no matter what budget you have to work with, Tama has the set you need, want, and can afford. Every aspect of the modern drum kit was exhaustively examined and reexamined and then improved before it was accepted as part of the Tama design. Which is why, if you start playing Tama now as a beginner, you\'ll still enjoy playing it when you\'ve achieved pro-status. That\'s how good these groundbreaking new drums are.\r\n\r\nOnly Tama comes with a complete set of genuine Meinl HCS cymbals. These high-quality brass cymbals are made in Germany and are sonically matched so they sound great together. They are even lathed for a more refined tonal character. The set includes 14\" hi-hats, 16\" crash cymbal, and a 20\" ride cymbal.\r\n\r\nFeatures:\r\n\r\n* 100% poplar 6-ply/7.5mm shells\r\n* Precise bearing edges\r\n* 100% glued finishes\r\n* Original small lugs\r\n* Drum heads\r\n* Accu-tune bass drum hoops\r\n* Spur brackets\r\n* Tom holder\r\n* Tom brackets', '800', '15', '2012-07-30 13:14:15', 'images/products/les_paul.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sid` varchar(255) NOT NULL,
  `timestamp` varchar(45) DEFAULT NULL,
  `lastclick` int(255) NOT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sid`, `timestamp`, `lastclick`, `uid`) VALUES
('216920d9396f372ec5122c9895049249', '1491612507', 1491612507, 1),
('3caf776b5b55016e7af2db2804ffd282', '1488307047', 1488307047, 8),
('583456cf0cf769cf15a975595df967a3', '1488192439', 1488192439, 4),
('5dcb43a8622c23821afda5fdcd1b5beb', '1491432767', 1491432767, 2),
('65d608a44895ee40487b520efdc89521', '1491421387', 1491421387, 0),
('7d02708dc92e7df008e8dce6abd48cf6', '1491621715', 1491621715, 3),
('8109e2bd929ae528995d9061d4ca18ef', '1491650590', 1491650590, 5),
('b4b1302393fc29bfacfb4f0a4ad3ece0', '1488193608', 1488193608, 6),
('df3929a2c45ffd615373a0fbfd03488b', '1488306690', 1488306690, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD UNIQUE KEY `EmailAddress_2` (`EmailAddress`),
  ADD KEY `EmailAddress` (`EmailAddress`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`LineID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `ProductCode` (`ProductCode`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `LineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `CA1` FOREIGN KEY (`EmailAddress`) REFERENCES `customers` (`EmailAddress`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `itemsToProduct` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `orderToItems` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `catprod` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
