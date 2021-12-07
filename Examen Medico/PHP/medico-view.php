<?php
//Vista del medico
//Llamado a la base de datos
include 'conexion.php'; 
session_start();
date_default_timezone_set('America/Caracas');
$fecha = date('d/m/Y h:i:s a');

//Ejecutando llamado a la base de datos
$sql_select_activos = "SELECT * FROM estudio WHERE estado = 'activo';";
$sql_select_activos_ejecutar = mysqli_query($con, $sql_select_activos) or die('Error: ' . mysqli_error($con));
$sql_select_activos_array = mysqli_fetch_array($sql_select_activos_ejecutar);
// $sql_select_activos_num = mysqli_num_rows($sql_select_activos_ejecutar);

//Asignacion de valores
$NP = $sql_select_activos_array['nombre_paciente'];
$AP = $sql_select_activos_array['apellido_paciente'];
$CP = $sql_select_activos_array['cedula_paciente'];
$EP = $sql_select_activos_array['email_paciente'];
$EXP = $sql_select_activos_array['examen'];
$NE = $sql_select_activos_array['nombre_enfermero'];
$AE = $sql_select_activos_array['apellido_enfermero'];
$CE = $sql_select_activos_array['cedula_enfermero'];
$FA = date('d/m/Y h:i:s a',strtotime($sql_select_activos_array['fecha_atencion_enfermero']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDICO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">

</head>
<body>
    <div class="borde col-md-6 col-sm-10 col mx-auto my-5">
        <!-- form donde se indicara los valores de la base de datos -->
        <form class="row g-3" action="medico.php" method="post">
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" placeholder="Nombre Paciente" value="<?php echo $NP ?>" disabled>
                <label for="nombre_paciente">Nombre Paciente</label>
            </div>
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="apellido_paciente" id="apellido_paciente" placeholder="Apellido Paciente" value="<?php echo $AP ?>" disabled>
                <label for="apellido_paciente">Apellido paciente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cedula_paciente" id="cedula_paciente" placeholder="Cedula Paciente" value="<?php echo $CP ?>" disabled>
                <label for="cedula_paciente">Cedula Paciente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="correo_paciente" id="correo_paciente" placeholder="Correo Paciente" value="<?php echo $EP ?>" disabled>
                <label for="correo_paciente">Correo Paciente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="tipo_examen" id="tipo_examen" placeholder="Tipo de Examen" value="<?php echo $EXP ?>" disabled>
                <label for="tipo_examen">Tipo de Examen</label>
            </div>
            <hr class="color">
            <div class="form-floating col-auto w-50">
                <!-- <label for="nombre_enfermero" class="visually-hidden">Email</label> -->
                <input type="text" class="form-control" name="nombre_enfermero" id="nombre_enfermero" placeholder="Nombre Enfermero" value="<?php echo $NE ?>" disabled>
                <label for="nombre_enfermero">Nombre Enfermero</label>
            </div>
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="apellido_enfermero" id="apellido_enfermero" placeholder="Apellido Enfermero" value="<?php echo $AE ?>" disabled>
                <label for="apellido_enfermero">Apellido Enfermero</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cedula_enfermero" id="cedula_enfermero" placeholder="Cedula Enfermero" value="<?php echo $CE ?>" disabled>
                <label for="cedula_enfermero">Cedula Enfermero</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="fecha_atencion_enfermero" id="fecha_atencion_enfermero" placeholder="Fecha de Atencion Enfermero" value="<?php echo date('d/m/Y h:i:s a',strtotime($FA)) ?>" disabled>
                <label for="fecha_atencion_enfermero">Fecha de Atencion (Enfermero)</label>
            </div>
            <hr class="color">
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="nombre_medico" id="nombre_medico" placeholder="Nombre Medico" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                <label for="nombre_medico">Nombre Medico</label>
            </div>
            <div class="form-floating col-auto w-50">
                <input type="text" class="form-control" name="apellido_medico" id="apellido_medico" placeholder="Apellido Medico" value="<?php echo $_SESSION['apellido'] ?>" disabled>
                <label for="apellido_medico">Apellido Medico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cedula_medico" id="cedula_medico" placeholder="Cedula Medico" value="<?php echo $_SESSION['cedula'] ?>" disabled>
                <label for="cedula_medico">Cedula Medico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="fecha_atencion_medico" id="fecha_atencion_medico" placeholder="Fecha de Atencion Medico" value="<?php echo $fecha ?>" disabled>
                <label for="fecha_atencion_medico">Fecha de Atencion al Paciente (Medico)</label>
            </div>
            <div class="mb-3">
                <label for="diagnostico" class="form-label">Diagnostico Medico</label>
                <textarea class="form-control" id="diagnostico" name="diagnostico" rows="20"></textarea>
            </div>
            <!-- Boton de enviar datos -->
            <div class="mb-3">
                <input type="submit" name="guardar" value="Guardar" class="btn btn-primary mb-3 w-100 text-uppercase">
            </div>
        </form>
        <form action="enfermero.php" method="post">
            <div class="mb-3">
                <!-- boton para salir de la cuenta -->
                <input type="submit" name="logout" value="Logout" class="btn btn-danger mb-3 w-100 text-uppercase">
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>