<?php 
        session_start();
        require 'conexion.php';

        $id_contr =  null; 
        $ced_contr = null; 
        $nombre_contr =  null; 
        $dir_contr = null;  
        $telf_contr = null; 
        $celular_contr = null;  
        $email_contr = null; 

     //   $id_contr =  $fila['cod_contr'];
        //  $ced_contr = $fila['ced_ruc']; 
          $fec_emision = null; 
          $fec_deps =  null; 
          $fec_venc = null;
          $cant = null; 
          $precio = null; 
          $valor = null; 
          $motivos = null; 
          $observ = null; 

        if(isset($_GET['id'])){
            $id= (int) $_GET['id'];
            $consulta = "SELECT * FROM  detall_service  WHERE  id_det_ser = $id ";
            $resultado =  mysqli_query($conexion,$consulta);
    
            while( $fila = mysqli_fetch_array($resultado) )  {
                 $id_det_serv = $fila['id_det_ser']; 
                $id_contr =  $fila['id_contr'];            
                $fec_emision =  $fila['fecha_emision']; 
                $fec_deps =  $fila['fecha_depos']; 
                $fec_venc = $fila['fecha_venc'];
                $cant = $fila['cant']; 
                $precio = $fila['prec']; 
                $valor = $fila['valor']; 
                $motivos = $fila['motivo']; 
                $observ = $fila['observ']; 
            }   
        }

        $consultaService = "SELECT * FROM  service ORDER BY id_service ASC";
        $resultadoService =  mysqli_query($conexion,$consultaService);    
        
//Servicio de transporte
    if(isset($_POST['btn_grabar'])){      
          if (!empty($_POST['fecha_emi']) && !empty($_POST['fecha_depos'])) {
            try{
                mysqli_query($conexion,("UPDATE detall_service SET id_contr='$_POST[cod_contr]', id_service='$_POST[id_service]',fecha_emision='$_POST[fecha_emi]',
                fecha_depos='$_POST[fecha_depos]',fecha_venc='$_POST[fecha_venc]',cant= '$_POST[cant]',prec='$_POST[prec]',
                valor='$_POST[valor]',motivo='$_POST[motivos]',observ='$_POST[observ]'  WHERE id_det_ser='$_POST[id_det_ser]'"));
                $message = 'Permiso de Servicio Creado';            
                header('Location: permisos.php');
            }catch( Exception  $ex){
              $message = 'Error al crear permiso';        
            }
        }
    }

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
    <title>Servicio Transporte</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>


<div id="div_uni">

    <h4>SERVICIOS</h4><br>
   
    <h4>Datos del Contribuyente</h4><br>
    <div id="contenedor1" class="contenedor">	
		<form action="" method="post">
                <label>Código:</label>
				<input type="text" name="id_contr" value="<?php if($resultadoC) echo $id_contr; ?>" class="input__text">
                <label>Cédula:</label>
                <input type="text" name="ced" value="<?php if($resultadoC) echo $ced_contr ; ?>" class="input__text">			
                <label>Nombre:</label>
				<input type="text" name="nombres" value="<?php if($resultadoC) echo  $nombre_contr; ?>" class="input__text">
                <label>Dirección:</label>
				<input type="text" name="dir" value="<?php if($resultadoC) echo  $dir_contr; ?>" class="input__text">
			    <label>Teléfono:</label>
				<input type="text" name="telf" value="<?php if($resultadoC) echo $telf_contr; ?>" class="input__text">
                <label>Celular:</label>
                <input type="text" name="celular" value="<?php if($resultadoC) echo  $celular_contr; ?>" class="input__text">
                <label>Correo:</label>
                <input type="text" name="correo" value="<?php if($resultadoC) echo $email_contr; ?>" class="input__text">                 
		</form>	
	</div>
<!--Registro de servicios-->
    <br>
        <h4>Seleccionar Servicio</h4><br>

    <form action="" method="POST"> 
    <div id="contenedor1">
      <select name="id_service">
        <option value="0">Seleccione:</option>
        <?php
        while ($fila = mysqli_fetch_array($resultadoService)) {
             echo '<option value="'.$fila[id_service].'">'.$fila[descrip].'</option>';
            } ?>
        </select>  
    </div>
    <br>
    <h4>Detalles del servicio</h4><br>

    <!--form action="view/addVehiculo.php" method="POST"-->  
    <div id="contenedor1">
        <input name="id_det_ser" type="hidden"  value = <?php if($resultado) echo $id_det_serv; ?>  placeholder="Contribuyente"> 
        <input name="cod_contr" type="hidden"  value = <?php if($resultado) echo $id_contr; ?>  placeholder="Contribuyente"> 
        <label>Fecha Emision:</label>  
        <input name="fecha_emi" type="date"  value = <?php if($resultado) echo $fec_emision; ?> placeholder="Fecha de emision">     
        <label>Fecha depósito:</label> 
        <input name="fecha_depos" type="date" value = <?php if($resultado) echo $fec_deps; ?> placeholder="fecha deposito">      
        <label>Fecha Vencimiento:</label> 
        <input name="fecha_venc" type="date" value = <?php if($resultado) echo $fec_venc; ?> placeholder="fecha Vencimiento"> 
        <label>Cantidad:</label>
        <input name="cant" type="text" value = <?php if($resultado) echo $cant; ?> placeholder="Cantidad">
        <label>Precio:</label>
        <input name="prec" type="text" value = <?php if($resultado) echo $precio; ?> placeholder="Precio"> 
        <label>Valor:</label>
        <input name="valor" type="text" value = <?php if($resultado) echo $valor; ?> placeholder="Valor">
        <label>Motivos:</label>
        <input name="motivos" type="text" value = <?php if($resultado) echo $motivos; ?> placeholder="Motivos">
        <label>Observaciones:</label>
        <input name="observ" type="text" value = <?php if($resultado) echo  $observ; ?> placeholder="Observaciones">
        </div>
        <br>       
       <div id="elemento">
        <input type="submit" name="btn_grabar" value="Editar el permiso"> 
        <a href="permisos.php" class="btn btn__nuevo" >Volver</a>
        
        </div> 
    </form> 
    </div>
</body>
</html>