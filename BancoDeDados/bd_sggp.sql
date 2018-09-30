-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2018 at 06:40 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_sggp`
--
CREATE DATABASE IF NOT EXISTS `bd_sggp` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `bd_sggp`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_grupospesquisa`
--

DROP TABLE IF EXISTS `tb_grupospesquisa`;
CREATE TABLE IF NOT EXISTS `tb_grupospesquisa` (
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `sigla` varchar(10) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `lider` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `situacao` int(1) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `descricao` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `logotipo` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `data_inicio` text,
  PRIMARY KEY (`sigla`),
  KEY `lider` (`lider`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_liderancas`
--

DROP TABLE IF EXISTS `tb_liderancas`;
CREATE TABLE IF NOT EXISTS `tb_liderancas` (
  `lider_antigo` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `lider_novo` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `data_inicio` timestamp NOT NULL,
  `grupo` varchar(10) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  KEY `grupo` (`grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lideres`
--

DROP TABLE IF EXISTS `tb_lideres`;
CREATE TABLE IF NOT EXISTS `tb_lideres` (
  `lider` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  KEY `lider` (`lider`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_permissoes`
--

DROP TABLE IF EXISTS `tb_permissoes`;
CREATE TABLE IF NOT EXISTS `tb_permissoes` (
  `id` tinyint(1) NOT NULL,
  `cdusuarios` tinyint(1) NOT NULL,
  `cdgrupo` tinyint(1) NOT NULL,
  `edgrupo` tinyint(1) NOT NULL,
  `permissoes` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `senha` char(64) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `data` timestamp NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `acesso` tinyint(1) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
