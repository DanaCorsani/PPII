<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huffmann / Alta Medicos</title>                                               
</head>
<body>
    <h1>Ingrese los datos del Especialista</h1>

    <form method="post" action="altaMedicos.php">
        <input type="hidden" name="enviar">

        <label for="nom">Nombre: </label><br>
        <input type="text" name="nom" id="nom" required><br>

        <label for="ape">Apellido: </label><br>
        <input type="text" name="ape" id="ape" required><br>

        <label for="dni">Documento: </label><br>
        <input type="number" name="dni" id="dni" minlength="5" maxlength="8" required><br>

        <label for="mat">N° de matrícula: </label><br>
        <input type="number" name="mat" id="mat" minlength="1" maxlength="9" required>

        <label for="esp">Profesión de Referencia: </label>
        <select name="esp" id="esp" required>
            <option value="1">Especialidad 1</option>
            <option value="2">Especialidad 2</option>
            <option value="3">Especialidad 3</option>
            <option value="4">Especialidad 4</option>
            <option value="5">Especialidad 5</option>
            <option value="6">Especialidad 6</option>
            <option value="7">Especialidad 7</option>
            <option value="8">Especialidad 8</option>
        </select><br>

        <label for="tel">Teléfono</label><br>
        <input type="tel" name="tel" id="tel" required><br>

        <label for="mail">Mail</label><br>
        <input type="email" name="mail" id="mail" required><br><br>

        <input type="submit" value="Añadir Especialista">
    </form>
    <?php
    if(isset($_POST['enviar'])){
        $nom = $_POST['nom'];
        $ape = $_POST['ape'];
        $dni = $_POST['dni'];
        $mat = $_POST['mat'];
        $esp = $_POST['esp'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        
        $sql= "INSERT INTO especialistas (nombre, apellido, dni, matricula, especialidad_id, telefono, mail) 
        VALUES ('$nom', '$ape', $dni, $mat, $esp, '$tel', '$mail');";

        require_once "conexion.php";
        $con = conectar();
        mysqli_query($con, $sql);

        if(mysqli_affected_rows($con)>0){
            echo "Especialista agregado exitosamente";
        }else{
            echo "No se pudo agregar al especialista";
        }
        mysqli_close($con);
    }
    ?>
</body>
</html>