<?php if(!empty($servicios)): ?>
<h1>Lista de Servicios</h1>

  <?php foreach($servicios as $servicio): ?>
    <form action="/mensajes/iniciar" method="POST" class="servicios-chat-form">
    <div class="servicio">
      <h3><strong>Categoria:</strong> <?= htmlspecialchars($_GET['categoria']) ?></h3>
      <p><strong>Tipo:</strong> <?= htmlspecialchars($servicio['tipo']) ?></p>
       <p><strong>Descripcion:</strong> <?= htmlspecialchars($servicio['descripcion']) ?></p>
       <p><strong>Duracion:</strong> <?= htmlspecialchars($servicio['duracion']) ?></p>
      <p><strong>Precio Estimado:</strong> <?= number_format($servicio['precio_estimado'], 2, ',', '.') ?></p>
      <p class="razon-social"><strong>Dueño Del Servicio:</strong> <?= htmlspecialchars($servicio['nombre']) ?></p>
    
     <input type="hidden" 
                   name="rutDestinatario" 
                   value="<?= htmlspecialchars($servicio['rutVendedor']); ?>">
            
            <input type="hidden" 
                   name="idServicio" 
                   value="<?= htmlspecialchars($servicio['IdServicio']); ?>">
            
            <input type="hidden" 
                   name="categoria" 
                   value="<?= htmlspecialchars($_GET['categoria']); ?>">

            <input type="hidden" 
                   name="nombre" 
                   value="<?= htmlspecialchars($servicio['tipo']); ?>">
  
            <input type="hidden" 
                   name="descripcion" 
                   value="<?= htmlspecialchars($servicio['descripcion']); ?>">

            <input type="hidden" 
                   name="precio_estimado" 
                   value="<?= htmlspecialchars($servicio['precio_estimado']); ?>">
            
            <input type="hidden" 
                   name="razon_social" 
                   value="<?= htmlspecialchars($servicio['nombre']); ?>"> 
             
            <button type="submit" class="btn-iniciar-chat">Contactar</button>
            
    </div>
 </form>
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
<?php else: ?>
<h1><span>No hay servicios aun para esta <a href="/explorar">categoria</a>.<span></h1>
<?php endif; ?>
