<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huffmann / Baja Medicos</title>
</head>
<body>
    <h2>Baja de Especialista</h2>

    <?php
    require "conexion.php";
    $con = conectar();
    $sql = "SELECT id, matricula, nombre, apellido, dni, especialidad_id FROM especialistas";
    $result = mysqli_query($con, $sql);

    if(mysqli_affected_rows($con) > 0){
        echo "<form action='bajaMedicos.php' method='POST'>";
        echo "<table>";
        echo "<tr><th>Matrícula</th><th>Nombre</th><th>Apellido</th><th>NroDoc</th><th>Especialidad</th><th>Seleccionar</th></tr>";
        
        while($especialistas = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $especialistas['matricula'] . "</td>";
            echo "<td>" . $especialistas['nombre'] . "</td>";
            echo "<td>" . $especialistas['apellido'] . "</td>";
            echo "<td>" . $especialistas['dni'] . "</td>";
            echo "<td>" . $especialistas['especialidad_id'] . "</td>";
            echo "<td><input type='radio' name='selec' value='" . $especialistas['id'] . "' required></td>";
            echo "</tr>";
        }

        echo "</table><br>";
        echo "<button type='submit' name='eliminar'>Eliminar</button>";
        echo "</form>"; 
    }else{
        echo "Aún no hay especialistas.";
    }

    if(isset($_POST['eliminar'])){
        $seleccion = $_POST['selec'];
        echo "<p><strong>ADVERTENCIA:</strong><br>¿Esta seguro que desea eliminar al especialista seleccionado?";
        echo "<form method='post' action='bajaMedicos.php'>";
        echo "<input type='hidden' name='id' value='" . $seleccion . "'>"; 
        echo "<input type='submit' value='Sí, eliminar' name='confirmar'>";
        echo "<input type='submit' value='Cancelar' name='cancelar'>";
        echo "</form>";
    }
    if(isset($_POST['confirmar'])){
        $sql_del = "DELETE FROM especialistas WHERE id =" . $_POST['id'] . "";
        mysqli_query($con, $sql_del);
        if(mysqli_affected_rows($con)>0) {
            echo "<br>Éxito al eliminar especialista";
        }else{
            echo "<br>No se pudo eliminar al especialista";
        }
    }

    if(isset($_POST['cancelar'])){

    }
    
    mysqli_close($con);
    ?>
</body>
</html>