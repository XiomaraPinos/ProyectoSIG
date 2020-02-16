<?php 
session_start();
require 'conexion.php';

    //Editar COntribuyente
    if(isset($_POST['btn_grabar'])){     
        if (!empty($_POST['ced']) && !empty($_POST['nombres'])) {  
            try{
                mysqli_query($conexion,("UPDATE  contribuyente SET ced_ruc='$_POST[ced]', nombres='$_POST[nombres]', dir='$_POST[dir]', 
                telf='$_POST[telf]', celular='$_POST[celular]' , email='$_POST[email]',	tip_contribuyente='$_POST[tip_contrib]'  WHERE  id_contr ='$_POST[id_contr]' ")); 
                $message = 'Contribuyente actualizado correctamente';
                header('Location: contribuyentes.php');
            }catch( Exception  $ex){
              $message = 'Error durante la actualizacion';
             echo "Error al crear contribuyente";
            }
        }
    }
    if(isset($_GET['id'])){
        $id= (int) $_GET['id'];
        $consulta = "SELECT * FROM  contribuyente  WHERE  id_contr = $id ";
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/css/styleper.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/styles.css">  
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="js/validation.js"> </script>
    
    <title>Sistema Bomberos</title>
</head>
<body>
<?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>
    <div id="div_uni"> 
    <h4>Editar Contribuyente</h4><br>
    <div id="contenedor1" class="contenedor">	
        	
		<form action="#" method="post"  onsubmit="return validar();">	
                <label>Código: </label>
                <input type="text" name="id_contr" value="<?php if($resultado) echo $id_contr; ?>" class="input__text" required>
                <label>Cedula:</label>
                <input type="text" name="ced" id="ced_ruc" value="<?php if($resultado) echo $ced_contr ; ?>" class="input__text" required>			
                <label>Nombre:</label>
				<input type="text" name="nombres" value="<?php if($resultado) echo  $nombre_contr; ?>" class="input__text" required>
                <label>Direccion:</label>
				<input type="text" name="dir" value="<?php if($resultado) echo  $dir_contr; ?>" class="input__text" required>
			    <label>Telefono:</label>
				<input type="text" name="telf" id="telf" value="<?php if($resultado) echo $telf_contr; ?>" class="input__text" required>
                <label>Celular:</label>
                <input type="text" name="celular" id ="celular" value="<?php if($resultado) echo  $celular_contr; ?>" class="input__text">
                <label>Correo:</label>
                <input type="email" name="email" value="<?php if($resultado) echo $email_contr; ?>" class="input__text">	<br>	<br>
                <label>Tipo de Contribuyente:</label>
                <select name="tip_contrib" required >
                        <option></option>
                        <option>Persona</option>
                        <option>Empresa</option>     
                </select> <br><br>

                <div id="elemento">
                    <input type="submit"  name="btn_grabar"  value="Editar Contribuyente">
                    <a href="contribuyentes.php" class="btn btn__nuevo" >Volver</a>
        
                </div >
               
                
		</form>	
	<!--/div-->

    </div>

</body>
</html>