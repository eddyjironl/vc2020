-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2020 a las 03:26:34
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ksisdbc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptran`
--

CREATE TABLE `aptran` (
  `cuid` int(10) NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aptran`
--

INSERT INTO `aptran` (`cuid`, `crespno`, `cstatus`, `ctype`, `dtrndate`, `mnotas`, `namount`, `cuserid`, `fecha`, `hora`) VALUES
(11, '01', 'OP', 'CT', '2020-06-05', 'Churros', '630.83', 'supervisor', '', ''),
(12, '02', 'OP', 'CT', '2020-06-05', 'Galletas,avena,cloro,shampoo,crema para rizo,besitos', '501.00', 'supervisor', '', ''),
(13, '03', 'OP', 'CT', '2020-06-05', 'coca cola 2lt y 3lts', '470.00', 'supervisor', '', ''),
(14, '04', 'OP', 'CT', '2020-06-05', '10 de queso 44 y 15 de mantequilla 33', '935.00', 'supervisor', '', ''),
(15, '05', 'OP', 'CT', '2020-06-05', 'un paquete de pepsi 1.5', '260.00', 'supervisor', '', ''),
(16, '07', 'OP', 'CT', '2020-06-08', '', '360.00', 'supervisor', '', ''),
(17, '05', 'OP', 'CT', '2020-06-08', 'MP', '200.00', 'supervisor', '', ''),
(18, '08', 'OP', 'CT', '2020-06-08', '2 bolsas de agua para vender\r\ny un tambo de agua para tomar la casa', '54.00', 'supervisor', '', ''),
(19, '03', 'OP', 'IN', '2020-05-01', '', '6086.00', 'supervisor', '', ''),
(20, '03', 'OP', 'RE', '2020-06-08', '', '-6080.00', 'supervisor', '', ''),
(21, '09', 'OP', 'IN', '2020-06-08', 'Prestamo para pagar  a Domis', '2500.00', 'supervisor', '', ''),
(22, '10', 'OP', 'CT', '2020-06-09', '', '140.00', 'supervisor', '', ''),
(23, '05', 'OP', 'CT', '2020-06-09', 'pepsi 3 lts', '250.00', 'supervisor', '', ''),
(24, '03', 'OP', 'IN', '2020-06-09', '', '8896.00', 'supervisor', '', ''),
(25, '05', 'OP', 'IN', '2020-06-10', '', '260.00', 'supervisor', '', ''),
(26, '12', 'OP', 'CT', '2020-06-11', 'tres cajillas a 90', '270.00', 'supervisor', '', ''),
(27, '08', 'OP', 'CT', '2020-06-11', 'bolsas de agua y vidon', '54.00', 'supervisor', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arcust`
--

CREATE TABLE `arcust` (
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cname` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `ctel` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `cpasword` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `nlimcrd` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arcust`
--

INSERT INTO `arcust` (`ccustno`, `cname`, `ctel`, `cpasword`, `nlimcrd`, `mnotas`, `ctype`) VALUES
('00', 'Clientes Varios (Vta Contado)', '', 'VTA00', '1.00', 'Clientes de Contado', 'CT'),
('01', 'Carmelina Torrez', '', '1234', '2000.00', 'Suegra', 'IN'),
('02', 'Merlyn Vecina', '', '0000', '300.00', '', 'IN'),
('03', 'Melisa Amador', '', '0000', '2000.00', '', 'IN'),
('04', 'Gladys de lito', '', '', '1000.00', '', 'IN'),
('05', 'Ramon de Moncha', '', '', '200.00', '', 'IN'),
('06', 'Merci', '', '0006', '300.00', '', 'IN'),
('07', 'Seylin', '', '0003', '300.00', '', 'IN'),
('08', 'Fany Diaz', '', '', '100.00', '', 'IN'),
('09', 'Denis zelaya', '97516054', '', '1000.00', '', 'IN'),
('10', 'Jeny de Lolita', '', '', '200.00', '', 'IN'),
('11', 'Bertita', '', '', '200.00', '', 'IN'),
('12', 'pastora', '', '', '200.00', '', 'IN'),
('13', 'Gerardo de lito', '', '', '1500.00', '', 'IN'),
('14', 'melissa nuera de lolita', '', '', '300.00', '', 'IN'),
('15', 'nohemy de lolita', '', '', '300.00', 'credito de productos varios', 'IN'),
('16', 'suyapa de lolita', '', '', '300.00', '', 'IN'),
('17', 'Mandina de merci', '', '', '100.00', '', 'IN'),
('18', 'Hija de lolita', '', '', '300.00', 'la muchacha que trabajaba en donde mundi', 'IN'),
('19', 'Nely de Antonio', '', '', '100.00', '', 'IN'),
('20', 'Lolita (Dina dolores Carias)', 'no def', '', '100.00', '', 'IN'),
('21', 'Laura hermana de Carlitos', '0000', '', '100.00', '', 'IN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arinvc`
--

CREATE TABLE `arinvc` (
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dstar` date NOT NULL,
  `dend` date NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `nsalesamt` decimal(10,2) NOT NULL,
  `ntaxamt` decimal(10,2) NOT NULL,
  `ndesamt` decimal(10,2) NOT NULL,
  `nbalance` decimal(10,2) NOT NULL,
  `ntc` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armedm`
--

CREATE TABLE `armedm` (
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `csigno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arresp`
--

CREATE TABLE `arresp` (
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `mtels` text COLLATE utf8_spanish_ci NOT NULL,
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cruc` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `nbalance` decimal(10,2) NOT NULL,
  `nbuyamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ndays` int(3) NOT NULL DEFAULT '0',
  `llunes` tinyint(1) NOT NULL DEFAULT '0',
  `lmartes` tinyint(1) NOT NULL DEFAULT '0',
  `lmiercoles` tinyint(1) NOT NULL DEFAULT '0',
  `ljueves` tinyint(1) NOT NULL DEFAULT '0',
  `lviernes` tinyint(1) NOT NULL DEFAULT '0',
  `lsabado` tinyint(1) NOT NULL DEFAULT '0',
  `ldomingo` tinyint(1) NOT NULL DEFAULT '0',
  `fecha` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arresp`
--

INSERT INTO `arresp` (`crespno`, `cfullname`, `cstatus`, `mdirecc`, `mnotas`, `mtels`, `cctaid`, `cruc`, `cfoto`, `nbalance`, `nbuyamt`, `ndays`, `llunes`, `lmartes`, `lmiercoles`, `ljueves`, `lviernes`, `lsabado`, `ldomingo`, `fecha`, `hora`, `cuserid`) VALUES
('01', 'Luis Enrique L.', 'OP', 'Empresa Dinan', 'el sr. se parece a Cantinflas,\r\nPASA LOS VIERNES.\r\n(churros)', '32521881', '', 'Dinan', '../photos/otras/IMG_20200605_122512.jpg', '0.00', '0.00', 1, 0, 0, 0, 0, 1, 0, 0, '', '', ''),
('02', 'Jose Mendoza', 'OP', '', 'Compramos Galletas Chiki, leche seteco , Avena\r\nViene los Lunes, (Viernes alternativo )', '95728570', '', 'CODIS', '../photos/otras/IMG_20200605_145054.jpg', '0.00', '0.00', 0, 1, 0, 0, 0, 1, 0, 0, '', '', ''),
('03', 'Abastecedora Domis - Salama.', 'OP', ' 20 mts sur del Registro Civil de Salama.', ' ', '9710-1892', '', 'Contacto Paola', '', '0.00', '0.00', 0, 1, 1, 1, 1, 1, 0, 0, '', '', ''),
('04', 'Las Delicias - Carretera Juticalpa', 'OP', ' Carretera a Juticalpa', ' compra de quesos y mantequillas.', '9783-5147', '', ' Tatiana (dueña)', '../photos/otras/', '0.00', '0.00', 0, 0, 0, 0, 0, 0, 0, 0, '', '', ''),
('05', 'marlon distribuidora pepsi', 'OP', ' 100 metros parque, de salama', ' ', '95979121', '', '', '', '0.00', '0.00', 0, 1, 1, 1, 1, 1, 0, 0, '', '', ''),
('06', 'keydy mantequilla silca', 'OP', ' colonia Juan Jose, entrada a salama', ' ', '96288436', '', '', '../photos/otras/', '0.00', '0.00', 0, 0, 0, 0, 0, 0, 0, 0, '', '', ''),
('07', 'Panadero Pickup Toyota Gris', 'OP', '', '', 'undefined', '', '', '', '0.00', '0.00', 0, 1, 0, 0, 0, 1, 0, 0, '', '', ''),
('08', 'Agua Gualiqueme', 'OP', ' ', ' ', '2222222', 'OP', '', '', '0.00', '0.00', 0, 1, 0, 0, 1, 0, 0, 0, '', '', ''),
('09', 'Carmelina Torrez (Prestamos)', 'OP', ' ', ' ', 'undefined', '', '', '../photos/otras/', '0.00', '0.00', 0, 0, 0, 0, 0, 0, 0, 0, '', '', ''),
('10', 'Dennis Herrera (Panaderia Kilos)', 'OP', ' pasan martes y viernes 32521881', ' ', '32521881', '', '', '../photos/otras/10.jpg', '0.00', '0.00', 0, 0, 1, 0, 0, 1, 0, 0, '', '', ''),
('11', 'Marcos Ortes (Embutidos)', 'OP', 'Cada 15 días Miércoles\r\ntelefono 33793338', ' ', '33793338', '', '', '../photos/otras/11.jpg', '0.00', '0.00', 0, 0, 0, 1, 0, 0, 0, 0, '', '', ''),
('12', 'Huevos', 'OP', ' ', ' ', 'undefined', '', '', '', '0.00', '0.00', 0, 0, 0, 0, 1, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arserm`
--

CREATE TABLE `arserm` (
  `cservno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `ncost` decimal(10,2) NOT NULL,
  `nprice` decimal(10,2) NOT NULL,
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` text COLLATE utf8_spanish_ci NOT NULL,
  `lupdonhand` tinyint(1) NOT NULL,
  `lallowneg` tinyint(1) NOT NULL,
  `nlastcost` decimal(10,2) NOT NULL,
  `nprice1` decimal(10,2) NOT NULL,
  `nprice2` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arserm`
--

INSERT INTO `arserm` (`cservno`, `cdesc`, `ncost`, `nprice`, `ctserno`, `cstatus`, `cmedno`, `crespno`, `mnotas`, `cfoto`, `lupdonhand`, `lallowneg`, `nlastcost`, `nprice1`, `nprice2`) VALUES
('01', 'Leche Sula', '13.00', '15.00', '', '', '', '', '', '', 0, 0, '0.00', '0.00', '0.00'),
('02', 'Maseca', '8.33', '10.00', '', '', '', '', '', '', 0, 0, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arsetup`
--

CREATE TABLE `arsetup` (
  `ninvno` int(10) NOT NULL,
  `nrecno` int(10) NOT NULL,
  `nadjno` int(10) NOT NULL,
  `nncno` int(10) NOT NULL,
  `nndno` int(10) NOT NULL,
  `ncotno` int(10) NOT NULL,
  `ncashno` int(10) NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `minvno` text COLLATE utf8_spanish_ci NOT NULL,
  `mestados` text COLLATE utf8_spanish_ci NOT NULL,
  `mcoti` text COLLATE utf8_spanish_ci NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `carsetup` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `ctypcost` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctaxproc` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `linvno` tinyint(1) NOT NULL,
  `lestados` tinyint(1) NOT NULL,
  `lcoti` tinyint(1) NOT NULL,
  `ninvlinmax` int(2) NOT NULL,
  `ncashamt` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arsetup`
--

INSERT INTO `arsetup` (`ninvno`, `nrecno`, `nadjno`, `nncno`, `nndno`, `ncotno`, `ncashno`, `cwhseno`, `minvno`, `mestados`, `mcoti`, `ccustno`, `cpaycode`, `ccateno`, `carsetup`, `ctypcost`, `ctaxproc`, `linvno`, `lestados`, `lcoti`, `ninvlinmax`, `ncashamt`) VALUES
(1, 0, 1, 1, 1, 1, 1, '', '\r\n', '', '', '00', '', '', '', 'PR', 'IN', 0, 0, 0, 25, '200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artcas`
--

CREATE TABLE `artcas` (
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cvtype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid1` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid2` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid3` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid4` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid5` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nday` int(3) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artran`
--

CREATE TABLE `artran` (
  `cuid` int(10) NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ctype` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'IN',
  `cstatus` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `artran`
--

INSERT INTO `artran` (`cuid`, `ccustno`, `dtrndate`, `namount`, `mnotas`, `ctype`, `cstatus`, `cuserid`, `fecha`, `hora`) VALUES
(27, '00', '2020-05-25', '36.00', '1 azucar, 3 cafe, 2 semitas de 3 , 5 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(28, '00', '2020-05-25', '8.00', '2 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(29, '01', '2020-05-25', '30.00', 'Venta de Aloe ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(30, '00', '2020-05-25', '40.00', 'Mantequilla ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(31, '00', '2020-05-25', '50.00', 'coca 2 litros ,\r\n10 vasos de plastico ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(32, '00', '2020-05-25', '6.00', '3 semitas de 2 ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(33, '00', '2020-05-25', '15.00', '1 leche sula, \r\nangeles la lleva pero no hay cambio talves haya que apuntarla.', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(34, '00', '2020-05-25', '100.00', '1 manzanilla\r\n10 de copetines\r\n6 huevos\r\n1 escoba 40\r\n1 bolsa de semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(35, '00', '2020-05-25', '3.00', '3 juguitos de 1', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(36, '00', '2020-05-25', '1.00', '1 bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(37, '02', '2020-05-25', '20.00', '1 maseca de 2 lbrs', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(38, '00', '2020-05-25', '4.00', '1 confites sicis\r\n2 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(39, '03', '2020-05-25', '27.00', '1 jugo la granja\r\n1 leche ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(40, '00', '2020-05-25', '10.00', '2 jugos YA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(41, '00', '2020-05-25', '8.00', '2 shammpoo ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(42, '00', '2020-05-25', '10.00', '5 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(43, '00', '2020-05-25', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(44, '00', '2020-05-25', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(45, '00', '2020-05-25', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(46, '00', '2020-05-25', '10.00', '5 panes de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(47, '00', '2020-05-25', '2.00', 'una agua', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(48, '00', '2020-05-25', '11.00', '2 hielo\r\n1 jugo Ya', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(49, '00', '2020-05-25', '5.00', '4 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(50, '00', '2020-05-25', '2.00', 'semita 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(51, '00', '2020-05-25', '4.00', '4 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(52, '00', '2020-05-25', '3.00', '1CAPI, 1 BOMBA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(53, '00', '2020-05-25', '5.00', 'juguitos 5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(54, '00', '2020-05-25', '68.00', '4 malteadas sula', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(55, '03', '2020-05-25', '8.00', 'angeles 2 shampoo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(56, '00', '2020-05-25', '12.00', '12 polvorones', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(57, '03', '2020-05-25', '20.00', '2 chorisitos en bolsa', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(58, '00', '2020-05-25', '29.00', '1 malteada\r\n1 sofrito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(59, '00', '2020-05-25', '5.00', '1 panadol', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(60, '00', '2020-05-25', '11.00', '1 libra de azucar', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(61, '01', '2020-05-25', '-30.00', 'cancela aloe', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(62, '03', '2020-05-25', '-55.00', 'cancelacion varios', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(63, '03', '2020-05-25', '52.00', 'compra de una coca 3 litros', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(64, '00', '2020-05-25', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(65, '00', '2020-05-25', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(66, '00', '2020-05-25', '30.00', '2 leche sula', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(67, '00', '2020-05-25', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(68, '04', '2020-05-25', '24.00', 'bolsa de pan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(69, '03', '2020-05-25', '5.00', 'taquerito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(70, '00', '2020-05-25', '1.00', 'bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(71, '05', '2020-05-25', '52.00', 'caca 3 litrs\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(72, '03', '2020-05-25', '7.00', 'jumypups', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(73, '03', '2020-05-25', '12.00', '3 huevos - angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(74, '00', '2020-05-25', '10.00', 'sopa', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(75, '00', '2020-05-25', '145.00', '1 pepsi 3lt\r\n1 lb mantequilla\r\n1 queso frijol', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(76, '00', '2020-05-25', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(77, '00', '2020-05-25', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(78, '00', '2020-05-25', '128.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(79, '00', '2020-05-25', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(80, '00', '2020-05-25', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(81, '00', '2020-05-25', '31.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(82, '06', '2020-05-25', '112.00', '2 mountain 14\r\nyumi 7\r\ncapy 2\r\nchorizo 1lb 40\r\nCocoa 35', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(83, '03', '2020-05-25', '7.00', 'yumi pop', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(84, '00', '2020-05-25', '22.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(85, '00', '2020-05-25', '12.00', '8 juguitos 2 capis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(86, '00', '2020-05-25', '1.00', '1 sicis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(87, '00', '2020-05-25', '18.00', 'Venta de 1 bolsita de chorizo 2 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(88, '00', '2020-05-25', '14.00', 'coca de 14 ..quede debiendo 1 lps a carlitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(89, '00', '2020-05-26', '12.00', 'semitas de 3, 1 gusanito\r\n', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(90, '00', '2020-05-26', '14.00', '1 HUEVO 5 SEMITAS 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(91, '00', '2020-05-26', '1.00', '1 BOMBA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(92, '00', '2020-05-26', '22.00', '2 LB AZUCAR', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(93, '00', '2020-05-26', '13.00', '10 pan de 1 ,1 cafe', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(94, '00', '2020-05-26', '14.00', '14 panes', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(95, '02', '2020-05-26', '11.00', 'azucar 1 lb', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(96, '00', '2020-05-26', '2.00', 'confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(97, '00', '2020-05-26', '2.00', '1 juguito 1 bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(98, '00', '2020-05-26', '2.00', 'semita', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(99, '00', '2020-05-26', '2.00', 'juguitos rojos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(100, '00', '2020-05-26', '8.00', 'uvita', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(101, '00', '2020-05-26', '64.00', '2 gatorade 1 raptor', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(102, '00', '2020-05-26', '2.00', 'capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(103, '03', '2020-05-26', '8.00', 'jugo de 8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(104, '00', '2020-05-26', '6.00', 'tan y bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(105, '00', '2020-05-26', '15.00', '3 huevos y 3 panes ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(106, '00', '2020-05-26', '10.00', 'jugo', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(107, '00', '2020-05-26', '2.00', '1 algodon\r\n1 cubitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(108, '00', '2020-05-26', '13.00', '12 sofrito\r\n1 cubitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(109, '00', '2020-05-26', '2.00', 'confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(110, '00', '2020-05-26', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(111, '00', '2020-05-26', '7.00', 'semita 3 4juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(112, '00', '2020-05-26', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(113, '03', '2020-05-26', '40.00', '1 coca de 2 litros', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(114, '01', '2020-05-26', '182.00', '1 molida 56,shorisos 20,semitas 24,pan 18,galleta 24,mant 40\r\n\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(115, '00', '2020-05-26', '20.00', '5 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(116, '00', '2020-05-26', '50.00', 'pepsi 3 lt', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(117, '00', '2020-05-26', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(118, '01', '2020-05-26', '10.00', '10 galletas\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(119, '01', '2020-05-26', '-7.00', 'cuenta de las galletas', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(120, '00', '2020-05-26', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(121, '07', '2020-05-26', '27.00', 'pepsi 1.5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(122, '06', '2020-05-26', '40.00', '1 pepsi 27, 1 chiky 5, jugo 8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(123, '00', '2020-05-26', '6.00', 'semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(124, '00', '2020-05-26', '50.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(126, '00', '2020-05-26', '40.00', 'banana', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(127, '00', '2020-05-26', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(128, '00', '2020-05-26', '42.00', '1 coca 30\r\n6 pan blanco 12', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(129, '00', '2020-05-26', '14.00', 'mointan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(130, '00', '2020-05-26', '27.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(131, '03', '2020-05-26', '1.00', '1 bombon', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(132, '00', '2020-05-26', '80.00', '2 lb mantequilla', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(133, '00', '2020-05-26', '7.00', 'capi y taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(134, '00', '2020-05-26', '17.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(135, '00', '2020-05-26', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(136, '00', '2020-05-26', '52.00', 'pepsi 3 lt', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(137, '00', '2020-05-26', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(138, '00', '2020-05-26', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(139, '00', '2020-05-26', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(140, '00', '2020-05-26', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(141, '08', '2020-05-26', '32.00', '2 yumipups 1 coca de 18', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(142, '00', '2020-05-26', '5.00', '3 juguitos y 1 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(143, '00', '2020-05-26', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(144, '00', '2020-05-26', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(145, '00', '2020-05-26', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(146, '00', '2020-05-26', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(147, '00', '2020-05-26', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(148, '00', '2020-05-26', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(149, '00', '2020-05-26', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(150, '00', '2020-05-26', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(151, '02', '2020-05-26', '22.00', 'pepsi de 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(152, '00', '2020-05-26', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(153, '00', '2020-05-26', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(154, '03', '2020-05-26', '35.00', 'mantequilla 20\r\nmortadela 15', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(155, '00', '2020-05-26', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(157, '00', '2020-05-27', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(158, '00', '2020-05-27', '11.00', 'azucar lb', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(159, '00', '2020-05-27', '20.00', 'mantequilla 1/2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(160, '00', '2020-05-27', '74.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(161, '00', '2020-05-27', '6.00', '3 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(162, '00', '2020-05-27', '3.00', 'cafe', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(163, '00', '2020-05-27', '1.00', 'bombon', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(164, '00', '2020-05-27', '16.00', 'jugo de lata y 6 besitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(165, '00', '2020-05-27', '44.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(166, '00', '2020-05-27', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(167, '03', '2020-05-27', '62.00', 'coca 2lt 40 margarina 6 salsa dulce 10 marmelos 6', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(168, '00', '2020-05-27', '9.00', 'yumi y otros', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(169, '00', '2020-05-27', '14.00', 'coca 14', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(170, '00', '2020-05-27', '27.00', 'pepsi 27', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(171, '00', '2020-05-27', '50.00', 'media quezo y mantequilla', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(172, '09', '2020-05-27', '44.00', '2 arros 22 \r\nraptor 20\r\n2 cubitos 2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(173, '00', '2020-05-27', '20.00', '10 extremeños', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(174, '00', '2020-05-27', '21.00', '2 capi 1 jugo la granja 1 chiqui', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(175, '00', '2020-05-27', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(176, '00', '2020-05-27', '5.00', 'tan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(177, '03', '2020-05-27', '8.00', 'juguito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(178, '00', '2020-05-27', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(179, '00', '2020-05-27', '45.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(180, '00', '2020-05-27', '4.00', 'pan ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(181, '03', '2020-05-27', '7.00', 'yumi', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(182, '03', '2020-05-27', '-5.00', 'oscarito dio 5', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(183, '00', '2020-05-27', '17.00', 'ace y suavitel', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(184, '03', '2020-05-27', '7.00', 'shampoo ,1 agua', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(185, '03', '2020-05-27', '7.00', '1 yummy pops angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(186, '00', '2020-05-27', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(187, '00', '2020-05-27', '7.00', 'yumipups', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(188, '00', '2020-05-28', '37.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(189, '03', '2020-05-28', '20.00', '2 bolsas de chorizo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(190, '00', '2020-05-27', '154.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(191, '03', '2020-05-27', '32.00', '2 leches y churro', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(192, '00', '2020-05-27', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(193, '00', '2020-05-28', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(194, '03', '2020-05-28', '11.00', 'y bolsita chorizo y juguito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(195, '01', '2020-05-28', '-185.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(196, '01', '2020-05-01', '393.00', 'provision para el mes', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(197, '02', '2020-05-24', '288.00', 'provicion al mes de productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(198, '10', '2020-05-24', '167.00', 'saldo pendiente de deuda', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(199, '00', '2020-05-28', '27.00', 'pepsi 1.5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(200, '00', '2020-05-28', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(201, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(202, '03', '2020-05-28', '30.00', 'coca de 30', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(203, '07', '2020-05-28', '36.00', '4 huevos 2 lbs  maseca 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(204, '00', '2020-05-28', '50.00', '1lb mortadela ,5 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(205, '00', '2020-05-28', '7.00', '3 juguitos y 2 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(206, '00', '2020-05-28', '5.00', '2 juguitos 3 besitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(207, '00', '2020-05-28', '5.00', 'tank', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(208, '00', '2020-05-28', '27.00', 'pepsi 1.5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(209, '07', '2020-05-28', '17.00', '2 hielo 1/4mantequilla', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(210, '03', '2020-05-28', '5.00', 'confites', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(211, '00', '2020-05-28', '6.00', 'jabon de lavar', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(212, '00', '2020-05-28', '12.00', 'sopa instantanea', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(213, '00', '2020-05-28', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(214, '00', '2020-05-28', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(215, '03', '2020-05-28', '3.00', 'hielo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(216, '11', '2020-05-28', '20.00', 'toalla sanitaria', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(217, '00', '2020-05-28', '53.00', '3 azucar 2 shampoo 5 semitas 1 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(218, '00', '2020-05-28', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(219, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(220, '00', '2020-05-28', '42.00', 'pepsi 27 2 capi 1 oreon 4 confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(221, '00', '2020-05-28', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(222, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(224, '12', '2020-05-24', '162.00', 'saldo inicial', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(225, '00', '2020-05-28', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(226, '00', '2020-05-28', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(227, '00', '2020-05-28', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(228, '00', '2020-05-28', '177.00', 'Vta a Lito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(229, '07', '2020-05-28', '115.00', 'aceite , chorizo, huevos, queso, polvorones', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(230, '00', '2020-05-28', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(231, '00', '2020-05-28', '1.00', 'besito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(232, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(233, '03', '2020-05-28', '26.00', 'montain 14 , yumipup 7, galleta 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(234, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(235, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(236, '00', '2020-05-28', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(237, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(238, '13', '2020-05-24', '298.00', 'Venta al credito de productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(239, '00', '2020-05-28', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(240, '00', '2020-05-28', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(241, '00', '2020-05-28', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(242, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(243, '00', '2020-05-28', '17.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(244, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(245, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(246, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(247, '00', '2020-05-28', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(248, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(249, '00', '2020-05-29', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(250, '00', '2020-05-29', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(251, '00', '2020-05-29', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(252, '00', '2020-05-29', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(253, '14', '2020-05-24', '379.00', 'credito de varios productos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(254, '15', '2020-05-24', '379.00', 'credito de productos ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(255, '00', '2020-05-29', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(256, '00', '2020-05-29', '26.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(257, '00', '2020-05-29', '10.00', '2 orchatas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(258, '15', '2020-05-29', '2.00', 'un huevo paga 2 ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(259, '00', '2020-05-29', '2.00', 'un huevo ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(260, '00', '2020-05-29', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(261, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(262, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(263, '00', '2020-05-29', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(264, '02', '2020-05-29', '25.00', 'mantequilla 20, clavo de olor 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(265, '00', '2020-05-29', '37.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(266, '00', '2020-05-29', '5.00', 'marmelos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(267, '03', '2020-05-29', '73.00', '9 semitas 2, 2 cafes 3,2 arroz 11,pepsi 27', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(268, '00', '2020-05-29', '51.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(269, '00', '2020-05-29', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(270, '00', '2020-05-29', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(271, '00', '2020-05-29', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(272, '03', '2020-05-29', '4.00', 'shampoo angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(273, '03', '2020-05-29', '55.00', 'libra de queso ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(274, '03', '2020-05-29', '57.00', '2 jugo de lata 10, 1 leche 15, 2lb azucar 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(275, '03', '2020-05-29', '17.00', '2 juguitos ,7,8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(276, '00', '2020-05-29', '125.00', 'asistin 35,cloro 28,18 ace,escoba 44', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(277, '00', '2020-05-29', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(278, '13', '2020-05-29', '127.00', 'jabon 22,\r\nj. platos 12,\r\nsal 2,\r\nfosforos 1,\r\npan 24,\r\n2 shampo 8,\r\n3 suavitel 30,\r\n2 azucar 22,\r\ncafe 6', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(279, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(280, '00', '2020-05-29', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(281, '00', '2020-05-29', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(282, '00', '2020-05-29', '57.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(283, '00', '2020-05-29', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(284, '00', '2020-05-29', '78.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(285, '15', '2020-05-29', '-381.00', 'Venta de contado productos varios', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(286, '00', '2020-05-29', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(287, '00', '2020-05-29', '46.00', '6 chiqui y 2 juguitos caja', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(288, '00', '2020-05-29', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(289, '07', '2020-05-01', '887.00', 'Saldo inicial ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(290, '00', '2020-05-29', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(291, '15', '2020-05-29', '162.00', 'ceteco 90, cereal 50, azucar 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(292, '00', '2020-05-29', '6.00', 'cafes', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(293, '00', '2020-05-29', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(294, '00', '2020-05-29', '7.00', 'juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(295, '03', '2020-05-24', '-23.00', 'ajuste de saldo de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(296, '00', '2020-05-30', '20.00', 'raptor', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(297, '15', '2020-05-30', '14.00', 'semitas 4 y pegaloca 10', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(298, '15', '2020-05-30', '-12.00', 'abona a cuenta de pegaloca y queda deviendo 2 lps', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(299, '00', '2020-05-30', '2.00', 'juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(300, '00', '2020-05-30', '10.00', 'alcazelser', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(301, '00', '2020-05-30', '47.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(302, '15', '2020-05-30', '64.00', 'sofrito 12, coca 3lt 52', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(303, '00', '2020-05-30', '2.00', 'besito y juguito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(304, '00', '2020-05-30', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(305, '00', '2020-05-30', '29.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(306, '00', '2020-05-30', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(307, '00', '2020-05-30', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(308, '00', '2020-05-30', '6.00', 'tang y juguito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(309, '00', '2020-05-30', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(310, '00', '2020-05-30', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(311, '15', '2020-05-30', '-2.00', 'cancela la goma loca', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(312, '15', '2020-05-30', '6.00', 'margarina', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(313, '00', '2020-05-30', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(314, '00', '2020-05-30', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(315, '00', '2020-05-30', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(316, '00', '2020-05-30', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(317, '00', '2020-05-30', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(318, '00', '2020-05-30', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(319, '02', '2020-05-30', '12.00', '3 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(320, '00', '2020-05-30', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(321, '00', '2020-05-30', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(322, '00', '2020-05-30', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(323, '00', '2020-05-30', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(324, '15', '2020-05-30', '44.00', 'escoba', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(325, '00', '2020-05-30', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(326, '00', '2020-05-31', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(327, '00', '2020-05-31', '49.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(328, '00', '2020-05-31', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(329, '00', '2020-05-31', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(330, '16', '2020-05-01', '171.00', 'saldo inicial \r\npepsi 3 litros 2 cocas 3 litros una maleatda 5 pan blanco', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(331, '16', '2020-05-31', '10.00', '5 pan blancos ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(332, '00', '2020-05-31', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(333, '00', '2020-05-31', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(334, '00', '2020-05-31', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(335, '03', '2020-05-31', '20.00', 'mantequilla 1/2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(336, '00', '2020-05-31', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(337, '00', '2020-05-31', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(338, '00', '2020-05-31', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(339, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(340, '00', '2020-05-31', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(341, '00', '2020-05-31', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(342, '00', '2020-05-31', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(343, '00', '2020-05-31', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(344, '00', '2020-05-31', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(345, '16', '2020-05-31', '27.00', 'fresco 27', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(346, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(347, '00', '2020-05-31', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(348, '00', '2020-05-31', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(349, '00', '2020-05-31', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(350, '00', '2020-05-31', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(351, '03', '2020-05-31', '7.00', 'churro angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(352, '00', '2020-05-31', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(353, '00', '2020-05-31', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(354, '00', '2020-05-31', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(355, '00', '2020-05-31', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(356, '00', '2020-05-31', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(357, '03', '2020-05-31', '15.00', 'media de mortadela', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(358, '00', '2020-05-31', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(359, '00', '2020-05-31', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(360, '15', '2020-05-31', '52.00', '52 coca', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(361, '00', '2020-05-31', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(362, '00', '2020-05-31', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(363, '00', '2020-05-31', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(364, '00', '2020-05-31', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(365, '00', '2020-05-31', '55.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(366, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(367, '02', '2020-06-01', '42.00', 'pepsi 22, 20 mantequilla', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(368, '07', '2020-06-01', '-1082.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(369, '00', '2020-06-01', '20.00', '1 libra arroz 15 , cubitos 5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(370, '00', '2020-06-01', '4.00', 'capy y 2 juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(371, '00', '2020-06-01', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(372, '00', '2020-06-01', '27.00', 'coca', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(373, '00', '2020-06-01', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(374, '00', '2020-06-01', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(375, '00', '2020-06-01', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(376, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(377, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(378, '01', '2020-06-01', '14.00', '1 BABANA', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(379, '00', '2020-06-01', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(380, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(381, '00', '2020-06-01', '80.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(382, '00', '2020-06-01', '31.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(383, '00', '2020-06-01', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(384, '00', '2020-06-01', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(385, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(386, '00', '2020-06-01', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(387, '00', '2020-06-01', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(388, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(389, '00', '2020-06-01', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(390, '00', '2020-06-01', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(391, '00', '2020-06-01', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(392, '07', '2020-06-01', '47.00', 'PEPSI 27 , MANTEQUILLA 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(393, '15', '2020-06-01', '52.00', 'COCA 3LT', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(394, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(395, '00', '2020-06-01', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(396, '00', '2020-06-01', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(397, '18', '2020-06-01', '15.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(398, '00', '2020-06-01', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(399, '00', '2020-06-01', '55.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(400, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(401, '00', '2020-06-01', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(402, '00', '2020-06-01', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(403, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(404, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(405, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(406, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(407, '00', '2020-06-01', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(408, '00', '2020-06-02', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(409, '00', '2020-06-02', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(410, '13', '2020-06-02', '59.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(411, '00', '2020-06-02', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(412, '00', '2020-06-02', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(413, '00', '2020-06-02', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(414, '07', '2020-06-02', '61.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(415, '00', '2020-06-02', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(416, '00', '2020-06-02', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(417, '00', '2020-06-02', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(418, '00', '2020-06-02', '77.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(419, '00', '2020-06-02', '58.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(420, '01', '2020-06-02', '11.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(421, '01', '2020-06-02', '2.00', 'jemita de 2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(422, '06', '2020-06-02', '-152.00', 'cancelacion de cuenta pendiente', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(423, '17', '2020-06-02', '40.00', 'chorizo y 5 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(424, '07', '2020-06-02', '59.00', '.5 quesillo 20, .5 queso 28, salda dulce 11.', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(425, '00', '2020-06-02', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(426, '01', '2020-06-02', '-11.00', 'abono a cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(427, '00', '2020-06-02', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(428, '00', '2020-06-02', '83.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(429, '00', '2020-06-02', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(430, '00', '2020-06-02', '49.00', '3 sivas, 2 jugos de granja 12', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(431, '00', '2020-06-03', '1.00', 'caja de fosforos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(432, '00', '2020-06-03', '72.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(433, '00', '2020-06-03', '118.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(434, '00', '2020-06-03', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(435, '00', '2020-06-03', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(436, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(437, '00', '2020-06-03', '2.00', 'sicsis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(438, '00', '2020-06-03', '39.00', 'MANTAQUILLA , JUGO LEYDE ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(439, '00', '2020-06-03', '40.00', 'QUESILLO', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(440, '00', '2020-06-03', '10.00', 'Copetines', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(441, '00', '2020-06-03', '4.00', 'huevo', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(442, '12', '2020-06-03', '27.00', 'media de mortadela y 1 de tallarines', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(443, '00', '2020-06-03', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(444, '00', '2020-06-03', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(445, '00', '2020-06-03', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(446, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(447, '03', '2020-06-03', '20.00', 'hidrocrema, cepillo ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(448, '03', '2020-06-03', '2.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(449, '00', '2020-06-03', '64.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(450, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(451, '00', '2020-06-03', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(452, '00', '2020-06-03', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(453, '00', '2020-06-03', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(454, '00', '2020-06-03', '33.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(455, '00', '2020-06-03', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(456, '03', '2020-06-03', '20.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(457, '03', '2020-06-03', '12.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(458, '03', '2020-06-03', '8.00', 'juguito oscarito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(459, '00', '2020-06-03', '5.00', 'TAJADITA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(460, '00', '2020-06-03', '4.00', 'BOMBONES', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(461, '03', '2020-06-03', '1.00', 'BOMBON A OSCARITO', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(462, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(463, '07', '2020-06-03', '-231.00', 'Cancelacion', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(464, '00', '2020-06-03', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(465, '00', '2020-06-03', '5.00', 'Taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(466, '00', '2020-06-03', '35.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(467, '01', '2020-06-03', '373.00', 'productos varios para el mes.', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(468, '03', '2020-06-03', '2.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(469, '03', '2020-06-03', '15.00', 'jugo de lata y 5 juguitos de lempira', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(470, '01', '2020-06-03', '-393.00', 'abono a cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(471, '00', '2020-06-03', '85.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(472, '00', '2020-06-03', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(473, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000');
INSERT INTO `artran` (`cuid`, `ccustno`, `dtrndate`, `namount`, `mnotas`, `ctype`, `cstatus`, `cuserid`, `fecha`, `hora`) VALUES
(474, '00', '2020-06-03', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(475, '00', '2020-06-03', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(476, '00', '2020-06-03', '80.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(477, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(478, '01', '2020-06-03', '9.00', 'agua 3', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(479, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(480, '00', '2020-06-03', '25.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(481, '19', '2020-06-03', '37.00', '1 raptor , malteada de 17\r\npagara el 4/6/2020', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(482, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(483, '00', '2020-06-04', '74.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(484, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(485, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(486, '00', '2020-06-04', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(487, '00', '2020-06-04', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(488, '00', '2020-06-04', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(489, '00', '2020-06-04', '26.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(490, '00', '2020-06-04', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(491, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(492, '01', '2020-06-04', '130.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(493, '07', '2020-06-04', '28.00', 'media de queso', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(494, '00', '2020-06-04', '256.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(495, '19', '2020-06-04', '-37.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(496, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(497, '00', '2020-06-04', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(498, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(499, '00', '2020-06-04', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(500, '00', '2020-06-04', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(501, '00', '2020-06-04', '54.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(502, '00', '2020-06-04', '45.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(503, '03', '2020-06-04', '10.00', 'taquerito, juguito 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(504, '00', '2020-06-04', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(505, '00', '2020-06-04', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(506, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(507, '00', '2020-06-04', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(508, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(509, '16', '2020-06-04', '20.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(510, '00', '2020-06-04', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(511, '00', '2020-06-04', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(512, '00', '2020-06-04', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(513, '17', '2020-06-04', '-40.00', 'cancelacion de deuda', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(514, '00', '2020-06-04', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(515, '02', '2020-06-04', '-420.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(516, '00', '2020-06-04', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(517, '02', '2020-06-04', '113.00', '', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(518, '02', '2020-06-04', '20.00', 'mantequilla 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(519, '00', '2020-06-04', '10.00', '5 semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(520, '16', '2020-06-04', '20.00', '2 mufles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(521, '00', '2020-06-04', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(522, '00', '2020-06-04', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(523, '00', '2020-06-04', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(524, '00', '2020-06-04', '10.00', 'candela y fresco de 8', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(525, '03', '2020-06-04', '5.00', 'tajaditas', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(526, '03', '2020-06-04', '5.00', 'juguito 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(527, '00', '2020-06-05', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(528, '00', '2020-06-05', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(529, '07', '2020-06-05', '60.00', '2 pollo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(530, '00', '2020-06-05', '37.00', 'varios productos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(531, '00', '2020-06-05', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(532, '00', '2020-06-05', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(533, '00', '2020-06-05', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(534, '00', '2020-06-05', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(535, '00', '2020-06-05', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(536, '00', '2020-06-05', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(537, '03', '2020-06-04', '15.00', 'jugo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(538, '03', '2020-06-04', '-720.00', 'cancelación de deuda', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(539, '03', '2020-06-05', '8.00', 'juguito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(540, '03', '2020-06-05', '6.00', 'semita 3 ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(541, '00', '2020-06-05', '76.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(542, '00', '2020-06-05', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(543, '00', '2020-06-05', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(544, '03', '2020-06-05', '-11.00', 'abono a cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(545, '00', '2020-06-05', '25.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(546, '00', '2020-06-05', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(547, '00', '2020-06-05', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(548, '00', '2020-06-05', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(549, '00', '2020-06-05', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(550, '16', '2020-06-05', '-248.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(551, '16', '2020-06-05', '52.00', 'Coca 3 lts', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(552, '00', '2020-06-05', '45.00', '3 sibas y 2 yumi 2 chiqui', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(553, '00', '2020-06-05', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(554, '00', '2020-06-05', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(555, '00', '2020-06-05', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(556, '00', '2020-06-05', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(557, '02', '2020-06-05', '34.00', 'bolsa de pan y 1 maseca', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(558, '00', '2020-06-05', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(559, '00', '2020-06-05', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(560, '00', '2020-06-05', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(561, '00', '2020-06-05', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(562, '00', '2020-06-05', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(563, '18', '2020-06-05', '-15.00', 'CANCELACION ', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(564, '00', '2020-06-05', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(565, '00', '2020-06-05', '120.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(566, '00', '2020-06-05', '85.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(567, '00', '2020-06-05', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(568, '00', '2020-06-05', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(569, '00', '2020-06-05', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(570, '00', '2020-06-05', '55.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(571, '00', '2020-06-05', '100.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(572, '00', '2020-06-05', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(573, '07', '2020-06-05', '43.00', 'jugo 25, 16 shampoo , besitos 2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(574, '00', '2020-06-05', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(575, '00', '2020-06-05', '37.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(576, '00', '2020-06-06', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(577, '00', '2020-06-06', '40.00', '2 bolsits de chorizo y 5 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(578, '00', '2020-06-06', '78.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(579, '00', '2020-06-06', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(580, '00', '2020-06-06', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(581, '00', '2020-06-06', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(582, '00', '2020-06-06', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(583, '00', '2020-06-06', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(584, '00', '2020-06-06', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(585, '01', '2020-06-06', '90.00', '2 lbs de chuleta', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(586, '00', '2020-06-06', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(587, '00', '2020-06-06', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(588, '00', '2020-06-06', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(589, '00', '2020-06-06', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(590, '03', '2020-06-06', '8.00', 'jugo 8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(591, '00', '2020-06-06', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(592, '02', '2020-06-06', '10.00', 'maseca', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(593, '00', '2020-06-06', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(594, '00', '2020-06-06', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(595, '00', '2020-06-06', '64.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(596, '00', '2020-06-06', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(597, '00', '2020-06-06', '4.00', 'soda', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(598, '00', '2020-06-06', '13.00', 'jugo la granja', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(599, '00', '2020-06-06', '50.00', 'mantequilla , pepsi 1.5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(600, '03', '2020-06-06', '3.00', 'CHURRO', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(601, '16', '2020-06-06', '27.00', 'pepsi 1.5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(602, '00', '2020-06-06', '60.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(603, '00', '2020-06-06', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(604, '00', '2020-06-06', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(605, '00', '2020-06-06', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(606, '00', '2020-06-06', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(607, '00', '2020-06-06', '31.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(608, '00', '2020-06-06', '60.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(609, '00', '2020-06-06', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(610, '00', '2020-06-06', '25.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(611, '00', '2020-06-06', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(612, '00', '2020-06-06', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(613, '00', '2020-06-06', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(614, '00', '2020-06-06', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(615, '00', '2020-06-06', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(616, '00', '2020-06-06', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(617, '00', '2020-06-06', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(618, '00', '2020-06-06', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(619, '00', '2020-06-06', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(620, '00', '2020-06-06', '92.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(621, '00', '2020-06-06', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(622, '01', '2020-06-06', '42.00', 'jugo aloe, 12 lps de pan', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(623, '00', '2020-06-06', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(624, '00', '2020-06-06', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(625, '16', '2020-06-06', '28.00', 'jugo 10, malteada 18', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(626, '00', '2020-06-06', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(627, '00', '2020-06-06', '73.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(628, '00', '2020-06-08', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(629, '00', '2020-06-08', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(630, '00', '2020-06-08', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(631, '00', '2020-06-08', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(632, '00', '2020-06-08', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(633, '00', '2020-06-08', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(634, '04', '2020-06-08', '39.00', 'bolsa de pan y 3 alcaselcer ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(635, '03', '2020-06-08', '21.00', '3 churros y 1 jugo ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(636, '00', '2020-06-08', '144.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(637, '03', '2020-06-08', '30.00', 'queso', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(638, '02', '2020-06-08', '10.00', 'maseca', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(639, '08', '2020-06-08', '27.00', 'fresco', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(640, '00', '2020-06-08', '313.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(641, '00', '2020-06-08', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(642, '00', '2020-06-08', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(643, '00', '2020-06-08', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(644, '00', '2020-06-08', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(645, '00', '2020-06-08', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(646, '00', '2020-06-08', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(647, '00', '2020-06-08', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(648, '00', '2020-06-08', '96.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(649, '00', '2020-06-08', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(650, '02', '2020-06-08', '22.00', 'pepesi', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(651, '00', '2020-06-08', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(652, '00', '2020-06-08', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(653, '16', '2020-06-08', '52.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(654, '01', '2020-06-08', '40.00', 'bnana', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(655, '00', '2020-06-08', '29.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(656, '00', '2020-06-08', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(657, '00', '2020-06-08', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(658, '00', '2020-06-08', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(659, '00', '2020-06-08', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(660, '00', '2020-06-08', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(661, '00', '2020-06-08', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(662, '00', '2020-06-09', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(663, '00', '2020-06-09', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(664, '00', '2020-06-09', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(665, '00', '2020-06-09', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(666, '00', '2020-06-09', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(667, '03', '2020-06-09', '8.00', 'jugo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(668, '00', '2020-06-09', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(669, '00', '2020-06-09', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(670, '00', '2020-06-09', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(671, '00', '2020-06-09', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(672, '00', '2020-06-09', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(673, '20', '2020-06-09', '52.00', 'coca 3\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(674, '00', '2020-06-09', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(675, '00', '2020-06-09', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(676, '00', '2020-06-09', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(677, '00', '2020-06-09', '8.00', 'semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(678, '08', '2020-06-09', '8.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(679, '00', '2020-06-09', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(680, '00', '2020-06-09', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(681, '00', '2020-06-09', '70.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(682, '00', '2020-06-09', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(683, '00', '2020-06-09', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(684, '00', '2020-06-09', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(685, '00', '2020-06-09', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(687, '00', '2020-06-09', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(688, '00', '2020-06-09', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(689, '00', '2020-06-09', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(690, '00', '2020-06-09', '45.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(691, '03', '2020-06-09', '6.00', '6 juguitos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(692, '00', '2020-06-09', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(693, '00', '2020-06-09', '20.00', 'arina y jugo de lata', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(694, '00', '2020-06-09', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(695, '00', '2020-06-09', '60.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(696, '21', '2020-06-09', '40.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(697, '00', '2020-06-09', '60.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(698, '00', '2020-06-09', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(699, '00', '2020-06-09', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(700, '00', '2020-06-09', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(701, '00', '2020-06-09', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(702, '00', '2020-06-09', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(703, '00', '2020-06-09', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(705, '00', '2020-01-01', '53.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(706, '00', '2020-01-01', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(707, '00', '2020-06-09', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(708, '00', '2020-01-01', '53.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(709, '00', '2020-06-10', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(710, '00', '2020-06-10', '29.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(711, '00', '2020-06-10', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(712, '03', '2020-06-10', '15.00', '1 leche', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(713, '03', '2020-06-10', '10.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(714, '00', '2020-06-10', '6.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(715, '00', '2020-06-10', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(716, '00', '2020-06-10', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(717, '00', '2020-06-10', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(718, '03', '2020-06-10', '8.00', '2 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(719, '00', '2020-06-10', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(720, '00', '2020-06-10', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(721, '00', '2020-06-10', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(722, '03', '2020-06-10', '27.00', 'pepsi 1.5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(723, '00', '2020-06-10', '29.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(724, '00', '2020-06-10', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(725, '00', '2020-06-10', '87.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(726, '00', '2020-06-10', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(727, '00', '2020-06-10', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(728, '00', '2020-06-10', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(729, '00', '2020-06-07', '1409.00', 'vta del dia', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(730, '02', '2020-06-07', '12.00', 'venta de credito del 7', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(731, '03', '2020-06-07', '76.00', 'vta de credito del dia 7', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(732, '16', '2020-06-07', '10.00', 'compra del 7 del 6 registrado en sitio web', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(733, '01', '2020-06-10', '-130.00', 'cancelacion de chuleta y banana', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(734, '01', '2020-06-10', '-42.00', 'cancelacion de aloe y otras', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(735, '01', '2020-06-10', '-155.00', 'ajuste de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(736, '01', '2020-06-10', '7.00', 'taquerito y 2 besitos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(737, '00', '2020-06-10', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(738, '00', '2020-06-10', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(739, '00', '2020-06-10', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(740, '00', '2020-06-10', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(741, '00', '2020-06-10', '17.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(742, '00', '2020-06-10', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(743, '00', '2020-06-10', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(744, '00', '2020-06-10', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(745, '00', '2020-06-10', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(746, '07', '2020-06-10', '90.00', 'productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(747, '00', '2020-06-10', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(748, '00', '2020-06-10', '122.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(749, '00', '2020-06-10', '49.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(750, '00', '2020-06-10', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(751, '03', '2020-06-10', '43.00', '7 semitas, pepsi 22, 7 basos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(752, '00', '2020-06-10', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(753, '15', '2020-06-10', '4.00', '2 de cubitos y 2 cominos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(754, '03', '2020-06-10', '4.00', '4 bombos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(755, '00', '2020-06-11', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(756, '00', '2020-06-11', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(757, '00', '2020-06-11', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(758, '03', '2020-06-11', '14.00', 'bananita', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(759, '00', '2020-06-11', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(760, '00', '2020-06-11', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(762, '02', '2020-06-11', '12.00', '3 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(763, '00', '2020-06-11', '66.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(764, '00', '2020-06-11', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(765, '00', '2020-06-11', '54.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(766, '00', '2020-06-11', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(767, '00', '2020-06-11', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(768, '00', '2020-06-11', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(769, '00', '2020-06-11', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(770, '07', '2020-06-11', '37.00', '1 é´so u 2 tajaditas', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(771, '00', '2020-06-11', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(772, '12', '2020-06-11', '40.00', 'coca de 40 para carlitos y debe 10', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(773, '12', '2020-06-11', '-30.00', 'abono a cuenta de pepsi debe 10', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(774, '00', '2020-06-11', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(775, '00', '2020-06-11', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(776, '00', '2020-06-11', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(777, '00', '2020-06-11', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(778, '00', '2020-06-13', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(779, '00', '2020-06-13', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(780, '00', '2020-06-13', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(781, '00', '2020-06-13', '47.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(782, '00', '2020-06-13', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(783, '00', '2020-06-13', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(784, '03', '2020-06-13', '14.00', 'una Uva', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(785, '00', '2020-06-13', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(786, '00', '2020-06-13', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(787, '00', '2020-06-13', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(788, '00', '2020-06-13', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(789, '00', '2020-06-13', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(790, '07', '2020-06-13', '30.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(791, '00', '2020-06-13', '61.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(792, '20', '2020-06-13', '180.00', 'Cadena de Acero Inoxidable', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(793, '00', '2020-06-13', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(794, '00', '2020-06-13', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(795, '01', '2020-06-13', '14.00', 'sofia banana', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(796, '00', '2020-06-13', '34.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(797, '00', '2020-06-13', '22.00', '1 gatorade', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(798, '00', '2020-06-13', '42.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(799, '00', '2020-06-13', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(800, '02', '2020-06-13', '23.00', 'media de mantequilla', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(801, '00', '2020-06-13', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(802, '16', '2020-06-14', '15.00', 'una leche', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(803, '00', '2020-06-14', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(804, '00', '2020-06-14', '112.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(805, '00', '2020-06-14', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(806, '00', '2020-06-14', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(807, '12', '2020-06-14', '36.00', 'Manteca 1 kg', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(808, '00', '2020-06-14', '10.00', 'chorizo en bolsita', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(809, '00', '2020-06-14', '66.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(810, '00', '2020-06-14', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(811, '00', '2020-06-14', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(812, '00', '2020-06-14', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(813, '03', '2020-06-14', '9.00', 'MARGARINA 3 JUGUITOS', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(814, '02', '2020-06-14', '6.00', 'MARGARINA', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(815, '00', '2020-06-14', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(816, '07', '2020-06-14', '22.00', 'pepsi', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(817, '00', '2020-06-14', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(818, '00', '2020-06-14', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(819, '16', '2020-06-14', '52.00', 'coca 3lts', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(820, '00', '2020-06-14', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(821, '00', '2020-06-14', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(822, '00', '2020-06-14', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(823, '00', '2020-06-14', '42.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(824, '00', '2020-06-14', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(825, '00', '2020-06-14', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(826, '01', '2020-06-14', '4.00', 'shampoo para sofia', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(827, '01', '2020-06-14', '2.00', 'bombones', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(828, '00', '2020-06-14', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(829, '00', '2020-06-14', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(830, '00', '2020-06-14', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(831, '00', '2020-06-14', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(832, '00', '2020-06-14', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(833, '00', '2020-06-14', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(834, '00', '2020-06-14', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(835, '00', '2020-06-14', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(836, '00', '2020-06-14', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(837, '00', '2020-06-14', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(838, '00', '2020-06-14', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(839, '00', '2020-06-14', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(840, '07', '2020-06-14', '38.00', 'media de quesillo, 3 tajadas y taco', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(841, '13', '2020-06-14', '82.00', 'Productos Varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(844, '13', '2020-06-14', '28.00', 'media de quezo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(845, '00', '2020-06-14', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(846, '00', '2020-06-14', '25.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artser`
--

CREATE TABLE `artser` (
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arwhse`
--

CREATE TABLE `arwhse` (
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `mtel` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aptran`
--
ALTER TABLE `aptran`
  ADD PRIMARY KEY (`cuid`);

--
-- Indices de la tabla `arcust`
--
ALTER TABLE `arcust`
  ADD PRIMARY KEY (`ccustno`);

--
-- Indices de la tabla `arinvc`
--
ALTER TABLE `arinvc`
  ADD PRIMARY KEY (`cinvno`);

--
-- Indices de la tabla `armedm`
--
ALTER TABLE `armedm`
  ADD PRIMARY KEY (`cmedno`);

--
-- Indices de la tabla `arresp`
--
ALTER TABLE `arresp`
  ADD PRIMARY KEY (`crespno`);

--
-- Indices de la tabla `arserm`
--
ALTER TABLE `arserm`
  ADD PRIMARY KEY (`cservno`);

--
-- Indices de la tabla `artcas`
--
ALTER TABLE `artcas`
  ADD PRIMARY KEY (`cpaycode`);

--
-- Indices de la tabla `artran`
--
ALTER TABLE `artran`
  ADD UNIQUE KEY `cuid` (`cuid`);

--
-- Indices de la tabla `artser`
--
ALTER TABLE `artser`
  ADD PRIMARY KEY (`ctserno`);

--
-- Indices de la tabla `arwhse`
--
ALTER TABLE `arwhse`
  ADD PRIMARY KEY (`cwhseno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aptran`
--
ALTER TABLE `aptran`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `artran`
--
ALTER TABLE `artran`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=847;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
