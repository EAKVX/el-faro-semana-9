<?php
class Comentario {
    public static function guardar($articulo_id, $usuario_id, $comentario) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_insertar_comentario(?, ?, ?)";
        return $conexion->insertar($sql, [$articulo_id, $usuario_id, $comentario]);
    }

    public static function obtenerPorArticulo($articulo_id) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_obtener_comentarios_articulo(?)";
        return $conexion->consultar($sql, [$articulo_id]);
    }

    public static function eliminar($id_comentario) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "DELETE FROM comentarios WHERE id = ?";
        return $conexion->insertar($sql, [$id_comentario]);
    }
}
?>