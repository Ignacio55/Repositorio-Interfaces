<?php
session_start();

if($_SESSION['permisos']!="admin"){
    echo("No estas autorizado para acceder");
    sleep(5);
    header("refresh:0,url='index.html'");
}
//$con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
$con = mysqli_connect("localhost","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Administrador - Instant message</title>
        <link rel="stylesheet" href="./static/css/bootstrap.css">
	</head>
	<body>
		<header>
		<h1>Administrador</h1>
		<div>
			<a href="registro.php">Registrar nuevo usuario</a>
			<a href="edit.php">Editar usuarios</a>
			<a href="delete.php">Activar / desactivar cuentas</a>
			<a href="index.html">Logout</a>
		</div>
		</header>
		<main>
		<form id="form1" name="form1" method="post" action="backend.php">
    		<h2 class="col-6">Usuarios registrados</h2>
    		<div class="row justify-content-center">	
    			<?php 
                    $ssql="SELECT * FROM usuarios";
                    $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if(mysqli_num_rows($result)){               
                        $tabla="<table class='col-8 table-striped table-bordered'>
                                    <th>ID</th><th>Cuenta</th><th>Estado</th><th>Correo electr&oacute;nico</th>";
    
                        while($reg=mysqli_fetch_array($result)){
                            if($reg['activo']==1){
                                $activo="Cuenta activa";
                            }else{
                                $activo="Cuenta suspendida";
                            }
                            
                            $tabla=$tabla."<tr><td>".$reg['usuario_id']."</td><td>".$reg['nombre']."</td><td>$activo</td><td>".
                                $reg['email']."</td></tr>";
                        }
                        
                        $tabla=$tabla."</table>";
                        echo($tabla);
                    }else{
                        echo("No hay usuarios registrados");
                    }
    			?>
    			</div>
    		</form>
		</main>
	    <script src="./static/js/tether.min.js"></script>
        <script src="./static/js/jquery.min.js"></script>
        <script src="./static/js/bootstrap.js"></script>
	</body>
</html>