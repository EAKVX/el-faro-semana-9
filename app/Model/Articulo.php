<?php
class Articulo {
    private $id;
    private $titulo;
    private $descripcion;
    private $seccion;
    private $fecha_Publicacion;
    private $enlace_origen;

    public function __construct($id, $titulo, $descripcion, $seccion, $fecha_Publicacion, $enlace_origen = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->seccion = $seccion;
        $this->fecha_Publicacion = $fecha_Publicacion;
        $this->enlace_origen = $enlace_origen;
    }

    public function guardar() {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_insertar_articulo(?, ?, ?, ?, ?)";
        return $conexion->insertar($sql, [$this->titulo, $this->descripcion, $this->seccion, $this->fecha_Publicacion, $this->enlace_origen]);
    }

    public static function obtenerRecientes($limite) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_obtener_recientes(?)";
        return $conexion->consultar($sql, [(int)$limite]);
    }

    public static function obtenerPorSeccionExcluyendo($seccion, $ids_excluidos = []) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        
        // Convertimos el arreglo de IDs a un string separado por comas (Ej: "1,2,5")
        // para que el procedimiento almacenado lo procese con FIND_IN_SET
        $ids_string = !empty($ids_excluidos) ? implode(',', $ids_excluidos) : '';
        
        $sql = "CALL sp_obtener_por_seccion_excluyendo(?, ?)";
        return $conexion->consultar($sql, [$seccion, $ids_string]);
    }

    public static function obtenerPorId($id) {
        require_once __DIR__ . '/../../Config/Conexion.php';
        $conexion = new Conexion();
        $sql = "CALL sp_obtener_articulo_por_id(?)";
        $resultado = $conexion->consultar($sql, [(int)$id]);
        return !empty($resultado) ? $resultado[0] : null;
    }
}
?>
