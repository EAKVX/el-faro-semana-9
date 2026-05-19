<?php
// 1. Iniciamos la sesión para poder comprobar los roles en toda la web
session_start();

// 2. Cargamos el controlador de usuario que maneja los registros y el login
require_once __DIR__ . '/../app/Controller/UsuarioController.php';

// 3. Cargamos el Header (El menú de navegación siempre visible)
require_once __DIR__ . '/../app/View/Layout/header.php';

// 4. Capturamos la acción de la URL. Si no hay acción, por defecto es 'inicio' (las noticias)
$action = $_GET['action'] ?? 'inicio';

// 5. El Switch decide qué vista cargar en el medio de la página
switch ($action) {
    case 'login':
        $uc = new UsuarioController();
        $uc->procesarLogin();
        require_once '../app/View/login.php'; // Solo carga el formulario si clickeas el botón
        break;

    case 'logout':
        require_once '../app/Model/Login.php';
        Login::cerrar(); 
        header("Location: index.php");
        exit;

    case 'registrar':
        $usuarioController = new UsuarioController();
        $usuarioController->registrar();
        require_once '../app/View/registro.php';
        break;
        
    case 'nuevo_articulo':
        require_once '../app/Controller/ArticuloController.php';
        $articuloController = new ArticuloController();
        $articuloController->procesarNuevoArticulo();
        require_once '../app/View/nuevo_articulo.php';
        break;

    case 'ver_articulo':
        require_once '../app/Controller/ArticuloController.php';
        $ac = new ArticuloController();
        $ac->verArticulo($_GET['id'] ?? 0);
        break;

    case 'comentar':
        if(isset($_SESSION['usuario_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/Model/Comentario.php';
            Comentario::guardar($_POST['articulo_id'], $_SESSION['usuario_id'], $_POST['comentario']);
            header("Location: index.php?action=ver_articulo&id=" . $_POST['articulo_id']);
        } else {
            echo "<div class='notification is-warning container mt-5'>Debes iniciar sesión para comentar.</div>";
        }
        break;

    case 'contacto':
        require_once '../app/Controller/ContactoController.php';
        $contactoController = new ContactoController();
        $contactoController->procesar();
        require_once '../app/View/contacto.php';
        break;

    case 'usuarios':
        $usuarioController = new UsuarioController();
        $usuarios = $usuarioController->listarUsuarios();
        require_once '../app/View/lista_usuario.php';
        break;

    case 'eliminar_comentario':
        // Validación estricta: Solo el rol 'admin' puede ejecutar esta acción
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            if (isset($_GET['id_comentario']) && isset($_GET['id_articulo'])) {
                require_once '../app/Model/Comentario.php';
                Comentario::eliminar($_GET['id_comentario']);
                // Redirigimos de vuelta al mismo artículo para ver el cambio instantáneo
                header("Location: index.php?action=ver_articulo&id=" . $_GET['id_articulo']);
                exit;
            }
        } else {
            echo "<div class='notification is-danger container mt-5'>Acceso denegado. No tienes permisos para esta acción.</div>";
        }
        break;    
        
    default:
        // EL CASO POR DEFECTO: Si entras a la web limpia, carga las noticias.
        require_once '../app/Controller/ArticuloController.php';
        $articuloController = new ArticuloController();
        $datos = $articuloController->index();
        extract($datos);
        
        // Carga la vista de inicio. Asegúrate de que tu archivo inicio.php NO tenga el código del formulario login.
        require_once '../app/View/inicio.php'; 
        break;
}

// 6. Cargamos el Footer (siempre visible al final)
require_once '../app/View/Layout/footer.php';
?>