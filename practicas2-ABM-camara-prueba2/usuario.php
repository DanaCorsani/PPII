<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link href=estilo.css rel=stylesheet>
</head>

<?php
switch ($_SESSION['id_rol']) {
    case 1:
        echo '<body class="admin">';
        break;
    case 2:
        echo '<body class="recepcionista">';
        break;
    case 3;
        echo '<body class="medico">';
        break;
    default:
        echo '<body>';
        break;
}
?>
<?php
if (!isset($_SESSION['email'])) {
    header("Location: logout.php");
} else {
?>
    <h1>Trabajo Practico - Practicas 2</h1>
    <!-- Barra de Usuario (Nombre y Botón de Cerrar Sesión) -->
    <div class="userbar">
        <div class="boton-izq"></div>

        <div class="username">
            <?php
            if (isset($_SESSION["id_rol"])) {
            ?>
                <span>Usuario: <?= $_SESSION['nombreCompleto']; ?></span>
                &nbsp;
                <form action="" method="post">
                    <input type="submit" name="logout" value="Cerrar Sesión">
                </form>
                <?php
                if (isset($_POST['logout'])){
                    if(!empty($_SESSION)){
                        $_SESSION = [];
                    }
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                }
                ?>
                
            <?php
            }
            ?>
        </div>

    </div>
    <br>
    <!-- Sección de Altas, Busqueda, y Listar. -->
    <div id="buscador">
        <ul>
            <li>
                <form action="?elegir-tabla">
                <label for="tabla">Tabla:</label>
                <select name="tabla" id="tabla">
                    <option value="-" selected disabled>-</option>
                    <?php
                    if($_SESSION['id_rol'] == 1){
                        // Tablas solo visibles para administradores (rol 1)
                        ?>
                        <option value="roles">Roles</option>
                        <option value="areas">Areas</option>
                        <option value="usuarios">Usuarios</option>
                        <?php
                    }
                    if($_SESSION['id_rol'] == 2){
                        ?>
                        <option value="usuarios">Medicos</option>
                        <?php
                    }
                    ?>
                    <option value="pacientes">Pacientes</option>
                    <option value="turnos">Turnos</option>
                </select>
            </li>
            <li>
                <input type="submit" name="accion" value="Dar de alta">
            </li>
            <li>
                <input type="submit" name="accion" value="Listar Tabla">
                </form>
            </li>
        </ul>
    </div>

    <?php
    if (isset($_GET['creado'])) {
        echo "<br>El Elemento fue creado.";
    }
    if (isset($_GET['modificado'])) {
        echo "<br>La selección fue modificada.";
    }
    if (isset($_GET['eliminado'])) {
        echo "<br>La selección fue eliminada.";
    }
    if (isset($_GET['nocambios'])) {
        echo "<br>No se realizaron cambios.";
    }

    ?>
    
    <?php

    #region PERMISOS
    /* echo "rol= " . $_SESSION['id_rol'] . "<br><br>";
    echo "Primero necesito listado segun aceso: Admin (todo), Rec (Turnos & Pacientes), Medico (Turnos & pacientes). <br>Puedo empezar por el listado de pacintes y turnos que es mas corto que listar todo. <br><br>";
    switch ($_SESSION['id_rol']) {
        case 1:
            echo 'Usuario Admin tiene que poder tocar todo (roles, areas, usuarios -medicos, recepcionistas, etc.-, pacientes, turnos.)<br>';
            echo "5 ABM x 3 botones: ABM roles, ABM areas, ABM usuarios, ABM pacientes, ABM turnos<br>";
            echo "Listado? Buscador?";
            break;
        case 2:
            echo 'Usuario recepcionista (usuarios principales) tienen que poder modificar Turnos y pacientes. <br>Pacientes porque al ingresar un paciente nuevo se deberían agregar los datos al DB. Tambien tenemos que poder tener acceso para averiguar x dni si ya se atendió, y telefono en caso de cancelacion.';
            echo "ABM Pacientes (solo listado, añadir, y modificar). <br>Pacientes porque al ingresar un paciente nuevo se deberían agregar los datos al DB. Tambien tenemos que poder tener acceso para averiguar x dni si ya se atendió, y telefono en caso de cancelacion.<br>";
            echo "ABM Turnos (ingreso usando input date & datetime en DB, listado x día / semana, listado x medico).";
            break;
        case 3;
            echo 'Usuario medico: todavía no se sus permisos. Ponele que tendria que poder ver los turnos con [solo] sus pacientes.<br>';
            echo 'Buscador -&gt; x paciente (Dni, nombre, apellido), x obra social <br>';
            echo 'Ver Turnos del día / semana / etc. (solo sus pacientes)';
            break;
        default:
            break;
    } */
    ?>
    </div>
    <br>
    <?php
    #endregion

    #region Busqueda (teoria)

    if(isset($_GET['lista-roles'])){
        ?>
        <p>Buscar: codigo y desc</p>
        <?php
    }
    if(isset($_GET['lista-areas'])){
        ?>
        <p>Buscar: codigo y desc</p>
        <?php
        
    }
    if(isset($_GET['lista-usuarios'])){
        ?>
        <p>Buscar: codigo, apellido, nombre, dni, email, tel, contraseña, area, rol. <br>
        (codigo y dni buscan numero)
        </p>
        <?php
        
    }
    if(isset($_GET['lista-pacientes'])){
        ?>
        <p>Buscar: codigo, apellido, nombre, dni, email, tel.</p>
        <?php
        
    }
    if(isset($_GET['lista-turnos'])){
        ?>
        <p>Buscar: turno, usuario (medico), area, paciente, fecha.</p>
        <?php
        
    }
    #endregion

    #region ABM

    #region Altas
    include_once "altas.php";
    #endregion

    #region Listar
    include_once "listar.php";
    #endregion

    #region Buscar
    include "buscar.php";
    #endregion

    #region Modificar
    include "modificar.php";
    #endregion

    #region Eliminar
    include "bajas.php";
    #endregion

    #endregion
    ?>

    <?php
    #region COMENTARIOS (VACIO)


    #endregion
    ?>
    </div>

<?php



} //<- (end) Si el usuario existe
?>
</body>

</html>