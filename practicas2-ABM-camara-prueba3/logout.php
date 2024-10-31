<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
// (v) Continuo a sesión para decirle su nombre "hasta pronto <nombre>".
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggin out</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<?php
$_GET['accion'] = Null;
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
<div class="flex-form logout">
    <?php
    if (isset($_SESSION['email'])) {
        echo "<p>Hasta pronto " . $_SESSION['nombreCompleto'] . "</p>";
        echo "<br><p>Sesion Cerrada</p><br>";
        
    } else {
        echo "<p>Usuario no existente.</p>";
    }
    session_unset();
    session_destroy();
    ?>
    <p><a href=index.php><button>Iniciar Sesion</button></a></p>
    <br>
    <!-- Alternativamente puedo mostrar texto y botón con html (en vez de php) v -->
    <!-- <br><br>Sesion Cerrada<br><br> -->
    <!-- <a href="index.php"><button>Iniciar Sesion</button></a> -->
</div>
</body>

</html>