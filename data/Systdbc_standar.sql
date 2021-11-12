-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql203.byetcluster.com
-- Tiempo de generación: 18-06-2021 a las 23:14:50
-- Versión del servidor: 5.6.48-88.0
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epiz_26567022_systdbc`
--
drop database if EXISTS systdbc;
create database systdbc;
use systdbc;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sycont`
--
DROP TABLE IF EXISTS sycont;
CREATE TABLE `sycont` (
  `cuid` int(10) NOT NULL,
  `cfullname` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ctel` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `cemail` char(50) COLLATE latin1_spanish_ci NOT NULL,
  `mnotas` text COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `fecha` date NOT NULL,
  `hora` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

DROP TABLE IF EXISTS sygrup;
CREATE TABLE `sygrup` (
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `symenu`
--

DROP TABLE IF EXISTS symenu;
CREATE TABLE `symenu` (
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `symenu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syperm`
--
DROP TABLE IF EXISTS syperm;
CREATE TABLE `syperm` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `allow` tinyint(1) NOT NULL,
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'compañia a la que pertenece el permiso'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


DROP TABLE IF EXISTS syscomp;
CREATE TABLE `syscomp` (
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `compdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ctel` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `cfax` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `mdirecc` text COLLATE latin1_spanish_ci NOT NULL,
  `cciudad` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cpais` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL,
  `llogo` tinyint(1) NOT NULL,
  `lview` tinyint(1) NOT NULL,
  `cfoto` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `dbc` char(50) COLLATE latin1_spanish_ci NOT NULL,
  `nperfisc` int(3) NOT NULL,
  `nanofisc` int(4) NOT NULL,
  `ntaxratg` decimal(10,2) NOT NULL,
  `lunicontdat` tinyint(1) NOT NULL,
  `dnextclear` date NOT NULL,
  `dbname` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `chost` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ckeyid` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cuser` char(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sysuser`
--

DROP TABLE IF EXISTS sysuser;
CREATE TABLE `sysuser` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `cwhseno` char(10) COLLATE latin1_spanish_ci NOT NULL DEFAULT '01',
  `cpasword` char(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

drop table if exists syswhse;
  create table syswhse (
    cuserid char(10) not null ,
    cwhseno char(10) not null, 
    cstatus char(2) not null
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- Indices de la tabla `sycont`
--
ALTER TABLE `sycont`
  ADD UNIQUE KEY `cuid` (`cuid`);

--
-- Indices de la tabla `syperm`
--
ALTER TABLE `syperm`
  ADD PRIMARY KEY (`cuid`);

--
-- Indices de la tabla `syscomp`
--
ALTER TABLE `syscomp`
  ADD PRIMARY KEY (`ccompid`);

--
-- Indices de la tabla `sysuser`
--
ALTER TABLE `sysuser`
  ADD PRIMARY KEY (`cuid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sycont`
--
ALTER TABLE `sycont`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `syperm`
--
ALTER TABLE `syperm`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de la tabla `sysuser`
--
ALTER TABLE `sysuser`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
