create database practicas2;
use practicas2;

create table especialidades(
id tinyint auto_increment primary key,
nombre varchar(30));

create table especialistas(
id tinyint auto_increment primary key, 
matricula tinyint,
nombre varchar(30),
apellido varchar(40),
dni tinyint,
especialidad_id tinyint,
mail varchar(255),
telefono varchar(15),
foreign key (especialidad_id) references especialidades(id));

insert into especialidades(nombre) 
values ('Especialidad 1'), ('Especialidad 2'), ('Especialidad 3'), ('Especialidad 4'),
('Especialidad 5'), ('Especialidad 6'), ('Especialidad 7'), ('Especialidad 8');