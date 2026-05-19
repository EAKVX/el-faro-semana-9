<?php
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fechaRegistro;

    public function __construct($id, $nombre, $email, $password, $fechaRegistro) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    public static function guardar($nombre, $email, $passwordHash, $rol = 'lector') {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_insertar_usuario(?, ?, ?, ?)";
        return $conexion->insertar($sql, [$nombre, $email, $passwordHash, $rol]);
    }

    public static function obtenerTodos() {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_obtener_usuarios()";
        return $conexion->consultar($sql);
    }

    public static function autenticar($email, $password) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        
        // Excepción de administrador nativa
        if($email === 'admin' && $password === 'admin') {
            $sql = "CALL sp_obtener_usuario_por_email(?)";
            $resultado = $conexion->consultar($sql, ['admin']);
            return $resultado[0] ?? null;
        }

        $sql = "CALL sp_obtener_usuario_por_email(?)";
        $resultado = $conexion->consultar($sql, [$email]);
        
        if (!empty($resultado)) {
            $usuario = $resultado[0];
            if (password_verify($password, $usuario['password'])) {
                return $usuario;
            }
        }
        return false;
    }
}
