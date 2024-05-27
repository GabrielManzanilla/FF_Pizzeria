<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. Pizzeria - Repartidor</title>
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
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="../../../index.php">Regresar al Menú Principal</a>
    <h1 style="text-align:center">PEDIDOS A ENTREGAR</h1>
<?php
    include("../../conectar.php");
    $consultaOrder = "SELECT 
                        o.orden_id AS id_order,
                        c.nombre AS nombre_cliente,
                        c.direccion as direccion_cliente,
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
                echo "<td>" . $row['direccion_cliente'] . "</td>";

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