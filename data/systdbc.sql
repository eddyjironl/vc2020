-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2021 a las 18:00:27
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ksschgrd`
-- lista de menus estructurados del sistema.
--

drop table if exists ksschgrd;
create table ksschgrd(
  calias char(10) default "",
  corder char(10) default "",
  cheader char(30) default "",
  mcolvalue text ,
  ncolwidth integer(3) default 0,
  cmodule char(10) default ""

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kssgrid`
--




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sycont`
--

DROP TABLE IF EXISTS `sycont`;
CREATE TABLE IF NOT EXISTS `sycont` (
  `cuid` int(10) NOT NULL AUTO_INCREMENT,
  `cfullname` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ctel` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `cemail` char(50) COLLATE latin1_spanish_ci NOT NULL,
  `mnotas` text COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `fecha` date NOT NULL,
  `hora` date NOT NULL,
  UNIQUE KEY `cuid` (`cuid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sygrup`
--

DROP TABLE IF EXISTS `sygrup`;
CREATE TABLE IF NOT EXISTS `sygrup` (
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `symenu`
--

DROP TABLE IF EXISTS `symenu`;
CREATE TABLE IF NOT EXISTS `symenu` (
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Estructura de tabla para la tabla `syperm`
--

DROP TABLE IF EXISTS `syperm`;
CREATE TABLE IF NOT EXISTS `syperm` (
  `cuid` int(10) NOT NULL AUTO_INCREMENT,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `allow` tinyint(1) NOT NULL,
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'compañia a la que pertenece el permiso',
  PRIMARY KEY (`cuid`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `syperm`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syscomp`
--

DROP TABLE IF EXISTS `syscomp`;
CREATE TABLE IF NOT EXISTS `syscomp` (
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `compdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ctel` char(20) COLLATE latin1_spanish_ci default '',
  `cfax` char(20) COLLATE latin1_spanish_ci default '',
  `mdirecc` text COLLATE latin1_spanish_ci ,
  `cciudad` char(100) COLLATE latin1_spanish_ci default '',
  `cpais` char(100) COLLATE latin1_spanish_ci default '',
  `cstatus` char(2) COLLATE latin1_spanish_ci default "OP",
  `llogo` tinyint(1) default 0,
  `lview` tinyint(1) default 0,
  `cfoto` char(200) COLLATE latin1_spanish_ci default "",
  `dbc` char(50) COLLATE latin1_spanish_ci default "",
  `nperfisc` int(3) default 12,
  `nanofisc` int(4) default 2009,
  `ntaxratg` decimal(10,2) default 0,
  `lunicontdat` tinyint(1) default 0,
  `dnextclear` date ,
  `dbname` char(200) COLLATE latin1_spanish_ci default "ksisdbc",
  `chost` char(200) COLLATE latin1_spanish_ci default "localhost",
  `ckeyid` char(200) COLLATE latin1_spanish_ci default "",
  `cuser` char(200) COLLATE latin1_spanish_ci default "root",
  PRIMARY KEY (`ccompid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Estructura de tabla para la tabla `sysuser`
--

DROP TABLE IF EXISTS `sysuser`;
CREATE TABLE IF NOT EXISTS `sysuser` (
  `cuid` int(10) NOT NULL AUTO_INCREMENT,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `cpasword` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cuid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sysuser`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syswhse`
--

DROP TABLE IF EXISTS `syswhse`;
CREATE TABLE IF NOT EXISTS `syswhse` (
  `cuserid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

COMMIT;

