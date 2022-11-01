-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 07:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db6`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `AlbumTitle` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `regDate` date NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `Mtime` varchar(50) NOT NULL,
  `ArtName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumTitle`, `genre`, `regDate`, `Mname`, `Mtime`, `ArtName`) VALUES
('one', 'pop', '2020-07-16', 'one time', '3:30', 'justin b'),
('one', 'pop', '2020-07-16', 'one way', '3:40', 'justin b'),
('baby', 'pop', '2020-07-16', 'baby', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'car', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'faint', '3:40', 'justin b'),
('road', 'sprit', '2020-07-16', 'mirror', '3:30', 'justin b'),
('pretty', 'pop', '2020-07-16', 'sunset', '3:30', 'sia'),
('pretty', 'pop', '2020-07-16', 'utopia', '2:00', 'sia'),
('desert', 'pop', '2020-07-19', 'desert', '3:40', 'justin b'),
('naro', 'pop', '2020-07-19', 'naro', '3:30', 'mehdi yarahi'),
('end game', 'pop', '2020-07-19', 'boyfriend', '3:40', 'justin b'),
('end game', 'pop', '2020-07-19', 'game', '2:00', 'justin b'),
('end game', 'pop', '2020-07-19', 'pressure', '2:30', 'justin b'),
('end game', 'pop', '2020-07-19', 'town', '2:30', 'justin b'),
('one', 'pop', '2020-07-16', 'one time', '3:30', 'justin b'),
('one', 'pop', '2020-07-16', 'one way', '3:40', 'justin b'),
('baby', 'pop', '2020-07-16', 'baby', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'car', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'faint', '3:40', 'justin b'),
('road', 'sprit', '2020-07-16', 'mirror', '3:30', 'justin b'),
('pretty', 'pop', '2020-07-16', 'sunset', '3:30', 'sia'),
('pretty', 'pop', '2020-07-16', 'utopia', '2:00', 'sia'),
('desert', 'pop', '2020-07-19', 'desert', '3:40', 'justin b'),
('naro', 'pop', '2020-07-19', 'naro', '3:30', 'mehdi yarahi'),
('end game', 'pop', '2020-07-19', 'boyfriend', '3:40', 'justin b'),
('end game', 'pop', '2020-07-19', 'game', '2:00', 'justin b'),
('end game', 'pop', '2020-07-19', 'pressure', '2:30', 'justin b'),
('end game', 'pop', '2020-07-19', 'town', '2:30', 'justin b'),
('one', 'pop', '2020-07-16', 'one time', '3:30', 'justin b'),
('one', 'pop', '2020-07-16', 'one way', '3:40', 'justin b'),
('baby', 'pop', '2020-07-16', 'baby', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'car', '2:00', 'justin b'),
('road', 'sprit', '2020-07-16', 'faint', '3:40', 'justin b'),
('road', 'sprit', '2020-07-16', 'mirror', '3:30', 'justin b'),
('pretty', 'pop', '2020-07-16', 'sunset', '3:30', 'sia'),
('pretty', 'pop', '2020-07-16', 'utopia', '2:00', 'sia'),
('desert', 'pop', '2020-07-19', 'desert', '3:40', 'justin b'),
('naro', 'pop', '2020-07-19', 'naro', '3:30', 'mehdi yarahi'),
('end game', 'pop', '2020-07-19', 'boyfriend', '3:40', 'justin b'),
('end game', 'pop', '2020-07-19', 'game', '2:00', 'justin b'),
('end game', 'pop', '2020-07-19', 'pressure', '2:30', 'justin b'),
('end game', 'pop', '2020-07-19', 'town', '2:30', 'justin b');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `ArtName` varchar(30) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `userType` char(1) NOT NULL,
  `resType` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ArtName`, `nationality`, `startDate`, `username`, `userType`, `resType`) VALUES
('justin b', 'american', '2019-10-03', 'justin99', 'A', 'ok'),
('mehdi yarahi', 'iranian', '2019-10-03', 'mehdi-y', 'A', 'ok'),
('minoo', 'afghan', '2017-09-17', 'minoo', 'A', 'Checking'),
('sia', 'american', '2019-11-05', 'sia', 'A', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `firstUsername` varchar(30) NOT NULL,
  `secondUsername` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`firstUsername`, `secondUsername`) VALUES
