<?php
function conectar(){
 $servidorBD = "localhost";
 $usuarioBD = "root";
 $contraBD = "";
 $bd = "practicas2";
 $c = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $bd );

 return $c;
}
?>