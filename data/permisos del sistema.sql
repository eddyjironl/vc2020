/* Listado de permisos del sistema. */
delete from symenu ;
delete from sysuser;
delete from syscomp;
delete from sygrup;
delete from ksschgrd;

/*listas del modulo cuentas por cobrar*/

  SET @lcSelect = " select ccateno, cdesc  from arcate  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARCATEG","00","Listados General de Categorias",@lcSelect,0,"AR"),
      ("ARCATEG","01","Categoria Id","ccateno",100,"AR"),
      ("ARCATEG","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select ccateno, cdesc  from arcate where ctypecate = 'A'  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARCATEA","00","Ajustes de Inventario",@lcSelect,0,"AR"),
      ("ARCATEA","01","Ajuste Id","ccateno",100,"AR"),
      ("ARCATEA","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select ccateno, cdesc  from arcate where ctypecate = 'P'  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARCATEP","00","Categoria de Proveedores / Responsables ",@lcSelect,0,"AR"),
      ("ARCATEP","01","Categoria Id","ccateno",100,"AR"),
      ("ARCATEP","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select ccateno, cdesc  from arcate where ctypecate = 'C'  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARCATEC","00","Categoria de Clientes ",@lcSelect,0,"AR"),
      ("ARCATEC","01","Categoria Id","ccateno",100,"AR"),
      ("ARCATEC","02","Descripcion","cdesc",200,"AR");


  SET @lcSelect = " select crespno, cfullname from arresp  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARRESP","00","Listado de Proveedores / Vendedores",@lcSelect,0,"AR"),
      ("ARRESP","01","Responsable Id","crespno",100,"AR"),
      ("ARRESP","02","Nombre","cfullname",200,"AR");

  SET @lcSelect = " select cwhseno, cdesc from arwhse  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
      VALUES("ARWHSE","00","Listado de Bodegas",@lcSelect,0,"AR"),
      ("ARWHSE","01","Bodega Id","cwhseno",100,"AR"),
      ("ARWHSE","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select ctserno, cdesc from artser  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("ARTSER","00","Tipos de Articulos",@lcSelect,0,"AR"),
    ("ARTSER","01","Tipo Id","ctserno",100,"AR"),
    ("ARTSER","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select ccustno, cname from arcust  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("ARCUST","00","Listado de Clientes",@lcSelect,0,"AR"),
    ("ARCUST","01","Cliente Id","ccustno",100,"AR"),
    ("ARCUST","02","Nombre Completo","cname",200,"AR");

  SET @lcSelect = " select cpaycode, cdesc from artcas  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("ARTCAS","00","Condiciones de Pago",@lcSelect,0,"AR"),
    ("ARTCAS","01","Condicion Id","cpaycode",100,"AR"),
    ("ARTCAS","02","Descripcion","cdesc",200,"AR");

  SET @lcSelect = " select cservno, cdesc, nprice , ndesc, ntax from arserm  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("ARSERM","00","Listado de Articulos",@lcSelect,0,"AR"),
    ("ARSERM","01","Articulo Id","cservno",100,"AR"),
    ("ARSERM","02","Descripcion","cdesc",200,"AR"),
    ("ARSERM","03","Precio","nprice",100,"AR"),
    ("ARSERM","04","Desc Maximo","ndesc",100,"AR"),
    ("ARSERM","05","Impuesto","ntax",100,"AR");


/* modulo de planillas-*/


 SET @lcSelect = " select cingid , cdesc from plingm  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLINGM","00","SELECT",@lcSelect,0,"PL"),
    ("PLINGM","01","Ingreso Id","cingid",100,"PL"),
    ("PLINGM","02","Nombre del Ingreso","cdesc",200,"PL");

  SET @lcSelect = " select * from pldedm  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLDEDM","00","Listado de deducciones",@lcSelect,0,"PL"),
    ("PLDEDM","01","Deduccion Id","cdedid",100,"PL"),
    ("PLDEDM","02","Nombre de la Deduccion","cdesc",200,"PL");

  SET @lcSelect = " select * from plempl  ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLEMPL","00","Listado de Empleados",@lcSelect,0,"PL"),
    ("PLEMPL","01","Empleado Id","cempno",100,"PL"),
    ("PLEMPL","02","Nombre del empleado","cfullname",200,"PL"),
    ("PLEMPL","03","Cedula No","ccedid",100,"PL"),
    ("PLEMPL","04","Nacimiento","dnacday",100,"PL");

  SET @lcSelect = " select * from pldept ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLDEPT","00","Listado de Departamentos",@lcSelect,0,"PL"),
    ("PLDEPT","01","Departamento id","cdeptno",100,"PL"),
    ("PLDEPT","02","Nombre","cdesc",200,"PL");

  SET @lcSelect = " select * from plwork ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLWORM","00","Listado de Puestos de Trabajo",@lcSelect,0,"PL"),
    ("PLWORM","01","Puesto id","cworkno",100,"PL"),
    ("PLWORM","02","Nombre","cdesc",200,"PL");

  SET @lcSelect = " select * from plturm ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLTURM","00","Turnos de Trabajo",@lcSelect,0,"PL"),
    ("PLTURM","01","Turno id","cturno",100,"PL"),
    ("PLTURM","02","Nombre","cdesc",200,"PL");

  SET @lcSelect = " select * from pljusm ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLJUSM","00","Justificaciones de Ausencias",@lcSelect,0,"PL"),
    ("PLJUSM","01","Just id","cjusno",100,"PL"),
    ("PLJUSM","02","Nombre","cdesc",200,"PL");

  SET @lcSelect = " select * from plmast ";
  INSERT INTO ksschgrd(calias,corder,cheader,mcolvalue,ncolwidth,cmodule)
    VALUES("PLMAST","00","Listado de Planillas",@lcSelect,0,"PL"),
    ("PLMAST","01","Planilla id","cplano",100,"PL"),
    ("PLMAST","02","Descripcion","cdesc",200,"PL"),
    ("PLMAST","03","Estado","cstatus",80,"PL"),
    ("PLMAST","04","Fecha Pago","dpay",100,"PL");


