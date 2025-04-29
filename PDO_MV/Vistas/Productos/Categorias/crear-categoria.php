<?php
require_once '../../../Clases/Categoria.php';

$categoriaModelo = new Categoria();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_categoria = trim($_POST["nombre"] ?? "");

    if (empty($nombre_categoria)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $categoriaModelo->crearCategoria($nombre_categoria);

        if ($resultado) {
            header("Location: lista-categorias.php?success=Categoria creado.");
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
    <title>Crear Categoria</title>
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
                <li><a href="lista-categorias.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Categoria</li>
            </ul>
            <h1>Subir Categoria</h1>
            <p>Formulario para subir un categoria.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre Categoria</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Categoria</button>
                    <a href="lista-categorias.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>