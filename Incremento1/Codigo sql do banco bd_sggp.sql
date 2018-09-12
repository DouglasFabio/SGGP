-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Set-2018 às 23:20
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
CREATE DATABASE IF NOT EXISTS `bd_sggp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_sggp`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `Login` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` char(64) NOT NULL,
  `Data` timestamp NOT NULL,
  PRIMARY KEY (`Login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`Login`, `Email`, `Senha`, `Data`) VALUES
('Admin', 'douglasfabio.ifsp@gmail.com', '123', '0000-00-00 00:00:00'),
('testedata', 'douglasfabio.ifsp@gmail.com', '123', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lideres`
--

DROP TABLE IF EXISTS `lideres`;
CREATE TABLE IF NOT EXISTS `lideres` (
  `Prontuario` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` char(64) NOT NULL,
  `Data` timestamp NOT NULL,
  `verificaacesso_lider` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Prontuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lideres`
--

INSERT INTO `lideres` (`Prontuario`, `Nome`, `Email`, `Senha`, `Data`, `verificaacesso_lider`) VALUES
(1690094, 'Douglas Fabio', 'douglasfabio.ifsp@gmail.com', '0', '0000-00-00 00:00:00', 0),
(1350081, 'Douglas Integrado', 'douglasfabio.integrado@gmail.com', '0', '0000-00-00 00:00:00', 0),
(1690065, 'Douglas +1', 'douglas.mais1@gmail.com', '0', '2018-09-03 23:23:00', 0);

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
