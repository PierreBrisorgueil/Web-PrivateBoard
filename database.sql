-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 29 Août 2014 à 14:26
-- Version du serveur: 5.5.38
-- Version de PHP: 5.4.4-14+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `private_board2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `text_to_match` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `text_to_match`) VALUES
(1, 'The Walking Dead', 'the.walking.dead'),
(2, 'Homeland', 'homeland'),
(3, 'The Originals', 'The.Originals'),
(4, 'Game Of Thrones', 'of.thrones.S');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fichier` tinytext NOT NULL,
  `propername` tinytext NOT NULL,
  `path` tinytext NOT NULL,
  `temps` int(11) NOT NULL,
  `taille` tinytext NOT NULL,
  `code_cat` int(11) NOT NULL,
  `cat` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4692 ;

--
-- Structure de la table `log_connexion`
--

CREATE TABLE IF NOT EXISTS `log_connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `Ip` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3529 ;

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;


--
-- Structure de la table `requetes`
--

CREATE TABLE IF NOT EXISTS `requetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(256) NOT NULL,
  `quality` varchar(256) NOT NULL,
  `language` varchar(256) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `requete` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;


--
-- Structure de la table `restrictions`
--

CREATE TABLE IF NOT EXISTS `restrictions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text_to_match` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


--
-- Structure de la table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id`, `name`, `url`) VALUES
(1, 'YourCreation', 'http://yourcreation.fr'),
(2, 'Yourcreation Mix', 'http://yourcreation.fr/?cat=300');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `userpass` varchar(256) NOT NULL,
  `userlevel` int(11) NOT NULL DEFAULT '1',
  `useravatar` varchar(256) NOT NULL DEFAULT 'notdefine',
  `lastconexion` int(11) NOT NULL,
  `LastLoadIndex` int(11) NOT NULL DEFAULT '0',
  `LastLoadFile` int(11) NOT NULL,
  `userstyle` varchar(255) NOT NULL DEFAULT 'style.css',
  `userstream` tinyint(4) NOT NULL DEFAULT '0',
  `userlastip` varchar(128) NOT NULL DEFAULT 'none',
  `userfilename` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `userpass`, `userlevel`, `useravatar`, `lastconexion`, `LastLoadIndex`, `LastLoadFile`, `userstyle`, `userstream`, `userlastip`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'notdefine', 0, 0, 0, 'style5.css', 0, 'none');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
