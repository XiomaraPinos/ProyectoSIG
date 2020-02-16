<?php

session_start();
require 'conexion.php';

if(isset($_GET['id'])){
    try{
        $id=(int) $_GET['id'];
        $consultaContr = "SELECT * FROM  doc_contribuy  WHERE  id_doc = '$id' ";
        $resultadoContr =  mysqli_query($conexion,$consultaContr);
        }catch(Exception  $ex){
            echo $ex;   
    }
}

if(isset($_GET['ide'])){
    try{
        $ide=(int) $_GET['ide']; 
        }catch(Exception  $ex){
            echo $ex;   
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
   
    

    <title>Bomberos</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>
    
    <div id="div_uni">
        <?php while( $fila = mysqli_fetch_array($resultadoContr) )  { 
                $nom_ima = $fila['imagen'];
            ?>
            <img  src="<?php echo $fila['imagen'];?> " width=500  height=500 >  
              
        <?php } ?>
        <br>
       
        <form action="descargar_doc.php"  enctype="multipart/form-data" class="formulario" method="post"  >
            <input type="hidden" name="nom_imagen"  value="<?php if($resultadoContr) echo $nom_ima; ?>"/>
            <input  type="submit" class="btn" name="btn_descargar" value="Descargar">   
           
            <a href="doc_contr.php?id=<?php echo $ide ?>"   class="">Regresar</a>
        </form>
    </div>
</body>
</html>