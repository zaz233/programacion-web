<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular la hipotenusa del triangulo rectangulo</title>
</head>
<body>
    <h1 align="center">Calcular la hipotenusa del triangulo rectangulo</h1>
    <br><br>
    <h3 align="center">Datos</h3>
    <table align="center" border="1">
        <tr>
            <td>Valor del Cateto A:</td>
            <td>3 cm</td>
        </tr>
        <tr>
            <td>Valor del Cateto B:</td>
            <td>4 cm</td>
        </tr>
    </table>
    <br><br>
    <?php
    $C_a = 4;
    $C_b = 3;
    $Hipo = sqrt(pow($C_a,2) + pow($C_b,2));
    ?>
    <h3 align="center">Resultado</h3>
    <table align="center" border="1">
        <tr>
            <td>Valor de la Hipotenusa:</td>
            <td>
                <?php
                echo $Hipo . ' cm';
                ?>
            </td>
        </tr>
    </table>
</body>
</html>