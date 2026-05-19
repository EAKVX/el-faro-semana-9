<section class="container mt-6">
    <div class="columns is-centered">
        <div class="column is-two-thirds-tablet is-half-desktop">
            <div class="box shadow">
                <h2 class="title has-text-centered">📰 Redactar Nuevo Artículo</h2>
                <hr>
                
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <form action="index.php?action=nuevo_articulo" method="POST">
                    <div class="field">
                        <label class="label">Título de la Noticia</label>
                        <div class="control">
                            <input class="input" type="text" name="titulo" placeholder="Ej: Avances tecnológicos en Chile" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Contenido / Descripción</label>
                        <div class="control">
                            <textarea class="textarea" name="descripcion" placeholder="Escribe el cuerpo de la noticia aquí..." rows="8" required></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Enlace de la Fuente (Opcional)</label>
                        <div class="control">
                            <input class="input" type="url" name="enlace_origen" placeholder="Ej: https://www.biobiochile.cl/noticia-completa">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Sección</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="seccion" required>
                                    <option value="">Selecciona una sección</option>
                                    <option value="nacional">Nacional</option>
                                    <option value="internacional">Internacional</option>
                                    <option value="negocios">Negocios</option>
                                    <option value="deportes">Deportes</option>
                                    <option value="ciencia_tecnologia">Ciencia y Tecnología</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field is-grouped is-grouped-centered mt-5">
                        <div class="control">
                            <button class="button is-dark is-fullwidth" type="submit">Publicar Artículo</button>
                        </div>
                    </div>
                </form>
                <?php else: ?>
                    <p class="has-text-centered has-text-danger">No tienes permisos para ver este formulario.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>