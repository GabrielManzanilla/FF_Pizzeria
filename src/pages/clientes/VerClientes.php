<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver clientes</title>
</head>
<body>

    <?php

    include("../../conectar.php");

    // Inicializar la variable de búsqueda
    $numero = "";

    // Verificar si se envió un número a través del formulario
    if(isset($_POST['buscar_numero'])) {
        // Limpiar y sanitizar el número ingresado
        $numero = mysqli_real_escape_string($enlace, $_POST['buscar_numero']);
    }

    // Construir la consulta SQL con la cláusula WHERE para filtrar por número
    $consulta = "SELECT * FROM clientes";
    if(!empty($numero)) {
        $consulta .= " WHERE numero LIKE '%$numero%'";
    }

    // Ejecutar la consulta
    $resultado = mysqli_query($enlace, $consulta);

    if($resultado){
        
        $total_Filas = mysqli_num_rows($resultado);
        
        if($total_Filas > 0){

            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Numero</th><th>Nombre</th><th>Dirección</th></tr>";

            while($row = mysqli_fetch_assoc($resultado)){
                // Generar una fila de la tabla con los datos de la fila actual
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['direccion'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        }else{
            echo "No hay productos registrados";
        }
    }else{
        echo "Ha ocurrido un error al consultar los productos";
    }

    if (!$resultado) {
        die("Error: " . mysqli_error($enlace));
    }
    
    ?>

<br>
    <!-- Formulario para buscar por número -->
    <form method="post">
        <label>Buscar por número: </label>
        <input type="text" name="buscar_numero" value="<?php echo $numero; ?>">
        <input type="submit" value="Buscar">
    </form>

    <!-- Enlace para regresar al menú principal -->
    <a href="AltaClientes.php">Regresar al Menú Principal</a>

</body>
</html>
