<h1>Lista de Servicios</h1>

  <?php foreach($servicios as $servicio): ?>
    <a class="servicio" href="/compra">
      <h3><strong>Categoria:</strong> <?= htmlspecialchars($servicio['categoria']) ?></h3>
      <p><strong>Tipo:</strong> <?= htmlspecialchars($servicio['tipo']) ?></p>
       <p><strong>Descripcion:</strong> <?= htmlspecialchars($servicio['descripcion']) ?></p>
       <p><strong>Duracion:</strong> <?= htmlspecialchars($servicio['duracion']) ?></p>
      <p><strong>Precio Estimado:</strong> <?= number_format($servicio['precio_estimado'], 2, ',', '.') ?></p>
      <p class="razon-social"><strong>Razón Social:</strong> <?= htmlspecialchars($servicio['razon_social']) ?></p>
    </a>
  <?php endforeach; ?> 
