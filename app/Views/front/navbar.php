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
          <?php if (env('SHOPPING_CART_ENABLED')): ?>
          <a class="btn btn-beige boton-links" href="<?= base_url('/muestro') ?>">
            <img src="<?= base_url('assets/img/iconos/cart-check.svg') ?>" alt="Carrito" class="icono">
          </a>
          <?php endif; ?>

          <button class="btn btn-beige boton-links" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPerfil" aria-controls="offcanvasScrolling">
            <img src="<?= base_url('assets/img/iconos/person.svg') ?>" alt="Opciones de perfil de usuario" class="icono">
          </button>
        <?php endif; ?>
        
      </div>

    </div> <!-- Fin navbar-collapse -->

  </div> <!-- Fin container-fluid -->
</nav>

<!-- MENÚ LATERAL (OFFCANVAS) - REDISEÑO ARTISAN -->
<div class="offcanvas offcanvas-end menu-lateral shadow-lg border-0" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasPerfil">
  
  <!-- Cabecera del Menú -->
  <div class="offcanvas-header text-white" style="background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);">
    <div class="d-flex align-items-center">
      <i class="bi bi-person-badge fs-4 me-2 text-gold"></i>
      <h5 class="offcanvas-title font-lora fw-bold" id="offcanvasScrollingLabel">Panel de Gestión</h5>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>

  <div class="offcanvas-body p-0 bg-artisan-soft">
    
    <!-- Sección de Usuario -->
    <div class="user-profile-card p-4 mb-3 border-bottom bg-white text-center shadow-sm">
      <div class="avatar-wrapper mx-auto mb-3 position-relative" style="width: 90px; height: 90px;">
          <!-- Avatar Estándar (El humanito) -->
          <div class="avatar-bg shadow-sm" style="background-color: #f0f2f5; border-radius: 50%; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; border: 2px solid #e0e0e0;">
              <i class="bi bi-person-fill text-secondary" style="font-size: 3.5rem;"></i>
          </div>
          <!-- Indicador de Estado -->
          <div class="status-indicator" style="position: absolute; bottom: 5px; right: 5px; background: #2ecc71; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.1);"></div>
      </div>
      <h5 class="mb-1 fw-bold text-dark"><?= esc($nombre) ?></h5>
      <div class="d-flex justify-content-center mb-3">
          <span class="badge bg-dark rounded-pill px-3 py-1 text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">
            <i class="bi bi-shield-lock me-1"></i> <?= ($perfil == 1) ? 'ADMINISTRADOR' : 'CLIENTE' ?>
          </span>
      </div>
      <a href="<?= base_url('/perfil') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-4 fw-bold">CONFIGURAR PERFIL</a>
    </div>

    <!-- Lista de Opciones -->
    <div class="menu-options-container p-3">
      <?php if ($perfil == 1): ?>
        <p class="text-muted small fw-bold px-3 mb-2 opacity-50">ADMINISTRACIÓN</p>
        <div class="list-group list-group-flush rounded-4 overflow-hidden border shadow-sm">
          <a href="<?= base_url('/alta-producto') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-plus-circle me-3 text-gold fs-5"></i> Añadir Producto
          </a>
          <a href="<?= base_url('/ventas-list') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-receipt-cutoff me-3 text-gold fs-5"></i> Lista de Ventas
          </a>
          <a href="<?= base_url('/crud-usuarios') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-people me-3 text-gold fs-5"></i> Gestión de Usuarios
          </a>
          <a href="<?= base_url('/crud-productos') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-box-seam me-3 text-gold fs-5"></i> Catálogo de Productos
          </a>
          <a href="<?= base_url('/lista-consultas') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-chat-dots me-3 text-gold fs-5"></i> Bandeja de Consultas
          </a>
        </div>

        <p class="text-muted small fw-bold px-3 mt-4 mb-2 opacity-50">MI ACTIVIDAD</p>
        <div class="list-group list-group-flush rounded-4 overflow-hidden border shadow-sm">
          <a href="<?= base_url('/ventas_lista') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-bag-check me-3 text-brown fs-5"></i> Mis Compras
          </a>
        </div>

      <?php elseif ($perfil == 2): ?>
        <div class="list-group list-group-flush rounded-4 overflow-hidden border shadow-sm">
          <?php if (env('SHOPPING_CART_ENABLED')): ?>
          <a href="<?= base_url('/muestro') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-cart3 me-3 text-gold fs-5"></i> Mi Carrito
          </a>
          <?php endif; ?>
          <a href="<?= base_url('/ventas_lista') ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
            <i class="bi bi-bag-check me-3 text-gold fs-5"></i> Mis Compras
          </a>
        </div>
      <?php endif; ?>

      <!-- Botón Cerrar Sesión -->
      <div class="px-3 mt-5 pb-5">
        <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger w-100 py-2 fw-bold rounded-pill shadow-sm d-flex align-items-center justify-content-center">
          <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
        </a>
      </div>
    </div>

  </div>
</div>

<style>
  .bg-artisan-soft { background-color: #fdfaf7; }
  .text-brown { color: #3e2723; }
  .text-gold { color: #b8860b; }
  .font-lora { font-family: 'Lora', serif; }
  
  .list-group-item-action:hover {
    background-color: #fff;
    color: #b8860b;
    padding-left: 1.5rem !important;
    transition: all 0.3s;
  }

  .btn-outline-brown {
    border: 1px solid #3e2723;
    color: #3e2723;
    transition: all 0.3s;
  }
  .btn-outline-brown:hover {
    background-color: #3e2723;
    color: white;
  }
</style>
