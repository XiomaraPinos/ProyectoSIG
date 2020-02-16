<?php
session_start();
require 'conexion.php';


$consulta = "SELECT *from sesiones_user";
    $resultado =  mysqli_query($conexion,$consulta);


    if(isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar']; 
        
        $consulta = "SELECT  *from sesiones_user  WHERE  NOM_USER = '$_POST[buscar]'";  

        $resultado =  mysqli_query($conexion,$consulta);
    }


    if(isset($_POST['btn_Todos'])){
        $consulta = "SELECT  *from sesiones_user";

    $resultado =  mysqli_query($conexion,$consulta);
    }


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


    
    <title>Document</title>
</head>
<body>

    <?php require 'partials/header.php' ?>  
    <?php require 'partials/lateral.php' ?>
   
   





    <div id="div_uni">
    <div class="contenedor">
    <h2>USUARIOS LOGUEADOS</h2>
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
				<td>Fecha</td>	
                <td>Ip</td>
                <td>Host</td>
				            
				
            </tr>         
			<?php    while( $fila = mysqli_fetch_array($resultado) )  {  ?>
				<tr >
                    <td><?php echo $fila['ID']; ?></td>
                    <td><?php echo $fila['NOM_USER']; ?></td>
					<td><?php echo $fila['ROL']; ?></td>
					<td><?php echo $fila['FECHA']; ?></td>
					<td><?php echo $fila['IP']; ?></td>
                    <td><?php echo $fila['HOST']; ?></td>
					  
                    <!--td><a href="edit_patente.php?id=<?php echo $fila['ID']; ?>"   class="btn btn__update" >Editar</a>  </td>                           
                    <td><a href="reportes/soli_inspeccion?id=<?php echo $fila['ID']; ?>"   class="btn btn__update" target="_blank">Imprimir</a>  </td>                   
                    <td><a href="op_delete/delete_per_transp.php?id=<?php echo $fila['ID']; ?>" class="btn__delete" onclick="return validarDelete();">Eliminar</a></td--> 
                    
                    
				</tr>
            <?php } ?>

		</table>




   
    </div>
    </div>
    <script src="js/validation.js"> </script>

        <script src="main.js"></script>
</body>
</html>