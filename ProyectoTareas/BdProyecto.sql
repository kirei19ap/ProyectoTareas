-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS casostiendas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE casostiendas;

-- Tabla principal de casos
CREATE TABLE casos_tienda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tienda VARCHAR(100) NOT NULL,
    referencia VARCHAR(50),
    nombre_cliente VARCHAR(100),
    descripcion TEXT,
    fecha_creacion DATE,
    fecha_actualizacion DATE,
    guia_oca VARCHAR(50),
    estado_id INT,
    sub_estado_id INT,
    usuarioCarga INT
);

-- Tabla de estados
CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado VARCHAR(50) NOT NULL
);

-- Tabla de subestados
CREATE TABLE sub_estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado_id INT NOT NULL,
    nombre_sub_estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (estado_id) REFERENCES estados(id)
);

-- Insertar estados
INSERT INTO estados (id, nombre_estado) VALUES
(1, 'Concluido'),
(2, 'Demorado'),
(3, 'Cancelado'),
(4, 'Cambio'),
(5, 'Garantía');

-- Insertar subestados
INSERT INTO sub_estados (estado_id, nombre_sub_estado) VALUES
-- Demorado
(2, 'Reclamado'),
(2, 'Reclamado Gerencia'),
(2, 'Actualizado'),
(2, 'Sin Actualizar'),

-- Cancelado
(3, 'Retiro Enviado'),
(3, 'Retiro Demorado'),
(3, 'Retiro En Viaje'),
(3, 'Rechazado'),
(3, 'Cancelación Pedida'),

-- Garantía
(5, 'Service'),
(5, 'Cambio');


INSERT INTO casos_tienda 
(tienda, referencia, nombre_cliente, descripcion, fecha_creacion, fecha_actualizacion, guia_oca, estado_id, sub_estado_id, usuarioCarga)
VALUES 
('Tienda Central', 'REF123', 'Juan Pérez', 'Producto defectuoso', CURDATE(), CURDATE(), 'OCA456', 2, 1, 1);