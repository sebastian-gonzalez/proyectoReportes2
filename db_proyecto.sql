-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2021 a las 23:45:55
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
  `activo` varchar(1) DEFAULT NULL,
  `fecha_campo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_id_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `campos_fichas`
--

INSERT INTO `campos_fichas` (`id_campo`, `descripcion_campo`, `valor_campo`, `activo`, `fecha_campo`, `fk_id_ficha`) VALUES
(1, 'Formulación del Problema', 'Cómo se puede rediseñar y actualizar la versión 1 de la aplicación administrar proyectos de \r\ngrado de la facultad de la ingeniería de la UNIAJC?\r\n', NULL, '2021-03-23 03:20:14', 1),
(2, 'Sistematización del problema', 'Cómo se puede rediseñar y actualizar la versión 1 de la aplicación administrar proyectos de \r\ngrado de la facultad de la ingeniería de la UNIAJC?\r\n', NULL, '2021-03-23 03:20:14', 1),
(3, 'Sistematización del problema', 'Cómo se puede rediseñar y actualizar la versión 1 de la aplicación administrar proyectos de \r\ngrado de la facultad de la ingeniería de la UNIAJC?\r\n', NULL, '2021-03-23 03:20:14', 1),
(4, 'Sistematización del problema', '¿Cómo obtener la información de los proyectos oportunamente?', NULL, '2021-03-23 03:20:14', 1),
(5, 'Objetivo general', 'Desarrollar las adecuaciones necesarias al aplicativo de Administración de Proyectos de Grado \r\nversión 1 de la facultad de Ingeniería de la UNIAJC con el fin de mejorar su usabilidad y facilitar \r\nsu mantenimiento.\r\n\r\n', NULL, '2021-03-23 03:20:14', 1),
(6, 'Objetivo especifico', 'Analizar la funcionalidad y estructura de la primera versión del aplicativo \r\nAdministración de Proyectos de Grado versión 1.', NULL, '2021-03-23 03:20:14', 1),
(7, 'Objetivo especifico', 'Analizar la funcionalidad y estructura de la primera versión del aplicativo \r\nAdministración de Proyectos de Grado versión 1.', NULL, '2021-03-23 03:20:14', 1),
(8, 'Objetivo especifico', 'Analizar la funcionalidad y estructura de la primera versión del aplicativo \r\nAdministración de Proyectos de Grado versión 1.', NULL, '2021-03-23 03:20:14', 1),
(9, 'Formulación del Problema', 'formulazion 1', NULL, '2021-03-23 18:47:59', 2),
(10, 'Sistematización del problema', 'sistematizacion 1', NULL, '2021-03-23 18:47:59', 2),
(11, 'Sistematización del problema', 'sistematizacion 2', NULL, '2021-03-23 18:47:59', 2),
(12, 'Objetivo general', 'objetivo 1', NULL, '2021-03-23 18:47:59', 2),
(13, 'Objetivo especifico', 'expecifico 1', NULL, '2021-03-23 18:47:59', 2),
(14, 'Objetivo especifico', 'especifico 2', NULL, '2021-03-23 18:47:59', 2),
(15, 'Formulación del Problema', '\r\n¿Cuáles elementos estructurales de la versión anterior se pueden reutilizar para la construcción del proyecto?\r\n', NULL, '2021-03-23 22:37:51', 3),
(16, 'Sistematización del problema', '¿Cuáles criterios de calidad se pueden aplicar que permitan mantener el correcto funcionamiento del software a través del tiempo?', NULL, '2021-03-23 22:37:51', 3),
(17, 'Sistematización del problema', '¿Cómo obtener la información de los proyectos oportunamente?', NULL, '2021-03-23 22:37:51', 3),
(18, 'Objetivo general', '\r\nDesarrollar las adecuaciones necesarias al aplicativo de Administración de Proyectos de Grado versión 1 de la facultad de Ingeniería de la UNIAJC con el fin de mejorar su usabilidad y facilitar su mantenimiento.\r\n', NULL, '2021-03-23 22:37:51', 3),
(19, 'Objetivo especifico', 'Analizar la funcionalidad y estructura de la primera versión del aplicativo Administración de Proyectos de Grado versión 1.', NULL, '2021-03-23 22:37:51', 3),
(20, 'Objetivo especifico', 'Realizar la reestructuración al aplicativo Administración de Proyectos versión 1 que garanticen su rendimiento y correcto funcionamiento a través del tiempo.', NULL, '2021-03-23 22:37:51', 3);

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
(4, 'Finalizado'),
(5, 'Rechazado'),
(6, 'Revision final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_anteproyecto`
--

