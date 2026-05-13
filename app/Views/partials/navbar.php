<?php
  $session = session();
  $nombre = $session->get('nombre');
  $perfil = $session->get('perfil_id');
  $isLogged = $session->get('logged_in');
  $imagen = $session->get('imagen');
?>

<!-- BARRA DE NAVEGACIÓN PRINCIPAL -->
<nav class="navbar navbar-expand-lg artisan-main-nav">
  <div class="container-fluid px-lg-5">

    <!-- Bloque Izquierdo: Logo (Ancho balanceado) -->
    <div class="navbar-brand-wrapper d-flex align-items-center" style="flex: 1;">
      <img src="<?= base_url('assets/img/branding/cva2.png') ?>" alt="Logo CVA Muebles" width="50px" class="logo me-2">
      <a class="navbar-brand titulo-logo text-nowrap mb-0" href="<?= base_url('/') ?>">
        CVA Muebles
      </a>
    </div>

    <!-- Botón hamburguesa (móvil) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido del menú (Centro) -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarContent" style="flex: 2;">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php 
          $current_uri = service('request')->getUri()->getPath(); 
          $active_inicio = ($current_uri == '' || $current_uri == '/') ? 'active' : '';
          $active_productos = (strpos($current_uri, 'productos') !== false || strpos($current_uri, 'todos_p') !== false || strpos($current_uri, 'producto/detalle') !== false) ? 'active' : '';
          $active_comercializacion = (strpos($current_uri, 'comercializacion') !== false) ? 'active' : '';
          $active_info = (strpos($current_uri, 'quienesSomos') !== false) ? 'active' : '';
          $active_contacto = (strpos($current_uri, 'informacionContacto') !== false) ? 'active' : '';
        ?>
        <li class="nav-item">
          <a class="nav-link-custom mx-lg-2 <?= $active_inicio ?>" href="<?= base_url('/') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link-custom mx-lg-2 <?= $active_productos ?>" href="<?= $isLogged == 'SI' ? base_url('todos_p') : base_url('productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link-custom mx-lg-2 <?= $active_comercializacion ?>" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link-custom mx-lg-2 <?= $active_info ?>" href="<?= base_url('quienesSomos') ?>">Información</a>
        </li>
        <li class="nav-item">
          <a class="nav-link-custom mx-lg-2 <?= $active_contacto ?>" href="<?= base_url('informacionContacto') ?>">Contacto</a>
        </li>
      </ul>
    </div>

    <!-- Bloque Derecho: Íconos (Ancho balanceado para centrado perfecto) -->
    <div class="d-flex align-items-center justify-content-end gap-2" style="flex: 1;">
        <?php if (!$isLogged): ?>
          <a class="boton-icon-circle" href="<?= base_url('login') ?>">
            <img src="<?= base_url('assets/img/ui/icons/person.svg') ?>" alt="Login" class="icono-svg">
          </a>
        <?php else: ?>
          <?php if (env('SHOPPING_CART_ENABLED')): ?>
          <a class="boton-icon-circle" href="<?= base_url('/muestro') ?>">
            <img src="<?= base_url('assets/img/ui/icons/cart-check.svg') ?>" alt="Carrito" class="icono-svg">
          </a>
          <?php endif; ?>

          <button class="boton-icon-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPerfil">
            <img src="<?= base_url('assets/img/ui/icons/person.svg') ?>" alt="Perfil" class="icono-svg">
          </button>
        <?php endif; ?>
    </div>

  </div> <!-- Fin container-fluid -->
</nav>

<!-- MENÚ LATERAL (OFFCANVAS) -->
<div class="offcanvas offcanvas-end menu-lateral shadow-lg border-0" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasPerfil">
  
  <!-- Cabecera del Menú -->
  <div class="offcanvas-header shadow-sm">
    <div class="d-flex align-items-center">
      <i class="bi bi-person-badge fs-4 me-2 text-cva-gold"></i>
      <h5 class="offcanvas-title fw-bold" id="offcanvasScrollingLabel">Panel de Gestión</h5>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>

  <div class="offcanvas-body p-0">
    
    <!-- Sección de Usuario -->
    <div class="user-profile-card p-4 text-center">
      <div class="avatar-wrapper mx-auto mb-3 position-relative" style="width: 90px; height: 90px;">
          <div class="avatar-bg shadow-sm">
              <?php if (!empty($imagen)): ?>
                  <img src="<?= base_url('assets/uploads/perfil/' . $imagen) ?>" alt="Perfil" style="width: 100%; height: 100%; object-fit: cover;">
              <?php else: ?>
                  <i class="bi bi-person-fill text-secondary" style="font-size: 3.5rem;"></i>
              <?php endif; ?>
          </div>
          <div class="status-indicator"></div>
      </div>
      <h5 class="mb-1 fw-bold"><?= esc($nombre) ?></h5>
      <div class="d-flex justify-content-center mb-3">
          <span class="badge bg-cva-brown rounded-pill px-3 py-1 text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">
            <i class="bi bi-shield-lock me-1"></i> <?= ($perfil == 1) ? 'ADMINISTRADOR' : 'CLIENTE' ?>
          </span>
      </div>
      <a href="<?= base_url('/perfil') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-4 fw-bold">CONFIGURAR PERFIL</a>
    </div>

    <!-- Lista de Opciones -->
    <div class="menu-options-container p-3">
      <?php if ($perfil == 1): ?>
        <p class="sidebar-section-label">ADMINISTRACIÓN</p>
        <div class="list-group list-group-flush rounded-4 overflow-hidden border shadow-sm mb-4">
          <a href="<?= base_url('/admin-dashboard') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-speedometer2 me-3 text-cva-gold fs-5"></i> Dashboard Principal
          </a>
          <a href="<?= base_url('/ventas-list') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-tools me-3 text-cva-gold fs-5"></i> Control de Ventas
          </a>
          <a href="<?= base_url('/consultas') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-chat-dots me-3 text-cva-gold fs-5"></i> Inbox Consultas
          </a>
          <a href="<?= base_url('/crud-productos') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-box-seam me-3 text-cva-gold fs-5"></i> Gestión de Productos
          </a>
          <a href="<?= base_url('/crud-usuarios') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-people me-3 text-cva-gold fs-5"></i> Gestión de Usuarios
          </a>
        </div>
      <?php endif; ?>

      <p class="sidebar-section-label">MI ACTIVIDAD</p>
      <div class="list-group list-group-flush rounded-4 overflow-hidden border shadow-sm">
        <?php if (env('SHOPPING_CART_ENABLED')): ?>
        <a href="<?= base_url('/muestro') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
          <i class="bi bi-cart3 me-3 text-cva-gold fs-5"></i> Mi Carrito
        </a>
        <?php endif; ?>
        <a href="<?= base_url('/ventas_lista') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
          <i class="bi bi-bag-check me-3 text-cva-gold fs-5"></i> Mis Compras
        </a>
      </div>

      <!-- Botón Cerrar Sesión -->
      <div class="px-3 mt-5 pb-5">
        <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger w-100 py-2 fw-bold rounded-pill shadow-sm d-flex align-items-center justify-content-center">
          <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
        </a>
      </div>
    </div>

  </div>
</div>
