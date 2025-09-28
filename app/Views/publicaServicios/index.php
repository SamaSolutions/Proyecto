<h2 class="titulo-principal">Publica tu Servicio</h2>

<?php if(!empty($mensaje)): ?>
    <p class="mensaje-exito"><?= $mensaje ?></p>
<?php endif; ?>

<form method="POST" class="form-publicar-servicio">
    <label>Nombre del Servicio:</label><br>
    <input type="text" name="nombre" required class="input-text"><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required class="textarea"></textarea><br><br>

    <label>Precio Estimado:</label><br>
    <input type="number" name="precio" step="0.01" required class="input-text"><br><br>

    <label>Duración:</label><br>
    <input type="text" name="duracion" required class="input-text"><br><br>

    <label for="tipo">Categoría:</label><br>
    <select id="tipo" name="tipo" required>
        <option value="">-- Selecciona un Tipo --</option><br>
        </select>
    
    <br><br>

    <label for="categoria">Categoría Específica:</label><br>
    <select id="categoria" name="categoria" disabled required>
        <option value="">Selecciona un Tipo de Servicio primero</option><br>
    </select>
     <br><br>
    <button type="submit" class="btn-publicar">Publicar</button>
</form>

<script src="js/categoria.js"></script>
