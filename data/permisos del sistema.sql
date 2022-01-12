/* ultimo reporte : rp011 */


/* Listado de permisos del sistema. */
delete from symenu ;
delete from sysuser;
delete from syscomp;
delete from sygrup;

insert into symenu(cmenuid,cdesc)
    values("sy001","configuracion de la compañia"),
    ("sy002","Grupos de Trabajo"),
    /* TRANSACCIONES*/
    ("tr001","Facturacion y Notas de Debito"),
    ("tr002","Recibos de Dinero"),
    ("tr003","Cotizaciones"),
    ("tr004","Entradas y Salidas de Inventario"),
    ("tr007","Preventa de Clientes"),
    ("tr008","Anulacion de Facturas"),
    ("tr009","Anulacion de Recibos"),
    ("tr010","Anulacion Requisas"),
    /* REPORTES*/
    ("rp001","Resumen de Ventas (Moneda)"),
    ("rp013","Resumen de Ventas (Articulos)"),
    ("rp002","Cuentas por Cobrar"),
    ("rp009","Vencimiento de Cartera"),
    ("rp003","Estado de Cuentas"),
    ("rp004","Resumen de Cobros"),
    ("rp005","Lista de Precios"),
    ("rp006","Resumen de Uilidades y Costos"),
    ("rp007","Formato de Requisas"),
    ("rp008","Reporte de Movimiento de Inventario (Entradas y Salidas)"),
    ("rp010","Movimientos de Inventario Valorisados AD"),
    ("rp011","Maximos y Minimos "),
    ("rp012","Reimpresion Formato Factura"),
    /* CATALOGOS*/
    ("ca001","Catalogo de Clientes"),
    ("ca002","Condiciones de Pago"),
    ("ca003","Maestro de Inventarios"),
    ("ca004","Tipos de Inventarios"),
    ("ca005","Proveedores"),
    ("ca006","Tipos de Requisas / Entradas y Salidas"),
    ("ca007","Bodegas"),
    ("ca008","Tipos de Cambio"),
    /* Modulo de Planillas */
    ("plca001","Catalogo de Empleados"),
    ("plca002","Catalogo de Ingresos"),
    ("plca003","Catalogo de Ingresos"),
    ("plca004","Cuadro impuesto sobre Renta"),
    ("plca005","Puestos de Trabajo"),
    ("plca006","Departamentos de la Empresa"),
    ("plca007","Tipos de Justificaciones"),
    ("plca008","Turnos de Trabajo"),
    /* HERRAMIENTAS*/
    ("mod001","Configuracion VC-2020"),
    ("mod002","Importacion de datos"),
    ("mod003","Ajuste de Cartera");
    
/* B)- Usuario estandar del sistema.. */
    
insert into sysuser(cgrpid,cfullname,cuserid,cstatus,cpasword) 
values("00","Supervisor General","SUPERVISOR","OP","2505");

INSERT INTO sygrup(cgrpid,cdesc,cstatus) values("00","Grupo Sistemas","OP");

insert into syscomp(ccompid, compdesc,cstatus,dbname,chost,cuser)
value("00","Compañia de Pruebas","OP","ksisdbc","localhost","root");

insert into syperm(cgrpid,cmenuid,cdesc,allow,ccompid)
values("00","sy001","configuracion de la compañia",1,"00"),
      ("00","sy002","Grupos de Trabajo",1,"00")