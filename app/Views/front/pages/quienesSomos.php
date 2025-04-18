<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - CVA Muebles</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>

<?= view('front/navbar') ?>

    <div class="header-section">
        <div class="container">
            <h1>Quiénes Somos</h1>
            <p class="lead">Artesanía en madera con tradición y pasión</p>
        </div>
    </div>

    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="section-title">Nuestra Historia</h2>
                <p>Fundada en 2020 en el corazón de Mantilla, Corrientes, CVA Muebles nació del amor por la madera y el diseño artesanal. Lo que comenzó como un pequeño taller familiar hoy es un referente en muebles de calidad con identidad regional.</p>
                <p>Nos especializamos en crear piezas únicas donde cada veta de madera cuenta una historia. Nuestros diseños combinan técnicas tradicionales con un enfoque contemporáneo, resultando en muebles que son verdaderas obras de arte funcionales.</p>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/img/taller-historia.jpg') ?>" alt="Taller CVA Muebles" class="img-fluid history-img">
            </div>
        </div>

        <div class="wood-separator"></div>

        <div class="text-center mb-5">
            <h2 class="section-title">Nuestra Filosofía</h2>
            <p class="lead">"En cada pieza que creamos, ponemos el mismo cuidado que pondríamos en un mueble para nuestra propia casa"</p>
            <p>Creemos en la sustentabilidad, por eso trabajamos con maderas de reforestación y aprovechamos cada centímetro del material. Nuestro proceso artesanal garantiza que cada pieza sea única, con ese pequeño detalle imperfecto que la hace especial.</p>
        </div>

        <div class="wood-separator"></div>

        <div class="mb-5">
            <h2 class="section-title">Nuestro Equipo</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team-1.jpg') ?>" class="card-img-top" alt="Carlos Vega">
                        <div class="card-body">
                            <h5>Carlos Vega</h5>
                            <p class="position">Fundador y Maestro Carpintero</p>
                            <p>Con más de 25 años de experiencia, Carlos es el alma mater de nuestros diseños. Especialista en muebles rústicos y tallado artesanal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="card-img-top" alt="Valeria Acevedo">
                        <div class="card-body">
                            <h5>Valeria Acevedo</h5>
                            <p class="position">Diseñadora y Proyectista</p>
                            <p>Combina su formación en diseño industrial con técnicas tradicionales para crear piezas que son tendencia pero con raíces artesanales.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team-3.jpg') ?>" class="card-img-top" alt="Andrés Rojas">
                        <div class="card-body">
                            <h5>Andrés Rojas</h5>
                            <p class="position">Especialista en Acabados</p>
                            <p>Maestro en el arte de los acabados, Andrés da a cada pieza su carácter único mediante técnicas de envejecido y tratamientos naturales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wood-separator"></div>
        <!-- Ubicación -->
<section class="container-fluid contenedor-ubicacion my-5">
    <div class="text-center location-title">
        <h3>¿Dónde nos podés encontrar?</h3>
    </div>

    <div class="d-flex m-4 mb-4 location-content">
        <!-- Mapa de Google Maps (reemplaza la imagen) -->
        <div class="w-50 map-container">
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
        <div class="px-5 w-50 location-text">
            <h4 class="titulos">Ubicado en Corrientes, Argentina</h4>
            <h3 class="titulos localidad typewriter-text">Localidad de Mantilla</h3>
            <p>
                Nuestro taller está en este rincón de Corrientes, donde las tradiciones se trabajan 
                con el mismo cariño que las vetas de la madera. ¡Visítanos y lleva un pedacito de 
                Mantilla en ese mueble que soñaste!
            </p>
            <!-- Botón opcional para abrir en Google Maps -->
            <a 
                href="https://www.google.com/maps/place/Mantilla,+Corrientes/@-29.2839154,-58.7687226,15z/data=!3m1!4b1!4m6!3m5!1s0x944eba9a3d8e3c1f:0xf8a3e4f8a3e4f8a!8m2!3d-29.2833333!4d-58.7666667!16s%2Fg%2F121j1t7y" 
                target="_blank" 
                class="btn btn-lg mt-3" style="background-color: var(--color-madera-oscura); color: white;"
            >
                Ver en Google Maps
            </a>
        </div>
    </div>
</section>
        <div class="text-center py-4">
            <h3>¿Quieres conocer más sobre nuestro proceso artesanal?</h3>
            <a href="<?= base_url('informacionContacto')?>" class="btn btn-lg mt-3" style="background-color: var(--color-madera-oscura); color: white;">Visítanos en nuestro taller</a>
        </div>
    </div>

    <?= view('front/footer') ?>
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>