-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql203.byetcluster.com
-- Tiempo de generación: 18-06-2021 a las 23:32:57
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
CREATE DATABASE IF NOT EXISTS `epiz_26567022_systdbc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `epiz_26567022_systdbc`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sycont`
--

DROP TABLE IF EXISTS `sycont`;
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sygrup`
--

DROP TABLE IF EXISTS `sygrup`;
CREATE TABLE `sygrup` (
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sygrup`
--

INSERT INTO `sygrup` (`cgrpid`, `cdesc`, `cstatus`) VALUES
('01', 'Sistemas INT', 'OP'),
('02', 'Administracion', 'OP'),
('', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `symenu`
--

DROP TABLE IF EXISTS `symenu`;
CREATE TABLE `symenu` (
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `symenu`
--

INSERT INTO `symenu` (`cmenuid`, `cdesc`) VALUES
('sy001', 'configuracion de la compañia'),
('sy002', 'Grupos de Trabajo'),
('tr001', 'Facturacion y Notas de Debito'),
('tr002', 'Recibos de Dinero'),
('tr003', 'Cotizaciones'),
('tr004', 'Entradas y Salidas de Inventario'),
('rp001', 'Resumen de Ventas'),
('rp002', 'Cuentas por Cobrar'),
('rp003', 'Estado de Cuentas'),
('rp004', 'Resumen de Cobros'),
('rp005', 'Lista de Precios'),
('rp006', 'Resumen de Uilidades y Costos'),
('rp007', 'Formato de Requisas'),
('rp008', 'Reporte de Movimiento de Inventario (Entradas y Salidas)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syperm`
--

DROP TABLE IF EXISTS `syperm`;
CREATE TABLE `syperm` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `allow` tinyint(1) NOT NULL,
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'compañia a la que pertenece el permiso'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `syperm`
--

INSERT INTO `syperm` (`cuid`, `cgrpid`, `cmenuid`, `cdesc`, `allow`, `ccompid`) VALUES
(129, '01', 'sy001', 'configuracion de la compañia', 1, '02'),
(130, '01', 'sy002', 'Grupos de Trabajo', 1, '02'),
(131, '01', 'tr001', 'Facturacion y Notas de Debito', 1, '02'),
(132, '01', 'tr002', 'Recibos de Dinero', 1, '02'),
(133, '01', 'tr003', 'Cotizaciones', 1, '02'),
(134, '01', 'tr004', 'Entradas y Salidas de Inventario', 1, '02'),
(135, '01', 'rp001', 'Resumen de Ventas', 1, '02'),
(136, '01', 'rp002', 'Cuentas por Cobrar', 1, '02'),
(137, '01', 'rp003', 'Estado de Cuentas', 1, '02'),
(138, '01', 'rp004', 'Resumen de Cobros', 1, '02'),
(139, '01', 'rp005', 'Lista de Precios', 1, '02'),
(140, '01', 'rp006', 'Resumen de Uilidades y Costos', 1, '02'),
(141, '01', 'rp007', 'Formato de Requisas', 1, '02'),
(142, '01', 'rp008', 'Reporte de Movimiento de Inventario (Entradas y Salidas)', 1, '02'),
(143, '01', 'sy001', 'configuracion de la compañia', 1, 'KSIS01'),
(144, '01', 'sy002', 'Grupos de Trabajo', 1, 'KSIS01'),
(145, '01', 'tr001', 'Facturacion y Notas de Debito', 1, 'KSIS01'),
(146, '01', 'tr002', 'Recibos de Dinero', 1, 'KSIS01'),
(147, '01', 'tr003', 'Cotizaciones', 1, 'KSIS01'),
(148, '01', 'tr004', 'Entradas y Salidas de Inventario', 1, 'KSIS01'),
(149, '01', 'rp001', 'Resumen de Ventas', 1, 'KSIS01'),
(150, '01', 'rp002', 'Cuentas por Cobrar', 1, 'KSIS01'),
(151, '01', 'rp003', 'Estado de Cuentas', 1, 'KSIS01'),
(152, '01', 'rp004', 'Resumen de Cobros', 1, 'KSIS01'),
(153, '01', 'rp005', 'Lista de Precios', 1, 'KSIS01'),
(154, '01', 'rp006', 'Resumen de Uilidades y Costos', 1, 'KSIS01'),
(155, '01', 'rp007', 'Formato de Requisas', 1, 'KSIS01'),
(156, '01', 'rp008', 'Reporte de Movimiento de Inventario (Entradas y Salidas)', 1, 'KSIS01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syscomp`
--

DROP TABLE IF EXISTS `syscomp`;
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

--
-- Volcado de datos para la tabla `syscomp`
--

INSERT INTO `syscomp` (`ccompid`, `compdesc`, `ctel`, `cfax`, `mdirecc`, `cciudad`, `cpais`, `cstatus`, `llogo`, `lview`, `cfoto`, `dbc`, `nperfisc`, `nanofisc`, `ntaxratg`, `lunicontdat`, `dnextclear`, `dbname`, `chost`, `ckeyid`, `cuser`) VALUES
('02', 'Barbaros HN', '98612627', '98612627', 'ciudad doral w150', 'managua', 'Nicaragua', 'OP', 0, 0, '../photos/users.ico', '', 0, 13, '0.00', 0, '0000-00-00', 'epiz_26567022_ksisdbc', 'sql203.epizy.com', 'Silverdesk26', 'epiz_26567022'),
('KSIS01', 'Fresa S', '98612627', '97612627', 'Hotel Rodriguez, ddd', 'Salama, Olancho', 'Honduras', 'OP', 0, 0, '../photos/nueva.ico', '', 0, 4, '0.00', 0, '0000-00-00', 'epiz_26567022_ksisdbc_1', 'sql203.epizy.com', 'Silverdesk26', 'epiz_26567022');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sysuser`
--

DROP TABLE IF EXISTS `sysuser`;
CREATE TABLE `sysuser` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `cpasword` char(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sysuser`
--

INSERT INTO `sysuser` (`cuid`, `cgrpid`, `cfullname`, `cuserid`, `cstatus`, `cpasword`) VALUES
(9, '01', 'Administrador General', 'SUPERVISOR', 'OP', '2505'),
(10, '01', 'Eddy jiron', 'EDDY', 'OP', '1'),
(11, '02', 'Wendy Sauceda Torrez', 'WENDY', 'OP', '2212'),
(13, '01', 'Ivan Alfonso Jiron Guillen', 'ivan', 'CL', '2'),
(14, '01', 'Ivan Alfonso Jiron Guillen', 'alfonso', 'CL', '5'),
(18, '02', 'Ivan Alfonso Jiron Guillen', 'ivan', 'OP', '3');

--
-- Índices para tablas volcadas
--

--
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
