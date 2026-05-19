<?php
class Login {
    
    /**
     * Inicia la sesión de un usuario y guarda sus variables
     */
    public static function iniciar($usuario) {
        // Verificamos si la sesión ya está iniciada para evitar errores
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
    }

    /**
     * Cierra la sesión activa y destruye los datos
     */
    public static function cerrar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Vaciamos el arreglo de sesión y la destruimos
        session_unset();
        session_destroy();
    }

    /**
     * Comprueba si hay un usuario logueado actualmente
     */
    public static function activo() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['usuario_id']);
    }

    /**
     * Comprueba si el usuario logueado tiene el rol de administrador
     */
    public static function esAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
    }
}
?>