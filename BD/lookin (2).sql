-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2015 a las 18:52:04
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
  `num_identificacion_dueno` bigint(20) NOT NULL,
  PRIMARY KEY (`id_mascota`),
  UNIQUE KEY `id_gps` (`id_gps`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene toda la informacion e las mascotas' AUTO_INCREMENT=45 ;

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

--
-- Volcado de datos para la tabla `relacion_dueno_mascota`
--

INSERT INTO `relacion_dueno_mascota` (`id_dueno_mascota`, `num_identifiacion_dueno`, `id_mascota`) VALUES
(1, 20911962, 1),
(2, 20911962, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE IF NOT EXISTS `tipo_identificacion` (
  `id_tipoidentificacion` int(11) NOT NULL AUTO_INCREMENT,
  `num_tipoidentificacion` int(11) NOT NULL,
  `nombe_identificacion` text NOT NULL,
  PRIMARY KEY (`id_tipoidentificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene la localizacion de  la mascota.Actualizada cada 5 minutos ' AUTO_INCREMENT=83 ;

--
-- Volcado de datos para la tabla `tracking_mascota`
--

INSERT INTO `tracking_mascota` (`id_tracking_mascota`, `id_mascota`, `id_gps`, `longitud_localizacion`, `latitud_localizacion`) VALUES
(1, 42, 1234, '123', '-123'),
(2, 42, 1234, '1234', '-1234'),
(3, 42, 123, '12345', '-12345'),
(4, 42, 123, '-12345', '12345'),
(5, 42, 123, '60.234', '-60,234'),
(6, 42, 123, '10.507222562835883', '-66.90821863320309'),
(7, 42, 123456, '10.5004352', 'FEFE'),
(8, 42, 123456, '10.5004352', 'FEFE'),
(9, 42, 123456, '10.5004352', 'FEFE'),
(10, 42, 123456, '-66.9511459', '10.5004352'),
(11, 42, 123456, '-66.9511459', '10.5004352'),
(12, 42, 123456, '-66.9511459', '10.5004352'),
(13, 42, 123456, '-66.9511459', '10.5004352'),
(14, 42, 123456, '-66.9511459', '10.5004352'),
(15, 42, 123456, '-66.9511459', '10.5004352'),
(16, 42, 123456, '10.5004352', '-66.9511459'),
(18, 42, 123456, '-66.9511459', '10.5004352'),
(19, 42, 123456, '-66.9511459', '10.5004352'),
(20, 42, 123456, '-66.88883853614645', '10.499842902676288'),
(21, 42, 123456, '-66.88880609236948', '10.499820187254814'),
(22, 42, 123456, '10.499842279441622', '-66.88873715418646'),
(23, 42, 123456, '-66.88882860610151', '10.499835566806778'),
(24, 42, 123456, '-66.9511459', '10.5004352'),
(25, 42, 123456, '-66.9511459', '10.5004352'),
(26, 0, 0, '-66.9511459', '10.5004352'),
(27, 42, 123456, '-66.88872751354654', '10.499867151593862'),
(28, 42, 123456, '-66.88876991448562', '10.499838027400287'),
(29, 42, 123456, '-66.88879764552528', '10.499777397244392'),
(30, 42, 123456, '-66.88882343454334', '10.499795631149526'),
(31, 0, 0, '-66.9511459', '10.5004352'),
(32, 42, 123456, '-66.88877867409918', '10.49986661613552'),
(33, 0, 0, '-66.9511459', '10.5004352'),
(34, 42, 123456, '-66.8886889323062', '10.4998631727605'),
(35, 0, 0, '-66.9511459', '10.5004352'),
(36, 42, 123456, '-66.88875345419052', '10.499833403285622'),
(37, 42, 123456, '-66.88867479648463', '10.49986206920602'),
(38, 0, 0, '-66.9511459', '10.5004352'),
(39, 0, 0, '-66.9511459', '10.5004352'),
(40, 0, 0, '-66.9511459', '10.5004352'),
(41, 42, 123456, '-66.88875441174912', '10.49980950833466'),
(42, 0, 0, '-66.9511459', '10.5004352'),
(43, 42, 123456, '-66.88869466532622', '10.499854971268087'),
(44, 0, 0, '-66.9511459', '10.5004352'),
(45, 0, 0, '-66.9511459', '10.5004352'),
(46, 0, 0, '-66.9511459', '10.5004352'),
(47, 0, 0, '-66.9511459', '10.5004352'),
(48, 42, 123456, '-66.888673647385', '10.499843978554418'),
(49, 0, 0, '-66.9511459', '10.5004352'),
(50, 0, 0, '-66.9511459', '10.5004352'),
(51, 42, 123456, '-66.88883332060054', '10.499807471524434'),
(52, 42, 123456, '-66.88876650981582', '10.499845913330171'),
(53, 0, 0, '-66.9511459', '10.5004352'),
(54, 0, 0, '-66.9511459', '10.5004352'),
(55, 42, 123456, '-66.88885388450654', '10.499815270696601'),
(56, 0, 0, '-66.9511459', '10.5004352'),
(57, 42, 123456, '-66.88873588728056', '10.499829356076498'),
(58, 42, 123456, '-66.88873588728056', '10.499829356076498'),
(59, 0, 0, '-66.9511459', '10.5004352'),
(60, 0, 0, '-66.9511459', '10.5004352'),
(61, 0, 0, '-66.9511459', '10.5004352'),
(62, 42, 123456, '-66.88881025498676', '10.499803272389678'),
(63, 42, 123456, '-66.88874122129694', '10.499819921628031'),
(64, 42, 123456, '-66.88883488003968', '10.499854219574418'),
(65, 42, 123456, '-66.88879925080451', '10.499819763144085'),
(66, 42, 0, '-66.88879925080451', '10.499819763144085'),
(67, 0, 0, '-66.88879925080451', '10.499819763144085'),
(68, 0, 0, '-66.88872578237819', '10.499844028021776'),
(69, 0, 0, '-66.9511459', '10.5004352'),
(70, 0, 0, '-66.9511459', '10.5004352'),
(71, 0, 0, '-66.9511459', '10.5004352'),
(72, 0, 0, '-66.9511459', '10.5004352'),
(73, 0, 0, '-66.9511459', '10.5004352'),
(74, 0, 0, '-66.9511459', '10.5004352'),
(75, 0, 0, '-66.9511459', '10.5004352'),
(76, 0, 0, '-66.9511459', '10.5004352'),
(77, 0, 0, '-66.9511459', '10.5004352'),
(78, 0, 0, '-66.9511459', '10.5004352'),
(79, 0, 0, '-66.9511459', '10.5004352'),
(80, 0, 0, '-66.9511459', '10.5004352'),
(81, 0, 0, '-66.9511459', '10.5004352'),
(82, 0, 0, '-66.9511459', '10.5004352');

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
  `tipo_identificacion` int(11) NOT NULL,
  `pass` text NOT NULL,
  PRIMARY KEY (`num_identificacion`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de usuario del sistema lookin.Dueño de mascota';

--
-- Volcado de datos para la tabla `user_dueno`
--

INSERT INTO `user_dueno` (`num_identificacion`, `nombre`, `apellido`, `correo`, `telefono`, `tipo_identificacion`, `pass`) VALUES
(8978, 'kok', 'koko', 'jaj', 787887, 1, '123'),
(17371602, 'karem', 'Villadiego', 'prueba1@prueba.com', 4242039742, 1, '123'),
(17371603, 'karem', 'Villadiego', 'prueba2@prueba.com', 4242039742, 2, '123'),
(20911962, 'edgar', 'guevara', 'asas@asas.com', 2125782615, 1, '123'),
(123456789, 'PEDRO', 'guitierrez', 'prueba@prueba.com', 210212121, 1, '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