/*  PERMISOS */
insert into symenu(cmenuid,cdesc,cmodule,cgppmod)
    values("sy001","configuracion de la compañia","SYS","TRN"),
    ("sy002","Grupos de Trabajo","SYS","TRN"),
    /* TRANSACCIONES*/
    ("tr001","Facturacion y Notas de Debito","AR","TRN"),
    ("tr002","Recibos de Dinero","AR","TRN"),
    ("tr003","Cotizaciones","AR","TRN"),
    ("tr004","Entradas y Salidas de Inventario","AR","TRN"),
    ("tr007","Preventa de Clientes","AR","TRN"),
    ("tr008","Anulacion de Facturas","AR","TRN"),
    ("tr009","Anulacion de Recibos","AR","TRN"),
    ("tr010","Anulacion Requisas","AR","TRN"),
    /* REPORTES*/
    ("rp001","Resumen de Ventas (Moneda)","AR","RPT"),
    ("rp013","Resumen de Ventas (Articulos)","AR","RPT"),
    ("rp002","Cuentas por Cobrar","AR","RPT"),
    ("rp009","Vencimiento de Cartera","AR","RPT"),
    ("rp003","Estado de Cuentas","AR","RPT"),
    ("rp004","Resumen de Cobros","AR","RPT"),
    ("rp005","Lista de Precios","AR","RPT"),
    ("rp006","Resumen de Uilidades y Costos","AR","RPT"),
    ("rp007","Formato de Requisas","AR","RPT"),
    ("rp008","Reporte de Movimiento de Inventario (Entradas y Salidas)","AR","RPT"),
    ("rp010","Movimientos de Inventario Valorisados AD","AR","RPT"),
    ("rp011","Maximos y Minimos ","AR","RPT"),
    ("rp012","Reimpresion Formato Factura","AR","RPT"),
    ("rp014","Analisis de Kardex","AR","RPT"),
    /* CATALOGOS*/
    ("ca001","Catalogo de Clientes","AR","CAT"),
    ("ca002","Condiciones de Pago","AR","CAT"),
    ("ca003","Maestro de Inventarios","AR","CAT"),
    ("ca004","Tipos de Inventarios","AR","CAT"),
    ("ca005","Proveedores","AR","CAT"),
    ("ca006","Tipos de Requisas / Entradas y Salidas","AR","CAT"),
    ("ca007","Bodegas","AR","CAT"),
    ("ca008","Tipos de Cambio","AR","CAT"),
    /* Modulo de Planillas */
    ("pltr001","Definir Planilla","PL","TRN"),
    ("pltr002","Generar Planilla","PL","TRN"),
    ("pltr003","Modificar Planilla","PL","TRN"),

    ("plca001","Catalogo de Empleados","PL","CAT"),
    ("plca002","Catalogo de Ingresos","PL","CAT"),
    ("plca003","Catalogo de Ingresos","PL","CAT"),
    ("plca004","Cuadro impuesto sobre Renta","PL","CAT"),
    ("plca005","Puestos de Trabajo","PL","CAT"),
    ("plca006","Departamentos de la Empresa","PL","CAT"),
    ("plca007","Tipos de Justificaciones","PL","CAT"),
    ("plca008","Turnos de Trabajo","PL","CAT"),
    
    /* HERRAMIENTAS*/
    ("mod001","Configuracion VC-2020","AR","MOD"),
    ("mod002","Importacion de datos","AR","MOD"),
    ("mod003","Ajuste de Cartera","AR","MOD");
    
/* B)- Usuario estandar del sistema.. */
    
insert into sysuser(cgrpid,cfullname,cuserid,cstatus,cpasword) 
values("00","Supervisor General","SUPERVISOR","OP","2505");

INSERT INTO sygrup(cgrpid,cdesc,cstatus) values("00","Grupo Sistemas","OP");

insert into syscomp(ccompid, compdesc,cstatus,dbname,chost,cuser)
value("00","Compañia de Pruebas","OP","ksisdbc","localhost","root");

insert into syperm(cgrpid,cmenuid,cdesc,allow,ccompid)
values("00","sy001","configuracion de la compañia",1,"00"),
      ("00","sy002","Grupos de Trabajo",1,"00")