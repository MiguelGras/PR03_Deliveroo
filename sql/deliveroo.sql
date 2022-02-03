-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2022 a las 15:20:03
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id` int(11) NOT NULL,
  `foto` int(100) NOT NULL,
  `restaurante_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_restaurante`
--

CREATE TABLE `tbl_restaurante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valoracion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_restaurante`
--

INSERT INTO `tbl_restaurante` (`id`, `nombre`, `valoracion`) VALUES
(1, 'McDonald\'s', 10),
(2, 'Roadhouse', 5),
(3, 'Burrito\'s Way', 7),
(4, 'Burger King', 4),
(5, 'Kawa Sushi', 9),
(6, 'Rocky Asador', 6),
(7, 'Taco Bell', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cocina`
--

CREATE TABLE `tbl_tipo_cocina` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tipo_cocina`
--

INSERT INTO `tbl_tipo_cocina` (`id`, `tipo`, `foto`) VALUES
(1, 'Americana', NULL),
(2, 'Italiana', NULL),
(3, 'Pizza', NULL),
(4, 'Sushi', NULL),
(5, 'Burger', NULL),
(6, 'Sandwich', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cocina_restaurante`
--

CREATE TABLE `tbl_tipo_cocina_restaurante` (
  `id` int(11) NOT NULL,
  `restaurante_fk` int(11) DEFAULT NULL,
  `tipo_cocina_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cocina`
--
ALTER TABLE `tbl_tipo_cocina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cocina_restaurante`
--
ALTER TABLE `tbl_tipo_cocina_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
