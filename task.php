<?php
session_start();
require 'conexion.php';



$consulta = "SELECT  *from TAREAS_USER";

                        
    $resultado =  mysqli_query($conexion,$consulta);


    if(isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar']; 
        
        $consulta = "SELECT  *from TAREAS_USER  WHERE  NOM_USER = '$_POST[buscar]'";  

        $resultado =  mysqli_query($conexion,$consulta);
    }

    if(isset($_POST['btn_Todos'])){
        $consulta = "SELECT  *from TAREAS_USER";

    $resultado =  mysqli_query($conexion,$consulta);
    }

/*
$consulta = "SELECT * FROM  contribuyente ORDER BY id_contr ASC";
$resultado =  mysqli_query($conexion,$consulta);*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">


    
    <title>Bananera</title>
</head>
<body>

    <?php require 'partials/header.php' ?>  
    <?php require 'partials/lateral.php' ?>
   
    <div id="sub_menu_div">
        <?php require 'partials/submenu_perm.php' ?>      
    </div>


    <div id="div_uni">
    <div class="contenedor">
    <h2>Tareas de Usuario</h2>
        <form action="" class="formulario" method="post"> 
                    <label id="label_busc">Buscar:</label>          	
                    <input type="text" name="buscar" placeholder="buscar Cedula o Ruc" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
                    <input type="submit" class="" name="btn_buscar" value="Buscar">                             
                    <input type="submit" class="" name="btn_Todos" value="Ver todos">
                    
        </form>


        <table>
			<tr class="head">
                <td>Id</td>				
				<td>Usuario</td>
				<td>Rol</td>
				<td>Tarea</td>
                <td>Fecha</td>
                
              
				
            </tr>         
			<?php    while( $fila = mysqli_fetch_array($resultado) )  {  ?>
				<tr >
                    <td><?php echo $fila['ID']; ?></td>
					<td><?php echo $fila['NOM_USER']; ?></td>
					<td><?php echo $fila['ROL']; ?></td>
					<td><?php echo $fila['TAREA']; ?></td>
                    <td><?php echo $fila['FECHA']; ?></td> 
                    <!--td><a href="edit_serv_transp.php?id=<?php echo $fila['ID']; ?>"   class="btn btn__update" >Editar</a>  </td>                           
                    <td><a href="reportes/repTransp?id=<?php echo $fila['ID']; ?>"   class="btn btn__update" target="_blank">Imprimir</a>  </td>                   
                    <td><a href="op_delete/delete_per_transp.php?id=<?php echo $fila['ID']; ?>" class="btn__delete" onclick="return validarDelete();">Eliminar</a></td--> 
                    
                    
				</tr>
            <?php } ?>

		</table>




        <!--div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h4>Registrar Vehiculo</h4>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">					
                        <div class="box">                        
                        <form action="addVehiculo.php" method="POST">   
                            
                              
                            <input name="capacidad" type="text" placeholder="Capacidad">      
                            <input name="matricula" type="text" placeholder="Matricula"> 
                            <input name="placa" type="text" placeholder="Placa">
                            <input name="color" type="text" placeholder="Color"> 
                            <input name="modelo" type="text" placeholder="modelo">
                            <input name="num_sel" type="text" placeholder="modelo">
                            
                            <input type="submit" value="Registrar vehiculo">
                        </form>
                    </div>                
                    </div>
                    <div class="footer">
                        <h4>Sistema Bomberos &copy;</h4>
                    </div>
                </div>
            </div>
        </div-->
    </div>
    </div>
    <script src="js/validation.js"> </script>

        <script src="main.js"></script>
</body>
</html>