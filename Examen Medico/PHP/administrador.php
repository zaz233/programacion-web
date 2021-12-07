<?php
//llamado a la base de datos
require 'conexion.php';
session_start();
// verificacicon de entrada
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR - REGISTRO DE EMPLEADOS</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
<div class="container login-container">
    <!-- Formulario de registro del administrado -->
            <div class="row">
                <div class="col"></div>
                <div class="col-6 login-form-1">
                    <h3>Registro de Empleados</h3>
                    <form action="" method="post">
                        <div class="form-group margenes">
                            <input type="text" class="form-control" placeholder="Nombre" name="Nombre" required>
                        </div>
                        <div class="form-group margenes">
                            <input type="text" class="form-control" placeholder="Apellido" name="Apellido" required>
                        </div>
                        <div class="form-group margenes">
                            <input type="text" class="form-control" placeholder="Cedula" name="Cedula" required>
                        </div>
                        <div class="form-group margenes">
                            <input type="email" class="form-control" placeholder="Correo" name="Correo" required>
                        </div>
                        <div class="form-group margenes">
                            <input type="password" class="form-control" placeholder="Contraseña" name="Contra" required>
                        </div>
                        <div class="form-group margenes">
                            <select name="opcion" id="opcion" class="form-control">
                                <option value="">Selecione una opcion</option>
                                <option value="Medico">Medico</option>
                                <option value="Enfermero">Enfermero</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" name="login">
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>

    <?php
    //Verificaciones requeridas
    if (isset($_POST['login']) && $_POST['login'] == 'Login') {
        if (isset($_POST['Nombre']) && !empty($_POST['Nombre']) && isset($_POST['Apellido']) && !empty($_POST['Apellido']) && isset($_POST['Cedula']) && !empty($_POST['Cedula']) && isset($_POST['Correo']) && !empty($_POST['Correo']) && isset($_POST['Contra']) && !empty($_POST['Contra'])) {
            
            //Declaracion de variables
            $nombre = ucfirst(strtolower($_POST['Nombre']));
            $apellido = ucfirst(strtolower($_POST['Apellido']));
            $cedula = intval($_POST['Cedula']);
            $email = $_POST['Correo'];
            $contra = md5($_POST['Contra']);
            $rango = $_POST['opcion'];

            $patron_letras = "/^[a-zA-ZñáéíóúÁÉÍÓÚ]+$/";
            $patron_numeros = "/^[0-9]+$/";

            // Validaciones de campos
            if (preg_match($patron_letras, $nombre)) {
                if (preg_match($patron_letras, $apellido)) {
                    if (preg_match($patron_numeros, $cedula) && strlen($cedula) == 8 || strlen($cedula) == 7) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if (!($rango == "")) {
                                //Ejecucion del sql para validar que no exista dicho usuario
                                $sql_select_registro = "SELECT * FROM empleados WHERE cedula = '$cedula' ;";
                                $sql_select_registro_ejecutar = mysqli_query($con, $sql_select_registro) or die('Error: ' . mysqli_error());
                                $sql_select_registro_contar = mysqli_num_rows($sql_select_registro_ejecutar);

                                echo $sql_select_registro_contar;

                                if ($sql_select_registro_contar > 0) {
                                    echo 'Este usuario ya existe';
                                } else {
                                    //Ejecucuion del sql para registrar usuario
                                    $sql_insert = "INSERT INTO empleados (nombre, apellido, cedula, correo, contra, rango) VALUES ('$nombre', '$apellido', '$cedula', '$email', '$contra', '$rango');";
                                    $sql_insert_ejecutar = mysqli_query($con, $sql_insert) or die("Error:" . mysqli_error());

                                    unset($nombre);
                                    unset($apellido);
                                    unset($cedula);
                                    unset($email);
                                    unset($contra);
                                    unset($rango);

                                    header("Refresh:0");
                                }
                                

                            } else {
                                echo 'Eliga un rango';
                            }
                            
                        } else {
                            echo 'Correo Invalido';
                        }
                        
                    } else {
                        echo 'Cedula Invalida';
                    }
                    
                } else {
                    echo 'Apellido Invalido';
                }
                
            } else {
                echo 'Nombre Invalido';
            }
            

        } else {
            echo 'Deben rellenarce todos los campos';
        }
        
    }
    
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>   
</body>
</html>