CREATE TABLE `evaluacion_anteproyecto` (
  `id_evaluacion_anteproyecto` int(11) NOT NULL,
  `planteamiento` char(1) NOT NULL,
  `formulacion` char(1) NOT NULL,
  `sistematizacion` char(1) NOT NULL,
  `comentario_problema_investigacion` varchar(200) NOT NULL,
  `objetivo_general_a` char(1) NOT NULL,
  `objetivo_general_b` char(1) NOT NULL,
  `objetivo_general_c` char(1) NOT NULL,
  `objetivo_especifico_a` char(1) NOT NULL,
  `objetivo_especifico_b` char(1) NOT NULL,
  `objetivo_especifico_c` char(1) NOT NULL,
  `comentario_objetivo` varchar(200) NOT NULL,
  `resultado_a` char(1) NOT NULL,
  `resultado_b` char(1) NOT NULL,
  `impacto_a` char(1) NOT NULL,
  `impacto_b` char(1) NOT NULL,
  `comentario_resultado` varchar(200) NOT NULL,
  `interes` char(1) NOT NULL,
  `importancia` char(1) NOT NULL,
  `utilidad` char(1) NOT NULL,
  `factibilidad_gen` char(1) NOT NULL,
  `pertinencia` char(1) NOT NULL,
  `comentario_justificacion` varchar(200) NOT NULL,
  `historico_a` char(1) NOT NULL,
  `historico_b` char(1) NOT NULL,
  `historico_c` char(1) NOT NULL,
  `contextual` char(1) NOT NULL,
  `teorico_a` char(1) NOT NULL,
  `teorico_b` char(1) NOT NULL,
  `teorico_c` char(1) NOT NULL,
  `conceptual` char(1) NOT NULL,
  `legal` char(1) NOT NULL,
  `comentario_marco` varchar(200) NOT NULL,
  `metodologia_a` char(1) NOT NULL,
  `metodologia_b` char(1) NOT NULL,
  `metodologia_c` char(1) NOT NULL,
  `metodologia_d` char(1) NOT NULL,
  `comentario_metodologia` varchar(200) NOT NULL,
  `cronograma_a` char(1) NOT NULL,
  `cronograma_b` char(1) NOT NULL,
  `cronograma_c` char(1) NOT NULL,
  `comentario_cronograma` varchar(200) NOT NULL,
  `recurso_a` char(1) NOT NULL,
  `recurso_b` char(1) NOT NULL,
  `recurso_c` char(1) NOT NULL,
  `recurso_d` char(1) NOT NULL,
  `comentario_recurso` varchar(200) NOT NULL,
  `referencias_a` char(1) NOT NULL,
  `referencias_b` char(1) NOT NULL,
  `referencias_c` char(1) NOT NULL,
  `comentario_referencias` varchar(200) NOT NULL,
  `titulo` char(1) NOT NULL,
  `nivel_investigativo` char(1) NOT NULL,
  `factibilidad` char(1) NOT NULL,
  `documento_a` char(1) NOT NULL,
  `documento_b` char(1) NOT NULL,
  `documento_c` char(1) NOT NULL,
  `concepto_genera` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `fecha_evaluacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_lista_ficha_ante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluacion_anteproyecto`
--

INSERT INTO `evaluacion_anteproyecto` (`id_evaluacion_anteproyecto`, `planteamiento`, `formulacion`, `sistematizacion`, `comentario_problema_investigacion`, `objetivo_general_a`, `objetivo_general_b`, `objetivo_general_c`, `objetivo_especifico_a`, `objetivo_especifico_b`, `objetivo_especifico_c`, `comentario_objetivo`, `resultado_a`, `resultado_b`, `impacto_a`, `impacto_b`, `comentario_resultado`, `interes`, `importancia`, `utilidad`, `factibilidad_gen`, `pertinencia`, `comentario_justificacion`, `historico_a`, `historico_b`, `historico_c`, `contextual`, `teorico_a`, `teorico_b`, `teorico_c`, `conceptual`, `legal`, `comentario_marco`, `metodologia_a`, `metodologia_b`, `metodologia_c`, `metodologia_d`, `comentario_metodologia`, `cronograma_a`, `cronograma_b`, `cronograma_c`, `comentario_cronograma`, `recurso_a`, `recurso_b`, `recurso_c`, `recurso_d`, `comentario_recurso`, `referencias_a`, `referencias_b`, `referencias_c`, `comentario_referencias`, `titulo`, `nivel_investigativo`, `factibilidad`, `documento_a`, `documento_b`, `documento_c`, `concepto_genera`, `estado`, `activo`, `fecha_evaluacion`, `id_lista_ficha_ante`) VALUES
(1, '5', '5', '5', '', '5', '4', '5', '5', '5', '4', '', '4', '5', '5', '4', '', '5', '5', '4', '5', '4', '', '5', '4', '1', '1', '2', '1', '1', '1', '2', '', '1', '1', '1', '2', '', '1', '1', '2', '', '1', '1', '3', '2', '', '1', '2', '1', '', '1', '2', '1', '1', '1', '2', 'corregir el nivel investigativo', '2', 'N', '2021-03-23 03:26:45', 1),
(2, '5', '4', '5', '', '4', '5', '5', '5', '5', '4', '', '5', '5', '5', '4', '', '5', '5', '5', '5', '5', '', '5', '4', '4', '4', '5', '5', '5', '5', '4', '', '5', '4', '4', '5', '', '5', '5', '4', '', '5', '5', '5', '5', '', '4', '5', '5', '', '5', '5', '5', '5', '4', '5', 'aprobado', '3', NULL, '2021-03-23 03:26:45', 1),
(3, '5', '5', '5', '', '5', '5', '5', '5', '5', '4', '', '5', '5', '5', '4', '', '5', '4', '5', '5', '5', '', '5', '5', '5', '5', '5', '5', '5', '5', '5', '', '5', '5', '5', '5', '', '5', '5', '4', '', '5', '5', '5', '5', '', '5', '5', '5', '', '5', '5', '5', '5', '5', '5', 'proyecto aprobado', '3', NULL, '2021-03-23 18:55:18', 2),
(4, '5', '5', '5', 'buen planteamiento', '5', '5', '4', '4', '4', '5', '', '5', '5', '4', '4', '', '5', '4', '5', '4', '5', '', '5', '4', '4', '5', '5', '5', '4', '5', '5', 'marco legal excelente', '5', '4', '5', '5', '', '4', '5', '5', '', '5', '4', '5', '5', '', '5', '4', '5', '', '5', '4', '5', '5', '5', '4', 'evaluacion realizada', '3', NULL, '2021-03-23 22:40:17', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_proyecto`
--

CREATE TABLE `evaluacion_proyecto` (
  `id_evaluacion_anteproyecto` int(11) NOT NULL,
  `a1` double DEFAULT NULL,
  `a2` double DEFAULT NULL,
  `a3` double DEFAULT NULL,
  `a` double DEFAULT NULL,
  `b1` double DEFAULT NULL,
  `b2` double DEFAULT NULL,
  `b3` double DEFAULT NULL,
  `b4` double DEFAULT NULL,
  `b5` double DEFAULT NULL,
  `b6` double DEFAULT NULL,
  `b7` double DEFAULT NULL,
  `b` double DEFAULT NULL,
  `c1` double DEFAULT NULL,
  `c2` double DEFAULT NULL,
  `c3` double DEFAULT NULL,
  `c4` double DEFAULT NULL,
  `c5` double DEFAULT NULL,
  `c6` double DEFAULT NULL,
  `c7` double DEFAULT NULL,
  `c` double DEFAULT NULL,
  `d1` double DEFAULT NULL,
  `d2` double DEFAULT NULL,
  `d3` double DEFAULT NULL,
  `d` double DEFAULT NULL,
  `eva_jurado` double DEFAULT NULL,
  `nota_final` double DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `fecha_eva_pro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_eva_pro` varchar(50) DEFAULT NULL,
  `id_lista_ficha_eva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluacion_proyecto`
--

INSERT INTO `evaluacion_proyecto` (`id_evaluacion_anteproyecto`, `a1`, `a2`, `a3`, `a`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c`, `d1`, `d2`, `d3`, `d`, `eva_jurado`, `nota_final`, `activo`, `fecha_eva_pro`, `estado_eva_pro`, `id_lista_ficha_eva`) VALUES
(1, 4, 5, 4.5, 0.9, 5, 4.5, 4, 5, 4, 2, 1, 0.91, 3, 4, 3, 4, 3, 2, 3, 0.47, 3.4, 3.5, 3.6, 1.4, 2.28, 3.7, NULL, '2021-03-23 03:29:20', 'Aprobado', 1),
(2, 4, 5, 4, 0.87, 5, 4, 5, 4, 3, 2, 3, 0.93, 1, 1, 1, 4, 5, 3, 4.5, 0.42, 4, 4.5, 4.3, 1.71, 2.22, 3.9, NULL, '2021-03-23 19:42:55', 'Aprobado', 2),
(3, 3, 4, 5, 0.8, 4, 5, 4, 3, 4, 5, 4, 1.04, 3, 4, 5, 4, 3, 5, 4, 0.6, 5, 5, 5, 2, 2.44, 4.4, NULL, '2021-03-23 22:42:03', 'Aprobado', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `nombre_facultad` varchar(50) NOT NULL,
  `activo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre_facultad`, `activo`) VALUES
(1, 'FACULTAD DE INGIENERIAS', NULL),
(2, 'FACULTAD DE ADMINISTRACION DE EMPRESA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_ficha` int(11) NOT NULL,
  `titulo_ficha` varchar(1000) NOT NULL,
  `descripcion_ficha` varchar(50) NOT NULL,
  `id_programa_ficha` int(11) NOT NULL,
  `id_estado_ficha` int(11) NOT NULL,
  `evaluacion_ficha` text DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `fecha_ficha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_ficha`, `titulo_ficha`, `descripcion_ficha`, `id_programa_ficha`, `id_estado_ficha`, `evaluacion_ficha`, `activo`, `fecha_ficha`) VALUES
(1, 'Cómo se puede rediseñar y actualizar  la aplicación administrar proyectos de grado de la facultad de la ingeniería de la UNIAJC?', 'Proyecto de grado', 1, 4, 'aprobado', 'N', '2021-03-23 18:48:58'),
(2, 'proyecto de grado final', 'Proyecto de grado', 1, 4, 'Aprobado', 'N', '2021-03-23 22:35:22'),
(3, '¿Cómo se puede rediseñar y actualizar la versión 1 de la aplicación administrar proyectos de grado de la facultad de la ingeniería de la UNIAJC?', 'Proyecto de grado', 1, 4, 'Aprobado', NULL, '2021-03-23 22:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_ficha`
--

CREATE TABLE `lista_ficha` (
  `id_lista` int(11) NOT NULL,
  `id_lista_usuario` int(11) NOT NULL,
  `id_lista_ficha` int(11) NOT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `id_rol_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_ficha`
--

INSERT INTO `lista_ficha` (`id_lista`, `id_lista_usuario`, `id_lista_ficha`, `activo`, `id_rol_ficha`) VALUES
(1, 2, 1, NULL, 1),
(2, 4, 1, NULL, 1),
(3, 9, 1, NULL, 2),
(4, 10, 1, NULL, 3),
(5, 10, 1, NULL, 4),
(6, 3, 2, NULL, 1),
(7, 5, 2, NULL, 1),
(8, 9, 2, NULL, 2),
(9, 10, 2, NULL, 3),
(10, 10, 2, NULL, 4),
(11, 3, 3, NULL, 1),
(12, 10, 3, NULL, 2),
(13, 9, 3, NULL, 3),
(14, 9, 3, NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `nombre_pro` varchar(50) NOT NULL,
  `titulo_pro` varchar(50) NOT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `id_facultad_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `nombre_pro`, `titulo_pro`, `activo`, `id_facultad_pro`) VALUES
(1, 'INGIENERIA DE SISTEMAS', 'INGIENERIA DE SISTEMAS', NULL, 1),
(2, 'INGIENERIA DE ELECTRONICA', 'INGIENERIA DE ELECTRONICA', NULL, 1),
(3, 'INGIENERIA INDUSTRIAL', 'INGIENERIA INDUSTRIAL', NULL, 1);

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
(2, 'Docente'),
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
  `activo` varchar(1) DEFAULT NULL,
  `id_rol_usu` int(11) NOT NULL,
  `id_programa_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula_usu`, `nombre_usu`, `apellido_usu`, `correo_usu`, `contrasena_usu`, `activo`, `id_rol_usu`, `id_programa_usu`) VALUES
(1, 1107526211, 'EDWARD STEWEN', 'GIL BUITRAGO', 'admin@gmail.com', '$2y$10$/xAGfVqmZGJS3GKF3OQxUe3LXp7x/aLfIDMj5dlOf3lvl6xEWcLUC', NULL, 1, 1),
(2, 123451, 'Jorge Mario ', 'Vargaz', 'Vargaz@hotmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(3, 123452, 'Sebastian Morales', 'Barrientos', 'Barrientos@hotmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(4, 123453, 'Erik Stiven ', 'Alegria', 'Alegria@hotmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(5, 123454, 'Eduard ', 'Gil Lozada', 'Lozada@gmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(6, 123455, 'Mariana', 'Rodrigues', 'Rodrigues@gmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(7, 123456, 'Isabela', 'Landazuri', 'Landazuri@gmail.com', '$2y$10$z2spOy4tT9h.Frqz8SA2DOcgwYzgKHGeJpzYFwdprG/DdnRbf2nme', NULL, 4, 1),
(8, 213456, 'Rosa', 'Buitreras', 'Rosa@gmail.com', '$2y$10$ncBU8urrXmCqIIp1rU/gWOShnMk7HV3QvKpa/nqDUfu28j9mBvA/6', NULL, 3, 1),
(9, 31234, 'Andres', 'Arevalo', 'Andres@gmail.com', '$2y$10$w4/lN2nRam9Gxf1iQPm0wepiWokavit72PViEa0a9LefsMD8jD83S', NULL, 2, 1),
(10, 31235, 'Milton', 'Alegria', 'Milton@gmail.com', '$2y$10$zxJSNvZ2kL/VwvprjwX/juTV06euB5DXVUylq/3pcXB02E.KpP3n.', NULL, 2, 1);

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
-- Indices de la tabla `evaluacion_anteproyecto`
--
ALTER TABLE `evaluacion_anteproyecto`
  ADD PRIMARY KEY (`id_evaluacion_anteproyecto`),
  ADD KEY `id_lista_ficha_ante` (`id_lista_ficha_ante`);

--
-- Indices de la tabla `evaluacion_proyecto`
--
ALTER TABLE `evaluacion_proyecto`
  ADD PRIMARY KEY (`id_evaluacion_anteproyecto`),
  ADD KEY `id_lista_ficha_eva` (`id_lista_ficha_eva`);

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
  MODIFY `id_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `evaluacion_anteproyecto`
--
ALTER TABLE `evaluacion_anteproyecto`
  MODIFY `id_evaluacion_anteproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `evaluacion_proyecto`
--
ALTER TABLE `evaluacion_proyecto`
  MODIFY `id_evaluacion_anteproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista_ficha`
--
ALTER TABLE `lista_ficha`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campos_fichas`
--
ALTER TABLE `campos_fichas`
  ADD CONSTRAINT `id_campo_fichas_fk` FOREIGN KEY (`fk_id_ficha`) REFERENCES `ficha` (`id_ficha`);

--
-- Filtros para la tabla `evaluacion_anteproyecto`
--
ALTER TABLE `evaluacion_anteproyecto`
  ADD CONSTRAINT `evaluacion_anteproyecto_ibfk_1` FOREIGN KEY (`id_lista_ficha_ante`) REFERENCES `ficha` (`id_ficha`);

--
-- Filtros para la tabla `evaluacion_proyecto`
--
ALTER TABLE `evaluacion_proyecto`
  ADD CONSTRAINT `evaluacion_proyecto_ibfk_1` FOREIGN KEY (`id_lista_ficha_eva`) REFERENCES `ficha` (`id_ficha`);

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
