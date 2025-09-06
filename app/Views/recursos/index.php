<?= $header; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Lista de Recursos</h3>
    <a href="<?= base_url('recursos/crear'); ?>" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Registrar Nuevo Recurso
    </a>
  </div>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-striped table-hover table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Editorial</th>
          <th>Categoría</th>
          <th>Subcategoría</th>
          <th>Año</th>
          <th>ISBN</th>
          <th>Tipo</th>
          <th>Páginas</th>
          <th>Archivo <i class="bi bi-file-earmark-text"></i></th>
          <th>Estado</th>
          <th>Portada <i class="bi bi-image"></i></th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($recursos)): ?>
          <?php foreach ($recursos as $r): ?>
            <tr class="align-middle">
              <td><?= $r['idrecurso']; ?></td>
              <td class="text-start"><?= $r['titulo']; ?></td>
              <td><?= $r['editorial']; ?> (<?= $r['nacionalidad']; ?>)</td>
              <td><?= $r['categoria']; ?></td>
              <td><?= $r['subcategoria']; ?></td>
              <td><?= $r['apublicacion']; ?></td>
              <td><?= $r['isbn'] ?? '-'; ?></td>
              <td>
                <?php if(isset($r['tipo'])): ?>
                  <span class="badge bg-info text-dark">
                    <i class="bi bi-book"></i> <?= strtoupper($r['tipo']); ?>
                  </span>
                <?php else: ?>
                  -
                <?php endif; ?>
              </td>
              <td><?= $r['numpaginas'] ?? '-'; ?></td>
              <td>
                <?php if (!empty($r['rutarecurso'])): ?>
                  <a href="<?= base_url('uploads/'.$r['rutarecurso']); ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Ver archivo PDF">
                    <i class="bi bi-file-earmark-pdf"></i>
                  </a>
                <?php else: ?>
                  <span class="text-muted"><i class="bi bi-file-earmark"></i></span>
                <?php endif; ?>
              </td>
              <td>
                <?php
                  $estado = $r['estado'] ?? '';
                  $badgeColor = match($estado) {
                    'BUENO' => 'success',
                    'REGULAR' => 'warning',
                    'MALO' => 'danger',
                    default => 'secondary'
                  };
                ?>
                <span class="badge bg-<?= $badgeColor; ?>">
                  <i class="bi bi-circle-fill"></i> <?= $estado ?: '-' ?>
                </span>
              </td>
              <td>
                <?php if (!empty($r['rutaportada'])): ?>
                  <a href="<?= base_url('uploads/'.$r['rutaportada']); ?>" target="_blank">
                    <img src="<?= base_url('uploads/'.$r['rutaportada']); ?>" 
                         alt="Portada" class="img-thumbnail" style="width: 70px; height: auto;">
                  </a>
                <?php else: ?>
                  <span class="text-muted"><i class="bi bi-image"></i></span>
                <?php endif; ?>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-1">
                  <a href="<?= base_url('recursos/editar/'.$r['idrecurso']); ?>" class="btn btn-sm btn-warning" title="Editar">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="<?= base_url('recursos/eliminar/'.$r['idrecurso']); ?>" 
                     class="btn btn-sm btn-danger" title="Eliminar"
                     onclick="return confirm('¿Seguro de eliminar este recurso?');">
                    <i class="bi bi-trash"></i>
                  </a>
                  <?php if (!empty($r['rutarecurso'])): ?>
                    <a href="<?= base_url('uploads/'.$r['rutarecurso']); ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Ver archivo PDF">
                      <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="13" class="text-center text-muted">
              <i class="bi bi-exclamation-circle"></i> No hay recursos registrados
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $footer; ?>
