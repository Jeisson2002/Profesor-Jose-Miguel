<?php
require_once '../../Clases/Empleado.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-empleados.php?error=ID no válido");
    exit;
}

$empleadoModelo = new Empleado();
$empleado = $empleadoModelo->obtenerEmpleado($id);

if (empty($empleado)) {
    header("Location: lista-empleados.php?error=Empleado no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
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
                <li><a href="lista-empleados.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Ver Empleado</li>
            </ul>
            <h1>Detalles de Empleado</h1>
            <p>Todos los detalles de un empleado registrado.</p>
        </div>
        <div class="card gap-flex">
            <p><strong>ID:</strong> <?= $empleado["id_empleado"] ?></p>
            <p><strong>Nombre:</strong> <?= $empleado["nombre_empleado"] ?></p>
            <p><strong>Correo:</strong> <?= $empleado["correo"] ?></p>
            <p><strong>Usuario:</strong> <?= $empleado["usuario"] ?></p>
        </div>
        <a href="lista-empleados.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>