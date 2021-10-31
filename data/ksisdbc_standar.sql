-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2021 a las 03:28:41
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


drop database if EXISTS ksisdbc;
create database ksisdbc;
use ksisdbc;

DROP TABLE IF EXISTS arwqty;
create table arwqty(
  cuid int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  cwhseno char(10) COLLATE utf8_spanish_ci not null,
  cservno char(20) COLLATE utf8_spanish_ci not null,
  nqtymin decimal(10,2) NOT NULL default 0.00,
  nqtymax decimal(10,2) not null default 0.00,
  cestante char(50) not null default "",
  cbinno char(50) not null default ""
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE arwqty
  ADD KEY `cwhseno` (`cwhseno`),
  ADD KEY `cservno` (`cservno`);

DROP TABLE IF EXISTS aradjm;
CREATE TABLE `aradjm` (
  `cadjno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cmodule` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1' COMMENT '1- requisas , 2- compras',
  `ctrnno` char(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'asiento de diario',
  `mnotasv` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Comentarios sobre anulacion',
  `lvoid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indica si esta anulada o no en convinacion del estado',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `crefno` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `ntc` decimal(10,4) NOT NULL DEFAULT '1.0000',
  `nbuyamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ndescamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ntaxamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nbalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nebuyamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nedescamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `netaxamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nebalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `aradjm`
  ADD PRIMARY KEY (`cadjno`),
  ADD KEY `cwhseno` (`cwhseno`),
  ADD KEY `ccateno` (`ccateno`),
  ADD KEY `crespno` (`crespno`),
  ADD KEY `dtrndate` (`dtrndate`);

DROP TABLE IF EXISTS aradjt;

CREATE TABLE `aradjt` (
  `cuid` int(10) NOT NULL,
  `cadjno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cservno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `ncost` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `ncostu` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `nqty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ntax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ndesc` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `aradjt`
  ADD UNIQUE KEY `cuid` (`cuid`),
  ADD KEY `cadjno` (`cadjno`);


DROP TABLE IF EXISTS arcash;
CREATE TABLE `arcash` (
  `cuid` int(10) NOT NULL,
  `ccashno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arcash`
  ADD PRIMARY KEY (`cuid`);

DROP TABLE IF EXISTS arcasm;
CREATE TABLE `arcasm` (
  `ccashno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `ctrnno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `crefno` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `dtrndate` date NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `ctypedoc` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ntc` decimal(10,4) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` char(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `arcasm`
  ADD PRIMARY KEY (`ccashno`);

DROP TABLE IF EXISTS arcate;
CREATE TABLE `arcate` (
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctypeadj` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'E= entrada, S = salida ,indica si es de entrada o salida',
  `ctypecate` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid_tax` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `lctaresp` tinyint(1) NOT NULL,
  `lexpcont` tinyint(1) NOT NULL,
  `lupdcost` tinyint(1) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arcate`
  ADD PRIMARY KEY (`ccateno`);

DROP TABLE IF EXISTS arcust;
CREATE TABLE `arcust` (
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cname` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `ctel` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `cpasword` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `nlimcrd` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nbbalance` decimal(10,2) NOT NULL,
  `nebalance` decimal(10,2) NOT NULL,
  `nbsalestot` decimal(10,2) NOT NULL,
  `nesalestot` decimal(10,2) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` text COLLATE utf8_spanish_ci NOT NULL,
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `cweb` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cemail` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `dstar` date NOT NULL COMMENT 'fecha en que inicio el cliente',
  `cubino` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arcust`
  ADD PRIMARY KEY (`ccustno`);

DROP TABLE IF EXISTS arinvc;
CREATE TABLE `arinvc` (
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dstar` date NOT NULL,
  `dend` date NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `lvoid` tinyint(1) NOT NULL DEFAULT '0',
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `ctrnno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `ctel` char(10) COLLATE utf8_spanish_ci,
  `crefno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `nsalesamt` decimal(10,2) NOT NULL,
  `ntaxamt` decimal(10,2) NOT NULL,
  `ndesamt` decimal(10,2) NOT NULL,
  `nbalance` decimal(10,2) NOT NULL,
  `nefectivo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ntc` decimal(10,2) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arinvc`
  ADD PRIMARY KEY (`cinvno`),
  ADD KEY `ccustno` (`ccustno`),
  ADD KEY `cpaycode` (`cpaycode`),
  ADD KEY `ctrnno` (`ctrnno`),
  ADD KEY `cwhseno` (`cwhseno`),
  ADD KEY `crespno` (`crespno`);


DROP TABLE IF EXISTS arinvt;
CREATE TABLE `arinvt` (
  `cuid` int(10) NOT NULL,
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cservno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `nqty` int(10) NOT NULL,
  `nprice` decimal(10,2) NOT NULL,
  `ncost` decimal(10,4) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ntax` decimal(10,2) NOT NULL,
  `ndesc` decimal(10,2) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arinvt`
  ADD PRIMARY KEY (`cuid`),
  ADD KEY `cinvno` (`cinvno`),
  ADD KEY `cservno` (`cservno`(20));


DROP TABLE IF EXISTS arinvt_tmp;
CREATE TABLE `arinvt_tmp` (
  `cuid` int(11) NOT NULL,
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cservno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `ncost` decimal(10,2) NOT NULL,
  `nprice` decimal(10,2) NOT NULL,
  `nqty` decimal(10,0) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ntax` decimal(10,2) NOT NULL,
  `ndesc` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arinvt_tmp`
  ADD PRIMARY KEY (`cuid`);

DROP TABLE IF EXISTS armedm;
CREATE TABLE `armedm` (
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `csigno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `armedm`
  ADD PRIMARY KEY (`cmedno`);

DROP TABLE IF EXISTS armone;
CREATE TABLE `armone` (
  `cuid` int(10) NOT NULL,
  `dtrndate` date NOT NULL,
  `ntc` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `armone`
  ADD PRIMARY KEY (`cuid`);

DROP TABLE IF EXISTS arpedm;
CREATE TABLE `arpedm` (
  `cpedno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `clotno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ccustno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `cpaycode` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `ntc` decimal(10,2) NOT NULL DEFAULT '1.00',
  `cuserid` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arpedm`
  ADD PRIMARY KEY (`cpedno`);

DROP TABLE IF EXISTS arpedt;
CREATE TABLE `arpedt` (
  `cuid` int(10) NOT NULL,
  `cpedno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cservno` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `nqty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ntax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cuserid` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arpedt`
  ADD UNIQUE KEY `cuid` (`cuid`),
  ADD KEY `cpedno` (`cpedno`),
  ADD KEY `cservno` (`cservno`);

DROP TABLE IF EXISTS arresp;
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
  `ncomision` decimal(10,2) not null default '0.00',
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
ALTER TABLE `arresp`
  ADD PRIMARY KEY (`crespno`);

DROP TABLE IF EXISTS arserm;
CREATE TABLE `arserm` (
  `cservno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc2` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `ncost` decimal(10,2) NOT NULL,
  `nlastcost` decimal(10,2) NOT NULL,
  `nprice` decimal(10,2) NOT NULL,
  `nprice1` decimal(10,2) NOT NULL,
  `nprice2` decimal(10,2) NOT NULL,
  `ntax` decimal(10,2) NOT NULL,
  `ndesc` decimal(10,2) NOT NULL,
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid_c` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid_i` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `citemtype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` text COLLATE utf8_spanish_ci NOT NULL,
  `lallowneg` tinyint(1) NOT NULL,
  `lupdateonhand` tinyint(1) NOT NULL,
  `nminonhand` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arserm`
  ADD PRIMARY KEY (`cservno`);

/* tabla de existencias por bodega que se usa para la configuracion de la ubicacion de los objetos en cada bodega.*/
DROP TABLE IF EXISTS arwqty;
CREATE TABLE arwqty(
  cuid INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  cwhseno char(10) not null,
  cservno char(20) not null,
  nqtymin decimal(10,2) not null default 0.00,
  nqtymax decimal(10,2) not null default 0.00,
  cestante char(10) not null,
  cbinno  char(10) not null,
  mnotas text not null 
)

DROP TABLE IF EXISTS arsetup;
CREATE TABLE `arsetup` (
  `ninvno` int(10) NOT NULL,
  `nrecno` int(10) NOT NULL,
  `nadjno` int(10) NOT NULL,
  `nncno` int(10) NOT NULL,
  `nndno` int(10) NOT NULL,
  `ncotno` int(10) NOT NULL,
  `npedno` int(10) NOT NULL,
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

DROP TABLE IF EXISTS arskit;
CREATE TABLE `arskit` (
  `cuid` int(10) NOT NULL,
  `cservno1` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cservno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `nqty` decimal(10,2) NOT NULL,
  `ncost` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arskit`
  ADD UNIQUE KEY `cuid` (`cuid`);

DROP TABLE IF EXISTS artcas;
CREATE TABLE `artcas` (
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid1` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid2` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid3` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid4` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid5` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nday` int(3) NOT NULL,
  `lvalidcrd` tinyint(1) NOT NULL,
  `lqtypay` tinyint(1) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `artcas`
  ADD PRIMARY KEY (`cpaycode`);

DROP TABLE IF EXISTS artran;
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
ALTER TABLE `artran`
  ADD UNIQUE KEY `cuid` (`cuid`);

DROP TABLE IF EXISTS artser;
CREATE TABLE `artser` (
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `artser`
  ADD PRIMARY KEY (`ctserno`);

DROP TABLE IF EXISTS arubim;
CREATE TABLE `arubim` (
  `cubino` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` text COLLATE utf8_spanish_ci NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `cuserid` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arubim`
  ADD PRIMARY KEY (`cubino`);

DROP TABLE IF EXISTS arwhse;
CREATE TABLE `arwhse` (
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `mtel` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `arwhse`
  ADD PRIMARY KEY (`cwhseno`);

-- AUTO_INCREMENT de las tablas volcadas
ALTER TABLE `aradjt`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arcash`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arinvt`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arinvt_tmp`
  MODIFY `cuid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `armone`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arpedt`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arskit`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `artran`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
