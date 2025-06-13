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
<<<<<<< HEAD
            <?php } ?>
=======
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 34.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Juego de Mesa y Sillas de Pino Tratado</h5>
                        <p class="card-text">Conjunto de comedor compuesto por mesa robusta, realizados en madera de pino tratada. Perfecto para interiores cálidos o quinchos.</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$850.000 (con 4 sillas)</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 7.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Cama Matrimonial de Madera de Pino</h5>
                        <p class="card-text">Cama matrimonial de estructura reforzada en madera maciza de pino tratada. Ideal para darle calidez y durabilidad a tu dormitorio.</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$950.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 46.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Set de 4 Sillas de Madera Maciza y Tapizado</h5>
                        <p class="card-text">Madera maciza de alta calidad con tratamiento protector. Tapizado en asiento para mayor confort y resistencia. Diseño moderno y robusto.</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$600.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 11.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Mueble Esquinero de Pino Macizo</h5>
                        <p class="card-text">Mueble esquinero ideal para cocinas o comedores, realizado en madera de pino macizo. Puertas batientes con detalles rústicos y amplia capacidad de guardado. Tratamiento para mayor durabilidad.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$750.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 10.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Aparador de Pino con Estantería Abierta</h5>
                        <p class="card-text">Con estantes abiertos y puerta lateral para almacenamiento. Ideal para vajilla, libros o decoración. Terminación natural para ambientes cálidos.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$700.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 9.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Silla Alta de Madera Maciza</h5>
                        <p class="card-text">Silla alta construida en madera maciza tratada. Ideal para barras de cocina, desayunadores o comedores modernos. Diseño robusto, cómodo y duradero.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$350.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 12.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Mesa Auxiliar de Pino con Cajón</h5>
                        <p class="card-text">Mesa auxiliar de madera maciza de pino tratada. Incluye cajón con cerradura para almacenamiento seguro. Perfecta para cocinas, escritorios o rincones especiales.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$350.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4" data-categoria="mesas">
                <div class="card h-100 product-card">
                    <img src="assets/img/muebles/Muebles 16.jpeg" class="card-img-top h-100" alt="Mesa de Madera">
                    
                    <div class="card-body">
                        <h5 class="card-title">Pizarrón Caballete de Madera</h5>
                        <p class="card-text">Pizarrón caballete de doble cara fabricado en madera maciza. Ideal para restaurantes, cafeterías o ferias. Resistente, fácil de mover y excelente presentación.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">$100.000</span>
                        </div>
                    </div>
                </div>
            </div>
>>>>>>> 77926457638f411aee066cd071a2ca89f19663f5
        </div>
</section>
