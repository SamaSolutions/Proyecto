<div class="container mis-servicios-page">
    <h1 class="page-title">Mis Servicios Publicados</h1>
    
    <?php if (empty($servicios)): ?>
        <div class="alert alert-info no-services-alert">
            <p>Aún no has publicado ningún servicio.</p>
            <a href="/publicarServicios" class="btn btn-primary">Publicar mi primer servicio</a>
        </div>
    <?php else: ?>
        <div class="servicios-grid">
            <?php foreach ($servicios as $servicio): ?>
                <div class="tarjeta-servicio-mis-servicios">
                    <h2 class="servicio-titulo"><?= htmlspecialchars($servicio['nombre']) ?></h2>
                    <p class="servicio-descripcion"><?= htmlspecialchars($servicio['descripcion']) ?></p>
                    
                    <div class="servicio-detalles">
                        <span class="detalle-item">Precio estimado: <strong>$<?= number_format($servicio['precio'], 0, ',', '.') ?></strong></span>
                        <span class="detalle-item">Duración: <strong><?= htmlspecialchars($servicio['duracion']) ?></strong></span>
                    </div>
                    <div class="acciones-servicio">
    <a href="/miServicios/editar/<?= $servicio['IdServicio'] ?>" class="btn btn-warning btn-sm">Editar</a>
    
    <form action="/miServicios/eliminar/<?= $servicio['IdServicio'] ?>" method="POST" style="display: inline-block;">
        <button type="submit" class="btn btn-danger btn-sm" 
                onclick="return confirm('¿Seguro que quieres eliminar este servicio? Esta acción es irreversible.');">
            Eliminar
        </button>
    </form>
</div>
                </div>
            <?php endforeach; ?>
        </div>
      <div class="paginacion-servicios">
    <?php if ($totalPaginas > 1): ?>

        <?php if ($pagina > 1): ?>
            <a href="/miServicios?pagina=<?= $pagina - 1 ?>" class="paginacion-link">
                &laquo; Anterior
            </a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php
                $clase_activa = ($i == $pagina) ? 'active' : ''; 
            ?>
            <a href="/miServicios?pagina=<?= $i ?>" class="paginacion-link <?= $clase_activa ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pagina < $totalPaginas): ?>
            <a href="/miServicios?pagina=<?= $pagina + 1 ?>" class="paginacion-link">
                Siguiente &raquo;
            </a>
        <?php endif; ?>

    <?php endif; ?>
</div>
    <?php endif; ?>
</div>
