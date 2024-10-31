<?php
$usuario = $_POST['email'];
$contra = $_POST['contra'];

// echo "Email: ".$usuario." Pass: ".$contra;

try {
    require_once "conexion.php";
    $cn = conectar();
    $sql = "select * from usuarios where email='$usuario';";
    $resultset = mysqli_query($cn, $sql);
    
    if (mysqli_affected_rows($cn) > 0) {
        // Si entro acá es xq encontré el usuario
        $registro = mysqli_fetch_assoc($resultset); // <- creo un array asociativo, con los campos como índices.

        /* var_dump($registro); */ /* <- funciona  */
        if ($registro['contra'] == $contra) {
            // Si entro acá es xq la contraseña es correcta.
            /*  echo "Iniciar sesion"; */
            session_start(); // <- Inicio sesión, así me guarda las variables siguientes (v)
            $_SESSION['email'] = $registro['email'];
            $_SESSION['id_rol'] = $registro['id_rol'];
            /* $_SESSION['rolDesc'] = $registro_roles['rolDesc']; */
            $_SESSION['nombreCompleto'] = $registro['nombre'] . " " . $registro['apellido'];

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $_SESSION['fechaLogin']=date('Y-m-d H:i:s');
            $_SESSION['fechaLogin-str'] = strtotime($_SESSION['fechaLogin']);
            // v Los tres usuarios son redirigidos a la misma página, pero eso podríamos modificarlo.
            switch ($_SESSION['id_rol']) {
                case 1:
                    // Admin
                    header("location: usuario.php");
                case 2:
                    //Recepcionista
                    header("location: usuario.php");
                case 3:
                    // Medico
                    header("location: usuario.php");
                break;
                default:
                echo "error <br> ROL NO DEFINIDO";
                    // ^ Si en la tabla tengo un usuario con rol 5 me va a aparecer esto.
                    echo "<br><a href='logout.php'><button>Salir</button></a>";
                    break;
            }
    } else {
        //echo "Error. Contraseña Incorrecta";
        header("Location:index.php?badPass");
    }
    // A diferencia del de usuario incorrecto (v) no le mostramos "la contraseña 'X' es incorrecta", por motivos de seguridad.
}
    else {
        //echo "Error. No se encontro el usuario $usuario";
        header("Location:index.php?noUsu=$usuario");
    }
}catch(mysqli_sql_exception $e){
    echo "<p>Error de Servidor.</p> <p>Consulte con su proveedor de Base de Datos.</p> <p><a href='index.php'>Volver</a></p>";
    exit();
    // ^ Ojo! Salgo de todo, no solo la base de datos, sino que corta toda la carga de datos y la pagina.
}

?>
