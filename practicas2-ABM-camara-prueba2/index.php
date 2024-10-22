<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP ABM</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <header>
        <h1>TP 2</h1>
        <h2>Practicas 2 - Prof. Roldan</h2>
    </header>
    <hr>

    <main>
        <form action="login.php" method="post">
            <label for="email">Email</label> &nbsp; <input name="email" type="email" id="email" maxlength="30"> <br>
            <label for="Password">Contraseña</label> &nbsp; <input name="contra" type="password" id="Password" maxlength="30"> <br>
            <input type="submit" value="Ingresar" name="login">
        </form>

        <?php
        // Prueba: funciona! =) v
        if (isset($_GET['noUsu'])) {
            echo "<br>No se encontró el usuario con email " . $_GET['noUsu'];
        }
        if (isset($_GET['badPass'])) {
            echo "<br>La contraseña es incorrecta";
        }
        ?>

        <br>
        <hr>
        <ul>
            <li>html &emsp;&emsp;√</li>
            <li>css &emsp;&emsp;√</li>
            <li>DB especialidades &emsp;&emsp;√</li>
            <li>DB medicos &emsp;&emsp;√</li>
            <li>DB pacientes &emsp;&emsp; &lt;-
                <ul>
                    <li>Dni</li>
                    <li>Apellido</li>
                    <li>Nombre</li>
                    <li>Obra social</li>
                    <li>Especialidad / Área médica</li>
                    <li>Medico</li>
                    <li>Teléfono</li>
                </ul>
            </li>
            <li>DB Turnos &emsp;&emsp;(To-do)
                <ul>
                    <li>30 min c/u?</li>
                    <li>horarios clinica 8-18 ?</li>
                    <li>medicos =/= horario c/u ?</li>
                </ul>
            </li>
            <li>Listado turnos&emsp;&emsp;(To-do)
                <ul>
                    <li>Listado x date, Ascendente</li>
                    <li>DATE expects the format YYYY-MM-DD; DATETIME and TIMESTAMP expect the format YYYY-MM-DD HH:MM:SS (datetime is better for local time, as it doesn't account for timezones; timestamp needs to be properly set in with timezones). I think I'll go with datetime.</li>
                    <li></li>
                </ul>
            </li>
        </ul>

        <h4>Permisos</h4>
        <ul>
            <li>Usuario Admin tiene que poder tocar todo (roles, areas, usuarios -medicos, recepcionistas, etc.-, pacientes, turnos.)</li>
            <li>Usuario recepcionista (usuarios principales) tienen que poder modificar Turnos y pacientes. <br>Pacientes porque al ingresar un paciente nuevo se deberían agregar los datos al DB. Tambien tenemos que poder tener acceso para averiguar x dni si ya se atendió, y telefono en caso de cancelacion.</li>
            <li>Usuario medico: todavía no se sus permisos. Ponele que tendria que poder ver los turnos con [solo] sus pacientes.</li>
        </ul>


        <br>
        <hr>

        <h4>SQL</h4>

        <ul>
            <li># Practicas 2 - TP 2 - ABM</li>
            <li># Ejemplo de SQL</li>
            <br>
            <li>CREATE DATABASE practicas2;</li>
            <li>USE practicas2;</li>
            <br>
            <li>CREATE TABLE roles(</li>
            <li>id_rol int primary key auto_increment,</li>
            <li>desc_rol varchar(20));</li>
            <br>
            <li>INSERT INTO roles VALUES</li>
            <li>(1, "Admin"),</li>
            <li>(2, "Recepcionista"),</li>
            <li>(3, "Medico");</li>
            <li></li>
            <br>
            <li>CREATE TABLE areas(</li>
            <li>id_area int primary key auto_increment,</li>
            <li>desc_area varchar(50));</li>
            <br>
            <li>INSERT INTO areas VALUES</li>
            <li>(1, "Gerencia"),</li>
            <li>(2, "Gastroenterologia"),</li>
            <li>(3, "Traumatologia"),</li>
            <li>(4, "Pediatria"),</li>
            <li>(5, "Odontologia"),</li>
            <li>(6, "Cardiologia"),</li>
            <li>(7, "Optometria"),</li>
            <li>(8, "Otorrinolaringologia");</li>
            <br>
            <li>CREATE TABLE usuarios(</li>
            <li>id_usu int auto_increment primary key,</li>
            <li>apellido varchar(30),</li>
            <li>nombre varchar(30),</li>
            <li>dni int,</li>
            <li>email varchar(30),</li>
            <li>tel varchar(30),</li>
            <li>contra varchar(30),</li>
            <li>id_area int,</li>
            <li>id_rol int,</li>
            <li>foreign key(id_rol) references roles(id_rol),</li>
            <li>foreign key(id_area) references areas(id_area),</li>
            <li>unique(dni));</li>
            <br>
            <li>INSERT INTO usuarios VALUES</li>
            <li>(null, "Sudo", "Admin", 12345678, "super@example.com", "15-1234-5678", "example", 1, 1),</li>
            <li>(null, "pcionista", "Rece", 98765432, "recepcionista@myemail.com", "11-87654321", "ejemplo", 1, 2),</li>
            <li>(null, "Anna", "Mary", 44444444, "recepcionista@email.com", "11-87654321", "ejemplo", 1, 2),</li>
            <li>(null, "House", "Gregory", 13579146, "housemd@example.com", "0800-5555", "vicodin", 2, 3),</li>
            <li>(null, "Galilei", "Galileo", 112223333, "tierra@gira.com", "09090-90909", "sol", 3, 3),</li>
            <li>(null, "Borges", "Jorge Luis", 12457892, "borg@example.com", "0800-1234", "lit", 4, 3);</li>
            <br>
            <li>CREATE TABLE pacientes(</li>
            <li>id_pac int auto_increment primary key,</li>
            <li>apellido varchar(30),</li>
            <li>nombre varchar(30),</li>
            <li>dni int,</li>
            <li>email varchar(30),</li>
            <li>tel varchar(30),</li>
            <li>obra_social varchar(50)</li>
            <li>unique(dni));</li>
            <br>
            <li>INSERT INTO pacientes VALUES</li>
            <li>(null, "Lin", "Jorge", 12345678, "miemail@ejemplo.com", "15-0800-5000", "OSDE"),</li>
            <li>(null, "DeBarriga", "Dolores", 98765432, "ejemplo@email.com", "15-0500-8000", "Femeba"),</li>
            <li>(null, "Quito", "Esteban", 13579864, "email@miejemplo.com", "15-1234-5678", "Medicus");</li>
            <br>
            <li>CREATE TABLE turnos(</li>
            <li>id_tur int auto_increment primary key,</li>
            <li>id_usu int,</li>
            <li>id_area int,</li>
            <li>id_pac int,</li>
            <li>tur_fecha date,</li>
            <li>tur_hora time,</li>
            <li>foreign key(id_usu) references usuarios(id_usu),</li>
            <li>foreign key(id_area) references areas(id_area),</li>
            <li>foreign key(id_pac) references pacientes(id_pac));</li>
            <br>
            <li># datetime o timestamp, para fecha con hora (datetime es mas sencillo x sin zona horaria)</li>
            <li># Ej: CREATE TABLE turnos(id_tur int auto_increment primary key, fecha datetime);</li>
            <li># cont'd Ej: INSERT INTO turnos VALUES (null, "2024-10-20 12:30:00");</li>
            <li># Alternativamente podriamos usar date (fecha) y time (hora) por separado.</li>
            <li>INSERT INTO turnos VALUES</li>
            <li>(null, 3, 3, 1, "2024-10-10", "13:30:00"),</li>
            <li>(null, 4, 4, 2, "2024-10-15", "13:00:00"),</li>
            <li>(null, 3, 3, 3, "2024-10-20", "12:30:00");</li>
        </ul>

    </main>

    <hr><br>

    <footer>
        © ISFDyT Nº 24 - 2024
    </footer>
</body>

</html>