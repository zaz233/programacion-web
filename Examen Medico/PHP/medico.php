<?php
//Llamado a laconexion y al creador de Email
include 'conexion.php';
require '../email.php';

//validacion de entrada
date_default_timezone_set('America/Caracas');
session_start();
if (isset($_SESSION['id'])) {
    $ID = $_SESSION['id'];
    $sql_select_comprobar = "SELECT * FROM empleados WHERE id = '$ID';";
    $sql_select_comprobar_ejecutar = mysqli_query($con, $sql_select_comprobar) or die('Erro: ' . mysqli_error($con));
    $sql_select_comprobar_contar = mysqli_num_rows($sql_select_comprobar_ejecutar);

    if ($sql_select_comprobar_contar <= 0) {
        header('location:login.php');
    }

} else {
    header('location:login.php');
}

//Validaciones requeridas
if (isset($_POST['guardar']) && $_POST['guardar'] == 'Guardar') {

    // if (isset($_POST['nombre_enfermero']) && !empty($_POST['nombre_enfermero']) && isset($_POST['apellido_enfermero']) && !empty($_POST['apellido_enfermero']) && isset($_POST['cedula_enfermero']) && !empty($_POST['cedula_enfermero'])) {

        if (isset($_POST['diagnostico']) && !empty($_POST['diagnostico'])) {
        
            $nombre_medico = $_SESSION['nombre'];
            $apellido_medico = $_SESSION['apellido'];
            $cedula_medico = $_SESSION['cedula'];

            $fecha_atencion_medico = date('Y-m-d H:i:s');

            //Ejecutando sentencia SQL
            $sql_select_activos = "SELECT * FROM estudio WHERE estado = 'Activo';";
            $sql_select_activos_ejecutar = mysqli_query($con, $sql_select_activos) or die('Error: ' . mysqli_error($con));
            $sql_select_activos_array = mysqli_fetch_array($sql_select_activos_ejecutar);
            // $sql_select_activos_num = mysqli_num_rows($sql_select_activos_ejecutar);

            //Toma de datos para poder actualizar posteriormente
            $ID = $sql_select_activos_array['id'];

            $diagnostico = $_POST['diagnostico'];
            $estado = 'Realizado';
            $estado_medico='Enviar';

            //Actualizacion de datos de la tabla estudio
            $sql_update = "UPDATE estudio SET nombre_medico = '$nombre_medico', apellido_medico = '$apellido_medico', cedula_medico = '$cedula_medico', fecha_atencion_medico = '$fecha_atencion_medico', diagnostico = '$diagnostico',estado = '$estado' , estado_medico = '$estado_medico' WHERE id = '$ID';";
            $sql_update_ejecutar = mysqli_query($con, $sql_update) or die("Error:" . mysqli_error($con));
    
            // echo ($nombre_medico);
            // echo ($apellido_medico);
            // echo ($cedula_medico);
            // echo ($fecha_atencion_medico);
            // echo ($ID);
            // echo ($diagnostico);
            // echo ($estado);

            unset($nombre_medico);
            unset($apellido_medico);
            unset($cedula_medico);
            unset($fecha_atencion_medico);
            unset($id);
            unset($diagnostico);
            unset($estado);

            
            //Direccionando al creador de Email
            header("location:../email.php");
    
            
    
        } else {
            //Validando
            echo 'Deben rellenarce el diagnostico';
            header("refresh:5; medico-view.php");
        }
    // } else {
    //     // unset($nombre_enfermero);
    //     // unset($apellido_enfermero);
    //     // unset($cedula_enfermero);
    //     // unset($fecha_atencion);
                        
    //     // unset($nombre_paciente);
    //     // unset($apellido_paciente);
    //     // unset($cedula_paciente);
    //     // unset($email_paciente);
    //     // unset($examen);
    //     // session_destroy();
    //     // header('Location: login.php');
    //     echo 'problema con las sesion';
    // }
    
    
}

if (isset($_POST['logout']) && $_POST['logout'] == 'Logout') {
    session_destroy();
    header('location:login.php');
}
?>