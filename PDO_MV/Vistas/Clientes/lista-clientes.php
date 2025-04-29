<?php
require_once '../../Clases/Cliente.php';

$clienteModelo = new Cliente();
$listaClientes = $clienteModelo->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
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
                <li>Lista Clientes</li>
            </ul>
            <h1>Lista de Clientes</h1>
            <p>Lista general de los clientes registrados</p>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Identidad</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaClientes)): ?>
                        <?php foreach ($listaClientes as $cliente): ?>
                            <tr>
                                <td><?= $cliente['id_cliente'] ?></td>
                                <td><?= $cliente['nombre_cliente'] ?></td>
                                <td><?= $cliente['nro_identidad'] ?></td>
                                <td><?= $cliente['direccion_cliente'] ?></td>
                                <td>
                                    <a href="ver-cliente.php?id=<?= $cliente['id_cliente']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="editar-cliente.php?id=<?= $cliente['id_cliente']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="eliminar-cliente.php?id=<?= $cliente['id_cliente']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay clientes registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>