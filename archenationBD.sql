CREATE USER archenationadmin WITH ENCRYPTED PASSWORD '4rch3n4t10n';
CREATE USER archenationuser WITH ENCRYPTED PASSWORD 'archeuser1234';
CREATE USER archenationclient WITH ENCRYPTED PASSWORD 'archeclient';

CREATE DATABASE archenationbd WITH OWNER archenationadmin;
GRANT ALL PRIVILEGES ON DATABASE archenationbd TO archenationadmin;


CREATE TABLE usuario(
idUsuario NUMERIC(2,0) NOT NULL,
usuario VARCHAR(50) NOT NULL UNIQUE,
password CHAR(32) NOT NULL,
nombre VARCHAR(60) NOT NULL,
aPaterno VARCHAR(40) NOT NULL,
aMaterno VARCHAR(40) NULL,
telefono CHAR(12) NOT NULL,
email VARCHAR(60) NOT NULL UNIQUE,
direccion VARCHAR(150) NOT NULL,
rol CHAR(1) NOT NULL,
activo BOOLEAN NOT NULL,
CONSTRAINT pkUsuario PRIMARY KEY(idUsuario),
CONSTRAINT verificarCorreo CHECK (email ~ '^[A-Za-z0-9._%\-+!#$&/=?^|~]+@[A-Za-z0-9.-]+[.][A-Za-z]+$'),
CONSTRAINT verificarUsuario CHECK (usuario ~ '^[A-Za-z0-9]+[A-Za-z0-9_.$-]*$'),
CONSTRAINT verificarNombre CHECK (nombre ~ '^[A-Za-zÁÉÍÓÚáéíóúüÜ]+[A-Za-zÁÉÍÓÚáéíóúüÜ ]*$'),
CONSTRAINT verificarAPaterno CHECK (aPaterno ~ '^[A-Za-zÁÉÍÓÚáéíóúüÜ]+[A-Za-zÁÉÍÓÚáéíóúüÜ ]*$'),
CONSTRAINT verificarAMaterno CHECK (aMaterno ~ '^[A-Za-zÁÉÍÓÚáéíóúüÜ]+[A-Za-zÁÉÍÓÚáéíóúüÜ ]*$'),
CONSTRAINT verificarTelefono CHECK (telefono ~ '[0-9]{10,12}'),
CONSTRAINT verificarRol CHECK (rol ~ 'c|a'));

CREATE TABLE articulo(
idArticulo NUMERIC(2,0) NOT NULL,
nombre VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
imagen VARCHAR(255) NULL,
precio NUMERIC(7,2) NOT NULL,
cantidad NUMERIC(3,0) NOT NULL,
enDescuento BOOLEAN NOT NULL,
porcentajeDescuento NUMERIC(4,1) NOT NULL,
activo BOOLEAN NOT NULL,
CONSTRAINT pkArticulo PRIMARY KEY(idArticulo),
CONSTRAINT verificarImagen CHECK (imagen ~ '[A-Za-z0-9ÁÉÍÓÚáéíóúüÜ]+.(jpg|jpeg|png|gif)$'),
CONSTRAINT verificarPrecio CHECK (precio >= 0.00),
CONSTRAINT verificarCantidad CHECK (cantidad >= 0),
CONSTRAINT verificarDescuento CHECK (porcentajeDescuento > 0.0 AND porcentajeDescuento <= 100.0));

CREATE TABLE venta(
idVenta NUMERIC(3,0) NOT NULL,
idUsuario NUMERIC(2,0) NOT NULL,
fechaVenta TIMESTAMP NOT NULL,
totalVenta NUMERIC(8,2) NOT NULL,
status CHAR(1) NOT NULL,
CONSTRAINT pkVenta PRIMARY KEY(idVenta),
CONSTRAINT fkVentaUsuario FOREIGN kEY(idUsuario) REFERENCES usuario(idUsuario)
ON UPDATE CASCADE
ON DELETE RESTRICT,
CONSTRAINT verificarTotalVenta CHECK(totalVenta >= 0),
CONSTRAINT verificarStatusVenta CHECK(status ~ 't|p|c'));

CREATE TABLE entrega(
idEntrega NUMERIC(3,0) NOT NULL,
idVenta NUMERIC(3,0) NOT NULL,
domicilioEntrega VARCHAR(150) NOT NULL,
nombreReceptor VARCHAR(60) NOT NULL,
fechaEnvio DATE NULL,
fechaEntrega DATE NULL,
recibido BOOLEAN NULL,
CONSTRAINT pkEntrega PRIMARY KEY(idEntrega),
CONSTRAINT fkEntregaVenta FOREIGN KEY(idVenta) REFERENCES venta(idVenta)
ON UPDATE CASCADE
ON DELETE RESTRICT,
CONSTRAINT verificarNombreEntrega CHECK (nombreReceptor ~ '^[A-Za-zÁÉÍÓÚáéíóúüÜ]+[A-Za-zÁÉÍÓÚáéíóúüÜ ]*$'),
CONSTRAINT verificarFechaEntrega CHECK (fechaEntrega >= fechaEnvio));

