<?php
require_once '../../Clases/Venta.php';

$ventaModelo = new Venta();
$listaVentas = $ventaModelo->obtenerVentas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>
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
                <li>Lista Ventas</li>
            </ul>
            <h1>Lista de Ventas</h1>
            <p>Lista general de los ventas registrados</p>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Tipo de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaVentas)): ?>
                        <?php foreach ($listaVentas as $venta): ?>
                            <tr>
                                <td><?= $venta["nro_factura"] ?></td>
                                <td><?= $venta["fecha_venta"] ?></td>
                                <td><?= $venta["nombre_cliente"] ?></td>
                                <td><?= $venta["nombre_empleado"] ?></td>
                                <td><?= $venta["descripcion"] ?></td>
                                <td>
                                    <a href="ver-venta.php?id=<?= $venta['nro_factura']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="generar-pdf.php?id=<?= $venta['nro_factura']; ?>" class="btn btn-editar" target="_blank">Imprimir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay ventas registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>