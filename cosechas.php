<?php 
 session_start();
 require 'conexion.php';

 $sesion = $_SESSION['user_id'];
 $consultaU = "SELECT * FROM  USUARIO  where ID = '$sesion'";
    $resultadoU =  mysqli_query($conexion,$consultaU);
    $fecha =  date('m/d/Y g:ia');
    while( $fila = mysqli_fetch_array($resultadoU) )  {
        $rol = 'Admin';  
        $dni =  $fila['DNI'];  
    } 

    $consultaFinca = "SELECT * FROM  FINCA ORDER BY ID ASC";
    $resultadoFinca =  mysqli_query($conexion,$consultaFinca);


    $consulta = "SELECT * FROM   COSECHA ORDER BY ID ASC";
    $resultado =  mysqli_query($conexion,$consulta);


 if(isset($_POST['btn_buscar_all'])){
    $consulta = "SELECT * FROM   COSECHA ORDER BY ID ASC";
    $resultado =  mysqli_query($conexion,$consulta);
}
 
 if(isset($_POST['btn_buscar'])){
     $buscar_text=$_POST['buscar']; 
     $consulta = "SELECT * FROM  COSECHA  WHERE  ID_FINCA LIKE '$_POST[buscar]' OR ID Like  '$_POST[buscar]'";
     $resultado =  mysqli_query($conexion,$consulta);
 }


//Registro Cosecha
if(isset($_POST['btn_grabar'])){       
    if (!empty($_POST['num_cajas']) && !empty($_POST['fecha'])) {
      try{
          mysqli_query($conexion,("INSERT INTO COSECHA (ID_FINCA,NUM_CAJAS,FECHA) 
          VALUES ('$_POST[id_finca]', '$_POST[num_cajas]','$_POST[fecha]')"));
          $message = 'Cosecha Registrada';
         

            //Registrar Actividad del usuario registra cosecha
      mysqli_query($conexion,("INSERT INTO TAREAS_USER (NOM_USER,ROL,TAREA,FECHA)            
      VALUES ( '$dni','$rol','Registro de Cosecha:$_POST[num_cajas]','$fecha')"));  

      }catch( Exception  $ex){
        $message = 'Error al crear permiso';        
      }
  }
}

$consulta = "SELECT * FROM   COSECHA ORDER BY ID ASC";
$resultado =  mysqli_query($conexion,$consulta);        q23                                      
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?> 
    <?php require 'partials/lateral.php' ?> 
    <div id="div_uni">  
    <div id="miModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h4>Registrar Cosecha</h4>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">					
                    <div class="box"> 
                <form action="" method="POST">  
                    <label>Seleccionar Finca:</label>  
                    <select name="id_finca">
                                            <option value="0">Seleccione:</option>
                                            <?php
                                            while ($fila = mysqli_fetch_array($resultadoFinca)) {
                                                echo '<option value="'.$fila[ID].'">'.$fila[NOM_FINCA].'</option>';
                                            }
                                                ?>
                    </select>     
                    <br>
                    <label>Numero de Cajas:</label>  
                    <input name="num_cajas" type="text" placeholder="Numero de Cajas" required>     
                    <label>Fecha Cosecha:</label> 
                    <input name="fecha" type="date" placeholder="fecha Cosecha"> 
                    <input type="submit" name="btn_grabar" value="Grabar Cosecha"> 

                </form>
                </div>                
                </div>
				<div class="footer">
					<h4>Sistema Bananera &copy;</h4>
				</div>
			</div>
		</div>
    </div>

    <div class="contenedor">
		<h2>Fincas</h2>
	<div class="barra__buscador">
			<form action="" class="formulario" method="post"> 
                <label id="label_busc">Buscar:</label>          	
				<input type="text" name="buscar" placeholder="buscar nombre " value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="">			              
                <input type="submit" class="" name="btn_buscar" value="Buscar">     
                <input type="submit" class="" name="btn_buscar_all" value="Todo"> 
                <a href="#" id="abrir" class="">Nuevo</a>                                       
			</form>           
        </div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>FINCA</td>
                <td>CANTIDAD CAJAS</td>
                <td>FECHA</td>				
				<td colspan="2">Acción</td>
            </tr>         
			<?php    while( $fila = mysqli_fetch_array($resultado) )  {  ?>
				<tr >
					<td><?php echo $fila['ID']; ?></td>
					<td><?php echo $fila['ID_FINCA']; ?></td>
					<td><?php echo $fila['NUM_CAJAS']; ?></td>	
                    <td><?php echo $fila['FECHA']; ?></td>	
                    <td><a href="edit_cosecha.php?id=<?php echo $fila['ID']; ?>" id="actualizar"  class="btn btn__update" >Editar</a>  </td>                                                    
                    <td><a href="op_delete/delete_cosechas.php?id=<?php echo $fila['ID']; ?>" class="btn__delete" onclick="return validarDelete();" >Eliminar</a></td>                 
				</tr>
            <?php } ?>

		</table>
    </div>


    </div>
    <script src="js/validation.js"> </script>
    <script src="main.js"></script>
</body>
</html>