<?php
//Vista del enfermero
include 'conexion.php';
session_start();
date_default_timezone_set('America/Caracas');
$fecha = date('d/m/Y h:i:s a');
//validacion de entrada
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
    <title>ENFERMERO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">

</head>
<body>
    <div class="borde col-md-6 col-sm-10 col mx-auto my-5">
        <form class="row g-3" action="enfermero.php" method="post">
            <!-- Form del enfermero -->
            <div class="form-floating col-auto w-50">
                <!-- <label for="nombre_enfermero" class="visually-hidden">Email</label> -->
                <input type="text" class="form-control" name="nombre_enfermero" id="nombre_enfermero" placeholder="Nombre Enfermero" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                <label for="nombre_enfermero">Nombre Enfermero</label>
            </div>
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="apellido_enfermero" id="apellido_enfermero" placeholder="Apellido Enfermero" value="<?php echo $_SESSION['apellido'] ?>" disabled>
                <label for="apellido_enfermero">Apellido Enfermero</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cedula_enfermero" id="cedula_enfermero" placeholder="Cedula Enfermero" value="<?php echo $_SESSION['cedula'] ?>" disabled>
                <label for="cedula_enfermero">Cedula Enfermero</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="fecha_atencion" id="fecha_atencion" placeholder="Fecha de Atencion" value="<?php echo $fecha ?>" disabled>
                <label for="fecha_atencion">Fecha de Atencion al Paciente</label>
            </div>
            <hr class="color">
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" placeholder="Nombre Paciente" required>
                <label for="nombre_paciente">Nombre Paciente</label>
            </div>
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="apellido_paciente" id="apellido_paciente" placeholder="Apellido Paciente" required>
                <label for="apellido_paciente">Apellido paciente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cedula_paciente" id="cedula_paciente" placeholder="Cedula Paciente" required>
                <label for="cedula_paciente">Cedula Paciente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="correo_paciente" id="correo_paciente" placeholder="Correo Paciente" required>
                <label for="correo_paciente">Correo Paciente</label>
            </div>
            <div class="mb-3">
                <!-- Seleccionador de examenes medics -->
                <select name="opcion" id="opcion" class="form-control" required>
                    <option value="">--Tipo de Examen Medico--</option>
                    <option value="Hemograma">Hemograma</option>
                    <option value="Urinálisis">Urinalisis</option>
                    <option value="Heces">Heces</option>
                    <option value="Perfil renal">Perfil renal</option>
                    <option value="Perfil lipídico">Perfil lipidico</option>
                    <option value="Perfil hepático">Perfil hepatico</option>
                    <option value="Perfil triode">Perfil triode</option>
                    <option value="Biopsia">Biopsia</option>
                    <option value="Panel basico metabalico">Panel basico metabolico</option>
                    <option value="Glucosa">Glucosa</option>
                </select>
            </div>
            <div class="mb-3">
                <!-- boton enviar -->
                <input type="submit" name="guardar" value="Guardar" class="btn btn-primary mb-3 w-100 text-uppercase">
            </div>
        </form>
        <form action="enfermero.php" method="post">
            <div class="mb-3">
                <!-- boton de salir -->
                <input type="submit" name="logout" value="Logout" class="btn btn-danger mb-3 w-100 text-uppercase">
            </div>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>