<?php
include 'PHP/conexion.php';
//Pide el dia actual en formato YYYY-MM-DD para colocarlo como limite maximo en el type="date"
date_default_timezone_set('America/Caracas');
$limite_maximo = date('Y-m-d\TH:i');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manometro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="IMG/icono.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stilos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <h1 class="titulo">Mamometro Petrolero <i class="fas fa-oil-can"></i></h1>
    <form action="" method="post">
        <div class="contenedor_form">
            <div class="form-floating mb-3">
                <input type="number" name="pozo" class="form-control" id="floatingInput" placeholder="00">
                <label for="floatingInput">Pozo Petrolero </label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="presion" class="form-control" id="floatingInput" placeholder="00.0">
                <label for="floatingInput">Presión Manométrica</label>
            </div>
            <div>
                <!-- El primer pozo petrolero que existio fue hecho en Estados Unidos el 27 de agosto de 1859 por lo cual es su limite minimo en la fecha -->
                <!-- Y ademas como limite maximo no debe pasar del dia actual existente -->
                <input type="datetime-local" id="fecha" name="fecha" class="fecha" min="1859-08-27T00:00" max="<?php echo $limite_maximo ?>">
            </div>
            <div class="marco_btn">
                <input type="submit" value="Guardar" name="guardar" class="btn btn-secondary">
            </div>
        </div>
    </form>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="contenedor_form">
            <select class="form-select" aria-label="Default select example" name="ver_pozo">
                <option selected>--Seleccione una Opción--</option>
                <?php
                
                $consulta = "SELECT DISTINCT pozo FROM mediciones ORDER BY pozo ASC";

                if ($resultado = $con->query($consulta)) {

                    /* obtener un array asociativo */
                    while ($fila = $resultado->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $fila["pozo"]; ?>"><?php echo $fila["pozo"]; ?></option>
                        <?php
                    }

                    /* liberar el conjunto de resultados */
                    $resultado->free();
                }
                ?>
            </select>
            <div class="marco_btn">
                <input type="submit" value="Ver" name="ver" class="btn btn-secondary">
            </div>
            <label for="">En caso de que el pozo no aparezca en la opciones refresque la pagina</label>
        </div>
    </form>
    <?php
    
    if (isset($_POST['guardar']) && isset($_POST['guardar']) == 'Guardar') {
        $pozo = $_POST['pozo'];
        $presion = $_POST['presion'];
        $fecha = $_POST['fecha'] . ':00';

        $valores = explode('-', $fecha);
        $patron_decimal = "(^[0-9]{1,3}$|^[0-9]{1,3}\.[0-9]{1,3}$)";
        $patron_entero = '/^[0-9]*$/';

        $sql_select = "SELECT * FROM mediciones WHERE pozo='$pozo' AND fecha='$fecha';";
        $ejecucuion_sql_select = mysqli_query($con, $sql_select) or die('Error: ' . mysqli_error($con));
        $contador_sql_select = mysqli_num_rows($ejecucuion_sql_select);
        // echo $contador_sql_select;

        if ($contador_sql_select == 0) {
            // -------------------------EVALUAR SI ES BUENA IDEA OMITIR O ACTUALIZAR-------------------------//
            // echo $contador_sql_select;
                // Validando que los datos ingresados sean correctos para el Pozo petrolero que es un int
            if (preg_match($patron_entero, $pozo)) {
                // echo 'vas super bien con los enteros';
                // echo $pozo;
                // transformando string en int
                $pozo = intval($pozo);

                // Validando que los datos ingresados sean correctos para La Presion manometrica que es un float
                if (preg_match($patron_decimal, $presion)) {
                            // echo 'vas super bien con los decimales';
                            // echo $presion;
                    // transformando string en float
                    $presion = floatval($presion);

                    //Validando que el dato resivido sea un int y que no resivio algun caracter especial
                    if (is_int($pozo) && ($pozo > 0)) {
                        // echo 'Vas bien con pozo <br>';
                        // echo $pozo . '<br>';

                        //Validando que el dato resivido sea un float y que no resivio algun caracter especial
                        if (is_float($presion) == true && ($presion > 0)) {
                            // echo 'Vas bien con presion <br>';
                            // echo $presion . '<br>';

                            
                                $sql_insert = "INSERT INTO mediciones (pozo, presion, fecha) VALUES ('$pozo', '$presion', '$fecha');";
                                $resultado = mysqli_query($con, $sql_insert) or die("Error: " . mysqli_error($con));
                                header("Refresh:0");

                        //En caso de que la Presion no tenga los datos adecuados
                        }else {
                            echo 'Medicion manometrica erronea';
                            // echo $presion . '<br>';
                        }

                    //En caso de que El Pozo no tenga los datos adecuados
                    } else {
                        echo 'Numero de pozo invalido <br>';
                        // echo $pozo . '<br>';
                    }

                //En caso de que los datos de la Precion sean incorrectos
                } else {
                    echo 'Dato Erroneo en Presion';
                }
            //En caso de que los datos del Pozo sean incorrectos
            } else {
                echo 'Dato Erroneo en Pozo';
            }
        } else {
            echo "La medicion para el pozo $pozo en la fecha $fecha ya fue registrada";
        }
    }

    if(isset($_POST['ver']) && $_POST['ver'] == "Ver"){
        $ver_pozo = $_POST["ver_pozo"];
        ?>
        <div class="grafica">
        <canvas id="myChart" width="100%" height="50px"></canvas>
    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                    $sql_select_grafica_fecha = "SELECT fecha FROM mediciones WHERE pozo = '$ver_pozo' ORDER BY fecha ASC;";

                    if ($resul = $con->query($sql_select_grafica_fecha)) {
                    
                        /* obtener un array asociativo */
                        while ($datos = $resul->fetch_assoc()) {
                            $timestamp = strtotime($datos["fecha"]);
                            $nueva_fecha = date('d/m/Y H:i:s', $timestamp);
                    ?>
                            '<?php echo $nueva_fecha ?>',
                    <?php
                        }
                    
                        /* liberar el conjunto de resultados */
                        $resul->free();
                    }
                ?>
        ],
            datasets: [{
                label: 'Precion Manometrica',
                data: [<?php
                    $sql_select_grafica_fecha = "SELECT presion FROM mediciones WHERE pozo = '$ver_pozo' ORDER BY fecha ASC;";

                    if ($resul = $con->query($sql_select_grafica_fecha)) {
                    
                        /* obtener un array asociativo */
                        while ($datos = $resul->fetch_assoc()) {
                    ?>
                            '<?php echo $datos["presion"] ?>',
                    <?php
                        }
                    
                        /* liberar el conjunto de resultados */
                        $resul->free();
                    }
                ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    </div>
        <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php
    mysqli_close($con);
    ?>
</body>
</html>