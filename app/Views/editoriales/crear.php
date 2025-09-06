<?= $header; ?>

<div class="container mt-4">
  <h3>Registrar Nueva Editorial</h3>

  <form action="<?= base_url('editoriales/guardar'); ?>" method="post">

    <!-- Empresa -->
    <div class="mb-3">
      <label for="empresa" class="form-label">Empresa</label>
      <input type="text" name="empresa" id="empresa" class="form-control" required>
    </div>

    <!-- Nacionalidad -->
    <div class="mb-3">
      <label for="nacionalidad" class="form-label">Nacionalidad</label>
      <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="<?= base_url('editoriales'); ?>" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?= $footer; ?>

