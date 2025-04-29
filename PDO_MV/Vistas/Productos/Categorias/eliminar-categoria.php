<?php
require_once '../../../Clases/Categoria.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-categorias.php?error=ID no válido.");
    exit;
}

$categoriaModelo = new Categoria();
$categoria = $categoriaModelo->obtenerCategoria($id);

if (empty($categoria)) {
    header("Location: lista-categorias.php?error=Categoria no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $categoriaModelo->eliminarCategoria($id);

    if ($resultado) {
        header("Location: lista-categorias.php?success=Categoria Eliminado.");
    } else {
        echo "Error al editar el categoria.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Categoria</title>
    <link rel="stylesheet" href="../../../Css/principal.css">
    <link rel="stylesheet" href="../../../Css/base.css">
</head>

<body>
    <?php include '../../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Categoria</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al categoria <strong><?= $categoria["nombre_categoria"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-categorias.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>