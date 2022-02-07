-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2022 a las 19:37:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deliveroo`
--
CREATE DATABASE IF NOT EXISTS `deliveroo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `deliveroo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `restaurante_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_foto`
--

INSERT INTO `tbl_foto` (`id`, `foto`, `restaurante_fk`) VALUES
(1, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 1),
(2, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 4),
(3, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 2),
(4, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 3),
(5, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 5),
(6, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 6),
(7, 'uploads/rajIUVScBbnVix4XOjbW8jZXRys1oShYW8ltbFig.png', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_restaurante`
--

CREATE TABLE `tbl_restaurante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valoracion` int(2) NOT NULL,
  `tiempo_medio` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_restaurante`
--

INSERT INTO `tbl_restaurante` (`id`, `nombre`, `valoracion`, `tiempo_medio`) VALUES
(1, 'McDonald\'s', 10, '25'),
(2, 'Roadhouse', 5, '40'),
(3, 'Burrito\'s Way', 7, '15'),
(4, 'Burger King', 4, '30'),
(5, 'Kawa Sushi', 9, '25'),
(6, 'Rocky Asador', 6, '30'),
(7, 'Taco Bell', 9, '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicio`
--

CREATE TABLE `tbl_servicio` (
  `id` int(11) NOT NULL,
  `tipo` enum('Recogida','Envio') COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_servicio`
--

INSERT INTO `tbl_servicio` (`id`, `tipo`) VALUES
(1, 'Recogida'),
(2, 'Envio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cocina`
--

CREATE TABLE `tbl_tipo_cocina` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tipo_cocina`
--

INSERT INTO `tbl_tipo_cocina` (`id`, `tipo`) VALUES
(1, 'Americana'),
(2, 'Italiana'),
(3, 'Pizza'),
(4, 'Sushi'),
(5, 'Burger'),
(6, 'Sandwich');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cocina_restaurante`
--

CREATE TABLE `tbl_tipo_cocina_restaurante` (
  `id` int(11) NOT NULL,
  `restaurante_fk` int(11) DEFAULT NULL,
  `tipo_cocina_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tipo_cocina_restaurante`
--

INSERT INTO `tbl_tipo_cocina_restaurante` (`id`, `restaurante_fk`, `tipo_cocina_fk`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 2, 1),
(4, 2, 5),
(5, 3, 2),
(6, 3, 3),
(7, 4, 5),
(8, 5, 4),
(9, 6, 1),
(10, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_servicio_restaurante`
--

CREATE TABLE `tbl_tipo_servicio_restaurante` (
  `id` int(11) NOT NULL,
  `restaurante_fk` int(11) DEFAULT NULL,
  `tipo_servicio_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_servicio_restaurante`
--

INSERT INTO `tbl_tipo_servicio_restaurante` (`id`, `restaurante_fk`, `tipo_servicio_fk`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 1),
(5, 3, 1),
(6, 3, 2),
(7, 4, 2),
(8, 5, 2),
(9, 6, 1),
(10, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `tipo` enum('Usuario','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id`, `nombre`, `correo`, `pass`, `tipo`) VALUES
(1, 'Ivan', 'ivan@gmail.com', 'bd4f881f9422e07ed3ee9da1284e4ef3', 'Admin'),
(2, 'Raul', 'raul@gmail.com', 'bd4f881f9422e07ed3ee9da1284e4ef3', 'Admin'),
(3, 'Miguel', 'miguel@gmail.com', 'bd4f881f9422e07ed3ee9da1284e4ef3', 'Admin'),
(4, 'Danny', 'danny@gmail.com', 'bd4f881f9422e07ed3ee9da1284e4ef3', 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurante_fk` (`restaurante_fk`);

--
-- Indices de la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_servicio`
--
ALTER TABLE `tbl_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_cocina`
--
ALTER TABLE `tbl_tipo_cocina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_cocina_restaurante`
--
ALTER TABLE `tbl_tipo_cocina_restaurante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurante_tipo_cocina_fk` (`restaurante_fk`),
  ADD KEY `tipo_cocina_fk` (`tipo_cocina_fk`);

--
-- Indices de la tabla `tbl_tipo_servicio_restaurante`
--
ALTER TABLE `tbl_tipo_servicio_restaurante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurante_tipo_servicio_fk` (`restaurante_fk`),
  ADD KEY `tipo_servicio_fk` (`tipo_servicio_fk`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_servicio`
--
ALTER TABLE `tbl_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cocina`
--
ALTER TABLE `tbl_tipo_cocina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cocina_restaurante`
--
ALTER TABLE `tbl_tipo_cocina_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_servicio_restaurante`
--
ALTER TABLE `tbl_tipo_servicio_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD CONSTRAINT `restaurante_fk` FOREIGN KEY (`restaurante_fk`) REFERENCES `tbl_restaurante` (`id`);

--
-- Filtros para la tabla `tbl_tipo_cocina_restaurante`
--
ALTER TABLE `tbl_tipo_cocina_restaurante`
  ADD CONSTRAINT `restaurante_tipo_cocina_fk` FOREIGN KEY (`restaurante_fk`) REFERENCES `tbl_restaurante` (`id`),
  ADD CONSTRAINT `tipo_cocina_fk` FOREIGN KEY (`tipo_cocina_fk`) REFERENCES `tbl_tipo_cocina` (`id`);

--
-- Filtros para la tabla `tbl_tipo_servicio_restaurante`
--
ALTER TABLE `tbl_tipo_servicio_restaurante`
  ADD CONSTRAINT `restaurante_tipo_servicio_fk` FOREIGN KEY (`restaurante_fk`) REFERENCES `tbl_restaurante` (`id`),
  ADD CONSTRAINT `tipo_servicio_fk` FOREIGN KEY (`tipo_servicio_fk`) REFERENCES `tbl_servicio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
