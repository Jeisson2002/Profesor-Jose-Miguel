<?php
require_once '../../Configuracion/conexion.php';

class Producto
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }
    
    public function obtenerProductos()
    {
        $query = "SELECT
            productos.cod_prod, productos.nombre_prod, productos.descripcion_prod, productos.stock_prod, productos.impuesto,
            productos.valor_unidad, categorias.id_categoria, categorias.nombre_categoria, estados.id_estado, estados.nombre_estado
            FROM `productos`
            INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
            INNER JOIN estados ON productos.id_estado = estados.id_estado";

        $statement = $this->db->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function obtenerProducto($cod_prod)
    {
        $query = "SELECT
            productos.cod_prod, productos.nombre_prod, productos.descripcion_prod, productos.stock_prod, productos.impuesto,
            productos.valor_unidad, categorias.id_categoria, categorias.nombre_categoria, estados.id_estado, estados.nombre_estado
            FROM `productos` INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
            INNER JOIN estados ON productos.id_estado = estados.id_estado WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":cod_prod", $cod_prod);

        $statement->execute();

        return $statement->fetch();
    }

    public function crearProducto($datos)
    {
        $query = "INSERT INTO productos
                (cod_prod, nombre_prod, descripcion_prod, stock_prod, valor_unidad, impuesto, id_categoria, id_estado) 
            VALUES
                (:cod_prod, :nombre_prod, :descripcion_prod, :stock_prod, :valor_unidad, :impuesto, :id_categoria, :id_estado)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':cod_prod', $datos["codigo"]);
        $statement->bindValue(':nombre_prod', $datos["nombre"]);
        $statement->bindValue(':descripcion_prod', $datos["descripcion"]);
        $statement->bindValue(':stock_prod', $datos["stock"]);
        $statement->bindValue(':valor_unidad', $datos["precio"]);
        $statement->bindValue(':impuesto', $datos["impuesto"]);
        $statement->bindValue(':id_categoria', $datos["id_categoria"]);
        $statement->bindValue(':id_estado', $datos["id_estado"]);

        return $statement->execute();
    }

    public function editarProducto($cod_prod, $datos)
    {
        $query = "UPDATE productos SET
                nombre_prod = :nombre_prod,
                descripcion_prod = :descripcion_prod,
                stock_prod = :stock_prod,
                valor_unidad = :valor_unidad,
                impuesto = :impuesto,
                id_categoria = :id_categoria,
                id_estado = :id_estado
            WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nombre_prod', $datos["nombre"]);
        $statement->bindValue(':descripcion_prod', $datos["descripcion"]);
        $statement->bindValue(':stock_prod', $datos["stock"]);
        $statement->bindValue(':valor_unidad', $datos["precio"]);
        $statement->bindValue(':impuesto', $datos["impuesto"]);
        $statement->bindValue(':id_categoria', $datos["id_categoria"]);
        $statement->bindValue(':id_estado', $datos["id_estado"]);
        $statement->bindValue(':cod_prod', $cod_prod);

        return $statement->execute();
    }

    public function eliminarProducto($cod_prod)
    {
        $query = "DELETE FROM productos WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':cod_prod', $cod_prod);

        return $statement->execute();
    }
}
?>