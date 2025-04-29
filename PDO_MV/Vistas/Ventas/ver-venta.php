<?php
require_once '../../Clases/Venta.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: lista-ventas.php?error=ID no válido");
    exit;
}

$productoModelo = new Venta();
$venta = $productoModelo->obtenerVenta($id);

if (empty($venta)) {
    header("Location: lista-ventas.php?error=Venta no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Venta</title>
    <link rel="stylesheet" href="../../Css/principal.css">
    <link rel="stylesheet" href="../../Css/base.css">
</head>

<body>
    <?php include '../Base/navbar.php' ?>

    <div class="container">
        <div class="header">
            <ul class="breadcrumb">
                <li><a href="../inicio.php">Inicio</a></li>
                <li class="breadcrumb-arrow">></li>
                <li><a href="lista-ventas.php">Lista Ventas</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Ver Venta</li>
            </ul>
            <h1>Detalles de Venta</h1>
            <p>Todos los detalles de un venta registrado.</p>
        </div>
        <div class="card gap-flex">
            <p><strong>Numero de Factura:</strong> <?= $venta["nro_factura"] ?></p>
            <p><strong>Fecha:</strong> <?= date("d/m/Y", strtotime($venta["fecha_venta"])) ?></p>
            <p><strong>Cliente:</strong> <?= $venta["nombre_cliente"] ?></p>
            <p><strong>Empleado:</strong> <?= $venta["nombre_empleado"] ?></p>
            <p><strong>Tipo de Venta:</strong> <?= $venta["tipo_venta"] ?></p>
            <p><strong>Producto:</strong> <?= $venta["nombre_prod"] ?></p>
            <p><strong>Cantidad:</strong> <?= $venta["cantidad"] ?></p>
            <p><strong>Total:</strong> <?= $venta["valor_total"] ?></p>
        </div>
        <a href="lista-ventas.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>