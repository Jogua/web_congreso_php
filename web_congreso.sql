-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2015 a las 10:09:15
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
CREATE DATABASE IF NOT EXISTS `web_congreso` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `web_congreso`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
`id_actividad` int(10) unsigned NOT NULL,
  `nombre_actividad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `url_foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `importe` decimal(4,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `nombre_actividad`, `fecha_hora`, `descripcion`, `url_foto`, `importe`) VALUES
(1, 'Visita a la Alhambra', '2015-07-02 09:00:00', 'La actividad consistirá en visita a los alrededores del monumento y entrada en horario de mañana, donde se podrán ver la Alhambra y el Generalife.\r\n\r\nLa Alhambra es una ciudad palatina andalusí situada en Granada, España. Formada por un conjunto de palacios,jardines y fortaleza que albergaba una verdadera ciudadela dentro de la propia ciudadde Granada, que servía como alojamiento al monarca y a la corte del Reino nazarí de Granada.\r\n\r\nSu verdadero atractivo,como en otras obras musulmanas de la época, no sólo radica en los interiores, cuya decoración está entre las cumbresdel arte andalusí, sino también en su localización y adaptación, generando un paisaje nuevo pero totalmente integradocon la naturaleza preexistente.\r\n\r\nEn 2011 se convirtió en el monumento más visitado de España, recibiendo la cifra histórica de 2 310 764 visitantes.', 'images/visita_alhambra.jpg', '25.00'),
(2, 'Visita a Sierra Nevada', '2015-07-03 09:00:00', 'La actividad consistirá en visita a la estación de esquí en la explanada de Pradollano, subida a Borreguiles y desayuno incluido.\r\n\r\nLa Estación de Esquí y Montaña de Sierra Nevada está situada en el Parque Natural de Sierra Nevada, en el Sistema Penibético, en los términos municipales de Monachil y de Dílar (partido judicial y provincia de Granada, España). Fue conocida durante sus primeros años como Estación de Esquí Solynieve, nombre ya en desuso.\r\n\r\nLa estación fue sede del Campeonato Mundial de Esquí Alpino de 1996, así como de varias pruebas de la Copa del Mundo de Esquí Alpino, de cuya competición acogió su primera final en el año 1977. Además, ha sido candidata como sede principal a los Juegos Olímpicos de Invierno.', 'images/visita_sierra_nevada.jpg', '15.00'),
(3, 'Prueba', '2015-05-20 00:00:00', 'esta es una actividad de prueba.\r\n\r\nesto es un parrafo nuevo', 'asdf', '20.00'),
(4, 'Cena de Gala', '2015-06-03 21:30:00', 'Cena de clausura del congreso.', 'images/cena_de_gala.jpg', '30.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE IF NOT EXISTS `cuota` (
`id_cuota` int(10) unsigned NOT NULL,
  `nombre_cuota` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `importe` decimal(4,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuota`
--

INSERT INTO `cuota` (`id_cuota`, `nombre_cuota`, `descripcion`, `importe`) VALUES
(1, 'Invitado', 'Esta es la cuota para cualquier usuario que no pertenezca a la universidad.', '50.00'),
(2, 'Profesor', 'Esta es una cuota dedicada para los profesores e investigadores.', '45.00'),
(3, 'Estudiantes', 'Cuota pensada para los usuarios que estén matriculados en una universidad.', '25.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota_tiene_actividad`
--

CREATE TABLE IF NOT EXISTS `cuota_tiene_actividad` (
  `id_cuota` int(10) unsigned NOT NULL,
  `id_actividad` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuota_tiene_actividad`
--

INSERT INTO `cuota_tiene_actividad` (`id_cuota`, `id_actividad`) VALUES
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(10) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `centro_trabajo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cuota_inscripcion` int(10) unsigned DEFAULT NULL,
  `tipo_usuario` enum('Administrador','Congresista') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Congresista'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `centro_trabajo`, `telefono`, `mail`, `password`, `cuota_inscripcion`, `tipo_usuario`) VALUES
(1, 'Jose', 'Guadix Rosado', NULL, '645337375', 'josegua93@gmail.com', '12341234', 1, 'Administrador'),
(2, 'Pepito', 'Flores', NULL, '645337375', 'j@g.es', '12341234', 2, 'Congresista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_actividad`
--

CREATE TABLE IF NOT EXISTS `usuario_tiene_actividad` (
  `id_usuario` int(10) unsigned NOT NULL,
  `id_actividad` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
 ADD PRIMARY KEY (`id_cuota`);

--
-- Indices de la tabla `cuota_tiene_actividad`
--
ALTER TABLE `cuota_tiene_actividad`
 ADD PRIMARY KEY (`id_cuota`,`id_actividad`), ADD KEY `fk_cuota_tiene_actividad_id_actividad` (`id_actividad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `usuario_tiene_actividad`
--
ALTER TABLE `usuario_tiene_actividad`
 ADD PRIMARY KEY (`id_usuario`,`id_actividad`), ADD KEY `fk_usuario_actividad_id_actividad` (`id_actividad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
MODIFY `id_actividad` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
MODIFY `id_cuota` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuota_tiene_actividad`
--
ALTER TABLE `cuota_tiene_actividad`
ADD CONSTRAINT `fk_cuota_tiene_actividad_id_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_cuota_tiene_actividad_id_cuota` FOREIGN KEY (`id_cuota`) REFERENCES `cuota` (`id_cuota`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuota_tiene_actividad`
--
ALTER TABLE `cuota_tiene_actividad`
ADD CONSTRAINT `fk_cuota_tiene_actividad_id_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_cuota_tiene_actividad_id_cuota` FOREIGN KEY (`id_cuota`) REFERENCES `cuota` (`id_cuota`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_tiene_actividad`
--
ALTER TABLE `usuario_tiene_actividad`
ADD CONSTRAINT `fk_usuario_actividad_id_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_usuario_actividad_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_tiene_actividad`
--
ALTER TABLE `usuario_tiene_actividad`
ADD CONSTRAINT `fk_usuario_actividad_id_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_usuario_actividad_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
