<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('/ventas-list') ?>" class="text-decoration-none text-muted">CONTROL DE PEDIDOS</a></li>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">GESTIÓN DE PRODUCCIÓN</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Estilo Artisan -->
<div class="row mb-5 align-items-center g-4">
    <div class="col-lg-7">
        <div class="d-flex align-items-center gap-3 gap-md-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-tools"></i>
            </div>
            <div>
                <h1 class="display-6 display-md-5 fw-bold text-cva-brown mb-1">Producción</h1>
                <p class="text-muted mb-0 small">
                    <i class="bi bi-person-badge text-gold me-1"></i> <?= esc($venta['nombre'] . ' ' . $venta['apellido']) ?>
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $venta['usuario'] ?? '') ?>?text=Hola%20<?= urlencode($venta['nombre']) ?>,%20te%20contacto%20por%20tu%20pedido%20#<?= $venta['id'] ?>%20en%20CVA%20Muebles" 
                       target="_blank" class="ms-2 badge bg-success text-white text-decoration-none">
                        <i class="bi bi-whatsapp me-1"></i> Contactar
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-5 text-lg-end">
        <div class="badge bg-gold-soft text-gold px-4 py-2 rounded-pill fs-6 fw-bold border border-gold shadow-sm w-sm-100 justify-content-center">
            #<?= $venta['id'] ?> | <?= date('d M, Y', strtotime($venta['fecha'])) ?>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- COLUMNA PRINCIPAL: DETALLES Y PRODUCCIÓN -->
    <div class="col-lg-8">
        
        <!-- PROGRESO VISUAL O APROBACIÓN -->
        <div class="admin-card-v2 p-4 p-md-5 border-0 shadow-sm mb-4 overflow-hidden">
            <?php if ($venta['estado_aprobacion'] == 'SOLICITUD'): ?>
                <div class="text-center py-4">
                    <div class="bg-gold-soft p-4 rounded-4 mb-4 border border-gold border-opacity-25">
                        <i class="bi bi-shield-lock display-4 text-gold mb-3 d-block"></i>
                        <h4 class="fw-bold text-brown">Pedido Pendiente de Aprobación</h4>
                        <p class="text-muted">Revisa los detalles antes de aceptar este pedido para producción.</p>
                        
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <form action="<?= base_url('ventas/actualizar_estado/' . $venta['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="estado" value="ACEPTADO">
                                <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-sm">
                                    <i class="bi bi-check-lg me-2"></i> ACEPTAR Y EMPEZAR OBRA
                                </button>
                            </form>
                            <form action="<?= base_url('ventas/actualizar_estado/' . $venta['id']) ?>" method="post" onsubmit="return confirm('¿Seguro que deseas rechazar este pedido?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="estado" value="RECHAZADO">
                                <button type="submit" class="btn btn-outline-danger px-5 py-3 rounded-pill fw-bold">
                                    <i class="bi bi-x-lg me-2"></i> RECHAZAR PEDIDO
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h5 class="fw-bold text-brown mb-4"><i class="bi bi-hammer me-2 text-gold"></i> Estado de la Obra</h5>
                
                <div class="production-stepper position-relative py-3">
                    <?php 
                        $steps = ['ACEPTADO', 'EN_PROCESO', 'TERMINADO', 'ENTREGADO'];
                        // Si por algún motivo está en PENDIENTE (manual), lo tratamos como ACEPTADO
                        $estado_visual = ($venta['estado'] == 'PENDIENTE') ? 'ACEPTADO' : $venta['estado'];
                        $current_idx = array_search($estado_visual, $steps);
                        $progress = ($current_idx / (count($steps)-1)) * 100;
                    ?>
                    <div class="progress mb-4" style="height: 10px; background-color: #f0ece2; border-radius: 10px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                             style="width: <?= $progress ?>%; background-color: var(--cva-gold);"></div>
                    </div>
                    <div class="d-flex justify-content-between text-center position-relative">
                        <?php foreach($steps as $idx => $step): ?>
                            <div class="step-item <?= $idx <= $current_idx ? 'active' : '' ?>" style="flex: 1;">
                                <div class="step-dot mb-2 mx-auto shadow-sm"></div>
                                <span class="x-small fw-bold d-block text-uppercase <?= $idx <= $current_idx ? 'text-brown' : 'text-muted' ?>" style="letter-spacing: 0.5px;"><?= $step ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Formulario de cambio de estado -->
                <form action="<?= base_url('ventas/actualizar_estado/' . $venta['id']) ?>" method="post" class="mt-5 pt-4 border-top">
                    <?= csrf_field() ?>
                    <div class="row align-items-center g-3">
                        <div class="col-lg-6">
                            <p class="small text-muted mb-0">Cambia la etapa de producción:</p>
                        </div>
                        <div class="col-lg-4 col-8">
                            <select name="estado" class="form-select admin-control py-2 fw-bold text-uppercase x-small">
                                <?php foreach($steps as $step): ?>
                                    <option value="<?= $step ?>" <?= $venta['estado'] == $step ? 'selected' : '' ?>><?= $step ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <button class="btn btn-admin-gold w-100 py-2" type="submit">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <!-- DETALLES DE LA OBRA -->
        <div class="admin-card-v2 border-0 shadow-sm mb-4 notebook-card overflow-hidden">
            <div class="bg-brown p-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-gold"><i class="bi bi-pencil-square me-2"></i> ESPECIFICACIONES Y OBRA</h6>
                <span class="badge bg-gold-soft text-gold x-small px-3 border border-gold border-opacity-25">Ficha Técnica</span>
            </div>
            
            <?php 
                $obs_clean = $venta['observaciones'] ?? '';
                $img_ref = "";
                if (preg_match('/\[IMG_REF:(.*?)\]/', $obs_clean, $matches)) {
                    $img_ref = $matches[1];
                    $obs_clean = trim(str_replace($matches[0], '', $obs_clean));
                }
            ?>

            <?php if (!empty($obs_clean) || !empty($img_ref)): ?>
            <div class="p-4 border-bottom bg-gold-soft bg-opacity-10">
                <div class="d-flex gap-3">
                    <i class="bi bi-chat-left-quote fs-4 text-gold opacity-50"></i>
                    <div>
                        <span class="admin-label mb-1">Nota del Cliente / Pedido</span>
                        <p class="mb-0 text-brown fw-semibold italic"><?= nl2br(esc($obs_clean)) ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="p-4">
                <?php if (!empty($img_ref)): ?>
                    <div class="mb-4 text-center p-3 border rounded-4 bg-light">
                        <span class="admin-label mb-2 d-block">Imagen de Referencia / Boceto</span>
                        <div class="product-img-zoom-container rounded-3 overflow-hidden shadow-sm d-inline-block" style="max-width: 100%;">
                            <a href="<?= base_url('assets/uploads/referencias/' . $img_ref) ?>" target="_blank">
                                <img src="<?= base_url('assets/uploads/referencias/' . $img_ref) ?>" 
                                     class="img-fluid transition-all" style="max-height: 400px;" alt="Referencia">
                            </a>
                        </div>
                        <div class="mt-2 x-small text-muted italic"><i class="bi bi-zoom-in me-1"></i> Pasa el mouse para ampliar o haz clic para ver original</div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('ventas/guardar_observaciones') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                    <div class="mb-3 position-relative">
                        <textarea name="observaciones" class="form-control artisan-notebook-textarea" rows="8" 
                                  placeholder="Madera: Roble, Medidas: 1.80m x 0.90m, Acabado: Barniz mate..."><?= esc($obs_clean) ?></textarea>
                        
                        <!-- Mantenemos el tag de imagen oculto si existe para no perderlo al guardar -->
                        <?php if ($img_ref): ?>
                            <input type="hidden" name="img_ref_tag" value="[IMG_REF:<?= $img_ref ?>]">
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-admin-gold px-5 py-2 shadow-sm fw-bold">
                            <i class="bi bi-save me-2"></i> GUARDAR ESPECIFICACIONES
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- LISTADO DE ÍTEMS -->
        <div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-4">
            <div class="bg-light py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-brown">Artículos en la Obra</h6>
            </div>
            <div class="table-responsive-stack">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-white d-none d-md-table-header-group">
                        <tr class="x-small text-uppercase text-muted fw-bold">
                            <th class="py-3 px-4 border-0" style="width: 100px;">Imagen</th>
                            <th class="py-3 border-0">Producto</th>
                            <th class="py-3 text-center border-0">Cant.</th>
                            <th class="py-3 text-end border-0">Unit.</th>
                            <th class="py-3 text-end px-4 border-0">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $det): ?>
                        <tr>
                            <td class="ps-4 py-3" data-label="IMAGEN">
                                <?php if (!empty($det['imagen'])): ?>
                                    <div class="product-img-zoom-container rounded-3 border overflow-hidden shadow-sm" style="width: 70px; height: 70px;">
                                        <img src="<?= base_url('assets/uploads/' . $det['imagen']) ?>" 
                                             class="img-fluid h-100 w-100 object-fit-cover transition-all" 
                                             alt="<?= esc($det['nombre_prod']) ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 70px; height: 70px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-3" data-label="PRODUCTO">
                                <div class="fw-bold text-brown"><?= esc($det['nombre_prod']) ?></div>
                                <div class="x-small text-muted">ID: <?= $det['producto_id'] ?? 'CUSTOM' ?></div>
                            </td>
                            <td class="text-center fw-bold" data-label="CANTIDAD"><?= $det['cantidad'] ?></td>
                            <td class="text-end text-muted small" data-label="UNITARIO">$ <?= number_format($det['precio'], 2, ',', '.') ?></td>
                            <td class="text-end px-4 fw-bold text-brown" data-label="SUBTOTAL">$ <?= number_format($det['cantidad'] * $det['precio'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-light border-top border-2">
                        <tr>
                            <td colspan="4" class="text-end py-3 px-4 text-muted x-small fw-bold text-uppercase d-none d-md-table-cell">Total Venta</td>
                            <td class="text-end py-3 px-4 text-brown fw-bold font-lora fs-5" data-label="TOTAL FINAL">$ <?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- COLUMNA LATERAL: PAGOS Y FINANZAS -->
    <div class="col-lg-4">
        
        <!-- ESTADO FINANCIERO -->
        <div class="admin-card-v2 p-4 border-0 shadow-lg mb-4 text-white finance-card position-relative overflow-hidden" 
             style="background: linear-gradient(135deg, #1a0f0d 0%, #3e2723 100%);">
            <div class="position-relative z-1">
                <h6 class="text-gold x-small fw-bold text-uppercase mb-4 tracking-wider">Estado Financiero</h6>
                
                <div class="mb-4">
                    <small class="d-block opacity-50 x-small mb-1">TOTAL COBRADO</small>
                    <h3 class="fw-bold text-success mb-0">$ <?= number_format($total_pagado, 2, ',', '.') ?></h3>
                </div>

                <div class="p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-inner">
                    <small class="d-block opacity-50 x-small mb-1 fw-bold">SALDO PENDIENTE</small>
                    <h2 class="fw-bold font-lora mb-0 <?= $saldo_pendiente > 0 ? 'text-gold' : 'text-success' ?>">
                        $ <?= number_format($saldo_pendiente, 2, ',', '.') ?>
                    </h2>
                </div>
            </div>
            <i class="bi bi-wallet2 position-absolute end-0 bottom-0 text-white opacity-05" style="font-size: 8rem; transform: translate(20%, 20%);"></i>
        </div>

        <!-- REGISTRAR PAGO -->
        <div class="admin-card-v2 border-0 shadow-sm mb-4">
            <div class="p-4">
                <h5 class="fw-bold text-brown mb-4"><i class="bi bi-cash-stack me-2 text-success"></i> Nueva Entrega</h5>
                <form action="<?= base_url('ventas/registrar_pago') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="venta_id" value="<?= $venta['id'] ?>">
                    <div class="mb-3">
                        <label class="x-small fw-bold text-muted text-uppercase mb-2">Monto Recibido</label>
                        <div class="input-group shadow-sm rounded-3 overflow-hidden border-2">
                            <span class="input-group-text bg-white border-end-0 text-gold fw-bold">$</span>
                            <input type="number" step="0.01" name="monto" class="form-control border-start-0 ps-0 fw-bold py-2" required placeholder="0.00">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="x-small fw-bold text-muted text-uppercase mb-2">Concepto / Nota</label>
                        <input type="text" name="nota" class="form-control admin-control py-2" placeholder="Ej: Seña, Entrega materiales...">
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> REGISTRAR COBRO
                    </button>
                </form>
            </div>
        </div>

        <!-- HISTORIAL DE PAGOS -->
        <div class="admin-card-v2 border-0 shadow-sm overflow-hidden mb-5">
            <div class="bg-light py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-brown small text-uppercase">Cronología de Pagos</h6>
            </div>
            <div class="p-0">
                <?php if (empty($pagos)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-clock-history text-muted opacity-25 fs-1"></i>
                        <p class="text-muted small mt-2">Sin movimientos.</p>
                    </div>
                <?php else: ?>
                    <div class="payment-list">
                        <?php foreach ($pagos as $pago): ?>
                            <div class="payment-item d-flex justify-content-between align-items-center p-3 border-bottom bg-white hover-bg-light transition-all">
                                <div>
                                    <div class="fw-bold text-brown">$ <?= number_format($pago['monto'], 2, ',', '.') ?></div>
                                    <small class="text-muted d-block text-truncate x-small" style="max-width: 150px;"><?= esc($pago['nota']) ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-light text-muted fw-normal x-small border"><?= date('d/m/y', strtotime($pago['fecha'])) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-icon-main {
        width: 60px; height: 60px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 1.2rem;
        font-size: 1.8rem;
    }
    .bg-gold-soft { background: #fff9f0; }
    .bg-success-soft { background: #f0fff4; }
    .bg-info-soft { background: #f0f7ff; }
    .tracking-wider { letter-spacing: 1.5px; }

    /* Stepper Producción */
    .step-dot { 
        width: 18px; height: 18px; 
        border-radius: 50%; 
        background-color: #f0ece2; 
        border: 3px solid #fff; 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        position: relative; 
        z-index: 2; 
    }
    .step-item.active .step-dot { 
        background-color: var(--cva-gold); 
        transform: scale(1.2);
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.15); 
    }
    
    /* Estilo Cuaderno Artisan */
    .artisan-notebook-textarea {
        background-color: #fff;
        background-image: linear-gradient(#f9f9f9 .1em, transparent .1em);
        background-size: 100% 1.5em;
        line-height: 1.5em;
        padding: 1.5em;
        border: 1px solid #e0d5c5;
        border-radius: 1rem;
        color: #5d4037;
        font-family: inherit;
        transition: all 0.3s ease;
    }
    .artisan-notebook-textarea:focus {
        border-color: var(--cva-gold);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .opacity-05 { opacity: 0.05; }
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
    .hover-bg-light:hover { background-color: #fcfcfc !important; }
    .transition-all { transition: all 0.3s ease; }

    .btn-admin-gold {
        background: var(--cva-brown);
        color: var(--cva-gold);
        border: 2px solid var(--cva-gold);
        border-radius: 12px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-admin-gold:hover {
        background: var(--cva-gold);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(184, 134, 11, 0.2);
    }

    /* Zoom Effect for Images */
    .product-img-zoom-container {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .product-img-zoom-container:hover img {
        transform: scale(1.5);
    }
    .object-fit-cover { object-fit: cover; }
    .transition-all { transition: all 0.4s ease; }

    @media (max-width: 767.98px) {
        .step-item span { 
            font-size: 0.55rem !important; 
            letter-spacing: 0 !important;
            white-space: nowrap;
        }
        .step-item:nth-child(even) span {
            margin-top: 5px;
        }
        .production-stepper { padding: 10px 0 !important; }
        .finance-card h3 { font-size: 1.4rem !important; }
        .finance-card h2 { font-size: 1.7rem !important; }
        .artisan-notebook-textarea { padding: 1rem; font-size: 0.9rem; }
        
        .d-flex.justify-content-center.gap-3.mt-4 {
            flex-direction: column !important;
            width: 100% !important;
            gap: 0.75rem !important;
            margin-top: 2rem !important;
        }
        .d-flex.justify-content-center.gap-3.mt-4 form, 
        .d-flex.justify-content-center.gap-3.mt-4 button {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .display-6.display-md-5 { font-size: 1.6rem !important; }
        .w-sm-100 { width: 100% !important; }
        .admin-card-v2 { overflow: hidden !important; }
        .bi-wallet2 { font-size: 5rem !important; opacity: 0.03 !important; }
    }
</style>

<?= $this->endSection() ?>
