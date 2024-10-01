CREATE database practicas2;

USE practicas2;

CREATE TABLE pacientes(
pac_id tinyint auto_increment primary key,
pac_apellido varchar(30),
pac_nombre varchar(30),
pac_dni tinyint,
pac_tel varchar(30),
pac_email varchar(40));

insert into pacintes values
(null, "Lin", "Jorge", 12345678, "15-0800-5000", "miemail@ejemplo.com"),
(null, "DeBarriga", "Dolores", 98765432, "15-0500-8000", "ejemplo@email.com"),
(null, "Quito", "Esteban", 13579864, "15-1234-5678", "email@miejemplo.com");
