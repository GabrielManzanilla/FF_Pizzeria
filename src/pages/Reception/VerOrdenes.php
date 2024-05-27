<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>hola mundo</h1>
    <div>

        <?php
        include("../../conectar.php");
        $consultaOrder = "SELECT o.orden_id AS id_order,
                        c.nombre AS nombre_cliente,
                        o.isEntregado,
                        GROUP_CONCAT(t.nombre SEPARATOR ', ') AS description,
                        ROUND(SUM(t.precio),2) AS total_precio
                    FROM Orden o
                    JOIN Clientes c ON o.fk_id_cliente = c.cliente_id
                    JOIN Details d ON o.orden_id = d.fk_id_orden
                    JOIN Tamanio t ON d.fk_id_tamanio = t.tamanio_id
                    GROUP BY o.orden_id;";

        $orden = mysqli_query($enlace, $consultaOrder);

        if ($orden) {
            $total_Filas = mysqli_num_rows($orden);

            if ($total_Filas > 0) {
                //     echo "<form method='post'>
                //     <label>Buscar por número: </label>
                //     <input type='text' name='buscar_numero' value='$numero'>
                //     <input type='submit' value='Buscar'>
                // </form>";
                echo "<table border='1'>";
                echo "<tr><th>ORDEN</th><th>Cliente</th><th>Estado Entrega</th><th>Descripcion <br>del Pedido</th><th>TOTAL</th></tr>";

                while ($row = mysqli_fetch_assoc($orden)) {
                    // Generar una fila de la tabla con los datos de la fila actual
                    echo "<tr>";
                    echo "<td>" . $row['id_order'] . "</td>";
                    echo "<td>" . $row['nombre_cliente'] . "</td>";
                    if ($row['isEntregado'] == '0') {
                        echo "<td>" . 'En espera' . "</td>";
                    } else if ($row['isEntregado'] == '1') {
                        echo "<td>" . 'Entregado' . "</td>";
                    } else {
                        echo "<td>" . 'ERROR ' . "</td>";
                    }
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['total_precio'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No hay clientes registrados";
            }
        } else {
            echo "Ha ocurrido un error al consultar los clientes";
        }
        ?>
    </div>
    <div>
        <form action="" id="busquedaCliente">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" readonly>
            <input type="text" name="numero" id="numero" placeholder="Telefono" onblur="buscarCliente()">
            <input type="text" name="direccion" id="direccion" placeholder="Direccion" readonly>
            <select name="tamanioPizza" id="tamanioPizza">
                <option value="0">Seleccione Tamaño</option>
                <?php 
                include("../../conectar.php");
                $consultaT="SELECT 
                                    id
                                    CONCAT(nombre, ' - ', precio) AS options
                                    FROM Tamanio;";
                $tamanios=mysqli_query($enlace, $consultaT);

                while($row= mysqli_fetch_assoc($tamanios)){
                    echo "<option id=". $row['id'] .">".$row['options'] ."</option>";
                }
                ?>
            </select>
        </form>
        <script>
            function buscarCliente() {
                var numero = document.getElementById('numero').value;
                var xhr = new XMLHttpRequest();
                console.log(numero)
                xhr.open('GET', '../clientes/BuscarCliente.php?numero=' + numero, true);
                xhr.onload = function(){
                    if (xhr.status == 200) {
                        var cliente = JSON.parse(xhr.responseText);
                        if (cliente) {
                            document.getElementById('nombre').value = cliente.nombre;
                            document.getElementById('direccion').value = cliente.direccion;
                        } else {
                            alert('Cliente no encontrado');
                        }
                    } else {
                        alert('Error al buscar cliente');
                    }
                };
                xhr.send();
            }

        </script>
    </div>
</body>

</html>