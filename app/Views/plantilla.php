<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'titulo variable' ?></title>
    
    <link rel="stylesheet" href="assets/css/miestilo.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="assets/js/bootstrap.bundle.min.js" ></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-madera-clara: #e3c9a0;
            --color-madera-oscura: #5a3a22;
            --color-accento: #8b5a2b;
        }
        
        body {
            font-family: 'Georgia', serif;
            background-color: #f9f5f0;
            color: #333;
        }
        
        .bg-madera-clara {
            background-color: var(--color-madera-clara);
        }
        
        .bg-madera-oscura {
            background-color: var(--color-madera-oscura);
            color: white;
        }
        
        .text-madera {
            color: var(--color-accento);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/img/texturas/mesa.jpeg');
            background-size: cover;
            background-position: center;
            min-height: 60vh;
        }
        
        .producto-card {
            transition: transform 0.3s;
            border: 1px solid #ddd;
            overflow: hidden;
        }
        
        .producto-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .textura-madera {
            background-image: url('img/textura-madera.jpg');
            background-size: cover;
        }
    </style>
</head>

  <body>
  <section id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/fondos-carrusel/GojoWorld.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>
  
  <!-- Hero Section -->
    <header class="hero-section d-flex align-items-center text-white">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">Muebles Artesanales Hechos a Mano</h1>
            <p class="lead mb-5">Cada pieza cuenta una historia, tallada con paciencia y dedicación</p>
            <a href="#" class="btn btn-primary btn-lg px-4 me-2">Ver Colección</a>
            <a href="#" class="btn btn-outline-light btn-lg px-4">Conoce Nuestro Proceso</a>
        </div>
    </header>

    <!-- Sección de Categorías -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-madera">Nuestras Especialidades</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-chair fa-3x mb-3 text-madera"></i>
                            <h3>Muebles de Sala</h3>
                            <p>Sofás, mesas de centro y libreros diseñados para tu comodidad</p>
                            <a href="#" class="btn btn-outline-primary">Explorar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-bed fa-3x mb-3 text-madera"></i>
                            <h3>Dormitorio</h3>
                            <p>Camas, mesitas y armarios que transformarán tu espacio</p>
                            <a href="#" class="btn btn-outline-primary">Explorar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-utensils fa-3x mb-3 text-madera"></i>
                            <h3>Cocina</h3>
                            <p>Islas, alacenas y mesas rústicas para tu hogar</p>
                            <a href="#" class="btn btn-outline-primary">Explorar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="text-madera">Productos Destacados</h2>
                <a href="#" class="btn btn-outline-madera">Ver Todos</a>
            </div>
            <div class="row g-4">
                <!-- Producto 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="producto-card card h-100">
                        <div class="badge bg-danger position-absolute" style="top: 10px; right: 10px">Oferta</div>
                        <img src="assets/img/texturas/mesa.jpg" class="card-img-top" alt="Mesa de comedor">
                        <div class="card-body">
                            <h5 class="card-title">Mesa de Comedor Roble</h5>
                            <p class="text-muted">Hecha a mano con madera de roble macizo</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-madera">$1,200.000</span>
                                <del class="text-muted">$1,500.000</del>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-primary w-100">Añadir al Carrito</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="producto-card card h-100">
                        <img src="assets/img/texturas/silla.jpg" class="card-img-top" alt="Silla de madera">
                        <div class="card-body">
                            <h5 class="card-title">Silla Artesanal</h5>
                            <p class="text-muted">Diseño ergonómico con acabado natural</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-madera">$350.000</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-outline-primary w-100">Ver Detalles</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="producto-card card h-100">
                        <img src="assets/img/texturas/estante.jpeg" class="card-img-top" alt="Estante para libros">
                        <div class="card-body">
                            <h5 class="card-title">Estante Librero</h5>
                            <p class="text-muted">Hecho con madera de pino reciclado</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-madera">$890.000</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-outline-primary w-100">Ver Detalles</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="producto-card card h-100">
                        <div class="badge bg-success position-absolute" style="top: 10px; right: 10px">Nuevo</div>
                        <img src="assets/img/texturas/cama.jpg" class="card-img-top" alt="Cama rústica">
                        <div class="card-body">
                            <h5 class="card-title">Cama King Size</h5>
                            <p class="text-muted">Diseño rústico con cabecera tallada</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-madera">$2,450.000</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-primary w-100">Añadir al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección del Taller -->
    <section class="py-5 bg-madera-clara">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="assets/img/texturas/taller.jpg" alt="Nuestro taller" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="text-madera mb-4">Hecho con Pasión en Nuestro Taller</h2>
                    <p>Cada pieza en nuestra colección nace en nuestro taller, donde combinamos técnicas tradicionales con diseños contemporáneos.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-madera me-2"></i> Madera 100% natural</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-madera me-2"></i> Acabados artesanales</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-madera me-2"></i> Procesos sostenibles</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-madera me-2"></i> Garantía de por vida</li>
                    </ul>
                    <a href="#" class="btn btn-outline-madera mt-3">Conoce Nuestro Proceso</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 text-madera">Lo que Dicen Nuestros Clientes</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text">"La mesa de comedor superó todas mis expectativas. La calidad de la madera y el acabado son excepcionales."</p>
                            <div class="d-flex align-items-center">
                                <img src="img/cliente1.jpg" class="rounded-circle me-3" width="50" alt="Cliente">
                                <div>
                                    <h6 class="mb-0">María González</h6>
                                    <small class="text-muted">Bogotá, Colombia</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Más testimonios... -->
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-5 bg-madera-oscura text-white">
        <div class="container text-center">
            <h2 class="mb-4">Únete a Nuestra Comunidad</h2>
            <p class="lead mb-4">Recibe ofertas exclusivas y conoce nuestras nuevas creaciones</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form class="input-group">
                        <input type="email" class="form-control" placeholder="Tu correo electrónico">
                        <button class="btn btn-primary" type="submit">Suscribirse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
</html>