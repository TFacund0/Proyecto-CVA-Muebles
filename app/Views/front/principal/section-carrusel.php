<!-- 
  =============================================
  ARTISAN HERO CAROUSEL - BRAND IDENTITY
  =============================================
-->

<div id="heroCarousel" class="carousel slide carousel-fade shadow-lg" data-bs-ride="carousel">
    
    <!-- Indicadores de Navegación -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Contenedor de los ítems -->
    <div class="carousel-inner" style="height: 600px;">

        <!-- Slide 1: El Taller -->
        <div class="carousel-item active h-100">
            <div class="carousel-img-overlay"></div>
            <img src="<?= base_url('assets/img/fondos-carrusel/taller.jpg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Taller de carpintería">
            <div class="carousel-caption d-md-block text-start" style="bottom: 20%; left: 10%; right: 10%;">
                <h1 class="display-3 fw-bold font-lora mb-3 slide-in-bottom">Bienvenidos a <span class="text-gold">CVA Muebles</span></h1>
                <p class="fs-4 mb-4 opacity-75 slide-in-bottom-delay-1">Diseño y fabricación artesanal de muebles a medida con maderas seleccionadas.</p>
                <div class="slide-in-bottom-delay-2">
                    <a href="<?= base_url('quienesSomos') ?>" class="btn btn-gold-artisan rounded-pill px-5 py-3 fw-bold text-uppercase shadow-lg">
                        Nuestra Historia <i class="bi bi-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2: Calidad -->
        <div class="carousel-item h-100">
            <div class="carousel-img-overlay"></div>
            <img src="<?= base_url('assets/img/fondos-carrusel/Muebles 22.jpeg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Muebles artesanales">
            <div class="carousel-caption d-md-block text-center" style="bottom: 25%;">
                <h2 class="display-4 fw-bold font-lora mb-3">Calidad Artesanal Incomparable</h2>
                <p class="fs-5 mb-4 opacity-75">Cada pieza es única, hecha con dedicación y el alma de un maestro artesano.</p>
                <a href="<?= base_url('productos') ?>" class="btn btn-outline-light rounded-pill px-5 py-2 fw-bold text-uppercase">Ver Colección</a>
            </div>
        </div>

        <!-- Slide 3: Pasión -->
        <div class="carousel-item h-100">
            <div class="carousel-img-overlay"></div>
            <img src="<?= base_url('assets/img/fondos-carrusel/Muebles 69.jpeg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Muebles familiares">
            <div class="carousel-caption d-md-block text-end" style="bottom: 20%; right: 10%;">
                <h2 class="display-4 fw-bold font-lora mb-3">Oficio Familiar</h2>
                <p class="fs-5 mb-4 opacity-75">Transformamos tus espacios con muebles que cuentan una historia.</p>
                <a href="<?= base_url('informacionContacto') ?>" class="btn btn-gold-artisan rounded-pill px-5 py-2 fw-bold text-uppercase">Contáctanos</a>
            </div>
        </div>

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon p-3 bg-dark rounded-circle opacity-50" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon p-3 bg-dark rounded-circle opacity-50" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>

</div>

<style>
    .font-lora { font-family: 'Lora', serif; }
    .text-gold { color: #b8860b; }
    
    .carousel-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.7) 100%);
        z-index: 1;
    }

    .carousel-caption {
        z-index: 2;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .btn-gold-artisan {
        background-color: #b8860b;
        color: white;
        border: none;
        transition: all 0.3s;
    }

    .btn-gold-artisan:hover {
        background-color: #ffffff;
        color: #3e2723;
        transform: translateY(-3px);
    }

    /* Animaciones de entrada */
    .slide-in-bottom {
        animation: slideInBottom 0.8s ease-out forwards;
    }
    .slide-in-bottom-delay-1 {
        animation: slideInBottom 0.8s ease-out 0.2s forwards;
        opacity: 0;
    }
    .slide-in-bottom-delay-2 {
        animation: slideInBottom 0.8s ease-out 0.4s forwards;
        opacity: 0;
    }

    @keyframes slideInBottom {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .carousel-inner { height: 400px !important; }
        .display-3 { font-size: 2.5rem; }
    }
</style>