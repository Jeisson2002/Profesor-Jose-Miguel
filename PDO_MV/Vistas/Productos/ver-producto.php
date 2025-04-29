<?php
require_once '../../Clases/Producto.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: lista-productos.php?error=ID no válido");
    exit;
}

$productoModelo = new Producto();
$producto = $productoModelo->obtenerProducto($id);

if (empty($producto)) {
    header("Location: lista-productos.php?error=Producto no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Producto</title>
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
                <li><a href="lista-productos.php">Lista Productos</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Ver Producto</li>
            </ul>
            <h1>Detalles de Producto</h1>
            <p>Todos los detalles de un producto registrado.</p>
        </div>
        <div class="card gap-flex">
            <p><strong>Nombre:</strong> <?= $producto["nombre_prod"] ?></p>
            <p><strong>Descripción:</strong> <?= $producto["descripcion_prod"] ?></p>
            <p><strong>Stock Disponible:</strong> <?= $producto["stock_prod"] ?></p>
            <p><strong>Precio por Unidad:</strong> $<?= number_format($producto["valor_unidad"], 2) ?></p>
            <p><strong>Impuesto:</strong> <?= $producto["impuesto"] ?>%</p>
            <p><strong>Categoría:</strong> <?= $producto["nombre_categoria"] ?></p>
            <p><strong>Estado:</strong> <?= $producto["nombre_estado"] ?></p>
        </div>
        <a href="lista-productos.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>