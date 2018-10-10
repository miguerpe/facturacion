-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 09:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facturacion`
--
CREATE DATABASE IF NOT EXISTS `facturacion` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `facturacion`;

-- --------------------------------------------------------

--
-- Table structure for table `detallefactura`
--

CREATE TABLE `detallefactura` (
  `idFactura` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `detalle` varchar(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valorUnitario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detallefactura`
--

INSERT INTO `detallefactura` (`idFactura`, `idItem`, `detalle`, `cantidad`, `valorUnitario`) VALUES
(9, 2, 'naranja', 12, 6000),
(18, 2, 'fgdfg', 6, 6700),
(21, 2, 'Jabon', 2, 2500),
(21, 3, 'cepillo', 2, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idFactura`, `fecha`, `idCliente`) VALUES
(2, '2018-10-09', 6),
(3, '2018-10-09', 6),
(4, '2018-10-09', 6),
(7, '2018-10-09', 6),
(8, '2018-10-09', 9),
(9, '2018-10-09', 9),
(15, '2018-10-09', 9),
(18, '2018-10-09', 9),
(20, '2018-10-09', 9),
(21, '2018-10-09', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`idFactura`,`idItem`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
