<?php
require_once '../../../Clases/Estado.php';

$estadoModelo = new Estado();
$listaEstados = $estadoModelo->obtenerEstados();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Estados</title>
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
                <li>Lista Estados</li>
            </ul>
            <h1>Lista de Estados</h1>
            <p>Lista general de los estados registrados</p>
        </div>
        <a href="crear-estado.php" class="add-btn">Agregar Estado</a>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaEstados)): ?>
                        <?php foreach ($listaEstados as $estado): ?>
                            <tr>
                                <td><?= $estado['id_estado'] ?></td>
                                <td><?= $estado['nombre_estado'] ?></td>
                                <td>
                                    <a href="editar-estado.php?id=<?= $estado['id_estado']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="eliminar-estado.php?id=<?= $estado['id_estado']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay estados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>