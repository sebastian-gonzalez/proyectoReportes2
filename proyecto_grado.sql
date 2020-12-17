-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2020 a las 00:04:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_grado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ficha`
--

CREATE TABLE `estado_ficha` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE `facultades` (
  `id_f` int(11) NOT NULL,
  `nombre_facu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id_f`, `nombre_facu`) VALUES
(1, 'FACULTAD DE INGENIERÍAS'),
(2, 'FACULTAD DE CIENCIAS EMPRESARIALES'),
(3, 'FACULTAD DE CIENCIAS SOCIALES & HUMANAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `id_fi` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL,
  `jurado` int(11) NOT NULL,
  `evaluador` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `compa_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id_fi`, `usuario_id`, `programa_id`, `jurado`, `evaluador`, `director_id`, `compa_id`, `estado_id`) VALUES
(1, 5, 1, 2, 2, 2, 4, 1),
(2, 5, 1, 2, 2, 2, 4, 1),
(3, 5, 2, 2, 2, 2, 4, 1),
(4, 5, 1, 2, 2, 2, 4, 1),
(5, 5, 1, 2, 2, 2, 4, 1),
(6, 5, 1, 2, 2, 2, 4, 2),
(7, 5, 2, 2, 2, 2, 4, 3),
(8, 5, 1, 2, 7, 2, 4, 3),
(9, 5, 2, 2, 7, 7, 4, 3),
(10, 5, 2, 2, 2, 2, 4, 4),
(11, 5, 1, 2, 2, 2, 5, 3),
(12, 5, 1, 7, 7, 2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_demo`
--

CREATE TABLE `ficha_demo` (
  `id_fi` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `planteamiento` text NOT NULL,
  `formulacion` text NOT NULL,
  `programa_id` int(11) NOT NULL,
  `sistematizacion` text NOT NULL,
  `objetivo_general` text NOT NULL,
  `objetivos_especificos` text NOT NULL,
  `impacto_proyecto` text NOT NULL,
  `marco_contextual` text NOT NULL,
  `marco_legal` text NOT NULL,
  `marco_otro` text NOT NULL,
  `jurado` text NOT NULL,
  `evaluador` text NOT NULL,
  `metodologia` text NOT NULL,
  `alcance` text NOT NULL,
  `documento` mediumblob NOT NULL,
  `observacion_general` text NOT NULL,
  `director_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `cronograma` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id_p` int(11) NOT NULL,
  `nombre_prog` text NOT NULL,
  `titulo` text NOT NULL,
  `facultad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id_p`, `nombre_prog`, `titulo`, `facultad_id`) VALUES
(1, 'INGENIERÍA DE SISTEMAS', 'INGENIERO (A) DE SISTEMAS	', 1),
(2, 'ADMINISTRACIÓN', 'ADMINISTRADOR DE EMPRESAS', 2),
(3, 'TRABAJO SOCIAL', 'TRABAJADOR SOCIAL1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Docente'),
(3, 'Coordinador'),
(4, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` text NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `contrasena`, `rol_id`) VALUES
(1, 'Jorge Mario', 'Vasquez Garcia', 'j-mario9715@hotmail.com', '1234', 1),
(2, 'Gloria', 'Garcia', 'glg@hotmail.com', '1234', 2),
(3, 'Daniel', 'Vasquez', 'daniel@hotmail.com', '1234', 3),
(4, 'Stiven', 'Gil', 'stiven@hotmail.com', '1234', 4),
(5, 'Yakita', 'k5', 'yakita@hotmail.com', '1234', 4),
(7, 'Gloriagggg', 'Garciaggg', 'glgggg@hotmail.com', '1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`id_f`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id_fi`),
  ADD KEY `programa_id` (`programa_id`),
  ADD KEY `jurado` (`jurado`),
  ADD KEY `evaluador` (`evaluador`),
  ADD KEY `director_id` (`director_id`),
  ADD KEY `usuario_id` (`compa_id`),
  ADD KEY `usuario_id_2` (`usuario_id`);

--
-- Indices de la tabla `ficha_demo`
--
ALTER TABLE `ficha_demo`
  ADD PRIMARY KEY (`id_fi`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `facultad_id` (`facultad_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id_fi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id_p`),
  ADD CONSTRAINT `fichas_ibfk_2` FOREIGN KEY (`jurado`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fichas_ibfk_3` FOREIGN KEY (`evaluador`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fichas_ibfk_4` FOREIGN KEY (`director_id`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fichas_ibfk_5` FOREIGN KEY (`compa_id`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fichas_ibfk_6` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_ibfk_1` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`id_f`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
