<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">GESTIÓN DE CONSULTAS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Estilo Artisan -->
<div class="row mb-5 align-items-center g-4">
    <div class="col-lg-7">
        <div class="d-flex align-items-center gap-3 gap-md-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-chat-left-text"></i>
            </div>
            <div>
                <h1 class="display-6 display-md-5 fw-bold text-cva-brown mb-1">Inbox</h1>
                <p class="text-muted mb-0 small"><i class="bi bi-envelope-paper text-gold me-1"></i> Gestión de mensajes y presupuestos.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-5 text-lg-end">
        <div class="badge bg-gold-soft text-gold px-4 py-2 rounded-pill fs-6 fw-bold border border-gold shadow-sm w-sm-100 justify-content-center">
            <i class="bi bi-inbox-fill me-2"></i><?= $counts['activos'] ?> PENDIENTES
        </div>
    </div>
</div>

<!-- KPIs de Consultas -->
<div class="row g-3 g-md-4 mb-5">
    <div class="col-6 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 border-info h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Mes <?= $nombreMes ?></span>
                    <h4 class="fw-bold text-cva-brown mb-0"><?= $counts['mensuales'] ?></h4>
                </div>
                <div class="bg-light text-info p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-calendar3 fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 h-100 shadow-sm" style="border-color: var(--cva-gold) !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Presupuestos</span>
                    <h4 class="fw-bold text-gold mb-0"><?= $counts['presupuestos'] ?></h4>
                </div>
                <div class="bg-gold-soft text-gold p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-file-earmark-spreadsheet fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="admin-card-v2 p-3 p-md-4 border-start border-4 border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Total Histórico</span>
                    <h4 class="fw-bold text-success mb-0"><?= $counts['total'] ?> Mensajes</h4>
                </div>
                <div class="bg-light text-success p-2 p-md-3 rounded-circle d-none d-sm-block">
                    <i class="bi bi-archive fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros Inteligentes -->
<div class="admin-card-v2 mb-4 border-0 shadow-sm overflow-hidden">
    <div class="bg-light p-3 border-bottom d-flex align-items-center justify-content-between" style="min-height: 52px;">
        <h6 class="mb-0 fw-bold text-cva-brown"><i class="bi bi-filter-right me-2 text-gold"></i> Filtros de Mensajería</h6>
        <div id="filter-status" class="x-small fw-bold text-success" style="opacity: 0; transition: opacity 0.2s ease;">
            <span class="spinner-grow spinner-grow-sm me-1"></span> FILTRANDO...
        </div>
    </div>
    <div class="p-4">
        <div class="row g-3 align-items-end">
            <div class="col-lg-5 col-md-12">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Buscador en tiempo real</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 border-2" style="border-radius: 1rem 0 0 1rem;">
                        <i class="bi bi-search text-gold"></i>
                    </span>
                    <input type="text" id="input-search" class="form-control border-start-0 border-2 py-2" 
                           style="border-radius: 0 1rem 1rem 0;"
                           placeholder="Buscar...">
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Estado</label>
                <button type="button" id="toggle-view" class="btn btn-outline-dark w-100 py-2 rounded-3 shadow-sm x-small fw-bold">
                    <i class="bi bi-check2-all me-1"></i> CONTESTADOS
                </button>
            </div>
            <div class="col-lg-3 col-6">
                <label class="x-small fw-bold text-muted text-uppercase mb-2">Asunto</label>
                <select id="select-asunto" class="form-select border-2 py-2 rounded-3 x-small fw-bold text-uppercase">
                    <option value="ALL">TODOS</option>
                    <option value="Consulta general">Gral.</option>
                    <option value="Solicitud de presupuesto">Presup.</option>
                    <option value="Estado de mi pedido">Pedido</option>
                    <option value="Consulta sobre garantía">Garantía</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="col-lg-1 col-12">
                <button type="button" id="btn-reset" class="btn btn-light border py-2 w-100 rounded-3 shadow-sm x-small fw-bold text-uppercase">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Listado de Mensajes -->
