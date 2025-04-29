<?php
session_start();

require_once '../../Clases/Venta.php';
require_once '../../Clases/Producto.php';
require_once '../../Clases/Cliente.php';
require_once '../../Clases/Empleado.php';
require_once '../../Clases/TipoVenta.php';
require_once '../../Clases/DetalleFactura.php';

$ventasModelo = new Venta();
$productosModelo = new Producto();
$clientesModelo = new Cliente();
$empleadosModelo = new Empleado();
$tiposVentaModelo = new TipoVenta();
$detallesFacturaModelo = new DetallesFactura();

$productos = $productosModelo->obtenerProductos();
$clientes = $clientesModelo->obtenerClientes();
$empleados = $empleadosModelo->obtenerEmpleados();
$tiposVenta = $tiposVentaModelo->obteneterTiposVenta();

if (!isset($_SESSION['detalles_venta'])) {
    $_SESSION['detalles_venta'] = [];
}

if (!isset($_SESSION['venta_form'])) {
    $_SESSION['venta_form'] = [
        'nro_factura' => $ventasModelo->generarNumeroFactura(),
        'id_cliente' => '',
        'id_empleado' => '',
        'id_tipo_venta' => ''
    ];
}

$nroFactura = $_SESSION['venta_form']['nro_factura'];
$total = array_sum(array_column($_SESSION['detalles_venta'], 'subtotal'));

if (isset($_POST['agregar_producto'])) {
    $cod_prod = $_POST['cod_prod'];
    $cantidad = intval($_POST['cantidad']);

    $producto = $productosModelo->obtenerProducto($cod_prod);
    if ($producto && $cantidad > 0) {
        $valorUnidad = $producto["valor_unidad"];
        $ivaPorcentaje = $producto['impuesto'];

        $precioIva = $valorUnidad + ($valorUnidad * $ivaPorcentaje / 100);
        $subtotal = $cantidad * $precioIva;
        
        $detalle = [
            "cod_prod" => $cod_prod,
            "nombre_prod" => $producto["nombre_prod"],
            "valor_unidad" => $valorUnidad,
            "cantidad" => $cantidad,
            "iva" => $precioIva,
            "subtotal" => $subtotal
        ];

        $_SESSION['detalles_venta'][] = $detalle;

        $total = array_sum(array_column($_SESSION['detalles_venta'], 'subtotal'));

        $_SESSION['venta_form']['id_cliente'] = $_POST['id_cliente'];
        $_SESSION['venta_form']['id_empleado'] = $_POST['id_empleado'];
        $_SESSION['venta_form']['id_tipo_venta'] = $_POST['id_tipo_venta'];

        header("Location: crear-venta.php");
        exit;
    }
}

if (isset($_POST['guardar_venta'])) {
    $datosVenta = [
        "nro_factura" => $_SESSION['venta_form']['nro_factura'],
        "id_cliente" => $_SESSION['venta_form']['id_cliente'],
        "id_empleado" => $_SESSION['venta_form']['id_empleado'],
        "id_tipo_venta" => $_SESSION['venta_form']['id_tipo_venta'],
        "fecha" => date("Y-m-d H:i:s")
    ];

    if (
        empty($datosVenta["nro_factura"]) || empty($datosVenta["id_cliente"]) ||
        empty($datosVenta["id_empleado"]) || empty($datosVenta["id_tipo_venta"]) ||
        empty($_SESSION["detalles_venta"])
    ) {
        echo "Todos los campos son obligatorios y debe añadir al menos un producto.";
    } else {
        $ventasModelo->crearVenta($datosVenta);

        foreach ($_SESSION["detalles_venta"] as $item) {
            $detalle = [
                "nro_factura" => $datosVenta["nro_factura"],
                "cod_prod" => $item["cod_prod"],
                "cantidad" => $item["cantidad"],
                "valor_prod" => $item["valor_unidad"],
                "valor_impuesto" => $item["iva"],
                "valor_total" => $item["subtotal"]
            ];
            $detallesFacturaModelo->crearDetallesFactura($detalle);
        }

        unset($_SESSION["detalles_venta"]);
        unset($_SESSION["venta_form"]);

        header("Location: lista-ventas.php?success=Venta creada");
        exit;
    }
}

