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
CREATE DATABASE IF NOT EXISTS `saltaChequeado` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `saltaChequeado`;

CREATE TABLE `saltaChequeado`.`users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(10) NOT NULL ,
 `password` varchar(100) NOT NULL ,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `users` (`id`, `username`, `password`) VALUES (8, 'admin', '3c71987c6285d972c05c9aa048002e91');

