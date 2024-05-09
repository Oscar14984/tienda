
CREATE DATABASE IF NOT EXISTS tienda_nissan;

USE tienda_nissan;

CREATE TABLE productos(
    id INT(10) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    precio DECIMAL(10,2) DEFAULT NULL,
    cantidad INT DEFAULT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;