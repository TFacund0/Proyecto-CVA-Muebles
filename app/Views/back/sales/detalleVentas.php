<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">CONTROL DE PEDIDOS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Estilo Artisan -->
<div class="row mb-5 align-items-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-hammer"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold text-cva-brown mb-1">Gestión de Pedidos</h1>
                <p class="text-muted mb-0"><i class="bi bi-calendar-check text-gold me-1"></i> Control de producción, pagos y entregas de obras.</p>
            </div>
        </div>
    </div>
    <div class="col-md-5 text-md-end">
        <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 shadow-gold">
            <i class="bi bi-plus-circle-fill me-2"></i> NUEVO PEDIDO MANUAL
        </a>
    </div>
</div>

<!-- KPIs de Ventas y Producción -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="admin-card-v2 p-4 border-start border-4 border-info h-100 shadow-sm cursor-pointer" onclick="filterByStatus('ALL')">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Pedidos de <?= $nombreMes ?></span>
                    <h3 class="fw-bold text-cva-brown mb-0"><?= $counts['mensuales'] ?></h3>
                </div>
                <div class="bg-light text-info p-3 rounded-circle">
                    <i class="bi bi-receipt fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card-v2 p-4 border-start border-4 h-100 shadow-sm cursor-pointer" style="border-color: var(--cva-gold) !important;" onclick="filterByStatus('EN_PROCESO')">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">En Taller</span>
                    <h3 class="fw-bold text-gold mb-0"><?= $counts['en_proceso'] ?> Obras</h3>
                </div>
                <div class="bg-gold-soft text-gold p-3 rounded-circle">
                    <i class="bi bi-tools fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card-v2 p-4 border-start border-4 border-warning h-100 shadow-sm cursor-pointer" onclick="filterByStatus('PENDIENTE')">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Pendientes</span>
                    <h3 class="fw-bold text-warning mb-0"><?= $counts['pendientes'] ?> Espera</h3>
                </div>
                <div class="bg-light text-warning p-3 rounded-circle">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card-v2 p-4 border-start border-4 border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Recaudación de <?= $nombreMes ?></span>
                    <h3 class="fw-bold text-success mb-0">$ <?= number_format($counts['ingresos'], 0, ',', '.') ?></h3>
                </div>
                <div class="bg-light text-success p-3 rounded-circle">
                    <i class="bi bi-cash-stack fs-4"></i>
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
            <span class="spinner-grow spinner-grow-sm me-1"></span> ACTUALIZANDO...
        </div>
    </div>
    <div class="p-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Buscador en tiempo real</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 border-2" style="border-radius: 1rem 0 0 1rem;">
                        <i class="bi bi-search text-gold"></i>
                    </span>
                    <input type="text" id="input-search" class="form-control border-start-0 border-2 py-2" 
                           style="border-radius: 0 1rem 1rem 0;"
                           placeholder="ID de pedido, nombre de cliente o usuario...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Estado de Producción</label>
                <select id="select-status" class="form-select border-2 py-2 rounded-3 x-small fw-bold text-uppercase">
                    <option value="ALL">TODOS LOS ESTADOS</option>
                    <option value="PENDIENTE">🟠 PENDIENTE</option>
                    <option value="EN_PROCESO">🔵 EN PROCESO</option>
                    <option value="TERMINADO">🟢 TERMINADO</option>
                    <option value="ENTREGADO">🔘 ENTREGADO</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" id="btn-reset" class="btn btn-light border py-2 w-100 rounded-3 shadow-sm x-small fw-bold text-uppercase">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar Filtros
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Pedidos -->
<div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase x-small fw-bold text-muted">ID</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted">Fecha y Hora</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted">Cliente / Origen</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted text-end">Total</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted text-center">Estado</th>
                    <th class="pe-4 py-3 text-uppercase x-small fw-bold text-muted text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="order-table-body">
                <?php foreach ($ventas as $v): ?>
                    <tr class="order-row" 
                        data-search="<?= $v['search_data'] ?>"
                        data-estado="<?= $v['estado'] ?>">
                        <td class="ps-4">
                            <span class="badge bg-light text-muted border">#<?= $v['id'] ?></span>
                        </td>
                        <td>
                            <div class="fw-bold text-cva-brown"><?= date('d/m/Y', strtotime($v['fecha'])) ?></div>
                            <div class="x-small text-muted"><?= date('H:i', strtotime($v['fecha'])) ?> hs</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-premium bg-brown text-gold rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 35px; height: 35px; font-size: 0.7rem;">
                                    <?= strtoupper(substr($v['nombre'] ?? 'M', 0, 1)) ?><?= strtoupper(substr($v['apellido'] ?? 'P', 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-cva-brown"><?= esc(($v['nombre'] ?? 'VENTA') . ' ' . ($v['apellido'] ?? 'MANUAL')) ?></div>
                                    <div class="x-small text-muted text-uppercase fw-bold" style="font-size: 0.6rem;">
                                        <?= empty($v['usuario']) || $v['usuario'] == 'cliente_whatsapp' ? '<i class="bi bi-whatsapp text-success me-1"></i>LOCAL / WHATSAPP' : '<i class="bi bi-shop text-gold me-1"></i>TIENDA ONLINE' ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="fw-bold fs-6 text-dark">
                                <span class="small opacity-50 fw-normal">$ </span><?= number_format($v['total_venta'], 2, ',', '.') ?>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php 
                                $badge_class = "bg-light text-muted border";
                                $icon = "bi-clock";
                                if($v['estado'] == 'PENDIENTE') { $badge_class = "bg-warning-soft text-warning border-warning"; $icon = "bi-hourglass-split"; }
                                if($v['estado'] == 'EN_PROCESO') { $badge_class = "bg-info-soft text-info border-info"; $icon = "bi-tools"; }
                                if($v['estado'] == 'TERMINADO') { $badge_class = "bg-success-soft text-success border-success"; $icon = "bi-check-all"; }
                                if($v['estado'] == 'ENTREGADO') { $badge_class = "bg-dark text-white"; $icon = "bi-truck"; }
                            ?>
                            <span class="badge px-3 py-2 rounded-pill x-small fw-bold <?= $badge_class ?>" style="min-width: 100px;">
                                <i class="bi <?= $icon ?> me-1"></i>
                                <?= strtoupper($v['estado']) ?>
                            </span>
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= base_url('ventas/gestion/' . $v['id']) ?>" 
                                   class="btn btn-action-premium text-gold border-gold border-opacity-25 shadow-sm" 
                                   title="Gestionar Pedido">
                                    <i class="bi bi-sliders2"></i>
                                </a>
                                <a href="<?= base_url('factura/' . $v['id']) ?>" 
                                   class="btn btn-action-premium text-danger border-danger border-opacity-25 shadow-sm" 
                                   title="Ver Comprobante">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Filas de Estados Vacíos -->
                <tr id="no-results-row" style="display: none;">
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-search display-4 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No hay pedidos que coincidan con la búsqueda.</p>
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
    .bg-warning-soft { background: #fff8eb; }
    .bg-info-soft { background: #f0f7ff; }
    .bg-success-soft { background: #f0fff4; }
    .cursor-pointer { cursor: pointer; transition: transform 0.2s; }
    .cursor-pointer:hover { transform: translateY(-5px); }
</style>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    function filterByStatus(status) {
        const selectStatus = document.getElementById('select-status');
        selectStatus.value = status;
        selectStatus.dispatchEvent(new Event('change'));
    }

    document.addEventListener('DOMContentLoaded', function() {
        const inputSearch = document.getElementById('input-search');
        const selectStatus = document.getElementById('select-status');
        const rows = document.querySelectorAll('.order-row');
        const noResults = document.getElementById('no-results-row');
        const filterStatus = document.getElementById('filter-status');
        const btnReset = document.getElementById('btn-reset');

        function filterOrders() {
            const searchTerm = inputSearch.value.toLowerCase();
            const statusFilter = selectStatus.value;
            let visibleCount = 0;

            filterStatus.style.opacity = '1';

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                const estado = row.getAttribute('data-estado');
                
                const matchesSearch = searchData.includes(searchTerm);
                const matchesStatus = (statusFilter === 'ALL' || estado === statusFilter);

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            noResults.style.display = (visibleCount === 0) ? '' : 'none';
            
            setTimeout(() => {
                filterStatus.style.opacity = '0';
            }, 300);
        }

        inputSearch.addEventListener('input', filterOrders);
        selectStatus.addEventListener('change', filterOrders);
        
        btnReset.addEventListener('click', function() {
            inputSearch.value = '';
            selectStatus.value = 'ALL';
            filterOrders();
        });

        // Check for initial filter in URL
        const urlParams = new URLSearchParams(window.location.search);
        const initialStatus = urlParams.get('estado');
        if (initialStatus) {
            selectStatus.value = initialStatus;
        }

        // Inicializar
        filterOrders();
    });
</script>
<?= $this->endSection() ?>
