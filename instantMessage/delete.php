<?php
session_start();
$con = mysqli_connect("localhost","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
//$con = mysqli_connect("localhost","adminstrador","123Daw$321","instantMessage") or die("No se pudo conectar");
if (isset($_POST['boton'])){
    if ($_POST['boton']=="Borrar"){
        $id=$_POST['idAct'];
        $sql="UPDATE usuarios SET activo='0' WHERE usuario_id='$id'";
        mysqli_query($con,$sql) or die(mysqli_error($con));
        
    }else if($_POST['boton']=="Activar"){
        $id=$_POST['idInact'];
        $sql="UPDATE usuarios SET activo='1' WHERE usuario_id='$id'";
        $resultados=mysqli_query($con,$sql) or die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Activaci&oacute;n y desactivaci&oacute;n de cuentas - Instant message</title>
<link rel="stylesheet" href="./static/css/bootstrap.css">

	</head>
	<body>
		<header>
			<h1>Activar y desactivar cuentas</h1>
			
			<a href="backend.php">Volver</a>
		</header>
		<main>
		<form id="form1" name="form1" method="post" action="delete.php">
		<div class="row justify-content-center">
			<?php 
                $ssql="SELECT * FROM usuarios where activo='1'";
                $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if(mysqli_num_rows($result)){               
                    $select="<select name='idAct'>";

                    while($reg=mysqli_fetch_array($result)){
                        $select=$select."<option value='".$reg['usuario_id']."'>".$reg['nombre']."</option>";   
                    }
                    
                    $select=$select."</select>";
                    echo($select);
                }else{
                    echo("No hay usuarios activos");
                }
			?>
			
			<input type="submit" class="btn btn-cancel" name="boton" value="Borrar"/>
			
			<?php 
                $ssql="SELECT * FROM usuarios where activo='0'";
                $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if(mysqli_num_rows($result)){               
                    $select="<select name='idInact'>";

                    while($reg=mysqli_fetch_array($result)){
                        
                        $select=$select."<option value='".$reg['usuario_id']."'>".$reg['nombre']."</option>";
                        
                        
                    }
                    
                    $select=$select."</select>";
                    echo($select);
                }else{
                    echo("No hay usuarios inactivos");
                }
			?>
			
			<input type="submit" class="btn btn-success" name="boton" value="Activar"/>
		</div>
		</form>
		</main>
		    <script src="./static/js/tether.min.js"></script>
    <script src="./static/js/jquery.min.js"></script>
    <script src="./static/js/bootstrap.js"></script>
	</body>
</html>