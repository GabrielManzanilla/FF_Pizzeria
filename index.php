<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. PIZZA - Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            overflow-x: hidden;
            transition: 0.3s;
            z-index: 999;
        }

        .sidebar.hide {
            left: -250px;
        }

        .sidebar .navbar {
            background-color: #222;
            padding: 10px 20px;
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .sidebar a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .menu-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer;
            font-size: 24px;
            color: white;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="navbar">
            <h1>FREDDY FAZBER PIZZA</h1>
        </div>
        <a href="#" onclick="mostrarRepartidor()">
            <div class="item">
                <i class='bx bx-user-circle icon'></i>
                <div>REPARTIDOR</div>
            </div>
        </a>
        <a href="#" onclick="mostrarRecepcion()">
            <div class="item">
                <i class='bx bx-receipt icon'></i>
                <div>RECEPCIÓN</div>
            </div>
        </a>
        <a href="#" onclick="mostrarCocina()">
            <div class="item">
                <i class='bx bx-food-menu icon'></i>
                <div>COCINA</div>
            </div>
        </a>
        <a href="/FF_Pizzeria/src/pages/clientes/VerClientes.php">
            <div class="item">
                <i class='bx bx-user icon'></i>
                <div>CLIENTES</div>
            </div>
        </a>
        <a href="/FF_Pizzeria/src/pages/empleados/VerEmpleados.php">
            <div class="item">
                <i class='bx bx-group icon'></i>
                <div>EMPLEADOS</div>
            </div>
        </a>
        <a href="/FF_Pizzeria/src/pages/productos/VerDetalles.php">
            <div class="item">
                <i class='bx bx-pizza icon'></i>
                <div>PRODUCTOS</div>
            </div>
        </a>
    </div>

    <div class="content" id="content">
        <div class="menu-icon" onclick="toggleSidebar()">
            <i class='bx bx-menu'></i>
        </div>
        <h1>Bienvenido a Freddy Fazber Pizza</h1>
    </div>

    <script>
        function mostrarRepartidor() {
            window.location.assign("/FF_Pizzeria/src/pages/Repartidor/repartidor.php");
        }

        function mostrarRecepcion() {
            window.location.assign("/FF_Pizzeria/src/pages/Reception/Crear_Orden.php");
        }

        function mostrarCocina() {
            window.location.assign("/FF_Pizzeria/src/pages/Cocina/cocina.php");
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('hide');
            content.classList.toggle('hide');
        }
    </script>
</body>
</html>
