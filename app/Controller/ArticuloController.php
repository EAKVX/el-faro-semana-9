<?php
require_once __DIR__ . '/../Model/Articulo.php';

class ArticuloController {
    
    public function index() {
        $recientes = Articulo::obtenerRecientes(3);
        $ids_excluidos = array_column($recientes, 'id');
        
        $secciones = ['nacional', 'internacional', 'negocios', 'deportes', 'ciencia_tecnologia'];
        $articulos_secciones = [];
        
        foreach ($secciones as $sec) {
            $articulos_secciones[$sec] = Articulo::obtenerPorSeccionExcluyendo($sec, $ids_excluidos);
        }

        return [
            'recientes' => $recientes,
            'articulos_secciones' => $articulos_secciones
        ];
    }

    public function verArticulo($id) {
        require_once __DIR__ . '/../Model/Comentario.php'; // Cargamos el modelo de Comentarios para obtener los comentarios del artículo
        $articulo = Articulo::obtenerPorId($id); // Obtenemos el artículo por su ID
        $comentarios = Comentario::obtenerPorArticulo($articulo['id']); // Obtenemos los comentarios relacionados al artículo
        if($articulo) { // Verificamos que el artículo exista
            require_once '../app/View/articulo_detalle.php'; // Cargamos la vista de detalle del artículo
        }
        else {
            echo "<div class='notification is-danger container mt-5'>Artículo no encontrado.</div>"; 
        }
    }

    public function procesarNuevoArticulo() {
        // Validación de seguridad para que solo el admin pueda crear noticias
        if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            echo "<div class='notification is-danger has-text-centered mt-4 container'>Acceso denegado. Solo los administradores pueden publicar.</div>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $seccion = trim($_POST['seccion'] ?? '');
            $enlace_origen = trim($_POST['enlace_origen'] ?? '');
            
            if (!empty($titulo) && !empty($descripcion) && !empty($seccion)) {  
                $fechaPublicacion = date('Y-m-d H:i:s');
                $articulo = new Articulo(null, $titulo, $descripcion, $seccion, $fechaPublicacion, $enlace_origen);

                if ($articulo->guardar()) {
                    echo "<div class='notification is-success has-text-centered mt-4 container'>¡Éxito! El artículo ha sido publicado correctamente.</div>";
                } else {
                    echo "<div class='notification is-danger has-text-centered mt-4 container'>Error al guardar el artículo.</div>";
                }
            }
        }
    }
}
?>