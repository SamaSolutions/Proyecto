document.addEventListener('DOMContentLoaded', () => {
    const ratingComponent = document.getElementById('rating-component');
    if (!ratingComponent) return; // Salir si el componente no existe

    const starsContainer = ratingComponent.querySelector('.stars-container');
    const allStars = starsContainer.querySelectorAll('.star'); // Seleccionar todas las estrellas
    const submitButton = document.getElementById('submit-rating');
    const currentRatingSpan = document.getElementById('current-rating');
    const ratingMessage = document.getElementById('rating-message');
    
    // Las variables de chat (CONVERSACION_ID, MI_RUT, TARGET_RUT) se obtienen de la vista PHP.

    let selectedRating = parseFloat(starsContainer.dataset.currentRating) || 0; // Iniciar con calificación actual si existe

    // --- Funciones de Resaltado ---
    function highlightStars(ratingToHighlight) {
        allStars.forEach(star => {
            if (parseFloat(star.dataset.rating) <= ratingToHighlight) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        currentRatingSpan.textContent = ratingToHighlight.toFixed(1);
    }

    // --- Inicializar estado ---
    highlightStars(selectedRating);
    submitButton.disabled = selectedRating === 0;

    // --- Eventos de Interacción ---
    starsContainer.addEventListener('mouseover', (e) => {
        if (e.target.classList.contains('star')) {
            const hoverRating = parseFloat(e.target.dataset.rating);
            highlightStars(hoverRating);
        }
    });

    starsContainer.addEventListener('mouseleave', () => {
        highlightStars(selectedRating); // Vuelve a la calificación seleccionada
    });

    starsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('star')) {
            selectedRating = parseFloat(e.target.dataset.rating);
            highlightStars(selectedRating);
            submitButton.disabled = false; // Habilitar el botón al seleccionar
        }
    });

    // --- Enviar calificación al servidor ---
    submitButton.addEventListener('click', () => {
        if (selectedRating > 0 && TARGET_RUT) {
            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';
            ratingMessage.textContent = ''; // Limpiar mensajes anteriores

            fetch('/api/calificar/vendedor', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    rut_vendedor: TARGET_RUT,
                    rut_comprador: MI_RUT,
                    rating: selectedRating,
                    conversacion_id: CONVERSACION_ID 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    ratingMessage.textContent = '✅ Calificación enviada con éxito!';
                    ratingMessage.style.color = 'green';
                    starsContainer.style.pointerEvents = 'none'; // Desactivar interacción
                    submitButton.style.display = 'none'; // Ocultar botón
                } else {
                    ratingMessage.textContent = `❌ Error: ${data.message || 'Inténtalo de nuevo.'}`;
                    ratingMessage.style.color = 'red';
                    submitButton.disabled = false;
                    submitButton.textContent = 'Enviar Calificación';
                }
            })
            .catch(error => {
                ratingMessage.textContent = '❌ Error de conexión.';
                ratingMessage.style.color = 'red';
                submitButton.disabled = false;
                submitButton.textContent = 'Enviar Calificación';
                console.error('Error al enviar calificación:', error);
            });
        }
    });
});
