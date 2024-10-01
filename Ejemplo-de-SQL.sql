# Algoritmos 2 - TP ABM - Guía 2
# Ejemplo de SQL

# creo base de datos
create database julietaCamaraGuia2;
# uso la base de datos (voy a crear tablas dentro de esta)
use julietaCamaraGuia2;

# TABLA ROLES: 
create table roles(
rol tinyint,
rolDesc varchar(20),
primary key(rol));

# roles ejemplo
insert into roles values
(1, "Admin"),
(2, "Empleado"),
(3, "Profesor");

# defino los roles primero, antes de los usuarios

# USUARIOS: 
create table usuarios(
idUsu int auto_increment primary key,
nombre varchar(30),
apellido varchar(30),
email varchar(30),
contra varchar(30),
rol tinyint,
# rol hace referencia a "rol" de la tabla roles.
foreign key(rol) references roles(rol),
# El campo email es unico, osea me va a dar error si creo otra entrada con el mismo email
unique(email));

# usuarios ejemplo
insert into usuarios values
(null, "King", "Kong", "kingkong@yahoo.com", "gorilla", 1),
(null, "Julieta", "Camara", "jcamara@hotmail.com", "814", 2),
(null, "Paula", "Giaimo", "pau_giaimo@gmail.com", "pg123", 3);

# PRODUCTOS:
create table productos(
    codigo int auto_increment primary key,
    descripcion varchar(30),
    precio float);

# productos ejemplo
insert into productos values
(null, "Alfajor", 405.99),
(null, "Chicle", 200.80),
(null, "Bonbon", 310.10),
(null, "Cuaderno", 110.15),	
(null, "Botella de Agua", 300.6),	
(null, "Fibron", 305.55),
(null, "Cinta Scotch", 123.46), 
(null, "Lapiz HB", 90.99);
