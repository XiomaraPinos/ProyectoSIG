<?php 
 
 session_start();
require 'conexion.php';


//$id= (int) $_GET['id'];

//patente (cod_contr,,,,,,,) 
       

if(isset($_GET['id'])){
    $id= (int) $_GET['id'];
    $consulta = "SELECT * FROM  patente  WHERE  id_patente = $id ";
    $resultado =  mysqli_query($conexion,$consulta);

    while( $fila = mysqli_fetch_array($resultado) )  {
    
        $idpatente = $fila['id_patente']; 
        $id_contr =  $fila['cod_contr'];   
        $fec_emision =  $fila['fecha']; 
        $verf_insp =  $fila['verf_insp']; 
        $verf_reins = $fila['verf_reinsp'];
        $prtas_cortf = $fila['ver_prtas_cortf']; 
        $verf_planos = $fila['verf_planos']; 
        $verf_asis = $fila['verf_asis_tecn']; 
        $otros = $fila['atros']; 
        

    }   
}


//patente

try{
      
    $consultaC = "SELECT * FROM  contribuyente  WHERE  id_contr=$id_contr ";
    $resultadoC =  mysqli_query($conexion,$consultaC);
    while( $fila = mysqli_fetch_array($resultadoC) )  {
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
//ubicacion

try{
      
    $consultaU = "SELECT * FROM  ubicacion  WHERE  id_patente=$id";
    $resultadoU =  mysqli_query($conexion,$consultaU);
    while( $fila = mysqli_fetch_array($resultadoU) )  {
        $id_patente =  $fila['id_patente'];
        $barrio = $fila['barrio']; 
        $parroquia =  $fila['parroquia']; 
        $calle =  $fila['calle']; 
        $edificio = $fila['edificio'];
        $piso = $fila['piso']; 

    }
}catch(Exception  $ex){
    echo $ex;   
}












/*
 $resultado= null;
$resultadovehi = null;
   
$row = null;
$id_contr = null;
$ced_contr = null; 
$nombre_contr =  null; 
$dir_contr =  null; 
$telf_contr = null;
$celular_contr = null; 
$email_contr = null; */
 
/*
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
  
 }*/






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
    <h4>EDITAR INSPECCION</h4><br>
    <!--div id="contenedor1" class="barra__buscador">
			<form action="" class="formulario" method="post">  
            <label>Buscar por nombre o cédula:</label>       	
				<input type="text" name="buscar" placeholder="buscar nombre o Ruc" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">                             
              
	        </form>           
    </div-->

    <br>
    <h4>Datos del Contribuyente</h4><br>
    <div id="contenedor1" class="contenedor">	
		<form action="" method="post">	
                <label>Código:</label>
				<input type="text" name="id_contr" value="<?php if($resultadoC) echo $id_contr; ?>" class="input__text" disabled required>  
                <label>Cédula:</label>
                <input type="text" name="ced" value="<?php if($resultadoC) echo $ced_contr ; ?>" class="input__text" disabled>			
                <label>Nombre:</label>
				<input type="text" name="nombres" value="<?php if($resultadoC) echo  $nombre_contr; ?>" class="input__text" disabled>
               <br> <label>Dirección:</label>
				<input type="text" name="dir" value="<?php if($resultadoC) echo  $dir_contr; ?>" class="input__text" disabled>
			    <label>Teléfono:</label>
				<input type="text" name="telf" value="<?php if($resultadoC) echo $telf_contr; ?>" class="input__text" disabled>
                <label>Celular:</label>
                <input type="text" name="celular" value="<?php if($resultadoC) echo  $celular_contr; ?>" class="input__text" disabled>
                <br><label>Correo:</label>
                <input type="text" name="correo" value="<?php if($resultadoC) echo $email_contr; ?>" class="input__text" disabled>
		</form>	
    </div>
    <br><br>


    
<!--Direccion-->
    <form action="op_delete/op_patente.php" method="POST"> 
        <div id="contenedor1">
        <input name="cod_contr" type="hidden"  value = <?php if($resultado) echo $id_contr; ?>  placeholder="Contribuyente"> 
        <input name="id_patente" type="hidden"  value = <?php if($resultado) echo $idpatente; ?>  placeholder="Contribuyente"> 

        <label>Fecha:</label>  
        <input name="fecha" type="date" placeholder="Inspección"  value="<?php if($resultado) echo  $fec_emision; ?>"  required> 
        
        <label>Inspección:</label>  
        <input name="inspección" type="text" placeholder="Inspección" value="<?php if($resultado) echo  $verf_insp; ?>" required>     
        <label>Reinspección:</label> 
        <input name="reinspeccion" type="text" placeholder="Reinspección"value="<?php if($resultado) echo $verf_reins; ?>" >      
        <label>Puerta Corta Fuego:</label> 
        <input name="puert_cortf" type="text" placeholder="Puerta Cortafuego" value="<?php if($resultado) echo $prtas_cortf; ?>"> 
        <br><label>Visto Bueno en Planos:</label>
        <input name="vis_planos" type="text" placeholder="Visto bueno en planos" value="<?php if($resultado) echo $verf_planos; ?>">
        <label>Asistencia Técnico:</label>
        <input name="asis_tec" type="text" placeholder="Asistencia Técnica" value="<?php if($resultado) echo $verf_asis; ?>"> 
        <label>Otros:</label>
        <input name="otros" type="text" placeholder="Otros" value="<?php if($resultado) echo  $otros; ?>">  </div><br>
        <!--guardar direccion-->   
        

        <div id="contenedor1">
        <label>Barrio:</label>  
        <input name="barrio" type="text" placeholder="barrio" value="<?php if($resultadoU) echo  $barrio; ?>" required>     
        <label>Parroquia:</label> 
        <input name="parroquia" type="text" placeholder="Parroquia" value="<?php if($resultadoU) echo  $parroquia; ?>">    
        <label>Calle:</label> 
        <input name="calle" type="text" placeholder="Calle" value="<?php if($resultadoU) echo  $calle; ?>">
        <br><label>Edificio:</label>
        <input name="edificio" type="text" placeholder="Edificio" value="<?php if($resultadoU) echo  $edificio; ?>">
        <label>Piso:</label>
        <input name="piso" type="text" placeholder="Piso" value="<?php if($resultadoU) echo $piso; ?>"> 
        
        </div>
        <br>
       <div id="elemento">
        <input type="submit" name="btn_editar_patente" value="Editar"> 
        </div >
    </form> 
    </div>
    </div>
<!--fin-->
</body>
</html>