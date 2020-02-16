<?php
session_start();
require 'conexion.php';

if(isset($_GET['ide'])){
   // echo "hola mundo";
    $ide=(int) $_GET['ide'];
}

if(isset($_GET['id'])){
   // echo "solo ingresa aqui";
    $id=(int) $_GET['id'];
    $nomImg = null;
    //Encontrar el nombre de la imagen
   
    $consultaDoc = "SELECT * FROM  doc_contribuy where id_doc=$id";
    $resultadoDoc =  mysqli_query($conexion,$consultaDoc);
    while( $fila = mysqli_fetch_array($resultadoDoc)) {
        $nomImg =  $fila['imagen'];
    }
   
    mysqli_query($conexion,("DELETE FROM doc_contribuy WHERE id_doc=$id")); 
    //Eliminar la imagen
    unlink($nomImg);

   header("Location: doc_contr.php?id=$ide");
}else{
    header("Location: doc_contr.php?id=$ide");
}




?>