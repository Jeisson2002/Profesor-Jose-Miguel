<?php
require_once __DIR__ . '/../Configuracion/conexion.php';

class DetallesFactura
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

   
    public function crearDetallesFactura($datos)
    {
        $query = "INSERT INTO detalles_factura 
                (nro_factura, cod_prod, cantidad, valor_prod, valor_impuesto, valor_total) 
              VALUES 
                (:nro_factura, :cod_prod, :cantidad, :valor_prod, :valor_impuesto, :valor_total)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_factura', $datos["nro_factura"]);
        $statement->bindValue(':cod_prod', $datos["cod_prod"]);
        $statement->bindValue(':cantidad', $datos["cantidad"]);
        $statement->bindValue(':valor_prod', $datos["valor_prod"]);
        $statement->bindValue(':valor_impuesto', $datos["valor_impuesto"]);
        $statement->bindValue(':valor_total', $datos["valor_total"]);

        return $statement->execute();
    }
}
?>