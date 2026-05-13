<aside class="admin-sidebar">
    <div class="sidebar-header">
        <a href="<?= base_url('/admin-dashboard') ?>" class="sidebar-logo">
            <i class="bi bi-hammer text-gold"></i>
            <span>CVA ADMIN</span>
        </a>
    </div>
    
    <nav class="sidebar-nav">
        <!-- Dashboard Principal -->
        <a href="<?= base_url('/admin-dashboard') ?>" class="nav-item-admin <?= (current_url() == base_url('/admin-dashboard') || current_url() == base_url('/admin-stats')) ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <div class="px-4 mt-4 mb-2 small text-uppercase opacity-50 fw-bold" style="letter-spacing: 1px; font-size: 0.7rem;">Gestión de Catálogo</div>
        
        <a href="<?= base_url('/crud-productos') ?>" class="nav-item-admin <?= (current_url() == base_url('/crud-productos')) ? 'active' : '' ?>">
            <i class="bi bi-box-seam"></i>
            <span>Productos</span>
        </a>
        
        <a href="<?= base_url('/alta-producto') ?>" class="nav-item-admin <?= (current_url() == base_url('/alta-producto')) ? 'active' : '' ?>">
            <i class="bi bi-plus-circle"></i>
            <span>Nuevo Producto</span>
        </a>

        <div class="px-4 mt-4 mb-2 small text-uppercase opacity-50 fw-bold" style="letter-spacing: 1px; font-size: 0.7rem;">Gestión de Usuarios</div>

        <a href="<?= base_url('/crud-usuarios') ?>" class="nav-item-admin <?= (current_url() == base_url('/crud-usuarios')) ? 'active' : '' ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
        </a>

        <div class="px-4 mt-4 mb-2 small text-uppercase opacity-50 fw-bold" style="letter-spacing: 1px; font-size: 0.7rem;">Ventas y Consultas</div>

        <a href="<?= base_url('/ventas-list') ?>" class="nav-item-admin <?= (current_url() == base_url('/ventas-list')) ? 'active' : '' ?>">
            <i class="bi bi-receipt-cutoff"></i>
            <span>Control de Ventas</span>
        </a>

        <a href="<?= base_url('/consultas') ?>" class="nav-item-admin <?= (current_url() == base_url('/consultas') || current_url() == base_url('/lista-consultas')) ? 'active' : '' ?>">
            <i class="bi bi-chat-dots"></i>
            <span>Consultas</span>
        </a>


        <div class="px-4 mt-auto pt-5">
            <a href="<?= base_url('/') ?>" class="btn btn-outline-light btn-sm w-100 rounded-pill opacity-75">
                <i class="bi bi-house-door me-2"></i> VER SITIO
            </a>
        </div>
    </nav>
</aside>
