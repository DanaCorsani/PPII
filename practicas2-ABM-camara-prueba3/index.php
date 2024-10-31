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
        <h5>Falta:</h5>
        <ul>
            <li>Que los medicos puedan ver solo sus pacientes y turnos.</li>
            <li>Al modificar y Dar de alta quiero seleccionar de un desplegable las "opciones" de la base de datos. <br>Ej: Al dar de alta un nuevo paciente quiero selecionar la obra social de un desplegable (en vez de tener que escribir el numero de ID manualmente).</li>
            <li>Que luego de hacer una acción/operacion en la tabla, esta se vuelva a listar automáticamente.</li>
            <br>
            <li>Calendario con colorcitos para dias sin turnos, dias con turnos, y dias con turnos completos. <i>(opcional)</i></li>
            <li>Comprobante (pdf?) que se emita luego de dar de alta un turno. El mismo luego se puede enviar por email a los pacientes. <i>(opcional)</i></li>
            <li>Que el login al sistema se realice con dni y contraseña, en vez de con email y contraseña. <i>(opcional)</i></li>
        </ul>

    </main>

    <hr><br>

    <footer>
        © ISFDyT Nº 24 - 2024
    </footer>
</body>

</html>