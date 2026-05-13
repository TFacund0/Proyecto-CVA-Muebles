<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active text-gold fw-bold" aria-current="page">GESTIÓN DE CATÁLOGO</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-5 align-items-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold text-cva-brown mb-1">Inventario de Obras</h1>
                <p class="text-muted mb-0"><i class="bi bi-check2-circle text-success me-1"></i> Control total sobre las piezas disponibles y su visibilidad.</p>
            </div>
        </div>
    </div>
    <div class="col-md-5 text-md-end">
        <a href="<?= base_url('/alta-producto') ?>" class="btn-admin-primary rounded-pill px-4 py-3 shadow-gold">
            <i class="bi bi-plus-lg me-2"></i> NUEVA PIEZA
        </a>
    </div>
</div>

<!-- Resumen de Stock (KPIs Rápidos) -->
<div class="row g-4 mb-5">
    <?php 
        $total_items = count($productos);
        $unidades_fisicas = 0;
        $categorias_activas = [];
        foreach($productos as $p) {
            $unidades_fisicas += $p['stock'];
            if(!empty($p['categoria'])) $categorias_activas[$p['categoria']] = true;
        }
    ?>
    <div class="col-md-4">
        <div class="admin-card-v2 p-4 border-start border-4 border-info h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Total Catálogo</span>
                    <h3 class="fw-bold text-cva-brown mb-0"><?= $total_items ?> Obras</h3>
                </div>
                <div class="bg-info-soft text-info p-3 rounded-circle">
                    <i class="bi bi-collection fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card-v2 p-4 border-start border-4 h-100 shadow-sm" style="border-color: var(--cva-gold) !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Unidades en Stock</span>
                    <h3 class="fw-bold text-gold mb-0"><?= $unidades_fisicas ?> Muebles</h3>
                </div>
                <div class="bg-gold-soft text-gold p-3 rounded-circle">
                    <i class="bi bi-box-seam-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card-v2 p-4 border-start border-4 border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Categorías</span>
                    <h3 class="fw-bold text-success mb-0"><?= count($categorias_activas) ?> Estilos</h3>
                </div>
                <div class="bg-success-soft text-success p-3 rounded-circle">
                    <i class="bi bi-tags fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros Avanzados -->
<div class="admin-card-v2 mb-4 border-0 shadow-sm overflow-hidden">
    <div class="bg-light p-3 border-bottom d-flex align-items-center justify-content-between" style="min-height: 52px;">
        <h6 class="mb-0 fw-bold text-cva-brown"><i class="bi bi-filter-right me-2 text-gold"></i> Filtros de Búsqueda</h6>
        <div id="filter-status" class="x-small fw-bold text-success" style="opacity: 0; transition: opacity 0.2s ease;">
            <span class="spinner-grow spinner-grow-sm me-1"></span> FILTRANDO...
        </div>
    </div>
    <div class="p-4">
        <form id="filter-form">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="x-small fw-bold text-muted text-uppercase mb-2">Nombre o Palabra Clave</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-search text-gold"></i></span>
                        <input type="text" id="input-search" class="form-control border-0 py-2" placeholder="Empieza a escribir para filtrar...">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="x-small fw-bold text-muted text-uppercase mb-2">Categoría</label>
                    <select id="select-category" class="form-select border shadow-sm py-2">
                        <option value="all">Todas las categorías</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= esc($cat['descripcion']) ?>"><?= esc($cat['descripcion']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="button" id="toggle-view" class="btn btn-outline-dark w-100 py-2 rounded-3 shadow-sm x-small fw-bold" data-current="<?= $vista ?>">
                            <i class="bi bi-archive me-1"></i> VER ARCHIVADOS
                        </button>
                        <button type="button" id="btn-reset" class="btn btn-light border py-2 px-3 rounded-3 shadow-sm">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Listado Maestro -->
