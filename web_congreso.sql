-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-05-2015 a las 15:35:15
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `web_congreso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `denominacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `importe` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`denominacion`, `fecha_hora`, `descripcion`, `foto`, `importe`) VALUES
('Visita a la Alhambra', '2015-07-02 09:00:00', 'La actividad consistirá en visita a los alrededores del monumento y entrada en horario de mañana, donde se podrán ver la Alhambra y el Generalife.\r\n\r\nLa Alhambra es una ciudad palatina andalusí situada en Granada, España. Formada por un conjunto de palacios, jardines y fortaleza (alcázar) que albergaba una verdadera ciudadela dentro de la propia ciudad de Granada, que servía como alojamiento al monarca y a la corte del Reino nazarí de Granada. Su verdadero atractivo, como en otras obras musulmanas de la época, no sólo radica en los interiores, cuya decoración está entre las cumbres del arte andalusí, sino también en su localización y adaptación, generando un paisaje nuevo pero totalmente integrado con la naturaleza preexistente.\r\n\r\nEn 2011 se convirtió en el monumento más visitado de España, recibiendo la cifra histórica de 2 310 764 visitantes.', 'poner_url_foto', '25.00'),
('Visita a Sierra Nevada', '2015-07-01 09:00:00', 'La actividad consistirá en visita a la estación de esquí en la explanada de Pradollano, subida a Borreguiles y desayuno incluido.\r\n\r\nLa Estación de Esquí y Montaña de Sierra Nevada está situada en el Parque Natural de Sierra Nevada, en el Sistema Penibético, en los términos municipales de Monachil y de Dílar (partido judicial y provincia de Granada, España). Fue conocida durante sus primeros años como Estación de Esquí Solynieve, nombre ya en desuso.\r\n\r\nLa estación fue sede del Campeonato Mundial de Esquí Alpino de 1996, así como de varias pruebas de la Copa del Mundo de Esquí Alpino, de cuya competición acogió su primera final en el año 1977. Además, ha sido candidata como sede principal a los Juegos Olímpicos de Invierno.', 'poner_url_foto', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE IF NOT EXISTS `cuota` (
  `denominacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `importe` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `centro_trabajo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cuota_inscripcion` decimal(4,0) NOT NULL,
  `tipo_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `centro_trabajo`, `telefono`, `mail`, `password`, `cuota_inscripcion`, `tipo_usuario`) VALUES
('Antonio', 'Espinosa Jiménez', '', '999999999', 'jonnny0@hotmail.com', '12345678', '30', 'administrador'),
('José', 'Guadix Rosado', 'Universidad de Granada', '111111111', 'jose@gmail.com', '12345678', '15', 'invitado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`denominacion`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
 ADD PRIMARY KEY (`denominacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`nombre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
