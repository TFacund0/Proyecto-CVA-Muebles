<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2" style="color: var(--color-madera-oscura);">Gestión de Pedido #<?= $venta['id'] ?></h1>
        <a href="<?= base_url('ventas-list') ?>" class="btn btn-outline-secondary btn-sm">Volver al listado</a>
    </div>

    <div class="row g-4">
        <!-- Columna Izquierda: Información del Pedido y Detalles -->
        <div class="col-lg-8">
            <!-- Card: Información General -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Información General</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> <?= esc($venta['nombre'] . ' ' . $venta['apellido']) ?></p>
                            <p><strong>Usuario:</strong> <?= esc($venta['usuario']) ?></p>
                            <p><strong>Email:</strong> <?= esc($venta['email']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></p>
                            <p><strong>Estado Actual:</strong> 
                                <span class="badge bg-<?= $venta['estado'] == 'ENTREGADO' ? 'success' : ($venta['estado'] == 'PENDIENTE' ? 'warning text-dark' : 'info') ?>">
                                    <?= $venta['estado'] ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Detalles del Mueble (Observaciones) -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detalles de la Obra (Muebles a Medida)</h5>
                    <i class="text-muted small">Cualquier especificación técnica o pedido especial</i>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('ventas/guardar_observaciones') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                        <div class="mb-3">
                            <textarea name="observaciones" class="form-control" rows="5" placeholder="Escribe aquí los detalles del mueble (materiales, dimensiones, acabados, etc.)..."><?= esc($venta['observaciones']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-4">Guardar Detalles</button>
                    </form>
                </div>
            </div>

            <!-- Card: Ítems del Pedido -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Productos Seleccionados</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unit.</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalles as $det): ?>
                            <tr>
                                <td><?= esc($det['nombre_prod']) ?></td>
                                <td class="text-center"><?= $det['cantidad'] ?></td>
                                <td class="text-end">$<?= number_format($det['precio'], 2) ?></td>
                                <td class="text-end">$<?= number_format($det['cantidad'] * $det['precio'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="3" class="text-end">TOTAL VENTA:</td>
                                <td class="text-end" style="color: var(--color-madera-oscura);">$<?= number_format($venta['total_venta'], 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Pagos y Resumen Financiero -->
        <div class="col-lg-4">
            <!-- Resumen Financiero -->
            <div class="card shadow-sm mb-4 border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-4">Estado de Cuenta</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Venta:</span>
                        <span class="fw-bold">$<?= number_format($venta['total_venta'], 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Total Cobrado:</span>
                        <span class="fw-bold">$<?= number_format($total_pagado, 2) ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0 <?= $saldo_pendiente > 0 ? 'text-danger' : 'text-success' ?>">
                        <span class="h6">Saldo Pendiente:</span>
                        <span class="h5 fw-bold">$<?= number_format($saldo_pendiente, 2) ?></span>
                    </div>
                </div>
            </div>

            <!-- Formulario: Registrar Pago -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Registrar Entrega de Dinero</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('ventas/registrar_pago') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Monto ($)</label>
                            <input type="number" step="0.01" name="monto" class="form-control" required placeholder="0.00">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nota/Concepto</label>
                            <input type="text" name="nota" class="form-control" placeholder="Eje: Seña inicial, Cuota 1...">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Registrar Pago</button>
                    </form>
                </div>
            </div>

            <!-- Historial de Pagos -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Historial de Pagos</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($pagos)): ?>
                        <p class="text-center text-muted py-4">No hay pagos registrados.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($pagos as $pago): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">$<?= number_format($pago['monto'], 2) ?></div>
                                    <small class="text-muted"><?= esc($pago['nota']) ?></small>
                                </div>
                                <span class="badge bg-light text-dark border"><?= date('d/m/y', strtotime($pago['fecha'])) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --color-madera-oscura: #5d4037;
    }
    .card {
        border-radius: 12px;
    }
    .card-header {
        border-bottom: 1px solid #f0f0f0;
        border-radius: 12px 12px 0 0 !important;
    }
    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }
</style>
