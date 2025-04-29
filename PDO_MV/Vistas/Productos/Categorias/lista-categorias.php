<?php
require_once '../../../Clases/Categoria.php';

$categoriaModelo = new Categoria();
$listaCategorias = $categoriaModelo->obtenerCategorias();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
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
                <li>Lista Categorias</li>
            </ul>
            <h1>Lista de Categorias</h1>
            <p>Lista general de los categorias registrados</p>
        </div>
        <a href="crear-categoria.php" class="add-btn">Agregar Categoria</a>
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
                    <?php if (!empty($listaCategorias)): ?>
                        <?php foreach ($listaCategorias as $categoria): ?>
                            <tr>
                                <td><?= $categoria['id_categoria'] ?></td>
                                <td><?= $categoria['nombre_categoria'] ?></td>
                                <td>
                                    <a href="editar-categoria.php?id=<?= $categoria['id_categoria']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="eliminar-categoria.php?id=<?= $categoria['id_categoria']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay categorias registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>