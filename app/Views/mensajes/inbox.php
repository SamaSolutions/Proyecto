<div class="inbox-container">
    <h2>Bandeja de Entrada</h2>

    <?php if (empty($conversaciones)): ?>
        <p>Aún no tienes conversaciones activas.</p>
    <?php else: ?>
        <ul class="lista-conversaciones">
            <?php foreach ($conversaciones as $conv): ?>
                <?php
                    // 1. CREACIÓN DEL ENLACE AL CHAT
                    // Define la URL usando el ID de la conversación
                    $chatUrl = "/mensajes/chat/{$conv['id']}";
                    
                    // 2. FORMATEO DE LA HORA
                    // Formatea la hora de la última actividad (updated_at)
                    $hora = date('d/m/Y H:i', strtotime($conv['updated_at']));
                ?>
                
                <li class="conversacion-item">
                    <a href="<?= $chatUrl ?>">
                        <div class="chat-info">
                            <strong>Chat con: <?= htmlspecialchars($conv['otroNombre']) ?></strong>
                            <span class="fecha-ultima-actividad"><?= $hora ?></span>
                        </div>
                        <p class="resumen-mensaje">Toca para ver el historial.</p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
