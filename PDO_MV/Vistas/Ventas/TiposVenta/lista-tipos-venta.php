<?php
require_once '../../../Clases/TipoVenta.php';

$tipoVentaModelo = new TipoVenta();
$listaTiposVenta = $tipoVentaModelo->obteneterTiposVenta();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Tipos Venta</title>
    <link rel="stylesheet" href="../../../Css/principal.css">
    <link rel="stylesheet" href="../../../Css/base.css">
</head>

<body>
    <?php include '../../Base/navbar.php' ?>

    <div class="container">
        <div class="header">
            <ul class="breadcrumb">
                <li><a href="../../inicio.php">Inicio</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Lista Tipos Venta</li>
            </ul>
            <h1>Lista de Tipos Venta</h1>
            <p>Lista general de los tipos venta registrados</p>
        </div>
        <a href="crear-tipo-venta.php" class="add-btn">Agregar Tipo Venta</a>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaTiposVenta)): ?>
                        <?php foreach ($listaTiposVenta as $tipoVenta): ?>
                            <tr>
                                <td><?= $tipoVenta['id_tipo_venta'] ?></td>
                                <td><?= $tipoVenta['descripcion'] ?></td>
                                <td>
                                    <a href="editar-tipo-venta.php?id=<?= $tipoVenta['id_tipo_venta']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="eliminar-tipo-venta.php?id=<?= $tipoVenta['id_tipo_venta']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay tiposVenta registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>