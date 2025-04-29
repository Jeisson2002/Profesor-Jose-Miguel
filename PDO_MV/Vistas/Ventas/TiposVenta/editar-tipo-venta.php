<?php
require_once '../../../Clases/TipoVenta.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-tipos-venta.php?error=ID no válido");
    exit;
}

$tipoVentaModelo = new TipoVenta();
$tipoVenta = $tipoVentaModelo->obtenerTipoVenta($id);

if (empty($tipoVenta)) {
    header("Location: lista-tipos-venta.php?error=Tipo de venta no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($descripcion)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $tipoVentaModelo->editarTipoVenta($id, $nombre_estado);

        if ($resultado) {
            header("Location: lista-estados.php?success=Tipo de venta actualizado.");
        } else {
            echo "Error al editar el tipo de venta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Venta</title>
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
                <li><a href="lista-tipos-venta.php">Lista Tipos de Venta</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Editar Tipos de Venta</li>
            </ul>
            <h1>Editar Tipo de Venta</h1>
            <p>Formulario para editar un Tipo de Venta.</p>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="descripcion">Nombre</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?= $tipoVenta['descripcion'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Estado</button>
                    <a href="lista-tipos-venta.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>