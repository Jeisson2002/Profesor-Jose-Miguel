<?php
require_once '../../../Clases/Estado.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-estados.php?error=ID no válido.");
    exit;
}

$estadoModelo = new Estado();
$estado = $estadoModelo->obtenerEstado($id);

if (empty($estado)) {
    header("Location: lista-estados.php?error=Estado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $estadoModelo->eliminarEstado($id);

    if ($resultado) {
        header("Location: lista-estados.php?success=Estado Eliminado.");
    } else {
        echo "Error al editar el estado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Estado</title>
    <link rel="stylesheet" href="../../../Css/principal.css">
    <link rel="stylesheet" href="../../../Css/base.css">
</head>

<body>
    <?php include '../../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Estado</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al estado <strong><?= $estado["nombre_estado"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-estados.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>