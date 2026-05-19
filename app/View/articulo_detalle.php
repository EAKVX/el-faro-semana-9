<div class="container mt-5 mb-6">
    <div class="box shadow">
        <span class="tag is-info is-light mb-2"><?= htmlspecialchars(strtoupper(str_replace('_', ' ', $articulo['seccion']))) ?></span>
        <h1 class="title is-2"><?php echo htmlspecialchars($articulo['titulo']); ?></h1>
        <p class="subtitle is-6 has-text-grey">
            📅 Publicado el: <?php echo date('d M Y H:i', strtotime($articulo['fecha_publicacion'])); ?>
        </p>
        <hr>
        <div class="content is-medium">
            <?php echo nl2br(htmlspecialchars($articulo['descripcion'])); ?>
        </div>
        <hr>            
            <?php if (!empty($articulo['enlace_origen'])): ?>
                <div class="mt-5">
                    <a href="<?php echo htmlspecialchars($articulo['enlace_origen']); ?>" target="_blank" class="button is-link is-light">
                        <span class="icon">🔗</span>
                        <span>Leer noticia original</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <h3 class="title is-4 mt-6">💬 Comentarios</h3>

    <?php if (count($comentarios) > 0): ?>
        <?php foreach ($comentarios as $comentario): ?>
            <div class="box">
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><?php echo htmlspecialchars($comentario['nombre']); ?></strong> 
                                <small class="has-text-grey ml-2"><?php echo date('d/m/Y H:i', strtotime($comentario['fecha'])); ?></small>
                                <br>
                                <?php echo nl2br(htmlspecialchars($comentario['comentario'])); ?>
                            </p>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <div class="media-right">
                            <a href="index.php?action=eliminar_comentario&id_comentario=<?php echo $comentario['id']; ?>&id_articulo=<?php echo $articulo['id']; ?>" class="button is-danger is-small is-outlined" onclick="return confirm('¿Eliminar este comentario permanentemente?');">
                                Eliminar
                            </a>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notification is-light">No hay comentarios aún. ¡Sé el primero en opinar!</div>
    <?php endif; ?>

    <div class="box mt-5 has-background-white-ter">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <form action="index.php?action=comentar" method="POST">
                <input type="hidden" name="articulo_id" value="<?php echo $articulo['id']; ?>">
                <div class="field">
                    <label class="label">Deja tu comentario como <span class="has-text-link"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span></label>
                    <div class="control">
                        <textarea class="textarea" name="comentario" placeholder="Escribe tu opinión sobre esta noticia..." rows="3" required></textarea>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-dark" type="submit">Publicar Comentario</button>
                </div>
            </form>
        <?php else: ?>
            <div class="has-text-centered">
                <p>Debes <a href="index.php?action=login" class="has-text-link has-text-weight-bold">iniciar sesión</a> o <a href="index.php?action=registrar" class="has-text-link has-text-weight-bold">registrarte</a> para poder comentar.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
