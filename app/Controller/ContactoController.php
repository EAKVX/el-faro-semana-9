<?php
require_once __DIR__ . '/../Model/Contacto.php';

class ContactoController {
    public function procesar() {
        // Verificar si el formulario ha sido enviado
        /*Request_Method es una variable de servidor que contiene el método HTTP utilizado para acceder a la página (por ejemplo, GET, POST, etc.).
        En este caso, se verifica si el método es POST, lo que indica que el formulario ha sido enviado.*/
        /*POST=> se utiliza para enviar datos al servidor, generalmente a través de un formulario. 
        Cuando un formulario se envía utilizando el método POST, 
        los datos del formulario se incluyen en el cuerpo de la solicitud HTTP y no son visibles en la URL.*/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $mensaje = trim($_POST['mensaje'] ?? '');
            // Validar que los campos no estén vacíos
            if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
                // Guardar el mensaje utilizando el modelo Contacto
                Contacto::guardar($nombre, $email, $mensaje);
                // Mostrar un mensaje de éxito al usuario
                echo "<div class='notification is-success has-text-centered mt-4 container'>Gracias $nombre, hemos guardado tu mensaje correctamente.</div>";
            }
        }
    }
}
?>