CREATE TABLE contenidoVenta(
idVenta NUMERIC(3,0) NOT NULL,
idArticulo NUMERIC(2,0) NOT NULL,
cantidad NUMERIC(3,0) NOT NULL,
iva NUMERIC(3,1) NOT NULL,
precioFinal NUMERIC(7,2) NOT NULL,
CONSTRAINT pkContenidoVenta PRIMARY KEY(idVenta,idArticulo),
CONSTRAINT fkContenidoVentaVenta FOREIGN KEY(idVenta) REFERENCES venta(idVenta)
ON DELETE RESTRICT
ON UPDATE RESTRICT,
CONSTRAINT fkContenidoVentaArticulo FOREIGN KEY(idArticulo) REFERENCES articulo(idArticulo)
ON DELETE RESTRICT
ON UPDATE RESTRICT,
CONSTRAINT verificarCantidadVenta CHECK (cantidad > 0),
CONSTRAINT verificarIva CHECK (iva > 0.0),
CONSTRAINT verificarPrecioFInal CHECK (precioFinal > 0));

GRANT INSERT, SELECT, UPDATE (usuario,password,nombre,aPaterno,aMaterno,telefono,email,direccion) ON usuario TO archenationclient;
GRANT INSERT, SELECT , UPDATE (usuario,password,nombre,aPaterno,aMaterno,telefono,email,direccion,activo), DELETE ON usuario TO archenationuser;

GRANT SELECT (idArticulo,nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento,activo), UPDATE, INSERT,DELETE ON articulo TO archenationuser;
GRANT SELECT (nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento,activo) ON articulo TO archenationclient;

GRANT SELECT, INSERT ON entrega TO archenationclient;
GRANT SELECT, INSERT, UPDATE ON entrega TO archenationuser;

GRANT INSERT, SELECT, DELETE, UPDATE ON venta TO archenationclient;
GRANT INSERT, SELECT, UPDATE, DELETE ON venta TO archenationuser;

GRANT INSERT, SELECT,INSERT,UPDATE ON contenidoVenta TO archenationclient;
GRANT INSERT, SELECT, UPDATE, INSERT ON contenidoVenta TO archenationuser;

GRANT SELECT, UPDATE, DELETE, INSERT ON usuario TO archenationadmin;
GRANT SELECT, UPDATE, DELETE, INSERT ON articulo TO archenationadmin;
GRANT SELECT, UPDATE, DELETE, INSERT ON entrega TO archenationadmin;
GRANT SELECT, UPDATE, DELETE, INSERT ON venta TO archenationadmin;
GRANT SELECT, UPDATE, DELETE, INSERT ON contenidoVenta TO archenationadmin;

INSERT INTO usuario VALUES(1,'archeadmin00','5e11fe1a3872ea9a45da85ef85bbe1d6','Marvin','Rayas','Sanchez','5547139929','naruhina1189@gmail.com','Casa de Marvin','a','t');
INSERT INTO articulo VALUES(1,'Arco Recurvo 30lb','Arco de PVC Industrial de 30 libras','arco1.jpg',600.00,30,'t',10.0,'t');
INSERT INTO articulo VALUES(2,'Arco Recurvo 32lb','Arco de PVC Industrial de 32 libras','arco2.jpg',600.00,20,'f',0.0,'t');
INSERT INTO articulo VALUES(3,'Arco Recurvo 35lb','Arco de PVC Industrial de 35 libras','arco3.jpg',600.00,20,'f',0.0,'t');
INSERT INTO articulo VALUES(4,'Arco Recurvo 38lb','Arco de PVC Industrial de 38 libras','arco4.jpg',600.00,20,'f',0.0,'t');
INSERT INTO articulo VALUES(5,'Arco Recurvo 40lb','Arco de PVC Industrial de 40 libras','arco5.jpg',600.00,20,'f',0.0,'t');
INSERT INTO articulo VALUES(6,'Arco Recurvo 30lb Tigre Toño','Arco de PVC Industrial de 30 libras con diseño de tigre, tipo el tigre Toño','arco6.jpg',700.00,5,'t',5.0,'t');
INSERT INTO articulo VALUES(7,'Arco Recurvo 30lb Naranja','Arco de PVC Industrial de 30 libras con diseño naranja y cintas de colores','arco7.jpg',650.00,30,'t',10.0,'t');
INSERT INTO articulo VALUES(8,'Docena de Flechas','Flechas de madera para tirar','flechas.jpg',300.00,20,'f',0.0,'t');
INSERT INTO articulo VALUES(9,'Arco Recurvo 42lb','Arco de PVC Industrial de 42 libras','arco8.jpg',700.00,10,'t',10.0,'t');
INSERT INTO articulo VALUES(10,'Arco Recurvo 25lb','Arco de PVC de 25 libras para novatos','arco9.jpg',600.00,5,'f',0.0,'t');
#La contraseña de archeadmin es 4rch3n4t10n