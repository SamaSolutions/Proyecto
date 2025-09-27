<h2 class="titulo-principal">Publica tu Servicio</h2>

<?php if(!empty($mensaje)): ?>
    <p class="mensaje-exito"><?= $mensaje ?></p>
<?php endif; ?>

<form method="POST" class="form-publicar-servicio">
    <label>Nombre del Servicio:</label><br>
    <input type="text" name="nombre" required class="input-text"><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required class="textarea"></textarea><br>

    <label>Precio Estimado:</label><br>
    <input type="number" name="precio" step="0.01" required class="input-text"><br>

    <label>Duración:</label><br>
    <input type="text" name="duracion" required class="input-text"><br>

    <label>Categoría:</label><br>
    <input type="text" name="categoria" required class="input-text"><br>

    <button type="submit" class="btn-publicar">Publicar</button>
</form>
