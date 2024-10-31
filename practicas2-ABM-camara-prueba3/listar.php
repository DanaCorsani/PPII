<?php
//if ((isset($_GET['accion']) && $_GET['accion'] == "Listar Tabla") || isset($_GET['modificado']) || isset($_GET['eliminado']) || isset($_GET['nocambios'])) {
if (isset($_GET['accion'])) {
    if (isset($_GET['tabla'])) {
        if ($_GET['accion'] == "Listar Tabla") {
            try {
?>
                <br>
                <table>
                    <tr>
                        <?php
                        require_once "conexion.php";
                        $cn = conectar();

                        switch ($_GET['tabla']) {
                            case 'roles':
                                $sql = "select * from " . $_GET['tabla'] . ";";
                                echo "<th colspan=3>";
                                echo "Tabla Roles";
                                break;
                            case 'areas':
                                $sql = "select * from " . $_GET['tabla'] . " ORDER BY desc_area;";
                                echo "<th colspan=3>";
                                echo "Tabla Areas";
                                break;
                            case 'prepagas':
                                $sql = "select * from " . $_GET['tabla'] . " ORDER BY desc_prepaga;";
                                echo "<th colspan=3>";
                                echo "Tabla Obras Sociales";
                                break;
                            case 'usuarios':
                                //$sql = "select * from " . $_GET['tabla'] . ";";
                                if ($_SESSION['id_rol'] == 1) {
                                    $sql = "SELECT id_usu, nombre, apellido, dni, email, tel, contra, disponibilidad,
            desc_rol, desc_area 
        FROM usuarios
        LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
        LEFT JOIN areas ON usuarios.id_area = areas.id_area;";
echo "<th colspan=11>";
        echo "Tabla Usuarios";
                                }

                                if ($_SESSION['id_rol'] == 2) {
                                    $sql = "SELECT id_usu, nombre, apellido, dni, email, tel, contra,disponibilidad,
            desc_rol, desc_area 
        FROM usuarios
        LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
        LEFT JOIN areas ON usuarios.id_area = areas.id_area WHERE usuarios.id_rol = 3;";
        echo "<th colspan=8>";
        echo "Tabla Medicos";
                        }
                                break;
                            case 'pacientes':
                                $sql = "select 
                            pacientes.id_pac, pacientes.apellido, pacientes.nombre, pacientes.dni, pacientes.email, pacientes.tel, pacientes.id_prepaga, prepagas.id_prepaga, 
            prepagas.desc_prepaga from " . $_GET['tabla'] . " LEFT JOIN prepagas ON pacientes.id_prepaga = prepagas.id_prepaga;";
                                //echo $sql;
                                echo "<th colspan=8>";
                                echo "Tabla Pacientes";
                                break;
                            case 'turnos':
                                $sql = "SELECT 
            turnos.id_tur, 
            turnos.fecha,
            turnos.hora,
            turnos.id_usu,
            turnos.id_area,
            turnos.id_pac,
            usuarios.nombre AS usu_nombre, 
            usuarios.apellido AS usu_apellido, 
            pacientes.nombre AS pac_nombre, 
            pacientes.apellido AS pac_apellido, 
            areas.desc_area AS desc_area 
        FROM turnos
        LEFT JOIN usuarios ON turnos.id_usu = usuarios.id_usu
        LEFT JOIN pacientes ON turnos.id_pac = pacientes.id_pac
        LEFT JOIN areas ON turnos.id_area = areas.id_area
        ORDER BY turnos.fecha ASC, turnos.hora ASC;";
                                echo "<th colspan=7>";
                                echo "Tabla Turnos";
                                break;
                            default:
                                $sql = "select * from " . $_GET['tabla'] . ";";
                                echo "<th colspan=3>";
                                echo "ERROR de Tabla";
                                break;
                        }

                        $resulset = mysqli_query($cn, $sql);

                        if (mysqli_affected_rows($cn) > 0) {
                        ?>
                            </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <?php
                            switch ($_GET['tabla']) {
                                case 'roles':
                        ?>
                                <th>Descripcion</th>
                                <th>-</th>
                    </tr>
                    <?php
                                    while ($registro = mysqli_fetch_assoc($resulset)) {
                    ?>
                        <tr>
                            <td><?php echo $registro['id_rol'] ?></td>
                            <td><?= $registro['desc_rol'] ?></td>
                            <th>
                                
                                <form action="">
                                    <input type="hidden" name="id" value="<?= $registro['id_rol'] ?>">
                                    <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                    <input type="submit" value="Modificar" name="modificar">
                                    <input type="submit" value="Eliminar" name="eliminar">
                                </form>
                                
                            </th>
                        </tr>
                    <?php
                                    }
                                    //echo "mostrando tabla roles";
                                    break;
                                case 'areas':
                    ?>
                    <th>Descripcion</th>
                    <th>-</th>
                    </tr>
                    <?php
                                    while ($registro = mysqli_fetch_assoc($resulset)) {
                    ?>
                        <tr>
                            <td><?php echo $registro['id_area'] ?></td>
                            <td><?= $registro['desc_area'] ?></td>
                            <th>
                                <form action="">
                                    <input type="hidden" name="id" value="<?= $registro['id_area'] ?>">
                                    <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                    <input type="submit" value="Modificar" name="modificar">
                                    <input type="submit" value="Eliminar" name="eliminar">
                                </form>
                            </th>
                        </tr>
                    <?php
                                    }
                                    //echo "mostrando tabla areas";
                                    break;
                        case 'prepagas':
                                        ?>
                                        <th>Descripcion</th>
                                        <th>-</th>
                                        </tr>
                                        <?php
                                                        while ($registro = mysqli_fetch_assoc($resulset)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $registro['id_prepaga'] ?></td>
                                                <td><?= $registro['desc_prepaga'] ?></td>
                                                <th>
                                                    <form action="">
                                                        <input type="hidden" name="id" value="<?= $registro['id_prepaga'] ?>">
                                                        <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                                        <input type="submit" value="Modificar" name="modificar">
                                                        <input type="submit" value="Eliminar" name="eliminar">
                                                    </form>
                                                </th>
                                            </tr>
                                        <?php
                                                        }
                                                        //echo "mostrando tabla areas";
                                                        break;
                                case 'usuarios':
                    ?>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <?php
                        if ($_SESSION['id_rol'] == 1) {
                    ?>
                            <th>Contraseña</th>
                    <?php
                        }
                    ?>
                    <th>Disponibilidad</th>
                    <th>Area</th>
                    <?php
                        if ($_SESSION['id_rol'] == 1) {
                    ?>
                        <th>Rol</th>
                        <th>-</th>
                    <?php
                    }
                    ?>
                    </tr>
                    <?php
                                    while ($registro = mysqli_fetch_assoc($resulset)) {
                    ?>
                        <tr>
                            <td><?php echo $registro['id_usu'] ?></td>
                            <td><?= $registro['apellido'] ?></td>
                            <td><?= $registro['nombre'] ?></td>
                            <td><?= $registro['dni'] ?></td>
                            <td><?= $registro['email'] ?></td>
                            <td><?= $registro['tel'] ?></td>
                            <?php
                            if ($_SESSION['id_rol'] == 1) {
                            ?>
                            <td><?= $registro['contra'] ?></td>
                            <?php
                            }
                            ?>
                            <td><?= $registro['disponibilidad'] ?></td>
                            <td><?= $registro['desc_area'] ?></td>
                            <?php
                            if ($_SESSION['id_rol'] == 1) {
                            ?>
                            <td><?= $registro['desc_rol'] ?></td>
                            <?php
                            }
                            ?>
                            <?php
                            if ($_SESSION['id_rol'] == 1) {
                            ?>
                                <th>
                                    <form action="">
                                        <input type="hidden" name="id" value="<?= $registro['id_usu'] ?>">
                                        <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                        <input type="submit" value="Modificar" name="modificar">
                                        <input type="submit" value="Eliminar" name="eliminar">
                                    </form>
                                </th>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                                    }
                                    //echo "mostrando tabla usuarios";
                                    break;
                                case 'pacientes':
                    ?>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Obra Social</th>
                    <th>-</th>
                    </tr>
                    <?php
                                    while ($registro = mysqli_fetch_assoc($resulset)) {
                    ?>
                        <tr>
                            <td><?php echo $registro['id_pac'] ?></td>
                            <td><?= $registro['apellido'] ?></td>
                            <td><?= $registro['nombre'] ?></td>
                            <td><?= $registro['dni'] ?></td>
                            <td><?= $registro['email'] ?></td>
                            <td><?= $registro['tel'] ?></td>
                            <td><?= $registro['desc_prepaga'] ?></td>
                            <th>
                                <form action="">
                                    <input type="hidden" name="id" value="<?= $registro['id_pac'] ?>">
                                    <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                    <input type="submit" value="Modificar" name="modificar">
                                    <input type="submit" value="Eliminar" name="eliminar">
                                </form>
                            </th>
                        </tr>
                    <?php
                                    }
                                    //echo "mostrando tabla pacientes";
                                    break;
                                case 'turnos':
                    ?>
                    <th>Medico</th>
                    <th>Area</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>-</th>
                    </tr>
                    <?php
                                    while ($registro = mysqli_fetch_assoc($resulset)) {
                    ?>

                        <tr>
                            <td><?php echo $registro['id_tur'] ?></td>
                            <td title="ID Medico: <?= $registro['id_usu'] ?>"><?= $registro['usu_nombre'] . " " . $registro['usu_apellido'] ?></td>
                            <td title="ID Area: <?= $registro['id_area'] ?>"><?= $registro['desc_area'] ?></td>
                            <td title="ID Paciente: <?= $registro['id_pac'] ?>"><?= $registro['pac_nombre'] . " " . $registro['pac_apellido'] ?></td>
                            <td><?= $registro['fecha'] ?></td>
                            <td><?= $registro['hora'] ?></td>
                            <th>
                                <form action="">
                                    <input type="hidden" name="id" value="<?= $registro['id_tur'] ?>">
                                    <input type="hidden" name="tabla" value="<?= $_GET['tabla'] ?>">
                                    <input type="submit" value="Modificar" name="modificar">
                                    <input type="submit" value="Cancelar" name="eliminar">
                                </form>
                            </th>
                        </tr>
<?php

                                    }
                                    break;
                                default:
                                    echo "error en la tabla.";
                                    break;
                            }
                        }
                    } catch (mysqli_sql_exception $e) {
                        echo "Fallo en la conexión.";
                        echo $e->getMessage();
                        exit();
                    }
                }
            }
        }
?>