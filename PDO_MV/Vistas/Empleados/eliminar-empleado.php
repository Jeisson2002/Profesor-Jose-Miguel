<?php
require_once '../../Clases/Empleado.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-empleados.php?error=ID no válido.");
    exit;
}

$empleadoModelo = new Empleado();
$empleado = $empleadoModelo->obtenerEmpleado($id);

if (empty($empleado)) {
    header("Location: lista-empleados.php?error=Empleado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $empleadoModelo->eliminarEmpleado($id);

    if ($resultado) {
        header("Location: lista-empleados.php?success=Empleado Eliminado.");
    } else {
        echo "Error al editar el empleado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="../../Css/principal.css">
    <link rel="stylesheet" href="../../Css/base.css">
</head>

<body>
    <?php include '../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Empleado</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al empleado <strong><?= $empleado["nombre_empleado"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-empleados.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>