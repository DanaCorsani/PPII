<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href=estilo.css rel=stylesheet>
</head>
<body> 
    <?php
    if (!isset($_SESSION["usuario"]) || $_SESSION["rol"]!=1){
        echo "<br><br><h3>No ha iniciado sesion</h3>";
        ?><a href="loggin.php"><button class="iniciar">Iniciar sesion</button></a><?php
        exit();
    }
    ?>
    
<h1>Pagina de Especialidades</h1>
    <div class=admin>
    <ul>
        <li>
            <a href=?altas><button>Ingresar especialidad</button></a>
            
        </li>   
        <li>   
    
        <form>
    
        <input type=hidden name=buscar> Buscar por:
                
                <select name=opcion required>
                    <option value=codigo>Codigo</option>
                    <option value=descripcion>Descripcion</option>
                   
                </select>
                <input type=text name=buscado required>
                    <input type=submit value="buscar" formmethod=post formaction="recep.php">

            </form>
         </li>
        <li>
            <a href=?listarAssoc><button>Lista de especialidades</button></a>
        </li>
    </ul>
   
        <a href="logout.php"><button>Cerrar sesion</button></a>
    
        <?php

    #region CARGAR especialidades
    if(isset($_GET['altas'])){
        ?>
        
        
        <form method=post>
            <input type=hidden name=altaespecialidad>

                codigo:<input type=text name=codigo maxlenght=30 required><br>
                descripcion: <input type=text name=descripcion required><br>
                

            <input type=submit value="Cargar especialidad">
        </form>
        

        <?php
    }
    if(isset($_POST['altaespecialidad'])){
        //echo "Cargar especialidades";
        $codigo=$_POST['codigo'];
        $descripcion=$_POST['descripcion'];
        

        $sql="insert into especialidades (codigo, descripcion) 
        values
        ('$codigo', '$descripcion');";

        require_once "conexion.php";
        $conexion=conectar();
      
        mysqli_query($conexion,$sql);

        if(mysqli_affected_rows($conexion)>0){
            echo "la especialidad $descripcion fue cargado con éxito";
        }
        mysqli_close($conexion);

    }

    #region LISTA DE especialidades

    if(isset($_GET['listarAssoc'])){
        echo "<h1>Lista de especialidades</h1>";

        require_once "conexion.php";
        $cn=conectar();
        $sql="select * from especialidades;";

        $resulset=mysqli_query($cn, $sql);

        if(mysqli_affected_rows($cn)>0){
            ?>
            <table>
                <tr>
                    <th>codigo</th>
                    <th>descricion</th>
                    
                    
                </tr>
                <?php
                while($registro=mysqli_fetch_assoc($resulset)){
                    ?>
                <tr>
                    <td><?php echo $registro['codigo']?></td>
                    <td><?=$registro['descripcion']?></td>
                    
                </tr>
                
                    <?php
                }
                ?>
            </table>
            
            <?php

        }else{
            echo "No hay especialidades en la tabla";
        }
        
    }
