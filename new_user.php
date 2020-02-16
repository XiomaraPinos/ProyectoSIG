<?php
  session_start();
  require 'conexion.php';
  
  $message = '';

  if(isset($_POST['registrar'])){
    $passw1=$_POST['password']; 
    $passw2=$_POST['confirm_password']; 
    if($passw1==$passw2){
      mysqli_query($conexion,("INSERT INTO USUARIO (DNI,NOMBRES,DIR,EMAIL,PASS,PHONE,ROL) 
      VALUES ('$_POST[dni]','$_POST[nombres]','$_POST[dir]','$_POST[email]', '$_POST[confirm_password]','$_POST[phone]','$_POST[nom_rol]')"));
      
      
      
      
      
      
      
      $message = 'Successfully created new user';
  

    }else {
      $message = 'Contraseñas no coniciden';
    }
}

$consultRol = "SELECT * FROM  roles ORDER BY ID ASC";
$resultadoRol =  mysqli_query($conexion,$consultRol);

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
          
         
        
          <form action="new_user.php" method="POST">
          <div id="contenedor1" class="contenedor">
      
          <input name="dni" type="text" placeholder="Ingrese su cédula" required> 
        <input name="nombres" type="text" placeholder="Ingrese su nombres" required>       
        <input name="dir" type="text" placeholder="dirección">
        <input name="email" type="email" placeholder="Ingrese su email"> 
        <input name="phone" type="text" placeholder="Ingrese su Telefono"> 
       
       
       
       
      
        <label>Seleccionar Rol:</label>  
      <select name="nom_rol">
                                    <option value="0">Seleccione:</option>
                                    <?php
                                     while ($fila = mysqli_fetch_array($resultadoRol)) {
                                        echo '<option value="'.$fila[NAME_ROL].'">'.$fila[NAME_ROL].'</option>';
                                    }
                                    ?>
        </select>




        <input name="password" type="password" placeholder="Ingrese su Password" required> 
        <input name="confirm_password" type="password" placeholder="Confirmar su Password" required> 
                
               
          <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
          <?php endif; ?><br>
              </div><br>
              <input type="submit" name="registrar" value="Registrarse">
          </form>
       
    </div>

    <script src="main.js"></script>
  </body>
  
</html>