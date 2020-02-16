
<?php 
session_start();
require 'conexion.php';


$consulta = "SELECT  VENTAS.ID, VENTAS.CANT_CAJAS,VENTAS.PREC,VENTAS.TOTAL,VENTAS.FECHA ,CLIENTE.NOM_CLI
             FROM  VENTAS, CLIENTE  where VENTAS.ID_CLIENT = CLIENTE.ID_CLI";
    $resultado =  mysqli_query($conexion,$consulta);



    if(isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar']; 
              
        $consulta =  "SELECT  VENTAS.ID, VENTAS.CANT_CAJAS,VENTAS.PREC,VENTAS.TOTAL,VENTAS.FECHA ,CLIENTE.NOM_CLI
        FROM  VENTAS, CLIENTE  where VENTAS.ID_CLIENT = CLIENTE.ID_CLI      
         and DNI LIKE '$_POST[buscar]' ";
        $resultado =  mysqli_query($conexion,$consulta);
    }

    if(isset($_POST['btn_Todos'])){
        $consulta = "SELECT VENTAS.ID,  VENTAS.CANT_CAJAS,VENTAS.PREC,VENTAS.TOTAL,VENTAS.FECHA ,CLIENTE.NOM_CLI
             FROM  VENTAS, CLIENTE  where VENTAS.ID_CLIENT = CLIENTE.ID_CLI";
    $resultado =  mysqli_query($conexion,$consulta);

        $resultado =  mysqli_query($conexion,$consulta);
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
  
  
    <title>Registrar Permisos</title>
   
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php require 'partials/lateral.php' ?>
    
    <div id="sub_menu_div">
        <?php require 'partials/submenu_perm.php' ?>      
    </div>
    
    <div id="div_uni">
  
    <div class="contenedor">
    <h2>VENTAS DE LA EMPRESA XXX</h2>

            <form action="" class="formulario" method="post">  

                <h3>BUSCAR:</h3> 
                <!--label id="label_busc"> Buscar:</label-->        	
				<input  type="text" name="buscar" placeholder="buscar Cedula o Ruc" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
               
                <input type="submit" class="" name="btn_buscar" value="Buscar">                
                <input type="submit" class=" " name="btn_Todos" value="Ver todos">
                <a href="ventas.php" id="abrir" class="">Nuevo Venta</a>   <!--btn btn__nuevo-->
			</form>

           
            <table>
			<tr class="head">
                <td>Id</td>				
				<td>Empresa</td>
				<td>Cantidad</td>
				<td>Precio</td>
                <td>Total</td>
				<td>Fecha</td>  
                        
              
				<td colspan="3">Acción</td>
            </tr>         
			<?php    while( $fila = mysqli_fetch_array($resultado) )  {  ?>
				<tr >
                    <td><?php echo $fila['ID']; ?></td>
					<td><?php echo $fila['NOM_CLI']; ?></td>
					<td><?php echo $fila['CANT_CAJAS']; ?></td>
					<td><?php echo $fila['PREC']; ?></td>
					<td><?php echo $fila['TOTAL']; ?></td>
                    <td><?php echo $fila['FECHA']; ?></td>
   
                    <td><a href="reportes/index.php?id=<?php echo $fila['ID']; ?>"   class="btn btn__update" target="_blank">Imprimir</a>  </td> 
                    
                    

				</tr>
            <?php } ?>

		</table>




    
                 
</div>
</div>
<script src="js/validation.js"> </script>
  <script src="js/functions.js"></script>   
  <script src="main.js"></script>
</body>
</html>