<?php 
//Declarando valores de conexion
$nombre_servidor = "localhost";
$usuario = "root";
$contra = "";
$base_datos = "examen_medico";

//Abriendo la conexion con la base de datos
$con = mysqli_connect($nombre_servidor, $usuario, $contra, $base_datos);

//Comprovando la conexion con la base de datos
if (!$con) {
    die("Conexión fallida" . mysqli_connect_error());
} 
    // echo "Conexión Exitosa";

?>