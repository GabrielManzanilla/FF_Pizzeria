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

        table, th, td {
            border: 1px solid black;
        }

        th, td {
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $orden_id = $_POST['orden_id'];
        $nuevo_estado = $_POST['estado'];

        $actualizar_estado = "UPDATE Orden SET isEntregado = ? WHERE orden_id = ?";
        $stmt = mysqli_prepare($enlace, $actualizar_estado);
        mysqli_stmt_bind_param($stmt, "ii", $nuevo_estado, $orden_id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            echo "Error al actualizar el estado de la orden: " . mysqli_error($enlace);
        }

        mysqli_stmt_close($stmt);
    }

    $consultaOrderListo = "SELECT 
                            o.orden_id AS id_order,
                            c.nombre AS nombre_cliente,
                            c.direccion AS direccion_cliente
                          FROM Orden o
                          JOIN Clientes c ON o.fk_id_cliente = c.cliente_id
                          WHERE o.isEntregado = 1
                          GROUP BY o.orden_id";

    $ordenListo = mysqli_query($enlace, $consultaOrderListo);

    $consultaOrderCompletada = "SELECT 
                                o.orden_id AS id_order,
                                c.nombre AS nombre_cliente,
                                c.direccion AS direccion_cliente
                              FROM Orden o
                              JOIN Clientes c ON o.fk_id_cliente = c.cliente_id
                              WHERE o.isEntregado = 2
                              GROUP BY o.orden_id";

    $ordenCompletada = mysqli_query($enlace, $consultaOrderCompletada);
    ?>

    <h2>Pedidos Listo para Entrega</h2>
    <?php
    if ($ordenListo) {
        $total_FilasListo = mysqli_num_rows($ordenListo);

        if ($total_FilasListo > 0) {
            echo "<table>";
            echo "<tr>
            <th>ORDEN</th>
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Acción</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($ordenListo)) {
                echo "<tr>";
                echo "<td>" . $row['id_order'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . "</td>";
                echo "<td>" . $row['direccion_cliente'] . "</td>";
                echo "<td>";
                echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                echo "<input type='hidden' name='orden_id' value='" . $row['id_order'] . "'>";
                echo "<input type='hidden' name='estado' value='2'>";
                echo "<button type='submit'>Marcar como Entrega Completada</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay órdenes listas para entrega.";
        }
    } else {
        echo "Ha ocurrido un error al consultar las órdenes: " . mysqli_error($enlace);
    }
    ?>

    <h2>Pedidos con Entrega Completada</h2>
    <?php
    if ($ordenCompletada) {
        $total_FilasCompletada = mysqli_num_rows($ordenCompletada);

        if ($total_FilasCompletada > 0) {
            echo "<table>";
            echo "<tr>
            <th>ORDEN</th>
            <th>Cliente</th>
            <th>Dirección</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($ordenCompletada)) {
                echo "<tr>";
                echo "<td>" . $row['id_order'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . "</td>";
                echo "<td>" . $row['direccion_cliente'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay órdenes con entrega completada.";
        }
    } else {
        echo "Ha ocurrido un error al consultar las órdenes: " . mysqli_error($enlace);
    }

    mysqli_close($enlace);
    ?>
</body>
</html>
