<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/productos.css?v=6.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section id="productos" class="contenedor-productos">
    <!-- Cabecera Premium -->
    <div class="header-productos text-center shadow-sm">
        <div class="container">
            <h2 class="text-uppercase display-4">Catálogo de Productos</h2>
            <p>Descubrí piezas únicas diseñadas para durar toda la vida. Cada mueble cuenta una historia de tradición y madera seleccionada.</p>
            <div class="divider-artisan"></div>
        </div>
    </div>

    <!-- Contenedor de muebles (Mi diseño artisan) -->
    <div class="contenedor-muebles-artisan container-lg" id="catalogo-productos">

        <!-- Pestañas de Filtro -->
        <div class="filter-container mb-5 animate-fade-in">
            <div class="filter-group d-flex flex-wrap justify-content-center">
                <button type="button" class="btn filtro-categoria active" data-categoria="todos">Todos</button>
                <?php foreach ($categorias as $cat) { ?>
                    <button type="button" class="btn filtro-categoria" data-categoria="<?= esc($cat['descripcion']) ?>">
                        <?= esc($cat['descripcion']) ?>
                    </button>
                <?php } ?>
            </div>
        </div>

        <div class="row" id="lista-productos">
            <?php foreach ($producto as $row) { ?>
                <div class="col-md-4 col-sm-6 mb-5" data-categorias="<?= esc($row['categoria']) ?>">
                    <div class="card h-100 product-card">
                        <div class="img-wrapper">
                            <img src="<?= base_url('assets/uploads/' . $row['imagen']) ?>" alt="<?= esc($row['nombre_prod']) ?>">
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= esc($row['nombre_prod']) ?></h5>
                            <p class="small text-muted mb-4">Pieza única de fabricación artesanal en madera seleccionada.</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4 mt-auto">
                                <span class="precio-tag">$<?= number_format($row['precio_vta'], 0, ',', '.') ?></span>
                                <span class="badge-stock">Stock: <?= esc($row['stock']) ?></span>
                            </div>
                            
                            <div class="action-buttons">
                                <a href="<?= base_url('producto/detalle/' . $row['id_producto']) ?>" class="btn btn-artisan-gold w-100 py-3 fw-bold">
                                    VER DETALLES
                                </a>
                            </div>
                        </div>

                        <div class="card-footer border-0 bg-transparent pb-4 px-4">
                            <?php if (env('SHOPPING_CART_ENABLED')): ?>
                                <?php if (session()->get('logged_in')): ?>
                                    <form action="<?= base_url('carrito/add') ?>" method="post">
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                        <input type="hidden" name="id_producto" value="<?= esc($row['id_producto']) ?>">
                                        <input type="hidden" name="precio_vta" value="<?= esc($row['precio_vta']) ?>">
                                        <input type="hidden" name="nombre_prod" value="<?= esc($row['nombre_prod']) ?>">
                                        <input type="hidden" name="imagen" value="<?= esc($row['imagen']) ?>">
                                        <input type="submit" class="btn btn-brown-solid w-100" value="Agregar al Carrito" name="action">
                                    </form>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary w-100">Iniciá sesión para comprar</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php 
                                    $whatsapp_num = "5493794098511";
                                    $mensaje = urlencode("Hola! Estoy interesado en el producto: " . $row['nombre_prod'] . " (ID: " . $row['id_producto'] . "). Me podrías dar más información?");
                                    $url_whatsapp = "https://wa.me/{$whatsapp_num}?text={$mensaje}";
                                ?>
                                <a href="<?= $url_whatsapp ?>" target="_blank" class="btn btn-whatsapp-artisan w-100">
                                    <i class="bi bi-whatsapp me-2"></i> Consultar
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.filtro-categoria');
        const productos = document.querySelectorAll('#lista-productos .col-md-4 col-sm-6'); // Selector corregido

        botones.forEach(btn => {
            btn.addEventListener('click', () => {
                // Manejo de clase activa
                botones.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const categoria = btn.dataset.categoria.toLowerCase();
                const items = document.querySelectorAll('#lista-productos > div');

                items.forEach(prod => {
                    const catProd = prod.dataset.categorias.toLowerCase();
                    if (categoria === 'todos' || catProd === categoria) {
                        prod.style.display = 'block';
                    } else {
                        prod.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>
