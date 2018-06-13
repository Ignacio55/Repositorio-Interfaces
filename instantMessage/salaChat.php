<?php
session_start();

if (isset($_POST['estado'])){
    echo("HE LLEGADO");
    if($_POST['estado']=="abrir"){
        $user = $_SESSION['id'];
        $sala = $_POST['sala'];
        $con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
        $ssql="SELECT * FROM mensajes WHERE sala='$sala' ORDER BY publicado ASC LIMIT 50";
        $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
        
        if(mysqli_num_rows($result)){
            echo(mysqli_num_rows($result));
            while($reg=mysqli_fetch_array($result)){
                if($reg['usuario']==$user){
                    $reg['tipo']="propio";
                    
                    //$mensaje="<p class='propio'>".$reg['usuario']."(".$reg['publicado']."):".$reg['texto']."</p>";
                }else{
                    $reg['tipo']="ajeno";
                    
                    //$mensaje="<p class='ajeno'>".$reg['usuario']."(".$reg['publicado']."):".$reg['texto']."</p>";
                }
            }
        }
    }else if($_POST['estado']=="actualizar"){
        $sala = $_POST['sala'];
        $tnto=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
        $desde = date("Y-m-d H:i:s", $tnto-1);
        $hasta = date("Y-m-d H:i:s", $tnto);
        $con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
        $ssql="SELECT * FROM mensajes WHERE sala='$sala' AND publicado >= '$desde' AND publicado < '$hasta' ORDER BY publicado ASC LIMIT 50";
        $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
        
        if(mysqli_num_rows($result)){
            while($reg=mysqli_fetch_array($result)){
                if($reg['usuario']==$user){
                    $reg['tipo']="propio";
                    //$mensaje="<p class='propio'>".$reg['usuario']."(".$reg['publicado']."):".$reg['texto']."</p>";
                }else{
                    $reg['tipo']="ajeno";
                    //$mensaje="<p class='ajeno'>".$reg['usuario']."(".$reg['publicado']."):".$reg['texto']."</p>";
                }
            }
        }
    }
    /*$user = $_SESSION['id'];
    
    $sala =  $_POST['sala'];
    $mensaje= $_POST['mensaje'];
    
    echo  $_SESSION['user'];*/
}

if (isset($_POST['sala'])){
    if($_POST['mensaje']!=""){
        $user = $_SESSION['id'];
        $fecha = date("Y-m-d H:i:s");
        $sala =  $_POST['sala'];
        $mensaje= $_POST['mensaje'];
        $con = mysqli_connect("localhost:3306","administrador","123Daw$321","instantMessage") or die("No se pudo conectar");
        $ssql="INSERT INTO mensajes VALUES (NULL, $user, '$mensaje', '$fecha', $sala);";
        $result = mysqli_query($con, $ssql) or die ( "Algo ha ido mal en la consulta a la base de datos");
    }
}
