<?php
require_once __DIR__ . '/../Configuracion/conexion.php';

class Estado
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function obtenerEstados()
    {
        $query = "SELECT * FROM estados";

        $statement = $this->db->prepare($query);
        
        $statement->execute();

        return $statement->fetchAll();
    }

    public function obtenerEstado($id_estado)
    {
        $query = "SELECT * FROM estados WHERE id_estado = :id_estado";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":id_estado", $id_estado);

        $statement->execute();

        return $statement->fetch();
    }

    public function crearEstado($nombre_estado)
    {
        $query = "INSERT INTO estados (nombre_estado) VALUES (:nombre_estado)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":nombre_estado", $nombre_estado);

        return $statement->execute();
    }

    public function editarEstado($id_estado, $nombre_estado)
    {
        $query = "UPDATE estados SET nombre_estado = :nombre_estado WHERE id_estado = :id_estado";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":id_estado", $id_estado);
        $statement->bindValue(":nombre_estado", $nombre_estado);

        return $statement->execute();
    }

    public function eliminarEstado($id_estado)
    {
        $query = "DELETE FROM estados WHERE id_estado = :id_estado";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":id_estado", $id_estado);

        return $statement->execute();
    }
}
?>