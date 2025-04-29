<?php
require_once '../../../Clases/TipoVenta.php';

$tipoVentaModelo = new TipoVenta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($descripcion)) {
        echo "Todos los datos son obligatorios.";
    } else {

        $resultado = $tipoVentaModelo->createTipoVenta($descripcion);

        if ($resultado) {
            header("Location: lista-tipos-venta.php?success=Tipo de venta creado.");
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
                <li><a href="lista-tipos-venta.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Estado</li>
            </ul>
            <h1>Subir Estado</h1>
            <p>Formulario para subir un estado.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="descripcion">Nombre</label>
                    <input type="text" name="descripcion" id="descripcion" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Estado</button>
                    <a href="lista-tipos-venta.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>