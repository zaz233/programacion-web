<?php
    $empleado_1 = array(
        'Nombre' => null ,
        'Apellido' => null ,
        'Cedula' => null ,
        'Sueldo' => null ,
        'Departamento' => null ,
        'Trabajo' => null
    );
    $empleado_2 = array(
        'Nombre' => null ,
        'Apellido' => null ,
        'Cedula' => null ,
        'Sueldo' => null ,
        'Departamento' => null ,
        'Trabajo' => null
    );
    $empleado_3 = array(
        'Nombre' => null ,
        'Apellido' => null ,
        'Cedula' => null ,
        'Sueldo' => null ,
        'Departamento' => null ,
        'Trabajo' => null
    );
    
    function comp_texto($texto){
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/";
        if (preg_match($patron_texto, $texto)) {
            return true;
        } else {
            return false;
        }
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa de Arreglos Asociativos</title>
</head>
<body>
    <h1 align="center">Programa de Arreglos Asociativos</h1>
    <br><br>
    <?php
        
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div style="
    float: left;
    margin: 0 5.6%;
    ">
            <table border="1" align="center">
                <tr>
                    <td><label for="nombre1">Nombre: </label></td>
                    <td><input type="text" name="nombre1" id="nombre" placeholder="Ingrese Nombre..." required></td>
                </tr>
                <tr>
                    <td><label for="apellido1">Apellido: </label></td>
                    <td><input type="text" name="apellido1" id="apellido" placeholder="Ingrese Apellido..." required></td>
                </tr>
                <tr>
                    <td><label for="cedula1">Cedula: </label></td>
                    <td><input type="number" name="cedula1" id="cedula" placeholder="Ingrese Cedula..." required></td>
                </tr>
                <tr>
                    <td><label for="sueldo1">Sueldo: </label></td>
                    <td><input type="number" name="sueldo1" id="sueldo" placeholder="Ingrese Sueldo..." required></td>
                </tr
                ><tr>
                    <td><label for="departamento1">Departamento: </label></td>
                    <td><input type="text" name="departamento1" id="departamento" placeholder="Ingrese Departamento..." required></td>
                </tr>
                <tr>
                    <td><label for="trabajo1">Trabajo: </label></td>
                    <td><input type="text" name="trabajo1" id="trabajo" placeholder="Ingrese Trabajo..." required></td>
                </tr>
            </table>
        </div>
        <div style="
    float: left;
    margin: 0 5.6%;
    ">
            <table border="1" align="center">
                <tr>
                    <td><label for="nombre2">Nombre: </label></td>
                    <td><input type="text" name="nombre2" id="nombre" placeholder="Ingrese Nombre..." required></td>
                </tr>
                <tr>
                    <td><label for="apellido2">Apellido: </label></td>
                    <td><input type="text" name="apellido2" id="apellido" placeholder="Ingrese Apellido..." required></td>
                </tr>
                <tr>
                    <td><label for="cedula2">Cedula: </label></td>
                    <td><input type="number" name="cedula2" id="cedula" placeholder="Ingrese Cedula..." required></td>
                </tr>
                <tr>
                    <td><label for="sueldo2">Sueldo: </label></td>
                    <td><input type="number" name="sueldo2" id="sueldo" placeholder="Ingrese Sueldo..." required></td>
                </tr
                ><tr>
                    <td><label for="departamento2">Departamento: </label></td>
                    <td><input type="text" name="departamento2" id="departamento" placeholder="Ingrese Departamento..." required></td>
                </tr>
                <tr>
                    <td><label for="trabajo2">Trabajo: </label></td>
                    <td><input type="text" name="trabajo2" id="trabajo" placeholder="Ingrese Trabajo..." required></td>
                </tr>
            </table>
        </div>
        <div style="
    float: left;
    margin: 0 5.6%;
    ">
            <table border="1" align="center">
                <tr>
                    <td><label for="nombre3">Nombre: </label></td>
                    <td><input type="text" name="nombre3" id="nombre" placeholder="Ingrese Nombre..." required></td>
                </tr>
                <tr>
                    <td><label for="apellido3">Apellido: </label></td>
                    <td><input type="text" name="apellido3" id="apellido" placeholder="Ingrese Apellido..." required></td>
                </tr>
                <tr>
                    <td><label for="cedula3">Cedula: </label></td>
                    <td><input type="number" name="cedula3" id="cedula" placeholder="Ingrese Cedula..." required></td>
                </tr>
                <tr>
                    <td><label for="sueldo3">Sueldo: </label></td>
                    <td><input type="number" name="sueldo3" id="sueldo" placeholder="Ingrese Sueldo..." required></td>
                </tr
                ><tr>
                    <td><label for="departamento3">Departamento: </label></td>
                    <td><input type="text" name="departamento3" id="departamento" placeholder="Ingrese Departamento..." required></td>
                </tr>
                <tr>
                    <td><label for="trabajo3">Trabajo: </label></td>
                    <td><input type="text" name="trabajo3" id="trabajo" placeholder="Ingrese Trabajo..." required></td>
                </tr>
            </table>
        </div>
        <div align="center">
            <br><br>
            <input type="submit" name="btn" value="Guardar">
            <input type="reset" name="btn" value="Limpiar">
        </div>
    </form>
    <?php
    if (isset($_POST['btn']) && $_POST['btn'] == 'Guardar') {
        if (isset($_POST['nombre1']) && !empty($_POST['nombre1']) && isset($_POST['apellido1']) && !empty($_POST['apellido1']) && isset($_POST['cedula1']) && !empty($_POST['cedula1']) && isset($_POST['sueldo1']) && !empty($_POST['sueldo1']) && isset($_POST['departamento1']) && !empty($_POST['departamento1']) && isset($_POST['trabajo1']) && !empty($_POST['trabajo1']) && isset($_POST['nombre2']) && !empty($_POST['nombre2']) && isset($_POST['apellido2']) && !empty($_POST['apellido2']) && isset($_POST['cedula2']) && !empty($_POST['cedula2']) && isset($_POST['sueldo2']) && !empty($_POST['sueldo2']) && isset($_POST['departamento2']) && !empty($_POST['departamento2']) && isset($_POST['trabajo2']) && !empty($_POST['trabajo2']) && isset($_POST['nombre3']) && !empty($_POST['nombre3']) && isset($_POST['apellido3']) && !empty($_POST['apellido3']) && isset($_POST['cedula3']) && !empty($_POST['cedula3']) && isset($_POST['sueldo3']) && !empty($_POST['sueldo3']) && isset($_POST['departamento3']) && !empty($_POST['departamento3']) && isset($_POST['trabajo3']) && !empty($_POST['trabajo3'])) {
            if (comp_texto($_POST['nombre1']) == true && comp_texto($_POST['apellido1']) == true && comp_texto($_POST['trabajo1']) == true) {
                $_POST['cedula1'] = number_format($_POST['cedula1'],0,'',".");
                $_POST['cedula2'] = number_format($_POST['cedula2'],0,'',".");
                $_POST['cedula3'] = number_format($_POST['cedula3'],0,'',".");
                $empleado_1 = array(
                    'Nombre' => $_POST['nombre1'] ,
                    'Apellido' => $_POST['apellido1'] ,
                    'Cedula' => $_POST['cedula1'] ,
                    'Sueldo' => $_POST['sueldo1'] ,
                    'Departamento' => $_POST['departamento1'] ,
                    'Trabajo' => $_POST['trabajo1']
                );
                ?>
                <br>
                <br>
                <div>
                    <table align="center" border="1">
                            <?php
                                foreach ($empleado_1 as $clave => $valor) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $clave;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $valor;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                    </table>
                </div>
                    <?php
                $empleado_2 = array(
                    'Nombre' => $_POST['nombre2'] ,
                    'Apellido' => $_POST['apellido2'] ,
                    'Cedula' => $_POST['cedula2'] ,
                    'Sueldo' => $_POST['sueldo2'] ,
                    'Departamento' => $_POST['departamento2'] ,
                    'Trabajo' => $_POST['trabajo2']
                );
                ?>
                <div>
                    <br><br>
                <table align="center" border="1">
                        <?php
                            foreach ($empleado_2 as $clave => $valor) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo $clave;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $valor;
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </table>
                    </div>
                    <?php
                    $empleado_3 = array(
                        'Nombre' => $_POST['nombre3'] ,
                        'Apellido' => $_POST['apellido3'] ,
                        'Cedula' => $_POST['cedula3'] ,
                        'Sueldo' => $_POST['sueldo3'] ,
                        'Departamento' => $_POST['departamento3'] ,
                        'Trabajo' => $_POST['trabajo3']
                    );
                    ?>
                    <div>
                        <br><br>
                    <table align="center" border="1">
                            <?php
                                foreach ($empleado_3 as $clave => $valor) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $clave;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $valor;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </table>
                        </div>
                        <?php
            } else {
                if (comp_texto($_POST['nombre1']) == false) {
                    echo '<br>';
                    echo 'Error en nombre del formulario 1';
                } 
                if (comp_texto($_POST['apellido1']) == false) {
                    echo '<br>';
                    echo 'Error en apellido del formulario 1';
                }
                if (comp_texto($_POST['trabajo1']) == false) {
                    echo '<br>';
                    echo 'Error en trabajo del formulario 1';
                }
                if (comp_texto($_POST['nombre2']) == false) {
                    echo '<br>';
                    echo 'Error en nombre del formulario 2';
                } 
                if (comp_texto($_POST['apellido2']) == false) {
                    echo '<br>';
                    echo 'Error en apellido del formulario 2';
                }
                if (comp_texto($_POST['trabajo2']) == false) {
                    echo '<br>';
                    echo 'Error en trabajo del formulario 2';
                }
                if (comp_texto($_POST['nombre3']) == false) {
                    echo '<br>';
                    echo 'Error en nombre del formulario 3';
                } 
                if (comp_texto($_POST['apellido3']) == false) {
                    echo '<br>';
                    echo 'Error en apellido del formulario 3';
                }
                if (comp_texto($_POST['trabajo3']) == false) {
                    echo '<br>';
                    echo 'Error en trabajo del formulario 3';
                }
                
            }
        } else {
            echo 'Recuerde, no deje espacios en blanco';
        }
        
    }
    ?>
</body>
</html>