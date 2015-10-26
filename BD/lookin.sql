-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2015 a las 23:30:48
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lookin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE IF NOT EXISTS `mascota` (
  `id_mascota` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_mascota` varchar(255) NOT NULL,
  `raza` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `tamano` varchar(255) NOT NULL,
  `id_gps` bigint(20) NOT NULL,
  PRIMARY KEY (`id_mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla que contiene toda la informacion e las mascotas' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_dueno_mascota`
--

CREATE TABLE IF NOT EXISTS `relacion_dueno_mascota` (
  `id_dueno_mascota` bigint(20) NOT NULL,
  `num_identifiacion_dueno` bigint(20) NOT NULL,
  `id_mascota` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dueno_mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking_mascota`
--

CREATE TABLE IF NOT EXISTS `tracking_mascota` (
  `id_tracking_mascota` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_mascota` bigint(20) NOT NULL,
  `id_gps` bigint(20) NOT NULL,
  `longitud_localizacion` varchar(255) NOT NULL,
  `latitud_localizacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tracking_mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla que contiene la localizacion de  la mascota.Actualizada cada 5 minutos ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_dueno`
--

CREATE TABLE IF NOT EXISTS `user_dueno` (
  `num_identificacion` bigint(20) NOT NULL COMMENT 'numero de identifiacion ',
  `nombre` varchar(255) NOT NULL COMMENT 'nombre del dueño o usuario del sistema',
  `apellido` varchar(255) NOT NULL COMMENT 'Apellido del dueño o usuario',
  `correo` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `tipo_identifiacion` int(11) NOT NULL,
  PRIMARY KEY (`num_identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de usuario del sistema lookin.Dueño de mascota';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
