<section id="productos" class="contenedor-productos">
    <div class="titulo-productos text-center">
        <h2>Productos</h2>
        <p>Elegí una categoría o mirá todo</p>
    </div>

    <!-- Filtro de categorías -->
    <div class="dropdown text-center mb-4">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filtrar por categoría
        </button>
        
        <ul class="dropdown-menu">
            <li><a class="dropdown-item filtro-categoria" href="#" data-categoria="todos">Todos</a></li>
            <li><a class="dropdown-item filtro-categoria" href="#" data-categoria="mesas">Mesas</a></li>
            <li><a class="dropdown-item filtro-categoria" href="#" data-categoria="sillas">Sillas</a></li>
            <li><a class="dropdown-item filtro-categoria" href="#" data-categoria="escritorios">Escritorios</a></li>
        </ul>
    </div>

    <!-- Grid de productos -->
    <div class="container">
        <div class="row" id="lista-productos">
            <!-- Ejemplo de producto -->
            <div class="col-md-4 mb-4 producto-card" data-categoria="mesas">
                <div class="card h-100 shadow-sm">
                    <img src="img/productos/mesa1.jpg" class="card-img-top" alt="Mesa de Madera">
                    <div class="card-body">
                        <h5 class="card-title">Mesa de Comedor</h5>
                        <p class="card-text">Mesa robusta de madera de pino tratada.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 producto-card" data-categoria="mesas">
                <div class="card h-100 shadow-sm">
                    <img src="img/productos/mesa1.jpg" class="card-img-top" alt="Mesa de Madera">
                    <div class="card-body">
                        <h5 class="card-title">Mesa de Comedor</h5>
                        <p class="card-text">Mesa robusta de madera de pino tratada.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 producto-card" data-categoria="mesas">
                <div class="card h-100 shadow-sm">
                    <img src="img/productos/mesa1.jpg" class="card-img-top" alt="Mesa de Madera">
                    <div class="card-body">
                        <h5 class="card-title">Mesa de Comedor</h5>
                        <p class="card-text">Mesa robusta de madera de pino tratada.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    