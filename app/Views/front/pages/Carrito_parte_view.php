<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/carrito.css?v=1.0') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="carrito-wrapper">
    <div class="container">
        <!-- Breadcrumb sutil -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('productos') ?>" class="text-decoration-none text-gold fw-bold small">CATÁLOGO</a></li>
                <li class="breadcrumb-item active small" aria-current="page">MI CARRITO</li>
            </ol>
        </nav>

        <div class="carrito-card shadow-lg animate-fade-in-up">
            <!-- Cabecera del Carrito -->
            <div class="carrito-header">
                <h2>Tu Selección Artesanal</h2>
                <p class="mb-0 opacity-75">Piezas únicas listas para formar parte de tu hogar</p>
            </div>

            <div class="card-body p-0">
                <!-- Mensajes Flash -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success m-4 rounded-3 border-0 shadow-sm">
                        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger m-4 rounded-3 border-0 shadow-sm">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($cart)): ?>
                    <!-- Estado Vacío -->
                    <div class="empty-cart-state">
                        <div class="empty-cart-icon">
                            <i class="bi bi-cart-x"></i>
                        </div>
                        <h3 class="fw-bold text-cva-brown">Tu carrito está esperando ser llenado</h3>
                        <p class="text-muted mb-4">Parece que aún no has seleccionado ninguna de nuestras piezas artesanales.</p>
                        <a href="<?= base_url('productos') ?>" class="btn btn-artisan-primary">
                            <i class="bi bi-arrow-left me-2"></i> EXPLORAR CATÁLOGO
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Listado de Productos -->
                    <div class="carrito-table-container">
                        <div class="table-responsive">
                            <table class="table align-middle table-carrito">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pieza</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Subtotal</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $gran_total = 0; ?>
                                    <?php foreach ($cart as $item): ?>
                                        <?php $gran_total += $item['price'] * $item['qty']; ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" 
                                                     class="carrito-img" alt="<?= esc($item['name']) ?>">
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0 text-cva-brown"><?= esc($item['name']) ?></h6>
                                                <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Mueble de Autor</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="price-text">$<?= number_format($item['price'], 0, ',', '.') ?></span>
                                            </td>
                                            <td class="text-center">
                                                <div class="qty-control">
                                                    <a href="<?= base_url('carrito_resta/' . $item['rowid']) ?>" class="btn-qty">-</a>
                                                    <span class="fw-bold px-1"><?= esc($item['qty']) ?></span>
                                                    <a href="<?= base_url('carrito_suma/' . $item['rowid']) ?>" class="btn-qty">+</a>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <span class="subtotal-text">$<?= number_format($item['subtotal'], 0, ',', '.') ?></span>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>" 
                                                   class="text-danger fs-5" title="Quitar del carrito">
                                                    <i class="bi bi-trash3"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Footer del Carrito con Totales -->
                    <div class="carrito-footer">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="total-display">
                                    Total: <span>$<?= number_format($gran_total, 0, ',', '.') ?></span>
                                </div>
                                <p class="small text-muted mb-0">Incluye impuestos. Gastos de envío se coordinan luego de la compra.</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-md-end">
                                    <a href="<?= base_url('borrar') ?>" class="btn btn-outline-danger px-4 py-3 rounded-3 fw-bold">
                                        VACIAR CARRITO
                                    </a>
                                    <a href="<?= base_url('productos') ?>" class="btn btn-outline-secondary px-4 py-3 rounded-3 fw-bold">
                                        SEGUIR VIENDO
                                    </a>
                                    <a href="<?= base_url('carrito_comprar') ?>" class="btn btn-artisan-primary px-5 py-3 rounded-3 fs-5">
                                        FINALIZAR COMPRA
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

