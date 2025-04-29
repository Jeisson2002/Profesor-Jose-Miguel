<?php
require_once '../../../Clases/TipoVenta.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-tipos-venta.php?error=ID no válido.");
    exit;
}

$tipoVentaModelo = new TipoVenta();
$tipoVenta = $tipoVentaModelo->obtenerTipoVenta($id);

if (empty($tipoVenta)) {
    header("Location: lista-tiposVenta.php?error=TipoVenta no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $tipoVentaModelo->eliminarTipoVenta($id);

    if ($resultado) {
        header("Location: lista-tipos-venta.php?success=Tipo Venta Eliminado.");
    } else {
        echo "Error al editar el tipo venta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Tipo Venta</title>
    <link rel="stylesheet" href="../../../Css/principal.css">
    <link rel="stylesheet" href="../../../Css/base.css">
</head>

<body>
    <?php include '../../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Tipo Venta</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar este tipo de venta</strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-tipos-venta.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>