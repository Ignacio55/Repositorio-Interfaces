<?php
session_start();

session_destroy();
echo("Se le ha expulsado de la aplicacion por falta de actividad");
echo("<a href='index.html'>Volver al inicio</a>");
