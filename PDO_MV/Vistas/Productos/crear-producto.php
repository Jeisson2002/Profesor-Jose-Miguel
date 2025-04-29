<?php
require_once '../../Clases/Producto.php';
require_once '../../Clases/Categoria.php';
require_once '../../Clases/Estado.php';

$productoModelo = new Producto();
$categoriaModelo = new Categoria();
$estadoModelo = new Estado();

$categorias = $categoriaModelo->obtenerCategorias();
$estados = $estadoModelo->obtenerEstados();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        "codigo" => trim($_POST["codigo"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "descripcion" => trim($_POST["descripcion"] ?? ""),
        "stock" => trim($_POST["stock"] ?? ""),
        "precio" => trim($_POST["precio"] ?? ""),
        "impuesto" => trim($_POST["impuesto"] ?? ""),
        "id_categoria" => trim($_POST["id_categoria"] ?? ""),
        "id_estado" => trim($_POST["id_estado"] ?? "")
    ];

    if (empty($datos["codigo"]) || empty($datos["nombre"]) || empty($datos["descripcion"]) || empty($datos["stock"]) || empty($datos["precio"])) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $productoModelo->crearProducto($datos);

        if ($resultado) {
            header("Location: lista-productos.php?success=Producto creado.");
        } else {
            echo "Error al editar el producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
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
                <li><a href="lista-productos.php">Lista Productos</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Producto</li>
            </ul>
            <h1>Subir Producto</h1>
            <p>Formulario para subir un producto.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="codigo">Código</label>
                    <input type="text" id="codigo" name="codigo" required>
                </div>
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="input-field">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" rows="4" required></textarea>
                </div>
                <div class="input-field">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                </div>
                <div class="input-field">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" min="0" step="0.01" required>
                </div>
                <div class="input-field">
                    <label for="impuesto">Impuesto</label>
                    <input type="number" id="impuesto" name="impuesto" min="0" step="0.01" required>
                </div>
                <div class="combined-input-field">
                    <div class="input-field">
                        <label for="id_categoria">Categoría</label>
                        <select name="id_categoria" id="id_categoria" class="form-select" required>
                            <option value="">Selecciona una categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria'] ?>">
                                    <?= $categoria['nombre_categoria'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="id_estado">Estado Producto</label>
                        <select name="id_estado" id="id_estado" class="form-select" required>
                            <option value="">Selecciona un estado</option>
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?= $estado['id_estado'] ?>">
                                    <?= $estado['nombre_estado'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Producto</button>
                    <a href="lista-productos.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>