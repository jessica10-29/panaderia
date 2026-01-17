CREATE DATABASE panaderia;
USE panaderia;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE,
    clave VARCHAR(255)
);

INSERT INTO usuarios (usuario, clave)
VALUES ('admin', MD5('1234'));

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100),
    bunuelos INT DEFAULT 0,
    pan_basico INT DEFAULT 0,
    croissant INT DEFAULT 0,
    pandebono INT DEFAULT 0,
    pasteles INT DEFAULT 0,
    palitos_queso INT DEFAULT 0,
    jugos INT DEFAULT 0,
    cafe INT DEFAULT 0,
    galletas INT DEFAULT 0,
    pan_queso INT DEFAULT 0,
    empanadas INT DEFAULT 0,
    tortas INT DEFAULT 0,
    total DECIMAL(10,2) DEFAULT 0,
    estado ENUM('En espera','En proceso','Despachado') NOT NULL
);
