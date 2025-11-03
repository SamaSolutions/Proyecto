document.addEventListener('DOMContentLoaded', () => {
    const closeButton = document.getElementById('close-chat-button');
    if (!closeButton) return;

    // --- 1. Obtención Forzada de ID desde el Data-Attribute (Fuente Confiable) ---
    // Si el 'echo' en PHP es correcto, este valor DEBE ser 55.
    let conversacionId = parseInt(closeButton.dataset.conversacionId);

    // 🚨 2. Verificación de ID válida
    if (isNaN(conversacionId) || conversacionId <= 0 || conversacionId === 1) {
        console.error("Fallo crítico: ID incorrecta o inválida en el botón. Valor: " + conversacionId);
        alert("Error de ID. Revise el código fuente del botón. Valor: " + conversacionId);
        closeButton.disabled = true;
        closeButton.textContent = 'Error de ID';
        return;
    }
    
    // Ruta que llama al método de eliminación simple en PHP
    const deleteRoute = '/mensajes/delete-simple/';

    closeButton.addEventListener('click', () => {
        
        if (!confirm('¡ADVERTENCIA! ¿Estás seguro de que deseas ELIMINAR este chat? Esta acción es PERMANENTE.')) {
            return;
        }

        closeButton.disabled = true;
        closeButton.textContent = 'Eliminando...';

        // Redirigir a la ruta GET que ejecuta el DELETE en el servidor
        window.location.href = deleteRoute + conversacionId;
    });
});
