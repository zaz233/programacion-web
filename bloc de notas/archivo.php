<?php
$ruta = "Download.txt";
if (isset($_POST['guardar'])) {
    $texto = $_POST['textarea'];
    $archivo = fopen($ruta, 'w');
    fwrite($archivo, $texto);

    $archivo_ruta = './'.$ruta;

    if(file_exists($archivo_ruta)){
        $nombre_archivo = basename($ruta);
        $medida_archivo = filesize($archivo_ruta);

        //Output headers.
        header('Cache-Control: private');
        header('Content-Type: application/stream');
        header("Content-Length: ".$medida_archivo);
        header("Content-Disposition: attachment; filename=".$nombre_archivo);
        // Output file.
        readfile ($archivo_ruta);                   

        }
    else {
        die('Algo salio mal');
    }
}
?>