CREATE DATABASE santeria;

USE santeria;

CREATE TABLE usuarios(

id INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(100),

usuario VARCHAR(50) UNIQUE,

correo VARCHAR(150),

password VARCHAR(255),

rol VARCHAR(20),

fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE categorias(

id INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(100)

);

CREATE TABLE productos(

id INT AUTO_INCREMENT PRIMARY KEY,

categoria INT,

nombre VARCHAR(200),

descripcion TEXT,

precio_compra DECIMAL(10,2),

precio_venta DECIMAL(10,2),

stock INT,

imagen VARCHAR(255),

FOREIGN KEY(categoria)

REFERENCES categorias(id)

);

CREATE TABLE clientes(

id INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(150),

telefono VARCHAR(50),

correo VARCHAR(150),

direccion TEXT

);

CREATE TABLE ventas(

id INT AUTO_INCREMENT PRIMARY KEY,

cliente INT,

fecha DATETIME,

total DECIMAL(10,2),

FOREIGN KEY(cliente)

REFERENCES clientes(id)

);

CREATE TABLE detalle_ventas(

id INT AUTO_INCREMENT PRIMARY KEY,

venta INT,

producto INT,

cantidad INT,

precio DECIMAL(10,2),

subtotal DECIMAL(10,2),

FOREIGN KEY(venta)

REFERENCES ventas(id),

FOREIGN KEY(producto)

REFERENCES productos(id)

);