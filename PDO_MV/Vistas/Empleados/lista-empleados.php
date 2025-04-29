<?php
require_once '../../Clases/Empleado.php';

$empleadoModelo = new Empleado();
$listaEmpleados = $empleadoModelo->obtenerEmpleados();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
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
                <li>Lista Empleados</li>
            </ul>
            <h1>Lista de Empleados</h1>
            <p>Lista general de los empleados registrados</p>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaEmpleados)): ?>
                        <?php foreach ($listaEmpleados as $empleado): ?>
                            <tr>
                                <td><?= $empleado['id_empleado'] ?></td>
                                <td><?= $empleado['nombre_empleado'] ?></td>
                                <td><?= $empleado['usuario'] ?></td>
                                <td><?= $empleado['correo'] ?></td>
                                <td>
                                    <a href="ver-empleado.php?id=<?= $empleado['id_empleado']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="editar-empleado.php?id=<?= $empleado['id_empleado']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="eliminar-empleado.php?id=<?= $empleado['id_empleado']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay empleados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>