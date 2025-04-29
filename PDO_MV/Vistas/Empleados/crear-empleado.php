<?php
require_once '../../Clases/Empleado.php';

$empleadoModelo = new Empleado();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        "nombre" => trim($_POST["nombre"] ?? ""),
        "email" => trim($_POST["email"] ?? ""),
        "usuario" => trim($_POST["usuario"] ?? ""),
        "password" => trim($_POST["password"] ?? ""),
        "confirmarPassword" => trim($_POST["confirmarPassword"] ?? "")
    ];

    if (empty($datos["nombre"]) || empty($datos["email"]) || empty($datos["usuario"]) || empty($datos["password"])) {
        echo "Todos los datos son obligatorios.";
    }
    if ($datos["password" != $datos["confirmarPassword"]]) {
        echo "La contraseña y la confirmación de tu contraseña deben ser iguales.";
    } else {
        $datos["password"] = password_hash($datos["password"], PASSWORD_BCRYPT);

        $resultado = $empleadoModelo->crearEmpleado($datos);

        if ($resultado) {
            header("Location: lista-empleados.php?success=Empleado creado.");
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
    <title>Crear Empleado</title>
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
                <li>Subir Empleado</li>
            </ul>
            <h1>Subir Empleado</h1>
            <p>Formulario para subir un empleado.</p>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-field">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" required>
                </div>
                <div class="input-field">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-field">
                    <label for="confirmPassword">Confirmar Contraseña</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Empleado</button>
                    <a href="lista-empleados.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>