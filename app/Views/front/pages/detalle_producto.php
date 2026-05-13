<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/detalle_producto.css?v=2.0') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="product-detail-wrapper">
    <!-- Breadcrumb Nav (Sutil) -->
    <div class="container mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('productos') ?>" class="text-decoration-none text-gold fw-bold small">CATÁLOGO</a></li>
                <li class="breadcrumb-item active small" aria-current="page"><?= strtoupper(esc($producto['nombre_prod'])) ?></li>
            </ol>
        </nav>
    </div>

    <div class="container main-artisan-card rounded-4 overflow-hidden animate-fade-in-up">
        <div class="row g-0">
            <!-- Columna de Imagen -->
            <div class="col-lg-6 image-column">
                <div class="image-container">
                    <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                         class="img-fluid main-img" 
                         alt="<?= esc($producto['nombre_prod']) ?>">
                </div>
            </div>

            <!-- Columna de Información -->
            <div class="col-lg-6 info-column d-flex flex-column">
                <div class="header-info">
                    <span class="category-tag"><?= esc($producto['categoria']) ?></span>
                    <h1 class="product-title"><?= esc($producto['nombre_prod']) ?></h1>
                    <div class="title-divider"></div>
                </div>

                <div class="price-box">
                    <div class="price-label">Inversión artesanal</div>
                    <div class="price-value">
                        <span class="price-symbol">$</span>
                        <span><?= number_format($producto['precio_vta'], 0, ',', '.') ?></span>
                    </div>
                    <div class="stock-info">
                        <?php if ($producto['stock'] > 0): ?>
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span>Disponible para entrega inmediata</span>
                        <?php else: ?>
                            <i class="bi bi-clock-history text-warning"></i>
                            <span>Sin stock por el momento - ¡Consultanos!</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-hammer"></i></div>
                        <div class="feature-text">
                            <h6>Mano de obra local</h6>
                            <p>Fabricado artesanalmente en Mantilla, Corrientes.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-tree"></i></div>
                        <div class="feature-text">
                            <h6>Maderas seleccionadas</h6>
                            <p>Piezas de alta calidad y origen responsable.</p>
                        </div>
                    </div>
                </div>

                <div class="actions-area mt-auto">
                    <?php if (env('SHOPPING_CART_ENABLED')): ?>
                        <?php if (session()->get('logged_in')): ?>
                            <?php if ($producto['stock'] > 0): ?>
                                <form action="<?= base_url('carrito/add') ?>" method="post" class="mb-3">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_producto" value="<?= esc($producto['id_producto']) ?>">
                                    <input type="hidden" name="precio_vta" value="<?= esc($producto['precio_vta']) ?>">
                                    <input type="hidden" name="nombre_prod" value="<?= esc($producto['nombre_prod']) ?>">
                                    <input type="hidden" name="imagen" value="<?= esc($producto['imagen']) ?>">
                                    <button type="submit" class="btn btn-artisan-primary w-100 py-3 rounded-3 fs-5">
                                        <i class="bi bi-cart-plus me-2"></i> AGREGAR AL CARRITO
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="https://wa.me/5493794098511?text=Hola!%20Me%20interesa%20el%20mueble%20<?= urlencode($producto['nombre_prod']) ?>%20pero%20no%20hay%20stock.%20¿Me%20avisarías%20cuando%20vuelvan%20a%20fabricar?" 
                                   target="_blank" class="btn btn-outline-brown w-100 py-3 mb-3 rounded-3 fs-5">
                                    <i class="bi bi-whatsapp me-2"></i> CONSULTAR DISPONIBILIDAD
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary w-100 py-3 mb-3 rounded-3">
                                <i class="bi bi-person-lock me-2"></i> INICIÁ SESIÓN PARA COMPRAR
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php 
                            $whatsapp_num = "5493794098511";
                            $mensaje = urlencode("Hola! Me interesa este mueble artesanal: " . $producto['nombre_prod'] . ". ¿Podrías darme más detalles?");
                            $url_whatsapp = "https://wa.me/{$whatsapp_num}?text={$mensaje}";
                        ?>
                        <a href="<?= $url_whatsapp ?>" target="_blank" class="btn btn-whatsapp-premium mb-3">
                            <i class="bi bi-whatsapp"></i> CONSULTAR POR WHATSAPP
                        </a>
                    <?php endif; ?>

                    <a href="https://wa.me/5493794098511?text=Hola!%20Me%20gustaría%20personalizar%20el%20mueble%20<?= urlencode($producto['nombre_prod']) ?>" 
                       class="btn btn-personalizar">
                        <i class="bi bi-pencil-square"></i> SOLICITAR MEDIDAS ESPECIALES
                    </a>
                </div>
            </div>
        </div>

        <!-- Ficha Técnica -->
        <div class="technical-section">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h2 class="technical-title">Detalles <br><span>Constructivos</span></h2>
                    <p class="text-muted">Cada veta y nudo de la madera es único, lo que garantiza que tu mueble sea una pieza irrepetible.</p>
                </div>
                <div class="col-lg-8">
                    <div class="description-box">
                        <?php if (!empty($producto['descripcion'])): ?>
                            <?= nl2br(esc($producto['descripcion'])) ?>
                        <?php else: ?>
                            <p class="mb-0"><i class="bi bi-info-circle me-2"></i> Esta pieza se fabrica siguiendo técnicas de carpintería tradicional. Se entrega terminada con productos protectores que resaltan la belleza natural de la madera. Consultanos por diferentes acabados (brillante, mate o satinado).</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="row trust-badges g-4">
                <div class="col-md-4">
                    <div class="badge-card">
                        <div class="badge-icon-wrap">🚚</div>
                        <h5>Envío Seguro</h5>
                        <p class="small text-muted">Coordinamos la logística para que tu mueble llegue impecable.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="badge-card">
                        <div class="badge-icon-wrap">🛡️</div>
                        <h5>Garantía de Obra</h5>
                        <p class="small text-muted">Aseguramos la integridad estructural de cada pieza.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="badge-card">
                        <div class="badge-icon-wrap">🌿</div>
                        <h5>Madera Sustentable</h5>
                        <p class="small text-muted">Utilizamos recursos de bosques gestionados responsablemente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