('justin99', 'kamran'),
('justin99', 'sia'),
('saba.em', 'justin99'),
('iman', 'justin99'),
('iman', 'saba.em'),
('iman', 'sia'),
('justin99', 'admin'),
('justin99', 'iman'),
('saba.em', 'sia'),
('saba.em', 'admin'),
('justin99', 'kamran'),
('justin99', 'sia'),
('saba.em', 'justin99'),
('iman', 'justin99'),
('iman', 'saba.em'),
('iman', 'sia'),
('justin99', 'admin'),
('justin99', 'iman'),
('saba.em', 'sia'),
('saba.em', 'admin'),
('justin99', 'kamran'),
('justin99', 'sia'),
('saba.em', 'justin99'),
('iman', 'justin99'),
('iman', 'saba.em'),
('iman', 'sia'),
('justin99', 'admin'),
('justin99', 'iman'),
('saba.em', 'sia'),
('saba.em', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ip_loginlimit`
--

CREATE TABLE `ip_loginlimit` (
  `ID` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timeDiff` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listener`
--

CREATE TABLE `listener` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `userType` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listener`
--

INSERT INTO `listener` (`firstName`, `lastName`, `nationality`, `DateOfBirth`, `username`, `userType`) VALUES
('saba', 'emami', 'iranian', '1999-05-06', 'saba.em', 'L'),
('nasim', 'fani', 'iranian', '2014-07-10', 'nacm.fn', 'L'),
('kamran', 'kamrani', 'iranian', '2019-07-04', 'kamran', 'L'),
('zahra', 'mahdavi', 'arabic', '2019-10-03', 'zahra-m', 'L'),
('iman', 'heidari', 'iranian', '2019-07-04', 'iman', 'L'),
('negar', 'fani', 'iranian', '2019-10-02', 'nagar', 'L'),
('saba', 'emami', 'iranian', '1999-05-06', 'saba.em', 'L'),
('nasim', 'fani', 'iranian', '2014-07-10', 'nacm.fn', 'L'),
('kamran', 'kamrani', 'iranian', '2019-07-04', 'kamran', 'L'),
('zahra', 'mahdavi', 'arabic', '2019-10-03', 'zahra-m', 'L'),
('iman', 'heidari', 'iranian', '2019-07-04', 'iman', 'L'),
('negar', 'fani', 'iranian', '2019-10-02', 'nagar', 'L'),
('saba', 'emami', 'iranian', '1999-05-06', 'saba.em', 'L'),
('nasim', 'fani', 'iranian', '2014-07-10', 'nacm.fn', 'L'),
('kamran', 'kamrani', 'iranian', '2019-07-04', 'kamran', 'L'),
('zahra', 'mahdavi', 'arabic', '2019-10-03', 'zahra-m', 'L'),
('iman', 'heidari', 'iranian', '2019-07-04', 'iman', 'L'),
('negar', 'fani', 'iranian', '2019-10-02', 'nagar', 'L'),
('hodi', 'hodhod', 'iran', '0000-00-00', 'hoda', 'L'),
('hodi', 'hodhod', 'iran', '1999-08-08', 'hoda', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `loginlimit`
--

CREATE TABLE `loginlimit` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `timeDiff` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginlimit`
--

INSERT INTO `loginlimit` (`ID`, `username`, `timeDiff`) VALUES
(1, 'iman', '47'),
(1, 'sia', '48'),
(2, 'sia', '12'),
(3, 'sia', '13'),
(4, 'sia', '13'),
(1, 'iman', '47'),
(1, 'sia', '48'),
(2, 'sia', '12'),
(3, 'sia', '13'),
(4, 'sia', '13'),
(1, 'iman', '47'),
(1, 'sia', '48'),
(2, 'sia', '12'),
(3, 'sia', '13'),
(4, 'sia', '13');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `Mname` varchar(50) NOT NULL,
  `Mtime` varchar(50) NOT NULL,
  `ArtName` varchar(30) NOT NULL,
  `report` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`Mname`, `Mtime`, `ArtName`, `report`) VALUES
('baby', '2:00', 'justin b', 'Fine'),
('boyfriend', '3:40', 'justin b', 'Fine'),
('car', '2:00', 'justin b', 'Fine'),
('desert', '3:40', 'justin b', 'Fine'),
('faint', '3:40', 'justin b', 'Fine'),
('game', '2:00', 'justin b', 'Fine'),
('girl', '2:30', 'sia', 'Fine'),
('mirror', '3:30', 'justin b', 'reported'),
('naro', '3:30', 'mehdi yarahi', 'Fine'),
('one time', '3:30', 'justin b', 'Fine'),
('one way', '3:40', 'justin b', 'Fine'),
('pressure', '2:30', 'justin b', 'Fine'),
('sunset', '3:30', 'sia', 'Fine'),
('town', '2:30', 'justin b', 'Fine'),
('utopia', '2:00', 'sia', 'Fine');

-- --------------------------------------------------------

--
-- Table structure for table `play`
--

CREATE TABLE `play` (
  `Mname` varchar(50) NOT NULL,
  `pDate` date NOT NULL,
  `ArtName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `play`
--

INSERT INTO `play` (`Mname`, `pDate`, `ArtName`, `username`) VALUES
('one time', '2020-07-16', 'justin b', 'justin99'),
('one time', '2020-07-16', 'justin b', 'justin99'),
('one way', '2020-07-16', 'justin b', 'justin99'),
('baby', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'justin99'),
('faint', '2020-07-16', 'justin b', 'justin99'),
('mirror', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'saba.em'),
('faint', '2020-07-16', 'justin b', 'saba.em'),
('mirror', '2020-07-16', 'justin b', 'saba.em'),
('sunset', '2020-07-16', 'sia', 'saba.em'),
('utopia', '2020-07-16', 'sia', 'saba.em'),
('baby', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-16', 'justin b', 'saba.em'),
('one way', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-19', 'justin b', 'iman'),
('one way', '2020-07-19', 'justin b', 'iman'),
('baby', '2020-07-19', 'justin b', 'iman'),
('mirror', '2020-07-19', 'justin b', 'iman'),
('sunset', '2020-07-19', 'sia', 'iman'),
('sunset', '2020-07-19', 'sia', 'sia'),
('car', '2020-07-19', 'justin b', 'saba.em'),
('faint', '2020-07-19', 'justin b', 'saba.em'),
('mirror', '2020-07-19', 'justin b', 'saba.em'),
('sunset', '2020-07-19', 'sia', 'saba.em'),
('utopia', '2020-07-19', 'sia', 'saba.em'),
('boyfriend', '2020-07-19', 'justin b', 'saba.em'),
('game', '2020-07-19', 'justin b', 'saba.em'),
('pressure', '2020-07-19', 'justin b', 'saba.em'),
('town', '2020-07-19', 'justin b', 'saba.em'),
('desert', '2020-07-19', 'justin b', 'iman'),
('pressure', '2020-07-19', 'justin b', 'iman'),
('one time', '2020-07-16', 'justin b', 'justin99'),
('one time', '2020-07-16', 'justin b', 'justin99'),
('one way', '2020-07-16', 'justin b', 'justin99'),
('baby', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'justin99'),
('faint', '2020-07-16', 'justin b', 'justin99'),
('mirror', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'saba.em'),
('faint', '2020-07-16', 'justin b', 'saba.em'),
('mirror', '2020-07-16', 'justin b', 'saba.em'),
('sunset', '2020-07-16', 'sia', 'saba.em'),
('utopia', '2020-07-16', 'sia', 'saba.em'),
('baby', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-16', 'justin b', 'saba.em'),
('one way', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-19', 'justin b', 'iman'),
('one way', '2020-07-19', 'justin b', 'iman'),
('baby', '2020-07-19', 'justin b', 'iman'),
('mirror', '2020-07-19', 'justin b', 'iman'),
('sunset', '2020-07-19', 'sia', 'iman'),
('sunset', '2020-07-19', 'sia', 'sia'),
('car', '2020-07-19', 'justin b', 'saba.em'),
('faint', '2020-07-19', 'justin b', 'saba.em'),
('mirror', '2020-07-19', 'justin b', 'saba.em'),
('sunset', '2020-07-19', 'sia', 'saba.em'),
('utopia', '2020-07-19', 'sia', 'saba.em'),
('boyfriend', '2020-07-19', 'justin b', 'saba.em'),
('game', '2020-07-19', 'justin b', 'saba.em'),
('pressure', '2020-07-19', 'justin b', 'saba.em'),
('town', '2020-07-19', 'justin b', 'saba.em'),
('desert', '2020-07-19', 'justin b', 'iman'),
('pressure', '2020-07-19', 'justin b', 'iman'),
('one time', '2020-07-16', 'justin b', 'justin99'),
('one time', '2020-07-16', 'justin b', 'justin99'),
('one way', '2020-07-16', 'justin b', 'justin99'),
('baby', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'justin99'),
('faint', '2020-07-16', 'justin b', 'justin99'),
('mirror', '2020-07-16', 'justin b', 'justin99'),
('car', '2020-07-16', 'justin b', 'saba.em'),
('faint', '2020-07-16', 'justin b', 'saba.em'),
('mirror', '2020-07-16', 'justin b', 'saba.em'),
('sunset', '2020-07-16', 'sia', 'saba.em'),
('utopia', '2020-07-16', 'sia', 'saba.em'),
('baby', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-16', 'justin b', 'saba.em'),
('one way', '2020-07-16', 'justin b', 'saba.em'),
('one time', '2020-07-19', 'justin b', 'iman'),
('one way', '2020-07-19', 'justin b', 'iman'),
('baby', '2020-07-19', 'justin b', 'iman'),
('mirror', '2020-07-19', 'justin b', 'iman'),
('sunset', '2020-07-19', 'sia', 'iman'),
('sunset', '2020-07-19', 'sia', 'sia'),
('car', '2020-07-19', 'justin b', 'saba.em'),
('faint', '2020-07-19', 'justin b', 'saba.em'),
('mirror', '2020-07-19', 'justin b', 'saba.em'),
('sunset', '2020-07-19', 'sia', 'saba.em'),
('utopia', '2020-07-19', 'sia', 'saba.em'),
('boyfriend', '2020-07-19', 'justin b', 'saba.em'),
('game', '2020-07-19', 'justin b', 'saba.em'),
('pressure', '2020-07-19', 'justin b', 'saba.em'),
('town', '2020-07-19', 'justin b', 'saba.em'),
('desert', '2020-07-19', 'justin b', 'iman'),
('pressure', '2020-07-19', 'justin b', 'iman');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `pName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `addDate` date NOT NULL,
  `ArtName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`pName`, `username`, `Mname`, `addDate`, `ArtName`) VALUES
('good', 'justin99', 'mirror', '2020-07-16', 'justin b'),
('life', 'justin99', 'car', '2020-07-16', 'justin b'),
('life', 'justin99', 'faint', '2020-07-16', 'justin b'),
('life', 'justin99', 'sunset', '2020-07-16', 'sia'),
('bag', 'justin99', 'one way', '2020-07-16', 'justin b'),
('bag', 'justin99', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'justin99', 'sunset', '2020-07-16', 'sia'),
('Shared good from justin99', 'sia', 'mirror', '2020-07-16', 'justin b'),
('Liked Songs', 'saba.em', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'iman', 'sunset', '2020-07-19', 'sia'),
('my pl', 'iman', 'baby', '2020-07-19', 'justin b'),
('my pl', 'iman', 'car', '2020-07-19', 'justin b'),
('my pl', 'iman', 'faint', '2020-07-19', 'justin b'),
('bag', 'iman', 'baby', '2020-07-19', 'justin b'),
('Liked Songs', 'iman', 'utopia', '2020-07-19', 'sia'),
('good', 'justin99', 'mirror', '2020-07-16', 'justin b'),
('life', 'justin99', 'car', '2020-07-16', 'justin b'),
('life', 'justin99', 'faint', '2020-07-16', 'justin b'),
('life', 'justin99', 'sunset', '2020-07-16', 'sia'),
('bag', 'justin99', 'one way', '2020-07-16', 'justin b'),
('bag', 'justin99', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'justin99', 'sunset', '2020-07-16', 'sia'),
('Shared good from justin99', 'sia', 'mirror', '2020-07-16', 'justin b'),
('Liked Songs', 'saba.em', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'iman', 'sunset', '2020-07-19', 'sia'),
('my pl', 'iman', 'baby', '2020-07-19', 'justin b'),
('my pl', 'iman', 'car', '2020-07-19', 'justin b'),
('my pl', 'iman', 'faint', '2020-07-19', 'justin b'),
('bag', 'iman', 'baby', '2020-07-19', 'justin b'),
('Liked Songs', 'iman', 'utopia', '2020-07-19', 'sia'),
('good', 'justin99', 'mirror', '2020-07-16', 'justin b'),
('life', 'justin99', 'car', '2020-07-16', 'justin b'),
('life', 'justin99', 'faint', '2020-07-16', 'justin b'),
('life', 'justin99', 'sunset', '2020-07-16', 'sia'),
('bag', 'justin99', 'one way', '2020-07-16', 'justin b'),
('bag', 'justin99', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'justin99', 'sunset', '2020-07-16', 'sia'),
('Shared good from justin99', 'sia', 'mirror', '2020-07-16', 'justin b'),
('Liked Songs', 'saba.em', 'baby', '2020-07-16', 'justin b'),
('Liked Songs', 'iman', 'sunset', '2020-07-19', 'sia'),
('my pl', 'iman', 'baby', '2020-07-19', 'justin b'),
('my pl', 'iman', 'car', '2020-07-19', 'justin b'),
('my pl', 'iman', 'faint', '2020-07-19', 'justin b'),
('bag', 'iman', 'baby', '2020-07-19', 'justin b'),
('Liked Songs', 'iman', 'utopia', '2020-07-19', 'sia');

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE `premium` (
  `cardNo` varchar(50) NOT NULL,
  `expcardDate` date NOT NULL,
  `buyDate` date NOT NULL,
  `expDate` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `userType` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premium`
--

INSERT INTO `premium` (`cardNo`, `expcardDate`, `buyDate`, `expDate`, `username`, `userType`) VALUES
('22559966633778885555', '2021-09-22', '2020-07-19', '2020-07-22', 'iman', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `questionslist`
--

CREATE TABLE `questionslist` (
  `question` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `answer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionslist`
--

INSERT INTO `questionslist` (`question`, `username`, `answer`) VALUES
('color', 'saba.em', 'red'),
('color', 'nacm.fn', 'pink'),
('faveTeacher', 'justin99', 'galler'),
('color', 'kamran', 'black'),
('faveTeacher', 'zahra-m', 'mehrabun'),
('color', 'mehdi-y', 'green'),
('color', 'sia', 'blue'),
('faveTeacher', 'minoo', 'professor'),
('color', 'iman', 'black'),
('color', 'nagar', 'green'),
('color', 'saba.em', 'red'),
('color', 'nacm.fn', 'pink'),
('faveTeacher', 'justin99', 'galler'),
('color', 'kamran', 'black'),
('faveTeacher', 'zahra-m', 'mehrabun'),
('color', 'mehdi-y', 'green'),
('color', 'sia', 'blue'),
('faveTeacher', 'minoo', 'professor'),
('color', 'iman', 'black'),
('color', 'nagar', 'green'),
('color', 'saba.em', 'red'),
('color', 'nacm.fn', 'pink'),
('faveTeacher', 'justin99', 'galler'),
('color', 'kamran', 'black'),
('faveTeacher', 'zahra-m', 'mehrabun'),
('color', 'mehdi-y', 'green'),
('color', 'sia', 'blue'),
('faveTeacher', 'minoo', 'professor'),
('color', 'iman', 'black'),
('color', 'nagar', 'green'),
('color', 'hoda', 'gold');

-- --------------------------------------------------------

--
-- Table structure for table `requestcontrol`
--

CREATE TABLE `requestcontrol` (
  `ip` varchar(255) NOT NULL,
  `requests` int(255) NOT NULL,
  `expires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestcontrol`
--

INSERT INTO `requestcontrol` (`ip`, `requests`, `expires`) VALUES
('::1', 1, '19:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `sharedplaylist`
--

CREATE TABLE `sharedplaylist` (
  `pName` varchar(30) NOT NULL,
  `mainUsername` varchar(30) NOT NULL,
  `addUsername` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `hashedpass` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userType` char(1) NOT NULL
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `pass`, `hashedpass`, `email`, `userType`) VALUES
('admin', 'adminadmin', 'jj', 'admin@gmail.com', 'A'),
('hoda', 'Ab123456', 'a0a475cf454cf9a06979034098167b9e', 'hoda.s@gmail.com', 'L'),
('iman', 'iman44455577', '$2y$10$azm3dZIcXTMhNtI6NGN/quME5000aum9YMB4mXdz5zrd11ULXBhae', 'iman@gmail.com', 'L'),
('justin99', 'justin99ty42276', '$2y$10$qZ7JGgis3y13jWSEDbdvnuTQNm5.BLZz7w15droLYAv4bzQthrIsu', 'justin99@gmail.com', 'A'),
('kamran', 'kamran44559988', '$2y$10$HTKi4ZVS275Qxh..KFC5W.c8OjjAuhypbSs0FX8sqbktslY9nRhEO', 'kamran@gmail.com', 'L'),
('mehdi-y', 'yarahi55887799ii', '$2y$10$M8pIWR1bw17XZi9XbJwLBeXhgFINWAyiyMSF.pDjUH2./spC.c7LC', 'mehdiyar@gmail.com', 'A'),
('minoo', 'minu88899966yy', '$2y$10$1lllqWkx7EsdpHWJT.7U3..ameAXpNOIOeftU2btTeB/wnQ09z5Uy', 'minoo@gmail.com', 'A'),
('nacm.fn', '5432kmn986', '$2y$10$9JDaeFLZ5VMawJCsumdopum.98vj3wqRziHHP6dNhLR6uWpc/f1g2', 'nacm.fn@yahoo.com', 'L'),
('nagar', 'negar44555666', '$2y$10$q.LJDfNQMXwB6g3myLanheCC3oB6hVmv/wBLsX09tu4rnzxVjQF.O', 'negar@gmail.com', 'L'),
('saba.em', '12345ll4', '$2y$10$1XgiiyP/ypQghiR.YquI9OfB2RUacX57cn2fbgpl64fVoSxsihdBK', 'saba.em9@gmail.com', 'L'),
('sia', 'siaaa333355', '$2y$10$fq8befMdBTn1O6zHyNAziOllIVSXJgHKx.WlsmIJgrqc9AI03PgaK', 'sia@gmail.com', 'A'),
('zahra-m', '44445522zaha', '$2y$10$e.NcAy3Z6GH2JOtzvqGgVOgza2jj0uaXYG3.JiQRc9qLmj/nEKsyy', 'zahra.m@gmail.com', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD KEY `Mname` (`Mname`,`Mtime`),
  ADD KEY `ArtName` (`ArtName`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`ArtName`),
  ADD KEY `username` (`username`,`userType`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD KEY `firstUsername` (`firstUsername`),
  ADD KEY `secondUsername` (`secondUsername`);

--
-- Indexes for table `listener`
--
ALTER TABLE `listener`
  ADD KEY `username` (`username`,`userType`);

--
-- Indexes for table `loginlimit`
--
ALTER TABLE `loginlimit`
  ADD KEY `username` (`username`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`Mname`,`Mtime`,`ArtName`),
  ADD KEY `ArtName` (`ArtName`);

--
-- Indexes for table `play`
--
ALTER TABLE `play`
  ADD KEY `ArtName` (`ArtName`,`Mname`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD KEY `username` (`username`),
  ADD KEY `Mname` (`Mname`),
  ADD KEY `ArtName` (`ArtName`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`cardNo`,`expDate`),
  ADD KEY `username` (`username`,`userType`);

--
-- Indexes for table `questionslist`
--
ALTER TABLE `questionslist`
  ADD KEY `username` (`username`);

--
-- Indexes for table `requestcontrol`
--
ALTER TABLE `requestcontrol`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `sharedplaylist`
--
ALTER TABLE `sharedplaylist`
  ADD KEY `mainUsername` (`mainUsername`),
  ADD KEY `addUsername` (`addUsername`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`,`userType`,`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`Mname`,`Mtime`) REFERENCES `music` (`Mname`, `Mtime`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`ArtName`) REFERENCES `artist` (`ArtName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`username`,`userType`) REFERENCES `user` (`username`, `userType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`firstUsername`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`secondUsername`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listener`
--
ALTER TABLE `listener`
  ADD CONSTRAINT `listener_ibfk_1` FOREIGN KEY (`username`,`userType`) REFERENCES `user` (`username`, `userType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loginlimit`
--
ALTER TABLE `loginlimit`
  ADD CONSTRAINT `loginlimit_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`ArtName`) REFERENCES `artist` (`ArtName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `play`
--
ALTER TABLE `play`
  ADD CONSTRAINT `play_ibfk_1` FOREIGN KEY (`ArtName`,`Mname`) REFERENCES `music` (`ArtName`, `Mname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `play_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`Mname`) REFERENCES `music` (`Mname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_ibfk_3` FOREIGN KEY (`ArtName`) REFERENCES `artist` (`ArtName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`username`,`userType`) REFERENCES `user` (`username`, `userType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionslist`
--
ALTER TABLE `questionslist`
  ADD CONSTRAINT `questionslist_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sharedplaylist`
--
ALTER TABLE `sharedplaylist`
  ADD CONSTRAINT `sharedplaylist_ibfk_1` FOREIGN KEY (`mainUsername`) REFERENCES `playlist` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sharedplaylist_ibfk_2` FOREIGN KEY (`addUsername`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
