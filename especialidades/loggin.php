<?php
$usuario=$_POST['usuario'];
$contra=$_POST['contra'];



try{
    require_once "conexion.php";
    $con=conectar();
    $sql="select * from usuarios where usuario='$usuario'";
    $resulset=mysqli_query($con, $sql);
    if(mysqli_affected_rows($con)>0){
        $registro=mysqli_fetch_assoc($resulset);

        //var_dump($registro);
        if($registro['contra']==$contra){
            //echo "Inicia sesion";
            session_start();
            $_SESSION['nombre']=$registro['nombre']." ".$registro['apellido'];
            $_SESSION['usuario']=$registro['usuario'];
            $_SESSION['rol']=$registro['rol'];
            switch($_SESSION['rol']){
                case 1:
                    //echo "recep";
                    header("Location: recep.php");
                    break;
                

                default:
                    echo "ROL NO DEFINIDO";
                break;
            }

        }else{
           // echo "La contraseña es incorrecta";
           header("Location: index.php?badPass");
        }

    }else{
        //echo "No se encontro el usuario $usuario";
        header("Location: index.php?noUsu=$usuario");
    }


}catch(mysqli_sql_exception $e){
    echo "Error";
    exit();
}


?>