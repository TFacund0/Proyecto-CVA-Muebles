<!-- 
  =============================================
  ARTISAN ORDER MANAGEMENT - DASHBOARD PRO
  =============================================
-->

<div class="management-wrapper py-5">
    <div class="container">
        <!-- Cabecera de Impacto -->
        <div class="management-header p-4 p-md-5 text-white rounded-5 shadow-lg mb-5" style="background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="badge bg-gold-artisan px-3 py-2">PEDIDO #<?= $venta['id'] ?></span>
                        <span class="opacity-75">|</span>
                        <span class="small opacity-75"><i class="bi bi-calendar3 me-1"></i> <?= date('d M, Y', strtotime($venta['fecha'])) ?></span>
                    </div>
                    <h1 class="display-5 fw-bold font-lora mb-2">Gestión de Producción</h1>
                    <p class="lead opacity-75 mb-0 text-truncate">Cliente: <?= esc($venta['nombre'] . ' ' . $venta['apellido']) ?></p>
                </div>
                <div class="col-md-5 text-md-end mt-4 mt-md-0">
                    <a href="<?= base_url('ventas-list') ?>" class="btn btn-outline-light rounded-pill px-4 btn-sm">
                        <i class="bi bi-arrow-left me-2"></i> VOLVER AL LISTADO
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- COLUMNA PRINCIPAL: DETALLES Y PRODUCCIÓN -->
            <div class="col-lg-8">
                
                <!-- PROGRESO VISUAL DE PRODUCCIÓN -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold text-brown mb-4"><i class="bi bi-hammer me-2 text-gold"></i> Estado de la Obra</h5>
                        
                        <div class="production-stepper">
                            <?php 
                                $steps = ['PENDIENTE', 'EN_PROCESO', 'TERMINADO', 'ENTREGADO'];
                                $current_idx = array_search($venta['estado'], $steps);
                            ?>
                            <div class="progress mb-4" style="height: 8px; background-color: #f0ece2;">
                                <div class="progress-bar bg-gold-artisan" role="progressbar" style="width: <?= ($current_idx / (count($steps)-1)) * 100 ?>%"></div>
                            </div>
                            <div class="d-flex justify-content-between text-center">
                                <?php foreach($steps as $idx => $step): ?>
                                    <div class="step-item <?= $idx <= $current_idx ? 'active' : '' ?>">
                                        <div class="step-dot mb-2 mx-auto"></div>
                                        <span class="small fw-bold d-block text-uppercase" style="font-size: 0.65rem;"><?= $step ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Formulario de cambio de estado -->
                        <form action="<?= base_url('ventas/actualizar_estado/' . $venta['id']) ?>" method="post" class="mt-5 pt-4 border-top">
                            <?= csrf_field() ?>
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <p class="small text-muted mb-md-0">Actualiza el estado para que el cliente y el taller estén sincronizados.</p>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <select name="estado" class="form-select artisan-input-sm">
                                            <?php foreach($steps as $step): ?>
                                                <option value="<?= $step ?>" <?= $venta['estado'] == $step ? 'selected' : '' ?>><?= $step ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-artisan-dark px-3" type="submit">ACTUALIZAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DETALLES TÉCNICOS (OBSERVACIONES) -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 notebook-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-brown mb-0"><i class="bi bi-pencil-square me-2 text-gold"></i> Notas del Maestro Artesano</h5>
                        <span class="badge bg-light text-muted border px-3">Especif. Técnicas</span>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('ventas/guardar_observaciones') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                            <div class="mb-3">
                                <textarea name="observaciones" class="form-control artisan-notebook-textarea" rows="8" placeholder="Madera: Roble, Medidas: 1.80m x 0.90m, Acabado: Barniz mate..."><?= esc($venta['observaciones']) ?></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-artisan-dark px-5 py-2 shadow-sm fw-bold">GUARDAR ESPECIFICACIONES</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- LISTADO DE ÍTEMS -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-light py-3 px-4 border-0">
                        <h6 class="mb-0 fw-bold text-brown">Ítems Vinculados al Pedido</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-white">
                                <tr class="small text-uppercase text-muted">
                                    <th class="py-3 px-4">Producto / Descripción</th>
                                    <th class="py-3 text-center">Cant.</th>
                                    <th class="py-3 text-end">Precio Unit.</th>
                                    <th class="py-3 text-end px-4">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalles as $det): ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold text-brown"><?= esc($det['nombre_prod']) ?></div>
                                        <div class="small text-muted">Ref: #ID-<?= $det['producto_id'] ?? 'MANUAL' ?></div>
                                    </td>
                                    <td class="text-center fw-bold"><?= $det['cantidad'] ?></td>
                                    <td class="text-end">$<?= number_format($det['precio'], 2, ',', '.') ?></td>
                                    <td class="text-end px-4 fw-bold">$<?= number_format($det['cantidad'] * $det['precio'], 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="bg-artisan-cream border-top-0">
                                <tr class="fs-5">
                                    <td colspan="3" class="text-end py-3 px-4 text-brown fw-bold">TOTAL VENTA:</td>
                                    <td class="text-end py-3 px-4 text-brown fw-bold font-lora">$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- COLUMNA LATERAL: PAGOS Y FINANZAS -->
            <div class="col-lg-4">
                
                <!-- ESTADO FINANCIERO -->
                <div class="card border-0 shadow-lg rounded-4 mb-4 text-white finance-summary-card" style="background: #3e2723;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 opacity-75">Resumen Financiero</h5>
                        
                        <div class="mb-4">
                            <small class="d-block opacity-75 mb-1">Total Cobrado</small>
                            <h3 class="fw-bold text-success">$<?= number_format($total_pagado, 2, ',', '.') ?></h3>
                        </div>

                        <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <small class="d-block opacity-75 mb-1 text-uppercase fw-bold" style="font-size: 0.65rem;">Saldo Pendiente</small>
                            <h2 class="fw-bold font-lora mb-0 <?= $saldo_pendiente > 0 ? 'text-gold' : 'text-success' ?>">
                                $<?= number_format($saldo_pendiente, 2, ',', '.') ?>
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- REGISTRAR PAGO -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold text-brown mb-0"><i class="bi bi-cash-stack me-2 text-success"></i> Nueva Entrega</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('ventas/registrar_pago') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">MONTO RECIBIDO ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">$</span>
                                    <input type="number" step="0.01" name="monto" class="form-control border-start-0 ps-0 artisan-input" required placeholder="0.00">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">CONCEPTO / NOTA</label>
                                <input type="text" name="nota" class="form-control artisan-input" placeholder="Ej: Pago de materiales, Seña...">
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-3">REGISTRAR COBRO</button>
                        </form>
                    </div>
                </div>

                <!-- HISTORIAL DE PAGOS -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-light py-3 px-4 border-0">
                        <h6 class="mb-0 fw-bold text-brown">Cronología de Pagos</h6>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($pagos)): ?>
                            <div class="text-center py-5">
                                <i class="bi bi-info-circle text-muted mb-2 fs-3"></i>
                                <p class="text-muted small">No hay pagos registrados aún.</p>
                            </div>
                        <?php else: ?>
                            <div class="payment-list">
                                <?php foreach ($pagos as $pago): ?>
                                    <div class="payment-item d-flex justify-content-between align-items-center p-3 border-bottom">
                                        <div>
                                            <div class="fw-bold text-brown">$<?= number_format($pago['monto'], 2, ',', '.') ?></div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 150px;"><?= esc($pago['nota']) ?></small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-light text-dark border-0 small text-muted"><?= date('d/m/y', strtotime($pago['fecha'])) ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Lora:wght@700&display=swap');

    :root {
        --artisan-dark: #3e2723;
        --artisan-gold: #b8860b;
        --artisan-cream: #fdfaf5;
    }

    .management-wrapper { background-color: #f8f5f0; font-family: 'Outfit', sans-serif; min-height: 100vh; }
    .font-lora { font-family: 'Lora', serif; }
    .text-brown { color: var(--artisan-dark); }
    .text-gold { color: var(--artisan-gold); }
    .bg-gold-artisan { background-color: var(--artisan-gold); color: white; }
    .bg-artisan-cream { background-color: var(--artisan-cream); }
    .btn-artisan-dark { background-color: var(--artisan-dark); color: white; border-radius: 8px; transition: all 0.3s; }
    .btn-artisan-dark:hover { background-color: var(--artisan-gold); color: white; }

    /* Stepper Producción */
    .step-dot { width: 14px; height: 14px; border-radius: 50%; background-color: #f0ece2; border: 2px solid #fff; transition: all 0.3s; position: relative; z-index: 2; }
    .step-item.active .step-dot { background-color: var(--artisan-gold); box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.2); }
    .step-item.active span { color: var(--artisan-dark); }

    /* Estilo Cuaderno */
    .artisan-notebook-textarea {
        background-color: #fff;
        background-image: linear-gradient(#f0f0f0 .1em, transparent .1em);
        background-size: 100% 1.5em;
        line-height: 1.5em;
        padding: 1.5em;
        border: 1px solid #e0d5c5;
        border-radius: 8px;
        color: #5d4037;
        font-family: 'Outfit', sans-serif;
    }
    .artisan-notebook-textarea:focus { background-color: #fff; border-color: var(--artisan-gold); box-shadow: none; }

    .artisan-input { border: 1px solid #d7ccc8; border-radius: 8px; }
    .artisan-input-sm { border: 1px solid #d7ccc8; border-radius: 8px; font-size: 0.9rem; }
    
    .payment-item:last-child { border-bottom: 0; }
    .finance-summary-card { position: relative; overflow: hidden; }
    .finance-summary-card::after { content: '⚒️'; position: absolute; right: -10px; bottom: -10px; font-size: 8rem; opacity: 0.05; pointer-events: none; }
</style>
