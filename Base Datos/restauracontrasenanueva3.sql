-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2013 a las 05:51:58
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restauracontrasenanueva3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobaciondocumento`
--

CREATE TABLE `aprobaciondocumento` (
  `idAprobacion` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `documento_idDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aprobaciondocumento`
--

INSERT INTO `aprobaciondocumento` (`idAprobacion`, `usuario_idUsuario`, `documento_idDocumento`) VALUES
(6, 156, 12),
(7, 156, 10),
(10, 156, 16),
(11, 156, 6),
(12, 156, 15),
(15, 156, 1),
(16, 156, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `autor` varchar(250) NOT NULL,
  `resumen` varchar(500) DEFAULT NULL,
  `foto_documento` varchar(500) DEFAULT NULL,
  `url_archivo` varchar(500) DEFAULT NULL,
  `ubicacion_fisica_documento` varchar(500) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `estado` enum('1','0') NOT NULL,
  `tipoDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`idDocumento`, `usuario_idUsuario`, `titulo`, `autor`, `resumen`, `foto_documento`, `url_archivo`, `ubicacion_fisica_documento`, `creado`, `modificado`, `estado`, `tipoDocumento`) VALUES
(1, 155, 'otro masmas', 'nuevo', 'msadlkfj', 'file-text-o', 'cf633eca-6b0e-4046-8a46-9a29bd113fbc/InstalaralInstalarLinux.txt', 'barinas', '2018-07-03 00:52:12', '2018-09-04 18:13:57', '1', 18),
(6, 155, 'subir nuevo', 'documento', 'mas nuevo', 'file-text-o', '3123510d-da50-4b38-a146-ad6c2d04975b/Descargar Curso BS4.txt', 'barinas', '2018-07-04 17:59:31', '2018-09-04 18:10:22', '1', 17),
(10, 155, 'nuevos', 'masmas', 'madlkjad', 'file-pdf-o', '4ea6ddfd-71c7-4672-b66d-ddf2c091d432/Modulo IV.pdf', 'barinas', '2018-09-04 18:09:39', '2018-09-04 21:23:12', '1', 18),
(12, 155, 'titulo', 'autor', 'resumen', 'file-text-o', '1cdfd7dd-9e0d-472a-b282-4f27f4c079a5/InstalaralInstalarLinux.txt', 'barinas', '2018-09-04 20:40:56', '2018-09-04 20:40:56', '1', 17),
(14, 155, 'excel2', 'juan', 'daslkfj', 'file-excel-o', '92058a33-e311-44c4-9319-9835547168ab/FORMATO DE NOTAS 2018.xls', 'barinas', '2018-09-04 21:42:16', '2018-09-04 21:42:16', '0', 17),
(15, 155, 'word', 'juan', 'sadlkjf', 'file-word-o', '7683cdfd-2240-4210-8ba6-a072c47e5478/Curriculo Juan Colmenares.docx', 'nuevo', '2018-08-04 21:43:50', '2018-09-04 21:43:50', '1', 17),
(16, 155, 'powerpoint', 'juan', 'david', 'file-powerpoint-o', '34121dbd-ac65-455c-a055-753c09b76974/CAux_CasosUso.ppt', 'barinas', '2018-09-04 21:44:23', '2018-09-04 21:44:23', '1', 17),
(17, 155, 'ultimo', 'nuevo', 'lakjfd', 'file-powerpoint-o', '0c5ea19b-3d34-4de9-813f-2ce7d7fb76ab/CAux_CasosUso.ppt', 'barinas', '2018-09-05 20:48:34', '2018-09-05 20:48:34', '1', 17),
(18, 155, 'juego', 'nuevo', 'lksfdj', 'file-pdf-o', 'f12735a1-74ce-49b0-b806-9a8084130e36/instalacion_antena-directv.pdf', 'barinas', '2018-09-05 14:51:35', '2018-09-05 14:51:35', '0', 17),
(19, 155, 'nuevo', 'titulo', 'nuevo', 'file-pdf-o', 'faa4f43e-1949-45ac-bb27-bf42264974a5/CONSTANCIA DE ESTUDIO.pdf', 'barinas', '2018-09-13 20:27:47', '2018-09-13 20:27:47', '0', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idMensaje` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `usuario_idUsuario2` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`idMensaje`, `usuario_idUsuario`, `usuario_idUsuario2`, `mensaje`, `fecha`, `estado`) VALUES
(1, 155, 0, 'El documento NUEVO ha sido aprobado', '2018-09-04 15:37:23', '1'),
(2, 155, 0, 'El documento NUEVO ha sido desaprobado', '2018-09-04 15:37:23', '1'),
(3, 155, 0, 'El documento NUEVO ha sido aprobado', '2018-09-04 15:37:23', '1'),
(5, 155, 0, 'El documento NUEVO ha sido aprobado', '2018-09-04 15:37:23', '1'),
(6, 155, NULL, 'El documento NUEVO ha sido desaprobado', '2018-09-07 22:50:05', '1'),
(7, 155, 0, 'El documento NUEVO ha sido aprobado', '2018-09-04 15:37:23', '1'),
(8, 155, 0, 'El documento NUEVO ha sido desaprobado', '2018-09-04 15:37:23', '1'),
(10, 155, 0, 'El documento titulo ha sido aprobado', '2018-09-04 19:21:55', '1'),
(11, 155, 0, 'El documento otros juego nuevo ha sido aprobado', '2018-09-04 19:21:55', '1'),
(12, 155, 0, 'El documento word ha sido aprobado', '2018-09-04 22:48:10', '1'),
(13, 155, 0, 'El documento excel2 ha sido aprobado', '2018-09-04 22:48:10', '1'),
(14, 155, 0, 'El documento powerpoint ha sido aprobado', '2018-09-04 22:48:10', '1'),
(15, 155, 0, 'El documento subir nuevo ha sido aprobado', '2018-09-04 22:48:10', '1'),
(16, 155, 0, 'El documento otro masmas ha sido desaprobado', '2018-09-05 18:45:23', '1'),
(17, 155, 0, 'El documento word ha sido desaprobado', '2018-09-05 18:45:23', '1'),
(29, 156, 155, 'sadfklj', '2018-09-07 23:50:35', '1'),
(31, 156, 155, 'mamas', '2018-09-07 23:50:35', '1'),
(34, 156, 155, 'respuesta', '2018-09-08 01:16:36', '1'),
(37, 155, 156, 'kjasdflkjdf', '2018-09-09 14:50:39', '1'),
(38, 156, 155, 'respuesta', '2018-09-09 14:52:06', '1'),
(40, 155, 156, 'klasd', '2013-01-01 05:40:38', '1'),
(41, 155, 156, 'klsadf', '2013-01-01 05:40:38', '1'),
(43, 156, 155, 'klasdjf', '2013-01-01 05:51:41', '1'),
(45, 155, 0, 'El documento juego ha sido desaprobado', '2013-01-01 05:54:30', '1'),
(46, 156, 155, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-09-14 19:53:50', '1'),
(47, 155, 156, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-09-14 19:56:14', '1'),
(48, 155, 156, 'hola cocomo estas hoy en dia tan especial como hoy en dia hola como estoy en mid ia dkl akld no los se todavia como slo sdl ime i lo menor del dia ena amdk isl dmalk difjakjdf', '2018-09-14 19:56:14', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idTipoDocumento` int(11) NOT NULL,
  `nombreTipo` varchar(150) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idTipoDocumento`, `nombreTipo`, `descripcion`) VALUES
(17, 'tesis', 'para universidad'),
(18, 'libro', 'para leer'),
(19, 'revista', 'para ver'),
(20, 'NUEVO', 'SKADFJLKFASDJ'),
(21, 'OTROMAS', 'NUEVO'),
(22, 'ULTIMO2', 'LJSAFD'),
(23, 'ayer', 'hoy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(60) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `olvido_pass_iden` varchar(32) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `estado` enum('1','0') NOT NULL DEFAULT '1',
  `foto_usuario` varchar(500) DEFAULT NULL,
  `permiso` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `telefono`, `olvido_pass_iden`, `creado`, `modificado`, `estado`, `foto_usuario`, `permiso`) VALUES
(155, 'juan', 'colmenares', 'uno@uno.com', '$2y$12$Ih32S4wA6wMbJ6HpeptyTe3RS8Hzw3fhGttT34SHEws7xQuMtN1Pm', '(283) 893 - 9298', '', '2013-01-01 06:10:34', '0000-00-00 00:00:00', '1', '', '0'),
(156, 'juan', 'colmenares', 'admin@admin.com', '$2y$12$2ISkau6i3yXwfLyjCLgqLusRAuUSnrQ1kYtUYSRPhpzS9T7c0.t9y', '(399) 999 - 999', '', '2013-01-01 06:11:03', '0000-00-00 00:00:00', '1', '', '1'),
(157, 'juan', 'colmenares', '97juandcm11@gmail.com', '$2y$12$i1X4afqC6PzbDGnfUreJAuW8qRIazlmgENDNcd0EIW54TtSIqfUCu', '(414) 351 - 5312', '', '2018-09-05 15:41:18', '0000-00-00 00:00:00', '1', '3046bfb0-dd77-418c-b194-951360bac55d/avatar5.png', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprobaciondocumento`
--
ALTER TABLE `aprobaciondocumento`
  ADD PRIMARY KEY (`idAprobacion`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`),
  ADD KEY `documento_idDocumento` (`documento_idDocumento`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `fk_documento_usuarios_idx` (`usuario_idUsuario`),
  ADD KEY `fk_documento_tipodocumento1_idx` (`tipoDocumento`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idMensaje`),
  ADD KEY `usuario_idUsuario` (`usuario_idUsuario`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idTipoDocumento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprobaciondocumento`
--
ALTER TABLE `aprobaciondocumento`
  MODIFY `idAprobacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idTipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprobaciondocumento`
--
ALTER TABLE `aprobaciondocumento`
  ADD CONSTRAINT `aprobaciondocumento_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `aprobaciondocumento_ibfk_2` FOREIGN KEY (`documento_idDocumento`) REFERENCES `documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_documento_tipodocumento1` FOREIGN KEY (`tipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documento_usuarios` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
