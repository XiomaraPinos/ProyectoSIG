<?php 
session_start();
require 'conexion.php';

$sesion = $_SESSION['user_id'];
$consultaU = "SELECT * FROM  USUARIO  where ID = '$sesion'";
$resultadoU =  mysqli_query($conexion,$consultaU);
$fecha =  date('m/d/Y g:ia');
while( $fila = mysqli_fetch_array($resultadoU) )  {
 
   $rol = 'Admin';  // = $fila['cedula']; 
   $dni =  $fila['DNI']; 
  
} 


    //Editar COntribuyente
    if(isset($_POST['btn_grabar'])){     
        if (!empty($_POST['dni']) ) {
            try{
                mysqli_query($conexion,("UPDATE  CLIENTE SET DNI='$_POST[dni]', NOM_CLI='$_POST[nom_cli]',
                 DIR_CLI='$_POST[dir_cli]', CIUDAD='$_POST[pais]', EMAIL='$_POST[email]', TELF='$_POST[telf]'
                WHERE  ID_CLI ='$_POST[id_cli]'")); 

                $message = 'Cliente actualizado correctamente';
                 //Registrar Actividad del usuario
                mysqli_query($conexion,("INSERT INTO TAREAS_USER (NOM_USER,ROL,TAREA,FECHA)                    
                VALUES ( '$dni','$rol','Actualizo  Cliente:$_POST[dni]','$fecha')")); 

            }catch( Exception  $ex){
              $message = 'Error durante la actualizacion';
             echo "Error al editar servicio";
            }

           
        }
    }
    if(isset($_GET['id'])){
        $id= (int) $_GET['id'];
        $consulta = "SELECT * FROM CLIENTE  WHERE  ID_CLI = $id ";
        $resultado =  mysqli_query($conexion,$consulta);

        while( $fila = mysqli_fetch_array($resultado) )  {
            $id_cli =  $fila['ID_CLI'];
            $dni_cli = $fila['DNI']; 
            $nom_cli =  $fila['NOM_CLI'];
            $dir_cli =  $fila['DIR_CLI']; 
            $Pais =  $fila['CIUDAD']; 
            $email =  $fila['EMAIL']; 
            $telf =  $fila['TELF']; 
           
        }   
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/css/styleper.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/styles.css">  
    <link rel="stylesheet" href="assets/css/main.css">
    
    <title>Document</title>
</head>
<body>
<?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>
    <div id="div_uni"> 
    <h2>Editar Establecimiento</h2>
    <div id="contenedor1" class="contenedor">	
        	
		<form action="#" method="post">	

                <label>Codigo: </label>
                <input type="text" name="id_cli" value="<?php if($resultado) echo  $id_cli; ?>" class="input__text"><br>
                <label>RUC/DNI:</label>
                <input type="text" name="dni" value="<?php if($resultado) echo $dni_cli ; ?>" class="input__text"><br>			
                <label>Nombres:</label>
				<input type="text" name="nom_cli" value="<?php if($resultado) echo   $nom_cli; ?>" class="input__text" required><br>          
                <label>Ciudad:</label>
				<input type="text" name="dir_cli" value="<?php if($resultado) echo  $dir_cli; ?>" class="input__text">     <br>
                <label>Pais:</label>
                <input type="text" name="pais" value="<?php if($resultado) echo $Pais ; ?>" class="input__text"><br>			
                <label>Email:</label>
				<input type="text" name="email" value="<?php if($resultado) echo   $email; ?>" class="input__text" required><br>              
                <label>Teléfono:</label>
				<input type="text" name="telf" value="<?php if($resultado) echo  $telf; ?>" class="input__text">     <br>
                
                <input type="submit"  name="btn_grabar"  value="Editar Establecimiento">
                <a href="clientes.php" class="btn btn__nuevo" >Volver</a>
           
		</form>	
	</div>
    </div>

</body>
</html>