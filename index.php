<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: home.php');
}
require 'conexion.php';

if (!empty($_POST['cedula']) && !empty($_POST['password'])) {
    
    $consulta = "SELECT * FROM USUARIO  WHERE DNI = '$_POST[cedula]'  and PASS = '$_POST[password]' ";
    $resultado =  mysqli_query($conexion,$consulta);
    $file = mysqli_num_rows($resultado); 
    $row = mysqli_fetch_assoc($resultado);

  if($file > 0){
   
    $_SESSION ['user_id'] = $row['ID'];
    //Guardar aqui los datos del usuario logueado
     $fecha =  date('m/d/Y g:ia');
     $ip = $_SERVER['REMOTE_ADDR']; 
     $host = gethostname();
     $rol = 'ADMIN';

    mysqli_query($conexion,("INSERT INTO SESIONES_USER (NOM_USER,ROL,FECHA,IP,HOST) 
    VALUES ( '$_POST[cedula]','$rol','$fecha','$ip','$host')"));    
  
      header("Location: home.php");
    
  }else {
    $message = 'Error en la autentificacion';
  }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/main.css">
 
</head>

<body>
    <?php require 'partials/headerLogin.php' ?>
 

    <br><br><br> <br><br>
     
        <div >
          <br>
        <h1>Inicio de Sesión</h1><br>
        <img src="assets/img/logo.png" alt="Logo" class="logo">
            <form action="index.php" method="POST">
              <input name="cedula" type="text" placeholder=" cedula"> 
              <input name="password" type="password" placeholder=" Password">   
              <input type="submit" value="Ingresar">
            </form>
            <?php if(!empty($message)): ?><p> <?= $message ?></p> <?php endif; ?>
            <br>
        </div>



</body>
</html>
