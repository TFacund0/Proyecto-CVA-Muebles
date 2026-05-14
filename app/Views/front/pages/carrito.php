<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/carrito.css?v=2.0') ?>">
    <style>
        .cart-item-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .cart-item-card:hover {
            box-shadow: 0 10px 30px rgba(62, 39, 35, 0.05);
            transform: translateY(-2px);
        }

        .cart-img-wrapper {
            width: 120px;
            height: 120px;
            background: #fdfaf7;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #f0e6d6;
        }

        .cart-img-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .cart-summary-card {
            background: white;
            border-radius: 2rem;
            border: 2px solid #eeebe6;
            padding: 2.5rem;
            position: sticky;
            top: 100px;
        }

        .cart-qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #eeebe6;
            background: white;
            color: var(--cva-brown);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 800;
            transition: all 0.2s ease;
        }

        .cart-qty-btn:hover {
            background: var(--cva-gold);
            border-color: var(--cva-gold);
            color: white;
        }

        .cart-section-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #a08d7c;
            margin-bottom: 1.5rem;
            display: block;
        }

        .cart-total-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #7d6b5d;
        }

        .cart-total-final {
            border-top: 2px dashed #eeebe6;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .cart-total-final .amount {
            font-size: 2rem;
            font-weight: 800;
            color: var(--cva-brown);
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="carrito-wrapper py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center text-lg-start">
            <h1 class="fw-bold text-cva-brown mb-2">Tu Carrito de Obras</h1>
            <p class="text-muted">Piezas artesanales seleccionadas para tu espacio personal.</p>
        </div>

        <!-- Mensajes de Estado Modularizados (Paso 3) -->
        <?= view('components/alert_message') ?>

        <?php if (empty($cart)): ?>
            <div class="empty-cart-state bg-white rounded-5 p-5 shadow-sm text-center border">
                <div class="mb-4">
                    <i class="bi bi-cart-x display-1 text-gold opacity-25"></i>
                </div>
                <h3 class="fw-bold text-cva-brown">Tu selección está vacía</h3>
                <p class="text-muted mb-4">Explora nuestro catálogo para encontrar la pieza perfecta para tu hogar.</p>
                <a href="<?= base_url('productos') ?>" class="btn btn-brown rounded-pill px-5 py-3 fw-bold text-gold">
                    EXPLORAR CATÁLOGO
                </a>
            </div>
        <?php else: ?>
            <div class="row g-5">
                <!-- Listado de Productos -->
                <div class="col-lg-8">
                    <span class="cart-section-label">Artículos Seleccionados</span>
                    
                    <?php $gran_total = 0; ?>
                    <?php foreach ($cart as $item): ?>
                        <?php $gran_total += $item['price'] * $item['qty']; ?>
                        <div class="cart-item-card">
                            <div class="cart-img-wrapper">
                                <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" alt="<?= esc($item['name']) ?>">
                            </div>
                            
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="fw-bold text-cva-brown mb-1"><?= esc($item['name']) ?></h5>
                                        <p class="small text-muted mb-0 text-uppercase letter-spacing-1">Mueble de Autor</p>
                                    </div>
                                    <a href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>" class="text-danger opacity-50 hover-opacity-100 fs-5">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="<?= base_url('carrito_resta/' . $item['rowid']) ?>" class="cart-qty-btn">-</a>
                                        <span class="fw-bold text-cva-brown"><?= esc($item['qty']) ?></span>
                                        <a href="<?= base_url('carrito_suma/' . $item['rowid']) ?>" class="cart-qty-btn">+</a>
                                    </div>
                                    
                                    <div class="text-end">
                                        <p class="small text-muted mb-0">Precio Unitario: $<?= number_format($item['price'], 0, ',', '.') ?></p>
                                        <p class="fw-bold text-cva-brown fs-5 mb-0">$<?= number_format($item['subtotal'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mt-4">
                        <a href="<?= base_url('productos') ?>" class="text-decoration-none text-brown fw-bold">
                            <i class="bi bi-arrow-left me-2"></i> SEGUIR VIENDO PRODUCTOS
                        </a>
                    </div>
                </div>

                <!-- Resumen de Compra -->
                <div class="col-lg-4">
                    <div class="cart-summary-card">
                        <span class="cart-section-label">Resumen de Orden</span>
                        
                        <div class="cart-total-line">
                            <span>Subtotal</span>
                            <span>$<?= number_format($gran_total, 0, ',', '.') ?></span>
                        </div>
                        <div class="cart-total-line">
                            <span>Envío</span>
                            <span class="text-gold fw-bold">A coordinar</span>
                        </div>
                        <div class="cart-total-line">
                            <span>Impuestos</span>
                            <span>Incluidos</span>
                        </div>

                        <div class="cart-total-final">
                            <span class="fw-bold text-cva-brown">TOTAL</span>
                            <div class="amount">$<?= number_format($gran_total, 0, ',', '.') ?></div>
                        </div>

                        <div class="mt-5">
                            <a href="<?= base_url('carrito_comprar') ?>" class="btn btn-brown w-100 py-3 rounded-pill fw-bold text-gold fs-5 shadow-sm mb-3">
                                FINALIZAR COMPRA
                            </a>
                            <a href="<?= base_url('borrar') ?>" class="btn btn-outline-danger w-100 py-2 rounded-pill fw-bold x-small opacity-75">
                                VACIAR CARRITO
                            </a>
                        </div>

                        <div class="mt-4 p-3 bg-light rounded-4 text-center">
                            <p class="x-small text-muted mb-0">
                                <i class="bi bi-shield-lock-fill me-1 text-gold"></i> Pago seguro y garantizado
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
