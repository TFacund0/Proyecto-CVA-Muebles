<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <style>
        .purchases-wrapper {
            background: linear-gradient(135deg, var(--cva-sand) 0%, #e8e2d8 100%);
            min-height: 85vh;
            padding: 4rem 0;
        }

        .purchase-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: block;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            position: relative;
            /* overflow: hidden; -- Eliminado para permitir que el preview sobresalga */
        }

        .purchase-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(62, 39, 35, 0.1);
            border-color: var(--cva-gold);
            background: white;
        }

        .purchase-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px dashed rgba(0,0,0,0.05);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .status-badge {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .status-solicitado { background: #e2e3e5; color: #383d41; border: 1px solid #d6d8db; }
        .status-pendiente { background: #fff3cd; color: #856404; }
        .status-aceptado { background: #d4edda; color: #155724; }
        .status-rechazado { background: #f8d7da; color: #721c24; }
        .status-entregado { background: #cce5ff; color: #004085; }
        .status-en_proceso { background: #d1ecf1; color: #0c5460; }
        .status-terminado { background: #d4edda; color: #155724; }

        .purchase-body {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .purchase-main-info h4 {
            font-weight: 900;
            color: var(--cva-brown);
            margin-bottom: 0.25rem;
        }

        .info-label {
            font-size: 0.65rem;
            font-weight: 800;
            color: #a08d7c;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
            display: block;
        }

        .purchase-footer {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-wa-support {
            background: rgba(37, 211, 102, 0.1);
            color: #128C7E;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-wa-support:hover {
            background: #25D366;
            color: white;
            transform: scale(1.05);
        }

        @media (max-width: 767.98px) {
            .purchase-card {
                padding: 1.5rem;
            }
            .purchase-header, .purchase-body, .purchase-footer {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }
            .purchase-footer .d-flex {
                flex-direction: column;
                width: 100%;
                gap: 0.75rem;
            }
            .purchase-footer .btn-artisan, .purchase-footer .btn-wa-support {
                width: 100%;
                justify-content: center;
                padding: 0.75rem !important;
            }
            .purchase-body .text-end {
                text-align: left !important;
                margin-top: 1rem;
            }
            .display-6 {
                font-size: 1.5rem !important;
            }
            .cart-title-main {
                font-size: 2.2rem;
            }
        }

        .empty-history {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: 3rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.05);
        }

        .cart-header-badge {
            background: var(--cva-brown);
            color: var(--cva-gold);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 2px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .cart-title-main {
            font-size: 3rem;
            font-weight: 900;
            color: var(--cva-brown);
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        .preview-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 1.25rem;
            border: 2px solid #f0e6d6;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .product-preview-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-top: 1rem;
            display: none;
            animation: fadeIn 0.3s ease;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
            text-align: center;
            z-index: 1000;
        }

        .product-preview-card.active {
            display: block;
        }

        .badge-preview-trigger {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .badge-preview-trigger:hover {
            background: var(--cva-gold) !important;
            color: white !important;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="purchases-wrapper">
    <div class="container">
        <!-- Header con Identidad -->
        <div class="mb-5 text-center text-lg-start">
            <span class="cart-header-badge">HISTORIAL ARTESANAL</span>
            <h1 class="cart-title-main">Mis Compras</h1>
            <p class="text-muted fs-5">Seguimiento de tus piezas y proyectos en curso.</p>
            <div style="width: 100px; height: 4px; background: var(--cva-gold); border-radius: 2px;"></div>
        </div>

        <!-- Alerta de Éxito Notable -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-artisan-success mb-5 p-4 border-0 shadow-lg animate__animated animate__backInDown" style="background: white; border-left: 10px solid #28a745 !important; border-radius: 1.5rem;">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle p-3 me-4 shadow">
                        <i class="bi bi-check-lg fs-3"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-success mb-1"><?= session()->getFlashdata('success') ?></h4>
                        <p class="text-muted mb-0 fw-semibold">Nuestro equipo revisará tu solicitud a la brevedad para confirmar los detalles.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($ventas)): ?>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php foreach ($ventas as $venta): ?>
                        <?php 
                            $status_class = 'status-' . strtolower($venta['estado'] ?? 'solicitado');
                            $status_label = $venta['estado'] ?? 'PENDIENTE';

                            // Si no ha sido aprobado por el admin, forzamos el label de solicitud
                            if (($venta['estado_aprobacion'] ?? '') == 'SOLICITUD') {
                                $status_class = 'status-solicitado';
                                $status_label = 'POR APROBAR';
                            } elseif (($venta['estado_aprobacion'] ?? '') == 'RECHAZADO') {
                                $status_class = 'status-rechazado';
                                $status_label = 'RECHAZADO';
                            }
                        ?>
                        <div class="purchase-card">
                            <div class="purchase-header">
                                <div>
                                    <span class="info-label">IDENTIFICADOR DE OBRA</span>
                                    <span class="fw-bold text-cva-brown">#PED-<?= str_pad($venta['id'], 5, '0', STR_PAD_LEFT) ?></span>
                                </div>
                                <span class="status-badge <?= $status_class ?>">
                                    <?= $status_label ?>
                                </span>
                            </div>

                            <div class="purchase-body">
                                <div class="purchase-main-info">
                                    <span class="info-label">FECHA DE SOLICITUD</span>
                                    <h4><?= date('d M, Y', strtotime($venta['fecha'])) ?></h4>
                                    <p class="text-muted mb-3 small">Registrado a las <?= date('H:i', strtotime($venta['fecha'])) ?>hs</p>

                                    <!-- Resumen de Productos -->
                                    <div class="mt-2">
                                        <span class="info-label">MUEBLES EN ESTE PEDIDO</span>
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            <?php if (!empty($venta['items'])): ?>
                                                <?php foreach($venta['items'] as $item): ?>
                                                    <span class="badge bg-white border text-dark px-3 py-2 rounded-pill x-small fw-bold shadow-sm">
                                                        <i class="bi bi-box me-1 text-gold"></i>
                                                        <?= $item['cantidad'] ?>x <?= esc($item['nombre_prod'] ?? 'Mueble a Medida') ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted x-small italic">Cargando detalles...</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-end">
                                    <span class="info-label">INVERSIÓN TOTAL</span>
                                    <span class="display-6 fw-bold text-cva-brown">$<?= number_format($venta['total_venta'], 0, ',', '.') ?></span>
                                </div>
                            </div>

                            <div class="purchase-footer">
                                <div class="d-flex gap-2">
                                    <a href="<?= base_url('factura/' . $venta['id']) ?>" class="btn-artisan btn-artisan-primary py-2 px-4" style="font-size: 0.7rem;">
                                        VER DETALLE Y PAGOS <i class="bi bi-chevron-right ms-1"></i>
                                    </a>
                                    
                                    <?php 
                                        $wa_num = "5493794098511";
                                        $msg = urlencode("Hola! Soy " . session()->get('nombre') . ", quería consultar sobre el estado de mi pedido #" . $venta['id']);
                                        $wa_url = "https://wa.me/{$wa_num}?text={$msg}";
                                    ?>
                                    <a href="<?= $wa_url ?>" target="_blank" class="btn-wa-support">
                                        <i class="bi bi-whatsapp"></i> CONSULTAR POR WHATSAPP
                                    </a>
                                </div>
                                
                                <div class="text-muted small">
                                    <i class="bi bi-shield-check me-1"></i> Compra Protegida
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-history">
                <div class="mb-4">
                    <i class="bi bi-bag-x display-1 text-gold opacity-25"></i>
                </div>
                <h3 class="fw-bold text-cva-brown">Aún no tienes registros</h3>
                <p class="text-muted mb-4 fs-5">Tu historial aparecerá aquí en cuanto realices tu primer encargo.</p>
                <a href="<?= base_url('productos') ?>" class="btn-artisan btn-artisan-primary px-5 py-3">
                    EXPLORAR CATÁLOGO
                </a>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function togglePreview(id, element) {
            // Cerrar otros abiertos
            document.querySelectorAll('.product-preview-card').forEach(card => {
                if(card.id !== id) card.classList.remove('active');
            });
            
            const card = document.getElementById(id);
            card.classList.toggle('active');
            
            // Cerrar al hacer clic fuera
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