<div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="products-table">
            <thead class="bg-brown text-white">
                <tr>
                    <th class="ps-4 py-4 text-gold x-small fw-bold border-0 text-uppercase tracking-widest" style="width: 45%;">PIEZA Y ESPECIFICACIONES</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-uppercase tracking-widest">CATEGORÍA</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-center text-uppercase tracking-widest">STOCK</th>
                    <th class="py-4 text-gold x-small fw-bold border-0 text-end text-uppercase tracking-widest">PRECIO VENTA</th>
                    <th class="pe-4 py-4 text-gold x-small fw-bold border-0 text-center text-uppercase tracking-widest">GESTIÓN</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php if(!empty($productos)): ?>
                    <?php foreach ($productos as $p): ?>
                        <tr class="product-row" 
                            data-name="<?= strtolower(esc($p['nombre_prod'])) ?>" 
                            data-category="<?= esc($p['categoria'] ?? 'Sin Categoría') ?>"
                            data-eliminado="<?= $p['eliminado'] ?>">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-4 py-3">
                                    <div class="flex-shrink-0 position-relative product-img-container">
                                        <img src="<?= base_url('assets/uploads/' . $p['imagen']) ?>" 
                                             class="rounded-4 shadow-sm border p-1 bg-white transition-transform" style="width: 120px; height: 120px; object-fit: cover;">
                                        <span class="position-absolute top-0 start-0 badge rounded-pill bg-dark shadow-sm" style="transform: translate(-20%, -20%); font-size: 0.7rem; border: 1px solid var(--cva-gold); z-index: 1;">#<?= $p['id_producto'] ?></span>
                                    </div>
                                    <div>
                                        <div class="h5 fw-bold text-cva-brown mb-1"><?= esc($p['nombre_prod']) ?></div>
                                        <div class="small text-muted mb-3"><?= character_limiter(esc($p['descripcion'] ?? ''), 100) ?></div>
                                        <div class="d-flex gap-2">
                                            <span class="x-small fw-bold text-uppercase badge bg-light text-muted border px-2 py-1" style="font-size: 0.6rem;">CVA ARTISAN</span>
                                            <span class="x-small fw-bold text-uppercase badge bg-light text-muted border px-2 py-1" style="font-size: 0.6rem;">PROD ID: <?= $p['id_producto'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-gold-soft text-gold px-3 py-2 rounded-pill small fw-bold border border-warning border-opacity-10">
                                    <i class="bi bi-tag-fill me-1"></i> <?= esc($p['categoria'] ?? 'Sin Categoría') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-block text-center">
                                    <div class="h3 fw-bold mb-0 <?= $p['stock'] > 0 ? 'text-success' : 'text-muted' ?>">
                                        <?= $p['stock'] ?>
                                    </div>
                                    <div class="x-small fw-bold text-uppercase text-muted" style="font-size: 0.65rem;">Unidades</div>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="h5 fw-bold text-cva-brown mb-0">$<?= number_format($p['precio_vta'], 2, ',', '.') ?></div>
                                <div class="x-small text-muted italic">Precio de Lista</div>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex flex-column gap-2 align-items-center">
                                    <a href="<?= base_url('/editar-producto/' . $p['id_producto']) ?>" 
                                       class="btn btn-action-premium text-primary border-primary border-opacity-25 w-100">
                                        <i class="bi bi-pencil-fill me-2"></i> EDITAR
                                    </a>
                                    
                                    <div class="w-100 btn-group-actions">
                                        <a href="<?= base_url('/delete-producto/' . $p['id_producto']) ?>" 
                                           class="btn btn-action-premium text-danger border-danger border-opacity-25 w-100 action-archive <?= $p['eliminado'] == 'SI' ? 'd-none' : '' ?>" 
                                           onclick="return confirm('¿Confirmas archivar esta pieza del catálogo?')">
                                            <i class="bi bi-archive-fill me-2"></i> ARCHIVAR
                                        </a>
                                        <a href="<?= base_url('/activar-producto/' . $p['id_producto']) ?>" 
                                           class="btn btn-action-premium text-success border-success border-opacity-25 w-100 action-restore <?= $p['eliminado'] == 'NO' ? 'd-none' : '' ?>">
                                            <i class="bi bi-arrow-counterclockwise me-2"></i> RESTAURAR
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <!-- Fila de "No hay resultados" (JS la controla) -->
                <tr id="no-results-row" style="display: none;">
                    <td colspan="5" class="text-center py-5 bg-light bg-opacity-50">
                        <div class="py-5 text-center">
                            <i class="bi bi-search display-1 text-muted opacity-25"></i>
                            <h4 class="text-muted mt-4">Sin coincidencias</h4>
                            <p class="text-muted small">No encontramos nada que coincida con tus filtros actuales.</p>
                            <button type="button" onclick="resetFilters()" class="btn btn-outline-gold rounded-pill px-4 mt-3 animate-pulse-gold">Limpiar búsqueda</button>
                        </div>
                    </td>
                </tr>

                <tr id="empty-active-row" style="display: none;">
                    <td colspan="5" class="text-center py-5 bg-light bg-opacity-50">
                        <div class="py-5 text-center">
                            <i class="bi bi-box-seam-fill display-1 text-muted opacity-25"></i>
                            <h4 class="text-muted mt-4">Catálogo Vacío</h4>
                            <p class="text-muted small">No hay piezas registradas en el catálogo activo.</p>
                            <a href="<?= base_url('/alta-producto') ?>" class="btn btn-admin-primary rounded-pill px-5 mt-3 shadow animate-pulse-gold">REGISTRAR PRIMERA OBRA</a>
                        </div>
                    </td>
                </tr>

                <tr id="empty-archive-row" style="display: none;">
                    <td colspan="5" class="text-center py-5 bg-light bg-opacity-50">
                        <div class="py-5 text-center">
                            <i class="bi bi-archive-fill display-1 text-muted opacity-25"></i>
                            <h4 class="text-muted mt-4">Archivo Vacío</h4>
                            <p class="text-muted small">No tienes piezas archivadas en este momento.</p>
                        </div>
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
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .bg-info-soft { background: #e7f5ff; }
    .bg-success-soft { background: #f2fcf5; }
    .bg-gold-soft { background: #fff9f0; }

    /* Botones Premium con Dinamismo */
    .btn-action-premium {
        background: white;
        border: 1px solid;
        border-radius: 50px;
        padding: 8px 15px;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-action-premium:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        filter: brightness(0.95);
    }
    .btn-action-premium:active {
        transform: translateY(0) scale(0.98);
    }

    /* Animación de Imagen */
    .product-img-container:hover img {
        transform: scale(1.08) rotate(2deg);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    .transition-transform { transition: all 0.4s ease; }

    /* Pulso para el botón de catálogo vacío */
    .animate-pulse-gold {
        animation: pulse-gold 2s infinite;
    }
    @keyframes pulse-gold {
        0% { box-shadow: 0 0 0 0 rgba(201, 161, 107, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(201, 161, 107, 0); }
        100% { box-shadow: 0 0 0 0 rgba(201, 161, 107, 0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputSearch = document.getElementById('input-search');
        const selectCategory = document.getElementById('select-category');
        const toggleView = document.getElementById('toggle-view');
        const rows = document.querySelectorAll('.product-row');
        const noResults = document.getElementById('no-results-row');
        const emptyActive = document.getElementById('empty-active-row');
        const emptyArchive = document.getElementById('empty-archive-row');
        const filterStatus = document.getElementById('filter-status');
        const btnReset = document.getElementById('btn-reset');

        let currentView = 'NO'; // 'NO' para Activos, 'SI' para Archivados

        function filterProducts() {
            const searchTerm = inputSearch.value.toLowerCase();
            const categoryTerm = selectCategory.value;
            let visibleCount = 0;
            let totalInCurrentView = 0;

            filterStatus.style.opacity = '1';

            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const category = row.getAttribute('data-category');
                const eliminado = row.getAttribute('data-eliminado');
                
                const isCorrectView = (eliminado === currentView);
                const matchesSearch = name.includes(searchTerm);
                const matchesCategory = (categoryTerm === 'all' || category === categoryTerm);

                if (isCorrectView) {
                    totalInCurrentView++;
                    if (matchesSearch && matchesCategory) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            // Control de filas vacías
            noResults.style.display = (visibleCount === 0 && totalInCurrentView > 0) ? '' : 'none';
            emptyActive.style.display = (totalInCurrentView === 0 && currentView === 'NO') ? '' : 'none';
            emptyArchive.style.display = (totalInCurrentView === 0 && currentView === 'SI') ? '' : 'none';
            
            setTimeout(() => {
                filterStatus.style.opacity = '0';
            }, 300);
        }

        toggleView.addEventListener('click', function() {
            currentView = (currentView === 'NO') ? 'SI' : 'NO';
            
            // Actualizar botón
            if (currentView === 'SI') {
                this.innerHTML = '<i class="bi bi-eye me-1"></i> VER ACTIVOS';
                this.classList.replace('btn-outline-dark', 'btn-dark');
            } else {
                this.innerHTML = '<i class="bi bi-archive me-1"></i> VER ARCHIVADOS';
                this.classList.replace('btn-dark', 'btn-outline-dark');
            }
            
            filterProducts();
        });

        inputSearch.addEventListener('input', filterProducts);
        selectCategory.addEventListener('change', filterProducts);
        
        btnReset.addEventListener('click', function() {
            inputSearch.value = '';
            selectCategory.value = 'all';
            filterProducts();
        });

        // Inicializar vista
        filterProducts();
    });

    function resetFilters() {
        document.getElementById('btn-reset').click();
    }
</script>
<?= $this->endSection() ?>
