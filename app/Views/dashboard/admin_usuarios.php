<div class="admin-container">
    <h1>Administración de Usuarios</h1>

    <?php
    // Muestra mensajes de éxito o error guardados en la sesión
    if (isset($mensaje)): ?>
        <!-- Corregido: Clase 'alerta-' a 'mensaje.' para coincidir con styles.css -->
        <div class="mensaje <?= htmlspecialchars($mensaje['tipo']) ?>">
            <?= htmlspecialchars($mensaje['texto']) ?>
        </div>
    <?php endif; ?>

    <!-- Tabla de Usuarios Existentes -->
    <div class="user-list-card">
        <h2 class="table-title">Listado de Usuarios Registrados</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['rut']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['especialidad'] ?? 'N/A') ?></td>
                    <td class="user-actions">
                        <!-- Botón Modificar (Ahora usa data-user) -->
                        <button type="button" 
                                class="btn-accion btn-modificar"
                                data-user='<?= htmlspecialchars(json_encode($usuario), ENT_QUOTES, 'UTF-8') ?>'>
                            Modificar
                        </button>
                        
                        <!-- Formulario para Eliminar -->
                        <form id="delete-form-<?= $usuario['rut'] ?>" 
                              action="/admin/usuarios/eliminar/<?= $usuario['rut'] ?>" 
                              method="POST" 
                              style="display:inline-block;">
                            <button type="button" 
                                    class="btn-accion btn-eliminar"
                                    data-rut="<?= $usuario['rut'] ?>">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL DE MODIFICACIÓN (HTML/PHP) -->
<!-- Cambiadas IDs para mejor sincronización con JS -->
<!-- ============================================== -->

<!-- ID del Modal corregida a 'editModal' y clase modal-backdrop para el CSS -->
<div id="editModal" class="modal-backdrop">
    <div class="modal-content">
        <!-- ID del botón cerrar corregida a closeModalBtn para JS -->
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Modificar Usuario: <span id="editRutDisplay"></span></h2>
        
        <form id="editForm" method="POST">
            <input type="hidden" name="rut" id="editRut">

            <div class="form-section">
                <h3>Datos Personales</h3>
                <input type="text" name="nombre" id="editNombre" placeholder="Nombre" required>
                <input type="text" name="apellido" id="editApellido" placeholder="Apellido" required>
                <input type="email" name="email" id="editEmail" placeholder="Email" required>
            </div>
            
            <div class="form-section">
                <h3>Datos de Contacto</h3>
                <input type="text" name="localidad" id="editLocalidad" placeholder="Localidad" required>
                <input type="text" name="calle" id="editCalle" placeholder="Calle" required>
                <input type="text" name="nro" id="editNro" placeholder="Número" required>
            </div>

            <div class="form-section">
                <h3>Datos de Perfil</h3>
                <input type="text" name="especialidad" id="editEspecialidad" placeholder="Especialidad">
                <input type="text" name="experiencia" id="editExperiencia" placeholder="Experiencia (Años/Nivel)">
                <input type="text" name="disponibilidad" id="editDisponibilidad" placeholder="Disponibilidad (Horarios)">
                <textarea name="descripcion" id="editDescripcion" placeholder="Descripción de perfil"></textarea>
            </div>

            <button type="submit" class="btn-guardar-modal">Actualizar Cambios</button>
        </form>
    </div>
</div>

<!-- Referencia al JavaScript. Asegúrate de que la ruta sea correcta. -->
<script src="/js/admin_usuarios.js"></script>
