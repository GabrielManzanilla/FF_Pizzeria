<!DOCTYPE html>
<html>

<head>
    <title>MR. PIZZA</title>
    <link rel="stylesheet" href="/FF_Pizzeria/src/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="navbar">
        <a href="#" class="title-Super">FREDDY FAZBER PIZZA</a>
    </div>

    <div class="home">
        <h1>Bienvenido a Freddy Fazber Pizza</h1>

        <div class="container">
            <div class="item">
                <div onclick="mostrarRepartidor()">
                    <img src="../FF_Pizzeria/imgg/repartidor.avif" alt="" class="icon">
                    <div>REPARTIDOR</div>
                </div>
            </div>

            <div class="item">
                <div onclick="mostrarRecepcion()">
                    <img src="../FF_Pizzeria/imgg/recep.jpg" alt="" class="icon">
                    <div>RECEPCION</div>
                </div>
            </div>
            <div class="item">
                <div onclick="mostrarCocina()">
                    <img src="../FF_Pizzeria/imgg/cocina.avif" alt="" class="icon">
                    <div>COCINA</div>
                </div>
            </div>
        </div>

    </div>

    <div>
        <div class="listas">
            <div class="item-lista">
                <a href="/FF_Pizzeria/src/pages/clientes/VerClientes.php">Ver Clientes</a>
            </div>
            <div class="item-lista">
                <a href="/FF_Pizzeria/src/pages/productos/VerDetalles.php">Ver Productos</a>
            </div>
            <div class="item-lista">
                <a href="/FF_Pizzeria/src/pages/empleados/VerEmpleados.php">Ver Empleados</a>
            </div>
        </div>
    </div>
</body>

<script>
    function mostrarRepartidor() {
        window.location.assign("/FF_Pizzeria/src/pages/Repartidor/VerEntregas.php");
    }

    function mostrarRecepcion() {
        window.location.assign("/FF_Pizzeria/src/pages/Reception/Crear_Orden.php");
    }

    function mostrarCocina() {
        window.location.assign("/FF_Pizzeria/src/pages/Cocina/cocina.php");
    }
</script>
</body>

</html>
