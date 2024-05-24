Create database FF_Pizzeria;
Use FF_Pizzeria;

Create table Ingredientes(
    id int(6) auto_increment not null,
    nombre varchar(255)
);

Create table Tamanio(
    id int(6) auto_increment not null,
    nombre varchar(255),
    precio float
);

Create table Clientes(
    id int(6) auto_increment not null,
    numero int(10),
    nombre varchar(255),
    direccion varchar(255)
);

Create table Empleados(
    id int(6) auto_increment not null,
    numero int(10),
    nombre varchar(255)
);

Create table Order(
    id int(6) auto_increment not null,
    fecha date,
    isEntregado bool,
    id_Cliente int(6),
    id_empleado int(6),
    foreing key id_empleado references Empleados(id),
    id_cliente int(6),
    foreing key id_cliente references Clientes(id)
);

Create table Details(
    id_order int(6),
    foreing key id_order references Order(id),
    id_ingredientes int(6),
    foreing key id_ingredientes references Ingredientes(id),
    id_tamanio int(6),
    foreing key id_tamanio references Tamanio(id)
);

Insert into Ingredientes(nombre) values
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

Insert into Tamanio(nombre, precio) values 
    ("Chica", 99.90),
    ("Mediana", 139.90),
    ("Grande", 219.90);


Insert into Empleados( numero,nombre) values 
    ("Rafael Pacheco",),
    ("Gabriel Estrella",),
    ("Gabriel Manzanilla", 9994919811),
    ("Isabel Estrella", );

