<?php
require_once '../../Clases/Cliente.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-clientes.php?error=ID no válido.");
    exit;
}

$clienteModelo = new Cliente();
$cliente = $clienteModelo->obtenerCliente($id);

if (empty($cliente)) {
    header("Location: lista-clientes.php?error=Cliente no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $clienteModelo->eliminarCliente($id);

    if ($resultado) {
        header("Location: lista-clientes.php?success=Cliente Eliminado.");
    } else {
        echo "Error al editar el cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../../Css/principal.css">
    <link rel="stylesheet" href="../../Css/base.css">
</head>

<body>
    <?php include '../Base/navbar.php' ?>

    <div class="container">
        <h1>Eliminar Cliente</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al cliente <strong><?= $cliente["nombre_cliente"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="lista-clientes.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>