<?php
if (isset($_GET['accion'])) {
    if (isset($_GET['tabla'])) {
        $tabla = $_GET['tabla'];
        if ($_GET['accion'] == "Dar de alta") {
?>
            <div class="flex-form altas">
                <h4>Ingresar
                    <?php
                    switch ($tabla) {
                        case 'roles':
                            echo "Rol";
                            break;
                        case 'areas':
                            echo "Area";
                            break;
                        case 'usuarios':
                            echo "Usuario";
                            break;
                        case 'pacientes':
                            echo "Paciente";
                            break;
                        case 'turnos':
                            echo "Turno";
                            break;
                        default:
                            echo "ERROR de Tabla";
                            break;
                    }
                    ?>
                </h4>
                <?php
                switch ($tabla) {
                    case 'roles':
                ?>
                        <form action="" method="post">
                            <input type=hidden name=altaRol>
                            <label for="desc_rol">Descripcion: </label>
                            <input type="text" name="desc_rol">
                            <br>
                            <input type="submit" value="Dar de alta Rol">
                        </form>
                    <?php
                        break;
                    case 'areas':
                    ?>
                        <form action="" method="post">
                            <input type=hidden name=altaArea>
                            <label for="area">Descipcion: </label>
                            <input type="text" name="area">
                            <br>
                            <input type="submit" value="Dar de alta Area">
                        </form>
                    <?php
                        break;
                    case 'usuarios':
                    ?>
                        <form action="" method="post">
                            <input type=hidden name=altaUsu>
                            <label for="nombre">Nombre: </label>
                            <input type="text" name="nombre">
                            <br>
                            <label for="apellido">Apellido: </label>
                            <input type="text" name="apellido">
                            <br>
                            <label for="dni">DNI: </label>
                            <input type="number" max=99999999 min=0 name="dni">
                            <br>
                            <label for="email">E-mail: </label>
                            <input type="email" name="email">
                            <br>
                            <label for="contra">Contraseña: </label>
                            <input type="password" name="contra">
                            <br>
                            <label for="tel">Telefono: </label>
                            <input type="text" name="tel">
                            <br>
                            <label for="area">Area: </label>
                            <input type="number" name="area" min=1>
                            <br>
                            <label for="rol">Rol: </label>
                            <input type="number" name="rol" min=1>
                            <br>
                            <input type="submit" value="Dar de alta Usuario">
                        </form>
                    <?php
                        break;
                    case 'pacientes':
                    ?>
                        <form action="" method="post">
                            <input type=hidden name=altaPac>
                            <label for="nombre">Nombre: </label>
                            <input type="text" name="nombre">
                            <br>
                            <label for="apellido">Apellido: </label>
                            <input type="text" name="apellido">
                            <br>
                            <label for="dni">DNI: </label>
                            <input type="number" max=99999999 min=0 name="dni">
                            <br>
                            <label for="email">E-mail: </label>
                            <input type="email" name="email">
                            <br>
                            <label for="tel">Telefono: </label>
                            <input type="text" name="tel">
                            <br>
                            <label for="obraSoc">Obra Social: </label>
                            <input type="text" name="obraSoc">
                            <br>
                            <input type="submit" value="Dar de alta Paciente">
                        </form>
                    <?php
                        break;
                    case 'turnos':
                    ?>
                        <form action="" method="post">
                            <input type=hidden name=altaTur>
                            <label for="medico">ID Medico: </label>
                            <input type="number" name="medico" min=1>
                            <br>
                            <label for="area">ID Area: </label>
                            <input type="number" name="area" min=1>
                            <br>
                            <label for="paciente">ID Paciente: </label>
                            <input type="number" name="paciente" min=1>
                            <br>
                            <label for="fecha">Fecha: </label>
                            <input type="date" name="fecha" placeholder="Año-Mes-Dia">
                            <br>
                            <label for="hora">Hora: </label>
                            <input type="time" name="hora" placeholder="Hor:Min:Seg">
                            <br>
                            <input type="submit" value="Dar de alta Turno">
                        </form>
                    <?php
                        break;
                    default:
                        echo "Error. Tabla Incorrecta a ingresar.<br>";
                        break;
                }
            }
        } else {
            // Si puse botón de accion pero no elegí tabla.
            echo "Error. Debe elegir una tabla para realizar esta acción.<br>";
        }
    }

    if (isset($_POST['altaRol'])) {
        
        $desc_rol = $_POST['desc_rol'];
        try {
        $sql = "insert into $tabla (desc_rol) values ('$desc_rol');";
        echo $sql;

        require_once "conexion.php";
        $cn = conectar();
    } catch (mysqli_sql_exception $e) {
        echo "Fallo en la conexión.";
        echo $e->getMessage();
        exit();
    } try {
        
        mysqli_query($cn, $sql);
        
    } catch (mysqli_sql_exception $e) {
        echo "Fallo en la conexión.";
        echo $e->getMessage();
        exit();
    }
        
        if (mysqli_affected_rows($cn) > 0) {
            echo "<p>El rol $rol fue cargado con éxito</p>";
            Header("Location: usuario.php?creado");
        } else {
            echo "<p>No se pudo realizar la conexion.</p>";
        }
        
        mysqli_close($cn);
    }

    if (isset($_POST['altaArea'])) {
        $area = $_POST['area'];

        $sql = "insert into $tabla (desc_area) values ('$area');";

        require_once "conexion.php";
        $cn = conectar();

        mysqli_query($cn, $sql);

        if (mysqli_affected_rows($cn) > 0) {
            echo "<p>El area $area fue cargada con éxito</p>";
            Header("Location: usuario.php?creado");
        }
        mysqli_close($cn);
    }

    if (isset($_POST['altaUsu'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $contra = $_POST['contra'];
        $tel = $_POST['tel'];
        $area = $_POST['area'];
        $rol = $_POST['rol'];

        $sql = "insert into $tabla (apellido, nombre, dni, email, contra, tel, id_area, id_rol) 
        values
        ('$apellido', '$nombre', $dni, '$email', '$contra', '$tel', $area, $rol);";

        require_once "conexion.php";
        $cn = conectar();

        mysqli_query($cn, $sql);

        if (mysqli_affected_rows($cn) > 0) {
            echo "<p>El usuario $nombre $apellido fue cargado con éxito</p>";
            Header("Location: usuario.php?creado");
        }
        mysqli_close($cn);
    }

    if (isset($_POST['altaPac'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $obraSoc = $_POST['obraSoc'];

        $sql = "insert into $tabla (apellido, nombre, dni, email, tel, obra_soc) 
        values
        ('$apellido', '$nombre', $dni, '$email', '$tel', '$obraSoc');";

        require_once "conexion.php";
        $cn = conectar();

        mysqli_query($cn, $sql);

        if (mysqli_affected_rows($cn) > 0) {
            echo "<p>El paciente $nombre $apellido fue cargado con éxito</p>";
            Header("Location: usuario.php?creado");
        }
        mysqli_close($cn);
    }

    if (isset($_POST['altaTur'])) {
        $medico = $_POST['medico'];
        $area = $_POST['area'];
        $paciente = $_POST['paciente'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];

        $sql = "insert into $tabla (id_usu, id_area, id_pac, fecha, hora) 
        values
        ($medico, $area, $paciente, '$fecha', '$hora');";

        require_once "conexion.php";
        $cn = conectar();

        mysqli_query($cn, $sql);

        if (mysqli_affected_rows($cn) > 0) {
            echo "<p>El Turno de $paciente con $medico el día $fecha a las $hora fue cargado con éxito</p>";
            Header("Location: usuario.php?creado");
        }else {
            echo "<p>No se pudo realizar la conexion.</p>";
        }
        mysqli_close($cn);
    }

    ?>
    </div>