
const INTERVALO_POLLING = 3000; // 3 segundos
const chatBox = document.getElementById('chat-box');

setInterval(checkNuevosMensajes, INTERVALO_POLLING); 

function checkNuevosMensajes() {
    const url = `/mensajes/check?chat_id=${CONVERSACION_ID}&last_id=${ultimoMensajeId}`;

    fetch(url)
        .then(response => response.json())
        .then(result => {
            
            if (result.status === 'success' && result.data.length > 0) {
                
                result.data.forEach(mensaje => {
                    const esMio = (mensaje.rutRemitente === MI_RUT);
                    const clase = esMio ? 'enviado' : 'recibido';
                    const nombre = esMio ? 'Yo' : mensaje.nombreRemitente;
                    
                    agregarMensajeAlChat(mensaje.contenido, clase, nombre, mensaje.created_at);
                    
                    if (parseInt(mensaje.id) > ultimoMensajeId) {
                        ultimoMensajeId = parseInt(mensaje.id);
                    }
                });
            }
        })
        .catch(error => console.error('Error en el polling:', error));
}


document.getElementById('boton-enviar').addEventListener('click', enviarMensaje);
document.getElementById('input-mensaje').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); 
        enviarMensaje();
    }
});

function enviarMensaje() {
    const inputMensaje = document.getElementById('input-mensaje');
    const contenido = inputMensaje.value.trim();

    if (!contenido) return;

    const ahora = new Date().toISOString();
    agregarMensajeAlChat(contenido, 'enviado', 'Yo', ahora);
    inputMensaje.value = ''; 

    const formData = new URLSearchParams();
    formData.append('conversacion_id', CONVERSACION_ID);
    formData.append('contenido', contenido);

    fetch('/mensajes/enviar', { 
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.new_id) {
                ultimoMensajeId = parseInt(data.new_id);
            }
        } else {
            console.error('Error al guardar mensaje:', data.message);
        }
    })
    .catch(error => console.error('Error de red en el envío:', error));
}


function agregarMensajeAlChat(texto, clase, nombre, timestamp) { 
    const divMensaje = document.createElement('div');
    divMensaje.classList.add('mensaje', clase);
    
    const fecha = new Date(timestamp);
    const hora = fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });

    let contenidoHTML = (clase === 'recibido') ? `<strong>${nombre}:</strong> ${texto}` : texto;

    divMensaje.innerHTML = `${contenidoHTML} <span class="hora">${hora}</span>`;
    chatBox.appendChild(divMensaje);
    
    chatBox.scrollTop = chatBox.scrollHeight; 
}