if (isset($_POST['eliminar_detalle'])) {
    $indice = $_POST['indice'];
    unset($_SESSION['detalles_venta'][$indice]);
    $_SESSION['detalles_venta'] = array_values($_SESSION['detalles_venta']);
    header("Location: crear-venta.php");
    exit;
}

if (isset($_POST['cancelar'])) {
    unset($_SESSION["detalles_venta"]);
    unset($_SESSION["venta_form"]);
    header("Location: lista-ventas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Venta</title>
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
                <li><a href="lista-productos.php">Lista Ventas</a></li>
                <li class="breadcrumb-arrow">></li>
                <li>Subir Venta</li>
            </ul>
            <h1>Subir Venta</h1>
            <p>Formulario para subir un producto.</p>
        </div>

        <div class="card">
            <form method="post" action="crear-venta.php" class="card-form">
                <div class="input-field">
                    <label for="nro_factura">Número de Factura:</label>
                    <input type="text" name="nro_factura" id="nro_factura" value="<?= $nroFactura ?>" readonly>
                </div>

                <div class="input-field">
                    <label for="id_cliente">Cliente:</label>
                    <select name="id_cliente" id="id_cliente" class="form-select">
                        <option value="">Seleccione un Cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id_cliente'] ?>"
                                <?= ($_SESSION['venta_form']['id_cliente'] == $cliente['id_cliente']) ? 'selected' : '' ?>>
                                <?= $cliente['nombre_cliente'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-field">
                    <label for="id_empleado">Empleado:</label>
                    <select name="id_empleado" id="id_empleado" class="form-select">
                        <option value="">Seleccione un Empleado</option>
                        <?php foreach ($empleados as $empleado): ?>
                            <option value="<?= $empleado['id_empleado'] ?>"
                                <?= ($_SESSION['venta_form']['id_empleado'] == $empleado['id_empleado']) ? 'selected' : '' ?>>
                                <?= $empleado['nombre_empleado'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-field">
                    <label for="id_tipo_venta">Tipo de Venta:</label>
                    <select name="id_tipo_venta" id="id_tipo_venta" class="form-select">
                        <option value="">Seleccione un Tipo</option>
                        <?php foreach ($tiposVenta as $tipo): ?>
                            <option value="<?= $tipo['id_tipo_venta'] ?>"
                                <?= ($_SESSION['venta_form']['id_tipo_venta'] == $tipo['id_tipo_venta']) ? 'selected' : '' ?>>
                                <?= $tipo['descripcion'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <br>

                <h3>Agregar Producto</h3>
                <div class="input-field-sale">
                    <div class="input-field">
                        <label for="cod_prod">Producto:</label>
                        <select name="cod_prod" id="cod_prod" class="form-select">
                            <option value="">Seleccione un Producto</option>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?= $producto['cod_prod'] ?>"><?= $producto['nombre_prod'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" min="1">
                    </div>
                </div>

                <button type="submit" name="agregar_producto" class="btn btn-editar">Agregar Producto</button>

                <h3 class="sale-title">Productos Agregados</h3>
                <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Valor Iva</th>
                            <th>Subtotal</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["detalles_venta"] as $i => $item): ?>
                            <tr>
                                <td><?= $item["nombre_prod"] ?></td>
                                <td><?= $item["cantidad"] ?></td>
                                <td>$<?= number_format($item["valor_unidad"], 2) ?></td>
                                <td>$<?= number_format($item["iva"], 2) ?></td>
                                <td>$<?= number_format($item["subtotal"], 2) ?></td>
                                <td>
                                    <form method="post" action="crear-venta.php">
                                        <input type="hidden" name="indice" value="<?= $i ?>">
                                        <button type="submit" name="eliminar_detalle">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>
                <p for="total">Productos: <?= count($_SESSION["detalles_venta"]) ?></p>
                <p for="total">Total: <?= number_format($total, 2) ?></p>

                <br><br>
                <div class="card-form-buttons">
                    <button type="submit" name="guardar_venta" class="btn btn-editar">Guardar Venta</button>
                    <button type="submit" name="cancelar" class="btn btn-volver">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>