-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2022 at 05:07 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ensaphpds`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `contenu` text COLLATE latin1_general_cs NOT NULL,
  `depot` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_photo` int(11) NOT NULL,
  `auteur` varchar(128) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Contient des informations sur les commentaires des photos';

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `contenu`, `depot`, `id_photo`, `auteur`) VALUES
(82, 'nice one', '2022-02-14 03:40:11', 47, 'abdelkados'),
(83, 'great', '2022-02-14 03:40:17', 48, 'abdelkados'),
(85, 'ensa is the great school in all the world', '2022-02-14 03:43:31', 46, 'abdelkados'),
(86, 'benzemma the best', '2022-02-14 03:44:17', 50, 'hichamchah'),
(87, 'php <3', '2022-02-14 03:44:31', 51, 'hichamchah'),
(88, 'Php', '2022-02-14 03:50:27', 51, 'asmae'),
(89, 'safi ahssan mdina f mghrib', '2022-02-14 03:51:00', 46, 'asmae');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `fichier` varchar(255) COLLATE latin1_general_cs NOT NULL,
  `date_photo` date NOT NULL,
  `description` text COLLATE latin1_general_cs NOT NULL,
  `proprietaire` varchar(128) COLLATE latin1_general_cs NOT NULL,
  `isProfile` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Contient les informations sur les photos';

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `fichier`, `date_photo`, `description`, `proprietaire`, `isProfile`) VALUES
(45, 'photos/hichamchah/testimonials-4.jpg', '2022-02-14', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eos ullam aperiam quis laudantium vero ea ducimus iure animi. Odio exercitationem amet ex odit ut tempore saepe incidunt soluta nesciunt!', 'hichamchah', 1),
(46, 'photos/hichamchah/download.jfif', '2022-02-17', 'safi safi', 'hichamchah', 0),
(47, 'photos/hichamchah/wentworth-miller-prison-break-season-1-1014x570.jpg', '2022-02-25', 'wentworth-miller-prison-break-season', 'hichamchah', 0),
(48, 'photos/hichamchah/1927893.jpg', '2022-02-05', 'GOT', 'hichamchah', 0),
(49, 'photos/abdelkados/download (1).jfif', '2022-02-14', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eos ullam aperiam quis laudantium vero ea ducimus iure animi. Odio exercitationem amet ex odit ut tempore saepe incidunt soluta nesciunt!', 'abdelkados', 1),
(50, 'photos/abdelkados/FJQiWRtXwAIKbZw.jpg', '2022-02-16', 'benzeeeeeeeeema', 'abdelkados', 0),
(51, 'photos/abdelkados/php-logo.png', '2022-02-16', 'php', 'abdelkados', 0),
(52, 'photos/abdelkados/inventors-header-2-1920x730.jpg', '2022-02-18', 'Czech Footprint: Inventions and Inventors ', 'abdelkados', 0),
(53, 'photos/asmae/download (2).jfif', '2022-02-14', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eos ullam aperiam quis laudantium vero ea ducimus iure animi. Odio exercitationem amet ex odit ut tempore saepe incidunt soluta nesciunt!', 'asmae', 1),
(54, 'photos/asmae/inspirational-quotes-camilla-eyring-kimball-1562000222.png', '2022-02-10', '“Never let the fear of striking out keep you from playing the game.”– Babe Ruth', 'asmae', 0),
(56, 'photos/asmae/photo-1606607291535-b0adfbf7424f.jfif', '2022-03-08', 'In order to write about life first you must live it.”– Ernest Hemingway', 'asmae', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `login` varchar(128) COLLATE latin1_general_cs NOT NULL,
  `password` varchar(255) COLLATE latin1_general_cs NOT NULL,
  `idPhoto` int(11) DEFAULT NULL,
  `desc_user` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `metier` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `token` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `genre` varchar(55) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Contient les informations de base sur les utilisateurs';

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`, `idPhoto`, `desc_user`, `metier`, `token`, `active`, `email`, `genre`) VALUES
('abdelkados', '0bdc9d2d256b3ee9daae347be6f4dc835a467ffe', 49, 'I am from Safi', 'undefined', '837ac70ceecacfcb5ad78d5bbb52e8fe', 1, 'abdelkadousessehymy@gmail.com ', 'homme'),
('asmae', 'eb7413653e6a9566f98c0b4b9db8dc4907f52d56', 53, 'I am from Agadir', 'Dev', 'd6eaca056b1afddbddc970945c15b06e', 1, 'hichamchahboune.java@gmail.com', 'femme'),
('hichamchah', 'c47907abd2a80492ca9388b05c0e382518ff3960', 45, 'I am from Safi', 'dev', '9f86fa395d1135ba40d62a2ff4b2425c', 1, 'hichamchah.jb.mc@gmail.com', 'homme');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comm_photo` (`id_photo`),
  ADD KEY `fk_comm_util` (`auteur`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photo_utilisateur` (`proprietaire`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`login`),
  ADD KEY `idPhoto` (`idPhoto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_comm_photo` FOREIGN KEY (`id_photo`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `fk_comm_util` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`login`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_utilisateur` FOREIGN KEY (`proprietaire`) REFERENCES `utilisateur` (`login`) ON DELETE CASCADE;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
