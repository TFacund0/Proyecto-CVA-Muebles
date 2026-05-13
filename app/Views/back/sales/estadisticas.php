<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active text-gold fw-bold" aria-current="page">ESTADÍSTICAS DEL TALLER</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Dinámico Refinado -->
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center gap-4 mb-3">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-activity"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold text-cva-brown mb-1">Estado de Producción</h1>
                <p class="text-muted mb-0"><i class="bi bi-check2-circle text-success me-1"></i> Monitoreo en tiempo real de pedidos y consultas.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-md-end">
        <div class="stats-timer shadow-sm border">
            <span class="pulse-dot"></span>
            ACTUALIZACIÓN VIVA: <?= date('H:i') ?>
        </div>
    </div>
</div>

<!-- Grid de KPIs Interactivos -->
<div class="row g-4 mb-5">
    <?php 
    $kpis = [
        ['label' => 'Pendientes', 'val' => $stats['PENDIENTE'], 'icon' => 'bi-hourglass-split', 'color' => 'warning', 'link' => 'ventas-list?estado=PENDIENTE', 'desc' => 'POR INICIAR'],
        ['label' => 'En Taller', 'val' => $stats['EN_PROCESO'], 'icon' => 'bi-hammer', 'color' => 'info', 'link' => 'ventas-list?estado=EN_PROCESO', 'desc' => 'FABRICANDO'],
        ['label' => 'Terminados', 'val' => $stats['TERMINADO'], 'icon' => 'bi-check-all', 'color' => 'success', 'link' => 'ventas-list?estado=TERMINADO', 'desc' => 'PARA ENTREGA'],
        ['label' => 'Consultas', 'val' => $total_consultas, 'icon' => 'bi-chat-left-text', 'color' => 'gold', 'link' => '/consultas', 'desc' => 'INBOX ACTIVO']
    ];
    foreach($kpis as $kpi): 
    ?>
    <div class="col-md-3">
        <a href="<?= base_url($kpi['link']) ?>" class="text-decoration-none h-100 d-block">
            <div class="kpi-card-premium border-<?= $kpi['color'] ?> h-100">
                <div class="kpi-body p-4 text-center">
                    <div class="kpi-icon-container mx-auto mb-3 bg-<?= $kpi['color'] ?>-soft text-<?= $kpi['color'] ?>">
                        <i class="bi <?= $kpi['icon'] ?>"></i>
                    </div>
                    <h6 class="kpi-label"><?= $kpi['label'] ?></h6>
                    <div class="kpi-value text-cva-brown"><?= $kpi['val'] ?></div>
                    <div class="kpi-footer text-<?= $kpi['color'] ?> fw-bold x-small mt-2">
                        <?= $kpi['desc'] ?> <i class="bi bi-chevron-right ms-1"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="row g-4">
    <!-- Acciones Rápidas (Volvemos a 8 unidades) -->
    <div class="col-lg-8">
        <div class="admin-card-v2 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-cva-brown mb-0">
                    <i class="bi bi-lightning-charge-fill text-gold me-2"></i> 
                    Acciones de Gestión Directa
                </h5>
                <span class="badge bg-light text-muted border rounded-pill px-3">Accesos Rápidos</span>
            </div>
            <div class="row g-3 h-100 pb-4">
                <div class="col-md-6 d-flex">
                    <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="action-btn-v2 flex-grow-1">
                        <div class="action-icon"><i class="bi bi-hammer"></i></div>
                        <div class="action-text">
                            <span class="d-block fw-bold">Pedido Manual</span>
                            <small class="text-muted">Venta local / WhatsApp</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="<?= base_url('/alta-producto') ?>" class="action-btn-v2 flex-grow-1">
                        <div class="action-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="action-text">
                            <span class="d-block fw-bold">Subir Producto</span>
                            <small class="text-muted">Actualizar catálogo</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="<?= base_url('/ventas-list') ?>" class="action-btn-v2 flex-grow-1">
                        <div class="action-icon"><i class="bi bi-card-checklist"></i></div>
                        <div class="action-text">
                            <span class="d-block fw-bold">Ver Ventas</span>
                            <small class="text-muted">Control de facturas</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="<?= base_url('/consultas') ?>" class="action-btn-v2 flex-grow-1">
                        <div class="action-icon"><i class="bi bi-envelope-paper"></i></div>
                        <div class="action-text">
                            <span class="d-block fw-bold">Inbox Consultas</span>
                            <small class="text-muted">Gestión de clientes</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de Rendimiento (4 unidades) -->
    <div class="col-lg-4">
        <?php 
            $total_pedidos = $stats['PENDIENTE'] + $stats['EN_PROCESO'] + $stats['TERMINADO'] + $stats['ENTREGADO'];
            $porcentaje = ($total_pedidos > 0) ? round(($stats['ENTREGADO'] / $total_pedidos) * 100) : 0;
        ?>
        <div class="admin-card-v2 h-100 bg-cva-brown text-white border-0 shadow-gold d-flex flex-column p-4">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2 text-gold">
                <i class="bi bi-award"></i> RENDIMIENTO HISTÓRICO
            </h6>
            <p class="x-small opacity-75 mb-auto">Métricas de éxito acumuladas en la fabricación y entrega de piezas artesanales.</p>
            
            <div class="production-display-compact p-4 rounded-4 border border-white border-opacity-10 my-4 text-center bg-white bg-opacity-5">
                <div class="text-gold display-4 fw-bold mb-0 lh-1"><?= $stats['ENTREGADO'] ?></div>
                <div class="x-small text-uppercase fw-bold opacity-50 tracking-widest mt-2">Muebles Entregados</div>
            </div>

            <div class="mt-auto">
                <div class="d-flex justify-content-between x-small fw-bold mb-2">
                    <span class="opacity-75">EFICIENCIA GLOBAL</span>
                    <span class="text-gold"><?= $porcentaje ?>%</span>
                </div>
                <div class="progress" style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 50px;">
                    <div class="progress-bar bg-gold progress-bar-striped progress-bar-animated" style="width: <?= $porcentaje ?>%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos Locales de Dashboard - No tocan el CORE */
    .dashboard-icon-main {
        width: 60px; height: 60px;
        background: #1a0f0d;
        color: var(--cva-gold);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        border-radius: 1.2rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .stats-timer {
        display: inline-flex; align-items: center;
        background: white; padding: 0.5rem 1.2rem;
        border-radius: 50px; font-weight: 700; font-size: 0.8rem;
        color: #5d4037;
    }
    .pulse-dot {
        width: 8px; height: 8px; background: #28a745;
        border-radius: 50%; margin-right: 10px;
        animation: pulse-green 2s infinite;
    }
    @keyframes pulse-green {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    .kpi-card-premium {
        background: white; border-radius: 1.5rem;
        box-shadow: var(--admin-card-shadow);
        border-bottom: 4px solid transparent;
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .kpi-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .kpi-icon-container {
        width: 65px; height: 65px; border-radius: 1.2rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
    }
    .kpi-label { font-weight: 800; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1px; color: #999; }
    .kpi-value { font-size: 2.8rem; font-weight: 800; line-height: 1; margin: 0.5rem 0; }
    
    .action-btn-v2 {
        display: flex; align-items: center; gap: 1rem;
        background: white; padding: 1.5rem; border-radius: 1.2rem;
        border: 1px solid #eeebe6; text-decoration: none; color: inherit;
        transition: all 0.3s ease;
    }
    .action-btn-v2:hover {
        background: #fdfaf7; border-color: var(--cva-gold); transform: translateX(5px);
    }
    .action-icon {
        width: 45px; height: 45px; background: #eeebe6;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; color: var(--cva-brown);
    }
    .action-btn-v2:hover .action-icon { background: var(--cva-gold); color: white; }
    
    .shadow-gold { box-shadow: 0 20px 40px rgba(184, 134, 11, 0.15); }
    .bg-warning-soft { background: #fff9db; }
    .bg-info-soft { background: #e7f5ff; }
    .bg-success-soft { background: #ebfbee; }
    .bg-gold-soft { background: #fff4e6; }
</style>
<?= $this->endSection() ?>
