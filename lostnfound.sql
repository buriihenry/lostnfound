-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2017 at 05:28 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lostnfound`
--

-- --------------------------------------------------------

--
-- Table structure for table `customercare`
--

CREATE TABLE IF NOT EXISTS `customercare` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `clientphone` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `dateadded` varchar(255) NOT NULL,
  `itemindex` varchar(255) NOT NULL,
  `mpesacode` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `customercare`
--

INSERT INTO `customercare` (`index`, `clientphone`, `purpose`, `details`, `dateadded`, `itemindex`, `mpesacode`) VALUES
(17, '0708995320', 'Wrong Item', 'Finder number: 0712345678', '10:59:10 AM 28/05/16', '2', '8190826');

-- --------------------------------------------------------

--
-- Table structure for table `founditems`
--

CREATE TABLE IF NOT EXISTS `founditems` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `itemtype` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `itemnumber` varchar(255) NOT NULL,
  `locationfound` varchar(255) NOT NULL,
  `itemdescription` varchar(255) NOT NULL,
  `finder` varchar(255) NOT NULL,
  `claimed` varchar(255) NOT NULL,
  `mpesacode` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `founditems`
--

INSERT INTO `founditems` (`index`, `itemtype`, `itemname`, `itemnumber`, `locationfound`, `itemdescription`, `finder`, `claimed`, `mpesacode`) VALUES
(1, 'other', 'Keys', '0', 'Nyeri', 'Black key holder', '0712345678', 'yes', '7387725'),
(2, 'Others', 'Keys', '1', 'Nyeri', 'Black key holder', '0712345678', 'no', '2821807'),
(3, 'foundcert', 'Birth certificate', '2', 'Nakuru', 'serial number c5486498645', 'admin', 'no', '8190826'),
(4, 'lostatmcard', 'Kamau Faciscg', '3', 'Nyeri', 'KCB atm ', 'admin', 'yes', '74813628'),
(5, 'Others', 'Laptop', '4', 'Nyeri', 'dell', 'admin', 'yes', '71163135'),
(6, 'Others', 'Laptop', '5', 'Nakuru', 'black', '0708995320', 'no', ''),
(7, 'foundcert', 'Birth certificate', '6', 'Kisumu', 'serial h151321', '0708995320', 'no', ''),
(8, 'Others', 'dell', '7', 'kenya', 'computer', '0708995320', 'no', ''),
(9, 'Others', 'dell', '8', 'Nyeri', 'computer', '0712345678', 'no', ''),
(10, 'Others', 'dell', '9', 'Nyeri', 'computer', '0712345678', 'no', ''),
(11, 'Others', 'dell', '10', 'Nyeri', 'computer', '0708995320', 'no', ''),
(12, 'lostatmcard', 'Dennis', '11', 'Nyeri', 'equity', '0708995320', 'yes', '17458749'),
(13, 'lostatmcard', 'KCB', '12', 'tao', 'peter kim\r\n', '0702770667', 'no', ''),
(14, 'foundid', 'kiptoo', '13', 'kimathi', 'id', '0712345678', 'no', ''),
(15, 'foundid', 'kiptoo joseph', '14', 'nairobi', 'national id', '0712345678', 'no', '55693497'),
(16, 'foundid', 'Kiptoo kimel', '15', 'Nyeri', 'national id', '0708995320', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

CREATE TABLE IF NOT EXISTS `lostitems` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `itemtype` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `itemnumber` varchar(255) NOT NULL,
  `locationlost` varchar(255) NOT NULL,
  `itemdescription` text NOT NULL,
  `owner` varchar(255) NOT NULL,
  `found` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lostitems`
--

INSERT INTO `lostitems` (`index`, `itemtype`, `itemname`, `itemnumber`, `locationlost`, `itemdescription`, `owner`, `found`) VALUES
(3, 'Others', 'Laptop', '0', 'Nyeri', 'its dell core i3', 'admin', 'no'),
(4, 'lostid', 'national id', '1', 'Nyeri', 'block', 'admin', 'no'),
(5, 'lostatmcard', 'Kamau Faciscg', '2', 'Nyeri', 'KCB atm lost in Nyeri town', 'admin', 'no'),
(6, 'Others', 'Laptop', '3', 'Nyeri', 'dell', '0712345678', 'no'),
(7, 'lostatmcard', 'Dennis Njoroge', '4', 'Kiambu', 'Equity card', '0712345678', 'no'),
(8, 'lostcert', 'Kcse', '5', 'nakuru', 'kim peter\r\nyear 2014', '0702770667', 'no'),
(9, 'lostatmcard', 'Kcb', '6', 'tao', 'peter kim\r\nacc.no 547845658455', '0702770667', 'no'),
(10, 'lostid', 'Kiptoo kimel', '7', 'nyeri', 'nationa id', '0708995320', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `timesent` varchar(255) NOT NULL,
  `readstatus1` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`index`, `message`, `sender`, `recipient`, `timesent`, `readstatus1`) VALUES
