<?php
session_start();
$con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");


if (isset($_POST['botonEditar'])){
    $id=$_POST['id'];
    $nombre=$_POST['campoNombre'];
    $password=$_POST['campoPassword'];
    $email=$_POST['campoEmail'];
    
    // Consulta SQL para obtener los datos de los centros.
    $sql="UPDATE usuarios SET nombre='$nombre', email='$email', contraseña='$password' WHERE usuario_id='$id'";
    $resultados=mysqli_query($con,$sql) or die(mysqli_error());
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar usuarios - Instant message</title>
<link rel="stylesheet" href="./static/css/bootstrap.css">

	</head>
	<body>
		<header>
			<h1>Edici&oacute;n de usuarios</h1>
			<a href="backend.php">Volver</a>
		</header>
		<main>
		<div class='col-sm-10 col-md-8 col-lg-6 col-xl-2 row justify-content-center'>
		<form id="form1" name="form1" method="post" action="edit.php" class="row justify-content-center">
		
			
			
			
			<?php 
                $ssql="SELECT * FROM usuarios where activo='1'";
                $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if(mysqli_num_rows($result)){               
                    $select="<select class='col-10 row justify-content-center' name='id'>";

                    while($reg=mysqli_fetch_array($result)){
                        $select=$select."<option value='".$reg['usuario_id']."'>".$reg['nombre']."</option>";
                    }
                    
                    $select=$select."</select>";
                    echo($select);
                }else{
                    echo("No hay usuarios registrados");
                }
			?>
			
			<label class='col-10 row justify-content-center'>Nombre:<input name="campoNombre" type="text"></label>
			<label class='col-10 row justify-content-center'>Contrase&ntilde;a:<input name="campoPassword" type="password"></label>
			<label class='col-10 row justify-content-center'>Email:<input name="campoEmail" type="email"></label>
			<input type="submit" class="btn btn-success col-10 row justify-content-center" name="botonEditar" value="Guardar"/>
		
		</form>
		</div>
		</main>
		    <script src="./static/js/tether.min.js"></script>
    <script src="./static/js/jquery.min.js"></script>
    <script src="./static/js/bootstrap.js"></script>
	</body>
</html>