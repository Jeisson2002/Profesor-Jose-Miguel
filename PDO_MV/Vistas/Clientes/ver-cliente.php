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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Cliente</title>
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
                <li><a href="lista-clientes.php">Lista Clientes</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Ver Cliente</li>
            </ul>
            <h1>Detalles de Cliente</h1>
            <p>Todos los detalles de un cliente registrado.</p>
        </div>
        <div class="card gap-flex">
            <p><strong>Numero Identidad:</strong> <?= $cliente["nro_identidad"] ?></p>
            <p><strong>Nombre Cliente:</strong> <?= $cliente["nombre_cliente"] ?></p>
            <p><strong>Dirección Cliente:</strong> <?= $cliente["direccion_cliente"] ?></p>
        </div>
        <a href="lista-clientes.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>