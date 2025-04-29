<?php
require_once '../../Configuracion/conexion.php';

class Cliente
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function obtenerClientes()
    {
        $query = "SELECT * FROM clientes";

        $statement = $this->db->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function obtenerCliente($id_cliente)
    {
        $query = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":id_cliente", $id_cliente);

        $statement->execute();

        return $statement->fetch();
    }

    public function crearCliente($datos)
    {
        $query = "INSERT INTO clientes
            (nro_identidad, nombre_cliente, direccion_cliente) 
        VALUES
            (:nro_identidad, :nombre_cliente, :direccion_cliente)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_identidad', $datos["identidad"]);
        $statement->bindValue(':nombre_cliente', $datos["nombre"]);
        $statement->bindValue(':direccion_cliente', $datos["direccion"]);

        return $statement->execute();
    }


    public function editarCliente($id_cliente, $datos)
    {
        $query = "UPDATE clientes SET
                nro_identidad = :nro_identidad, 
                nombre_cliente = :nombre_cliente,
                direccion_cliente = :direccion_cliente
            WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_identidad', $datos["identidad"]);
        $statement->bindValue(':nombre_cliente', $datos["nombre"]);
        $statement->bindValue(':direccion_cliente', $datos["direccion"]);
        $statement->bindValue(':id_cliente', $id_cliente);

        return $statement->execute();
    }


    public function eliminarCliente($id_cliente)
    {
        $query = "DELETE FROM clientes WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':id_cliente', $id_cliente);

        return $statement->execute();
    }
}
?>