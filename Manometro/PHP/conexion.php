<?php
//Declarando valores de conexion
$nombre_servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "manometro";

//Abriendo la conexion con la base de datos
$con = mysqli_connect($nombre_servidor, $usuario, $contraseña, $base_datos);

//Comprovando la conexion con la base de datos
if (!$con) {
    die("Conexión fallida" . mysqli_connect_error());
} 
    // echo "Conexión Exitosa";




?>