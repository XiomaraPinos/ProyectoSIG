<?php 

session_start();
    require 'conexion.php';
    if(isset($_GET['id'])){
        $id=(int) $_GET['id'];
        mysqli_query($conexion,("DELETE FROM contribuyente WHERE id_contr=$id")); 


		header('Location: contribuyentes.php');
	}else{
        header('Location: contribuyentes.php');
	}

?>