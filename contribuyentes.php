<?php
    session_start();
    require 'conexion.php';
    
    $id_contr =  null;
    $ced_contr = null; 
    $nombre_contr =  null; 
    $dir_contr =  null;
    $telf_contr = null;
    $celular_contr = null;
    $email_contr = null;
    $tip_contr = null;
   
    $consulta = "SELECT * FROM  contribuyente ORDER BY id_contr ASC";
    $resultado =  mysqli_query($conexion,$consulta);
    
    if(isset($_POST['btn_buscar'])){
        
        $buscar_text=$_POST['buscar']; 
        $consulta = "SELECT * FROM  contribuyente  WHERE  ced_ruc LIKE '$_POST[buscar]' OR nombres Like  '$_POST[buscar]'";
        $resultado =  mysqli_query($conexion,$consulta);
    }
    //registrar contribuyente
    if (!empty($_POST['ced_ruc']) && !empty($_POST['nombres'])) {
        try{
        mysqli_query($conexion,("INSERT INTO contribuyente (ced_ruc,nombres, dir,telf,celular,email,tip_contribuyente) 
        VALUES ('$_POST[ced_ruc]', '$_POST[nombres]','$_POST[direccion]','$_POST[telf]', '$_POST[celular]','$_POST[email]','$_POST[tip_contrib]')"));
        $message = 'Successfully created new contribuyente';
        header('Location: contribuyentes.php');

        }catch( Exception  $ex){
          $message = 'Error al crear contribuyente';
         echo "Error al crear contribuyente";
        }
      }
      //cargar contribuyente seleccionado
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
            $tip_contr = $fila['tip_contribuyente']; 
           
        }   
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
   

</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>
    
    <div id="div_uni">
	
    <div class="contenedor">
		<h2>CONTRIBUYENTES</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">     
                <label id="label_busc">Buscar:</label>    	
                
                <input type="text" name="buscar" placeholder="Buscar  nombre o Ruc/Ced" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">                            
                <input id="btn_busc" type="submit" class="" name="btn_buscar" value="Buscar">                               
                <input id="btn_vert" type="submit" class=""  value="Ver Todo"> 
                <!--<a href="#" id="abrir" class="btn btn__nuevo" >Nuevo</a-->
                <a href="#" id="abrir" class="" >Nuevo</a>

			</form>           
        </div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Cedula/Ruc</td>
				<td>Nombres</td>
				<td>Dirección</td>
				<td>Teléfono</td>              
                <td>Celular</td>
                <td>Email</td>
                <td>Tipo</td>
				<td colspan="3">Acción</td>
            </tr>         
			<?php    while( $fila = mysqli_fetch_array($resultado) )  {  ?>
				<tr >
					<td><?php echo $fila['id_contr']; ?></td>
					<td><?php echo $fila['ced_ruc']; ?></td>
					<td><?php echo $fila['nombres']; ?></td>
					<td><?php echo $fila['dir']; ?></td>
					<td><?php echo $fila['telf']; ?></td>
                    <td><?php echo $fila['celular']; ?></td>
                    <td><?php echo $fila['email']; ?></td> 
                    <td><?php echo $fila['tip_contribuyente']; ?></td> 

                                         
                    <td><a href="edit_contribuy.php?id=<?php echo $fila['id_contr']; ?>"   class="btn btn__update" >Editar</a> </td>               
                    <td><a href="doc_contr.php?id=<?php echo $fila['id_contr']; ?>" ID="abrirAct"  class="btn btn__update" >Documentos</a>  </td>                                                    
                    <td><a href="delete_contribuy.php?id=<?php echo $fila['id_contr']; ?>"   class="btn__delete"  onclick="return validarDelete();">Eliminar</a></td> 
				</tr>
            <?php } ?>
		</table>
    </div>
        
    
	<div id="miModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h4>Registrar Contribuyente</h4>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">					
                    <div class="box"> 
                    <form action="contribuyentes.php" method="POST" onsubmit="return validar();">      
                        <input name="ced_ruc" id="ced_ruc" type="text" placeholder="Ingrese su cedula" style="line-height: 100%" required> 
                        <input name="nombres" type="text" placeholder="Ingrese sus nombres" required>      
                        <input name="direccion" type="text" placeholder="Ingrese su direccion" required> 
                        <input name="telf" id="telf" type="text" placeholder="telefono" required>
                        <input name="celular" id ="celular" type="text" placeholder=" celular"> 
                        <input name="email" type="email" placeholder="email">                      
                        
                        <select name="tip_contrib" id="id_select" required>
                        <option></option>
                        <option>Persona</option>
                        <option>Empresa</option>     
                        </select> <br><br>
                        <input type="submit" value="Registrar">
                    </form>
                </div>                
                </div>
				<div class="footer">
					<h4>Sistema Bomberos &copy;</h4>
				</div>
			</div>
		</div>
    </div>
            </div>
    <!-- Finar Editar contribuyente-->

    <script src="js/validation.js"> </script>

    <script src="main.js"></script>
</body>
</html>