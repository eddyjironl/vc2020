/*
    30/ abril / 2022
    MODULO CONTABLE
        tablas.
        permisos 
        vistas.
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    TABLAS SISTEMA CONTABLE.
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
DROP TABLE IF EXISTS cgsetup;
CREATE TABLE cgsetup (
  ntrnno1  decimal(10) not null default 0,   
  ntrnno2  decimal(10) not null default 0,
  ntrnno3  decimal(10) not null default 0,
  ntrnno4  decimal(10) not null default 0,
  ncashamt decimal(10,2) not null default 0.00,
  cperid   char(10) not null default '',
  cctano1  char(20) not null default '',
  cctano2  char(20) not null default '',
  cctano3  char(20) not null default '',
  cctano4  char(20) not null default '', 
  cctano5  char(20) not null default '',
  cctano6  char(20) not null default '',
  cmonid   char(10) not null default '',
  cfirma1  char(50) not null default '' ,
  lviewF1  tinyint(1) NOT null  default 0,
  ctitulo1 char(50) , /* Descripcion del titulo del que Firma */
  cfirma2  char(50) , /* Firma de Estado financiero*/
  lviewF2  tinyint(1) NOT null  default 0, /* Ver Firma de Estado financiero */
  ctitulo2 char(50) ,/* && Descripcion del titulo del que Firma*/
  cfirma3  char(50) ,/* && Firma de Estado financiero*/
  lviewF3  tinyint(1) NOT null  default 0, /* Ver Firma de Estado financiero */
  ctitulo3 char(50) , /* Descripcion del titulo del que Firma */
  llogoBC  tinyint(1) NOT null  default 0, /* Ver logo en Balance de Comprobacion */
  llogoBG  tinyint(1) NOT null  default 0, /* Ver logo en Balance General */
  llogoER  tinyint(1) NOT null  default 0, /* Ver logo en Estado de Resultados */
  nrentax  decimal(10,2), /* Porcenaje impuesto sobre la renta */
  cmic1desc   char(15) not null default '', /* Descripcion del grupo */
  cmic2desc   char(15) not null default '' , /* Descripcion del grupo */
  cmic3desc   char(15) not null default '' , /* Descripcion del grupo */
  cmic4desc   char(15) not null default '' , /* Descripcion del grupo */
  cmic5desc   char(15) not null default '' , /* Descripcion del grupo */
  lmic1desc   tinyint(1) NOT null  default 0, /* habilitar la descripcion de grupo */
  lmic2desc   tinyint(1) NOT null  default 0, /* habilitar la descripcion de grupo */
  lmic3desc   tinyint(1) NOT null  default 0, /* habilitar la descripcion de grupo */
  lmic4desc   tinyint(1) NOT null  default 0, /* habilitar la descripcion de grupo */
  lmic5desc   tinyint(1) NOT null  default 0, /* habilitar la descripcion de grupo */
  nmic1desc    int(2), /* SANGRIA DEL ROTULO */
  nmic2desc    int(2), /* SANGRIA DEL ROTULO */
  nmic3desc    int(2), /* SANGRIA DEL ROTULO */
  nmic4desc    int(2), /* SANGRIA DEL ROTULO */
  nmic5desc    int(2), /* SANGRIA DEL ROTULO */
  lmic1desc1   tinyint(1) NOT null  default 0, /* PRESENTAR TITULO DE GRUPO en reporte */
  lmic2desc1   tinyint(1) NOT null  default 0, /* PRESENTAR TITULO DE GRUPO en reporte */
  lmic3desc1   tinyint(1) NOT null  default 0, /* PRESENTAR TITULO DE GRUPO en reporte */
  lmic4desc1   tinyint(1) NOT null  default 0, /* PRESENTAR TITULO DE GRUPO en reporte */
  lmic5desc1   tinyint(1) NOT null  default 0, /* PRESENTAR TITULO DE GRUPO en reporte */
  lmic1desc2   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic2desc2   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic3desc2   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic4desc2   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic5desc2   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic1desc3   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic2desc3   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic3desc3   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic4desc3   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte */
  lmic5desc3   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic1desc4   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic2desc4   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic3desc4   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic4desc4   tinyint(1) NOT null  default 0, /*PRESENTAR SUMARIZACION del total en reporte */
  lmic5desc4   tinyint(1) NOT null  default 0, /* PRESENTAR SUMARIZACION del total en reporte*/
  ngrupid      int(2), /* agrupacion del reporte */
  lnConfRChk   tinyint(1) NOT null  default 0,
  usuario  char(10) COLLATE utf8_spanish_ci default '',
  fecha    date default CURRENT_DATE,
  hora     time(6) default CURRENT_TIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgperd;
