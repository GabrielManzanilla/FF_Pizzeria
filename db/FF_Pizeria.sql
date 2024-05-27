DROP DATABASE FF_Pizzeria;


-- Creando base de datos
CREATE DATABASE FF_Pizzeria;
USE FF_Pizzeria;

-- Creando tablas
CREATE TABLE Ingredientes (
    ingrediente_id INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255)
);

CREATE TABLE Tamanio (
    tamanio_id INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255),
    precio FLOAT

);

CREATE TABLE Clientes (
    cliente_id INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    numero BIGINT(20),
    nombre VARCHAR(255),
    direccion VARCHAR(255)
);


CREATE TABLE Empleados (
    empleado_id INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    numero INT(10),
    nombre VARCHAR(255)
);

CREATE TABLE Orden (
    orden_id INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fecha DATE,
    isEntregado BOOLEAN,
    fk_id_cliente INT(6),
    fk_id_empleado INT(6),
    FOREIGN KEY (fk_id_empleado) REFERENCES Empleados(empleado_id),
    FOREIGN KEY (fk_id_cliente) REFERENCES Clientes(cliente_id) -- Cambio realizado aqui
);

CREATE TABLE Details (
    fk_id_orden INT(6),
    fk_id_ingredientes INT(6),
    fk_id_tamanio INT(6),
    FOREIGN KEY (fk_id_orden) REFERENCES Orden(orden_id),
    FOREIGN KEY (fk_id_ingredientes) REFERENCES Ingredientes(ingrediente_id),
    FOREIGN KEY (fk_id_tamanio) REFERENCES Tamanio(tamanio_id)
);