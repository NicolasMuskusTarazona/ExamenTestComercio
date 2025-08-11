-- Active: 1754912183091@@127.0.0.1@3306

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

