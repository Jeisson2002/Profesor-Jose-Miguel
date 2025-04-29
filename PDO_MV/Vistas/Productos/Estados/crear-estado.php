<?php
require_once '../../../Clases/Estado.php';

$estadoModelo = new Estado();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {

        $resultado = $estadoModelo->crearEstado($nombre_estado);

        if ($resultado) {
            header("Location: lista-estados.php?success=Estado creado.");
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
    <title>Crear Estado</title>
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
                <li><a href="lista-estados.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Estado</li>
            </ul>
            <h1>Subir Estado</h1>
            <p>Formulario para subir un estado.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre Estado</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Estado</button>
                    <a href="lista-estados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>