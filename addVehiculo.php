<?php
session_start();
require 'conexion.php';

if (!empty($_POST['matricula']) && !empty($_POST['capacidad'])) {
    try{
    mysqli_query($conexion,("INSERT INTO vehiculo (capacidad,matricula,placa,color,modelo,num_sel) 
    VALUES ( '$_POST[capacidad]','$_POST[matricula]','$_POST[placa]', '$_POST[color]','$_POST[modelo]','$_POST[num_sel]')"));
   
   $message = 'Successfully created new vehiculo';
   echo "Successfully created new vehiculo";
    header('Location: vehiculo.php');
    }catch( Exception  $ex){
      $message = 'Error al crear vehiculo';
     echo "Error al crear contribuyente";
   }
  }else{
    
    echo "Error al crear contribuyente";
    header('Location: vehiculo.php');
  }


?>

