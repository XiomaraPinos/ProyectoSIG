<?php 
session_start();
require 'conexion.php';
$nomImg = null;
$archivo = null;
$nomImg = $_FILES['foto']['name'];
$archivo = $_FILES['foto']['tmp_name'];
$ruta = "imagen";
$ruta = $ruta."/".$nomImg;
move_uploaded_file($archivo,$ruta);


if (!empty($_POST['id_perm']) && !empty($_POST['id_contr'])) {
    try{
    mysqli_query($conexion,("INSERT INTO permisos (id_permiso,id_contr, img_perm) 
    VALUES ('$_POST[id_perm]', '$_POST[id_contr]', '$ruta'   )"));
     echo   'Datos registrados correctamente';
    // header('Location: permisos.php');
    }catch( Exception  $ex){
        header('Location: permisos.php');
        echo   'Error al crear permiso';
     echo "Error al crear permiso";
    }
}

?>