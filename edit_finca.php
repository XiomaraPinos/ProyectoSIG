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

        $idfinca = null; 
        $nom_finca =  null;  
        $descrip = null; 



        if(isset($_GET['id'])){
            $id= (int) $_GET['id'];
            $consulta = "SELECT * FROM  FINCA  WHERE  ID = $id ";
            $resultado =  mysqli_query($conexion,$consulta);
    
            while( $fila = mysqli_fetch_array($resultado) )  {
                $idfinca = $fila['ID']; 
                $nom_finca =  $fila['NOM_FINCA'];  
                $descrip =  $fila['DESCRIP'];                        
              
            }         
        }
       

  
        
//Servicio de transporte
    if(isset($_POST['btn_grabar'])){      
          if (!empty($_POST['nom_finca']) && !empty($_POST['id_finca'])) {
            try{
                mysqli_query($conexion,("UPDATE FINCA SET NOM_FINCA='$_POST[nom_finca]', DESCRIP='$_POST[descrip]'    
                 WHERE ID ='$_POST[id_finca]'"));    
                 
                 


                //Registrar Actividad del usuario
                mysqli_query($conexion,("INSERT INTO TAREAS_USER (NOM_USER,ROL,TAREA,FECHA)                    
                VALUES ( '$dni','$rol','Actualizo Finca:$_POST[id_finca]','$fecha')")); 



               $message = 'Finca editado';  

            }catch( Exception  $ex){
              $message = 'Error al crear permiso';        
            }
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
    <link rel="stylesheet" href="assets/css/styleS.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <title>Servicio Transporte</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>


<div id="div_uni">

    <h4>SERVICIOS TRASPORTE</h4><br>
   
    
<!--Registro de servicios-->
    <br>
        <h4>Datos del Vehiculo</h4><br>

    <form action="" method="POST"> 
    <div id="contenedor1">
    <label>ID:</label>
        <input name="id_finca" type="text"  value = "<?php if($resultado) echo   $idfinca; ?>"  placeholder="Vehiculo"> 
      
        <label>NOMBRE:</label>  
        <input name="nom_finca" type="text"  value = "<?php if($resultado) echo $nom_finca; ?>" placeholder="Modelo">     
        <label>Descripción:</label> 
        <input name="descrip" type="text" value = "<?php if($resultado) echo  $descrip; ?>" placeholder="Color">      
            
    </div>
    <br>
    
        <br>       
       <div id="elemento">
        <input type="submit" name="btn_grabar" value="Editar Finca"> 
        <a href="fincas.php" class="btn btn__nuevo" >Volver</a>
        
        </div> 
    </form> 
    </div>
</body>
</html>
 