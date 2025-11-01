<div class="chat-page-layout">

    <div class="service-details-panel">
        <div class="service-info-inner"> <h3>Detalles del Servicio</h3>
            
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($servicio['nombre'] ?? 'N/A'); ?></p>
            <p><strong>Precio:</strong> $<?php echo number_format($servicio['precio'] ?? 0, 0, ',', '.'); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($servicio['categoria'] ?? 'N/A'); ?></p>
            <p><strong>Duración:</strong> <?php echo htmlspecialchars($servicio['duracion'] ?? 'N/A'); ?></p>
            <p><strong>Descripción:</strong></p>
            <p class="description-text"><?php echo nl2br(htmlspecialchars($servicio['descripcion'] ?? 'Sin descripción.')); ?></p>
            
            <hr>

            <h4>Calificar al Vendedor</h4>
            <div id="rating-component" data-target-rut="<?php echo htmlspecialchars($rutDestinatario ?? ''); ?>">
                <div class="stars-container" data-current-rating="0"> <?php for ($i = 0.5; $i <= 5.0; $i += 0.5): ?>
                        <span class="star" data-rating="<?php echo $i; ?>">★</span>
                    <?php endfor; ?>
                </div>
                <p>Tu calificación: <span id="current-rating">0.0</span> / 5</p>
                <button id="submit-rating" disabled>Enviar Calificación</button>
                <div id="rating-message" style="margin-top: 10px;"></div>
            </div>
            
        </div>
    </div>
    
    <div class="chat-main-panel">
        <div class="chat-container">
            <h2>Chat con <?php echo htmlspecialchars($servicio['dueño']); ?></h2>

            <div id="chat-box">
                <?php foreach ($historial as $mensaje): ?>
                    <?php
                        $esMio = ($mensaje['rutRemitente'] == $miRut);
                        $clase = $esMio ? 'enviado' : 'recibido';
                        $nombre = $esMio ? 'Yo' : htmlspecialchars($mensaje['nombreRemitente'] ?? 'Usuario');
                        $hora = date('H:i', strtotime($mensaje['created_at']));
                    ?>
                    <div class="mensaje <?php echo $clase; ?>">
                        <?php if (!$esMio): ?>
                            <strong><?php echo $nombre; ?>:</strong>
                        <?php endif; ?>
                        <?php echo htmlspecialchars($mensaje['contenido']); ?>
                        <span class="hora"><?php echo $hora; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="chat-input">
                <input type="text" id="input-mensaje" placeholder="Escribe tu mensaje..." autocomplete="off">
                <button id="boton-enviar">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const CONVERSACION_ID = <?php echo json_encode($conversacion_id); ?>; 
    const MI_RUT = <?php echo json_encode($miRut); ?>; 
    let ultimoMensajeId = <?php echo json_encode($ultimoId); ?>; 
    const TARGET_RUT = '<?php echo htmlspecialchars($rutDestinatario ?? ''); ?>';
</script>

<script src="/js/chat.js"></script>
<script src="/js/rating.js"></script>

