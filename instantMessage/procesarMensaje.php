<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

session_start();

$con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
mysqli_query($con,"SET NAMES 'utf8'");

if (isset($_POST['tiempo'])){
    $tiempo=$_POST['tiempo'];
    debug.log($tiempo);
    if($tiempo == "nada"){
        $sql="SELECT * FROM mensajes";
        $resultados=mysqli_query($con,$sql) or die(mysql_error());
        
        while ( $fila = mysql_fetch_array($resultados)){
            // Almacenamos en un array  cada una de las filas que vamos leyendo del recordset.
            $datos[]=$fila;
        }
        echo json_encode($datos); // función de PHP que convierte a formato JSON el array.
        
        //mysqli_close($conexion);
    }else{
        $hasta = date("Y-m-d H:i:s");
        $sql="SELECT * FROM mensajes WHERE publicado >= '$tiempo' AND publicado < '$hasta' ORDER BY publicado DESC";
        $resultados=mysql_query($con,$sql) or die(mysql_error());
        
        while ( $fila = mysql_fetch_array($resultados))
        {
            // Almacenamos en un array  cada una de las filas que vamos leyendo del recordset.
            $datos[]=$fila;
        }
        echo json_encode($datos); // función de PHP que convierte a formato JSON el array.
        
    }
}