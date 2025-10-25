<div class="container editar-servicio-page">
    <h1>Editar Servicio: <?= htmlspecialchars($servicio['nombre']) ?></h1>

    <form action="/miServicios/actualizar/<?= $servicio['IdServicio'] ?>" method="POST" class="form-editar">
        
        <div class="form-group">
            <label for="nombre">Nombre del Servicio</label>
            <input type="text" id="nombre" name="nombre" class="form-control" 
                   value="<?= htmlspecialchars($servicio['nombre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="form-control" required><?= htmlspecialchars($servicio['descripcion']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="precio_estimado">Precio Estimado ($)</label>
            <input type="number" step="0.01" id="precio_estimado" name="precio_estimado" class="form-control" 
                   value="<?= htmlspecialchars($servicio['precio']) ?>" required>
        </div>

        <div class="form-group">
            <label for="duracion">Duración Estimada</label>
            <input type="text" id="duracion" name="duracion" class="form-control" 
                   value="<?= htmlspecialchars($servicio['duracion']) ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="/miServicios" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
