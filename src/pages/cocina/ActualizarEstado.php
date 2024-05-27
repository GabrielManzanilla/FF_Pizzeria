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
