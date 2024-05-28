<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. Pizzeria - Empleados</title>
</head>
<body>
    <a href="../../../index.php">Regresar al Menú Principal</a>
    <h1>"La unión hace la fuerza...</h1>
    <h2>... por eso conoce a tu equipo de trabajo"</h2>

    <?php 
    // Conexión a la base de datos
    include("../../conectar.php");

    // Verificar si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];

        // Insertar el nuevo empleado en la base de datos
        $consulta = "INSERT INTO Empleados (numero, nombre, fk_rol_id) VALUES ('$numero', '$nombre', '$rol')";
        if (mysqli_query($enlace, $consulta)) {
            echo "Empleado agregado exitosamente.<br>";
        } else {
            echo "Error: " . mysqli_error($enlace) . "<br>";
        }
    }

    // Mostrar el formulario para agregar empleados
    ?>
    <h1>Agregar Nuevo Empleado</h1>
    <form action="" method="POST">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="1">Cocinero</option>
            <option value="2">Repartidor</option>
            <option value="3">Recepcionista</option>
            <option value="4">Gerente</option>
        </select><br><br>

        <input type="submit" value="Agregar Empleado">
    </form>



    <?php
    // Consultar y mostrar la lista de empleados
    $consulta = "SELECT E.empleado_id, E.numero, E.nombre, R.nombre AS rol 
                 FROM Empleados E 
                 JOIN Roles R ON E.fk_rol_id = R.rol_id";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $total_Filas = mysqli_num_rows($resultado);

        if ($total_Filas > 0) {
            echo "<h1>Lista de Empleados</h1>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['empleado_id'] . "</td>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['rol'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Upps, parece que no hay empleados registrados :(";
        }
    } else {
        echo "Ha ocurrido un error al consultar los empleados: " . mysqli_error($enlace);
    }

    // Cerrar la conexión
    mysqli_close($enlace);
    ?>
</body>
</html>
