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

-- 2. Plantas<
CREATE TABLE `plantas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `categoria` ENUM('cactus', 'ornamental', 'frutal','Sin familia') DEFAULT 'Sin familia',
    `familia` varchar(100) NOT NULL,
    `proximo_riego` DATETIME,
    PRIMARY KEY (`id`)
);

-- 3. Riego

CREATE TABLE `riego` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `plantas_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`plantas_id`) REFERENCES `plantas`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `plantas` 
(`id`, `nombre`, `categoria`, `familia`,`proximo_riego`)
VALUES
(1, 'Aloe Vera', 'cactus', 'Asphodelaceae','2025-08-14'),
(2, 'Lavanda', 'ornamental', 'Lamiaceae','2025-08-07');