<div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
    <div class="table-responsive-stack">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase x-small fw-bold text-muted d-none d-lg-table-cell" style="width: 8%;">Fecha</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted" style="width: 22%;">Interesado</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted d-none d-lg-table-cell" style="width: 18%;">Contacto</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted d-none d-lg-table-cell" style="width: 12%;">Asunto</th>
                    <th class="py-3 text-uppercase x-small fw-bold text-muted" style="width: 25%;">Mensaje</th>
                    <th class="pe-4 py-3 text-uppercase x-small fw-bold text-muted text-center" style="width: 15%;">Acciones</th>
                </tr>
            </thead>
            <tbody id="inquiry-table-body">
                <?php if(!empty($consultas)): ?>
                    <?php foreach ($consultas as $index => $consulta): ?>
                        <tr class="inquiry-row" 
                            data-search="<?= $consulta['search_data'] ?>"
                            data-asunto="<?= esc($consulta['asunto']) ?>"
                            data-activo="<?= $consulta['activo'] ?>">
                            <td class="ps-4 d-none d-lg-table-cell" data-label="FECHA">
                                <div class="fw-bold text-cva-brown small"><?= date('d/m/Y', strtotime($consulta['fecha'])) ?></div>
                            </td>
                            <td data-label="INTERESADO">
                                <div class="d-flex align-items-center gap-3 py-1 inquiry-info-wrapper">
                                    <div class="position-relative">
                                        <div class="avatar-premium bg-brown text-gold rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm">
                                            <?= strtoupper(substr($consulta['nombre'], 0, 1)) ?><?= strtoupper(substr($consulta['apellido'], 0, 1)) ?>
                                        </div>
                                        <span class="position-absolute top-0 start-0 badge rounded-pill bg-dark shadow-sm d-lg-none" style="transform: translate(-30%, -30%); font-size: 0.6rem; border: 1px solid var(--cva-gold);"><?= date('d/m/y', strtotime($consulta['fecha'])) ?></span>
                                    </div>
                                    <div class="inquiry-text-details">
                                        <div class="fw-bold text-cva-brown fs-5"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></div>
                                        <div class="x-small text-muted d-lg-none"><?= esc($consulta['email']) ?></div>
                                        <div class="d-lg-none mt-1">
                                            <span class="badge bg-gold-soft text-gold border border-gold border-opacity-25 x-small" style="font-size: 0.6rem;"><?= esc($consulta['asunto']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none d-lg-table-cell" data-label="CONTACTO">
                                <div class="small text-end text-md-start"><i class="bi bi-envelope me-1 text-gold"></i> <?= esc($consulta['email']) ?></div>
                                <div class="x-small fw-bold text-muted text-end text-md-start"><i class="bi bi-phone me-1"></i> <?= esc($consulta['telefono']) ?></div>
                            </td>
                            <td class="d-none d-lg-table-cell" data-label="ASUNTO">
                                <?php 
                                    $asunto_class = "bg-light text-muted";
                                    if(stripos($consulta['asunto'], 'presupuesto') !== false) $asunto_class = "bg-warning-soft text-warning border-warning";
                                    if(stripos($consulta['asunto'], 'pedido') !== false) $asunto_class = "bg-info-soft text-info border-info";
                                ?>
                                <span class="badge px-2 py-1 rounded-pill x-small fw-bold border <?= $asunto_class ?>">
                                    <?= esc($consulta['asunto']) ?>
                                </span>
                            </td>
                            <td data-label="MENSAJE" class="message-cell">
                                <div class="message-preview text-truncate small text-muted mb-1"><?= esc($consulta['descripcion']) ?></div>
                                <div class="message-action">
                                    <a href="#" class="text-gold x-small fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalConsulta<?= $index ?>">
                                        LEER MÁS <i class="bi bi-chevron-right"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="pe-4 text-center" data-label="ACCIONES">
                                <div class="d-flex justify-content-center gap-2">
                                    <?php 
                                        $num = preg_replace('/[^0-9]/', '', $consulta['telefono']);
                                        $msg = urlencode("Hola " . $consulta['nombre'] . "! Soy César de CVA Muebles, respondo a tu consulta sobre: " . $consulta['asunto']);
                                        $url_wa = "https://wa.me/" . (str_starts_with($num, '54') ? $num : "54" . $num) . "?text=" . $msg;
                                    ?>
                                    <a href="<?= $url_wa ?>" target="_blank" class="btn btn-action-premium text-success border-success border-opacity-25 shadow-sm" title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    
                                    <form action="<?= base_url('ventas/nuevo-personalizado') ?>" method="get" class="m-0">
                                        <input type="hidden" name="nombre" value="<?= esc($consulta['nombre'] . ' ' . $consulta['apellido']) ?>">
                                        <input type="hidden" name="detalle" value="<?= esc($consulta['asunto'] . ': ' . $consulta['descripcion']) ?>">
                                        <button type="submit" class="btn btn-action-premium text-gold border-gold border-opacity-25 shadow-sm" title="Convertir a Pedido">
                                            <i class="bi bi-hammer"></i>
                                        </button>
                                    </form>
                                    
                                    <button type="button" onclick="submitAction('<?= base_url('consultas/eliminar/'.$consulta['id_consulta']) ?>', '¿Marcar como contestado/archivado?')" 
                                            class="btn btn-action-premium text-danger border-danger border-opacity-25 shadow-sm" title="Archivar/Contestado">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL DE LECTURA PREMIUM -->
                        <div class="modal fade" id="modalConsulta<?= $index ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-5 shadow-lg overflow-hidden">
                                    <div class="modal-header bg-brown text-gold p-4">
                                        <div>
                                            <h5 class="modal-title fw-bold mb-1">Detalle del Mensaje</h5>
                                            <span class="x-small opacity-75">ID: <?= $consulta['id_consulta'] ?></span>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-light">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="avatar-md bg-brown text-gold rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4 shadow-sm" style="width: 50px; height: 50px;">
                                                <?= substr($consulta['nombre'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-cva-brown mb-0"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></h5>
                                                <div class="x-small text-muted"><?= date('d M Y, H:i', strtotime($consulta['fecha'])) ?> hs</div>
                                            </div>
                                        </div>
                                        <div class="p-4 bg-white border border-gold border-opacity-25 rounded-4 mb-4 shadow-sm">
                                            <div class="x-small fw-bold text-gold text-uppercase mb-2 border-bottom pb-2">
                                                <i class="bi bi-tag-fill me-1"></i> Asunto: <?= esc($consulta['asunto']) ?>
                                            </div>
                                            <p class="mb-0 text-dark lh-lg" style="font-size: 0.95rem;"><?= nl2br(esc($consulta['descripcion'])) ?></p>
                                        </div>
                                        <div class="d-flex gap-4 text-muted x-small justify-content-center py-2 bg-light rounded-3">
                                            <div><i class="bi bi-envelope-fill text-gold me-1"></i> <?= esc($consulta['email']) ?></div>
                                            <div><i class="bi bi-telephone-fill text-gold me-1"></i> <?= esc($consulta['telefono']) ?></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light p-3 border-0">
                                        <button type="button" class="btn btn-outline-dark rounded-pill px-4 x-small fw-bold" data-bs-dismiss="modal">CERRAR</button>
                                        <a href="<?= $url_wa ?>" target="_blank" class="btn btn-admin-primary rounded-pill px-4 x-small fw-bold">
                                            <i class="bi bi-whatsapp me-2"></i> RESPONDER POR WHATSAPP
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr id="empty-row">
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-chat-dots fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-3 fw-bold">No hay consultas registradas en el sistema.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                
                <!-- Fila de Sin Resultados JS -->
                <tr id="no-results-row" style="display: none;">
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-search display-4 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No hay consultas que coincidan con la búsqueda.</p>
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
    
    .nav-item-admin-special i {
        font-size: 1.2rem;
    }

    /* Fix para evitar desbordamiento en tablas de administración */
    @media (min-width: 992px) {
    .table-responsive-stack table {
        table-layout: fixed !important;
        width: 100% !important;
    }
    
    .inquiry-row td {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
    }

    .inquiry-row .inquiry-info-wrapper,
    .inquiry-row .message-cell {
        overflow: hidden !important;
    }

    .inquiry-row .fw-bold {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        display: block !important;
    }

    .message-cell .message-preview {
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: block !important;
    }

    .message-cell .message-action {
        display: block !important;
        margin-top: 2px !important;
    }
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
</style>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputSearch = document.getElementById('input-search');
        const selectAsunto = document.getElementById('select-asunto');
        const toggleView = document.getElementById('toggle-view');
        const rows = document.querySelectorAll('.inquiry-row');
        const noResults = document.getElementById('no-results-row');
        const filterStatus = document.getElementById('filter-status');
        const btnReset = document.getElementById('btn-reset');

        let currentView = 'SI'; // 'SI' para Pendientes (Activos), 'NO' para Contestados

        function filterInquiries() {
            const searchTerm = inputSearch.value.toLowerCase();
            const asuntoFilter = selectAsunto.value;
            let visibleCount = 0;
            let totalInCurrentView = 0;

            filterStatus.style.opacity = '1';

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                const asunto = row.getAttribute('data-asunto');
                const activo = row.getAttribute('data-activo');
                
                const isCorrectView = (activo === currentView);
                const matchesSearch = searchData.includes(searchTerm);
                const matchesAsunto = (asuntoFilter === 'ALL' || asunto === asuntoFilter);

                if (isCorrectView) {
                    totalInCurrentView++;
                    if (matchesSearch && matchesAsunto) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.style.display = (visibleCount === 0 && totalInCurrentView > 0) ? '' : 'none';
            }
            
            setTimeout(() => {
                filterStatus.style.opacity = '0';
            }, 300);
        }

        toggleView.addEventListener('click', function() {
            currentView = (currentView === 'SI') ? 'NO' : 'SI';
            
            if (currentView === 'NO') {
                this.innerHTML = '<i class="bi bi-clock-history me-1"></i> VER PENDIENTES';
                this.classList.replace('btn-outline-dark', 'btn-dark');
            } else {
                this.innerHTML = '<i class="bi bi-check2-all me-1"></i> VER CONTESTADOS';
                this.classList.replace('btn-dark', 'btn-outline-dark');
            }
            
            filterInquiries();
        });

        inputSearch.addEventListener('input', filterInquiries);
        selectAsunto.addEventListener('change', filterInquiries);
        
        btnReset.addEventListener('click', function() {
            inputSearch.value = '';
            selectAsunto.value = 'ALL';
            filterInquiries();
        });

        // Inicializar
        filterInquiries();
    });
</script>
<?= $this->endSection() ?>
