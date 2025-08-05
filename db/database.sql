
CREATE DATABASE IF NOT EXISTS ECommerce;
DROP DATABASE IF EXISTS ECommerce;
USE ECommerce;

-- 1. Usuarios
CREATE TABLE `usuarios`(
    `id`     int          NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `email`  varchar(100) NOT NULL,
    `password`  varchar(255) NOT NULL,
    `rol`  enum('admin', 'user') NOT NULL DEFAULT 'user',
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
); 

-- 2. Beneficios Estrategias
CREATE TABLE `beneficios_estrategias` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `tipo` ENUM('descuento_fijo', 'combo', 'bonificacion', '2x1', 'regalo', 'normal') DEFAULT 'normal',
    `descripcion` TEXT,
    -- Parametros específicos por tipo
    `porcentaje_descuento` DECIMAL(5,2),         -- para 'descuento_porcentaje'
    `monto_descuento` DECIMAL(10,2),             -- para 'descuento_fijo'
    `precio_combo` DECIMAL(10,2),                -- para 'combo'
    `producto_aplica_id` INT,                    -- para 2x1 o regalo
    `producto_extra_id` INT,                     -- para regalo o producto extra en combo
    `estado` ENUM('activo', 'inactivo') DEFAULT 'activo',
    PRIMARY KEY (`id`)
);

-- 3. Beneficios Productos

CREATE TABLE `beneficio_productos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `beneficio_id` INT NOT NULL,
    `producto_id` INT NOT NULL,
    `tipo_asociacion` ENUM('principal', 'regalo', 'extra') NOT NULL DEFAULT 'principal',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`beneficio_id`) REFERENCES `beneficios_estrategias`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- 4. Beneficios Productos
DROP TABLE IF EXISTS usuario_beneficios;

CREATE TABLE `usuario_beneficios` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usuario_id` INT NULL,
    `beneficio_id` INT NOT NULL,
    `fecha_asignacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`beneficio_id`) REFERENCES `beneficios_estrategias`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Cambia 'descuento_porcentaje' por 'descuento_fijo' o algo permitido
-- Aquí te doy una corrección para que funcionen los inserts actuales:

INSERT INTO `beneficios_estrategias` 
(`id`, `tipo`, `descripcion`, `porcentaje_descuento`, `monto_descuento`, `precio_combo`, `producto_aplica_id`, `producto_extra_id`, `estado`)
VALUES
(1, 'descuento_fijo', '10% de descuento en cualquier compra', 10.00, NULL, NULL, NULL, NULL, 'activo'),
(2, 'descuento_fijo', '20% de descuento en productos seleccionados', 20.00, NULL, NULL, NULL, NULL, 'activo'),
(3, 'descuento_fijo', 'Descuento fijo de $5000 en compras mayores a $50000', NULL, 5000.00, NULL, NULL, NULL, 'activo'),
(4, 'descuento_fijo', 'Descuento de $2000 por fidelidad', NULL, 2000.00, NULL, NULL, NULL, 'activo'),
(5, 'combo', 'Combo de arroz y lentejas por $15000', NULL, NULL, 15000.00, NULL, NULL, 'activo'),
(6, 'combo', 'Combo de gaseosa + papas + hamburguesa por $25000', NULL, NULL, 25000.00, NULL, NULL, 'activo'),
(7, 'bonificacion', 'Bono de $10000 por referir a un amigo', NULL, NULL, NULL, NULL, NULL, 'activo'),
(8, 'bonificacion', 'Bono sorpresa por cumpleaños', NULL, NULL, NULL, NULL, NULL, 'activo'),
(9, '2x1', 'Llévate 2 jugos pagando 1', NULL, NULL, NULL, 201, 201, 'activo'),
(10, '2x1', 'Compra 1 cerveza y llévate otra gratis', NULL, NULL, NULL, 202, 202, 'activo');


INSERT INTO `beneficio_productos` (beneficio_id, producto_id, tipo_asociacion) VALUES
(1, 101, 'principal'),
(1, 102, 'regalo'),
(2, 103, 'extra'),
(2, 104, 'principal'),
(3, 105, 'regalo'),
(4, 101, 'extra'),
(5, 102, 'principal'),
(5, 103, 'regalo'),
(3, 104, 'extra'),
(4, 105, 'principal');



INSERT INTO `usuario_beneficios` (usuario_id, beneficio_id, fecha_asignacion) VALUES
(NULL, 1, '2025-08-01 10:00:00'),
(NULL, 2, '2025-08-01 11:30:00'),
(NULL, 3, '2025-08-02 09:15:00'),
(NULL, 4, '2025-08-02 14:45:00'),
(NULL, 5, '2025-08-03 12:00:00'),
(NULL, 2, '2025-08-03 15:20:00'),
(NULL, 3, '2025-08-04 08:00:00'),
(NULL, 1, '2025-08-04 16:10:00'),
(NULL, 5, '2025-08-05 13:50:00'),
(NULL, 4, '2025-08-05 18:30:00');
