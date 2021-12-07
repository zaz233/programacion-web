<?php
//Login de la pagina
//llamado a la base de datos
include 'conexion.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
<div class="container login-container">
            <div class="row">
                <div class="col"></div>
                <div class="col-6 login-form-1">
                    <!-- Formulario del login -->
                    <h3>Login de Empleados</h3>
                    <form action="" method="post">
                        <div class="form-group margenes">
                            <input type="text" class="form-control" placeholder="-- Correo --" name="correo" required/>
                        </div>
                        <div class="form-group margenes">
                            <input type="password" class="form-control" placeholder="-- Contraseña --" name="contra" required/>
                        </div>
                        <div class="form-group">
                            <!-- botn para verificar datos -->
                            <input type="submit" class="btnSubmit" value="Login" name="login"/>
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>

<?php
//Validaciones requeridas
    if (isset($_POST['login']) && $_POST['login'] == 'Login') {
        if (isset($_POST['correo']) && isset($_POST['contra']) && !empty($_POST['correo']) && !empty($_POST['contra'])) {
            session_start();
            $correo = $_POST['correo'];
            $contra = md5($_POST['contra']);

            //ejecuntando sentencia sql para verificar existencia
            $sql_select_login = "SELECT * FROM empleados WHERE correo='$correo' AND contra='$contra';";
            $sql_select_login_ejecutar = mysqli_query($con, $sql_select_login) or die('Error: ' . mysqli_error($con));
            $sql_select_login_array = mysqli_fetch_array($sql_select_login_ejecutar);
            $sql_select_login_num = mysqli_num_rows($sql_select_login_ejecutar);

            //If validando existencia
            if ($sql_select_login_num > 0) {
                //Creacion de variables de sesion
                $_SESSION['id'] = $sql_select_login_array['id'];
                $_SESSION['nombre'] = $sql_select_login_array['nombre'];
                $_SESSION['apellido'] = $sql_select_login_array['apellido'];
                $_SESSION['cedula'] = $sql_select_login_array['cedula'];
                $_SESSION['rango'] = $sql_select_login_array['rango'];

                //Redireccionamiento
                if ($_SESSION['rango'] == 'administrador') {
                    header('location:administrador.php');
                } elseif ($_SESSION['rango'] == 'Enfermero') {
                    header('location:enfermero-view.php');
                } elseif ($_SESSION['rango'] == 'Medico') {
                    header('location:medico-view.php');
                } else {
                    echo 'Algo salio mal con el rango';
                }
                
                
            } else {
                echo 'Usted no esta registrado';
            }
        } else {
            echo 'Los dos campos son requeridos';
            session_destroy();
        }
        
    }

?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>   
</body>
</html>