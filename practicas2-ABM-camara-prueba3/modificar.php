
<?php
if (isset($_GET['modificar'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];

    try {
        require_once "conexion.php";
        $cn = conectar();
        switch ($tabla) {
            case 'roles':
                $sql = "select * from " . $tabla . " WHERE id_rol = $id;";
                break;
            case 'areas':
                $sql = "select * from " . $tabla . " WHERE id_area = $id;";
                break;
            case 'prepagas':
                $sql = "select * from " . $tabla . " WHERE id_prepaga = $id;";
                break;
            case 'usuarios':
                $sql = "select * from " . $tabla . " WHERE id_usu = $id;";
                break;
            case 'pacientes':
                $sql = "select * from " . $tabla . " WHERE id_pac = $id;";
                break;
            case 'turnos':
                $sql = "select * from " . $tabla . " WHERE id_tur = $id;";
                break;
            default:
                echo "ERROR de seleccion de renglon";
                break;
        }
        $resultset = mysqli_query($cn, $sql);
        $result = mysqli_fetch_assoc($resultset);

        //echo "<p>tabla $tabla</p>";
        //var_dump($tabla);
        ?>
        <div class="flex-form altas">
        <?php
        switch ($tabla) {
            case 'roles':
?>
                <form action="" method="post">
                    <input type=hidden name=mod>
                    <label for="id_rol">ID: <?= $id ?></label>
                    <input type="number" name="id_rol" value="<?= $id ?>" hidden>
                    <br>
                    <label for="desc_rol">Descripcion: </label>
                    <input type="text" name="desc_rol" value="<?= $result['desc_rol'] ?>">
                    <br>
                    <input type="submit" value="Modificar Rol">
                </form>
            <?php
                break;
            case 'areas':
            ?>
                <form action="" method="post">
                    <input type=hidden name=mod>
                    <label for="id_area">ID: <?= $id ?></label>
                    <input type="number" name="id_area" value="<?= $id ?>" hidden>
                    <br>
                    <label for="desc_area">Descipcion: </label>
                    <input type="text" name="desc_area" value="<?= $result['desc_area'] ?>">
                    <br>
                    <input type="submit" value="Modificar Area">
                </form>
            <?php
                break;
                case 'prepagas':
                    ?>
                        <form action="" method="post">
                            <input type=hidden name=mod>
                            <label for="id_prepaga">ID: <?= $id ?></label>
                            <input type="number" name="id_prepaga" value="<?= $id ?>" hidden>
                            <br>
                            <label for="desc_prepaga">Descipcion: </label>
                            <input type="text" name="desc_prepaga" value="<?= $result['desc_prepaga'] ?>">
                            <br>
                            <input type="submit" value="Modificar Obra Social">
                        </form>
                    <?php
                        break;
            case 'usuarios':
            ?>
                <form action="" method="post">
                    <input type=hidden name=mod>
                    <label for="id_usu">ID: <?= $id ?></label>
                    <input type="number" name="id_usu" value="<?= $id ?>" hidden>
                    <br>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" value="<?= $result['nombre'] ?>">
                    <br>
                    <label for="apellido">Apellido: </label>
                    <input type="text" name="apellido" value="<?= $result['apellido'] ?>">
                    <br>
                    <label for="dni">DNI: </label>
                    <input type="number" maxlength="8" max=99999999 min=0 name="dni" value="<?= $result['dni'] ?>">
                    <br>
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" value="<?= $result['email'] ?>">
                    <br>
                    <label for="tel">Telefono: </label>
                    <input type="text" name="tel" value="<?= $result['tel'] ?>">
                    <br>
                    <label for="contra">Contraseña: </label>
                    <input type="password" name="contra" value="<?= $result['contra'] ?>">
                    <br>
                    <label for="disponibilidad">Disponibilidad: </label>
                    <textarea name="disponibilidad" rows="5" maxlength="100"><?= $result['disponibilidad'] ?></textarea>
                    <br>
                    <label for="area">Area ID: </label>
                    <input type="number" name="area" value="<?= $result['id_area'] ?>">
                    <br>
                    <label for="rol">Rol ID: </label>
                    <input type="number" name="rol" value="<?= $result['id_rol'] ?>">
                    <br>
                    <input type="submit" value="Modificar Usuario">
                </form>
            <?php
                break;
            case 'pacientes':
            ?>
                <form action="" method="post">
                    <input type=hidden name=mod>
                    <label for="id_pac">ID: <?= $id ?></label>
                    <input type="number" name="id_pac" value="<?= $id ?>" hidden>
                    <br>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" value="<?= $result['nombre'] ?>">
                    <br>
                    <label for="apellido">Apellido: </label>
                    <input type="text" name="apellido" value="<?= $result['apellido'] ?>">
                    <br>
                    <label for="dni">DNI: </label>
                    <input type="number" maxlength="8" max=99999999 min=0 name="dni" value="<?= $result['dni'] ?>">
                    <br>
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" value="<?= $result['email'] ?>">
                    <br>
                    <label for="tel">Telefono: </label>
                    <input type="text" name="tel" value="<?= $result['tel'] ?>">
                    <br>
                    <label for="id_prepaga">ID Obra Social: </label>
                    <input type="number" name="id_prepaga" value="<?= $result['id_prepaga'] ?>">
                    <br>
                    <input type="submit" value="Modificar Paciente">
                </form>
            <?php
                break;
            case 'turnos':
            ?>
                <form action="" method="post">
                    <input type=hidden name=mod>
                    <label for="id_tur">ID: <?= $id ?></label>
                    <input type="number" name="id_tur" value="<?= $id ?>" hidden>
                    <br>
                    <label for="medico">Medico ID: </label>
                    <input type="number" name="medico" value="<?= $result['id_usu'] ?>">
                    <br>
                    <label for="area">Area ID: </label>
                    <input type="number" name="area" value="<?= $result['id_area'] ?>">
                    <br>
                    <label for="paciente">Paciente ID: </label>
                    <input type="number" name="paciente" value="<?= $result['id_pac'] ?>">
                    <br>
                    <label for="fecha">Fecha: </label>
                    <input type="date" name="fecha" placeholder="Año-Mes-Dia" value="<?= $result['fecha'] ?>">
                    <br>
                    <label for="hora">Hora: </label>
                    <input type="time" name="hora" placeholder="Hor:Min" value="<?= $result['hora'] ?>">
                    <br>
                    <input type="submit" value="Modificar Turno">
                </form>
        <?php
                break;
            default:
                echo "ERROR de seleccion de renglon";
                break;
        }
        ?>

<?php

    } catch (mysqli_sql_exception $e) {
        echo "Fallo en la conexión. 1?";
        echo $e->getMessage();
        exit();
    }
}
if (isset($_POST['mod'])) {
    try {
        require_once "conexion.php";
        $cn = conectar();
        switch ($tabla) {
            case 'roles':
                $id_rol = $_POST['id_rol'];
                $desc_rol = $_POST['desc_rol'];

                $sql = "update $tabla set desc_rol='$desc_rol' where id_rol=$id_rol;";
                break;
            case 'areas':
                $id_area = $_POST['id_area'];
                $desc_area = $_POST['desc_area'];
                $sql = "update $tabla set desc_area='$desc_area' where id_area=$id_area;";
                break;
            case 'prepagas':
                    $id_prepaga = $_POST['id_prepaga'];
                    $desc_prepaga = $_POST['desc_prepaga'];
                    $sql = "update $tabla set desc_prepaga='$desc_prepaga' where id_prepaga=$id_prepaga;";
                    break;
            case 'usuarios':
                $id_usu = $_POST['id_usu'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $dni = $_POST['dni'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $contra = $_POST['contra'];
                $disponibilidad = $_POST['disponibilidad'];
                $area = $_POST['area'];
                $rol = $_POST['rol'];

                $sql = "update $tabla set apellido='$apellido', nombre='$nombre', dni=$dni, email='$email', tel='$tel', contra='$contra', disponibilidad='$disponibilidad', id_area=$area, id_rol=$rol where id_usu=$id_usu;";

                break;
            case 'pacientes':
                $id_pac = $_POST['id_pac'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $dni = $_POST['dni'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $id_prepaga = $_POST['id_prepaga'];

                $sql = "update $tabla set apellido='$apellido', nombre='$nombre', dni=$dni, email='$email', tel='$tel', id_prepaga=$id_prepaga where id_pac=$id_pac;";
                break;
            case 'turnos':
                $id_tur = $_POST['id_tur'];
                $medico = $_POST['medico'];
                $area = $_POST['area'];
                $paciente = $_POST['paciente'];
                $fecha = $_POST['fecha'];
                $hora = $_POST['hora'];

                $sql = "update $tabla set id_usu=$medico, id_area=$area, id_pac=$paciente, fecha='$fecha', hora='$hora' where id_tur=$id_tur;";
                
                break;
            default:
                echo "ERROR de modificacion.";
                break;
        }
        
        mysqli_query($cn, $sql);
    
?>
</div>
<?php
    if (mysqli_affected_rows($cn) > 0) {
        //echo "Producto modificado";
        header('Location: ?modificado');
    } else {
        //echo "No se hicieron cambios.";
        header("Location: ?nocambios");
    }
    mysqli_close($cn);

} catch (mysqli_sql_exception $e) {
    echo "Fallo. Hubo un error en la conexion. 2?";
    echo $e->getMessage();
}
}
if (isset($_POST['cancelar'])) {
    //echo "No se hicieron cambios.";
    header("Location: ?nocambios");
}
?>