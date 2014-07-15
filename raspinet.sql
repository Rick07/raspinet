-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-07-2014 a las 17:24:54
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `raspinet`
--
DROP DATABASE IF EXISTS `raspinet`;
CREATE DATABASE `raspinet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `raspinet`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raspberry`
--

DROP TABLE IF EXISTS `raspberry`;
CREATE TABLE IF NOT EXISTS `raspberry` (
  `mac` varchar(17) NOT NULL,
  `estado` varchar(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  PRIMARY KEY (`mac`),
  KEY `raspi_state` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `raspberry`:
--   `estado`
--       `state` -> `sCode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raspivideo`
--

DROP TABLE IF EXISTS `raspivideo`;
CREATE TABLE IF NOT EXISTS `raspivideo` (
  `idraspivideo` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(9) DEFAULT NULL,
  `tiempo` varchar(8) DEFAULT NULL,
  `raspimac` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`idraspivideo`),
  KEY `FK_6jcpmdp52a7rpo1jk4eo6m5pd` (`raspimac`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `raspivideo`:
--   `raspimac`
--       `raspberry` -> `mac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `sName` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'State name with first letter capital',
  `sCode` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Optional state abbreviation (US is 2 capital letters)',
  PRIMARY KEY (`sCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='States by Country V0.1';

--
-- Volcado de datos para la tabla `state`
--

INSERT INTO `state` (`sName`, `sCode`) VALUES
('Aguascalientes', 'AG'),
('Baja California', 'BN'),
('Baja California Sur', 'BS'),
('Coahuila', 'CA'),
('Chihuahua', 'CH'),
('Colima', 'CL'),
('Campeche', 'CM'),
('Chiapas', 'CP'),
('Distrito Federal', 'DF'),
('Durango', 'DU'),
('Guanajuato', 'GJ'),
('Guerrero', 'GR'),
('Hidalgo', 'HI'),
('Jalisco', 'JA'),
('Michoacan', 'MC'),
('Morelos', 'MR'),
('Mexico', 'MX'),
('Nayarit', 'NA'),
('Nuevo Leon', 'NL'),
('Oaxaca', 'OA'),
('Puebla', 'PU'),
('Queretaro', 'QE'),
('Quintana Roo', 'QR'),
('Sinaloa', 'SI'),
('San Luis Potosi', 'SL'),
('Sonora', 'SO'),
('Tabasco', 'TB'),
('Tlaxcala', 'TL'),
('Tamaulipas', 'TM'),
('Veracruz', 'VE'),
('Yucatan', 'YU'),
('Zacatecas', 'ZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `nick` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `nick`, `password`) VALUES
(1, 'Ricardo Sánchez', 'rik', '8c0c495a436a206fe36c7ec2fe094658');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `raspberry`
--
ALTER TABLE `raspberry`
  ADD CONSTRAINT `raspi_state` FOREIGN KEY (`estado`) REFERENCES `state` (`sCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `raspivideo`
--
ALTER TABLE `raspivideo`
  ADD CONSTRAINT `FK_6jcpmdp52a7rpo1jk4eo6m5pd` FOREIGN KEY (`raspimac`) REFERENCES `raspberry` (`mac`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
