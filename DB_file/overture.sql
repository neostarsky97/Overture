-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2018 at 07:51 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `overture`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE latin1_general_cs DEFAULT NULL,
  `artist` bigint(20) UNSIGNED DEFAULT NULL,
  `genre` bigint(20) UNSIGNED DEFAULT NULL,
  `artworkPath` varchar(500) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'The World from the Other Side of the Moon', 1, 1, 'assets\\artwork\\220px-The_World_from_the_Side_of_the_Moon.jpg'),
(2, 'All The Little Lights', 2, 2, 'assets\\artwork\\Passenger - All The Little Lights - Front.bmp'),
(3, 'Mylo Xyloto', 3, 2, 'assets\\artwork\\220px-Myloxyloto.jpg'),
(4, 'Ocean Eyes', 4, 3, 'assets\\artwork\\Owl-city-ocean-eyes-2009.jpg'),
(5, 'The Greatest Hits - Eminem', 5, 4, 'assets\\artwork\\Greatest Hits - Eminem.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Phillip Phillips'),
(2, 'Passenger'),
(3, 'Coldplay'),
(4, 'Owl City'),
(5, 'Eminem');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Country'),
(2, 'Pop'),
(3, 'Electronic'),
(4, 'Rap');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `user` bigint(20) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `user`, `dateCreated`) VALUES
(2, 'Brother', 1, '2018-04-22 00:00:00'),
(3, 'sick sick', 1, '2018-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `songId` bigint(20) UNSIGNED DEFAULT NULL,
  `playlistId` bigint(20) UNSIGNED DEFAULT NULL,
  `playlistOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(3, 8, 2, 1),
(12, 6, 2, 3),
(13, 4, 3, 0),
(14, 5, 3, 1),
(15, 5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE latin1_general_cs DEFAULT NULL,
  `artist` bigint(20) UNSIGNED DEFAULT NULL,
  `album` bigint(20) UNSIGNED DEFAULT NULL,
  `genre` bigint(20) UNSIGNED DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `path` varchar(500) COLLATE latin1_general_cs DEFAULT NULL,
  `plays` int(11) DEFAULT NULL,
  `albumOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `plays`, `albumOrder`) VALUES
(1, 'Man on the Moon', 1, 1, 1, '00:03:35', 'assets\\music\\Phillip Phillips\\The World from the Side of the Moon (2012)\\01 - Man on the Moon.mp3', 14, NULL),
(2, 'Home', 1, 1, 1, '00:03:30', 'assets\\music\\Phillip Phillips\\The World from the Side of the Moon (2012)\\02 - Home.mp3', 22, NULL),
(3, 'Gone, Gone, Gone', 1, 1, 1, '00:03:29', 'assets\\music\\Phillip Phillips\\The World from the Side of the Moon (2012)\\03 - Gone, Gone, Gone.mp3', 12, NULL),
(4, 'Let Her Go', 2, 2, 2, '00:04:10', 'assets\\music\\Passenger\\02 - Passenger - Let Her Go.mp3', 19, NULL),
(5, 'Paradise', 3, 3, 2, '00:04:37', 'assets\\music\\Coldplay\\Mylo Xyloto\\03 Paradise.m4a', 21, NULL),
(6, 'Charlie Brown', 3, 3, 2, '00:04:45', 'assets\\music\\Coldplay\\Mylo Xyloto\\04 Charlie Brown.m4a', 28, NULL),
(7, 'On The Wing', 4, 4, 3, '00:05:01', 'assets\\music\\Owl City\\Ocean Eyes\\08 On the Wing.mp3', 19, NULL),
(8, 'Fireflies', 4, 4, 3, '00:03:48', 'assets\\music\\Owl City\\Ocean Eyes\\09 Fireflies.mp3', 20, NULL),
(9, 'Lose Yourself', 5, 5, 4, '00:05:20', 'assets\\music\\Eminem\\Greatest Hits\\10 - Lose Yourself.mp3', 27, NULL),
(10, 'Mockingbird', 5, 5, 4, '00:04:10', 'assets\\music\\Eminem\\Greatest Hits\\17 - Mockingbird.mp3', 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE latin1_general_cs DEFAULT NULL,
  `firstName` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `lastName` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `gender` varchar(10) COLLATE latin1_general_cs DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `password` varchar(32) COLLATE latin1_general_cs DEFAULT NULL,
  `profilePic` varchar(500) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `gender`, `DOB`, `email`, `password`, `profilePic`) VALUES
(1, 'brandon', 'Brandon', 'Stark', 'Male', '1997-01-01', 'bstark@gmail.com', '6a204bd89f3c8348afd5c77c717a097a', 'Overture\\assets\\images\\me.JPG'),
(2, 'BrandoN', 'Braddy', 'Starkie', 'Male', '2001-01-02', 'bstarkk@gmail.com', '6a204bd89f3c8348afd5c77c717a097a', 'Overture\\assets\\images\\me.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `artist` (`artist`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `genre` (`genre`),
  ADD KEY `album` (`album`),
  ADD KEY `artist` (`artist`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `albums_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`album`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`album`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `songs_ibfk_4` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
