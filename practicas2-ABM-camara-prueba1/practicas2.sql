# Practicas 2 - TP 2 - ABM
# Ejemplo de SQL

CREATE database practicas2;
USE practicas2;

CREATE TABLE roles(
id_rol int primary key auto_increment,
desc_rol varchar(20));

INSERT INTO roles VALUES
(1, "Admin"),
(2, "Recepcionista"),
(3, "Medico");

CREATE TABLE areas(
id_area int primary key auto_increment,
desc_area varchar(50));

INSERT INTO areas VALUES
(1, "Gerencia"),
(2, "Gastroenterologia"),
(3, "Traumatologia"),
(4, "Pediatria"),
(5, "Odontologia"),
(6, "Cardiologia"),
(7, "Optometria"),
(8, "Otorrinolaringologia");

CREATE TABLE usuarios(
id_usu int auto_increment primary key,
apellido varchar(30),
nombre varchar(30),
dni int,
email varchar(30),
tel varchar(30),
contra varchar(30),
id_area int,
id_rol int,
foreign key(id_area) references areas(id_area),
foreign key(id_rol) references roles(id_rol),
unique(dni));

INSERT INTO usuarios VALUES
(null, "Sudo", "Admin", 12345678, "super@example.com", "15-1234-5678", "example", 1, 1),
(null, "pcionista", "Rece", 98765432, "recepcionista@email.com", "11-87654321", "ejemplo", 1, 2),
(null, "Anna", "Mary", 44444444, "recepcionista@email.com", "11-87654321", "ejemplo", 1, 2),
(null, "House", "Gregory", 13579146, "housemd@example.com", "0800-5555", "vicodin", 2, 3),
(null, "Galilei", "Galileo", 112223333, "tierra@gira.com", "09090-90909", "sol", 3, 3),
(null, "Borges", "Jorge Luis", 12457892, "borg@example.com", "0800-1234", "lit", 4, 3);

CREATE TABLE pacientes(
id_pac int auto_increment primary key,
apellido varchar(30),
nombre varchar(30),
dni int,
email varchar(30),
tel varchar(30),
obra_soc varchar(50),
unique(dni));

INSERT INTO pacientes VALUES
(null, "Lin", "Jorge", 12345678, "miemail@ejemplo.com", "15-0800-5000", "OSDE"),
(null, "DeBarriga", "Dolores", 98765432, "ejemplo@email.com", "15-0500-8000", "Femeba"),
(null, "Quito", "Esteban", 13579864, "email@miejemplo.com", "15-1234-5678", "Medicus");

CREATE TABLE turnos(
id_tur int auto_increment primary key,
id_usu int,
id_area int,
id_pac int,
fecha date,
hora time,
foreign key(id_usu) references usuarios(id_usu),
foreign key(id_area) references areas(id_area),
foreign key(id_pac) references pacientes(id_pac));

# datetime o timestamp, para fecha con hora (datetime es mas sencillo x sin zona horaria)
# Ej: CREATE TABLE turnos(id_tur int auto_increment primary key, fecha datetime);
# cont'd Ej: INSERT INTO turnos VALUES (null, "2024-10-20 12:30:00");
# Alternativamente podriamos usar date (fecha) y time (hora) por separado.
INSERT INTO turnos VALUES
(null, 3, 3, 1, "2024-10-20", "13:30:00"),
(null, 3, 3, 1, "2024-10-10", "13:30:00"),
(null, 4, 4, 2, "2024-10-15", "13:00:00"),
(null, 3, 3, 3, "2024-10-20", "12:30:00");