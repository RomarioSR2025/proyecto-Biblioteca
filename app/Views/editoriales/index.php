<?= $header; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Lista de Editoriales</h3>
    <a href="<?= base_url('editoriales/crear'); ?>" class="btn btn-primary">Registrar Nueva Editorial</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Empresa</th>
        <th>Nacionalidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($editoriales)): ?>
        <?php foreach ($editoriales as $e): ?>
          <tr>
            <td><?= $e['ideditorial']; ?></td>
            <td><?= $e['empresa']; ?></td>
            <td><?= $e['nacionalidad']; ?></td>
            <td>
              <a href="<?= base_url('editoriales/editar/'.$e['ideditorial']); ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="<?= base_url('editoriales/eliminar/'.$e['ideditorial']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro de eliminar esta editorial?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center">No hay editoriales registradas</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $footer; ?>
