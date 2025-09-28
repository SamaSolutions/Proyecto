<h1>Lista de Servicios</h1>

  <?php foreach($servicios as $servicio): ?>
    <a class="servicio" href="/compra">
      <h3><strong>Categoria:</strong> <?= htmlspecialchars($_GET['categoria']) ?></h3>
      <p><strong>Tipo:</strong> <?= htmlspecialchars($servicio['tipo']) ?></p>
       <p><strong>Descripcion:</strong> <?= htmlspecialchars($servicio['descripcion']) ?></p>
       <p><strong>Duracion:</strong> <?= htmlspecialchars($servicio['duracion']) ?></p>
      <p><strong>Precio Estimado:</strong> <?= number_format($servicio['precio_estimado'], 2, ',', '.') ?></p>
      <p class="razon-social"><strong>Dueño Del Servicio:</strong> <?= htmlspecialchars($servicio['nombre']) ?></p>
    </a>
  <?php endforeach; ?> 

<div class="paginacion-servicios">
    <?php if ($totalPaginas > 1): ?>
        
        <?php if ($pagina > 1): ?>
            <a href="/servicios?categoria=<?= urlencode($categoria) ?>&pagina=<?= $pagina - 1 ?>" class="paginacion-link">
                &laquo; Anterior
            </a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php 
                // Clase para resaltar la página actual
                $clase_activa = ($i == $pagina) ? 'activo' : '';
            ?>
            <a href="/servicios?categoria=<?= urlencode($categoria) ?>&pagina=<?= $i ?>" class="paginacion-link <?= $clase_activa ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pagina < $totalPaginas): ?>
            <a href="/servicios?categoria=<?= urlencode($categoria) ?>&pagina=<?= $pagina + 1 ?>" class="paginacion-link">
                Siguiente &raquo;
            </a>
        <?php endif; ?>

    <?php endif; ?>
</div>
