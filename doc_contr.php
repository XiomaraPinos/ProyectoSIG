<?php

session_start();
require 'conexion.php';

if(isset($_GET['id'])){
    try{
    $id=(int) $_GET['id'];
    $consultaContr = "SELECT * FROM  contribuyente  WHERE  id_contr = '$id' ";
    $resultadoContr =  mysqli_query($conexion,$consultaContr);
    while( $fila = mysqli_fetch_array($resultadoContr) )  {
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
}
//CARGAR LA TABLA CON DOCUMENTOS
$consultaDoc = "SELECT * FROM  doc_contribuy where id_contr='$id' ";
$resultadoDoc =  mysqli_query($conexion,$consultaDoc);

//GUARDAR DOCUMENOS
$nomImg = null;
    $archivo = null;
if(isset($_POST['btn_grabar'])){ 

    $nomImg = $_FILES['foto']['name'];
    $archivo = $_FILES['foto']['tmp_name'];
    $ruta = "imagen";
    $ruta = $ruta."/".$nomImg;
    move_uploaded_file($archivo,$ruta); 
    
      if (!empty($_POST['nom_doc'])) {
        try{
            mysqli_query($conexion,("INSERT INTO doc_contribuy (id_contr,nom_doc,imagen) 
            VALUES ( '$_POST[cod_contr]','$_POST[nom_doc]', '$ruta' )"));
            $message = 'Documento subido correctamente';
           // echo "Documento subido correctamente---------------------------------------ljlkljkl";
            $consultaDoc = "SELECT * FROM  doc_contribuy where id_contr='$id' ";
            $resultadoDoc =  mysqli_query($conexion,$consultaDoc);
        }catch( Exception  $ex){
           // header('Location: doc_contr.php');
           /// echo "no ingreso";
          $message = 'Error al subir documento';        
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/styleper.css">
    <link rel="stylesheet" href="assets/css/styleS.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Bomberos</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>

    <div id="div_uni">
       
        <h4>Contribuyente</h4><br>
        <div id="contenedor1" class="contenedor">
            
            <form action="" method="POST">
                    <label>Código:</label>
                    <input type="text" name="id_contr" value="<?php if($resultadoContr) echo $id_contr; ?>" class="input__text" disabled>
                    <label>Cédula:</label>
                    <input type="text" name="ced" value="<?php if($resultadoContr) echo $ced_contr ; ?>" class="input__text" disabled>			
                    <label>Nombre:</label>
                    <input type="text" name="nombres" value="<?php if($resultadoContr) echo  $nombre_contr; ?>" class="input__text" disabled>
                   <br> <label>Direccion:</label>
                    <input type="text" name="dir" value="<?php if($resultadoContr) echo  $dir_contr; ?>" class="input__text" disabled>
                    <label>Teléfono:</label>
                    <input type="text" name="telf" value="<?php if($resultadoContr) echo $telf_contr; ?>" class="input__text" disabled>
                    <label>Celular:</label>
                    <input type="text" name="celular" value="<?php if($resultadoContr) echo  $celular_contr; ?>" class="input__text" disabled>
                    <br><label>Correo:</label>
                    <input type="text" name="correo" value="<?php if($resultadoContr) echo $email_contr; ?>" class="input__text" disabled> 
            </form>	
        </div>
    <!--REGISTROS DE DOCUMENTOS DEL CONTRIBUYENTE-->
        <br>
        <form action="#" method="POST" enctype="multipart/form-data" > 
            
            <h4>Ingreso de Documentos</h4><br>
            <div id="contenedor1">
                <input name="cod_contr" type="hidden"  value = <?php if($resultadoContr) echo $id; ?>  placeholder="Contribuyente"> 
                <label>Nombre del documento:</label>
                <input name="nom_doc"   type="text"  placeholder="Nombre del documento"  required>
                <div id="imagePreview"> </div>
                <label>Imagen:</label>
                <input name="foto" id = "imagen" type="file"   required >                 
            </div>
                <br>
            <div id="elemento">
                <input type="submit" name="btn_grabar" value="Subir Documento"> 
            </div >      
        </form> 

        <!--TABLA DE DOCUMENTOS-->
        <div class="contenedor">		
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Documento</td>
                <td>Imagen</td>				
				<td colspan="3">Acción</td>
            </tr>         
			<?php  while( $fila = mysqli_fetch_array($resultadoDoc)) {  ?>
				<tr>
					<td><?php echo $fila['id_doc']; ?></td>
					<td><?php echo $fila['nom_doc']; ?></td>
                    <td>  <img  src="<?php echo $fila['imagen'];?> " width=40  height=40 > </td>                                               
                    <td><a href="mostrar_doc.php?id=<?php echo $fila['id_doc']; ?>&ide=<?php echo  $id_contr; ?> " class="btn btn__update" >Visualizar</a>  </td>                    
                    <td><a href="delete_doc.php?id=<?php echo $fila['id_doc'];?>&ide=<?php echo  $id_contr; ?>   "  neme="dele" class="btn__delete"  onclick="return validarDelete();">Eliminar</a></td> 
				</tr>
            <?php } ?>

		</table>
    </div>


    </div>
    <script src="js/validation.js"> </script>
    
</body>
</html>