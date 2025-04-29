<?php
    class Conexion
    {
        private $host = "localhost";
        private $usuario = "root";
        private $password = "";
        private $db = "2873797_adso";
        private $conexion;

        public function __construct()
        {
            $db_string = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
            try {
                $this->conexion = new PDO($db_string, $this->usuario, $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                echo ("Connection Error");
                die("Connection Error: " . $e->getMessage());
            }
        }

        public function obtenerConexion()
        {
            return $this->conexion;
        }
    }
?>