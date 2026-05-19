<section class="container mt-5 mb-6" style="min-height: 50vh;">
    <h2 class="title is-3 has-text-centered">Lectores Registrados</h2>
    
    <div class="box shadow">
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead class="has-background-dark">
                <tr>
                    <th class="has-text-white">ID</th>
                    <th class="has-text-white">Nombre</th>
                    <th class="has-text-white">Correo Electrónico</th>
                    <th class="has-text-white">Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><strong><?= htmlspecialchars($user['nombre']) ?></strong></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($user['fecha_registro'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="has-text-centered">No hay usuarios registrados aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>