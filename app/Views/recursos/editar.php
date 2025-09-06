<?= $header; ?>

<div class="container mt-4">
  <h3>Editar Recurso</h3>

  <?php if(isset($recurso) && $recurso): ?>
  <form action="<?= base_url('recursos/actualizar/' . ($recurso['idrecurso'] ?? '')); ?>" 
        method="post" enctype="multipart/form-data" class="mt-3">

    <!-- Título -->
    <div class="mb-3">
      <label for="titulo" class="form-label">Título del libro</label>
      <input type="text" name="titulo" id="titulo" class="form-control" 
             value="<?= esc($recurso['titulo'] ?? ''); ?>" required>
    </div>

    <!-- Editorial -->
    <div class="mb-3">
      <label for="ideditorial" class="form-label">Editorial</label>
      <select name="ideditorial" id="ideditorial" class="form-select" required>
        <?php foreach($editoriales as $e): ?>
          <option value="<?= $e['ideditorial']; ?>"
            <?= (isset($recurso['ideditorial']) && $recurso['ideditorial'] == $e['ideditorial']) ? 'selected' : ''; ?>>
            <?= $e['empresa'] ?? ''; ?> (<?= $e['nacionalidad'] ?? ''; ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Categoría -->
    <div class="mb-3">
      <label for="idcategoria" class="form-label">Categoría</label>
      <select name="idcategoria" id="idcategoria" class="form-select" required>
        <?php foreach($categorias as $c): ?>
          <option value="<?= $c['idcategoria']; ?>"
            <?= (isset($recurso['idcategoria']) && $recurso['idcategoria'] == $c['idcategoria']) ? 'selected' : ''; ?>>
            <?= $c['nombre'] ?? ''; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Subcategoría -->
    <div class="mb-3">
      <label for="idsubcategoria" class="form-label">Subcategoría</label>
      <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
        <?php foreach($subcategorias as $s): ?>
          <option value="<?= $s['idsubcategoria']; ?>"
            <?= (isset($recurso['idsubcategoria']) && $recurso['idsubcategoria'] == $s['idsubcategoria']) ? 'selected' : ''; ?>>
            <?= $s['nombre'] ?? ''; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Año de publicación -->
    <div class="mb-3">
      <label for="apublicacion" class="form-label">Año de publicación</label>
      <input type="number" name="apublicacion" id="apublicacion" class="form-control"
             value="<?= esc($recurso['apublicacion'] ?? ''); ?>" min="1900" max="<?= date('Y'); ?>" required>
    </div>

    <!-- ISBN -->
    <div class="mb-3">
      <label for="isbn" class="form-label">ISBN</label>
      <input type="text" name="isbn" id="isbn" class="form-control" 
             value="<?= esc($recurso['isbn'] ?? ''); ?>">
    </div>

    <!-- Número de páginas -->
    <div class="mb-3">
      <label for="numpaginas" class="form-label">Número de páginas</label>
      <input type="number" name="numpaginas" id="numpaginas" class="form-control" 
             value="<?= esc($recurso['numpaginas'] ?? ''); ?>" min="1">
    </div>

    <!-- Tipo -->
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="FÍSICO" <?= (isset($recurso['tipo']) && $recurso['tipo'] == 'FÍSICO') ? 'selected' : ''; ?>>Físico</option>
        <option value="DIGITAL" <?= (isset($recurso['tipo']) && $recurso['tipo'] == 'DIGITAL') ? 'selected' : ''; ?>>Digital</option>
      </select>
    </div>

    <!-- Estado -->
    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <select name="estado" id="estado" class="form-select" required>
        <option value="BUENO" <?= (isset($recurso['estado']) && $recurso['estado'] == 'BUENO') ? 'selected' : ''; ?>>Bueno</option>
        <option value="REGULAR" <?= (isset($recurso['estado']) && $recurso['estado'] == 'REGULAR') ? 'selected' : ''; ?>>Regular</option>
        <option value="MALO" <?= (isset($recurso['estado']) && $recurso['estado'] == 'MALO') ? 'selected' : ''; ?>>Malo</option>
      </select>
    </div>

    <!-- Portada -->
    <div class="mb-3">
      <label for="rutaportada" class="form-label">Portada</label>
      <?php if (!empty($recurso['rutaportada'])): ?>
        <div class="mb-2">
          <img src="<?= base_url('uploads/' . $recurso['rutaportada']); ?>" 
               alt="Portada" class="img-thumbnail" style="max-width: 200px;">
        </div>
      <?php endif; ?>
      <input type="file" name="rutaportada" id="rutaportada" class="form-control" accept="image/*">
    </div>

    <!-- Recurso digital -->
    <div class="mb-3">
      <label for="rutarecurso" class="form-label">Archivo (PDF si es digital)</label>
      <?php if (!empty($recurso['rutarecurso'])): ?>
        <p class="text-muted">Archivo actual: <?= $recurso['rutarecurso']; ?></p>
      <?php endif; ?>
      <input type="file" name="rutarecurso" id="rutarecurso" class="form-control" accept="application/pdf">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="<?= base_url('recursos'); ?>" class="btn btn-secondary">Cancelar</a>
  </form>
  <?php else: ?>
    <p>No se encontró el recurso a editar.</p>
  <?php endif; ?>
</div>

<?= $footer; ?>
