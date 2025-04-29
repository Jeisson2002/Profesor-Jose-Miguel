<?php
require_once '../../Clases/Producto.php';

$productoModelo = new Producto();
$listaProductos = $productoModelo->obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
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
                <li>Lista Productos</li>
            </ul>
            <h1>Lista de Productos</h1>
            <p>Lista general de los productos registrados</p>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>IVA (%)</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaProductos)): ?>
                        <?php foreach ($listaProductos as $producto): ?>
                            <tr>
                                <td><?= $producto["cod_prod"] ?></td>
                                <td><?= $producto["nombre_prod"] ?></td>
                                <td><?= number_format($producto["valor_unidad"], 2, ',', '.') ?></td>
                                <td><?= $producto["impuesto"] ?>%</td>
                                <td><?= $producto["stock_prod"] ?></td>
                                <td><?= $producto["nombre_categoria"] ?></td>
                                <td><?= $producto["nombre_estado"] ?></td>
                                <td>
                                    <a href="ver-producto.php?id=<?= $producto['cod_prod']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="editar-producto.php?id=<?= $producto['cod_prod']; ?>"
                                        class="btn btn-editar">Editar</a>
                                    <a href="eliminar-producto.php?id=<?= $producto['cod_prod']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>