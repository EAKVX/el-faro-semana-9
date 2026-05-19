<section class="container mt-5" id="registro">
    <h2 class="title">Registro de Lectores</h2>
    <h3 class="subtitle">Crea tu cuenta para acceder a contenido exclusivo</h3>

    <form class="box" action="index.php?action=registrar" method="POST" style="max-width: 500px; margin: 0 auto;">
        <div class="field">
            <label class="label">Nombre completo</label>
            <div class="control">
                <!--pattern="^[a-zA-Z\s]+$" para permitir solo letras y espacios, evitando números y caracteres especiales en el nombre.-->
                <input class="input" type="text" name="nombre" pattern="^[a-zA-Z\s]+$" placeholder="Ej: Juan Pérez" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Correo Electrónico</label>
            <div class="control">
                <!--pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" para validar un formato básico de correo electrónico, asegurando que contenga caracteres válidos, un símbolo '@' y un dominio.-->
                <input class="input" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="correo@ejemplo.com" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Contraseña</label>
            <label class="label is-small has-text-grey">8 o + caracteres,una letra minúscula, una letra mayúscula, números y un carácter especial.</label>
            <div class="control">
                <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" para validar que la contraseña tenga al menos 8 caracteres, incluyendo una letra minúscula, una letra mayúscula, un número y un carácter especial. Esto ayuda a garantizar que los usuarios creen contraseñas seguras.-->
                <input class="input" type="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" placeholder="********" required>
            </div>
        </div>

        <div class="control">
            <button class="button is-link is-fullwidth" type="submit">Crear Cuenta</button>
        </div>
    </form>
</section>