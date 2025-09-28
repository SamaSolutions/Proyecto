document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos del DOM
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    const closeBtn = document.getElementById('closeModalBtn'); 

    // 1. Manejo del botón Modificar (Abre el Modal)
    // Usamos delegación de eventos o iteramos sobre todos los botones de la tabla.
    document.querySelectorAll('.btn-modificar').forEach(button => {
        button.addEventListener('click', function() {
            const userData = this.getAttribute('data-user');
            
            try {
                // Parseamos el JSON del usuario que viene del PHP
                const user = JSON.parse(userData);
                
                // Llenar los campos del formulario con datos de Personas
                document.getElementById('editRut').value = user.rut || '';
                document.getElementById('editNombre').value = user.nombre || '';
                document.getElementById('editApellido').value = user.apellido || '';
                document.getElementById('editEmail').value = user.email || '';
                document.getElementById('editLocalidad').value = user.localidad || '';
                document.getElementById('editCalle').value = user.calle || '';
                document.getElementById('editNro').value = user.nro || '';
                
                // Llenar los campos del formulario con datos de Usuarios (perfil)
                document.getElementById('editDescripcion').value = user.descripcion_del_perfil || '';
                document.getElementById('editEspecialidad').value = user.especialidad || '';
                document.getElementById('editExperiencia').value = user.experiencia || '';
                document.getElementById('editDisponibilidad').value = user.disponibilidad || '';
                
                // Actualiza el título del modal y la acción del formulario
                document.getElementById('editRutDisplay').textContent = user.rut;
                form.action = '/admin/usuarios/modificar/' + user.rut;

                // Muestra el modal
                modal.style.display = 'flex';

            } catch (e) {
                console.error("Error al parsear datos del usuario para modificación:", e);
            }
        });
    });

    // 2. Cerrar modal al hacer clic en la X
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    // 3. Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // 4. Manejo del botón Eliminar (Pide confirmación antes de enviar POST)
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function(event) {
            // Previene el envío inmediato del formulario
            event.preventDefault();

            const rut = this.getAttribute('data-rut');
            
            // Pide confirmación al usuario
            if (confirm(`¿Estás seguro de que quieres eliminar al usuario con RUT: ${rut}? Esta acción es irreversible.`)) {
                
                // Si el admin confirma, se busca el formulario POST asociado y se envía.
                const form = document.getElementById(`delete-form-${rut}`);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulario de eliminación no encontrado para el RUT:", rut);
                }
            }
        });
    });
});
