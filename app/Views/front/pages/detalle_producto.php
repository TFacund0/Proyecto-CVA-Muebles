<!-- 
  =============================================
  FICHA TÉCNICA DE PRODUCTO - WARM ARTISAN
  Estética cálida basada en texturas de madera y tonos tierra.
  =============================================
-->

<div class="product-detail-wrapper py-5">
    <!-- Contenedor Principal con fondo cálido -->
    <div class="container main-artisan-card shadow-lg p-0 overflow-hidden rounded-5">
        
        <div class="row g-0">
            <!-- Columna de Imagen (Fondo Madera Clara) -->
            <div class="col-lg-7 bg-wood-light d-flex align-items-center justify-content-center p-4 p-md-5">
                <div class="image-wrapper shadow-lg rounded-4 overflow-hidden border-artisan">
                    <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                         class="img-fluid main-img" 
                         alt="<?= esc($producto['nombre_prod']) ?>">
                </div>
            </div>

            <!-- Columna de Información (Fondo Crema) -->
            <div class="col-lg-5 bg-artisan-cream p-4 p-md-5 d-flex flex-column">
                
                <!-- Navegación Sutil -->
                <div class="mb-4 d-flex align-items-center gap-2 back-nav-warm animate__animated animate__fadeIn">
                    <a href="<?= base_url('productos') ?>" class="text-decoration-none">
                        <i class="bi bi-chevron-left me-1"></i> VOLVER AL CATÁLOGO
                    </a>
                </div>

                <div class="header-section mb-4">
                    <span class="category-tag mb-2"><?= esc($producto['categoria']) ?></span>
                    <h1 class="artisan-title mb-0"><?= esc($producto['nombre_prod']) ?></h1>
                    <div class="title-underline"></div>
                </div>

                <div class="price-container-warm mb-5 p-4 rounded-4 shadow-sm">
                    <div class="label text-uppercase small fw-bold opacity-75">Inversión en tu hogar</div>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="currency">$</span>
                        <span class="price-val"><?= number_format($producto['precio_vta'], 2, ',', '.') ?></span>
                    </div>
                    <div class="stock-status mt-2">
                        <i class="bi bi-check-circle-fill me-1"></i> <?= $producto['stock'] ?> disponibles en taller
                    </div>
                </div>

                <!-- Lista de Atributos con Iconos Madera -->
                <div class="attributes-list mb-5">
                    <div class="attr-item">
                        <div class="icon-circle"><i class="bi bi-hammer"></i></div>
                        <div>
                            <strong>Fabricación propia</strong>
                            <p class="mb-0 small">Hecho a mano en Mantilla, Corrientes</p>
                        </div>
                    </div>
                    <div class="attr-item">
                        <div class="icon-circle"><i class="bi bi-tree"></i></div>
                        <div>
                            <strong>Materiales Nobles</strong>
                            <p class="mb-0 small">Madera seleccionada de origen responsable</p>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción Estilo Madera -->
                <div class="actions-warm mt-auto">
                    <?php if (env('SHOPPING_CART_ENABLED')): ?>
                        <form action="<?= base_url('carrito/add') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_producto" value="<?= esc($producto['id_producto']) ?>">
                            <input type="hidden" name="precio_vta" value="<?= esc($producto['precio_vta']) ?>">
                            <input type="hidden" name="nombre_prod" value="<?= esc($producto['nombre_prod']) ?>">
                            <input type="hidden" name="imagen" value="<?= esc($producto['imagen']) ?>">
                            <button type="submit" class="btn btn-artisan-primary w-100 py-3 mb-3">
                                <i class="bi bi-cart-plus me-2"></i> AGREGAR AL CARRITO
                            </button>
                        </form>
                    <?php else: ?>
                        <?php 
                            $whatsapp_num = "5493794098511";
                            $mensaje = urlencode("Hola! Vi tu trabajo en la web y me interesa el modelo: " . $producto['nombre_prod'] . ".");
                            $url_whatsapp = "https://wa.me/{$whatsapp_num}?text={$mensaje}";
                        ?>
                        <a href="<?= $url_whatsapp ?>" target="_blank" class="btn btn-whatsapp-warm w-100 py-3 mb-3">
                            <i class="bi bi-whatsapp me-2"></i> CONSULTAR POR WHATSAPP
                        </a>
                    <?php endif; ?>
                    
                    <a href="https://wa.me/5493794098511?text=Hola!%20Me%20gustaría%20personalizar%20el%20mueble%20<?= urlencode($producto['nombre_prod']) ?>" 
                       class="btn btn-artisan-outline w-100 py-3">
                        <i class="bi bi-pencil-square me-2"></i> PERSONALIZAR MEDIDAS
                    </a>
                </div>
            </div>
        </div>

        <!-- Ficha Técnica (Box con Textura) -->
        <div class="technical-drawer bg-white p-4 p-md-5 border-top-artisan">
            <div class="row align-items-center mb-5">
                <div class="col-lg-4 text-center text-lg-start mb-3 mb-lg-0">
                    <h2 class="drawer-title">Ficha <br><span>Técnica</span></h2>
                </div>
                <div class="col-lg-8">
                    <div class="description-warm p-4 rounded-4">
                        <?php if (!empty($producto['descripcion'])): ?>
                            <?= nl2br(esc($producto['descripcion'])) ?>
                        <?php else: ?>
                            <p class="text-muted mb-0"><i class="bi bi-info-circle me-2"></i> Esta pieza se fabrica bajo pedido. Las dimensiones y tipo de madera se ajustan a la necesidad del cliente. Consúltanos para una propuesta personalizada.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="row g-4 text-center border-top pt-5">
                <div class="col-md-4">
                    <div class="trust-badge">
                        <div class="badge-icon">🚛</div>
                        <h5>Logística Artesanal</h5>
                        <p class="small text-muted">Envíos coordinados para cuidar cada pieza.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="trust-badge">
                        <div class="badge-icon">🛡️</div>
                        <h5>Calidad Garantizada</h5>
                        <p class="small text-muted">Construcción robusta para toda la vida.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="trust-badge">
                        <div class="badge-icon">🇦🇷</div>
                        <h5>Orgullo Local</h5>
                        <p class="small text-muted">Hecho íntegramente en Corrientes, Argentina.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos Warm Artisan -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Lora:ital,wght@0,700;1,700&display=swap');
    @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css');

    :root {
        --artisan-dark: #3e2723; /* Marrón Madera Oscura */
        --artisan-warm: #5d4037; /* Marrón Cálido */
        --artisan-tan: #8d6e63;  /* Tono Roble */
        --artisan-cream: #fdfaf5; /* Fondo Crema Suave */
        --artisan-gold: #b8860b;  /* Detalle Oro/Miel */
        --artisan-light-wood: #f4ece2; /* Fondo Madera Clara */
    }

    .product-detail-wrapper {
        background-color: #f5f0e8; /* Fondo general aún más cálido */
        font-family: 'Outfit', sans-serif;
    }

    .main-artisan-card {
        background-color: white;
        border: 1px solid #e0d5c5;
    }

    /* Columna Imagen */
    .bg-wood-light {
        background-color: var(--artisan-light-wood);
        background-image: radial-gradient(circle, rgba(255,255,255,0.4) 0%, rgba(210,180,140,0.1) 100%);
    }
    .image-wrapper {
        background: white;
        padding: 15px;
    }
    .main-img {
        width: 100%;
        height: 550px;
        object-fit: cover;
        border-radius: 10px;
    }
    .border-artisan {
        border: 4px solid white;
    }

    /* Columna Info */
    .bg-artisan-cream {
        background-color: var(--artisan-cream);
        border-left: 1px solid #eee;
    }

    .back-nav-warm a {
        color: var(--artisan-tan);
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        transition: color 0.3s;
    }
    .back-nav-warm a:hover {
        color: var(--artisan-dark);
    }

    .category-tag {
        color: var(--artisan-gold);
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    .artisan-title {
        font-family: 'Lora', serif;
        color: var(--artisan-dark);
        font-size: 2.5rem;
        line-height: 1.1;
    }
    .title-underline {
        width: 60px;
        height: 5px;
        background-color: var(--artisan-gold);
        margin-top: 10px;
        border-radius: 2px;
    }

    /* Caja de Precio */
    .price-container-warm {
        background: white;
        border-left: 5px solid var(--artisan-gold);
        border-top: 1px solid #f0e6d6;
        border-right: 1px solid #f0e6d6;
        border-bottom: 1px solid #f0e6d6;
    }
    .price-val {
        font-size: 3.2rem;
        font-weight: 700;
        color: var(--artisan-dark);
        letter-spacing: -2px;
    }
    .currency {
        font-size: 1.5rem;
        color: var(--artisan-gold);
        font-weight: 700;
    }
    .stock-status {
        color: #2e7d32;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Atributos */
    .attr-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    .icon-circle {
        width: 45px;
        height: 45px;
        background: var(--artisan-light-wood);
        color: var(--artisan-warm);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        border: 1px solid #d7ccc8;
    }

    /* Botones */
    .btn-artisan-primary {
        background-color: var(--artisan-dark);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .btn-artisan-primary:hover {
        background-color: var(--artisan-warm);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(62, 39, 35, 0.3);
    }

    .btn-whatsapp-warm {
        background-color: #2e7d32;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s;
    }
    .btn-whatsapp-warm:hover {
        background-color: #1b5e20;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
    }

    .btn-artisan-outline {
        border: 2px solid var(--artisan-tan);
        color: var(--artisan-tan);
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s;
    }
    .btn-artisan-outline:hover {
        background-color: var(--artisan-tan);
        color: white;
    }

    /* Cajón Técnico */
    .border-top-artisan {
        border-top: 2px solid #e0d5c5;
    }
    .drawer-title {
        font-family: 'Lora', serif;
        font-size: 2.2rem;
        color: var(--artisan-dark);
        line-height: 1;
    }
    .drawer-title span {
        color: var(--artisan-gold);
    }
    .description-warm {
        background-color: #fcfaf7;
        border: 1px dashed #d7ccc8;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4e342e;
    }

    .trust-badge .badge-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .trust-badge h5 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--artisan-dark);
        margin-bottom: 5px;
    }

    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate__fadeIn { animation: fadeIn 0.8s ease-out; }
</style>
