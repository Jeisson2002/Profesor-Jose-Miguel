<?php
require_once '../../Clases/Cliente.php';

$clienteModelo = new Cliente();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        "identidad" => trim($_POST["identidad"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "direccion" => trim($_POST["direccion"] ?? "")
    ];

    if (empty($datos["identidad"]) || empty($datos["nombre"]) || empty($datos["direccion"])) {
        echo "Todos los datos son obligatorios.";
    } else {

        $resultado = $clienteModelo->crearCliente($datos);

        if ($resultado) {
            header("Location: lista-clientes.php?success=Cliente creado.");
        } else {
            echo "Error al editar el cliente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
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
                <li><a href="lista-clientes.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Cliente</li>
            </ul>
            <h1>Subir Cliente</h1>
            <p>Formulario para subir un cliente.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="identidad">Numero de Identidad</label>
                    <input type="text" name="identidad" id="identidad" required>
                </div>
                <div class="input-field">
                    <label for="nombre">Nombre Cliente</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="input-field">
                    <label for="direccion">Direccion Cliente</label>
                    <input type="text" name="direccion" id="direccion" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Cliente</button>
                    <a href="lista-empleados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>