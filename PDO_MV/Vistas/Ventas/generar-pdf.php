<?php
require_once '../../dompdf/autoload.inc.php'; // Ruta donde pusiste dompdf

require_once '../../Clases/Venta.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$nro_factura = $_GET['id'] ?? "";

if (!$nro_factura) {
    die("Factura no válida.");
}

$ventaModelo = new Venta();
$detalles = $ventaModelo->obtenerVentaPDF($nro_factura);

if (empty($detalles)) {
    die("Venta no encontrada.");
}

$venta = $detalles[0]; // Datos generales de la venta

// HTML para el PDF
$html = '
    <h2 style="text-align:center;">Factura N° ' . $venta["nro_factura"] . '</h2>
    <p><strong>Fecha:</strong> ' . date("d/m/Y", strtotime($venta["fecha_venta"])) . '</p>
    <p><strong>Cliente:</strong> ' . $venta["nombre_cliente"] . '</p>
    <p><strong>Empleado:</strong> ' . $venta["nombre_empleado"] . '</p>
    <p><strong>Tipo de Venta:</strong> ' . $venta["tipo_venta"] . '</p>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr style="background:#f2f2f2;">
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>IVA</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>';

$total = 0;
foreach ($detalles as $item) {
    $subtotal = $item["valor_total"];
    $total += $subtotal;

    $html .= '
        <tr>
            <td>' . $item["nombre_prod"] . '</td>
            <td>' . $item["cantidad"] . '</td>
            <td>$' . number_format($item["valor_prod"], 2) . '</td>
            <td>$' . number_format($item["valor_impuesto"], 2) . '</td>
            <td>$' . number_format($subtotal, 2) . '</td>
        </tr>';
}

$html .= '
        </tbody>
    </table>
    <h3 style="text-align:right;">Total: $' . number_format($total, 2) . '</h3>';

// Generar el PDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Mostrar el PDF en el navegador
$dompdf->stream("Factura_" . $venta["nro_factura"] . ".pdf", ["Attachment" => false]);
exit;
