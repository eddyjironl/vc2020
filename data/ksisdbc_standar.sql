SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

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
	fecha    date DEFAULT CURRENT_DATE,
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
  hora    char(10) DEFAULT CURRENT_TIME,
  fecha   date DEFAULT CURRENT_DATE, 
  usuario char(10) default ''
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists pldepd;
create table pldepd(
  cuid    int(10) AUTO_INCREMENT UNIQUE,
  cdeptno char(10) default '',
  cplano  char(10) default '',
  hora    char(10) DEFAULT CURRENT_TIME,
  fecha   date DEFAULT CURRENT_DATE, 
  usuario char(10)  default ''
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists pljusm;
create table pljusm(
  cjusno  char(10) primary key default '',
  cdesc   char(200) default '',
  mnotas  text default '',
  hora    char(10) DEFAULT CURRENT_TIME,
  fecha   date DEFAULT CURRENT_DATE, 
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
    hora      char(10) default CURRENT_TIME,
    fecha     date  DEFAULT CURRENT_DATE, 
    usuario   char(10) NOT NULL DEFAULT ''
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
    hora    char(10)  DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE, 
    usuario char(10) NOT NULL DEFAULT ''
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
    hora    char(10)  DEFAULT CURRENT_DATE,
    fecha   date  DEFAULT CURRENT_TIME, 
    usuario char(10) NOT NULL DEFAULT ''
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
    hora char(10)  DEFAULT CURRENT_TIME,
    fecha date  DEFAULT CURRENT_DATE,
    usuario char(10) not null DEFAULT '' 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
  

  /* Detalle de fechas del permiso*/
  drop table if exists plpedf;
  create table plpedf(
    cpermno char(10) KEY ,
    dtrndate date not null,
    hora char(10)  DEFAULT CURRENT_TIME,
    fecha date  DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
  
  /*tabla de rango de impuestos*/
  drop table if exists plimpm;
  create table plimpm(
    cuid int(15) AUTO_INCREMENT UNIQUE,
    nstar decimal(10,2),                  /*Rango de inicio*/
    nend decimal(10,2),                   /*Rango mayor */
    nrate decimal(10,2),  /* impuesto del tramo */
    npayamt decimal(10,2), /*monto del impuesto para el tramo*/
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 

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
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 

  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* tabla de departamentos*/
DROP TABLE if EXISTS pldept ;
create table pldept(
  cdeptno  char(10) PRIMARY KEY ,
  cdesc    char(200) DEFAULT '',
  mnotas   text default '',     
  hora char(10) DEFAULT CURRENT_TIME,
  fecha date DEFAULT CURRENT_DATE,
  usuario char(10) default '' 	    
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* Puestos de trabajo */
drop table if exists plworm;
create table plworm(
  cworkno  char(10) ,
  cdesc    char(200),
  mnotas   text,     
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
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
	ccateno   char(10) default '',      /* justificacion de la ausencia*/
	ldeleted  tinyint(1) default 0,    /* Indica si el registro esta borrado o no*/
	mnotas    text default '',          /* Comentarios Generales */
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
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
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
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
  hora char(10) DEFAULT CURRENT_TIME,
  fecha date DEFAULT CURRENT_DATE,
  usuario char(10) default '' 
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
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
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
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
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
	mnotas text default '',
    cbinno char(50) default "",
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS aradjm;
CREATE TABLE aradjm (
  cadjno char(10) PRIMARY KEY NOT NULL,
  dtrndate date default '0000-00-00',
  ccateno char(10) default '',
  crespno char(10) default '',
  cwhseno char(10) default '',
  cmodule char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1' COMMENT '1- requisas , 2- compras',
  ctrnno char(10) COLLATE utf8_spanish_ci NOT NULL  default '' COMMENT 'asiento de diario',
  mnotasv text COLLATE utf8_spanish_ci NOT NULL  default '' COMMENT 'Comentarios sobre anulacion',
  lvoid tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indica si esta anulada o no en convinacion del estado',
  cstatus char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  crefno char(50) COLLATE utf8_spanish_ci NOT NULL default '',
  ntc decimal(10,4) NOT NULL DEFAULT '1.0000',
  nbuyamt decimal(10,2) NOT NULL DEFAULT '0.00',
  ndescamt decimal(10,2) NOT NULL DEFAULT '0.00',
  ntaxamt decimal(10,2) NOT NULL DEFAULT '0.00',
  nbalance decimal(10,2) NOT NULL DEFAULT '0.00',
  nebuyamt decimal(10,2) NOT NULL DEFAULT '0.00',
  nedescamt decimal(10,2) NOT NULL DEFAULT '0.00',
  netaxamt decimal(10,2) NOT NULL DEFAULT '0.00',
  nebalance decimal(10,2) NOT NULL DEFAULT '0.00',
  mnotas text COLLATE utf8_spanish_ci NOT NULL default '',
  hora char(10) DEFAULT CURRENT_TIME,
  fecha date DEFAULT CURRENT_DATE,
  usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS aradjt;

CREATE TABLE aradjt (
  cuid int(10) AUTO_INCREMENT UNIQUE,
  cadjno char(10) default '',
  cservno char(20) COLLATE utf8_spanish_ci default '',
  cdesc char(200) COLLATE utf8_spanish_ci  default '',
  ncost decimal(10,4) NOT NULL DEFAULT  '0.0000',
  ncostu decimal(10,4) NOT NULL DEFAULT '0.0000',
  nqty decimal(10,2) NOT NULL DEFAULT  '0.00',
  ntax decimal(10,2) NOT NULL DEFAULT  '0.00',
  ndesc decimal(10,2) NOT NULL DEFAULT '0.00',
  mnotas text default '',
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arcash;
CREATE TABLE arcash (
  cuid int(10) primary key AUTO_INCREMENT,
  ccashno char(10) default '',
  cinvno char(10) default '',
  namount decimal(10,2) default 0.00,
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arcasm;
CREATE TABLE arcasm (
  ccashno char(10) primary key,
  ccustno char(10) default '',
  ctrnno char(10) default '',
  cdesc char(100) default '',
  crefno char(50) default '',
  ctype char(2) default '' '',
  cstatus char(2)  DEFAULT 'OP',
  dtrndate date default '0000-00-00',
  mnotas text default '',
  namount decimal(10,2) default 0.00,
  ctypedoc char(2) default '',
  ntc decimal(10,4) default 0.0000,
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arcate;
CREATE TABLE arcate (
  ccateno char(10) primary key,
  cdesc char(200) default '',
  cstatus char(2) default '',
  ctypeadj char(1)  default '' COMMENT 'E= entrada, S = salida ,indica si es de entrada o salida',
  ctypecate char(2) default '',
  cctaid char(20) default '',
  cctaid_tax char(20)  default '',
  lctaresp tinyint(1) ,
  lexpcont tinyint(1) ,
  lupdcost tinyint(1) ,
  mnotas text default '',
    hora char(10) DEFAULT CURRENT_TIME,
    fecha date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arcust;
CREATE TABLE arcust (
  ccustno char(10) primary key ,
  cname char(100) default '',
  ctel char(15)  default '',
  cpasword char(50)  default '',
  nlimcrd decimal(10,2)  default 0.00,
  mnotas text  default '',
  ctype char(10)  default '',
  nbbalance decimal(10,2) default 0.00,
  nebalance decimal(10,2) default 0.00,
  nbsalestot decimal(10,2) default 0.00,
  nesalestot decimal(10,2) default 0.00,
  cctaid char(20)  default '',
  crespno char(10)  default '',
  cwhseno char(10)  default '',
  cpaycode char(10) default '',
  cstatus char(2)  default '',
  cfoto text  default '',
  ccateno char(10)  default '',
  mdirecc text  default '',
  cweb char(100)  default '',
  cemail char(50)  default '',
  dstar date  default '0000-00-00' COMMENT 'fecha en que inicio el cliente',
  cubino char(10)  default '',
  hora char(10) DEFAULT CURRENT_TIME,
  fecha date DEFAULT CURRENT_DATE,
  usuario char(10) default '' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arinvc;
CREATE TABLE `arinvc` (
  `cinvno` char(10) PRIMARY KEY,
  `dstar` date DEFAULT '0000-00-00',
  `dend` date default '0000-00-00',
  `ccustno` char(10) COLLATE utf8_spanish_ci ,
  `cstatus` char(2) COLLATE utf8_spanish_ci DEFAULT 'OP',
  `lvoid` tinyint(1)  DEFAULT '0',
  `cpaycode` char(10) COLLATE utf8_spanish_ci default '',
  `ctrnno`  char(20) COLLATE utf8_spanish_ci  default '',
  `cwhseno` char(10) COLLATE utf8_spanish_ci default '',
  `crespno` char(10) COLLATE utf8_spanish_ci default '',
  `cdesc` char(200) COLLATE utf8_spanish_ci default '',
  `ctel` char(10) COLLATE utf8_spanish_ci default '',
  `crefno` char(20) COLLATE utf8_spanish_ci default '',
  `mnotas` text COLLATE utf8_spanish_ci default '',
  `nsalesamt` decimal(10,2)  default 0.00,
  `ntaxamt` decimal(10,2)  default 0.00,
  `ndesamt` decimal(10,2)  default 0.00,
  `nbalance` decimal(10,2)  default 0.00,
  `nefectivo` decimal(10,2) DEFAULT 0.00,
  `ntc` decimal(10,2) default 0.00,
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arinvt;
CREATE TABLE `arinvt` (
  `cuid` int(10) primary key AUTO_INCREMENT,
  `cinvno` char(10) default '',
  `cservno` char(20) COLLATE utf8_spanish_ci  default '',
  `cdesc` char(200) COLLATE utf8_spanish_ci  default '',
  `nqty` int(10)  default 0,
  `nprice` decimal(10,2) default 0.00,
  `ncost` decimal(10,4)  default 0.00,
  `mnotas` text COLLATE utf8_spanish_ci  default '',
  `ntax` decimal(10,2)  default 0.00,
  `ndesc` decimal(10,2)  default 0.00,
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS armedm;

CREATE TABLE `armedm` (
  `cmedno` char(10) primary key ,
  `cdesc` char(100) COLLATE utf8_spanish_ci default '',
  `csigno` char(20) COLLATE utf8_spanish_ci default '',
  `mnotas` text COLLATE utf8_spanish_ci default '',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS armone;
CREATE TABLE `armone` (
  `cuid` int(10) primary key AUTO_INCREMENT,
  `dtrndate` date default '0000-00-00',
  `ntc` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arpedm;
CREATE TABLE `arpedm` (
  `cpedno` varchar(10) primary key ,
  `cdesc` varchar(200) default '',
  `clotno` varchar(10) default '',
  `cstatus` varchar(2) DEFAULT 'OP',
  `mnotas` text default '',
  `ccustno` varchar(10) default '',
  `dtrndate` date default '0000-00-00',
  `cpaycode` varchar(10) default '',
  `crespno` varchar(10) default '',
  `ntc` decimal(10,2)  DEFAULT '1.00',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arpedt;
CREATE TABLE `arpedt` (
  `cuid` int(10) unique AUTO_INCREMENT,
  `cpedno` varchar(10) default '',
  `cservno` varchar(20) default '',
  `cdesc` text  default '',
  `mnotas` text  default '',
  `nqty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ntax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arresp;
CREATE TABLE `arresp` (
  `crespno` char(10) primary key default '',
  `cfullname` char(100) COLLATE utf8_spanish_ci NOT NULL  default '',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL default '',
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mtels` text COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL default '',
  `cruc` char(20) COLLATE utf8_spanish_ci NOT NULL default '',
  `cfoto` char(200) COLLATE utf8_spanish_ci NOT NULL default '',
  `nbalance` decimal(10,2)  default 0.00,
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
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arserm;
CREATE TABLE arserm (
  cservno char(20) PRIMARY KEY,
  cdesc char(200)  NOT NULL default '',
  cdesc2 char(100) NOT NULL default '',
  ncost decimal(10,2) NOT NULL default 0.00,
  nlastcost decimal(10,2) NOT NULL default 0.00,
  nprice decimal(10,2) default 0.00,
  nprice1 decimal(10,2)  default 0.00,
  nprice2 decimal(10,2)  default 0.00,
  ntax decimal(10,2)  default 0.00,
  ndesc decimal(10,2)  default 0.00,
  ctserno char(10) NOT NULL default '',
  cstatus char(2) nOT NULL default '',
  cmedno char(10)  NOT NULL default '',
  crespno char(10) NOT NULL default '',
  cctaid char(20)  NOT NULL default '',
  cctaid_c char(20) NOT NULL default '',
  cctaid_i char(20) nOT NULL default '',
  citemtype char(2) NOT NULL default '',
  mnotas text NOT NULL default '',
  cfoto text NOT NULL default '',
  lallowneg tinyint(1) NOT null  default 0,
  lupdateonhand tinyint(1) NOT NULL default 0,
  nminonhand decimal(10,2) NOT NULL default 0.00,
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arsetup;
CREATE TABLE `arsetup` (
  `ninvno` int(10) default 0,
  `nrecno` int(10) default 0,
  `nadjno` int(10) default 0,
  `nncno` int(10)  default 0,
  `nndno` int(10) default 0,
  `ncotno` int(10) default 0,
  `npedno` int(10) default 0,
  `ncashno` int(10) default 0,
  `cwhseno` char(10) COLLATE utf8_spanish_ci  default '',
  `minvno` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mestados` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mcoti` text COLLATE utf8_spanish_ci NOT NULL default '',
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `carsetup` char(1) COLLATE utf8_spanish_ci NOT NULL default '',
  `ctypcost` char(2) COLLATE utf8_spanish_ci NOT NULL default '',
  `ctaxproc` char(2) COLLATE utf8_spanish_ci NOT NULL default '',
  `linvno` tinyint(1) NOT NULL default 0,
  `lestados` tinyint(1) NOT NULL default 0,
  `lcoti` tinyint(1) NOT NULL default 0,
  `ninvlinmax` int(2) NOT NULL default 0,
  `ncashamt` decimal(10,2) NOT NULL default 0,
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arskit;
CREATE TABLE arskit(
  cuid int(10) AUTO_INCREMENT UNIQUE,
  cservno CHAR(20) NOT NULL default '' ,
  cservno1 CHAR(20) NOT NULL default '' ,
  nqty DECIMAL(10,2) NOT NULL DEFAULT 0.00 ,
  ncost DECIMAL(10,2) NOT NULL DEFAULT 0.00 ,
  hora    char(10) default CURRENT_TIME,
  fecha   date default CURRENT_DATE,
  usuario char(10) default ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS artcas;
CREATE TABLE `artcas` (
  `cpaycode` char(10) primary key ,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL default '',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid1` char(20) COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid2` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid3` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid4` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `cctaid5` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `nday` int(3) NOT NULL default 0,
  `lvalidcrd` tinyint(1) NOT NULL default 0,
  `lqtypay` tinyint(1) NOT NULL default 0,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL default '',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS artran;
CREATE TABLE `artran` (
  `cuid` int(10) unique AUTO_INCREMENT,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `dtrndate` date NOT NULL default '0000-00-00',
  `namount` decimal(10,2) NOT NULL default 0.00,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL default '',
  `ctype` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'IN',
  `cstatus` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS artser;
CREATE TABLE `artser` (
  `ctserno` char(10) PRIMARY KEY NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL default '',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL default '',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL default '',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arubim;
CREATE TABLE `arubim` (
  `cubino` varchar(10) primary key,
  `cdesc` text COLLATE utf8_spanish_ci NOT NULL default '',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS arwhse;
CREATE TABLE `arwhse` (
  `cwhseno` char(10) primary key,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL default '',
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL default '',
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mtel` text COLLATE utf8_spanish_ci NOT NULL default '',
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL default '',
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `usuario` char(10) COLLATE utf8_spanish_ci default '',
  `fecha` date default CURRENT_DATE,
  `hora` time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
