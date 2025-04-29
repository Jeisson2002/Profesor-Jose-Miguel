<?php
require_once __DIR__ . '/../Configuracion/conexion.php';

class Categoria
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function obtenerCategorias()
    {
        $query = "SELECT * FROM categorias";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function obtenerCategoria($id_categoria)
    {
        $query = "SELECT * FROM categorias WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_categoria);

        $statement->execute();

        return $statement->fetch();
    }

    public function crearCategoria($nombre_categoria)
    {
        $query = "INSERT INTO categorias (nombre_categoria) VALUES (:nombre_categoria)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nombre_categoria", $nombre_categoria);

        return $statement->execute();
    }

    public function editarCategoria($id_categoria, $nombre_categoria)
    {
        $query = "UPDATE categorias SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_categoria);
        $statement->bindParam(":nombre_categoria", $nombre_categoria);

        return $statement->execute();
    }

    public function eliminarCategoria($id_categoria)
    {
        $query = "DELETE FROM categorias WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_categoria);

        return $statement->execute();
    }
}
?>