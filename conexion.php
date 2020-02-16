<?php

$servidor = "localhost";
$usuario= "root";
$password = "";
$base_datos = "bananera";
$port = 3308;
$conexion = new mysqli($servidor, $usuario, $password, $base_datos, $port);
/*
function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}*/


?>