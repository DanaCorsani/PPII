<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href=estilo.css rel=stylesheet>
</head>
<body>
    <h1>Inicio de Sesion</h1>
    <form method=post action=loggin.php>
        Usuario: <input type=text name="usuario" required><br>
        Contraseña: <input type=password name="contra" required><br>
        <input type=submit value="Iniciar Sesion">
    </form>
    <?php
        if(isset($_GET['noUsu'])){
            echo "No se encontró el usuario ".$_GET['noUsu'];
        }
        if(isset($_GET['badPass'])){
            echo "La contraseña es incorrecta";
        }
    ?>
    
    


</body>
</html>