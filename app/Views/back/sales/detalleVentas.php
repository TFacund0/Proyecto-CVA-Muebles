<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">CONTROL DE VENTAS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col-md-7">
        <h1 class="display-6 fw-bold text-cva-brown mb-0">Control de Pedidos</h1>
        <p class="text-muted">Supervisa la producción, pagos y entregas de tus obras.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="btn-admin-primary">
            <i class="bi bi-hammer"></i>
            <span>PEDIDO PERSONALIZADO</span>
        </a>
    </div>
</div>

<!-- Filtros Avanzados -->
<div class="admin-card-v2 mb-4">
    <div class="admin-card-body-v2 py-4">
        <form method="get" action="<?= base_url('/ventas-list') ?>">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="admin-label">Desde</label>
                    <input type="date" name="fecha_desde" class="form-control admin-control" value="<?= $_GET['fecha_desde'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="admin-label">Hasta</label>
                    <input type="date" name="fecha_hasta" class="form-control admin-control" value="<?= $_GET['fecha_hasta'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="admin-label">Estado de Producción</label>
                    <select name="estado" class="form-control admin-control">
                        <option value="">Todos los estados</option>
                        <option value="PENDIENTE" <?= ($_GET['estado'] ?? '') == 'PENDIENTE' ? 'selected' : '' ?>>🟠 Pendiente</option>
                        <option value="EN_PROCESO" <?= ($_GET['estado'] ?? '') == 'EN_PROCESO' ? 'selected' : '' ?>>🔵 En Proceso</option>
                        <option value="TERMINADO" <?= ($_GET['estado'] ?? '') == 'TERMINADO' ? 'selected' : '' ?>>🟢 Terminado</option>
                        <option value="ENTREGADO" <?= ($_GET['estado'] ?? '') == 'ENTREGADO' ? 'selected' : '' ?>>🔘 Entregado</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn-admin-primary w-100 justify-content-center">
                        <i class="bi bi-funnel"></i> FILTRAR
                    </button>
                    <a href="<?= base_url('/ventas-list') ?>" class="btn-admin-outline px-3" title="Limpiar">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de Pedidos -->
<div class="admin-card-v2">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 admin-label border-0" style="width: 80px;">ID</th>
                    <th class="py-3 admin-label border-0">Fecha / Hora</th>
                    <th class="py-3 admin-label border-0">Cliente / Origen</th>
                    <th class="py-3 admin-label border-0 text-end">Total</th>
                    <th class="py-3 admin-label border-0 text-center">Estado</th>
                    <th class="pe-4 py-3 admin-label border-0 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ventas)): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted small">#<?= $venta['id'] ?></td>
                            <td>
                                <div class="fw-bold text-cva-brown"><?= date('d/m/Y', strtotime($venta['fecha'])) ?></div>
                                <div class="x-small text-muted"><?= date('H:i', strtotime($venta['fecha'])) ?> hs</div>
                            </td>
                            <td>
                                <div class="fw-bold text-cva-brown"><?= esc($venta['nombre_usuario'] ?? 'VENTA MANUAL') ?></div>
                                <div class="x-small text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">
                                    <?= empty($venta['nombre_usuario']) ? 'WhatsApp / Local' : 'Tienda Online' ?>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="fw-bold fs-5 text-dark">
                                    <span class="small opacity-50 fw-normal">$</span><?= number_format($venta['total_venta'], 2, ',', '.') ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $badge_class = "bg-sand text-brown border";
                                    $icon = "bi-clock";
                                    if($venta['estado'] == 'PENDIENTE') { $badge_class = "bg-warning-soft text-warning border-warning"; $icon = "bi-hourglass-split"; }
                                    if($venta['estado'] == 'EN_PROCESO') { $badge_class = "bg-info-soft text-info border-info"; $icon = "bi-tools"; }
                                    if($venta['estado'] == 'TERMINADO') { $badge_class = "bg-success-soft text-success border-success"; $icon = "bi-check-all"; }
                                    if($venta['estado'] == 'ENTREGADO') { $badge_class = "bg-dark text-white"; $icon = "bi-truck"; }
                                ?>
                                <span class="badge px-3 py-2 rounded-pill small fw-bold <?= $badge_class ?>" style="font-size: 0.7rem;">
                                    <i class="bi <?= $icon ?> me-1"></i>
                                    <?= strtoupper($venta['estado']) ?>
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('ventas/gestion/' . $venta['id']) ?>" 
                                       class="btn btn-sm btn-admin-primary rounded-pill px-3 py-1 small">
                                        <i class="bi bi-sliders2 me-1"></i> GESTIONAR
                                    </a>
                                    <a href="<?= base_url('ventas-list/factura/' . $venta['id']) ?>" 
                                       class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-danger" 
                                       title="Ver Factura">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-receipt fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-3 fw-bold">No se registraron ventas en este periodo.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
