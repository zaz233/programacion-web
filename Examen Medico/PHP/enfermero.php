<?php
//LLamado a la base de datos
include 'conexion.php';
date_default_timezone_set('America/Caracas');
$fecha = date('d/m/Y h:i:s a');
session_start();
//Verificacion de entrada
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

        if (isset($_POST['nombre_paciente']) && !empty($_POST['nombre_paciente']) && isset($_POST['apellido_paciente']) && !empty($_POST['apellido_paciente']) && isset($_POST['cedula_paciente']) && !empty($_POST['cedula_paciente']) && isset($_POST['correo_paciente']) && !empty($_POST['correo_paciente']) && isset($_POST['opcion']) && !empty($_POST['opcion'])) {
        
            //guardado de variables
            $nombre_enfermero = $_SESSION['nombre'];
            $apellido_enfermero = $_SESSION['apellido'];
            $cedula_enfermero = $_SESSION['cedula'];
            $fecha_atencion = date('Y-m-d H:i:s',strtotime($fecha));
    
            $nombre_paciente = ucfirst(strtolower($_POST['nombre_paciente']));
            $apellido_paciente = ucfirst(strtolower($_POST['apellido_paciente']));
            $cedula_paciente = intval($_POST['cedula_paciente']);
            $email_paciente = $_POST['correo_paciente'];
            $examen = $_POST['opcion'];

            $estado = 'Activo';
    
            $patron_letras = "/^[a-zA-ZñáéíóúÁÉÍÓÚ]+$/";
            $patron_numeros = "/^[0-9]+$/";

            // Validaciones de datos
            if (preg_match($patron_letras, $nombre_paciente)) {
                if (preg_match($patron_letras, $apellido_paciente)) {
                    if (preg_match($patron_numeros, $cedula_paciente) && strlen($cedula_paciente) == 8 || strlen($cedula_paciente) == 7) {
                        if (filter_var($email_paciente, FILTER_VALIDATE_EMAIL)) {
                            if (!($examen == "")) {
                                
                                //ejecutando sentencia sql
                                $sql_insert = "INSERT INTO estudio (nombre_paciente, apellido_paciente, cedula_paciente, email_paciente, examen, nombre_enfermero, apellido_enfermero, cedula_enfermero, fecha_atencion_enfermero, estado) VALUES ('$nombre_paciente', '$apellido_paciente', '$cedula_paciente', '$email_paciente', '$examen', '$nombre_enfermero' , '$apellido_enfermero' , '$cedula_enfermero' , '$fecha_atencion' , '$estado');";
                                $sql_insert_ejecutar = mysqli_query($con, $sql_insert) or die("Error:" . mysqli_error($con));
    
                                unset($nombre_paciente);
                                unset($apellido_paciente);
                                unset($cedula_paciente);
                                unset($email);
                                unset($email_paciente);
                                unset($examen);

                                //redireccionando a vista del enefermero
                                header("location:enfermero-view.php");
    
                            } else {
                                echo 'Eliga un rango';
                                header("refresh:5; enfermero-view.php");
                            }
                            
                        } else {
                            echo 'Correo Invalido';
                            header("refresh:5; enfermero-view.php");
                        }
                        
                    } else {
                        echo 'Cedula Invalida';
                        header("refresh:5; enfermero-view.php");
                    }
                    
                } else {
                    echo 'Apellido Invalido';
                    header("refresh:5; enfermero-view.php");
                }
                
            } else {
                echo 'Nombre Invalido';
                header("refresh:5; enfermero-view.php");
            }
            
    
        } else {
            echo 'Deben rellenarce todos los campos';
            header("refresh:5; enfermero-view.php");
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