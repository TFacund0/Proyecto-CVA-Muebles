<?php
  $session = session();
  $nombre = $session->get('nombre');
  $perfil = $session->get('perfil_id');
  $isLogged = $session->get('logged_in');
?>

<!-- BARRA DE NAVEGACIÓN PRINCIPAL -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- Contenedor del Logo -->
    <div class="content-logo">
      <img src="assets/img/logo/cva2.png" alt="Logo CVA Muebles" width="50px" class="logo me-3 ms-3">
    </div>
    
    <!-- Título / Nombre de la marca -->
    <div>
      <a class="navbar-brand" href="<?= base_url('/') ?>">
        <span class="ms-3 titulo-logo">CVA Muebles</span>
      </a>

      <?php if ($perfil == 1) {?>
        <a class="ms-3 titulo-perfil d-block"><strong>Administrador:</strong> <?php echo $nombre?> </a>
      <?php }?>
      
      <?php if ($perfil == 2) {?>
        <a class="ms-3 titulo-perfil d-block"><strong>Usuario:</strong> <?php echo $nombre?></a>
      <?php }?>
    </div>

    <?= csrf_field(); ?>
    <?php if (!empty(session()->getFlashdata('sucess'))) {?>
      <div class="alert alert-Primary"><?=session()->getFlashdata('sucess'); ?></div>
    <?php }?>

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
        <?php if (!$isLogged) {?>
                <a class="btn btn-beige boton-links" href="<?= base_url('login') ?>">
                  <img src="assets/img/iconos/person.svg" alt="Registrarse" class="icono">
                </a>
        <?php } else {?>
                <button class="btn btn-beige boton-links" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPerfil" aria-controls="offcanvasScrolling">
                  <img src="assets/img/iconos/person.svg" alt="Opciones de perfil de usuario" class="icono">
                </button>
        <?php }?>

      </div> <!-- Fin de content-account -->

    </div> <!-- Fin de navbarContent -->

  </div> <!-- Fin de container-fluid -->
</nav>

<!-- MENÚ LATERAL (Offcanvas) para el carrito -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  
  <!-- Encabezado del menú lateral -->
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu de Usuario</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  
  <!-- Cuerpo del menú lateral -->
  <div class="offcanvas-body">
    <ul>
      <li>Opcion 1</li>
      <li>Opcion 2</li>
    </ul>
  </div>

</div> <!-- Fin del offcanvas -->


<!-- MENÚ LATERAL (Offcanvas) para el perfil-->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasPerfil" aria-labelledby="offcanvasScrollingLabel">
  
  <!-- Encabezado del menú lateral -->
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu de Opciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>

  <!-- Cuerpo del menú lateral -->
  <div class="offcanvas-body">
    <ul>
      <li>Opcion 1</li>
      <li>Opcion 2</li>
      <li>Opcion 3</li>
    </ul>
    <div class="btn btn-primary">
      <a class="text-dark mx-1" href="<?= base_url('/logout') ?>">Cerrar sesión</a>
    </div>
  </div>

</div> <!-- Fin del offcanvas -->
