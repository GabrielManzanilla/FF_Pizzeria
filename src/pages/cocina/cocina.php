<?php
include("../../conectar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID de la orden y el nuevo estado del formulario
    $orden_id = $_POST['orden_id'];
    $nuevo_estado = $_POST['estado'];

    // Preparar la consulta para actualizar el estado de la orden en la base de datos
    $actualizar_estado = "UPDATE Orden SET isEntregado = ? WHERE orden_id = ?";
    
    // Preparar y ejecutar la consulta
    $stmt = mysqli_prepare($enlace, $actualizar_estado);

    mysqli_stmt_bind_param($stmt, "si", $nuevo_estado, $orden_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Redireccionar de vuelta a la página de cocina con un parámetro de éxito
        header("Location: cocina.php?success=1");
        exit();
    } else {
        // Mostrar un mensaje de error si la consulta falla
        echo "Error al actualizar el estado de la orden: " . mysqli_error($enlace);
    }

    // Cerrar la conexión y liberar los recursos
    mysqli_stmt_close($stmt);
    mysqli_close($enlace);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>MR. PIZZA - Cocina</title>
    <link rel="stylesheet" href="/FF_Pizzeria/src/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .pedido {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body><a href="../../../index_Cocina.php">Regresar al Menú Principal</a>
<!-- Sección de la cocina -->
<div class="cocina-section">
    
    <h2>Ordenes en Cocina</h2>
    <?php
    // Consulta para obtener todas las órdenes
    $consultaOrder = "SELECT
                            o.orden_id AS id_order,
                            c.nombre AS nombre_cliente,
                            o.isEntregado,
                            GROUP_CONCAT(i.nombre SEPARATOR ', ') AS description,
                            t.nombre AS tamano_pizza
                        FROM Orden o
                        JOIN Clientes c ON o.fk_id_cliente = c.cliente_id
                        JOIN Details d ON o.orden_id = d.fk_id_orden
                        JOIN Tamanio t ON d.fk_id_tamanio = t.tamanio_id
                        JOIN Ingredientes i ON d.fk_id_ingredientes = i.ingrediente_id
                        GROUP BY o.orden_id;";
    $orden = mysqli_query($enlace, $consultaOrder);

    if ($orden) {
        while ($row = mysqli_fetch_assoc($orden)) {
    ?>
            <div class="pedido">
                <h3>Pedido #<?php echo $row['id_order']; ?></h3>
                <p><strong>Cliente:</strong> <?php echo $row['nombre_cliente']; ?></p>
                <p><strong>Tamaño de la Pizza:</strong> <?php echo $row['tamano_pizza']; ?></p>
                <p><strong>Ingredientes:</strong> <?php echo $row['description']; ?></p>
                <p><strong>Estado:</strong> <?php echo ($row['isEntregado'] == '0') ? 'En Cocina' : 'Listo para Entrega'; ?></p>
                <!-- Formulario para actualizar el estado -->
                <?php if($row['isEntregado'] == '0'): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="orden_id" value="<?php echo $row['id_order']; ?>">
                    <select name="estado">
                        <option value="0">En Cocina</option>
                        <option value="1">Listo para Entrega</option>
                    </select>
                    <button type="submit">Actualizar Estado</button>
                </form>
                <?php endif; ?>
            </div>
    <?php
        }
    } else {
        echo "No hay órdenes registradas";
    }
    ?>
</div>

</body>

</html>
