<?php
require_once '../../Clases/Empleado.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: lista-empleados.php?error=ID no válido");
    exit;
}

$empleadoModelo = new Empleado();
$empleado = $empleadoModelo->obtenerEmpleado($id);

if (empty($empleado)) {
    header("Location: lista-empleados.php?error=Empleado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        "nombre" => trim($_POST["nombre"] ?? ""),
        "email" => trim($_POST["email"] ?? ""),
        "usuario" => trim($_POST["usuario"] ?? "")
    ];

    if (empty($datos["nombre"]) || empty($datos["email"]) || empty($datos["usuario"])) {
        echo "Todos los datos son obligatorios.";
    }else {
        $resultado = $empleadoModelo->editarEmpleado($id, $datos);

        if ($resultado) {
            header("Location: lista-empleados.php?success=Empleado actualizado.");
        } else {
            echo "Error al editar el empleado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
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
                <li>Editar Empleado</li>
            </ul>
            <h1>Editar Empleado</h1>
            <p>Formulario para editar un empleado.</p>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $empleado['nombre_empleado'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" value="<?= $empleado['usuario'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $empleado['correo'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Empleado</button>
                    <a href="lista-empleados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>