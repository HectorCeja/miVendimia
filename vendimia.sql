CREATE DATABASE vendimia;

USE vendimia;

/*Tabla de datos*/
/*motores engine, inodb*/
CREATE TABLE clientes(
	clave_cliente INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(30) NOT NULL,
	apaterno VARCHAR(20) NOT NULL,
	amaterno VARCHAR(20) NOT NULL,
	rfc VARCHAR(13) NOT NULL,
	PRIMARY KEY(clave_cliente)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE articulo(
	clave_articulo INT NOT NULL AUTO_INCREMENT,
	descripcion_articulo TEXT NOT NULL,
	precio INT NOT NULL,
	modelo VARCHAR(20) NOT NULL,
	PRIMARY KEY(clave_articulo)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE venta(
	folio_venta INT NOT NULL AUTO_INCREMENT,
	clave_cliente INT NOT NULL,
	nombre VARCHAR(20) NOT NULL,
	total FLOAT NOT NULL,
	fecha DATE NOT NULL,
	PRIMARY KEY(folio_venta)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO clientes (clave_cliente,nombre,apaterno,amaterno,rfc) VALUES
(0001,"Hector","Ceja","Gomez", "CEGH960227WEQ");
INSERT INTO venta (folio_venta,clave_cliente,nombre,total,fecha) VALUES
(0001,0001,"Hector Ceja Gomez",1234.2,'2016-08-11');