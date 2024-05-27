<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. Pizzeria - Empleados</title>
</head>
<body>
    <a href="../../../index.php">Regresar al Menú Principal</a>
    <h1>"La union hace la fuerza...</h1>
    <h2>... por eso conoce a tu equipo de trabajo"</h2>

    <?php 
    include("../../conectar.php");
    $consulta = "SELECT * FROM empleados";
    $resultado = mysqli_query($enlace, $consulta);

    if($resultado){
        
        $total_Filas = mysqli_num_rows($resultado);
        
        if($total_Filas > 0){

            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Numero</th>
                    <th>Nombre</th>
                </tr>";

            while($row = mysqli_fetch_assoc($resultado)){
                // Generar una fila de la tabla con los datos de la fila actual
                echo "<tr>";
                echo "<td>" . $row['empleado_id'] . "</td>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        }else{
            echo "Upps, parece que no hay empleados registrados :(";
        }
    }else{
        echo "Ha ocurrido un error al consultar los productos";
    }
    ?>
</body>
</html>