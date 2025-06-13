<section id="productos" class="contenedor-productos text-center">
    <div class="titulo-productos text-center">
        <h2>Productos</h2>
        <p>Elegí una categoría o mirá todo</p>
    </div>

    <!-- Grid de productos -->
    <div class="container-lg container-fluid-md p-4 my-4" id="catalogo-productos">

        <!-- Filtro de categorías -->
        <div class="d-inline-block px-5 py-2 mb-4 filtro-categorias" role="group" aria-label="Basic outlined example">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button type="button" class="btn btn-outline-warning">Todos</button>    
                <button type="button" class="btn btn-outline-warning">Mesas</button>
                <button type="button" class="btn btn-outline-warning">Sillas</button>
                <button type="button" class="btn btn-outline-warning">Escritorios</button>
                <button type="button" class="btn btn-outline-warning">Camas</button>
                <button type="button" class="btn btn-outline-warning">Roperos</button>
            </div>
        </div>

        <div class="row" id="lista-productos">
            <?php foreach ($producto as $row) { ?>
                <div class="col-md-4 col-sm-6 mb-4" data-categorias="mesas">
                    <div class="card h-100 product-card">

                        <img src="<?= base_url('assets/uploads/' . $row['imagen']) ?>" class="card-img-top h-100" alt="<?= esc($row['nombre_prod']) ?>">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($row['nombre_prod']) ?></h5>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold">Precio: $<?= esc($row['precio_vta']) ?></p>
                            </div>
                        </div>

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
                    </div>
                </div>
            <?php } ?>
        </div>
</section>
