<?php

require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../Model/Login.php';

class UsuarioController {

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (!empty($nombre) && !empty($email) && !empty($password)) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                try {
                    // Por defecto, quienes se registran en la web tienen el rol de 'lector'
                    if (Usuario::guardar($nombre, $email, $passwordHash, 'lector')) {
                        echo "<div class='notification is-success has-text-centered mt-4 container'>¡Éxito! El usuario <strong>$nombre</strong> ha sido registrado. Ya puedes iniciar sesión.</div>";
                    }
                } catch (PDOException $e) {
                    // Si el correo ya existe en la BD (campo UNIQUE), saltará esta excepción
                    echo "<div class='notification is-danger has-text-centered mt-4 container'>Error: El correo electrónico ya está registrado.</div>";
                }
            }
        }
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            
            // Verificamos las credenciales en la base de datos
            $usuario = Usuario::autenticar($email, $password);
            
            if($usuario) {
                // Utilizamos nuestra clase abstracta Login para iniciar la sesión
                Login::iniciar($usuario);
                
                header("Location: index.php");
                exit;
            } else {
                echo "<div class='notification is-danger has-text-centered mt-4 container'>Credenciales incorrectas. Verifica tu correo y contraseña.</div>";
            }
        }
    }

    public function listarUsuarios() {
        // Doble validación de seguridad: Bloqueamos la vista si no es administrador
        if(!Login::esAdmin()) {
            echo "<div class='notification is-danger has-text-centered mt-4 container'>Acceso denegado. Esta sección es exclusiva para administradores.</div>";
            return [];
        }
        
        // Si pasa la validación, retorna los usuarios
        return Usuario::obtenerTodos();
    }
}
?>