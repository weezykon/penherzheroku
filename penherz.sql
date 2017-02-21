-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2017 at 04:14 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `penherz`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_written`
--

CREATE TABLE IF NOT EXISTS `books_written` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_name` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `year` year(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `books_written`
--

INSERT INTO `books_written` (`id`, `user_id`, `book_name`, `image`, `year`, `date`) VALUES
(1, 7, 'tboss the back stabber', 'default.jpg', 2007, '2017-02-03 22:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `item_id` varchar(15) NOT NULL,
  `quantity` tinyint(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL DEFAULT '0',
  `categories` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `story_id`, `user_id`, `comment`, `status`, `date`) VALUES
(1, 2, 7, 'yes ooo..', 1, '2017-02-02 16:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
`id` int(11) NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `book_id` varchar(30) NOT NULL,
  `old_price` varchar(11) NOT NULL,
  `new_price` varchar(11) NOT NULL,
  `close_date` date NOT NULL,
  `entry_date` datetime NOT NULL,
  `active` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_store`
--

CREATE TABLE IF NOT EXISTS `favorite_store` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_stories`
--

CREATE TABLE IF NOT EXISTS `favorite_stories` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `story_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `favorite_stories`
--

INSERT INTO `favorite_stories` (`id`, `user_id`, `story_id`, `date`) VALUES
(1, '7', 2, '2017-02-03 18:01:44'),
(2, '7', 3, '2017-02-03 18:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `user_id`, `follower_id`, `status`, `date`) VALUES
(1, 11, 7, 1, '2017-02-02 00:45:52'),
(2, 11, 9, 1, '2017-02-02 00:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE IF NOT EXISTS `hours` (
`id` int(11) NOT NULL,
  `open_monday` time NOT NULL,
  `open_tuesday` time NOT NULL,
  `open_wednesday` time NOT NULL,
  `open_thursday` time NOT NULL,
  `open_friday` time NOT NULL,
  `open_saturday` time NOT NULL,
  `open_sunday` time NOT NULL,
  `close_monday` time NOT NULL,
  `close_tuesday` time NOT NULL,
  `close_wednesday` time NOT NULL,
  `close_thursday` time NOT NULL,
  `close_friday` time NOT NULL,
  `close_saturday` time NOT NULL,
  `close_sunday` time NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `open_monday`, `open_tuesday`, `open_wednesday`, `open_thursday`, `open_friday`, `open_saturday`, `open_sunday`, `close_monday`, `close_tuesday`, `close_wednesday`, `close_thursday`, `close_friday`, `close_saturday`, `close_sunday`, `store_no`, `user_id`, `date`) VALUES
(1, '08:00:00', '08:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '05:00:00', '05:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '7908', '7', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `token` text NOT NULL,
  `valid_token` tinyint(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `ban` int(5) NOT NULL,
  `due_ban` date DEFAULT NULL,
  `activated` tinyint(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `password`, `token`, `valid_token`, `type`, `ban`, `due_ban`, `activated`) VALUES
(7, 'weezykon', 'weezykon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '5a26881d0a2e3de559abc1787897af239314892c', 1, 'office', 0, NULL, 1),
(9, 'iamamaka', 'iamamaka@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '78257216682138f7cf41c1cd6c5c20', 1, 'page', 0, NULL, 1),
(11, 'slimkhloe', 'slimkhloe@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '03477d320782b89dcdc8f67b7dca66d2fed2124b', 1, 'member', 0, NULL, 1),
(12, 'peezykon', 'plmakinbode@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '04d0cfbc263404cac91048ee9d08918e32e9479a', 1, 'page', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `love`
--

CREATE TABLE IF NOT EXISTS `love` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `story_id` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `love`
--

INSERT INTO `love` (`id`, `user_id`, `story_id`, `status`, `date`) VALUES
(1, '7', '2', 1, '2017-02-02 02:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `postcode` tinyint(10) NOT NULL,
  `phone_number` tinyint(20) NOT NULL,
  `profilepic` varchar(300) NOT NULL,
  `coverpic` varchar(300) NOT NULL,
  `bio` text NOT NULL,
  `website` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `interest` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `firstname`, `lastname`, `address`, `city`, `postcode`, `phone_number`, `profilepic`, `coverpic`, `bio`, `website`, `user_id`, `date`, `nationality`, `interest`, `gender`, `dob`) VALUES
(1, 'slimkhloe', 'Michaels', 'Khloe', '', '', 0, 0, 'default.png', '', '', '', 11, '2017-01-21', 'Nigeria', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `recipient_id` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `visible` tinyint(5) NOT NULL,
  `privacy` tinyint(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `note`, `visible`, `privacy`, `date`) VALUES
(1, 11, 'was passing by ni ooo', 'just wanna test the note joor', 1, 0, '2017-01-26 00:13:27'),
(2, 11, 'was passing', 'just wanna test the note again', 1, 1, '2017-01-26 00:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `click` tinyint(5) NOT NULL,
  `seen` tinyint(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `type_id`, `user_id`, `click`, `seen`, `date`) VALUES
(1, 'follow', 1, 11, 0, 1, '2017-02-02 00:45:52'),
(2, 'follow', 2, 11, 0, 1, '2017-02-02 00:46:22'),
(4, 'love', 1, 11, 0, 1, '2017-02-02 02:07:27'),
(5, 'comment', 1, 11, 0, 1, '2017-02-02 16:33:20'),
(6, 'mention_story', 11, 7, 0, 1, '2017-02-20 16:28:31'),
(7, 'mention_story', 12, 7, 0, 1, '2017-02-20 17:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
`id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` text,
  `city` varchar(100) NOT NULL,
  `postcode` tinyint(10) NOT NULL,
  `phone_number` tinyint(20) NOT NULL,
  `profilepic` varchar(300) NOT NULL,
  `coverpic` varchar(300) NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bio` text NOT NULL,
  `webiste` text NOT NULL,
  `date` date NOT NULL,
  `sub_category` varchar(30) NOT NULL,
  `nationality` varchar(60) NOT NULL,
  `interest` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `username`, `fullname`, `address`, `city`, `postcode`, `phone_number`, `profilepic`, `coverpic`, `store_no`, `user_id`, `bio`, `webiste`, `date`, `sub_category`, `nationality`, `interest`) VALUES
(2, 'weezykon', 'weezykon akinbode', '10, sunday close, off alimi street', '', 0, 0, 'default.png', '', '7908', 7, '', '', '2017-01-20', '', 'Nigeria', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `postcode` tinyint(10) NOT NULL,
  `phone_number` tinyint(20) NOT NULL,
  `profilepic` varchar(300) NOT NULL,
  `coverpic` varchar(300) NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `website` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sub_category` varchar(30) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `interest` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `username`, `firstname`, `lastname`, `address`, `city`, `postcode`, `phone_number`, `profilepic`, `coverpic`, `store_no`, `bio`, `website`, `user_id`, `date`, `sub_category`, `nationality`, `dob`, `interest`) VALUES
(3, 'peezykon', 'akinbode', 'akinwunmi', '', '', 0, 0, 'default.png', '', '818', '', '', 12, '2017-01-24', '', 'Nigeria', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `user_id`, `story_id`, `date`) VALUES
(3, 11, 3, '2017-01-24 03:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE IF NOT EXISTS `search_history` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `item` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `facebook` varchar(60) NOT NULL,
  `twitter` varchar(60) NOT NULL,
  `snapchat` varchar(60) NOT NULL,
  `instagram` varchar(60) NOT NULL,
  `youtube` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `user_id`, `facebook`, `twitter`, `snapchat`, `instagram`, `youtube`) VALUES
(1, 11, 'slimkhloe', 'slimkhloe', '', 'slimkhloe', ''),
(2, 7, 'iamweezykon', '', '', 'iamweezykon', '');

-- --------------------------------------------------------

--
-- Table structure for table `sold_items`
--

CREATE TABLE IF NOT EXISTS `sold_items` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `book_id` varchar(30) NOT NULL,
  `store_no` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_no` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `story` text NOT NULL,
  `audio` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `visible` tinyint(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `story`, `audio`, `image`, `date`, `visible`) VALUES
(1, '11', 'test 1', 'null', 'null', '2017-01-24 02:56:22', 1),
(2, '11', 'test 2', 'null', 'null', '2017-01-24 02:56:55', 1),
(3, '11', 'test 3', 'null', 'null', '2017-01-24 03:02:21', 1),
(4, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:24:36', 1),
(5, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:27:14', 1),
(6, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:27:36', 1),
(7, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:27:38', 1),
(8, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:27:40', 1),
(9, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:27:46', 1),
(10, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:28:10', 1),
(11, '11', '@weezykon new post', 'null', 'null', '2017-02-20 16:28:31', 1),
(12, '11', '@weezykon new testing', 'null', 'null', '2017-02-20 17:31:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `story_meta`
--

CREATE TABLE IF NOT EXISTS `story_meta` (
`id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ids` text NOT NULL,
  `mentions` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `story_meta`
--

INSERT INTO `story_meta` (`id`, `type`, `type_id`, `ids`, `mentions`) VALUES
(1, 'mention_story', 11, '7,', '@weezykon'),
(2, 'mention_story', 12, '7,', '@weezykon');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
`id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `book_id` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_written`
--
ALTER TABLE `books_written`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_store`
--
ALTER TABLE `favorite_store`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_stories`
--
ALTER TABLE `favorite_stories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `love`
--
ALTER TABLE `love`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold_items`
--
ALTER TABLE `sold_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_meta`
--
ALTER TABLE `story_meta`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_written`
--
ALTER TABLE `books_written`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite_store`
--
ALTER TABLE `favorite_store`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite_stories`
--
ALTER TABLE `favorite_stories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `love`
--
ALTER TABLE `love`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sold_items`
--
ALTER TABLE `sold_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `story_meta`
--
ALTER TABLE `story_meta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
