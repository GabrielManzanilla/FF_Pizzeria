<?php
// Incluir el archivo de conexión a la base de datos
include("src/conectar.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];

    // Consultar la base de datos para verificar al empleado
    $consulta = "SELECT E.empleado_id, E.nombre, E.fk_rol_id, R.nombre AS rol 
                 FROM Empleados E 
                 JOIN Roles R ON E.fk_rol_id = R.rol_id 
                 WHERE E.nombre = ? AND E.numero = ?";
    $stmt = mysqli_prepare($enlace, $consulta);
    mysqli_stmt_bind_param($stmt, "si", $nombre, $numero);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $empleado = mysqli_fetch_assoc($resultado);
        $rol = $empleado['fk_rol_id'];

        // Redirigir al empleado a la página correspondiente según su rol
        switch ($rol) {
            case 1:
                header("Location: index_Cocina.php");
                exit(); // Salir del script para evitar que se siga ejecutando el código
            case 2:
                header("Location: index_Repartidor.php");
                exit();
            case 3:
                header("Location: index_Recepcionista.php");
                exit();
            case 4:
                header("Location: index.php");
                exit();
            default:
                echo "Rol no reconocido.";
                break;
        }
    } else {
        echo "Nombre o número incorrectos.";
    }
} else {
    // Mostrar el formulario de login si no se ha enviado una solicitud POST
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MR. Pizzeria - Login</title>
    </head>
    <body>
        <h1>Login de Empleados</h1>
        <form action="login.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="numero">Número:</label>
            <input type="number" id="numero" name="numero" required><br><br>

            <input type="submit" value="Ingresar">
        </form>
    </body>
    </html>
<?php
}
?>
