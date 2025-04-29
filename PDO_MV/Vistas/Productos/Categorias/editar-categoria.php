<?php
require_once '../../../Clases/Categoria.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-categorias.php?error=ID no válido");
    exit;
}

$categoriaModelo = new Categoria();
$categoria = $categoriaModelo->obtenerCategoria($id);

if (empty($categoria)) {
    header("Location: lista-categorias.php?error=Categoria no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $categoriaModelo->editarCategoria($id, $nombre_estado);

        if ($resultado) {
            header("Location: lista-categorias.php?success=Categoria actualizado.");
        } else {
            echo "Error al editar el categoria.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
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
                <li><a href="lista-categorias.php">Lista Categorias</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Editar Categoria</li>
            </ul>
            <h1>Editar Categoria</h1>
            <p>Formulario para editar un categoria.</p>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $categoria['nombre_categoria'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Categoria</button>
                    <a href="lista-categorias.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>