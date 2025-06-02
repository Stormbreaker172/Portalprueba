CREATE DATABASE IF NOT EXISTS portal_cautivo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE portal_cautivo;

CREATE TABLE IF NOT EXISTS empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_empleado VARCHAR(20) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    eco_empleado VARCHAR(10) NOT NULL,
    fecha_ingreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);