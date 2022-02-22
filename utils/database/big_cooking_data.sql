-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 20 fév. 2022 à 17:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `big_cooking_data`
--

-- --------------------------------------------------------

--
-- Structure de la table `assess`
--

DROP TABLE IF EXISTS `assess`;
CREATE TABLE IF NOT EXISTS `assess` (
    `id_recipe` int(11) NOT NULL,
    `id_client` int(11) NOT NULL,
    `rating` tinyint(4) DEFAULT NULL,
    `commentary` varchar(280) DEFAULT NULL,
    PRIMARY KEY (`id_recipe`,`id_client`),
    KEY `id_client` (`id_client`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
    `id_client` int(11) NOT NULL,
    `firstname` varchar(25) DEFAULT NULL,
    `lastname` varchar(25) DEFAULT NULL,
    `civility` char(2) DEFAULT NULL,
    `pseudo` varchar(25) DEFAULT NULL,
    `mail` varchar(40) DEFAULT NULL,
    `password` varchar(30) DEFAULT NULL,
    PRIMARY KEY (`id_client`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contain_recipe_ingredient`
--

DROP TABLE IF EXISTS `contain_recipe_ingredient`;
CREATE TABLE IF NOT EXISTS `contain_recipe_ingredient` (
    `id_recipe` int(11) NOT NULL,
    `id_ingredient` int(11) NOT NULL,
    `quantity` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id_recipe`,`id_ingredient`),
    KEY `id_ingredient` (`id_ingredient`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `have_preferences_ingredient`
--

DROP TABLE IF EXISTS `have_preferences_ingredient`;
CREATE TABLE IF NOT EXISTS `have_preferences_ingredient` (
    `id_client` int(11) NOT NULL,
    `id_ingredient` int(11) NOT NULL,
    PRIMARY KEY (`id_client`,`id_ingredient`),
    KEY `id_ingredient` (`id_ingredient`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
    `id_ingredient` int(11) NOT NULL,
    `name` varchar(40) DEFAULT NULL,
    `url_pic` text,
    PRIMARY KEY (`id_ingredient`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
    `id_recipe` int(11) NOT NULL,
    `name` varchar(50) DEFAULT NULL,
    `categories` text,
    `url_pic` text,
    `directions` text,
    `prep_time` smallint(6) DEFAULT NULL,
    `cook_time` smallint(6) DEFAULT NULL,
    `break_time` smallint(6) DEFAULT NULL,
    `yield` varchar(15) DEFAULT NULL,
    `difficulty` varchar(15) DEFAULT NULL,
    `budget` varchar(15) DEFAULT NULL,
    `serving` smallint(6) DEFAULT NULL,
    `coordonnees` char(70) DEFAULT NULL,
    PRIMARY KEY (`id_recipe`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
    `id_recipe` int(11) NOT NULL,
    `id_client` int(11) NOT NULL,
    PRIMARY KEY (`id_recipe`,`id_client`),
    KEY `id_client` (`id_client`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
