-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 29-Ago-2018 às 22:23
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `lideres`
--

DROP TABLE IF EXISTS `lideres`;
CREATE TABLE IF NOT EXISTS `lideres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prontuario` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Email` int(50) NOT NULL,
  `Senha` char(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `verificaacesso`
--

DROP TABLE IF EXISTS `verificaacesso`;
CREATE TABLE IF NOT EXISTS `verificaacesso` (
  `acesso` tinyint(1) NOT NULL,
  PRIMARY KEY (`acesso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `verificaacesso`
--

INSERT INTO `verificaacesso` (`acesso`) VALUES
(0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
