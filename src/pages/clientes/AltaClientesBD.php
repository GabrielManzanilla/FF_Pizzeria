<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if (strlen($_POST['numero']) >= 1 && strlen($_POST['nombre']) >= 1 && strlen($_POST['direccion']) >= 1) {

        $num = trim($_POST['numero']);
        $nom = trim($_POST['nombre']);
        $dir = trim($_POST['direccion']);

    

        include("../../conectar.php");

        $consulta = "INSERT INTO clientes (numero, nombre, direccion) VALUES ('$num', '$nom', '$dir')";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            die('Error en la consulta: ' . mysqli_error($enlace));
        }

    } else {
        echo "Favor de introducir datos, todos los campos son obligatorios";
    }
    ?>
    <br><a href="AltaClientes.php">Alta de Productos</a>
</body>
</html>