#region BUSCAR especialidades
    
    if(isset($_POST['buscar'])){
        $opcion=$_POST['opcion'];
        $especialidades=$_POST['buscado'];
        //$sql="select * from especialidades";
        switch($opcion){
            case 'codigo':
                
                if(is_numeric($especialidades)){
                    echo "Buscando codigo $especialidades";
                    $sql="select * from especialidades where codigo=$especialidades;";

                }else{
                    echo "Debe ingresar un número. Reintentar";
                    exit();
                }
                break;
            case 'descripcion':
                echo "Buscando descripcion $especialidades";
                $sql="select * from especialidades where descripcion like '%$especialidades%';";
                break;
            
            default:
                echo "Error de busqueda";
                exit();
                break;
        }
#region MODIFICAR especialidades
        require_once "conexion.php";
        $cnn=conectar();

        $resultado=mysqli_query($cnn, $sql);

        if(mysqli_affected_rows($cnn)>0){
            ?>
              <table>
            <tr>
                <th>codigo</th>
                <th>descripcion</th>
               
            </tr><form method=post>
            <?php
            while($especialidades=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <td><?=$especialidades['codigo'];?></td>
                    <td><?=$especialidades['descripcion'];?></td>
                    
                    <td>
                        <input type=radio name=codigo value="<?=$especialidades['codigo'];?>" required>
                    </td>
                </tr>
                <?php
            }
            ?>
                <tr>
                    <th colspan=5>
                        <input type=submit value="Modificar" formaction=?modificar>
                        <input type=submit value="Eliminar" formaction=?eliminar>
                        

                    </th>
                </tr>
        </table>
            <?php

        }else{
            echo "No se encontró $especialidades";
        }
       

    }

    if(isset($_GET['modificar'])){
        $codigo=$_POST['codigo'];

        echo "Vamos a modificar el codigo $codigo";
        $sql="select * from especialidades where codigo=$codigo";
        
        try{
            require_once "conexion.php";
            $con=conectar();
           
            $resulset=mysqli_query($con, $sql);
            $especialidades=mysqli_fetch_assoc($resulset);

            
            ?>
            <form method=post action=recep.php>
                <input type=hidden name=codigo value="<?=$especialidades['codigo']?>">
                codigo: <?=$especialidades['codigo'];?><br>
                Descripcion:<input type=text name=descripcion value="<?=$especialidades['descripcion'];?>" required><br>
                <input type=submit value="modificar" name=modificar onClick=" return confirm ('Esta seguro de modificar?')">
          
            </form>
            
            <?php

        }catch(mysqli_sql_exception $e){
            echo "Fallo en la conexión";
            echo $e->getMessage();
            exit();
        }
    }
    if(isset($_POST['modificar'])){
        $codigo=$_POST['codigo'];
        $des=$_POST['descripcion'];
        

        $sql="update especialidades set descripcion='$des' where codigo=$codigo";
       
        try{
            require_once "conexion.php";
            $con=conectar();
            mysqli_query($con, $sql);
            if(mysqli_affected_rows($con)>0){
                echo "especialidades modificado";
            }else{
                echo "No se hicieron cambios";
            }
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }
#region ELIMINAR especialidades
    if(isset($_POST['cancelar'])){
        echo "No se hicieron cambios CANCELAR";
    }
    if(isset($_POST['confirmaEliminar'])){

        $codigo=$_POST['codigoEliminar'];
        try{
            require_once "conexion.php";
            $con=conectar();
     $sql="delete from especialidades where codigo=$codigo";
            mysqli_query($con, $sql);
            if(mysqli_affected_rows($con)>0){
                echo "El especialidades $codigo fue eliminado";
            }else{
                echo "No se pudo eliminar";
            }
        }catch(mysqli_sql_exception $e){
            echo "Fallo";
            exit();
        }

    }
    if(isset($_GET['eliminar'])){
        $codigo=$_POST['codigo'];
   
        $sql="select * from especialidades where codigo=$codigo";
        try{
            require_once "conexion.php";
            $con=conectar();
            $resultado=mysqli_query($con, $sql);
            if(mysqli_affected_rows($con)>0){
                $especialidades=mysqli_fetch_assoc($resultado);
                echo "<div><h2>Esta a punto de eliminar la especialidad<br>";
                echo $especialidades['codigo']." ".$especialidades['descripcion'];
                echo "<br> esta seguro???</h2></div>";
                ?>
                <form method=post action="recep.php">
                    <input type=hidden name=codigoEliminar value="<?=$codigo?>">
                    <input type=submit name="confirmaEliminar" value="si">
                    <input type=submit name="cancelar" value="No">
                </form>
                <?php
                
            }else{
                echo "FALLO. Algo anda mal";
            }
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
            exit();
        }
    }
    ?>
</body>
</html>