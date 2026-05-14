<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">GESTIÓN DE USUARIOS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Estilo Artisan -->
<div class="row mb-5 align-items-center g-4">
    <div class="col-lg-7">
        <div class="d-flex align-items-center gap-3 gap-md-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <h1 class="display-6 display-md-5 fw-bold text-cva-brown mb-1">Usuarios</h1>
                <p class="text-muted mb-0 small"><i class="bi bi-shield-lock text-gold me-1"></i> Control de accesos y perfiles.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-5 text-lg-end">
        <a href="<?= base_url('registro') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 shadow-gold w-sm-100 justify-content-center">
            <i class="bi bi-person-plus-fill me-2"></i> NUEVO USUARIO
        </a>
    </div>
</div>

<!-- KPIs de Usuarios -->
<div class="row g-3 g-md-4 mb-5">
    <div class="col-6 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 border-info h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Total</span>
                    <h4 class="fw-bold text-cva-brown mb-0"><?= $counts['total'] ?></h4>
                </div>
                <div class="bg-light text-info p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-people fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 h-100 shadow-sm" style="border-color: var(--cva-gold) !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Admins</span>
                    <h4 class="fw-bold text-gold mb-0"><?= $counts['admins'] ?></h4>
                </div>
                <div class="bg-gold-soft text-gold p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-person-badge-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Activos Online</span>
                    <h4 class="fw-bold text-success mb-0"><?= $counts['activos'] ?> Cuentas</h4>
                </div>
                <div class="bg-light text-success p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-person-check-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros Inteligentes -->
<div class="admin-card-v2 mb-4 border-0 shadow-sm overflow-hidden">
    <div class="bg-light p-3 border-bottom d-flex align-items-center justify-content-between" style="min-height: 52px;">
        <h6 class="mb-0 fw-bold text-cva-brown"><i class="bi bi-filter-right me-2 text-gold"></i> Filtros de Búsqueda</h6>
        <div id="filter-status" class="x-small fw-bold text-success" style="opacity: 0; transition: opacity 0.2s ease;">
            <span class="spinner-grow spinner-grow-sm me-1"></span> FILTRANDO...
        </div>
    </div>
    <div class="p-4">
        <div class="row g-3 align-items-end">
            <div class="col-lg-6 col-md-12">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Buscador en tiempo real</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 border-2" style="border-radius: 1rem 0 0 1rem;">
                        <i class="bi bi-search text-gold"></i>
                    </span>
                    <input type="text" id="input-search" class="form-control border-start-0 border-2 py-2" 
                           style="border-radius: 0 1rem 1rem 0;"
                           placeholder="Nombre, email o usuario...">
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Filtro</label>
                <button type="button" id="toggle-view" class="btn btn-outline-dark w-100 py-2 rounded-3 shadow-sm x-small fw-bold">
                    <i class="bi bi-person-dash me-1"></i> SUSPENDIDOS
                </button>
            </div>
            <div class="col-lg-3 col-6">
                <button type="button" id="btn-reset" class="btn btn-light border py-2 w-100 rounded-3 shadow-sm x-small fw-bold text-uppercase">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Usuarios -->
