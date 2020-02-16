<?php
  session_start();
  require 'conexion.php';
  
  $message = '';
  $sesion = $_SESSION['user_id'];
  $nombre_user = null;
  $ced_user = null;
  $id_user= null;
  $email = null;
      $direccion = null;
      $passw = null;


       //Editar COntribuyente
    if(isset($_POST['edit'])){     
      if (!empty($_POST['ced']) && !empty($_POST['nombres'])) {
          try{
              mysqli_query($conexion,("UPDATE  users SET cedula='$_POST[ced]', nombres='$_POST[nombres]', email='$_POST[email]', 
              dir='$_POST[dire]', password='$_POST[passwr]'  WHERE  id_user ='$_POST[id_user]' ")); 
              
              $message = 'Usuario actualizado correctamente';
              header('Location: home.php');
          }catch( Exception  $ex){
            $message = 'Error durante la actualizacion';
           echo "Error al crear contribuyente";
          }
      }
  }


  $consultaU = "SELECT * FROM  users  where id_user = '$sesion'";
  $resultadoU =  mysqli_query($conexion,$consultaU);
  
  while( $fila = mysqli_fetch_array($resultadoU) )  {
      $id_user = $fila['id_user']; 
      $ced_user = $fila['cedula']; 
      $nombre_user =  $fila['nombres']; 
      $email =  $fila['email']; 
      $direccion =  $fila['dir']; 
      $passw =  $fila['password']; 
  }










?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrar Usuario</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  
    
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/styleper.css">
    <link rel="stylesheet" href="assets/css/styleS.css">
    
    <link rel="stylesheet" href="assets/css/user.css">


  </head>
  <body>

    
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>

    
    <div id="div_uni">
          <h1>Registrar Nuevo Usuario</h1><br>
        <form action="#" method="POST">
          <div id="contenedor1" class="contenedor">
      
          <label>Codigo: </label>
                <input type="text" name="id_user" value="<?php if($resultadoU) echo  $id_user; ?>" class="input__text" required>
                <label>Cedula:</label>
                <input type="text" name="ced" id="ced_ruc" value="<?php if($resultadoU) echo $ced_user ; ?>" class="input__text" required>			
                <label>Nombre:</label>
				        <input type="text" name="nombres" value="<?php if($resultadoU) echo   $nombre_user; ?>" class="input__text" required>
                <label>Email:</label>
				        <input type="email" name="email" value="<?php if($resultadoU) echo  $email; ?>" class="input__text" required>
			         <label>Direccion:</label>
				        <input type="text" name="dire" id="telf" value="<?php if($resultadoU) echo $direccion;  ?>" class="input__text" required>
                <label>Contrasenia:</label>
                <input type="password" name="passwr" id ="celular" value="<?php if($resultadoU) echo  $passw; ?>" class="input__text">
               
                        <?php if(!empty($message)): ?>
                          <p> <?= $message ?></p>
                        <?php endif; ?><br>
                        </div><br>
              
              <input type="submit" name="edit" value="Editar Usuario">
              <a href="home.php" class="btn btn__nuevo" >Volver</a>

              </form>
    </div>

    <script src="main.js"></script>
  </body>
  
</html>