create table cgperd(
    cperid   char(10) primary key ,
    cdesc    char(200) default '',
    cyear    char(4) default '',
    ninvfin  decimal(10,2) default 0.00,
    dstarper date default CURRENT_DATE,
    dendper  date default CURRENT_DATE,
    lclose   tinyint(1) NOT null  default 0,
  usuario  char(10) COLLATE utf8_spanish_ci default '',
  fecha    date default CURRENT_DATE,
  hora     time(6) default CURRENT_TIME
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmonm;
create table cgmonm(
    cmonid   char(10) primary key,
    cdesc    char(200) , 
    csimbolo char(10),
    mnotas    text default'' ,			 /* Comentarios generales del documento */
	cmetodo  char(1),
    hora     char(10) DEFAULT CURRENT_TIME,
    fecha    date DEFAULT CURRENT_DATE,
    usuario  char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists cgmond;
create table cgmond(
    cuid     integer(10) AUTO_INCREMENT PRIMARY KEY ,
    cmonid   char(10) ,
    dtrndate date default CURRENT_DATE ,
    ntc  decimal(10,4) default 0.0000, 
    hora     char(10) DEFAULT CURRENT_TIME,
    fecha    date DEFAULT CURRENT_DATE,
    usuario  char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists cgmast_1;
create table cgmast_1(
    ctrnno    char(10),
	ckqno     char(10),         /* Numero de cheque */
	crefno    char(10),         /* Numero de cheque */
	crespno   char(10),         /* codigo del que elabora el registro */
    ctypeMon  char(1) default "N" , /* tipo de moneda del comprobante N = nacional D = dolares E= Euros */
	ctype     char(10),         /* Indicando el tipo de comprobante */
	dtrndate  date default CURRENT_DATE,   /* fecha de transaccion */
	cdesc     char(200),         /* Descripcion del documento */
	mnotas    text default'' ,			 /* Comentarios generales del documento */
	namount   decimal(10,2),       /* Monto del cheque */
	namount_d decimal(10,2),       /* Monto del cheque Dolares */
	nrate     decimal(10,4),       /* Tasa de cambio para valorazion de cuentas factuor de divicion. */
	lprint    tinyint(1) NOT null  default 0,             /* Indica si el cheque esta impreso o no. */
	lpost     tinyint(1) NOT null  default 0,			 /* indica si esta posteado o no a contabilidad */
	cperid    char(10),         /* periodo contable */
	cstatus   char(2),          /* Estatus */
    hora     char(10) DEFAULT CURRENT_TIME,
    fecha    date DEFAULT CURRENT_DATE,
    usuario  char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmasd_1;
create table cgmasd_1(
    cuid     int(10) AUTO_INCREMENT primary key,     /* Identificacion unica de la linea */
    ctrnno   char(10),      /*  Numero de la transaccion */
    ccodno   char(20),      /*  Codigo de Cuenta */
	cperid   char(10),      /*  periodo contable */
    cdesc    char(200) ,    /*  descripcion del codigo */
	crefno   char(10),      /*  Descripcion del documento */
	ccosno   char(10),      /*  Centro de costo */
	dref     date default CURRENT_DATE,          /*  Fecha referencial */
    ndebe    decimal(16,4), /*  Monto del debe */
    nhaber   decimal(16,4), /*  Monto del haber */
    ndebe_d  decimal(16,4), /*  Monto del debe */
    nhaber_d decimal(16,4), /*  Monto del haber */
    mnotas   text default '', /*  Comentarios de la transaccion */
    hora     char(10) DEFAULT CURRENT_TIME,
    fecha    date DEFAULT CURRENT_DATE,
    usuario  char(10) default '' 

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if EXISTS cgmast_1h;
create table cgmast_1h(
    ctrnno    char(10),           /* Numero de transaccion */
	ctrnno2   char(10),           /* Numero de Presupuesto asociado al asiento */
	ckqno     char(10),             /* Numero de cheque  */
	crefno    char(10),           /* Numero de cheque */
	crespno   char(10),           /* codigo del que elabora el registro */
    ctypeMon  char(1) default "N" , /* tipo de moneda del comprobante N = nacional D = dolares E= Euros */
	ctype     char(10),           /* Indicando el tipo de comprobante */
	dtrndate  date DEFAULT CURRENT_DATE,   /* fecha de transaccion */
	cdesc     char(200),      /* Descripcion del documento */
	mnotas    text ,			/* Comentarios generales del documento */
	namount   decimal(10,4),  /* Monto del cheque */
	namount_d decimal(10,4),  /* Monto del cheque Dolares */
	nrate     decimal(10,4),  /* Tasa de cambio para valorazion de cuentas factuor de divicion. */
	lprint    tinyint(1) default 0, /* Indica si el cheque esta impreso o no. */
	lpost     tinyint(1) default 0, /* indica si esta posteado o no a contabilidad */
	cperid    char(10), /* periodo contable */
	cstatus   char(2),  /* Estatus */
    hora      char(10) DEFAULT CURRENT_TIME,
    fecha     date DEFAULT CURRENT_DATE,
    usuario   char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmasd_1h;
create table cgmasd_1h(
    cuid     int(10) AUTO_INCREMENT primary key,     /* Identificacion unica de la linea */
    ctrnno   char(10),        /*  Numero de la transaccion */
    ccodno   char(20),        /*  Codigo de Cuenta */
	cperid   char(10),        /*  periodo contable */
    cdesc    char(200) ,      /*  descripcion del codigo */
	crefno   char(10),        /*  Descripcion del documento */
	ccosno   char(10),        /*  Centro de costo */
	dref     date default  CURRENT_DATE,          /*  Fecha referencial */
    ndebe    decimal(16,4),   /*  Monto del debe */
    nhaber   decimal(16,4),   /*  Monto del haber */
    ndebe_d  decimal(16,4),   /*  Monto del debe */
    nhaber_d decimal(16,4),   /*  Monto del haber */
    mnotas   text default '', /*  Comentarios de la transaccion */
    hora     char(10) DEFAULT CURRENT_TIME,
    fecha    date DEFAULT CURRENT_DATE,
    usuario  char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/* Bancos */
drop table if exists cgbanm;
create table cgbanm(
    cbanno  char(10),         /* Numero de la transaccion */
    cdesc   char(200) ,       /* descripcion del codigo de banco */
    chk     char(200),        /* ubicacion del formato de cheque. */
    mnotas  text default '' , /* Comentarios de la transaccion */
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists cgband;
create table cgband(
    cuid int(10) AUTO_INCREMENT primary key,
    cbanno  char(10),         /* Numero de la transaccion */
    cdesc   char(200) ,       /* descripcion del codigo de banco */
    cmonid  char(10),         /* ubicacion del formato de cheque. */
    cckqno  char(10),         /* ubicacion del formato de cheque. */
    cctaid  char(20),         /* ubicacion del formato de cheque. */
    mnotas  text default '' , /* Comentarios de la transaccion */
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists cgctas;
create table cgctas(
    cctaid    char(20),        /* Codigo del Cuenta Contable */
    nubic     integer(3),      /* Orden de la cuenta  */
    cerff     char(2),
    ctype     char(1),         /* Tipo de saldo D= Debe H = haber */
    cgrupid   char(1),         /* Clasificacion de grupo */
    cdesc     char(200),       /* Descripcion de la cuenta*/
    lapplyir  tinyint(1) default 0,  /* Indica si se considera en los calculos del IR.*/
    lfcash    tinyint(1) default 0,  /* indica si se considera en el flujo de caja*/
    cfcash    char(1),               /* indica que columna de la cuenta se considera en el flujo de caja D= debe H= haber */
    lpost     tinyint(1) default 0, /* Inidca si la cuenta es posteable o no*/
    nbi       decimal(16,2), /* Monto del debe*/
    ndebe     decimal(16,4) default 0.00, /* Monto del debe LOCAL*/
    nhaber    decimal(16,4) default 0.00, /* Monto del haber LOCAL*/
    ndebe_d   decimal(16,4) default 0.00, /* Monto del debe DOLARES*/
    nhaber_d  decimal(16,4) default 0.00, /* Monto del haber DOLARES*/
    namount   decimal(16,4) default 0.00, /* monto o saldo de la cuenta*/
    namount_d decimal(16,4) default 0.00, /* monto o saldo de la cuenta dolares*/
    mnotas    text default '' ,
    cmic1no   char(10) default '' ,      /* Numero de Micelaneo */
    cmic2no   char(10) default '' ,      /* Numero de Micelaneo */
    cmic3no   char(10) default '' ,      /* Numero de Micelaneo */
    cmic4no   char(10) default '' ,      /* Numero de Micelaneo */
    cmic5no   char(10) default '' ,      /* Numero de Micelaneo */ 
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* agrupaciones contables. */
drop table if exists cgmic1;
create table cgmic1(
    cmic1no char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmic2;
create table cgmic2(
    cmic2no char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmic3;
create table cgmic3(
    cmic3no char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmic4;
create table cgmic4(
    cmic4no char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
drop table if exists cgmic5;
create table cgmic5(
    cmic5no char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

drop table if exists cgresp;
create table cgresp(
    crespno char(10) primary key, 
    cdesc   char(200) default '',
    mnotas  text default '',
    hora    char(10) DEFAULT CURRENT_TIME,
    fecha   date DEFAULT CURRENT_DATE,
    usuario char(10) default '' 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


/*
    Listados Maestros.
*/
/* Borrando listados del catalogo maestro de Contabilidad unicamente.*/
delete from ksschgrd where cmodule = 'CG';


SET @lcSelect = " select ctrnno , cperid, cdesc ,dtrndate, nrate, if(lpost=0,'Si','No') as lpost, cstatus   from cgmast_1 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMAST_1","00","Lista de asientos",@lcSelect,0,"CG"),
        ("CGMAST_1","01","Asiento #","ctrnno",100,"CG"),
        ("CGMAST_1","02","Periodo Id","cperid",70,"CG"),
        ("CGMAST_1","03","Descripcion","cdesc",200,"CG"),
        ("CGMAST_1","04","Fecha","dtrndate",70,"CG"),
        ("CGMAST_1","05","Posteado","lpost",70,"CG"),
        ("CGMAST_1","06","Estado","cstatus",70,"CG"),
        ("CGMAST_1","07","Tipo Cambio","nrate",70,"CG");


SET @lcSelect = " select cperid, cdesc , cyear, if(lclose = 1,'Cerrado','Activo') as estado from cgperd ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGPERD","00","Lista de Periodos",@lcSelect,0,"CG"),
        ("CGPERD","01","Periodo Id","cperid",100,"CG"),
        ("CGPERD","02","Descripcion","cdesc",200,"CG"),
        ("CGPERD","03","Estado","lclose",70,"CG"),
        ("CGPERD","04","Año","cyear",70,"CG");

SET @lcSelect = " select cctaid, cdesc  from cgctas ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGCTAS","00","Catalogo General",@lcSelect,0,"CG"),
        ("CGCTAS","01","Cuenta Id","cctaid",100,"CG"),
        ("CGCTAS","02","Descripcion","cdesc",200,"CG");


SET @lcSelect = " select cmonid, cdesc from cgmonm  ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMONM","00","Listados de Monedas",@lcSelect,0,"CG"),
        ("CGMONM","01","Moneda id","cmonid",100,"CG"),
        ("CGMONM","02","cdesc","cdesc",200,"CG");
/*
SET @lcSelect = " select ctrnno,cperid,cdesc,if(lpost=0,'Si','No') as lpost from cgmast_1 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMAST_1","00","Listados de Transacciones.",@lcSelect,0,"CG"),
        ("CGMAST_1","01","Asiento","ctrnno",100,"CG"),
        ("CGMAST_1","02","Periodo","cperid",100,"CG"),
        ("CGMAST_1","03","Descripcion","cdesc",200,"CG"),
        ("CGMAST_1","04","Posteado","lpost",200,"CG");
*/
SET @lcSelect = " select cbanno, cdesc  from cgbanm ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGBANM","00","Listados de Bancos.",@lcSelect,0,"CG"),
        ("CGBANM","01","Banco ID","cbanno",100,"CG"),
        ("CGBANM","02","Descripcion","cdesc",200,"CG");

SET @lcSelect = " select cmic1no, cdesc  from cgmic1 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMIC1","00","Agrupacion 1",@lcSelect,0,"CG"),
        ("CGMIC1","01","Grupo # 1","cmic1no",100,"CG"),
        ("CGMIC1","02","Descripcion","cdesc",200,"CG");
SET @lcSelect = " select cmic2no, cdesc  from cgmic2 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMIC2","00","Agrupacion 2",@lcSelect,0,"CG"),
        ("CGMIC2","01","Grupo # 2","cmic2no",100,"CG"),
        ("CGMIC2","02","Descripcion","cdesc",200,"CG");
SET @lcSelect = " select cmic3no, cdesc  from cgmic3 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMIC3","00","Agrupacion 3",@lcSelect,0,"CG"),
        ("CGMIC3","01","Grupo # 3","cmic3no",100,"CG"),
        ("CGMIC3","02","Descripcion","cdesc",200,"CG");
SET @lcSelect = " select cmic4no, cdesc  from cgmic4 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMIC4","00","Agrupacion 4",@lcSelect,0,"CG"),
        ("CGMIC4","01","Grupo # 4","cmic4no",100,"CG"),
        ("CGMIC4","02","Descripcion","cdesc",200,"CG");
SET @lcSelect = " select cmic5no, cdesc  from cgmic5 ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGMIC5","00","Agrupacion 5",@lcSelect,0,"CG"),
        ("CGMIC5","01","Grupo # 5","cmic5no",100,"CG"),
        ("CGMIC5","02","Descripcion","cdesc",200,"CG");

SET @lcSelect = " select crespno, cdesc  from cgresp ";
INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
  VALUES("CGRESP","00","Listado de responsables",@lcSelect,0,"CG"),
        ("CGRESP","01","Resp id","crespno",100,"CG"),
        ("CGRESP","02","Descripcion","cdesc",200,"CG");

/*
    Permisos
*/

/*
    CONFIGURACION DE MENU
    transacciones
    
    Borrando las opciones de menu Contable.
*/

delete from symodu where cmodule = 'CG';

insert into symodu(cmodule, cdesc,cstatus)
values("CG","Contabilidad General","OP");
      
delete from symenh where cmodule = 'CG';

insert into symenh(cmenhid,cdesc, cmodule,cstatus,ctype)
values("CG01","Transacciones","CG","OP","TRN"),
      ("CG02","Reportes     ","CG","OP","RPT"),
      ("CG03","Catalogos    ","CG","OP","CAT"),
      ("CG04","Herramientas ","CG","OP","MOD");

delete from symenu where cmodule = 'CG';

insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR01","Asientos de diario","CG","TRN","CG01","OP","../view/cgmast_1.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR02","Registro de Cheques","CG","TRN","CG01","OP","../view/cgmast_2.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR03","Importar datos ","CG","TRN","CG01","OP","../view/cgimp.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR04","Mayorizacion o Posteo de Partidas","CG","TRN","CG01","OP","../view/cgmast_1.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR05","Reposteo de Partidas","CG","TRN","CG01","OP","../view/cgmast_1.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR06","Cierre del Periodo","CG","TRN","CG01","OP","../view/cgmast_1.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGTR07","Seleccion de Periodo","CG","TRN","CG01","OP","../view/cgperd_a.php");
/* Catalogos */
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA01","Catalogo Contable Ctas Operativas","CG","CAT","CG03","OP","../view/cgctas.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA02","Agrupacion 1 ","CG","CAT","CG03","OP","../view/cgmicx.php?cid=1");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA03","Agrupacion 2 ","CG","CAT","CG03","OP","../view/cgmicx.php?cid=2");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA04","Agrupacion 3 ","CG","CAT","CG03","OP","../view/cgmicx.php?cid=3");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA05","Agrupacion 4 ","CG","CAT","CG03","OP","../view/cgmicx.php?cid=4");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA06","Agrupacion 5 ","CG","CAT","CG03","OP","../view/cgmicx.php?cid=5");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA07","Bancos","CG","CAT","CG03","OP","../view/cgbanm.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA08","Digitadores de Partidas","CG","CAT","CG03","OP","../view/cgresp.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGCA09","Moneda y Tipos de Cambio","CG","CAT","CG03","OP","../view/cgmonm.php");
/* configuraciones especiales del modulo.*/
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGMOD01","Definicion de Periodos contables","CG","MOD","CG04","OP","../view/cgsetup.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGMOD02","Configuracion Contabilidad General VC2020 WEB","CG","MOD","CG04","OP","../view/cgsetup.php");
insert into symenu(cmenuid,cdesc,cmodule,cgppmod,cmenhid,cstatus,cview)
    values("CGMOD03","Reversion de Cierres Contables","CG","MOD","CG04","OP","../view/cgsetup.php");
