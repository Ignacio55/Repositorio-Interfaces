<?php
session_start();
//control de acceso URL
if(isset($_SESSION['user'])){

    $con = mysqli_connect("localhost","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
    
    
    if(isset($_POST['botonRegistro'])){
        //hacer validacion previa: si lagun campo no se ha introducido indicarlo para el formulario
        $nombre=$_POST['campoNombre'];
        $password=$_POST['campoPassword'];
        $email=$_POST['campoEmail'];
        if($nombre!="" && $password!="" && $email!=""){
            //comprobar que el email no exista
            $ssql1="SELECT * FROM usuarios WHERE nombre='$nombre'";
            $result1 = mysqli_query($con, $ssql1) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            
            if(!mysqli_num_rows($result1)){
                $ssql2="SELECT * FROM usuarios WHERE email='$email'";
                $result2 = mysqli_query($con, $ssql2) or die ( "Algo ha ido mal en la consulta a la base de datos2");
                
                if(!mysqli_num_rows($result2)){
                    $ssql="INSERT INTO usuarios VALUES (NULL, '$nombre', '$email', 'usuario', '".date("Y-m-d H:i:s")."', '$password','1');";
                    
                    $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos:".$ssql);
                    
                    if($_SESSION['permisos'] == "admin"){
                        header("refresh:5,url='backend.php'");
                    }else{
                        $_SESSION['user'] = $nombre;
                        header("refresh:5,url='frontend.php'");
                    }
                }else{
                    echo("Ya hay un usuario con ese correo");
                    header("refresh:5,url='registro.html'");
                }
            }else{
                echo("Ya hay un usuario con ese nombre");
                header("refresh:5,url='registro.html'");
            }
        }else{
            echo("Hay cmapos en blanco");
            header("refresh:5,url='registro.html'");
        }
    }
}else{
    echo("No estas autorizado");
    header("refresh:5,url='index.html'");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instant message - Inicio de sesion</title>
    <link rel="stylesheet" href="./static/css/bootstrap.css">
</head>
<body>
    <header>
        <h1 class="row justify-content-center">Instant message</h1>
        <?php 
            if($_SESSION['permisos']=="admin"){
                echo("<a href='backend.php'>volver</a>");
            }else{
                echo("<a href='index.html'>volver</a>");
            }
        ?>
        
    </header>
    <div class="row justify-content-center">
	    <main class="col-4">
	    <div class="row justify-content-center">
		    <form class="col-6" id="form1" name="form1" method="post" action="registro.php">
	            <div class="form-group">
	            	<label>Nombre:<input name="campoNombre" type="text"></label>
	            </div>
	            <div class="form-group">
	            	<label>Contrase&ntilde;a:<input name="campoPassword" type="password"></label>
	            </div>
	            <div class="form-group">
	            	<label>Email:<input name="campoEmail" type="email"></label>
	            </div>
		        
		        <input type="submit" class="btn btn-success" name="botonRegistro" value="Registrarse"/>
	        </form>
			</div>
	    </main>
    </div>
    <footer><p>Desarrollado por Ignacio G&oacute;mez</p></footer>
        <script src="./static/js/tether.min.js"></script>
    <script src="./static/js/jquery.min.js"></script>
    <script src="./static/js/bootstrap.js"></script>
</body>

</html>