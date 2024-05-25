DROP DATABASE FF_Pizzeria;


-- Creando base de datos
CREATE DATABASE FF_Pizzeria;
USE FF_Pizzeria;

-- Creando tablas
CREATE TABLE Ingredientes (
    id INT(6) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE Tamanio (
    id INT(6) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(255),
    precio FLOAT,
    PRIMARY KEY (id)
);

CREATE TABLE Clientes (
    id INT(6) AUTO_INCREMENT NOT NULL,
    numero BIGINT(20),
    nombre VARCHAR(255),
    direccion VARCHAR(255),
    PRIMARY KEY (id)
);


CREATE TABLE Empleados (
    id INT(6) AUTO_INCREMENT NOT NULL,
    numero INT(10),
    nombre VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE Orden (
    id INT(6) AUTO_INCREMENT NOT NULL,
    fecha DATE,
    isEntregado BOOL,
    id_cliente INT(6),
    id_empleado INT(6),
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id),
    PRIMARY KEY (id)
);

CREATE TABLE Details (
    id_order INT(6),
    id_ingredientes INT(6),
    id_tamanio INT(6),
    FOREIGN KEY (id_order) REFERENCES Orden(id),
    FOREIGN KEY (id_ingredientes) REFERENCES Ingredientes(id),
    FOREIGN KEY (id_tamanio) REFERENCES Tamanio(id)
);

-- Insertando datos por defecto
INSERT INTO Ingredientes(nombre) VALUES
    ('Queso Mozzarella'),
    ('Tomate'),
    ('Pepperoni'),
    ('Jamón'),
    ('Champiñones'),
    ('Aceitunas'),
    ('Cebolla'),
    ('Pimiento'),
    ('Anchoas'),
    ('Albahaca'),
    ('Tocino'),
    ('Pollo');

INSERT INTO Tamanio(nombre, precio) VALUES 
    ('Chica', 99.90),
    ('Mediana', 139.90),
    ('Grande', 219.90);

INSERT INTO Empleados(numero, nombre) VALUES 
    (NULL, 'Rafael Pacheco'),
    (NULL, 'Gabriel Estrella'),
    (9994919811, 'Gabriel Manzanilla'),
    (NULL, 'Isabel Estrella');
