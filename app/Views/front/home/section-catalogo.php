<?php
    $session = session();
    $isLogged = $session->get('logged_in');
?>

<!-- Sección de Categorias/Catalogo -->
<section class="section-categorias">
    <div class="container text-center">
        <h2 class="titulo mb-5">Nuestras Especialidades</h2>
        
        <div class="row g-4 justify-content-center">
            <!-- Especialidad: Muebles de Sala -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="catalogo-card muebles-card">
                    <div class="text-card">
                        <h3>Muebles de Sala</h3>
                        <p>Diseño artesanal para tu comodidad diaria</p>
                        <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-light rounded-pill">Explorar</a>
                    </div>
                </div>
            </div>

            <!-- Especialidad: Dormitorios -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="catalogo-card dormitorios-card">
                    <div class="text-card">
                        <h3>Dormitorios</h3>
                        <p>Espacios que transformarán tu descanso</p>
                        <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-light rounded-pill">Explorar</a>
                    </div>
                </div>
            </div>                
            
            <!-- Especialidad: Cocina -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="catalogo-card cocina-card">
                    <div class="text-card">
                        <h3>Cocina</h3>
                        <p>Islas y mesas rústicas para tu hogar</p>
                        <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-light rounded-pill">Explorar</a>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>

<!-- Texto a modo de promoción -->
<section class="section-texto">
    <div class="container text-center bloque-texto">
        <h2 class="font-lora mb-4">¡Diseños Únicos!</h2>
        <p class="lead">
            En CVA Muebles nos destacamos por la creatividad al diseñar. Inspirados en la simpleza morfológica encontramos la sutileza que caracteriza a nuestros diseños, dando lugar al nacimiento de lo hermoso, lo bello del diseño…
        </p>
        <p class="lead">Esa es nuestra pasión y se refleja en cada producto nuevo que podemos ofrecerte.</p>
    </div>
</section>

<!-- Productos Destacados -->
<section class="section-destacados"> 
    <div class="container text-center">
        <h2 class="titulo-producto mb-5">Productos Destacados</h2>

        <div class="row g-4">                
            
            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 56.jpeg') ?>" class="card-img-top" alt="Mesa" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Mesa de Comedor Roble</h5>
                        <p class="card-text text-muted small">Madera de roble macizo, ideal para 6 personas.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold fs-5">$1,200.000</span>
                            <span class="badge bg-danger">Oferta</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 10.jpeg') ?>" class="card-img-top" alt="Silla" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Alacena Rústica</h5>
                        <p class="card-text text-muted small">Diseño rústico, fabricado en pino seleccionado.</p>
                        <div class="mt-3 text-start">
                            <span class="fw-bold fs-5">$650.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 46.jpeg') ?>" class="card-img-top" alt="Sillas" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Set de 4 Sillas</h5>
                        <p class="card-text text-muted small">Diseño moderno realizadas en madera reciclada.</p>
                        <div class="mt-3 text-start">
                            <span class="fw-bold fs-5">$1.200.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuevos Productos -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 32.jpeg') ?>" class="card-img-top" alt="Ropero" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Ropero Macizo Clásico</h5>
                        <p class="card-text text-muted small">Amplio espacio y durabilidad con acabados en cera natural.</p>
                        <div class="mt-3 text-start">
                            <span class="fw-bold fs-5">$2.500.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 20.jpeg') ?>" class="card-img-top" alt="Biblioteca" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Biblioteca de Roble</h5>
                        <p class="card-text text-muted small">Estantes reforzados para tu colección de libros favorita.</p>
                        <div class="mt-3 text-start">
                            <span class="fw-bold fs-5">$1.800.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="product-card card h-100 shadow-sm">
                    <img src="<?= base_url('assets/img/content/products/Muebles 68.jpeg') ?>" class="card-img-top" alt="Mesa Ratona" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Mesa Ratona Rústica</h5>
                        <p class="card-text text-muted small">El centro de atención para tu sala de estar artesanal.</p>
                        <div class="mt-3 text-start">
                            <span class="fw-bold fs-5">$450.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-5">
            <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-dark btn-lg px-5 rounded-pill btn-ver-todos">
                Ver Todos los Productos
            </a>
        </div>
    </div>
</section>

<!-- Ubicación -->
<section class="section-ubicacion">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h3 class="font-lora mb-4">¿Dónde nos podés encontrar?</h3>
                <h4 class="text-gold fw-bold mb-3">Mantilla, Corrientes</h4>
                <p class="lead mb-4">
                    Nuestro taller está en este rincón de Corrientes, donde las tradiciones se trabajan 
                    con el mismo cariño que las vetas de la madera.
                </p>
                <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark px-4 py-2 rounded-pill">
                    Ver en Google Maps <i class="bi bi-geo-alt ms-2"></i>
                </a>
            </div>
            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden shadow-lg border" style="height: 400px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3479.876234045048!2d-58.7687226!3d-29.2839154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944eba9a3d8e3c1f%3A0xf8a3e4f8a3e4f8a!2sMantilla%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713456789012!5m2!1ses-419!2sar" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
