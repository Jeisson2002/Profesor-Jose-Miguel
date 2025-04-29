<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../Css/principal.css">
    <link rel="stylesheet" href="../Css/base.css">
    <link rel="stylesheet" href="../Css/inicio.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'Base/navbar.php' ?>

    <div class="header">
        <h1>Bienvenido al Panel de Control</h1>
        <p>Resumen general del sistema de ventas</p>
    </div>

    <div class="cards">
        <div class="card">
            <h2>Ventas del Día</h2>
            <div class="value">$5,200</div>
        </div>
        <div class="card">
            <h2>Nuevos Clientes</h2>
            <div class="value">12</div>
        </div>
        <div class="card">
            <h2>Productos en Stock</h2>
            <div class="value">1,280</div>
        </div>
        <div class="card">
            <h2>Ventas del Mes</h2>
            <div class="value">$60,000</div>
        </div>
    </div>

    <div class="section">
        <h2>Accesos Rápidos</h2>
        <div class="quick-actions">
            <button>➕ Subir Empleado</button>
            <button>➕ Subir Cliente</button>
            <button>➕ Subir Producto</button>
            <button>🛒 Registrar Venta</button>
            <button>📄 Ver Reportes</button>
        </div>
    </div>

    <div class="section">
        <h2>Alertas</h2>
        <div class="alerts">
            🔔 3 productos con stock crítico<br />
            🔔 2 ventas pendientes de confirmación
        </div>
    </div>

    <div class="section top-vendedores">
        <h2>Top Vendedores</h2>
        <table>
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Ventas ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>🥇 María López</td>
                    <td class="highlight">$25,000</td>
                </tr>
                <tr>
                    <td>🥇Juan Pérez</td>
                    <td>$22,300</td>
                </tr>
                <tr>
                    <td>🥇Carla Gómez</td>
                    <td>$19,500</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>