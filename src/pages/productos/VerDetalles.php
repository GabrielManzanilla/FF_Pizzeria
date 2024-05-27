<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. Pizzeria - productos</title>
</head>

<body>
    <?php include("../../conectar.php"); ?>
    <a href="../../../index.php">Regresar al Menú Principal</a>
    <h1>Conoce la variedad de productos que tenemos para ti</h1>
    <div>
        <h2>Tamaños de Pizza</h2>
        <?php
        $consultaTamanios = "SELECT * FROM tamanio";
        $resultadoTamanios = mysqli_query($enlace, $consultaTamanios);

        echo "<table>";
        echo "<tr>
                <th>cantidad <br> ingredientes</th>
                <th>Numero</th>
                <th>Nombre</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($resultadoTamanios)) {
            echo "<tr>";
            echo "<td>" . $row['tamanio_id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        ?>
    </div>
    <div>
        <h2>Ingredientes a Elegir</h2>
        <?php
        $consultaIngredientes = "SELECT * FROM ingredientes";
        $resultadoIngredientes = mysqli_query($enlace, $consultaIngredientes);
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($resultadoIngredientes)) {
            echo "<li>" . $row['nombre'] . "</li>";
        }
        echo "</ul>";


        ?>
    </div>
</body>

</html>