<?php
require_once '../../../Clases/Estado.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-estados.php?error=ID no válido");
    exit;
}

$estadoModelo = new Estado();
$estado = $estadoModelo->obtenerEstado($id);

if (empty($estado)) {
    header("Location: lista-estados.php?error=Estado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $estadoModelo->editarEstado($id, $nombre_estado);

        if ($resultado) {
            header("Location: lista-estados.php?success=Estado actualizado.");
        } else {
            echo "Error al editar el estado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Estado</title>
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
                <li><a href="lista-estados.php">Lista Estados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Editar Estado</li>
            </ul>
            <h1>Editar Estado</h1>
            <p>Formulario para editar un estado.</p>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $estado['nombre_estado'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Estado</button>
                    <a href="lista-estados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>