<?php 
//$sesion=null;
session_start();
$sesion = $_SESSION['user_id'];
if ($sesion == null || $sesion = ''){
  echo 'Usted no tiene autorizacion para ingresar';
  header('Location:index.php');
  die();

}
require 'conexion.php';

$consultaU = "SELECT * FROM  USUARIO  where ID = '$sesion'";
$resultadoU =  mysqli_query($conexion,$consultaU);

while( $fila = mysqli_fetch_array($resultadoU) )  {
  
   // $ced_user = $fila['cedula']; 
    $nombre_user =  $fila['NOMBRES']; 
   
} 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    

    <title>Sistema Bomberos</title> </head>
    
  <body>
        <?php require 'partials/header.php' ?>
        <?php require 'partials/lateral.php' ?>

      
        <div id="div_uni">
            <h1>Bienvenido al Sistema::   <?php   echo  $nombre_user     ?>  </h1>  
            <center>
                                     <iframe width="933" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiOGQzYWY4NmItZTljYS00NDMzLThlZjMtMDM0YTAyZTEzNzE0IiwidCI6ImEwMmM0ODBiLWJmN2QtNDE1YS05ZjY0LTgyY2U3NWJjYTVhNyIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe> 
                                    
                                </center>
      </div>
  
  

 


  <script src="main.js"></script>
  </body>
</html>