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

        $idcos = null; 
        $id_finca =  null;  
        $cant_cajas =  null;  
        $fechac =  null; 
       


        if(isset($_GET['id'])){
            $id= (int) $_GET['id'];
            $consulta = "SELECT * FROM  cosecha  WHERE  ID = $id ";
            $resultado =  mysqli_query($conexion,$consulta);
    
            while( $fila = mysqli_fetch_array($resultado) )  {
                $idcos = $fila['ID']; 
                $id_finca =  $fila['ID_FINCA'];  
                $cant_cajas =  $fila['NUM_CAJAS'];  
                $fechac =  $fila['FECHA'];                        
              
            }         
        }
       
        
  
        $consultaFinca = "SELECT * FROM  FINCA ORDER BY ID ASC";
        $resultadoFinca =  mysqli_query($conexion,$consultaFinca);   
//Servicio de transporte
    if(isset($_POST['btn_grabar'])){      
          if (!empty($_POST['cantidad']) && !empty($_POST['id_finca'])) {
            try{
                mysqli_query($conexion,("UPDATE COSECHA SET ID_FINCA='$_POST[id_finca]',NUM_CAJAS='$_POST[cantidad]', FECHA='$_POST[fecha]'    
                 WHERE ID ='$_POST[idcos]'")); 
                 
                 


                  //Registrar Actividad del usuario
                  mysqli_query($conexion,("INSERT INTO TAREAS_USER (NOM_USER,ROL,TAREA,FECHA)                    
                  VALUES ( '$dni','$rol','Actualizo  Cosecha:$_POST[idcos]','$fecha')")); 




               $message = 'Cosecha editado';  

            }catch( Exception  $ex){
              $message = 'Error al editar';        
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

    <h4>Cosechas</h4><br>
   
    
<!--Registro de servicios-->
    <br>
        <h4>Datos cosechas</h4><br>

    <form action="" method="POST"> 
    <div id="contenedor1">
    <label>ID:</label>
     
        <input name="idcos" type="text"  value = "<?php if($resultado) echo   $idcos; ?>"  placeholder="Id"> 
        <label>Id finca:</label> 


        <select name="id_finca">
                                            <option value="">Seleccione:</option>
                                            <?php
                                            while ($fila = mysqli_fetch_array($resultadoFinca)) {
                                                echo '<option value="'.$fila[ID].'">'.$fila[NOM_FINCA].'</option>';
                                            }
                                                ?>
                    </select>  



        <label>Cantidad de Cajas:</label>  
        <input name="cantidad" type="text"  value = "<?php if($resultado) echo $cant_cajas; ?>" placeholder="Cantidad">     
        <label>Fecha:</label> 
        <input name="fecha" type="date" value = "<?php if($resultado) echo  $fechac; ?>" placeholder="Fecha" require>      



     

    </div>
    <br>
    
        <br>       
       <div id="elemento">
        <input type="submit" name="btn_grabar" value="Editar Cosecha"> 
        <a href="cosechas.php" class="btn btn__nuevo" >Volver</a>
        
        </div> 
    </form> 
    </div>
</body>
</html>
 