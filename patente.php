<?php 
 
 session_start();
require 'conexion.php';

 $resultado= null;
$resultadovehi = null;
   
$row = null;
$id_contr = null;
$ced_contr = null; 
$nombre_contr =  null; 
$dir_contr =  null; 
$telf_contr = null;
$celular_contr = null; 
$email_contr = null; 
 
 if(isset($_POST['btn_buscar'])){
    try{
    $buscar_text=$_POST['buscar']; 
    $consulta = "SELECT * FROM  contribuyente  WHERE  ced_ruc LIKE '$_POST[buscar]' OR nombres Like  '$_POST[buscar]'";
    $resultado =  mysqli_query($conexion,$consulta);

    while( $fila = mysqli_fetch_array($resultado) )  {
        $id_contr =  $fila['id_contr'];
        $ced_contr = $fila['ced_ruc']; 
        $nombre_contr =  $fila['nombres']; 
        $dir_contr =  $fila['dir']; 
        $telf_contr = $fila['telf'];
        $celular_contr = $fila['celular']; 
        $email_contr = $fila['email']; 

    }
}catch(Exception  $ex){
    echo $ex;   
}
  //  $id_contr;
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/css/styleper.css">
    <!--link rel="stylesheet" href="../assets/css/modal.css"-->
    <link rel="stylesheet" href="assets/css/styleS.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Sistema Bomberos</title>
</head>
<body>

<?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>

<div id="div_uni">
    <h4>INSPECCION</h4><br>
    <div id="contenedor1" class="barra__buscador">
			<form action="" class="formulario" method="post">  
            <label>Buscar por nombre o cédula:</label>       	
				<input type="text" name="buscar" placeholder="buscar nombre o Ruc" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">                             
              
	        </form>           
    </div>

    <br>
    <h4>Datos del Contribuyente</h4><br>
    <div id="contenedor1" class="contenedor">	
		<form action="" method="post">	
                <label>Código:</label>
				<input type="text" name="id_contr" value="<?php if($resultado) echo $id_contr; ?>" class="input__text" disabled required>  
                <label>Cédula:</label>
                <input type="text" name="ced" value="<?php if($resultado) echo $ced_contr ; ?>" class="input__text" disabled>			
                <label>Nombre:</label>
				<input type="text" name="nombres" value="<?php if($resultado) echo  $nombre_contr; ?>" class="input__text" disabled>
               <br> <label>Dirección:</label>
				<input type="text" name="dir" value="<?php if($resultado) echo  $dir_contr; ?>" class="input__text" disabled>
			    <label>Teléfono:</label>
				<input type="text" name="telf" value="<?php if($resultado) echo $telf_contr; ?>" class="input__text" disabled>
                <label>Celular:</label>
                <input type="text" name="celular" value="<?php if($resultado) echo  $celular_contr; ?>" class="input__text" disabled>
                <br><label>Correo:</label>
                <input type="text" name="correo" value="<?php if($resultado) echo $email_contr; ?>" class="input__text" disabled>
		</form>	
    </div>
    <br><br>

<!--Direccion-->
    <form action="op_delete/op_patente.php" method="POST"> 
        <div id="contenedor1">
        <input name="cod_contr" type="hidden"  value = <?php if($resultado) echo $id_contr; ?>  placeholder="Contribuyente"> 
        <label>Fecha:</label>  
        <input name="fecha" type="date" placeholder="Inspección" required> 
        
        <label>Inspección:</label>  
        <input name="inspección" type="text" placeholder="Inspección" required>     
        <label>Reinspección:</label> 
        <input name="reinspeccion" type="text" placeholder="Reinspección">      
        <label>Puerta Corta Fuego:</label> 
        <input name="puert_cortf" type="text" placeholder="Puerta Cortafuego"> 
        <br><label>Visto Bueno en Planos:</label>
        <input name="vis_planos" type="text" placeholder="Visto bueno en planos">
        <label>Asistencia Técnico:</label>
        <input name="asis_tec" type="text" placeholder="Asistencia Técnica"> 
        <label>Otros:</label>
        <input name="otros" type="text" placeholder="Otros">  </div><br>
        <!--guardar direccion-->   
        <div id="contenedor1">
        <label>Barrio:</label>  
        <input name="barrio" type="text" placeholder="barrio" required>     
        <label>Parroquia:</label> 
        <input name="parroquia" type="text" placeholder="Parroquia">      
        <label>Calle:</label> 
        <input name="calle" type="text" placeholder="Calle"> 
        <br><label>Edificio:</label>
        <input name="edificio" type="text" placeholder="Edificio">
        <label>Piso:</label>
        <input name="piso" type="text" placeholder="Piso">  
        
        </div>
        <br>
       <div id="elemento">
        <input type="submit" name="btn_grabar" value="Generar"> 
        </div >
    </form> 
    </div>
    </div>
<!--fin-->
</body>
</html>