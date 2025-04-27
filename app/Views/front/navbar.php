<!-- BARRA DE NAVEGACIÓN PRINCIPAL -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- Contenedor del Logo -->
    <div class="content-logo">
      <img src="assets/img/logo/cva2.png" alt="Logo CVA Muebles" width="50px" class="logo me-3 ms-3">
    </div>
    
    <!-- Título / Nombre de la marca -->
    <a class="navbar-brand" href="<?= base_url('/') ?>">
      <span class="titulo-logo">CVA Muebles</span>
    </a>

    <!-- Botón del menú para dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenedor principal del menú de navegación -->
    <div class="collapse navbar-collapse justify-content-between me-lg-5" id="navbarContent">
      
      <!-- Menú centrado con enlaces principales -->
      <ul class="navbar-nav mx-auto text-lg-center text-end content-list">
        <!-- Ítem: Inicio -->
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('/') ?>">Inicio</a>
        </li>

        <!-- Ítem: Productos -->
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('productos') ?>">Productos</a>
        </li>

        <!-- Ítem: Comercialización -->
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        </li>

        <!-- Ítem: Información -->
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('quienesSomos') ?>">Información</a>
        </li>

        <!-- Ítem: Contacto -->
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('informacionContacto') ?>">Contacto</a>
        </li>
      </ul>
      
      <!-- Íconos de Cuenta y Carrito a la derecha -->
      <div class="d-flex content-account">
        
        <!-- Botón de carrito -->
        <button class="btn btn-beige boton-links" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
          <img src="assets/img/iconos/cart-check.svg" alt="Carrito" class="icono">
        </button>
        
        <!-- Botón de usuario / cuenta -->
        <button class="btn btn-beige boton-links" type="button">
          <img src="assets/img/iconos/person.svg" alt="Registrarse" class="icono">
        </button>

      </div> <!-- Fin de content-account -->

    </div> <!-- Fin de navbarContent -->

  </div> <!-- Fin de container-fluid -->
</nav>

<!-- MENÚ LATERAL (Offcanvas) para el carrito -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  
  <!-- Encabezado del menú lateral -->
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas con scroll</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  
  <!-- Cuerpo del menú lateral -->
  <div class="offcanvas-body">
    <p>Intenta desplazarte por el resto de la página para ver esta opción en acción.</p>
  </div>

</div> <!-- Fin del offcanvas -->
