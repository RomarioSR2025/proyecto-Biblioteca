<?= $header; ?>

<div class="container mt-4">
  <h3>Registrar Nuevo Recurso</h3>

  <form action="<?= base_url('recursos/guardar'); ?>" method="post" enctype="multipart/form-data" class="mt-3">

    <!-- Título -->
    <div class="mb-3">
      <label for="titulo" class="form-label">Título del libro</label>
      <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>

    <!-- Editorial -->
    <div class="mb-3">
      <label for="ideditorial" class="form-label">Editorial</label>
      <select name="ideditorial" id="ideditorial" class="form-select" required>
        <option value="">Seleccione una editorial</option>
        <?php foreach($editoriales as $e): ?>
          <option value="<?= $e['ideditorial']; ?>"><?= $e['empresa']; ?> (<?= $e['nacionalidad']; ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Categoría -->
    <div class="mb-3">
      <label for="idcategoria" class="form-label">Categoría</label>
      <select name="idcategoria" id="idcategoria" class="form-select" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach($categorias as $c): ?>
          <option value="<?= $c['idcategoria']; ?>"><?= $c['nombre']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Subcategoría -->
    <div class="mb-3">
      <label for="idsubcategoria" class="form-label">Subcategoría</label>
      <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
        <option value="">Seleccione primero una categoría</option>
        <?php foreach($subcategorias as $s): ?>
          <option value="<?= $s['idsubcategoria']; ?>"><?= $s['nombre']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Año de publicación -->
    <div class="mb-3">
      <label for="apublicacion" class="form-label">Año de publicación</label>
      <input type="number" name="apublicacion" id="apublicacion" class="form-control" min="1900" max="<?= date('Y'); ?>" required>
    </div>

    <!-- ISBN -->
    <div class="mb-3">
      <label for="isbn" class="form-label">ISBN</label>
      <input type="text" name="isbn" id="isbn" class="form-control">
    </div>

    <!-- Número de páginas -->
    <div class="mb-3">
      <label for="numpaginas" class="form-label">Número de páginas</label>
      <input type="number" name="numpaginas" id="numpaginas" class="form-control" min="1">
    </div>

    <!-- Tipo -->
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="FÍSICO">Físico</option>
        <option value="DIGITAL">Digital</option>
      </select>
    </div>

    <!-- Estado -->
    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <select name="estado" id="estado" class="form-select" required>
        <option value="BUENO">Bueno</option>
        <option value="REGULAR">Regular</option>
        <option value="MALO">Malo</option>
      </select>
    </div>

    <!-- Portada con preview -->
    <div class="mb-3">
      <label for="rutaportada" class="form-label">Portada</label>
      <input type="file" name="rutaportada" id="rutaportada" class="form-control" accept="image/*">
      <div class="mt-2">
        <img id="previewPortada" src="" style="display:none; max-width:200px;" class="img-thumbnail" alt="Preview">
      </div>
    </div>

    <!-- Recurso digital -->
    <div class="mb-3">
      <label for="rutarecurso" class="form-label">Archivo (PDF si es digital)</label>
      <input type="file" name="rutarecurso" id="rutarecurso" class="form-control" accept="application/pdf">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="<?= base_url('recursos'); ?>" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<script>
document.getElementById('rutaportada').addEventListener('change', function(){
  const preview = document.getElementById('previewPortada');
  const file = this.files[0];
  if (!file) { preview.style.display='none'; preview.src=''; return; }
  const reader = new FileReader();
  reader.onload = e => { preview.src = e.target.result; preview.style.display='block'; };
  reader.readAsDataURL(file);
});
</script>


<?= $footer; ?>

