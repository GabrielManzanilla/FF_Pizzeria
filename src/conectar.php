<?php
$enlace = mysqli_connect("localhost", "root", "", "ff_pizzeria");

try {
    if (!$enlace) {
        throw new Exception("No pudo conectarse la base de datos: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>