-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 09:53 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(5, 'category 1', 0),
(6, 'test category', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `cat_id`, `price`, `qty`, `description`) VALUES
(1, 'test product111111', '20170102ZRUCZMDMDZYTSPYEA6M4D7I4.png', 5, 324, 5, 'alsidaksjha jhashjd ajsdh hsdhkash dasdjkha shdahs dhashd asdha sd asd asd asdha sda sdhasjd asd asd asd asd asdhas dad asdasa sjdajksdjasdj asjkd kjasdjk ajksdh asjk kaskd ashkdh asjdk ajksdhkas hdahsd hasdh ahsd asd asd asd adashdhasdlhasdljask hdlashas sdalsk dhlasdhlashdasd hd had hshdjadhasdhasd asd ashd asldhasdjasdh hsdal hddjasdhasdh hjjj h hjdasd jhas ad ashj asd as ada sdha sdas dashd ahd asdasl dhlasdlh ashldj adalsl dkasl dkasd asld asjd asld asdasd hasdashdsajkd'),
(4, 'test product 3', 'Tulips.jpg', 0, 23234, 5, 'dasdasdasdasdad asdashd ajd dajkdah dadad ad dad ad ada sdjkas ajdad ajsdasdj asjd asd asd ad akjsdj akjldhskdhaldhkasd adhja dkasdj asdjd haskd asd asd ajd adasjk dasdskdjaka da ad jkdhkasdh klahdajskld haldlh dahd ahdad ahdlalk ahdahashlda hdlahda ahdhdadh ahsadhkaldhashdahd hadh hd ahdasdl hlkasahk dahld hasdh; a;shdhka; dasdkasdjk \'asdad\'asd kjasdj kasjkd ajkd as\'jj\' as\'j adjasd \'ajsdjasdj\'d jasd\'ljka jdjasd j\'lasd\'jsa\'dj sajdj\' asdj\' las\'jda\'j sd\'jasd \'ajd\'ljkas\'ld \'ljasdkl\' asd a\'sljd j\'asj\'d as\'d\' asdj \'asds \'sad\'jkas djk\'asjd j\'kdasj\'djas jadj as\'jd as\'jd aj\'kdj\'asjdk asdjkas \'jda j\'adj ad\'jaj dajsdjkls daj\'d aj\'da j\'da jajd\' as jdasj\'da \'jd j\'dadj\'asj\'dasj\'d jl');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(2, 'test', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
