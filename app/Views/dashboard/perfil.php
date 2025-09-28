<div class="perfil-container">
    <h1>Mi Perfil</h1>

    <div class="valoracion-box">
        <h2>Valoración Promedio</h2>
        <p class="valoracion-display"><?= htmlspecialchars($valoracionPromedio) ?> / 5.00</p>
        <small>Esta puntuación se calcula automáticamente en base a las reseñas.</small>
    </div>

    <hr>

    <form action="/perfil" method="POST" class="perfil-form">
        
        <div class="form-group">
            <label for="descripcion">Descripción del Perfil:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($datos['descripcion_del_perfil']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="especialidad">Especialidad (Ej: Fontanería, Electricidad):</label>
            <input type="text" id="especialidad" name="especialidad" 
                   value="<?= htmlspecialchars($datos['especialidad']) ?>" required>
        </div>

        <div class="form-group">
            <label for="experiencia">Experiencia (Años o Nivel):</label>
            <input type="text" id="experiencia" name="experiencia" 
                   value="<?= htmlspecialchars($datos['experiencia']) ?>" required>
        </div>

        <div class="form-group">
            <label for="disponibilidad">Disponibilidad (Horarios, Días):</label>
            <input type="text" id="disponibilidad" name="disponibilidad" 
                   value="<?= htmlspecialchars($datos['disponibilidad']) ?>" required>
        </div>

        <button type="submit" class="btn-guardar">Guardar Cambios</button>
    </form>
</div>