(1, 'An item you found, (Keys), has been claimed by a client with the following contacts: 0712345678. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', '0712345678', '6:23:59 AM 28/05/16', 'read'),
(2, 'An item you found, (Keys), has been claimed by a client with the following contacts: 0708995320. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', '0712345678', '10:07:58 AM 28/05/16', 'unread'),
(3, 'An item you found, (Birth certificate), has been claimed by a client with the following contacts: admin. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', 'admin', '12:49:17 AM 28/05/16', 'read'),
(4, 'An item you found, (Kamau Faciscg), has been claimed by a client with the following contacts: admin. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', 'admin', '2:31:55 PM 28/05/16', 'unread'),
(5, '|3|I claim this item to be mine. Please get back to me on the contacts i provided. Thanks', '0703175432', 'admin', '3:52:32 PM 28/05/16', 'unread'),
(6, 'Dear customer, we have found an item named <a href=''viewitem.php?itemnumber=8''>dell</a> that matches your lost item (Laptop). ', 'admin', 'admin', '7:26:05 PM 28/05/16', 'unread'),
(7, 'Dear customer, we have found an item named <a href=''viewitem.php?itemnumber=9''>dell</a> that matches your lost item (Laptop). ', 'admin', 'admin', '7:27:13 PM 28/05/16', 'unread'),
(8, 'Dear customer, we have found an item named <a href=''viewitem.php?itemnumber=10''>dell</a> that matches your lost item (Laptop). ', 'admin', 'admin', '7:27:38 PM 28/05/16', 'unread'),
(9, 'Dear customer, we have found an item named <a href=''viewitem.php?itemnumber=10''>dell</a> that matches your lost item (Laptop). ', 'admin', '0712345678', '7:27:38 PM 28/05/16', 'unread'),
(10, 'Dear customer, we have found an item named <a href=''closematch.php?itemname=Dennis Njoroge&itemstr=Dennis Njoroge lostatmcard Kiambu Equity card''>Dennis</a> that matches your lost item (Dennis Njoroge). ', 'admin', '0712345678', '7:47:14 PM 28/05/16', 'unread'),
(11, 'An item you found, (Dennis), has been claimed by a client with the following contacts: 0712345678. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', '0708995320', '8:58:49 PM 28/05/16', 'unread'),
(12, 'Dear customer, we have found an item named <a href=''closematch.php?itemname=Kamau Faciscg&itemstr=Kamau Faciscg lostatmcard Nyeri KCB atm lost in Nyeri town''>KCB</a> that matches your lost item (Kamau Faciscg). ', 'admin', 'admin', '9:47:19 PM 28/05/16', 'unread'),
(13, 'An item you found, (Laptop), has been claimed by a client with the following contacts: 0708995320. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', 'admin', '3:23:11 PM 29/05/16', 'unread'),
(14, 'Dear customer, we have found an item named <a href=''closematch.php?itemname=Kiptoo kimel&itemstr=kiptoo kimel lostid nyeri nationa id''>kiptoo joseph</a> that matches your lost item (Kiptoo kimel). ', 'admin', '0708995320', '3:50:20 PM 29/05/16', 'unread'),
(15, 'An item you found, (kiptoo joseph), has been claimed by a client with the following contacts: 0708995320. Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', '0712345678', '4:44:42 PM 29/05/16', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `mpesacode` varchar(255) NOT NULL,
  `confirmed` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `amountpaid` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`index`, `mpesacode`, `confirmed`, `phonenumber`, `account`, `amountpaid`) VALUES
(1, '7387725', 'yes', '0712345678', '0712345678', '100'),
(2, '2821807', 'yes', '0712345678', '0712345678', '100'),
(3, '8190826', 'yes', '0708995320', '0708995320', '100'),
(4, '74813628', 'yes', 'admin', 'admin', '100'),
(5, '17458749', 'yes', '0712345678', '0712345678', '100'),
(6, '71163135', 'yes', '0708995320', '0708995320', '100'),
(7, '55693497', 'yes', '0708995320', '0708995320', '100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`index`, `fname`, `sname`, `phonenumber`, `email`, `password`) VALUES
(1, 'Dennis', 'Njoroge', '0712345678', 'dennis@gmail.com', 'abc'),
(2, 'Peter', 'Kiptoo', '0708995320', 'kiptoopeter20@gmail.com', 'abc'),
(3, 'Admin', '1', 'admin', 'any@gmail.com', 'abc123'),
(4, 'peter', 'kim', '0702770667', 'kimelipter20@gmail.com', '31855046'),
(5, 'HENRY', 'BURII', '0700223146', 'buriihenry@gmail.com', 'hazard10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
