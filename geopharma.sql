-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 13 Décembre 2012 à 18:47
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `geopharma`
--

-- --------------------------------------------------------

--
-- Structure de la table `pharmacies`
--

CREATE TABLE IF NOT EXISTS `pharmacies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `type` varchar(255) NOT NULL,
  `region` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `pharmacies`
--

INSERT INTO `pharmacies` (`id`, `code`, `nom`, `lat`, `lng`, `type`, `region`, `created`, `modified`) VALUES
(1, 'PH01', 'Pharmacie Cité Asecna', 14.729265213012695, -17.490543365478516, 'Pharmacie', 0, '2012-11-20 12:04:19', '2012-11-28 14:14:42'),
(2, 'PH02', 'Pharmacie la Croix-blanche', 14.751524, -17.459587, 'Pharmacie', 0, '2012-11-22 18:20:21', '2012-11-28 14:15:42'),
(3, 'PH001', 'Pharmacie XXX', 47.23312000000001, -0.4298400000000129, 'Pharmacie', 0, '2012-11-24 10:59:52', '2012-11-24 10:59:52'),
(4, 'PH004', 'Pharmacie Liberter 5', 16.082411939728324, -14.765624593749976, 'Pharmacie', 0, '2012-11-28 10:16:25', '2012-11-28 10:16:25'),
(5, 'S01', 'SAMU', 14.747234750089385, -17.3896751228516, 'Centre de santé', 0, '2012-11-28 14:47:29', '2012-11-28 14:47:29'),
(6, 'H01', 'Hopital', 14.779769599729894, -17.347103101367225, 'Hopital', 0, '2012-11-28 14:48:22', '2012-11-28 14:48:22');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `superficie` varchar(255) NOT NULL,
  `population` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `superficie`, `population`) VALUES
(1, 'Dakar', '550 km²', 2411530),
(2, 'Diourbel', '4359 km²', 930008),
(3, 'Fatick 	 	', '7935 km²', 639075),
(4, 'Kaolack', '16010 km²', 1128130),
(5, 'Kolda', '21011 km²', 834753),
(6, 'Louga 	 	', '29188 km²', 559268),
(7, 'Matam', '25083 km²', 423041),
(8, 'Saint-Louis', '19044 km²', 863440),
(9, 'Tambacounda', '59602 km²', 530332),
(10, 'Thiès 		', '6601 km ²', 1348640);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `lastlogin`) VALUES
(1, 'prince', 'ba9be5a8611e184adf6c9c86f33ae1dd1965b1ee', 'admin', '2012-11-15 19:04:34', '2012-11-15 19:04:34', '0000-00-00 00:00:00'),
(2, 'omar', '7a7f04fdc9b15ecb5424a9ca099446e8922f0329', 'utilisateur', '2012-11-20 19:19:32', '2012-11-20 19:27:42', '0000-00-00 00:00:00'),
(3, 'fall', 'f950114d6643bd4fb8d4ef1b1cb55fb9e8e3d802', 'admin', '2012-11-24 10:43:46', '2012-11-24 10:43:46', '0000-00-00 00:00:00');
