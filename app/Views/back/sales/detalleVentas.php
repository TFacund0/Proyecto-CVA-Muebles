<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin-panel.css?v=1.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-wrapper py-5">
    <div class="container">
        <div class="card admin-card">
            
            <!-- Cabecera -->
            <div class="admin-card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="fw-bold"><i class="bi bi-receipt-cutoff me-2"></i> Listado de Ventas</h2>
                        <p class="small mb-0 opacity-75">Control de producción y facturación artesanal</p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="btn btn-admin-gold py-2 px-4 shadow-sm fw-bold">
                            <i class="bi bi-plus-lg me-2"></i> REGISTRAR PEDIDO MANUAL
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <!-- Filtros -->
                <form method="get" action="<?= base_url('/ventas-list') ?>" class="admin-filter-bar">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">FECHA INICIO</label>
                            <input type="date" name="fecha_desde" class="form-control admin-input" value="<?= $_GET['fecha_desde'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">FECHA FIN</label>
                            <input type="date" name="fecha_hasta" class="form-control admin-input" value="<?= $_GET['fecha_hasta'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">ESTADO ACTUAL</label>
                            <select name="estado" class="form-select admin-input">
                                <option value="">Todos los estados</option>
                                <option value="PENDIENTE" <?= ($_GET['estado'] ?? '') == 'PENDIENTE' ? 'selected' : '' ?>>🟠 Pendiente</option>
                                <option value="EN_PROCESO" <?= ($_GET['estado'] ?? '') == 'EN_PROCESO' ? 'selected' : '' ?>>🔵 En Proceso</option>
                                <option value="TERMINADO" <?= ($_GET['estado'] ?? '') == 'TERMINADO' ? 'selected' : '' ?>>🟢 Terminado</option>
                                <option value="ENTREGADO" <?= ($_GET['estado'] ?? '') == 'ENTREGADO' ? 'selected' : '' ?>>🔘 Entregado</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn bg-cva-brown text-white w-100 fw-bold py-2 rounded-3">FILTRAR</button>
                            <a href="<?= base_url('/ventas-list') ?>" class="btn btn-outline-secondary px-3 py-2">X</a>
                        </div>
                    </div>
                </form>

                <!-- Tabla de Ventas -->
                <div class="admin-table-container">
                    <table class="table table-hover admin-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-center"># ID</th>
                                <th>Fecha y Hora</th>
                                <th>Cliente / Detalle</th>
                                <th class="text-end">Total Venta</th>
                                <th class="text-center">Estado Producción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ventas)): ?>
                                <?php foreach ($ventas as $venta): ?>
                                    <tr class="align-middle">
                                        <td class="text-center fw-bold text-muted">#<?= $venta['id'] ?></td>
                                        <td>
                                            <div class="fw-bold"><?= date('d/m/Y', strtotime($venta['fecha'])) ?></div>
                                            <div class="small text-muted"><?= date('H:i', strtotime($venta['fecha'])) ?> hs</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-cva-brown"><?= esc($venta['nombre_usuario'] ?? 'VENTA MANUAL') ?></div>
                                            <div class="small text-muted text-truncate" style="max-width: 200px;"><?= esc($venta['email_usuario'] ?? 'Pedido Directo WhatsApp') ?></div>
                                        </td>
                                        <td class="text-end fw-bold fs-5 text-dark">
                                            <span class="small opacity-50 fw-normal">$</span><?= number_format($venta['total_venta'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                $badge_class = "bg-secondary";
                                                if($venta['estado'] == 'PENDIENTE') $badge_class = "bg-warning text-dark";
                                                if($venta['estado'] == 'EN_PROCESO') $badge_class = "bg-primary";
                                                if($venta['estado'] == 'TERMINADO') $badge_class = "bg-success";
                                                if($venta['estado'] == 'ENTREGADO') $badge_class = "bg-dark";
                                            ?>
                                            <span class="badge rounded-pill px-3 py-2 text-uppercase badge-admin <?= $badge_class ?>">
                                                <?= $venta['estado'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column align-items-center gap-2">
                                                <a href="<?= base_url('ventas/gestion/' . $venta['id']) ?>" class="btn btn-sm btn-outline-brown w-100 rounded-pill py-1 px-3 fw-bold" style="font-size: 0.75rem;">
                                                    <i class="bi bi-sliders2 me-1"></i> GESTIONAR
                                                </a>
                                                <a href="<?= base_url('ventas-list/factura/' . $venta['id']) ?>" class="btn btn-sm btn-outline-danger w-100 rounded-pill py-1 px-3 fw-bold" style="font-size: 0.75rem;">
                                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> FACTURA
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="opacity-50 mb-3" style="font-size: 3rem;">📁</div>
                                        <h5 class="text-muted">No hay registros para mostrar</h5>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
