<?php
session_start();
echo "Hasta pronto  ".$_SESSION['nombre'];

session_unset();
session_destroy();
echo "Sesion cerrada";
echo "<a href=index.php><button>Iniciar Sesion</button></a>";

?>