<?php

function conectar(){
    $servidor="localhost";
    $usuario="root";
    $contra="";
    $bd="clinica";

    return mysqli_connect($servidor, $usuario, $contra, $bd);
}

?>