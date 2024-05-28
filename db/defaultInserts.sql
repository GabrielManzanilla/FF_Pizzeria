
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


-- Insert clients in db
INSERT INTO Clientes (numero, nombre, direccion) VALUES
(1234567890, 'Juan Pérez', 'Calle Falsa 123'),
(2345678901, 'María López', 'Avenida Siempre Viva 742'),
(3456789012, 'Carlos Gómez', 'Boulevard de los Sueños 456'),
(4567890123, 'Ana Fernández', 'Plaza Mayor 789'),
(5678901234, 'Luis Martínez', 'Calle del Sol 1011'),
(6789012345, 'Laura Sánchez', 'Avenida del Mar 1213'),
(7890123456, 'Pedro Ramírez', 'Paseo de la Luna 1415'),
(8901234567, 'Sofía Torres', 'Calle del Río 1617'),
(9012345678, 'Jorge Vargas', 'Avenida de la Montaña 1819'),
(1234567891, 'Carmen Díaz', 'Plaza del Sol 2021');

-- Insertar Ordenes por defecto

INSERT INTO Orden (fecha, isEntregado, fk_id_cliente, fk_id_empleado) VALUES
('2024-05-01', FALSE, 1, 1),
('2024-05-02', FALSE, 2, 2),
('2024-05-03', FALSE, 3, 3),
('2024-05-04', FALSE, 4, 4),
('2024-05-05', FALSE, 5, 1);

-- Insertar datos en la tabla debil de los detalles
-- chica 1 ingrediente / mediana 2 ingredientes/ grande 3 ingredientes

INSERT INTO Details (fk_id_orden, fk_id_ingredientes, fk_id_tamanio) VALUES
    (1, 1, 2), -- Orden 1 con Queso Mozzarella y tamaño Mediana
    (1, 3, 2), -- Orden 1 con Pepperoni y tamaño Mediana
    (2, 1, 3), -- Orden 2 con Queso Mozzarella y tamaño Grande
    (2, 4, 3), -- Orden 2 con Jamón y tamaño Grande
    (2, 5, 3), -- Orden 2 con Champiñones y tamaño Grande
    (3, 2, 1), -- Orden 3 con Tomate y tamaño Chica
    (4, 6, 2), -- Orden 4 con Aceitunas y tamaño Mediana
    (4, 7, 2), -- Orden 4 con Cebolla y tamaño Mediana
    (5, 8, 3), -- Orden 5 con Pimiento y tamaño Grande
    (5, 9, 3), -- Orden 5 con Anchoas y tamaño Grande
    (5, 10, 3); -- Orden 5 con Albahaca y tamaño Grande

-- Insertando roles
INSERT INTO Roles (nombre) VALUES ('Cocinero');
INSERT INTO Roles (nombre) VALUES ('Repartidor');
INSERT INTO Roles (nombre) VALUES ('Recepcionista');

-- Insertando empleados
INSERT INTO Empleados (numero, nombre, fk_rol_id) VALUES (12345, 'Juan Perez', 1); -- Cocinero
INSERT INTO Empleados (numero, nombre, fk_rol_id) VALUES (67890, 'Maria Gomez', 2); -- Repartidor
INSERT INTO Empleados (numero, nombre, fk_rol_id) VALUES (54321, 'Luis Torres', 3); -- Recepcionista