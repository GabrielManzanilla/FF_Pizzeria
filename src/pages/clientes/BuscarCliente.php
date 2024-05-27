<?php
header('Content-Type: application/json');

include("../../conectar.php");
$numero = trim($_GET['numero']);
$consulta = "SELECT nombre, direccion FROM Clientes WHERE numero='$numero'";

$respuesta=mysqli_query($enlace,$consulta);

if ($respuesta->num_rows > 0) {
    // Obtiene los datos del cliente y los devuelve como un arreglo asociativo
    $cliente = $respuesta->fetch_assoc();
    echo json_encode($cliente);
} else {
    // Si no se encontró ningún cliente, devuelve null
    echo json_encode(null);
}
?>