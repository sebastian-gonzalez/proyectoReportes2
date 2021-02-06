-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2021 a las 21:49:03
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos_fichas`
--

CREATE TABLE `campos_fichas` (
  `id_campo` int(11) NOT NULL,
  `descripcion_campo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `valor_campo` varchar(2000) CHARACTER SET latin1 NOT NULL,
  `fecha_campo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_id_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'En revision'),
(2, 'En corrección '),
(3, 'Aprobado'),
(4, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `nombre_facultad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre_facultad`) VALUES
(1, 'FACULTAD DE INGENIERÍAS'),
(2, 'FACULTAD DE CIENCIAS EMPRESARIALES'),
(3, 'FACULTAD DE CIENCIAS SOCIALES & HUMANAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_ficha` int(11) NOT NULL,
  `titulo_ficha` varchar(50) NOT NULL,
  `descripcion_ficha` varchar(50) NOT NULL,
  `id_programa_ficha` int(11) NOT NULL,
  `id_estado_ficha` int(11) NOT NULL,
  `evaluacion_ficha` text DEFAULT NULL,
  `fecha_ficha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_ficha`, `titulo_ficha`, `descripcion_ficha`, `id_programa_ficha`, `id_estado_ficha`, `evaluacion_ficha`, `fecha_ficha`) VALUES
