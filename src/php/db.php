<?php
    $cadena_conexion = "mysql:dbname=sorasteam;host=127.0.0.1";
    $usuario = "root";
    $clave = "";
    $errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT];
    $db = new PDO($cadena_conexion, $usuario, $clave, $errmode);
?>