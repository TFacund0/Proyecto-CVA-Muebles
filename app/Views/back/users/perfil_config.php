<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <style>
        .profile-container-v3 {
            max-width: 1000px;
            margin: 40px auto;
        }
        
        .profile-main-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 15px 45px rgba(62, 39, 35, 0.12);
            border: 2px solid #eeebe6;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            min-height: 600px;
        }

        /* Columna de Resumen (Izquierda) */
        .profile-sidebar-summary {
            width: 350px;
            background: #fdfaf7;
            border-right: 1px solid #f0e6d6;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .avatar-circle-v3 {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--cva-gold);
            padding: 6px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .avatar-circle-v3 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .avatar-placeholder-v3 {
            width: 100%;
            height: 100%;
            background: #eeebe6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #a08d7c;
            border-radius: 50%;
        }

        .badge-role-v3 {
            background: var(--cva-brown);
            color: var(--cva-gold);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 1px;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            margin-bottom: 2rem;
        }

        .profile-nav-links {
            width: 100%;
            margin-top: auto;
        }

        .profile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            color: #7d6b5d;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .profile-nav-link:hover {
            background: white;
            color: var(--cva-brown);
            transform: translateX(5px);
        }

        .profile-nav-link.text-danger:hover {
            background: #fff5f5;
            color: #dc3545;
        }

        /* Columna de Formulario (Derecha) */
        .profile-form-content {
            flex: 1;
            padding: 4rem;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--cva-brown);
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-section-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: #f0e6d6;
        }

        .artisan-label-v3 {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #a08d7c;
            letter-spacing: 1px;
            margin-bottom: 0.6rem;
            display: block;
        }

        .artisan-control-v3 {
            border: 2px solid #eeebe6;
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            font-weight: 600;
            color: var(--cva-brown);
            transition: all 0.3s ease;
            background: white;
        }

        .artisan-control-v3:focus {
            border-color: var(--cva-gold);
            box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.1);
            outline: none;
        }

        .artisan-control-v3:disabled {
            background-color: #fcfbf9;
            border-color: transparent;
            color: #9c8e7e;
        }

        .btn-artisan-v3 {
            background: var(--cva-gold);
            color: #1a0f0d;
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 800;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(184, 134, 11, 0.15);
        }

        .btn-artisan-v3:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(184, 134, 11, 0.2);
            background: #c99310;
        }

        @media (max-width: 991px) {
            .profile-container-v3 { margin: 0; padding: 0; max-width: 100%; }
            .profile-main-card { flex-direction: column; border-radius: 0; border: none; }
            .profile-sidebar-summary { 
                width: 100%; 
                border-right: none; 
                border-bottom: 1px solid #f0e6d6; 
                padding: 3rem 1.5rem 2rem;
            }
            .avatar-circle-v3 { width: 130px; height: 130px; }
            .profile-sidebar-summary h3 { font-size: 1.5rem; }
            
            .profile-form-content { padding: 2.5rem 1.5rem; }
            .profile-form-content h2 { font-size: 1.6rem !important; }
            
            .artisan-label-v3 { font-size: 0.65rem; }
            .artisan-control-v3 { padding: 0.8rem 1rem; font-size: 0.9rem; }
            
            .btn-artisan-v3 { width: 100%; padding: 1rem; }
            .btnGroup .d-flex { flex-direction: column; gap: 10px !important; }
            #cancelEdit { width: 100%; }
        }

        @media (max-width: 575px) {
            .profile-sidebar-summary { padding: 2rem 1.5rem 1.5rem; }
            .avatar-circle-v3 { width: 110px; height: 110px; }
            .form-section-title { font-size: 1.2rem; }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $name = session()->get('nombre');
    $username = session()->get('usuario');
    $surname = session()->get('apellido');
    $email = session()->get('email');
    $profile = session()->get('perfil_id');
    $image = session()->get('imagen');
?>

<div class="container profile-container-v3">
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 text-center py-3">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="profile-main-card">
        <!-- Parte Izquierda: Perfil y Navegación -->
        <aside class="profile-sidebar-summary">
            <div class="avatar-circle-v3">
                <?php if (!empty($image)): ?>
                    <img src="<?= base_url('assets/uploads/perfil/' . $image) ?>" alt="Perfil" id="previewImg">
                <?php else: ?>
                    <div class="avatar-placeholder-v3">
                        <i class="bi bi-person-fill"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <h3 class="fw-bold text-cva-brown mb-1"><?= esc($name) . ' ' . esc($surname) ?></h3>
            <p class="text-muted small mb-3">@<?= esc($username) ?></p>
            
            <span class="badge-role-v3">
                <i class="bi bi-shield-check me-1"></i> <?= ($profile == 1) ? 'ADMINISTRADOR' : 'CLIENTE CVA' ?>
            </span>

            <div class="profile-nav-links">
                <a href="#" class="profile-nav-link" data-bs-toggle="modal" data-bs-target="#modalPassword">
                    <i class="bi bi-key-fill text-gold"></i> Cambiar Contraseña
                </a>
                <?php if($profile == 1): ?>
                    <a href="<?= base_url('/admin-dashboard') ?>" class="profile-nav-link">
                        <i class="bi bi-speedometer2 text-gold"></i> Ir al Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('/ventas_lista') ?>" class="profile-nav-link">
                        <i class="bi bi-bag-check text-gold"></i> Mis Pedidos
                    </a>
                <?php endif; ?>
                <hr class="my-4 opacity-50">
                <a href="<?= base_url('/logout') ?>" class="profile-nav-link text-danger">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
            </div>
        </aside>

        <!-- Parte Derecha: Formulario de Edición -->
        <main class="profile-form-content">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="h3 fw-bold text-cva-brown mb-0">Configuración</h2>
                <button type="button" class="btn btn-outline-brown rounded-pill px-4 fw-bold small" id="toggleEdit">
                    <i class="bi bi-pencil-square me-2"></i> EDITAR DATOS
                </button>
            </div>

            <form id="formPerfil" method="post" action="<?= base_url('/guardarCambios') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="artisan-label-v3">Nombre</label>
                        <input type="text" name="name" class="form-control artisan-control-v3" value="<?= esc($name) ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="artisan-label-v3">Apellido</label>
                        <input type="text" name="surname" class="form-control artisan-control-v3" value="<?= esc($surname) ?>" disabled required>
                    </div>
                    <div class="col-md-12">
                        <label class="artisan-label-v3">Dirección de Email</label>
                        <input type="email" name="email" class="form-control artisan-control-v3" value="<?= esc($email) ?>" disabled required>
                    </div>
                    <div class="col-md-12">
                        <label class="artisan-label-v3">Nombre de Usuario</label>
                        <input type="text" name="username" class="form-control artisan-control-v3" value="<?= esc($username) ?>" disabled required>
                    </div>
                    
                    <div class="col-md-12 d-none" id="fileGroup">
                        <label class="artisan-label-v3">Actualizar Foto de Perfil</label>
                        <input type="file" name="image" class="form-control artisan-control-v3" accept="image/*">
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top d-none" id="btnGroup">
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-artisan-v3 flex-grow-1">
                            GUARDAR CAMBIOS
                        </button>
                        <button type="button" id="cancelEdit" class="btn btn-light rounded-pill px-5 fw-bold border">
                            CANCELAR
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<!-- MODAL CONTRASEÑA -->
<div class="modal fade" id="modalPassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="modal-header bg-cva-brown text-white border-0 py-4">
                <h5 class="modal-title fw-bold mb-0">Cambiar Contraseña</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('/cambiarPassword') ?>" method="post">
                <div class="modal-body p-5">
                    <div class="mb-4">
                        <label class="artisan-label-v3">Contraseña Actual</label>
                        <input type="password" name="current_password" class="form-control artisan-control-v3" required>
                    </div>
                    <div class="mb-4">
                        <label class="artisan-label-v3">Nueva Contraseña</label>
                        <input type="password" name="new_password" class="form-control artisan-control-v3" required>
                    </div>
                    <div class="mb-0">
                        <label class="artisan-label-v3">Confirmar Nueva Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control artisan-control-v3" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-artisan-v3 w-100 py-3">
                        ACTUALIZAR CLAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleEdit = document.getElementById('toggleEdit');
        const cancelEdit = document.getElementById('cancelEdit');
        const btnGroup = document.getElementById('btnGroup');
        const fileGroup = document.getElementById('fileGroup');
        const inputs = document.querySelectorAll('.artisan-control-v3');

        toggleEdit.addEventListener('click', () => {
            inputs.forEach(input => input.disabled = false);
            btnGroup.classList.remove('d-none');
            fileGroup.classList.remove('d-none');
            toggleEdit.classList.add('d-none');
        });

        cancelEdit.addEventListener('click', () => {
            inputs.forEach(input => input.disabled = true);
            btnGroup.classList.add('d-none');
            fileGroup.classList.add('d-none');
            toggleEdit.classList.remove('d-none');
        });
    });
</script>
<?= $this->endSection() ?>