<div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
    <div class="table-responsive-stack">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase x-small fw-bold text-muted">ID</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted">Identidad</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted">Acceso y Contacto</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted text-center">Perfil</th>
                    <th class="pe-4 py-3 text-uppercase x-small fw-bold text-muted text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <?php foreach ($usuarios as $u): 
                    $isSelf = (session()->get('id_usuario') == $u['id_usuario']);
                ?>
                    <tr class="user-row" 
                        data-search="<?= strtolower(esc($u['nombre'] . ' ' . $u['apellido'] . ' ' . $u['email'] . ' ' . $u['usuario'])) ?>"
                        data-baja="<?= $u['baja'] ?>">
                        <td class="ps-4 d-none d-lg-table-cell" data-label="ID">
                            <span class="badge bg-light text-muted border">#<?= $u['id_usuario'] ?></span>
                        </td>
                        <td data-label="IDENTIDAD">
                            <div class="d-flex align-items-center gap-3 py-1 user-info-wrapper">
                                <div class="position-relative">
                                    <div class="avatar-premium bg-brown text-gold rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm">
                                        <?php if(!empty($u['imagen'])): ?>
                                            <img src="<?= base_url('assets/uploads/perfil/'.$u['imagen']) ?>" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                                        <?php else: ?>
                                            <?= substr($u['nombre'], 0, 1) ?><?= substr($u['apellido'], 0, 1) ?>
                                        <?php endif; ?>
                                    </div>
                                    <span class="position-absolute top-0 start-0 badge rounded-pill bg-dark shadow-sm d-md-none" style="transform: translate(-30%, -30%); font-size: 0.6rem; border: 1px solid var(--cva-gold);">#<?= $u['id_usuario'] ?></span>
                                </div>
                                <div class="user-text-details">
                                    <div class="fw-bold text-cva-brown"><?= esc($u['nombre']) ?> <?= esc($u['apellido']) ?></div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="badge bg-light text-muted border d-none d-md-inline-block" style="font-size: 0.65rem;">ID: #<?= $u['id_usuario'] ?></span>
                                        <?php if($isSelf): ?>
                                            <span class="badge bg-gold-soft text-gold x-small fw-bold" style="font-size: 0.6rem;">TU SESIÓN</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td data-label="ACCESO">
                            <div class="small fw-bold text-muted mb-1 user-access-info"><i class="bi bi-at text-gold me-1"></i><?= esc($u['usuario']) ?></div>
                            <div class="x-small text-muted user-access-info"><i class="bi bi-envelope me-1"></i><?= esc($u['email']) ?></div>
                        </td>
                        <td class="text-center" data-label="PERFIL">
                            <?php if($u['perfil_id'] == 1): ?>
                                <span class="badge bg-brown text-gold px-3 py-2 rounded-pill x-small fw-bold border border-gold border-opacity-25 shadow-sm">
                                    <i class="bi bi-shield-fill-check me-1"></i> ADMIN
                                </span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted px-3 py-2 rounded-pill x-small fw-bold border shadow-sm">
                                    <i class="bi bi-person me-1"></i> CLIENTE
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="pe-4 text-center" data-label="ACCIONES">
                            <div class="d-flex justify-content-center gap-2">
                                <?php if($isSelf): ?>
                                    <a href="<?= base_url('/perfil') ?>" class="btn btn-action-premium text-gold border-gold border-opacity-25 shadow-sm">
                                        <i class="bi bi-person-gear"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('/editar-usuario/' . $u['id_usuario']) ?>" 
                                       class="btn btn-action-premium text-primary border-primary border-opacity-25 shadow-sm" 
                                       title="Cambiar Rango">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </a>
                                    
                                    <div class="action-toggle-container">
                                        <a href="<?= base_url('/delete-usuario/' . $u['id_usuario']) ?>" 
                                           class="btn btn-action-premium text-danger border-danger border-opacity-25 shadow-sm btn-archive <?= $u['baja'] == 'SI' ? 'd-none' : '' ?>" 
                                           onclick="return confirm('¿Confirmas suspender a este usuario?')">
                                            <i class="bi bi-person-x-fill"></i>
                                        </a>
                                        <a href="<?= base_url('/activar-usuario/' . $u['id_usuario']) ?>" 
                                           class="btn btn-action-premium text-success border-success border-opacity-25 shadow-sm btn-restore <?= $u['baja'] == 'NO' ? 'd-none' : '' ?>">
                                            <i class="bi bi-person-check-fill"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Filas de Estados Vacíos -->
                <tr id="no-results-row" style="display: none;">
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-search display-4 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No hay usuarios que coincidan con los filtros.</p>
                    </td>
                </tr>
                <tr id="empty-active-row" style="display: none;">
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people display-4 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No hay usuarios activos en el sistema.</p>
                    </td>
                </tr>
                <tr id="empty-suspended-row" style="display: none;">
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-person-dash display-4 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No hay usuarios suspendidos.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .dashboard-icon-main {
        width: 60px; height: 60px;
        background: #1a0f0d;
        color: var(--cva-gold);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        border-radius: 1.2rem;
    }
    .avatar-premium {
        width: 45px; height: 45px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .user-row:hover .avatar-premium {
        transform: scale(1.1) rotate(5deg);
        background: var(--cva-gold);
        color: #1a0f0d;
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

<?= $this->section('extra-js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputSearch = document.getElementById('input-search');
        const toggleView = document.getElementById('toggle-view');
        const rows = document.querySelectorAll('.user-row');
        const noResults = document.getElementById('no-results-row');
        const emptyActive = document.getElementById('empty-active-row');
        const emptySuspended = document.getElementById('empty-suspended-row');
        const filterStatus = document.getElementById('filter-status');
        const btnReset = document.getElementById('btn-reset');

        let currentView = 'NO'; // 'NO' para Activos, 'SI' para Suspendidos

        function filterUsers() {
            const searchTerm = inputSearch.value.toLowerCase();
            let visibleCount = 0;
            let totalInCurrentView = 0;

            filterStatus.style.opacity = '1';

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                const baja = row.getAttribute('data-baja');
                
                const isCorrectView = (baja === currentView);
                const matchesSearch = searchData.includes(searchTerm);

                if (isCorrectView) {
                    totalInCurrentView++;
                    if (matchesSearch) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            // Control de estados vacíos
            noResults.style.display = (visibleCount === 0 && totalInCurrentView > 0) ? '' : 'none';
            emptyActive.style.display = (totalInCurrentView === 0 && currentView === 'NO') ? '' : 'none';
            emptySuspended.style.display = (totalInCurrentView === 0 && currentView === 'SI') ? '' : 'none';
            
            setTimeout(() => {
                filterStatus.style.opacity = '0';
            }, 300);
        }

        toggleView.addEventListener('click', function() {
            currentView = (currentView === 'NO') ? 'SI' : 'NO';
            
            if (currentView === 'SI') {
                this.innerHTML = '<i class="bi bi-person-check me-1"></i> VER ACTIVOS';
                this.classList.replace('btn-outline-dark', 'btn-dark');
            } else {
                this.innerHTML = '<i class="bi bi-person-dash me-1"></i> VER SUSPENDIDOS';
                this.classList.replace('btn-dark', 'btn-outline-dark');
            }
            
            filterUsers();
        });

        inputSearch.addEventListener('input', filterUsers);
        
        btnReset.addEventListener('click', function() {
            inputSearch.value = '';
            filterUsers();
        });

        // Inicializar vista
        filterUsers();
    });
</script>
<?= $this->endSection() ?>
