<?php
 session_start();
 require '../conexion.php';
if(isset($_POST['btn_grabar'])){

    if (!empty($_POST['nom_serv']) ) {
        try{
        mysqli_query($conexion,("INSERT INTO service (nom_comerc,descrip) 
        VALUES ( '$_POST[nom_com]','$_POST[nom_serv]')"));
       
       $message = 'Successfully created new servicio';
       echo "Successfully created new servicio";
        header('Location: ../establecimientos.php');
        }catch( Exception  $ex){
          $message = 'Error al crear servicio';
         echo "Error al crear servicio";
       }
      }else{ echo "Error al crear servicio";}

}

if(isset($_POST['actualizar'])){

    if (!empty($_POST['nom_serv']) ) {
        try{
        mysqli_query($conexion,("INSERT INTO service (nom_comerc,descrip) 
        VALUES ( '$_POST[nom_com]','$_POST[nom_serv]')"));
       
       $message = 'Successfully created new servicio';
       echo "Successfully created new servicio";
        header('Location: ../establecimientos.php');
        }catch( Exception  $ex){
          $message = 'Error al crear servicio';
         echo "Error al crear servicio";
       }
      }else{ echo "Error al crear servicio";}
      
}




?>