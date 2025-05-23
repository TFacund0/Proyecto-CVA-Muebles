<!-- Carrusel principal -->
<div id="carouselExample" class="carousel slide carrusel-size " data-bs-ride="carousel">

    <!-- Contenedor de los ítems del carrusel -->
    <div class="carousel-inner carrusel-size">

        <!-- Ítem activo (primera imagen del carrusel) -->
        <div class="carousel-item active">
            <img src="assets/img/fondos-carrusel/taller.jpg" class="d-block w-100 img-carrusel" alt="Taller de carpintería">
            
            <div class="carousel-caption d-none d-md-block text-content-carrusel position-carrusel">
                <h4 class="col text-carrusel">Bienvenidos a CVA Muebles</h4>
                <p class="col text-carrusel">Diseño y fabricación artesanal de muebles de madera a medida</p>
                
                <div class="col info">
                    <h5><a href="<?= base_url('quienesSomos')?>" class="boton-carrusel">Más Información</a></h5>
                </div>
            </div>
        </div>

        <!-- Segundo ítem del carrusel -->
        <div class="carousel-item">
            <img src="assets/img/fondos-carrusel/Muebles 22.jpeg" class="d-block w-100 img-carrusel" alt="Muebles artesanales">
            
            <div class="carousel-caption d-none d-md-block text-content-carrusel position-carrusel">
                <h4 class="col text-carrusel">Calidad artesanal</h4>
                <p class="col text-carrusel">Diseño con alma en el que cada pieza es única y hecha con dedicación</p>
            </div>
        </div>

        <!-- Tercer ítem del carrusel -->
        <div class="carousel-item">
            <img src="assets/img/fondos-carrusel/Muebles 69.jpeg" class="d-block w-100 img-carrusel" alt="Muebles familiares">
            
            <div class="carousel-caption d-none d-md-block text-content-carrusel position-carrusel">
                <h4 class="col text-carrusel">Pasión que se transmite</h4>
                <p class="col text-carrusel">Más de 2 años creando muebles con amor y oficio familiar</p>
            </div>
        </div>
    </div>

    <!-- Botón para ir al slide anterior -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>

    <!-- Botón para ir al siguiente slide -->
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>