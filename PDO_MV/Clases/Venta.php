<?php
require_once '../../Configuracion/conexion.php';

class Venta
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function obtenerVentas()
    {
        $query = "SELECT
            ventas_empleado.nro_factura, ventas_empleado.fecha_venta, clientes.nombre_cliente, empleados.nombre_empleado, tipos_venta.descripcion
            FROM ventas_empleado
            INNER JOIN clientes ON ventas_empleado.id_cliente = clientes.id_cliente
            INNER JOIN empleados ON ventas_empleado.id_empleado = empleados.id_empleado
            INNER JOIN tipos_venta ON ventas_empleado.id_tipo_venta = tipos_venta.id_tipo_venta";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function obtenerVenta($nro_factura)
    {
        $query = "SELECT v.nro_factura, v.fecha_venta, c.nombre_cliente, e.nombre_empleado, t.descripcion AS tipo_venta,
                p.nombre_prod, d.cantidad, d.valor_prod, d.valor_impuesto, d.valor_total
                FROM ventas_empleado v
                JOIN clientes c ON v.id_cliente = c.id_cliente
                JOIN empleados e ON v.id_empleado = e.id_empleado
                JOIN tipos_venta t ON v.id_tipo_venta = t.id_tipo_venta
                LEFT JOIN detalles_factura d ON v.nro_factura = d.nro_factura
                LEFT JOIN productos p ON d.cod_prod = p.cod_prod
                WHERE v.nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $nro_factura);
        $statement->execute();

        return $statement->fetch();
    }

    public function obtenerVentaPDF($nro_factura)
    {
        $query = "SELECT v.nro_factura, v.fecha_venta, c.nombre_cliente, e.nombre_empleado, t.descripcion AS tipo_venta,
                p.nombre_prod, d.cantidad, d.valor_prod, d.valor_impuesto, d.valor_total
                FROM ventas_empleado v
                JOIN clientes c ON v.id_cliente = c.id_cliente
                JOIN empleados e ON v.id_empleado = e.id_empleado
                JOIN tipos_venta t ON v.id_tipo_venta = t.id_tipo_venta
                LEFT JOIN detalles_factura d ON v.nro_factura = d.nro_factura
                LEFT JOIN productos p ON d.cod_prod = p.cod_prod
                WHERE v.nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $nro_factura);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function crearVenta($datos)
    {
        $query = "INSERT INTO
            ventas_empleado (nro_factura, fecha_venta, id_cliente, id_tipo_venta, id_empleado)
            VALUES (:nro_factura, :fecha_venta, :id_cliente, :id_tipo_venta, :id_empleado)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $datos["nro_factura"]);
        $statement->bindParam(":fecha_venta", $datos["fecha"]);
        $statement->bindParam(":id_cliente", $datos["id_cliente"]);
        $statement->bindParam(":id_tipo_venta", $datos["id_tipo_venta"]);
        $statement->bindParam(":id_empleado", $datos["id_empleado"]);

        return $statement->execute();
    }

    public function editarVenta($nro_factura, $datos)
    {
        $query = "UPDATE ventas_empleado SET
            id_cliente = :id_cliente,
            id_empleado = :id_empleado,
            id_tipo_venta = :id_tipo_venta
            WHERE nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $nro_factura);
        $statement->bindParam(":id_cliente", $datos["id_cliente"]);
        $statement->bindParam(":id_empleado", $datos["id_empleado"]);
        $statement->bindParam(":id_tipo_venta", $datos["id_tipo_venta"]);

        return $statement->execute();
    }

    public function eliminarVenta($nro_factura)
    {
        $queryDetails = "DELETE FROM detalles_factura WHERE nro_factura = :nro_factura";
        $statementDetails = $this->db->prepare($queryDetails);
        $statementDetails->bindParam(":nro_factura", $nro_factura);
        $statementDetails->execute();

        $query = "DELETE FROM ventas_empleado WHERE nro_factura = :nro_factura";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":nro_factura", $nro_factura);
        return $statement->execute();
    }

    function generarNumeroFactura() {
        $añoActual = date("Y");
    
        $query = "SELECT nro_factura 
                  FROM ventas_empleado 
                  WHERE YEAR(fecha_venta) = :anio 
                  ORDER BY fecha_venta DESC 
                  LIMIT 1";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['anio' => $añoActual]);
        $ultimaFactura = $stmt->fetchColumn();
    
        if ($ultimaFactura && preg_match('/FAC' . $añoActual . '-(\d+)/', $ultimaFactura, $matches)) {
            $ultimoNumero = (int)$matches[1];
        } else {
            $ultimoNumero = 0;
        }
    
        $nuevoNumero = $ultimoNumero + 1;
        return "FAC{$añoActual}-{$nuevoNumero}";
    }
}
?>