<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - CVA Muebles</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="assets/css/a-styles/navbar.css">
    <link rel="stylesheet" href="assets/css/a-styles/miestilo.css">
    <link rel="stylesheet" href="assets/css/a-styles/quienesSomos.css">
</head>
<body>

<?= view('front/navbar') ?>

    <!-- Sección de encabezado con título y subtítulo -->
    <header class="header-section">
        <div class="container-fluid text-center p-5 fondo-header">
            <h1>Quiénes Somos?</h1>
            <p class="lead mt-5">Artesanía en madera con tradición y pasión</p>
        </div>
    </header>

    <!-- Sección principal del contenido -->
    <section class="container">

        <!-- SECCIÓN: Nuestra Historia -->
        <div class="row my-5 p-3 py-4 gap-3 d-flex justify-content-around contenedor-historia">
            
            <!-- Texto de la historia -->
            <div class="col-lg-6 col-sm-12 texto-historia-section">
                <h2 class="section-title">Nuestra Historia</h2>
                <p class="mt-3">
                    Fundada en 2020 en el corazón de Mantilla, Corrientes, CVA Muebles nació del amor por la madera y el diseño artesanal. 
                    Lo que comenzó como un pequeño taller familiar hoy es un referente en muebles de calidad con identidad regional.
                </p>
                <p>
                    Nos especializamos en crear piezas únicas donde cada veta de madera cuenta una historia. 
                    Nuestros diseños combinan técnicas tradicionales con un enfoque contemporáneo, resultando en muebles que son verdaderas obras de arte funcionales.
                </p>
            </div>

            <!-- Imagen representativa de la historia -->
            <div class="col-lg-5 col-sm-12 d-flex img-historia-section">
                <img src="<?= base_url('assets/img/texturas/carpienteria.jpg') ?>" 
                     alt="Taller CVA Muebles" 
                     class="img-fluid history-img">
            </div>
        </div>

        <!-- SECCIÓN: Nuestra Filosofía -->
        <div class="text-center contenedor-filosofia p-3">
            <h2 class="section-title">Nuestra Filosofía</h2>
            <p class="lead">
                "En cada pieza que creamos, ponemos el mismo cuidado que pondríamos en un mueble para nuestra propia casa"
            </p>
            <p>
                Creemos en la sustentabilidad, por eso trabajamos con maderas de reforestación y aprovechamos cada centímetro del material. 
                Nuestro proceso artesanal garantiza que cada pieza sea única, con ese pequeño detalle imperfecto que la hace especial.
            </p>
        </div>

        <!-- SECCIÓN: Nuestro Equipo -->
        <div class="container-fluid my-5 contenedor-equipo">
            <h2 class="section-title">Nuestro Equipo</h2>

            <div class="row team-box">
                
                <!-- Miembro 1 -->
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team/viejo.jpg') ?>" class="card-img-top" alt="Carlos Vega">
                        <div class="card-body">
                            <h5>Carlos Vega</h5>
                            <p class="position">Fundador y Maestro Carpintero</p>
                            <p>Con más de 25 años de experiencia, Carlos es el alma mater de nuestros diseños. Especialista en muebles rústicos y tallado artesanal.</p>
                        </div>
                    </div>
                </div>

                <!-- Miembro 2 -->
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team/diseñadora.jpg') ?>" class="card-img-top" alt="Valeria Acevedo">
                        <div class="card-body">
                            <h5>Valeria Acevedo</h5>
                            <p class="position">Diseñadora y Proyectista</p>
                            <p>Combina su formación en diseño industrial con técnicas tradicionales para crear piezas que son tendencia pero con raíces artesanales.</p>
                        </div>
                    </div>
                </div>

                <!-- Miembro 3 -->
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="<?= base_url('assets/img/team/diseñador.jpg') ?>" class="card-img-top" alt="Andrés Rojas">
                        <div class="card-body">
                            <h5>Andrés Rojas</h5>
                            <p class="position">Especialista en Acabados</p>
                            <p>Maestro en el arte de los acabados, Andrés da a cada pieza su carácter único mediante técnicas de envejecido y tratamientos naturales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?= view('front/footer') ?>
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>