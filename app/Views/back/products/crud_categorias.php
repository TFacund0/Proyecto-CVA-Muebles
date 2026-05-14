<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">GESTIÓN DE CATEGORÍAS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-5 align-items-center g-4">
    <div class="col-lg-7">
        <div class="d-flex align-items-center gap-3 gap-md-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-tags-fill"></i>
            </div>
            <div>
                <h1 class="display-6 display-md-5 fw-bold text-cva-brown mb-1">Categorías</h1>
                <p class="text-muted mb-0 small"><i class="bi bi-info-circle text-gold me-1"></i> Organización del catálogo de muebles.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-5 text-lg-end">
        <button type="button" class="btn btn-admin-primary rounded-pill px-4 py-2 shadow-gold w-sm-100 justify-content-center" data-bs-toggle="modal" data-bs-target="#modalNuevaCategoria">
            <i class="bi bi-plus-circle-fill me-2"></i> NUEVA CATEGORÍA
        </button>
    </div>
</div>

<!-- Mensajes modularizados -->
<?= view('components/alert_message') ?>

<div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
    <div class="table-responsive-stack">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-brown text-white">
                <tr>
                    <th class="ps-4 py-4 text-gold x-small fw-bold border-0 text-uppercase tracking-widest" style="width: 100px;">ID</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-uppercase tracking-widest">DESCRIPCIÓN</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-center text-uppercase tracking-widest">PRODUCTOS</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-center text-uppercase tracking-widest">ESTADO</th>
                    <th class="pe-4 py-4 text-gold x-small fw-bold border-0 text-center text-uppercase tracking-widest">GESTIÓN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td class="ps-4" data-label="ID">
                        <span class="badge bg-light text-muted border">#<?= $cat['id_categoria'] ?></span>
                    </td>
                    <td class="fw-bold text-cva-brown" data-label="DESCRIPCIÓN">
                        <?= esc($cat['descripcion']) ?>
                    </td>
                    <td class="text-center" data-label="PRODUCTOS">
                        <div class="d-flex flex-column align-items-center gap-2">
                            <span class="badge bg-gold-soft text-gold border border-gold border-opacity-10 px-3 py-2 shadow-sm" style="min-width: 60px;">
                                <span class="fs-6"><?= $cat['total_productos'] ?></span> <i class="bi bi-box-seam ms-1"></i>
                            </span>
                            <?php if($cat['productos_activos'] > 0): ?>
                                <span class="x-small text-success fw-bold bg-success-subtle px-2 py-1 rounded-pill" style="font-size: 0.65rem;">
                                    <i class="bi bi-check-circle-fill me-1"></i><?= $cat['productos_activos'] ?> ACTIVOS
                                </span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="text-center" data-label="ESTADO">
                        <?php if($cat['activo'] == 'SI'): ?>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill x-small fw-bold border border-success border-opacity-10">ACTIVO</span>
                        <?php else: ?>
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill x-small fw-bold border border-danger border-opacity-10">INACTIVO</span>
                        <?php endif; ?>
                    </td>
                    <td class="pe-4 text-center" data-label="GESTIÓN">
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-action-premium text-primary border-primary border-opacity-10" 
                                    onclick="prepararEdicion(<?= $cat['id_categoria'] ?>, '<?= esc($cat['descripcion']) ?>')"
                                    data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            
                            <a href="<?= base_url('admin/categorias/toggle/' . $cat['id_categoria']) ?>" 
                               class="btn btn-action-premium <?= $cat['activo'] == 'SI' ? 'text-warning border-warning' : 'text-success border-success' ?> border-opacity-10">
                                <i class="bi <?= $cat['activo'] == 'SI' ? 'bi-slash-circle' : 'bi-check-circle' ?>"></i>
                            </a>

                            <a href="<?= base_url('admin/categorias/eliminar/' . $cat['id_categoria']) ?>" 
                               class="btn btn-action-premium text-danger border-danger border-opacity-10"
                                onclick="return confirm('¿Estás seguro de eliminar esta categoría? Solo se podrá si no tiene productos vinculados.')">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nueva Categoría -->
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('admin/categorias/guardar') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-brown text-gold">
                    <h5 class="modal-title fw-bold">NUEVA CATEGORÍA</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="descripcion" class="form-control" id="descNueva" placeholder="Nombre de la categoría" required>
                        <label for="descNueva">Descripción (Ej: Mesas de Roble)</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-toggle="modal">Cancelar</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEditar" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-brown text-gold">
                    <h5 class="modal-title fw-bold">EDITAR CATEGORÍA</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="descripcion" class="form-control" id="descEditar" placeholder="Nombre de la categoría" required>
                        <label for="descEditar">Descripción</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4">ACTUALIZAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function prepararEdicion(id, descripcion) {
        document.getElementById('descEditar').value = descripcion;
        document.getElementById('formEditar').action = '<?= base_url('admin/categorias/editar/') ?>' + id;
    }
</script>

<style>
    .dashboard-icon-main {
        width: 60px; height: 60px;
        background: #1a0f0d;
        color: var(--cva-gold);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        border-radius: 1.2rem;
    }
    .bg-gold-soft { background: #fff9f0; }
    .btn-action-premium {
        width: 40px; height: 40px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
        background: white;
        border: 1px solid #eee;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-action-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
</style>
<?= $this->endSection() ?>
