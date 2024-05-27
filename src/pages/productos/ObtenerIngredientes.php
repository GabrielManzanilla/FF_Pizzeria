<?php
include("../../conectar.php");

$consultaI = "SELECT 
                ingrediente_id,
                nombre
                FROM Ingredientes;";

$resultado = mysqli_query($enlace, $consultaI);

$ingredientes = [];

if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $ingredientes[] = $row;
    }
    echo json_encode($ingredientes);
} else {
    echo json_encode(['error' => 'Error en la consulta: ' . mysqli_error($enlace)]);
}

mysqli_close($enlace);
?>
