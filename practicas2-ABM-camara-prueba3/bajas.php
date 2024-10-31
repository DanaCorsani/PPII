<?php
if (isset($_POST['confirmaEliminar'])) {
        $id_del = $_POST['idEliminar'];
        $tabla = $_POST['tablaEliminar'];
        try {
            require_once "conexion.php";
            $cn = conectar();
            switch ($tabla) {
                case 'roles':
                    $sql = "delete from " . $tabla . " WHERE id_rol = $id_del;";
                    break;
                case 'areas':
                        $sql = "delete from " . $tabla . " WHERE id_area = $id_del;";
                        break;
                case 'prepagas':
                    $sql = "delete from " . $tabla . " WHERE id_prepaga = $id_del;";
                    break;
                case 'usuarios':
                        $sql = "delete from " . $tabla . " WHERE id_usu = $id_del;";
                    break;
                case 'pacientes':
                        $sql = "delete from " . $tabla . " WHERE id_pac = $id_del;";
                    break;
                case 'turnos':
                        $sql = "delete from " . $tabla . " WHERE id_tur = $id_del;";
                    break;
                default:
                    echo "ERROR de seleccion de renglon a eliminar";
                    break;
            }
            mysqli_query($cn, $sql);
            if (mysqli_affected_rows($cn) > 0) {
                mysqli_close($cn);
                /* echo "El elemento $id fue eliminado"; */
                header('Location: ?eliminado');
            } else {
                mysqli_close($cn);
                /* echo "No se pudo eliminar"; */
                header("Location: ?nocambios");
            }
        } catch (mysqli_sql_exception $e) {
            echo "Fallo. Hay tablas viculadas a este registro.";
            exit();
        }
    }

    if (isset($_GET['eliminar'])) {
        $id = $_GET['id'];
        $tabla = $_GET['tabla'];
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
        try {
            require_once "conexion.php";
            $cn = conectar();
            $resultado = mysqli_query($cn, $sql);
            ?>
            <div class="flex-form bajas">
            <?php
            if (mysqli_affected_rows($cn) > 0) {
                $resultado = mysqli_fetch_assoc($resultado);
                ?>
                <form method=post>
                    <div class="premisa">
                    <p>Esta a punto de <b>eliminar</b> al <?=$tabla?> ID: <?=$id;?> <br>Está seguro?</p>

                    <input type=hidden name=idEliminar value="<?= $id ?>">
                    <input type=hidden name=tablaEliminar value="<?= $tabla ?>">
                    </div>
                    <div class="si-no"><input type=submit name="confirmaEliminar" value="Si"> &nbsp; <input type=submit name="cancelar" value="No"></div>
                </form>
    <?php

            } else {
                echo "FALLO. Algo anda mal";
            }
            ?>
                </div>
                <?php
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
?>