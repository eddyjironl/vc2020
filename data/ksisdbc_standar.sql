SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- drop database if EXISTS ksisdbc;
-- create database ksisdbc;
-- use ksisdbc;


/* detalle de planillas*/
drop table if exists plmast;
  CREATE TABLE plmast (cplano char(10) PRIMARY KEY NOT NULL ,
	cdesc   char(200) default '',
	ctype   char(2) default '',
	ctypemp char(2) default '',
	ctyppay char(2) default '',
	cmonth  char(2) default'',
	cstatus char(2) default '',
	dpay    date null ,
	tstar   DATE null,
	tend    date null ,
	hora    char(8) null ,
  fecha    date null,
  usuario  char(10) DEFAULT ''
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

  
/* DATA PLANILLAS */
 	DROP TABLE if EXISTS plempl;
   create table plempl(
    cempno char(10) PRIMARY KEY NOT NULL ,
    cfullname char(200) default '',
    ccedid char(20) default '',
    dnacday date  default '0000-00-00',
    cmarital char(2) default '',
    csexo char(1) default '',
    mdirecc text,
    mtels text,
    mnotas text  ,
    dstar date default '0000-00-00',
    dend date default '0000-00-00',
    cstatus char(2) default 'OP',
    cdescmot char(100) default '',
    cworkid char(10) default '',
    cdeptno char(10) default '',
    cturno char(10) default '',
    nsalary decimal(10,2) default 0.00,
    nhrate decimal(10,2) default 0.00,
    nhratext decimal(10,2) default 0.00,
    ctypemp char(2) default '',
    ctyppay char(2) default '',
    ctyppay2 char(2) default '',
    nsetpay decimal(10,2)  default 0.00,
    cins char(10) default '',
    lnotausent tinyint(1) DEFAULT 0
	 
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




drop table if exists plturm;
create table plturm(
  cturno  char(10) primary key default '',
  cdesc   char(200) default '',
  mnotas  text default '',
  hora    char(10) NOT NULL,
  fecha   date NOT NULL, 
  usuario char(10) NOT NULL
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists pldepd;
create table pldepd(
  cuid    int(10) AUTO_INCREMENT UNIQUE,
  cdeptno char(10) default '',
  cplano  char(10) default '',
  hora    char(10) NULL,
  fecha   date  NULL, 
  usuario char(10)  default ''
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists pljusm;
create table pljusm(
  cjusno  char(10) primary key default '',
  cdesc   char(200) default '',
  mnotas  text default '',
  hora    char(10) NOT NULL,
  fecha   date NOT NULL, 
  usuario char(10) NOT NULL
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*ADD UNIQUE KEY cempno ("cuid"),*/

  drop table if exists pldedm;
  create table pldedm(
    cdedid    char(10) primary key,
    cdesc     char(200) default '',
    cdescsh   char(20) default '',
    ccateno   char(10) default '', 
    nvalue    decimal(10,2) default 0,
    nporctj   decimal(10,2) default 0,
    cctaid_d  char(20) default '',
    cctaid_h  char(20) default '',
    ctype     char(2) default '',
    lclear    tinyint(1) default 0,
    lapply    tinyint(1) default 0,
    cstatus   char(2) default 'OP',
    mnotas    text default '',
    hora      char(10) NOT NULL,
    fecha     date NOT NULL, 
    usuario   char(10) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
  

  drop table if exists pldedt;
   create table pldedt(
    cuid    int(15) AUTO_INCREMENT UNIQUE,
    cempno  char(10) default '' ,
    cctaid  char(20) default '' ,
    cdesc   char(200) default '' ,
    cdedid  char(10) default ''  ,
    crefno  char(10) default ''  ,
    nvalue  decimal(10,2) default 0.00 ,
    nsaldo  decimal(10,2) default 0.00 ,
    npayamt decimal(10,2) default 0.00 ,
    lapply  tinyint(1) default 0,  
    lclear  tinyint(1) default 0,
    ctype   char(2) default '' ,
    cstatus char(2) default 'OP' ,
    mnotas  text  default '' ,
    hora    char(10) NOT NULL,
    fecha   date NOT NULL, 
    usuario char(10) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
    
    
  drop table if exists pldedth;
  create table pldedth(
    cuid    char(15) UNIQUE,
    cplano  char(10) default '' ,
    cempno  char(10)  default '',
    cctaid  char(20) default '' ,
    cdesc   char(200) default '' ,
    cdedid  char(10)  default '' ,
    crefno  char(10)  default '' ,
    nvalue  decimal(10,2) default 0.00 ,
    nsaldo  decimal(10,2) default 0.00 ,
    npayamt decimal(10,2) default 0.00 ,
    lapply  tinyint(1) default 0,  
    lclear  tinyint(1) default 0,
    ctype   char(2) default '' ,
    cstatus char(2) default 'OP' ,
    mnotas  text  default '' ,
    hora    char(10) NOT NULL,
    fecha   date NOT NULL, 
    usuario char(10) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
    
  
  /* Detalle de Permisos*/
  drop table if exists plperm;
  create table plperm(
    cpermno char(10) primary key,        /* Codigo de permiso*/
    dtrndate date not null,  /* Fecha del permiso*/
    ndays int(3),            /* numero de dias del permiso*/
    ntime int(3),            /* Tiempo del permiso solicitado*/
    ctype char(1),           /* Tipo de permiso H= Horas D=Dias */
    cempno char(10),         /* Codigo de empleados*/
    mnotas text,             /* detalles del permiso*/
    ccateno char(10),        /* Tipo de Justificacion de  */
    hora char(10) not null,
    fecha date not null,
    usuario char(10) not null 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
  

  /* Detalle de fechas del permiso*/
  drop table if exists plpedf;
  create table plpedf(
    cpermno char(10) KEY ,
    dtrndate date not null,
    hora char(10) not null,
    fecha date not null,
    usuario char(10) not null 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
  
  /*tabla de rango de impuestos*/
  drop table if exists plimpm;
  create table plimpm(
    cuid int(15) AUTO_INCREMENT UNIQUE,
    nstar decimal(10,2),                  /*Rango de inicio*/
    nend decimal(10,2),                   /*Rango mayor */
    nrate decimal(10,2),  /* impuesto del tramo */
    npayamt decimal(10,2), /*monto del impuesto para el tramo*/
    hora char(10) not null,
    fecha date not null,
    usuario char(10) not null 

  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

  drop table if exists plsyst;
  create table plsyst(
    cplsetup char(1) default '',
    ninatec    int(3) default 0,
    nminpay    decimal(10,2) default 0.00,   /*Salario minimo del gobierno */
    nmaxpay    decimal(10,2) default 0.00,   /*Salario maximo para calculo del inss*/
    cded_1     char(10) default '',
    cded_2     char(10) default '',
    cded_3     char(10) default '',
    cdedd1     char(20) default '',
    cdedd2     char(20) default '',
    cdedd3     char(20) default '',
    cded_11    char(10) default '',
    cing_1     char(10) default '',
    cing_2     char(10) default '',
    cing_3     char(10) default '',
    cingd1     char(20) default '',
    cingd2     char(20) default '',
    nPorIhss   decimal(10,2) default 0.00,                      /*Porcentage aplicado al seguro*/
    namtIhss   decimal(10,2) default 0.00,                      /*Maximo monto pagado por seguro*/
    nMaxHToPay decimal(4,0) default 0.00,
    cturno	   char(10) default '',
    cturno2	   char(10) default '',
    cturno3	   char(10) default '',
    ckeyid	   char(50) default '',
    ckeyid2	   char(50) default '',
    lAusentAut tinyint(1) default 0,
    nOpcExtPay int(1) default 0,
    ndays      int(3) default 0,
    ncomi1     decimal(10,4)  default 0.0000,
    ncomi2     decimal(10,4) default 0.0000,
    hora char(10) not null,
    fecha date not null,
    usuario char(10) not null 

  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* tabla de departamentos*/
DROP TABLE if EXISTS pldept ;
create table pldept(
  cdeptno  char(10) PRIMARY KEY ,
  cdesc    char(200) DEFAULT '',
  mnotas   text default '',     
  hora char(10) not null,
  fecha date not null,
  usuario char(10) not null 
	    
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* Puestos de trabajo */
drop table if exists plworm;
create table plworm(
  cworkno  char(10) ,
  cdesc    char(200),
  mnotas   text,     
	hora char(10) not null,
  fecha date not null,
  usuario char(10) not null 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* ausentismo */
drop table if exists plausd;
create table plausd(
  cuid      int(15) AUTO_INCREMENT UNIQUE,
	cempno    char(10) KEY,
	nhrsau    DECIMAL(10,2) default 0, 
	nhrgoc    DECIMAL(10,2) default 0, /* Horas con goce*/
	nhrsgc    DECIMAL(10,2) default 0, /* Horas sin goce*/
	nhours    DECIMAL(10,2) default 0, /* Horas normales*/
	nhrext    DECIMAL(10,2) default 0, /* horas Extras*/
	nhwork    DECIMAL(10,2) default 0, /* horas que debio trabajar*/
	dtrndate  date default '0000-00-00',          /* Fecha de ausencia del trabajo.*/
	ccateno   char(10) not null,      /* justificacion de la ausencia*/
	ldeleted  tinyint(1) default 0,    /* Indica si el registro esta borrado o no*/
	mnotas    text,          /* Comentarios Generales */
	hora    char(10) not null,
  fecha   date not null,
  usuario char(10) not null 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/* ausentismos historico*/

drop table if exists plausdh;
create table plausdh(
  cuid      int(15) ,
	cempno    char(10) KEY,
	nhrsau    DECIMAL(10,2) default 0, 
	nhrgoc    DECIMAL(10,2) default 0,/* Horas con goce*/
	nhrsgc    DECIMAL(10,2) default 0, /* Horas sin goce*/
	nhours    DECIMAL(10,2) default 0, /* Horas normales*/
	nhrext    DECIMAL(10,2) default 0, /* horas Extras*/
	nhwork    DECIMAL(10,2) default 0, /* horas que debio trabajar*/
	dtrndate  date default '0000-00-00',          /* Fecha de ausencia del trabajo.*/
	ccateno   char(10) not null,      /* justificacion de la ausencia*/
	ldeleted  tinyint(1) default 0,    /* Indica si el registro esta borrado o no*/
	mnotas    text,          /* Comentarios Generales */
	hora    char(10) not null,
  fecha   date not null,
  usuario char(10) not null 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists plingm;
create table plingm(
  cingid  char(10) primary key,
  cctaid  char(20) default '',
	cdesc   char(200) default '',
	cdescsh char(20) default '',
	nvalue  decimal(10,2) default 0.00,
	nporctj decimal(10,2) default 0.00,
	ctype   char(2) default '',
	cstatus char(2) default '',
	lclear   tinyint(1) default 0, 
	lvac     tinyint(1) default 0, 
  lIhsApl  tinyint(1) default 0,
  lvecinal tinyint(1) default 0,  /* indica si paga impuesto vecinal o no */
  l1314avo tinyint(1) default 0,  /* indica si entra en el calculo del 13avo y 14avo */
  lprest   tinyint(1) default 0,  /* indica si entra en cualculo de prestaciones */
	hora    char(10) not null,
  fecha   date not null,
  usuario char(10) not null 

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* detalle de ingresos de planillas*/
drop table if exists plingt;
create table plingt(
  cuid     int(15) AUTO_INCREMENT PRIMARY key,
  cctaid   char(20) default '',
  cempno   char(10) default '',
  dfreday  date default '0000-00-00',
	cingid   char(10) default '',
	cdesc    char(200) default '',
	nvalue   decimal(10,2) default 0,
	lapply   tinyint(1) default 0,
	lclear   tinyint(1) default 0,
	ctype    char(2) default '',
	cstatus  char(2) default "OP",
	mnotas   text default "",
	hora    char(10) not null,
  fecha   date not null,
  usuario char(10) not null 
	

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* detalle historico de ingresos de planillas */
drop table if exists plingth;
create table plingth(
  cuid     int(15)  default 0,
  cctaid   char(20) default '',
  cplano   char(10) default '',
  cempno   char(10)  default '',
  dfreday  date default '0000-00-00',
	cingid   char(10) default '',
	cdesc    char(200) default '',
	nvalue   decimal(10,2) default 0.00,
	lapply   tinyint(1) default 0,
	lclear   tinyint(1) default 0,
	ctype    char(2) default '',
	cstatus  char(2) default "OP",
	mnotas   text default "",
	hora    char(10) not null,
  fecha   date not null,
  usuario char(10) not null 
	
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/* detalle de planillas.*/



/* DATA DE INVENTARIO */
  DROP TABLE IF EXISTS arwqty;
  create table arwqty(
    cuid int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cwhseno char(10) default '',
    cservno char(20) default '',
    nqtymin decimal(10,2) default 0.00,
    nqtymax decimal(10,2) default 0.00,
    cestante char(50) default "",
	mnotas text,
    cbinno char(50) default ""
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
