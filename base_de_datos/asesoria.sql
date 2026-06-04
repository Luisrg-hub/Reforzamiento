-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-06-2026 a las 14:49:58
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asesoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_sesion`
--

DROP TABLE IF EXISTS `alumno_sesion`;
CREATE TABLE IF NOT EXISTS `alumno_sesion` (
  `id_sesion` int NOT NULL,
  `id_alumno` int NOT NULL,
  PRIMARY KEY (`id_sesion`,`id_alumno`),
  KEY `fk-as-alumno` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE IF NOT EXISTS `asignacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_docente` int NOT NULL,
  `id_asignatura` int NOT NULL,
  `periodo` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-asig-docente` (`id_docente`),
  KEY `fk-asig-asignatura` (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
CREATE TABLE IF NOT EXISTS `asignatura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_carrera` int DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_asignatura_carrera` (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE IF NOT EXISTS `carrera` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
(1, 'Ingeniería en Sistemas Computacionales'),
(2, 'Ingeniería en Administración'),
(3, 'Ingeniería Ambiental'),
(4, 'Ingeniería Industrial'),
(5, 'Ingeniería en Gestión Empresarial'),
(6, 'Ingeniería Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera_asignatura`
--

DROP TABLE IF EXISTS `carrera_asignatura`;
CREATE TABLE IF NOT EXISTS `carrera_asignatura` (
  `id_carrera` int NOT NULL,
  `id_asignatura` int NOT NULL,
  PRIMARY KEY (`id_carrera`,`id_asignatura`),
  KEY `fk-ca-asignatura` (`id_asignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

DROP TABLE IF EXISTS `disponibilidad`;
CREATE TABLE IF NOT EXISTS `disponibilidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_docente` int NOT NULL,
  `dia` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_cierre` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-disp-docente` (`id_docente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencia`
--

DROP TABLE IF EXISTS `evidencia`;
CREATE TABLE IF NOT EXISTS `evidencia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sesion` int NOT NULL,
  `nombre_archivo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-evidencia-sesion` (`id_sesion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16le;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1777325819),
('m130524_201442_init', 1777325822),
('m190124_110200_add_verification_token_column_to_user_table', 1777325822),
('m260427_175742_create_carrera_table', 1777325822),
('m260427_183407_create_asignatura_table', 1777325822),
('m260427_183641_create_carrera_asignatura_table', 1777325822),
('m260427_202645_create_perfil_admin_table', 1777325822),
('m260427_202656_create_perfil_docente_table', 1777325823),
('m260427_202704_create_perfil_alumno_table', 1777325823),
('m260427_205229_create_disponibilidad_table', 1777325823),
('m260427_205246_create_asignacion_table', 1777325823),
('m260427_205301_create_sesion_table', 1777325823),
('m260427_205326_create_alumno_sesion_table', 1777325823),
('m260427_205341_create_evidencia_table', 1777325823);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_admin`
--

DROP TABLE IF EXISTS `perfil_admin`;
CREATE TABLE IF NOT EXISTS `perfil_admin` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_paterno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_materno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_admin`
--

INSERT INTO `perfil_admin` (`id_usuario`, `nombre`, `apellido_paterno`, `apellido_materno`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_alumno`
--

DROP TABLE IF EXISTS `perfil_alumno`;
CREATE TABLE IF NOT EXISTS `perfil_alumno` (
  `id_usuario` int NOT NULL,
  `matricula` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_paterno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_materno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_carrera` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `matricula` (`matricula`),
  KEY `fk-alumno-carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_docente`
--

DROP TABLE IF EXISTS `perfil_docente`;
CREATE TABLE IF NOT EXISTS `perfil_docente` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_paterno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido_materno` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE IF NOT EXISTS `sesion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_asignacion` int NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `duracion` int NOT NULL,
  `tema` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk-sesion-asignacion` (`id_asignacion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'master_root', '6BS7a3NEVFYZ_tES0lqE-W4-hydlexEA', '$2y$13$E7fsb1zcNudGF.SgksrNYuT5GJ8WyTCXwDdv6zldaKK2NBCNuOrP.', NULL, 'root@sistema.com', 10, 1780257287, 1780257287, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_sesion`
--
ALTER TABLE `alumno_sesion`
  ADD CONSTRAINT `fk-as-alumno` FOREIGN KEY (`id_alumno`) REFERENCES `perfil_alumno` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-as-sesion` FOREIGN KEY (`id_sesion`) REFERENCES `sesion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fk-asig-asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-asig-docente` FOREIGN KEY (`id_docente`) REFERENCES `perfil_docente` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_asignatura_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `carrera_asignatura`
--
ALTER TABLE `carrera_asignatura`
  ADD CONSTRAINT `fk-ca-asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-ca-carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD CONSTRAINT `fk-disp-docente` FOREIGN KEY (`id_docente`) REFERENCES `perfil_docente` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD CONSTRAINT `fk-evidencia-sesion` FOREIGN KEY (`id_sesion`) REFERENCES `sesion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_admin`
--
ALTER TABLE `perfil_admin`
  ADD CONSTRAINT `fk-admin-user` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_alumno`
--
ALTER TABLE `perfil_alumno`
  ADD CONSTRAINT `fk-alumno-carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-alumno-user` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_docente`
--
ALTER TABLE `perfil_docente`
  ADD CONSTRAINT `fk-docente-user` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk-sesion-asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignacion` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
