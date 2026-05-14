<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <style>
        .purchases-wrapper {
            background-color: #fdfaf7;
            min-height: 80vh;
            padding: 4rem 0;
        }

        .purchase-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: inherit;
        }

        .purchase-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(62, 39, 35, 0.08);
            border-color: var(--cva-gold);
        }

        .purchase-icon {
            width: 60px;
            height: 60px;
            background: #f9f4eb;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--cva-gold);
            margin-right: 1.5rem;
        }

        .purchase-info {
            flex-grow: 1;
        }

        .status-badge {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.4rem 1rem;
            border-radius: 50px;
        }

        .status-pendiente { background: #fff8e1; color: #f57f17; }
        .status-en_proceso { background: #e3f2fd; color: #1976d2; }
        .status-terminado { background: #e8f5e9; color: #2e7d32; }
        .status-entregado { background: #f3e5f5; color: #7b1fa2; }

        .empty-history {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: 2rem;
            border: 2px dashed #eeebe6;
        }

        /* ESTILO WHATSAPP VIP */
        .btn-whatsapp-vip {
            background-color: #25D366;
            color: white;
            border: none;
            font-weight: 800;
            font-size: 0.65rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-whatsapp-vip:hover {
            background-color: #128C7E;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        .animate-pulse-subtle {
            animation: pulse-vip 3s infinite;
        }

        @keyframes pulse-vip {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="purchases-wrapper">
    <div class="container">
        <div class="mb-5">
            <h1 class="fw-bold text-cva-brown mb-2">Mi Historial de Obras</h1>
            <p class="text-muted">Todas las piezas que has adquirido para tu hogar.</p>
        </div>

        <?php if (!empty($ventas)): ?>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php foreach ($ventas as $venta): ?>
                        <?php 
                            $status_class = 'status-' . strtolower($venta['estado'] ?? 'pendiente');
                            $status_label = $venta['estado'] ?? 'PENDIENTE';
                        ?>
                        <a href="<?= base_url('factura/' . $venta['id']) ?>" class="purchase-card shadow-sm">
                            <div class="d-flex align-items-center">
                                <div class="purchase-icon">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div class="purchase-info">
                                    <h5 class="fw-bold text-cva-brown mb-1">Pedido #<?= $venta['id'] ?></h5>
                                    <p class="small text-muted mb-0">
                                        Realizado el <?= date('d/m/Y', strtotime($venta['fecha'])) ?> a las <?= date('H:i', strtotime($venta['fecha'])) ?>hs
                                    </p>
                                </div>
                            </div>
                            
                            <div class="text-end d-flex align-items-center gap-4">
                                <div class="d-none d-md-block">
                                    <span class="status-badge <?= $status_class ?>">
                                        <?= $status_label ?>
                                    </span>
                                </div>
                                <div class="purchase-amount text-end">
                                    <p class="small text-muted mb-0">Total Invertido</p>
                                    <p class="fw-bold text-cva-brown mb-0 fs-5">$<?= number_format($venta['total_venta'], 0, ',', '.') ?></p>
                                </div>
                                <div class="text-gold fs-4">
                                    <i class="bi bi-chevron-right"></i>
                                </div>
                            </div>
                        </a>
                        
                        <!-- BOTÓN WHATSAPP VIP (PASO 4) -->
                        <div class="text-end mt-n2 mb-4 pe-3">
                            <?php 
                                $wa_num = "5493794098511";
                                $msg = urlencode("Hola! Soy " . session()->get('nombre') . ", quería hacer una consulta VIP sobre mi pedido #" . $venta['id'] . " realizado el " . date('d/m/Y', strtotime($venta['fecha'])));
                                $wa_url = "https://wa.me/{$wa_num}?text={$msg}";
                            ?>
                            <a href="<?= $wa_url ?>" target="_blank" class="btn btn-sm btn-whatsapp-vip rounded-pill px-3 shadow-sm animate-pulse-subtle">
                                <i class="bi bi-whatsapp me-2"></i> AYUDA VIP SOBRE ESTE PEDIDO
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-history">
                <div class="mb-4">
                    <i class="bi bi-bag-x display-1 text-gold opacity-25"></i>
                </div>
                <h3 class="fw-bold text-cva-brown">Aún no tienes compras</h3>
                <p class="text-muted mb-4">Cuando realices tu primer pedido, aparecerá aquí para que puedas seguir su fabricación.</p>
                <a href="<?= base_url('productos') ?>" class="btn btn-brown rounded-pill px-5 py-3 fw-bold text-gold">
                    VER CATÁLOGO
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
