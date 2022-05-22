-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2022 a las 20:32:21
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `alquiler_apart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE IF NOT EXISTS `apartamento` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `cantidadCamas` int(11) NOT NULL,
  `precioDia` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`id`, `alias`, `direccion`, `cantidadCamas`, `precioDia`) VALUES
(13, 'NYork1', 'Calle 26#3-22 barrio claret', 3, 145555),
(14, 'Csa1', 'manzana 2', 2, 1456000),
(15, 'house1w', 'carrera quinta', 4, 12345500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendatario`
--

CREATE TABLE IF NOT EXISTS `arrendatario` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `numeroDocumento` varchar(30) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `numeroAcompanante` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0= inactive',
  `alias` int(30) NOT NULL,
  `ingresoFecha` date NOT NULL,
  `salidaFecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `arrendatario`
--

INSERT INTO `arrendatario` (`id`, `nombre`, `numeroDocumento`, `direccion`, `origen`, `numeroAcompanante`, `status`, `alias`, `ingresoFecha`, `salidaFecha`) VALUES
(7, 'Sharito', '1005754084', 'Calle 26#3-22 barrio claret', 'colombiano', '2', 1, 15, '2022-05-14', '2022-06-14'),
(9, 'Juan', '1005754084', 'Calle 26#3-22 barrio claret', 'colombiano', '2', 1, 13, '2022-08-21', '2022-08-30'),
(11, 'edward', '1005754084', 'Calle 26#3-22 barrio claret', 'colombiano', '2', 1, 14, '2022-08-14', '2022-09-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Admin,2=Staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
