-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-11-2025 a las 03:59:47
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
-- Base de datos: `parcial_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptor`
--

DROP TABLE IF EXISTS `inscriptor`;
CREATE TABLE IF NOT EXISTS `inscriptor` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Edad` int NOT NULL,
  `Sexo` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Pais_Residente` int NOT NULL,
  `Nacionalidad` int NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Observaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Pais_Residente` (`Pais_Residente`,`Nacionalidad`) USING BTREE,
  KEY `Nacionalidad` (`Nacionalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscriptor`
--

INSERT INTO `inscriptor` (`ID`, `Nombre`, `Apellido`, `Edad`, `Sexo`, `Pais_Residente`, `Nacionalidad`, `Correo`, `Telefono`, `Fecha_Registro`, `Observaciones`) VALUES
(8, 'Kazim', 'Jesse', 23, 'M', 1, 1, 'Kazim.Jesse@utp.123', '2151-4114', '2025-11-16 02:28:06', 'Seguro'),
(9, 'Kazim', 'Jesse', 23, 'M', 2, 5, 'Kazim.Jesse@utp.123', '2151-4114', '2025-11-16 03:56:43', 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptor-tema`
--

DROP TABLE IF EXISTS `inscriptor-tema`;
CREATE TABLE IF NOT EXISTS `inscriptor-tema` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_Inscriptor` int NOT NULL,
  `ID_Tema` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Inscriptor` (`ID_Inscriptor`,`ID_Tema`),
  KEY `ID_Tema` (`ID_Tema`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscriptor-tema`
--

INSERT INTO `inscriptor-tema` (`ID`, `ID_Inscriptor`, `ID_Tema`) VALUES
(5, 8, 1),
(4, 8, 3),
(6, 8, 5),
(9, 9, 2),
(8, 9, 4),
(7, 9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`ID`, `Nombre`) VALUES
(1, 'Panama'),
(2, 'Venezuela'),
(3, 'Mexico'),
(4, 'España'),
(5, 'Alemania'),
(6, 'Grecia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`ID`, `Nombre`) VALUES
(1, 'Bases de datos'),
(2, 'Programacion Orientada a Objeto'),
(3, 'Amazon Web Services'),
(4, 'Inteligencia Artificial'),
(5, 'Big Data');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscriptor`
--
ALTER TABLE `inscriptor`
  ADD CONSTRAINT `inscriptor_ibfk_1` FOREIGN KEY (`Pais_Residente`) REFERENCES `pais` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inscriptor_ibfk_2` FOREIGN KEY (`Nacionalidad`) REFERENCES `pais` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscriptor-tema`
--
ALTER TABLE `inscriptor-tema`
  ADD CONSTRAINT `inscriptor-tema_ibfk_1` FOREIGN KEY (`ID_Inscriptor`) REFERENCES `inscriptor` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `inscriptor-tema_ibfk_2` FOREIGN KEY (`ID_Tema`) REFERENCES `temas` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
