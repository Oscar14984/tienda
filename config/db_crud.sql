
CREATE DATABASE IF NOT EXISTS tienda_nissan;

USE tienda_nissan;

CREATE TABLE productos(
    usuario_id INT(10) AUTO_INCREMENT NOT NULL,
    usuario_nombre VARCHAR(70) NOT NULL,
    usuario_apellido VARCHAR(70) NOT NULL,
    usuario_email VARCHAR(100) NOT NULL,
    usuario_usuario VARCHAR(30) NOT NULL,
    usuario_clave VARCHAR(200) NOT NULL,
    usuario_foto VARCHAR(535) NOT NULL,
    usuario_creado TIMESTAMP NULL,
    usuario_actualizado TIMESTAMP NULL,
    PRIMARY KEY (usuario_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;