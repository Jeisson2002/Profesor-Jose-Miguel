<?php
require_once '../../Configuracion/conexion.php';

class Empleado
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function obtenerEmpleados()
    {
        $query = "SELECT id_empleado, nombre_empleado, usuario, correo FROM empleados";
        $statement = $this->db->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function obtenerEmpleado($id_empleado)
    {
        $query = "SELECT id_empleado, nombre_empleado, usuario, correo FROM empleados WHERE id_empleado = :id_empleado";
        $statement = $this->db->prepare($query);
        $statement->bindValue(":id_empleado", $id_empleado);
        $statement->execute();

        return $statement->fetch();
    }

    public function crearEmpleado($datos)
    {
        $query = "INSERT INTO empleados (nombre_empleado, usuario, correo, empleado_password) 
                  VALUES (:nombre_empleado, :usuario, :correo, :empleado_password)";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':nombre_empleado', $datos["nombre"]);
        $statement->bindValue(':usuario', $datos["usuario"]);
        $statement->bindValue(':correo', $datos["email"]);
        $statement->bindValue(':empleado_password', $datos["password"]);

        return $statement->execute();
    }

    public function editarEmpleado($id_empleado, $datos)
    {
        $query = "UPDATE empleados SET 
                  nombre_empleado = :nombre_empleado, 
                  usuario = :usuario,
                  correo = :correo
                  WHERE id_empleado = :id_empleado";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':nombre_empleado', $datos["nombre"]);
        $statement->bindValue(':usuario', $datos["usuario"]);
        $statement->bindValue(':correo', $datos["email"]);
        $statement->bindValue(':id_empleado', $id_empleado);

        return $statement->execute();
    }

    public function eliminarEmpleado($id_empleado)
    {
        $query = "DELETE FROM empleados WHERE id_empleado = :id_empleado";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id_empleado', $id_empleado);

        return $statement->execute();
    }
}
?>