(14, 'pruebaficha', 'Proyecto de Grado', 1, 1, NULL, '2021-02-06 20:28:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_ficha`
--

CREATE TABLE `lista_ficha` (
  `id_lista` int(11) NOT NULL,
  `id_lista_usuario` int(11) NOT NULL,
  `id_lista_ficha` int(11) NOT NULL,
  `id_rol_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `nombre_pro` varchar(50) NOT NULL,
  `titulo_pro` varchar(50) NOT NULL,
  `id_facultad_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `nombre_pro`, `titulo_pro`, `id_facultad_pro`) VALUES
(1, 'INGENIERÍA DE SISTEMAS', 'INGENIERO (A) DE SISTEMAS', 1),
(2, 'ADMINISTRACIÓN', 'ADMINISTRADOR DE EMPRESAS', 2),
(3, 'TRABAJO SOCIAL', 'TRABAJADOR SOCIAL', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_lista`
--

CREATE TABLE `rol_lista` (
  `id_rol_lista` int(11) NOT NULL,
  `nombre_rol_ficha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_lista`
--

INSERT INTO `rol_lista` (`id_rol_lista`, `nombre_rol_ficha`) VALUES
(1, 'Estudiante'),
(2, 'Director'),
(3, 'Evaluador'),
(4, 'Jurado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usu`
--

CREATE TABLE `rol_usu` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_usu`
--

INSERT INTO `rol_usu` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Director'),
(3, 'Coordinador'),
(4, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula_usu` int(11) NOT NULL,
  `nombre_usu` varchar(30) NOT NULL,
  `apellido_usu` varchar(30) NOT NULL,
  `correo_usu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `contrasena_usu` varchar(255) NOT NULL,
  `id_rol_usu` int(11) NOT NULL,
  `id_programa_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula_usu`, `nombre_usu`, `apellido_usu`, `correo_usu`, `contrasena_usu`, `id_rol_usu`, `id_programa_usu`) VALUES
(104, 12345, 'cordinador', 'cordinador', 'cordinador@gmail.com', '$2y$10$ZEwLchOLo6HVEaQnFEFeu.Auy4TdfXiQXfXrfUSRqWfkUrgElb0ti', 3, 1),
(105, 1234561, 'Docente', 'Docente', 'docente@gmail.com', '$2y$10$hqfSs3rK8jFmVO2SnAdo5e1aTXqjjVwKyQrb8WHSJqfwWAKr6ghQe', 2, 1),
(106, 1234562, 'Docente1', 'Docente1', 'docente1@gmail.com', '$2y$10$MtD2AFpfDVB.uiUt0yzywu0gNJ4v9vBzS3QqDJ47E/ZWXNiRP4H2.', 2, 1),
(107, 1234563, 'Docente2', 'Docente2', 'docente2@gmail.com', '$2y$10$jd/jk.qiMt3S87YZUajtiOqQHV3sc3dtXygvKg6tzDKLw1TUU1xda', 1, 1),
(108, 1234564, 'Docente3', 'Docente3', 'docente3@gmail.com', '$2y$10$ZqOjSVXEvD9/PQwRx4ITEuegHIDTffD4AZ2IDMgu7OJYkPX45cLIu', 1, 1),
(111, 1234567, 'Estudiante', 'Estudiante', 'estudiante@gmail.com', '123456', 4, 1),
(112, 1234568, 'Estudiante1', 'Estudiante1', 'estudiante1@gmail.com', '$2y$10$Tb3cMlpxxo234Ua3zkfPm.PvpFJHo/rhMY2.CZlp3cS2sB01sNxBi', 4, 1),
(113, 12341234, 'jakita', 'jaka', 'jaka@gmail.com', '$2y$10$.2tDoWLU1mV4L2dNhquRsOHFQ6jTZ9D9D2RQD3Oq.vNUpfm4YMDMC', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campos_fichas`
--
ALTER TABLE `campos_fichas`
  ADD PRIMARY KEY (`id_campo`),
  ADD KEY `id_campo_fichas_fk` (`fk_id_ficha`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`id_facultad`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_ficha`),
  ADD KEY `fk_ficha_estado` (`id_estado_ficha`),
  ADD KEY `fk_ficha_programa` (`id_programa_ficha`);

--
-- Indices de la tabla `lista_ficha`
--
ALTER TABLE `lista_ficha`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `fk_lista_ficha_usuarios` (`id_lista_usuario`),
  ADD KEY `fk_lista_ficha_rol_lista` (`id_rol_ficha`),
  ADD KEY `fk_lista_ficha_ficha` (`id_lista_ficha`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`),
  ADD KEY `fk_programa_facultad` (`id_facultad_pro`);

--
-- Indices de la tabla `rol_lista`
--
ALTER TABLE `rol_lista`
  ADD PRIMARY KEY (`id_rol_lista`);

--
-- Indices de la tabla `rol_usu`
--
ALTER TABLE `rol_usu`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula_usu` (`cedula_usu`),
  ADD UNIQUE KEY `correo_usu` (`correo_usu`),
  ADD KEY `fk_usuarios_programa` (`id_programa_usu`),
  ADD KEY `unq_usuarios_id_rol_usu` (`id_rol_usu`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campos_fichas`
--
ALTER TABLE `campos_fichas`
  MODIFY `id_campo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `lista_ficha`
--
ALTER TABLE `lista_ficha`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol_lista`
--
ALTER TABLE `rol_lista`
  MODIFY `id_rol_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_usu`
--
ALTER TABLE `rol_usu`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campos_fichas`
--
ALTER TABLE `campos_fichas`
  ADD CONSTRAINT `id_campo_fichas_fk` FOREIGN KEY (`fk_id_ficha`) REFERENCES `ficha` (`id_ficha`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `fk_ficha_estado` FOREIGN KEY (`id_estado_ficha`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ficha_programa` FOREIGN KEY (`id_programa_ficha`) REFERENCES `programa` (`id_programa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lista_ficha`
--
ALTER TABLE `lista_ficha`
  ADD CONSTRAINT `fk_lista_ficha_ficha` FOREIGN KEY (`id_lista_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_ficha_rol_lista` FOREIGN KEY (`id_rol_ficha`) REFERENCES `rol_lista` (`id_rol_lista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_ficha_usuarios` FOREIGN KEY (`id_lista_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `fk_programa_facultad` FOREIGN KEY (`id_facultad_pro`) REFERENCES `facultad` (`id_facultad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_programa` FOREIGN KEY (`id_programa_usu`) REFERENCES `programa` (`id_programa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_rol_usu` FOREIGN KEY (`id_rol_usu`) REFERENCES `rol_usu` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
