<?php

session_start();

$nom_imagen = $_POST['nom_imagen'];
    $file = file($nom_imagen);
    $file2 = implode("",$file);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$nom_imagen");
    echo $file2;
   
?>