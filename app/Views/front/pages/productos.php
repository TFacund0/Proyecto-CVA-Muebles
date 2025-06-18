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
                            <?php 
                                echo form_open('carrito/add'); 
                                echo form_hidden('id_producto', $row['id_producto']);
                                echo form_hidden('precio_vta', $row['precio_vta']);
                                echo form_hidden('nombre_prod', $row['nombre_prod']);

                                $btn = array(
                                    'class' => 'btn btn-secondary fuenteBotones',
                                    'value' => 'Agregar al Carrito',
                                    'name'  => 'action'
                                );  
                                echo form_submit($btn);
                                echo form_close();
                            ?>
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
