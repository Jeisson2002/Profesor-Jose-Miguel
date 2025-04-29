<?php
require_once __DIR__ . '/../Configuracion/conexion.php';

class TipoVenta
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

   
    public function obteneterTiposVenta()
    {
        $query = "SELECT * FROM tipos_venta";

        $statement = $this->db->prepare($query);

        $statement->execute();
        
        return $statement->fetchAll();
    }

    public function obtenerTipoVenta($id_tipo_venta)
    {
        $query = "SELECT * FROM tipos_venta WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_tipo_venta);

        $statement->execute();
        
        return $statement->fetch();
    }

    public function createTipoVenta($descripcion)
    {
        $query = "INSERT INTO tipos_venta (descripcion) VALUES (:descripcion)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":descripcion", $descripcion);

        return $statement->execute();
    }

    public function editarTipoVenta($id_tipo_venta, $descripcion)
    {
        $query = "UPDATE tipos_venta SET descripcion = :descripcion WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_tipo_venta);
        $statement->bindParam(":descripcion", $descripcion);

        return $statement->execute();
    }

    public function eliminarTipoVenta($id_tipo_venta)
    {
        $query = "DELETE FROM tipos_venta WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_tipo_venta);

        return $statement->execute();
    }
}
?>