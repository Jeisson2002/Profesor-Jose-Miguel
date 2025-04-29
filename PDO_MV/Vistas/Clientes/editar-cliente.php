<?php
require_once '../../Clases/Cliente.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-clientes.php?error=ID no válido");
    exit;
}

$clienteModelo = new Cliente();
$cliente = $clienteModelo->obtenerCliente($id);

if (empty($cliente)) {
    header("Location: lista-clientes.php?error=Cliente no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        "identidad" => trim($_POST["identidad"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "direccion" => trim($_POST["direccion"] ?? "")
    ];

    if (empty($datos["identidad"]) || empty($datos["nombre"]) || empty($datos["direccion"])) {
        echo "Todos los datos son obligatorios.";
    }else {
        $resultado = $clienteModelo->editarCliente($id, $datos);

        if ($resultado) {
            header("Location: lista-clientes.php?success=Cliente actualizado.");
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
    <title>Editar Cliente</title>
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
                <li><a href="lista-empleados.php">Lista Empleados</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Editar Cliente</li>
            </ul>
            <h1>Editar Cliente</h1>
            <p>Formulario para editar un cliente.</p>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="identidad">Numero de Identidad</label>
                    <input type="text" id="identidad" name="identidad" value="<?= $cliente['nro_identidad'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="nombre">Nombre Cliente</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $cliente['nombre_cliente'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="direccion">Direccion Cliente</label>
                    <input type="text" id="direccion" name="direccion" value="<?= $cliente['direccion_cliente'] ?>" required>
                </div>

                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Cliente</button>
                    <a href="lista-empleados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>