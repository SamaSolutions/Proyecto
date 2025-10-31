document.addEventListener('DOMContentLoaded', function() {
    const bell = document.getElementById('notification-bell');
    const dropdown = document.getElementById('notification-dropdown');
    const list = document.getElementById('notification-list');
    const badge = document.getElementById('unread-count');
    const verMasLink = document.querySelector('.notification-dropdown .ver-mas');
    
    if (!bell || !dropdown || !list || !badge) {
        return;
    }
    
    bell.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) {
            // Cuando se abre, se recargan los datos
            fetchNotifications(); 
        }
    });

    document.addEventListener('click', function(e) {
        if (!dropdown.classList.contains('hidden') && 
            !bell.contains(e.target) && 
            !dropdown.contains(e.target)) 
        {
            dropdown.classList.add('hidden');
        }
    });

    function fetchNotifications() {
        fetch('/api/notificaciones/recientes')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    renderNotifications(data.notificaciones);
                    updateBadge(data.conteo_no_leidas);
                }
            })
            .catch(error => console.error('Error al obtener notificaciones:', error));
    }

    function renderNotifications(notifications) {
        list.innerHTML = ''; // Limpia la lista actual

        if (notifications.length === 0) {
            const fallbackItem = document.createElement('li');
            fallbackItem.innerHTML = `<a href="${verMasLink.href}" style="text-align:center; color:#6c757d;">No hay notificaciones recientes.</a>`;
            list.appendChild(fallbackItem);
            return;
        }

        notifications.forEach(notif => {
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            
            link.href = notif.url || '#'; // Enlaza a la URL (ej: /mensajes/chat/45)
            link.textContent = notif.contenido;
            link.dataset.id = notif.id; // Guarda el ID para marcar como leída

            if (notif.leida === 0) {
                link.classList.add('notificacion-no-leida');
                link.addEventListener('click', handleNotificationClick);
            }

            listItem.appendChild(link);
            list.appendChild(listItem);
        });
    }

    function updateBadge(count) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }
    
    function handleNotificationClick(event) {
        event.preventDefault(); // Detiene la navegación temporalmente
        const link = event.currentTarget;
        const notifId = link.dataset.id;
        
        fetch('/api/notificaciones/marcar-leida', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ id: notifId })
        })
        .then(() => {
             window.location.href = link.href;
        })
        .catch(error => {
            console.error("Error al marcar como leída:", error);
            window.location.href = link.href;
        });
    }

    fetchNotifications();
    setInterval(fetchNotifications, 60000); 
});
