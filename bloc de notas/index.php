<?php
    //LLamado de un archivo pre-creado para mostrar lectura de dicho archivo
    $ruta = "Download.txt";
    $archivo = fopen($ruta, "r");

    //Listando directorios
    $listar = null;
    $ignoreList = array('cgi-bin', '.', '..', '._', 'create.php');
    $dir = opendir('./');

    while($elemento = readdir($dir)){
        if(is_dir("./files/".$elemento)){
            $listar .= "<li><a href='.//$elemento' target'_blank' class='link-dark'>$elemento/</a></li>";
        } else {
            $listar .= "<li><a href='.//$elemento' target'_blank' class='link-dark'>$elemento/</a></li>";
        }
}
?>
<!-- Iniciando el html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="IMG/notas.png" type="image/x-icon">
</head>
<body>
    <div>
        <div>
            <!-- Titulo de la pagina con un icono -->
            <h1 id="titulo_principal">Esto es un Simple Bloc de Notas <i class="bi bi-pencil"></i></h1>
        </div>
        <!-- From para la creacion de archivos -->
        <form action="archivo.php" method="post">
            <div class="m-5">
                <label for="nombre" class=" label_nombre">Nombre Del Archivo</label>
                <input type="text" name="nombre" id="nombre" style="width: 100%;" class="">
            </div>
            <div class="area_textarea">
                <!-- textarea donde se escribira el contenido del archivo -->
                <textarea name="textarea" id="textarea" placeholder="Escriba algo . . ."><?php
                // ciclo que hace la lectura de un archivo previamente creado
                    do{
                        echo fgets($archivo);
                    }while (!feof($archivo));
                    fclose($archivo);
                    ?></textarea>
            </div>
            <div id="area_btn">
                <input type="submit" value="Guardar" name="guardar" id="guardar" class="btn btn-success">
            </div>
        </form>
    </div>
    <hr>
                    <!-- Form de la creacion de dierctorios -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label label_nombre">Creacion de Carpeta</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="nombre_carpeta" placeholder="Nombre de la carpeta">
        </div>
        <div id="area_btn">
            <input type="submit" value="Crear" name="crear" id="crear" class="btn btn-success">
        </div>
    </form>

    <?php
    // PHP para crear direcorios
    if (isset($_POST['crear'])) {
        $nombre_carpeta = $_POST['nombre_carpeta'];

        if (!file_exists($nombre_carpeta)) {
            if (mkdir($nombre_carpeta)) {
                header("Refresh:1");
            } else {
                echo 'No se pudo crear carpeta';
            }
        }else {
            echo 'Carpeta ya existe';
        }
    }

    


    ?>
    <!-- Listando directorios -->
    <div id="archivos">
        <hr>
        <h5>Lista de archivos</h5>
        <hr>
        <ul>
            <?php echo $listar ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>