<?php
include("../../conectar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $cliente = $_POST['cliente'];
    $empleado = $_POST['empleado'];
    $tamanio = $_POST['tamanio'];
    $ingredientes = $_POST['ingredientes'];

    $insertOrder = "INSERT INTO Orden (fecha, isEntregado, fk_id_cliente, fk_id_empleado) VALUES ('$fecha', FALSE, $cliente, $empleado)";
    if (mysqli_query($enlace, $insertOrder)) {
        $orden_id = mysqli_insert_id($enlace);

        // Insertar los detalles en la tabla Details
        foreach ($ingredientes as $ingrediente) {
            $insertDetails = "INSERT INTO Details (fk_id_orden, fk_id_ingredientes, fk_id_tamanio) VALUES ($orden_id, $ingrediente, $tamanio)";
            mysqli_query($enlace, $insertDetails);
        }

        // Actualizar el estado de la orden a "En Cocina"
        $actualizarEstado = "UPDATE Orden SET isEntregado = FALSE WHERE orden_id = $orden_id";
        mysqli_query($enlace, $actualizarEstado);

        // Redirigir a la misma página para evitar el reenvío del formulario al recargar
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($enlace);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Orden</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Crear Nueva Orden</h1>

    <!--Formulario.-->
    <form action="#" method="post">

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <?php
            $clientes = mysqli_query($enlace, "SELECT cliente_id, nombre FROM Clientes");
            while ($cliente = mysqli_fetch_assoc($clientes)) {
                echo "<option value='{$cliente['cliente_id']}'>{$cliente['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="empleado">Empleado:</label>
        <select id="empleado" name="empleado" required>
            <?php
            $empleados = mysqli_query($enlace, "SELECT empleado_id, nombre FROM Empleados");
            while ($empleado = mysqli_fetch_assoc($empleados)) {
                echo "<option value='{$empleado['empleado_id']}'>{$empleado['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="tamanio">Tamaño:</label>
        <select id="tamanio" name="tamanio" required>
            <?php
            $tamanios = mysqli_query($enlace, "SELECT tamanio_id, nombre FROM Tamanio");
            while ($tamanio = mysqli_fetch_assoc($tamanios)) {
                echo "<option value='{$tamanio['tamanio_id']}'>{$tamanio['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="ingredientes">Ingredientes:</label><br>
        <?php
        $ingredientes = mysqli_query($enlace, "SELECT ingrediente_id, nombre FROM Ingredientes");
        while ($ingrediente = mysqli_fetch_assoc($ingredientes)) {
            echo "<input type='checkbox' name='ingredientes[]' value='{$ingrediente['ingrediente_id']}'> {$ingrediente['nombre']}<br>";
        }
        ?><br><br>

        <input type="submit" value="Crear Orden">
    </form>

    <h1>Listado de Órdenes</h1>
    <?php
    $consultaOrder = "SELECT 
                        o.orden_id AS id_order,
                        c.nombre AS nombre_cliente,
                        o.isEntregado,
                        GROUP_CONCAT(CONCAT(t.nombre, ': ', d.descripcion) ORDER BY t.nombre SEPARATOR '|') AS description,
                        ROUND(SUM(t.precio), 2) AS total_precio
                    FROM Orden o
                    JOIN Clientes c ON o.fk_id_cliente = c.cliente_id
                    JOIN (
                        SELECT 
                            fk_id_orden,
                            t.nombre AS nombre_tamanio,
                            GROUP_CONCAT(i.nombre ORDER BY i.nombre SEPARATOR ', ') AS descripcion
                        FROM Details d
                        JOIN Tamanio t ON d.fk_id_tamanio = t.tamanio_id
                        JOIN Ingredientes i ON d.fk_id_ingredientes = i.ingrediente_id
                        GROUP BY fk_id_orden, nombre_tamanio
                    ) d ON o.orden_id = d.fk_id_orden
                    JOIN Tamanio t ON d.nombre_tamanio = t.nombre
                    GROUP BY o.orden_id;
";

    $orden = mysqli_query($enlace, $consultaOrder);

    if ($orden) {
        $total_Filas = mysqli_num_rows($orden);

        if ($total_Filas > 0) {
            echo "<table>";
            echo "<tr>
            <th>ORDEN</th>
            <th>Cliente</th>
            <th>Estado Entrega</th>
            <th>Descripción del Pedido</th>
            <th>TOTAL</th></tr>";

            // Iterar sobre los resultados y mostrar cada fila en la tabla
            while ($row = mysqli_fetch_assoc($orden)) {
                echo "<tr>";
                echo "<td>" . $row['id_order'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . "</td>";
                if ($row['isEntregado'] == '0') {
                    echo "<td>En Cocina</td>";
                } elseif ($row['isEntregado'] == '1') {
                    echo "<td>Entregado al repartidor</td>";
                } else {
                    echo "<td>ERROR</td>";
                }

                // Imprimir la descripción del pedido
                echo "<td>";
                $ingredientes_por_tamanio = explode('|', $row['description']);
                foreach ($ingredientes_por_tamanio as $descripcion) {
                    list($tamanio, $ingredientes) = explode(':', $descripcion);
                    echo "{$tamanio}({$ingredientes}), ";
                }
                echo "</td>";

                echo "<td>" . $row['total_precio'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay órdenes registradas";
        }
    } else {
        echo "Ha ocurrido un error al consultar las órdenes";
    }
    ?>

</body>

</html>