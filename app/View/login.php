<section class="container mt-6 mb-6" style="min-height: 50vh;">
    <div class="columns is-centered">
        <div class="column is-half">
            <h2 class="title has-text-centered">Iniciar Sesión</h2>
            
            <form class="box shadow" action="index.php?action=login" method="POST">
                <div class="field">
                    <label class="label">Usuario (Correo Electrónico)</label>
                    <div class="control">
                        <input class="input" type="text" name="email" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" name="password" placeholder="********" required>
                    </div>
                </div>

                <div class="field mt-5">
                    <div class="control">
                        <button class="button is-dark is-fullwidth" type="submit">Ingresar</button>
                    </div>
                </div>
            </form>

            <div class="has-text-centered mt-4">
                <p class="has-text-grey">¿No tienes cuenta? <a href="index.php?action=registrar" class="has-text-link">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</section>