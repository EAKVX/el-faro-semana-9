<?php
// Config/Conexion.php
require_once __DIR__ . '/Config.php'; // Incluimos las credenciales

class Conexion {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $conn;
    private $stmt; // Propiedad para manejar las sentencias preparadas

    // Método de conexión (Constructor)
    public function __construct() {
        try {
            // Creamos el DSN (Data Source Name) para PDO.
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            // Establecemos la conexión usando PDO.
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Configuramos PDO para que lance excepciones y use arreglos asociativos.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            die("Error de conexión a la Base de Datos: " . $exception->getMessage());
        }
    }

    // Método encapsulado para Consulta de datos (SELECT)
    public function consultar($sql, $params = []) {
        $this->stmt = $this->conn->prepare($sql); // Preparamos la sentencia.
        $this->stmt->execute($params); // Vinculamos parámetros y ejecutamos.
        return $this->stmt->fetchAll(); // Retornamos el arreglo de resultados.
    }

    // Método encapsulado para Inserción de datos (INSERT)
    public function insertar($sql, $params = []) {
        $this->stmt = $this->conn->prepare($sql); // Preparamos la sentencia.
        return $this->stmt->execute($params); // Ejecutamos y retornamos true/false.
    }
}
?>