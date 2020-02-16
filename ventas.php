<?php 
        session_start();
        require 'conexion.php';

    $sesion = $_SESSION['user_id'];
    $consultaU = "SELECT * FROM  USUARIO  where ID = '$sesion'";
    $resultadoU =  mysqli_query($conexion,$consultaU);
    $fecha =  date('m/d/Y g:ia');
    while( $fila = mysqli_fetch_array($resultadoU) )  {
            $iduser =  $fila['ID']; 
           $rol = 'Admin';  // = $fila['cedula']; 
           $dni =  $fila['DNI']; 
          
       } 

       $consultaCLI = "SELECT * FROM  CLIENTE";
        $resultadoCLI =  mysqli_query($conexion,$consultaCLI);

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

       if(isset($_GET['idcli'])){
        $idcli=  $_GET['idcli'];
        try{
        $consulta = "SELECT * FROM  CLIENTE  WHERE  DNI = $idcli";
        $resultado =  mysqli_query($conexion,$consulta);

        while( $fila = mysqli_fetch_array($resultado) )  {
            $id_contr =  $fila['ID_CLI'];
            $ced_contr = $fila['DNI']; 
            $nombre_contr =  $fila['NOM_CLI']; 
            $dir_contr =  $fila['DIR_CLI']; 
            $ciudad = $fila['CIUDAD'];         
            $email_contr = $fila['EMAIL']; 
            $celular_contr = $fila['TELF']; 
        }     
    }catch(Exception  $ex){
        echo $ex;   
    }  
    }




















       
        



    if(isset($_POST['btn_grabar'])){
        
        $fila = null;
        if (!empty($_POST['cant']) && !empty($_POST['total'])) {
            try{
                mysqli_query($conexion,("INSERT INTO VENTAS (ID_USER,ID_CLIENT,CANT_CAJAS,PREC,TOTAL,FECHA) 
                VALUES ('$_POST[id_user]','$_POST[id_client]','$_POST[cant]', '$_POST[costo]','$_POST[total]','$fecha')"));
                $message = 'Successfully created new venta';
           

             //Registrar Actividad del usuario Registrar Cliente
             $consultaV = "SELECT  MAX(ID)  FROM  VENTAS";
            $resultadov =  mysqli_query($conexion,$consultaV);
            while( $fila = mysqli_fetch_array($resultadov) )  {
                $idv =  $fila[0];         
            }


             mysqli_query($conexion,("INSERT INTO TAREAS_USER (NOM_USER,ROL,TAREA,FECHA)            
             VALUES ( '$dni','$rol','Registro de venta:$idv','$fecha')")); 
           
        }catch( Exception  $ex){
              $message = 'Error al crear venta';           
             echo "<script> alert('Los campos estan vacios');</script>";
            }
        }
    }
    


    if(isset($_POST['btn_buscar'])){
        try{
        $buscar_text=$_POST['buscar']; 
        $consulta = "SELECT * FROM  CLIENTE  WHERE  DNI LIKE '$_POST[buscar]' OR NOM_CLI Like  '$_POST[buscar]'";
        $resultado =  mysqli_query($conexion,$consulta);

        while( $fila = mysqli_fetch_array($resultado) )  {
            $id_contr =  $fila['ID_CLI'];
            $ced_contr = $fila['DNI']; 
            $nombre_contr =  $fila['NOM_CLI']; 
            $dir_contr =  $fila['DIR_CLI']; 
            $ciudad = $fila['CIUDAD'];         
            $email_contr = $fila['EMAIL']; 
            $celular_contr = $fila['TELF']; 
        }     
    }catch(Exception  $ex){
        echo $ex;   
    }
      
    }



    $totalv  = 0;
    $cant=null; 
    $prec=null; 

    if(isset($_POST['btn_calcular'])){
    
        $cant=$_POST['cant']; 
        $prec=$_POST['costo']; 
        $totalv  = $cant * $prec;

     //  $cedula  = $_POST['ced']; 


       // $buscar_text=$_POST['buscar']; 
        $consulta = "SELECT * FROM  CLIENTE  WHERE  DNI LIKE '$_POST[ced]' OR NOM_CLI Like  '$_POST[ced]'";
        $resultado =  mysqli_query($conexion,$consulta);

        while( $fila = mysqli_fetch_array($resultado) )  {
            $id_contr =  $fila['ID_CLI'];
            $ced_contr = $fila['DNI']; 
            $nombre_contr =  $fila['NOM_CLI']; 
            $dir_contr =  $fila['DIR_CLI']; 
            $ciudad = $fila['CIUDAD'];         
            $email_contr = $fila['EMAIL']; 
            $celular_contr = $fila['TELF']; 
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

    <h4>Ventas</h4><br>
    <div id="contenedor1" class="barra__buscador">
			<form action="" class="formulario" method="post">  
                <label>Buscar por nombre o cédula:</label>                    
                <select name="buscar">
                        <option value="0">Seleccione:</option>
                        <?php
                        while ($fila = mysqli_fetch_array($resultadoCLI)) {
                              echo '<option value="'.$fila[DNI].'">'.$fila[NOM_CLI].'</option>';
                        }
                        ?>
                    </select>  
				<!--input type="text" name="buscar" placeholder="buscar nombre o Ruc" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text"-->
                <input type="submit" class="btn" name="btn_buscar" value="Buscar">           
	        </form>           
    </div>


    <br>
    <h4>Datos del Cliente</h4><br>
    <div id="contenedor1" class="contenedor">
		
		<form action="" method="post">
		
                <label>Código:</label>
				<input type="text" name="id_contr" value="<?php if($resultado) echo $id_contr; ?>" class="input__text" disabled  style="width: 50px"   >
                <label>Ced/Ruc:</label>
                <input type="text" name="ced" value="<?php if($resultado) echo $ced_contr ; ?>" class="input__text" disabled>			
                <label>Nombre:</label>
				<input type="text" name="nombres" value="<?php if($resultado) echo  $nombre_contr; ?>" class="input__text" disabled>
                <label>Dirección:</label>
				<input type="text" name="dir" value="<?php if($resultado) echo  $dir_contr; ?>" class="input__text" disabled>
			    <label>Pais:</label>
				<input type="text" name="telf" value="<?php if($resultado) echo $ciudad; ?>" class="input__text" disabled>       
                <label>Email:</label>
                <input type="text" name="correo" value="<?php if($resultado) echo $email_contr; ?>" class="input__text" disabled>			
                <label>Telefono:</label>              
                <input type="text" name="celular" value="<?php if($resultado) echo  $celular_contr; ?>" class="input__text" disabled>
          
                
           
		</form>	
	</div>
<!--REGISTROS DE Venta-->
    <br>

        <h4>Registro de Venta</h4><br>
          
        <form action="#" method="POST"> 
            <div id="contenedor1">
            <input type="hidden" name="ced" value="<?php if($resultado) echo $ced_contr ; ?>" class="input__text" >			
               
                <label>iD USUARIO:</label>
                <input name="id_user" type="text" value="<?php if($resultadoU) echo $iduser;?>" placeholder="" required style="width: 50px">
                <label>Id Cliente:</label>     
                <input name="id_client" type="text" value="<?php if($resultado) echo $id_contr;?>" placeholder="Cliente" required> 
                <label>Cantidad de Cajas:</label>
               
              

                   
                        <input name="cant" type="text"  value="<?php echo   $cant; ?>" placeholder="Cantiadad" required>
                        <label>Precio:</label>
                        <input name="costo" type="text" value="<?php echo  $prec; ?>" placeholder="Costo" required> 
                        <input type="submit" name="btn_calcular" value="Calcular">
                        <label>Total:</label>
                    <input name="total" type="text"  value="<?php echo  $totalv; ?>" placeholder="" required>
                    

                   


                   
            </div>
        
            <br> 
            <br>
    
            <div id="elemento">
                <input type="submit" name="btn_grabar" value="Grabar Venta"> 
            </div >
        
        </form> 
        <div id="elemento">
        <?php if(!empty($message)): ?><p> <?= $message ?></p> <?php endif; ?>
        </div >

    </div>
</body>
</html>