<section id="productos" class="contenedor-productos text-center">
    <div class="titulo-productos text-center">
        <h2>Productos</h2>
        <p>Elegí una categoría o mirá todo</p>
    </div>

    <!-- Grid de productos -->
    <div class="container-lg container-fluid-md p-4 my-4" id="catalogo-productos">

        <!-- Filtro de categorías dinámico -->
        <div class="categorias-scroll py-3 mb-4 filtro-categorias">
            <div class="d-flex flex-nowrap overflow-auto gap-3 px-3">
                <button type="button" class="btn btn-outline-warning filtro-categoria" data-categoria="todos">Todos</button>
                <?php foreach ($categorias as $cat) { ?>
                    <button type="button" class="btn btn-outline-warning filtro-categoria" data-categoria="<?= esc($cat['descripcion']) ?>">
                        <?= esc($cat['descripcion']) ?>
                    </button>
                <?php } ?>
            </div>
        </div>

        <div class="row" id="lista-productos">
            <?php foreach ($producto as $row) { ?>
                <div class="col-md-4 col-sm-6 mb-4" data-categorias="<?= esc($row['categoria']) ?>">
                    <div class="card h-100 product-card">

                        <img src="<?= base_url('assets/uploads/' . $row['imagen']) ?>" class="card-img-top h-100" alt="<?= esc($row['nombre_prod']) ?>">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($row['nombre_prod']) ?></h5>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold">Precio: $<?= esc($row['precio_vta']) ?></p>
                                <p class="fw-bold">Stock: <?= esc($row['stock']) ?></p>
                            </div>
                        </div>

                        <?php if (session()->get('logged_in')) { ?>

                        <div class="card-footer">
                            <form action="<?= base_url('carrito/add') ?>" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                <input type="hidden" name="id_producto" value="<?= esc($row['id_producto']) ?>">
                                <input type="hidden" name="precio_vta" value="<?= esc($row['precio_vta']) ?>">
                                <input type="hidden" name="nombre_prod" value="<?= esc($row['nombre_prod']) ?>">
                                <input type="submit" class="btn btn-secondary fuenteBotones" value="Agregar al Carrito" name="action">
                            </form>
                        </div>
                        
                        <?php }?>

                    </div>
                </div>
            <?php } ?>
        </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.filtro-categoria');
        const productos = document.querySelectorAll('#lista-productos .col-md-4');

        botones.forEach(btn => {
            btn.addEventListener('click', () => {
                const categoria = btn.dataset.categoria.toLowerCase();

                productos.forEach(prod => {
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
