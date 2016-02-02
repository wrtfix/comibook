-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2014 a las 10:31:07
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `comibook`
--
CREATE DATABASE IF NOT EXISTS `comibook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `comibook`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fechavto` date NOT NULL,
  `proviene` varchar(100) NOT NULL,
  `entregado` varchar(100) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `importe` float not null,
  `numero` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cheques`
--

INSERT INTO `cheques` (`id`, `idPedido`, `fecha`, `fechavto`, `proviene`, `entregado`, `banco`, `numero`) VALUES
(1, 1, '2014-11-05', '2014-12-05', 'Jose', 'Pedro', 'Frances', 2147483647),
(2, 2, '2014-05-11', '2014-06-08', 'Roberto', 'Jose', 'Frances', 333333333333333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL,
  `Domicilio` varchar(200) NOT NULL,
  `Localidad` varchar(100) NOT NULL,
  `Telefono` varchar(100) NOT NULL,
  `Cuit` int(100) NOT NULL,
  `Numero` INT NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `Numero` int(11) NOT NULL AUTO_INCREMENT,
  `FormaPago` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `ClienteOrignen` int(11) NOT NULL,
  `ClienteDestino` int(11) NOT NULL,
  `Bultos` int(11) NOT NULL,
  `CostoFlete` float NOT NULL,
  `ContraReembolso` float NOT NULL,
  `Observaciones` varchar(100) NOT NULL,
  `Pago` tinyint(1) NOT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Numero`, `FormaPago`, `Fecha`, `ClienteOrignen`, `ClienteDestino`, `Bultos`, `CostoFlete`, `ContraReembolso`, `Observaciones`, `Pago`) VALUES
(1, 'efectivo', '2014-05-10', 1, 2, 5, 45, 0, '', 0),
(2, 'efectivo', '2014-05-10', 1, 2, 5, 45, 0, '', 0),
(3, 'efectivo', '2014-05-10', 2, 3, 4, 50.5, 0, '', 0),
(4, 'efectivo', '2014-05-11', 2, 3, 4, 50.5, 0, '', 1),
(5, 'efectivo', '2014-05-11', 2, 3, 4, 50.5, 0, '', 0),
(6, 'efectivo', '2010-05-14', 2, 3, 4, 50.5, 0, '', 0),
(7, 'efectivo', '2014-05-10', 2, 3, 4, 50.5, 0, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `comibook`.`gastos` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` int(11) NOT NULL , 
  `importe` float NOT NULL , 
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
