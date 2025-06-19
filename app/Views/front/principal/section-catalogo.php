<?php
    $session = session();
    $isLogged = $session->get('isLogged');
?>

<!-- Sección de Categorias/Catalogo -->
<section class="container my-5 catalogo-content section-categorias">
    <h2 class="titulo">Nuestras Especialidades</h2>
    
    <div class="row p-3">
    <!-- Especialidad: Muebles de Sala -->
        <div class="col-md-4 my-2">
            <div class="card catalogo-card h-100 text-center p-4 muebles-card ">
                <div class="card-body text-card">
                    <h3>Muebles de Sala</h3>
                    <p>Sofás, mesas de centro y libreros diseñados para tu comodidad</p>
                    <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-warning">Explorar</a>
                </div>
            </div>
        </div>

    <!-- Especialidad: Dormitorios -->
        <div class="col-md-4 my-2">
            <div class="card catalogo-card h-100 text-center p-4 dormitorios-card">
                <div class="card-body text-card">
                    <h3>Dormitorios</h3>
                    <p>Camas, mesitas y armarios que transformarán tu espacio</p>
                    <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-warning">Explorar</a>
                </div>
            </div>
        </div>                
        
    <!-- Especialidad: Cocina -->
        <div class="col-md-4 my-2">
            <div class="card catalogo-card h-100 text-center p-4 cocina-card">
                <div class="card-body text-card">
                    <h3>Cocina</h3>
                    <p>Islas, alacenas y mesas rústicas para tu hogar</p>
                    <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-outline-warning">Explorar</a>
                </div>
            </div>
        </div>  
        
    </div>
</section>

<!-- Texto a modo de promoción de los productos y de la empresa -->
<section class="container-fluid m-auto section-texto">
    <div class="m-auto my-3 p-3 bloque-texto">
        
        <h2 class="text-titulo">¡Diseños Únicos!</h2>
        <p>
            En CVA Muebles nos destacamos por la creatividad al diseñar. Inspirados en la simpleza morfológica encontramos la sutileza que caracteriza a nuestros diseños, dando lugar al nacimiento de lo hermoso, lo bello del diseño…
        </p>
        <p>Esa es nuestra pasión y se refleja en cada producto nuevo que podemos ofrecerte.</p>

    </div>
</section>


<!-- Productos Destacados -->
<section class="container my-5 py-5 section-destacados"> 
    <!-- Titulo -->
    <div class="d-flex justify-content-around align-items-center mb-5">
        <h2 class="titulo-producto mt-0">Productos Destacados</h2>
    </div>

    <div class="row g-4">                
        
        <!-- Contenedor de la primera imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
                
                <!-- Indicador de Oferta -->
                <div class="badge bg-danger position-absolute" style="top: 10px; right: 10px">Oferta</div>
                
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 56.jpeg" class="card-img-top h-100" alt="Mesa de comedor">
                    
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Mesa de Comedor Roble</h5>
                    <p class="text-muted">Juego artesanal de comedor fabricado en madera de roble macizo, ideal para 6 personas. Terminación natural para un estilo rústico y elegante. Resistente y de larga duración.</p>
                        
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$1,200.000</span>
                        <del class="text-muted">$1,500.000</del>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Contenedor de la Segunda imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
            
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 10.jpeg" class="card-img-top h-100" alt="Silla de madera">
                
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Alacena Rústica de Pino Macizo</h5>
                    <p class="text-muted">Estante tipo alacena de diseño rústico, fabricado en pino seleccionado. Cuenta con un sector abierto de 8 divisiones y un módulo cerrado para mayor funcionalidad.</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$650.000</span>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Contenedor de la Tercera imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
                
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 46.jpeg" class="card-img-top h-100" alt="Estante para libros">
                
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Set de 4 Sillas Modernas</h5>
                    <p class="text-muted">Conjunto de 4 sillas de diseño moderno realizadas en madera reciclada, con asiento tapizado en ecocuero. Combinan robustez, sustentabilidad y estilo contemporáneo.</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$1.200.000 (el set completo)</span>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- Contenedor de la Cuarta imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
            
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 58.jpeg" class="card-img-top h-100" alt="Silla de madera">
                
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Mesa de Arrime de Pino Macizo con Cajón</h5>
                    <p class="text-muted">Mesa auxiliar fabricada artesanalmente en pino seleccionado, con acabado natural y un cajón frontal para almacenamiento. Ideal para recibidores, livings o dormitorios</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$150.000</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contenedor de la Quinta imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
            
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 54.jpeg" class="card-img-top h-100" alt="Silla de madera">
                
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Sillón Mecedor de Exterior en Madera Tratada</h5>
                    <p class="text-muted">Realizado en madera tratada para resistir la intemperie. Diseño ergonómico, cómodo y rústico, perfecto para galerías, patios o balcones.</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$700.000</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contenedor de la Sexta imagen -->
        <div class="col-lg-4 col-md-6 card-size">
            
            <div class="product-card card h-100">
            
                <!-- Imagen -->
                <img src="assets/img/muebles/Muebles 64.jpeg" class="card-img-top h-100" alt="Silla de madera">
                
                <!-- Texto Descriptivo -->
                <div class="card-body">
                    <h5 class="card-title">Cama Daybed de Madera Maciza con Cajoneras</h5>
                    <p class="text-muted">Con respaldo calado artesanal y tres amplios cajones inferiores para guardado. Ideal para dormitorios modernos y funcionales.</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$1.200.000</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Boton para ver los todos los productos -->
        <div class="text-center mt-5">
            <a href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>" class="btn btn-ver-todos">
                <span class="me-2">Ver Todos los Productos</span>
            </a>
        </div>
</section>


<!-- Ubicación -->
<section class="container-fluid contenedor-ubicacion my-5">
    
    <!-- Titulo -->
    <div class="text-center location-title">
        <h3>¿Dónde nos podés encontrar?</h3>
    </div>

    <div class="row d-flex m-4 mb-4 location-content">
        
        <!-- Mapa de Google Maps (reemplaza la imagen) -->
        <div class="col-lg-6 col-md-6 col-sm-12 map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3479.876234045048!2d-58.7687226!3d-29.2839154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944eba9a3d8e3c1f%3A0xf8a3e4f8a3e4f8a!2sMantilla%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713456789012!5m2!1ses-419!2sar" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="rounded"
            ></iframe>
        </div>
        
        <!-- Texto descriptivo -->
        <div class="col-lg-6 col-md-6 col-sm-12 px-lg-5 location-text">
            <h4 class="titulos">Ubicado en Corrientes, Argentina</h4>
            <h3 class="titulos localidad">Localidad de Mantilla</h3>
            <p>
                Nuestro taller está en este rincón de Corrientes, donde las tradiciones se trabajan 
                con el mismo cariño que las vetas de la madera. ¡Visítanos y lleva un pedacito de 
                Mantilla en ese mueble que soñaste!
            </p>
            
            <!-- Botón para abrir en Google Maps -->
            <a 
                href="https://www.google.com/maps/place/Mantilla,+Corrientes/@-29.2839154,-58.7687226,15z/data=!3m1!4b1!4m6!3m5!1s0x944eba9a3d8e3c1f:0xf8a3e4f8a3e4f8a!8m2!3d-29.2833333!4d-58.7666667!16s%2Fg%2F121j1t7y" 
                target="_blank" 
                class="btn btn-primary mt-3"
            >
                Ver en Google Maps
            </a>
        </div>
    </div>
</section>