<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
<style>
    .order-status-badge {
        padding: 0.5rem 1.5rem;
        border-radius: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
    }
    .status-pendiente { background: #fff3cd; color: #856404; }
    .status-solicitado { background: #e2e3e5; color: #383d41; }
    .status-aceptado { background: #d4edda; color: #155724; }
    .status-rechazado { background: #f8d7da; color: #721c24; }
    .status-entregado { background: #cce5ff; color: #004085; }

    .payment-summary-card {
        background: #fdfaf7;
        border-radius: 1.5rem;
        border: 1px solid #f0e6d6;
        padding: 2rem;
    }
    .payment-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }
    .payment-total {
        border-top: 2px dashed #eeebe6;
        margin-top: 1rem;
        padding-top: 1rem;
        font-size: 1.25rem;
    }
    .product-preview-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-top: 0.5rem;
        display: none;
        animation: fadeIn 0.3s ease;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
        cursor: default;
    }
    .product-preview-card.active { display: block; }
    .preview-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 1.25rem;
        border: 2px solid #f0e6d6;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .badge-preview-trigger {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .badge-preview-trigger:hover {
        color: var(--cva-gold) !important;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Ajuste para móviles: que el detalle se vea al centro si no hay espacio a la derecha */
    @media (max-width: 991px) {
        .product-preview-card {
            position: fixed !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            width: 90% !important;
            max-width: 350px !important;
            z-index: 9999 !important;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row g-4">
        <!-- Detalle del Pedido -->
        <div class="col-lg-8">
            <div class="bg-white rounded-5 p-4 p-md-5 shadow-sm border">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-cva-brown mb-1">Pedido #<?= $venta['id'] ?></h2>
                        <p class="text-muted mb-0">Fecha: <?= date('d/m/Y', strtotime($venta['fecha'])) ?></p>
                    </div>
                    <?php 
                        $status_class = 'status-' . strtolower($venta['estado']);
                        $status_label = $venta['estado'];

                        if (($venta['estado_aprobacion'] ?? '') == 'SOLICITUD') {
                            $status_class = 'status-solicitado';
                            $status_label = 'POR APROBAR';
                        } elseif (($venta['estado_aprobacion'] ?? '') == 'RECHAZADO') {
                            $status_class = 'status-rechazado';
                            $status_label = 'RECHAZADO';
                        }
                    ?>
                    <span class="order-status-badge <?= $status_class ?>">
                        <?= $status_label ?>
                    </span>
                </div>

                <div class="table-responsive" style="overflow: visible !important;">
                    <table class="table table-borderless">
                        <thead class="border-bottom">
                            <tr>
                                <th class="py-3 text-muted">Obra / Producto</th>
                                <th class="py-3 text-center text-muted">Cant.</th>
                                <th class="py-3 text-end text-muted">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalles as $item): ?>
                                <tr class="border-bottom">
                                    <td class="py-4">
                                        <div class="position-relative d-inline-block">
                                            <div class="badge-preview-trigger" onclick="togglePreview('preview-<?= $item['id'] ?>', this)">
                                                <div class="fw-bold text-cva-brown"><?= esc($item['nombre_prod']) ?></div>
                                                <small class="text-muted">Ver detalle artesanal <i class="bi bi-chevron-right x-small"></i></small>
                                            </div>

                                            <div id="preview-<?= $item['id'] ?>" class="product-preview-card position-absolute z-3" style="width: 320px; left: calc(100% + 20px); top: -40px;">
                                                <div class="text-center mb-3">
                                                    <?php if(!empty($item['imagen'])): ?>
                                                        <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" class="preview-img mb-3" alt="<?= esc($item['nombre_prod']) ?>">
                                                    <?php else: ?>
                                                        <div class="preview-img bg-light d-flex align-items-center justify-content-center mx-auto mb-3">
                                                            <i class="bi bi-hammer text-muted display-6"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <h5 class="fw-bold text-cva-brown mb-1"><?= esc($item['nombre_prod']) ?></h5>
                                                    <span class="text-gold fw-bold">$<?= number_format($item['precio'], 0, ',', '.') ?></span>
                                                </div>
                                                <p class="text-muted small italic mb-0 text-center">
                                                    <?= !empty($item['descripcion']) ? esc($item['descripcion']) : 'Pieza única fabricada con técnicas artesanales tradicionales.' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-center fw-bold text-muted"><?= $item['cantidad'] ?></td>
                                    <td class="py-4 text-end fw-bold text-cva-brown">$<?= number_format($item['cantidad'] * $item['precio'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($venta['observaciones'])): ?>
                    <div class="mt-5 p-4 bg-light rounded-4">
                        <h6 class="fw-bold text-cva-brown mb-2"><i class="bi bi-chat-left-text me-2"></i>Tus especificaciones:</h6>
                        <p class="mb-0 text-muted italic">"<?= esc($venta['observaciones']) ?>"</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Resumen de Pagos -->
        <div class="col-lg-4">
            <div class="payment-summary-card shadow-sm sticky-top" style="top: 100px;">
                <h5 class="fw-bold text-cva-brown mb-4">Estado de Cuenta</h5>
                
                <div class="payment-line">
                    <span class="text-muted">Total de la Obra</span>
                    <span class="fw-bold">$<?= number_format($venta['total_venta'], 0, ',', '.') ?></span>
                </div>
                
                <div class="payment-line">
                    <span class="text-muted">Pagos Realizados</span>
                    <span class="fw-bold text-success">-$<?= number_format($total_pagado, 0, ',', '.') ?></span>
                </div>

                <div class="payment-line payment-total">
                    <span class="fw-bold text-cva-brown">Saldo Pendiente</span>
                    <span class="fw-bold text-danger">$<?= number_format($saldo_pendiente, 0, ',', '.') ?></span>
                </div>

                <?php if ($saldo_pendiente > 0): ?>
                    <div class="mt-4 p-3 bg-white rounded-4 border shadow-sm">
                        <p class="small text-muted mb-3">
                            <i class="bi bi-info-circle me-1 text-gold"></i>
                            Ponte en contacto con nosotros por WhatsApp para coordinar los pagos restantes o cuotas.
                        </p>
                        <?php 
                            $wa_num = "5493794098511";
                            $msg = urlencode("Hola! Soy " . session()->get('nombre') . ", quería consultar sobre los pagos de mi pedido #" . $venta['id']);
                            $wa_url = "https://wa.me/{$wa_num}?text={$msg}";
                        ?>
                        <a href="<?= $wa_url ?>" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold small">
                            <i class="bi bi-whatsapp me-2"></i> COORDINAR PAGO
                        </a>
                    </div>
                <?php else: ?>
                    <div class="mt-4 p-3 bg-success bg-opacity-10 text-success rounded-4 border border-success">
                        <p class="small mb-0 fw-bold">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            El pedido ha sido pagado en su totalidad.
                        </p>
                    </div>
                <?php endif; ?>

                <hr class="my-4">

                <h6 class="fw-bold text-cva-brown mb-3">Historial de Pagos</h6>
                <?php if (!empty($pagos)): ?>
                    <ul class="list-unstyled small mb-0">
                        <?php foreach ($pagos as $pago): ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span><?= date('d/m/y', strtotime($pago['fecha'])) ?> - <?= esc($pago['nota'] ?: 'Pago') ?></span>
                                <span class="fw-bold">$<?= number_format($pago['monto'], 0, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="small text-muted mb-0">No se han registrado pagos aún.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        function togglePreview(id, element) {
            document.querySelectorAll('.product-preview-card').forEach(card => {
                if(card.id !== id) card.classList.remove('active');
            });
            const card = document.getElementById(id);
            card.classList.toggle('active');
            document.addEventListener('click', function close(e) {
                if (!card.contains(e.target) && !element.contains(e.target)) {
                    card.classList.remove('active');
                    document.removeEventListener('click', close);
                }
            });
        }
    </script>
</div>
<?= $this->endSection() ?>
