<?php

$servidor = "localhost"; ///127.0.0.1
$baseDeDatos = "canciones";
$usuario = "root";
$contrasenia = "";

try{
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);//crea la conexion
}catch(PDOException $ex){
    echo "Error: " . $ex->getMessage();
}

?>
