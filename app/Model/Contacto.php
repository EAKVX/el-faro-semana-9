<?php
class Contacto {
    public static function guardar($nombre, $email, $mensaje) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
     
        // Usamos el procedimiento almacenado
        $sql = "CALL sp_insertar_contacto(?, ?, ?)";
        return $conexion->insertar($sql, [$nombre, $email, $mensaje]);
    }
}
?>