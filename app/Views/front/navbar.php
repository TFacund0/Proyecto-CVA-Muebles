<?php
  $session = session();
  $nombre = $session->get('nombre');
  $perfil = $session->get('perfil_id');
  $isLogged = $session->get('logged_in');
?>

<!-- BARRA DE NAVEGACIÓN PRINCIPAL -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- Logo y Título -->
    <div class="d-flex align-items-center flex-wrap">
      <img src="<?= base_url('assets/img/logo/cva2.png') ?>" alt="Logo CVA Muebles" width="50px" class="logo me-2 ms-2">
      <a class="navbar-brand titulo-logo text-nowrap" href="<?= base_url('/') ?>">
        CVA Muebles
      </a>

      <?php if ($perfil == 1 || $perfil == 2): ?>
        <a class="titulo-perfil d-none d-md-block btn btn-outline-light ms-2" href="<?= base_url('/perfil') ?>">
          <strong>Usuario:</strong> <?= $perfil == 1 ? 'admin' : 'cliente' ?>
        </a>
      <?php endif; ?>
    </div>

    <?= csrf_field(); ?>
    <?php if (!empty(session()->getFlashdata('sucess'))): ?>
      <div class="alert alert-primary"><?= session()->getFlashdata('sucess'); ?></div>
    <?php endif; ?>

    <!-- Botón hamburguesa (móvil) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido del menú -->
    <div class="collapse navbar-collapse justify-content-between me-lg-5" id="navbarContent">

      <!-- Enlaces principales -->
      <ul class="navbar-nav mx-auto text-lg-center text-end content-list">
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('/') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('quienesSomos') ?>">Información</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-beige text-dark mx-1" href="<?= base_url('informacionContacto') ?>">Contacto</a>
        </li>
      </ul>

      <!-- Íconos de perfil/carrito -->
      <div class="d-flex content-account align-items-center gap-2">

        <?php if (!$isLogged): ?>
          <a class="btn btn-beige boton-links" href="<?= base_url('login') ?>">
            <img src="<?= base_url('assets/img/iconos/person.svg') ?>" alt="Registrarse" class="icono">
          </a>
        <?php else: ?>
          <a class="btn btn-beige boton-links" href="<?= base_url('/muestro') ?>">
            <img src="<?= base_url('assets/img/iconos/cart-check.svg') ?>" alt="Carrito" class="icono">
          </a>

          <button class="btn btn-beige boton-links" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPerfil" aria-controls="offcanvasScrolling">
            <img src="<?= base_url('assets/img/iconos/person.svg') ?>" alt="Opciones de perfil de usuario" class="icono">
          </button>
        <?php endif; ?>
        
      </div>

    </div> <!-- Fin navbar-collapse -->

  </div> <!-- Fin container-fluid -->
</nav>

<!-- MENÚ LATERAL (OFFCANVAS) -->
<div class="offcanvas offcanvas-end menu-lateral" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasPerfil" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header titulo-menu-lateral">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menú de Opciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>

  <div class="offcanvas-body cuerpo-menu-lateral">
    <?php if ($perfil == 1): ?>
      <div class="btn usuario-boton-lateral">
        <a href="<?= base_url('/perfil') ?>">Usuario: <?= esc($nombre) ?></a>
      </div>
      <ul class="list-unstyled">
        <li><a class="nav-link" href="<?= base_url('/alta-producto') ?>">Añadir Producto</a></li>
        <li><a class="nav-link" href="<?= base_url('/ventas-list') ?>">Lista de Ventas</a></li>
        <li><a class="nav-link" href="<?= base_url('/crud-usuarios') ?>">Lista de Usuarios</a></li>
        <li><a class="nav-link" href="<?= base_url('/crud-productos') ?>">Lista de Productos</a></li>
        <li><a class="nav-link" href="<?= base_url('/lista-consultas') ?>">Consultas</a></li>
      </ul>
    <?php elseif ($perfil == 2): ?>
      <div class="btn usuario-boton-lateral">
        <a href="<?= base_url('/perfil') ?>">Cliente: <?= esc($nombre) ?></a>
      </div>
      <ul class="list-unstyled">
        <li><a class="nav-link" href="<?= base_url('/muestro') ?>">Carrito</a></li>
        <li><a class="nav-link" href="<?= base_url('/ventas_lista') ?>">Mis productos</a></li>
      </ul>
    <?php endif; ?>

    <div class="btn-cerrar-sesion mt-3">
      <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="<?= base_url('/logout') ?>">
        Cerrar sesión
      </a>
    </div>
  </div>
</div>
