<?php
require_once '../../Clases/Producto.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: lista-productos.php?error=ID no válido.");
    exit;
}

$empleadoModelo = new Producto();
$producto = $empleadoModelo->obtenerProducto($id);

if (empty($producto)) {
    header("Location: lista-productos.php?error=Producto no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $empleadoModelo->eliminarProducto($id);

    if ($resultado) {
        header("Location: lista-productos.php?success=Producto Eliminado.");
    } else {
        echo "Error al editar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="../../Css/principal.css">
    <link rel="stylesheet" href="../../Css/base.css">
</head>

<body>
    <?php include '../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Producto</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar el producto <strong><?= $producto["nombre_prod"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-productos.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>