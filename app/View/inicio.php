<section id="inicio" class="section container">
    <h2 class="title is-3 has-text-dark mb-5" style="border-bottom: 2px solid #363636; padding-bottom: 10px;">Últimas Noticias</h2>
    <div class="columns is-multiline">
        <?php if (!empty($recientes)): ?>
            <?php foreach ($recientes as $articulo): ?>
                <div class="column is-4">
                    <div class="card" style="border-radius: 8px; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column;">
                        <div class="card-content" style="flex-grow: 1;">
                            <span class="tag is-info is-light mb-3"><?= htmlspecialchars(strtoupper(str_replace('_', ' ', $articulo['seccion']))) ?></span>
                            
                            <p class="title is-5"><a href="index.php?action=ver_articulo&id=<?= $articulo['id'] ?>" class="has-text-black"><?= htmlspecialchars($articulo['titulo']) ?></a></p>
                            
                            <div class="content has-text-grey-dark mt-2 is-size-6">
                                <?= htmlspecialchars(substr($articulo['descripcion'], 0, 120)) ?>...
                            </div>
                            
                            <p class="is-size-7 has-text-grey mt-3">
                                📅 Publicado el: <?= date('d/m/Y', strtotime($articulo['fecha_publicacion'])) ?>
                            </p>
                        </div>
                        <footer class="card-footer">
                            <a href="index.php?action=ver_articulo&id=<?= $articulo['id'] ?>" class="card-footer-item has-text-link">Leer completo</a>
                        </footer>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="column is-12">
                <div class="notification is-warning has-text-centered">
                    Aún no hay noticias publicadas. ¡Sé el primero en escribir una!
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="columns mt-5 is-vcentered">
        <div class="column is-half">
            <div class="box has-background-white-ter" style="border-radius: 8px;">
                <h3 class="title is-5 mb-4 has-text-grey-dark">🎥 Reportaje Especial</h3>
                <figure class="image is-16by9">
                    <video controls class="has-ratio" style="border-radius: 6px;">
                        <source src="assets/video/video_web.mp4" type="video/mp4">
                    </video>
                </figure>
            </div>
        </div>
        <div class="column is-half">
            <div class="box has-background-white-ter" style="border-radius: 8px; height: 100%;">
                <h3 class="title is-5 mb-4 has-text-grey-dark">🎙️ Podcast El Faro</h3>
                <audio controls style="width: 100%; margin-top: 10px;">
                    <source src="assets/audio/El_Faro_audio.mp3" type="audio/mp3">
                </audio>
                <p class="mt-4 is-size-6 has-text-grey">Escucha nuestro resumen semanal. Actualidad, debates y entrevistas con los protagonistas de la semana.</p>
            </div>
        </div>
    </div>
</section>

<?php foreach ($articulos_secciones as $nombre_seccion => $articulos_sec): ?>
    <?php if(!empty($articulos_sec)): ?>
        <section id="<?= htmlspecialchars($nombre_seccion) ?>" class="section container mt-4">
            <h2 class="title is-3 has-text-dark mb-5" style="border-bottom: 2px solid #363636; padding-bottom: 10px;">
                <?= ucfirst(str_replace('_', ' ', htmlspecialchars($nombre_seccion))) ?>
            </h2>
            <div class="columns is-multiline">
                <?php foreach ($articulos_sec as $art): ?>
                    <div class="column is-4">
                        <div class="card" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%; display: flex; flex-direction: column;">
                            <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <p class="title is-5 mb-2"><?= htmlspecialchars($art['titulo']) ?></p>
                                    <p class="content is-small has-text-grey mb-4"><?= htmlspecialchars(substr($art['descripcion'], 0, 100)) ?>...</p>
                                </div>
                                <a href="index.php?action=ver_articulo&id=<?= $art['id'] ?>" class="button is-dark is-outlined is-small is-fullwidth mt-2">Leer artículo</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>