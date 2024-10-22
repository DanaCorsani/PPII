<?php
if (isset($_GET['buscar'])) {
    $opcion = $_GET['op'];
    $producto = $_GET['buscado'];
    //$sql="select * from productos";
    switch ($opcion) {
        case 'codigo':
            if (is_numeric($producto)) {
                echo "<br><p>Buscando codigo $producto </p>";
                $sql = "select * from productos where codigo=$producto;";
            } else {
                echo "<br><p>Debe ingresar un número. Reintentar</p>";
                exit();
            }
            break;
        case 'descripcion':
            echo "<br><p>Buscando descripcion $producto </p>";
            $sql = "select * from productos where descripcion like '%$producto%';";
            break;
        default:
            echo "<br><p>Error de busqueda.</p>";
            exit();
            break;
    }

    require_once "conexion.php";
    $cn = conectar();

    $resultset = mysqli_query($cn, $sql);

    if (mysqli_affected_rows($cn) > 0) {
    ?>
        <table>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <?php if ($_SESSION['id_rol'] == 1) { ?>
                    <th></th>
                <?php } ?>
            </tr>
            <form method=post>
                <?php
                while ($registro = mysqli_fetch_assoc($resultset)) {
                ?>
                    <tr>
                        <td><?= $registro['codigo']; ?></td>
                        <td><?= $registro['descripcion']; ?></td>
                        <td>$<?= $registro['precio']; ?></td>
                        <?php if ($_SESSION['id_rol'] == 1) { ?>
                            <td>
                                <input type=radio name="codigo" value="<?= $registro['codigo']; ?>" required>
                            </td>
                        <?php } ?>
                    </tr>
                <?php
                }
                if ($_SESSION['id_rol'] == 1) {
                ?>
                    <tr>
                        <th colspan=5>
                            <input type=submit value="Modificar" formaction=?modificar>
                            <input type=submit value="Eliminar" formaction=?eliminar>
                        </th>
                    </tr>
                <?php } ?>
            </form>

        </table>
    <?php

    } else {
        echo "<br>No se encontró $producto";
    }
}
?>