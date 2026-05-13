<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/contacto.css?v=3.0')?>">
    <style>
        .profile-compact-header {
            padding: 2rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .artisan-card-dynamic {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .artisan-card-dynamic:hover {
            transform: translateY(-3px);
        }
        .card-accent-gold { border-top: 5px solid var(--cva-gold); }
        .card-accent-vivid { border-top: 5px solid var(--cva-vivid); }
        .card-accent-forest { border-top: 5px solid var(--cva-forest); }

        .avatar-circle-edit {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid var(--cva-gold);
            padding: 4px;
            background: white;
            object-fit: cover;
        }
        .bg-dynamic-gradient {
            background: linear-gradient(135deg, var(--cva-forest) 0%, #2a4d44 100%);
            color: white;
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

    $hasImage = !empty($image);
    $imagePath = $hasImage ? base_url('assets/uploads/perfil/' . $image) : '';
?>

<div id="profile-page-wrapper" class="pb-5">
    <!-- Cabecera Compacta con Color -->
    <div class="profile-compact-header" style="background-color: var(--cva-parchment); border-bottom: 2px solid var(--cva-gold);">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white p-2 rounded-circle shadow-sm">
                    <i class="bi bi-person-gear fs-3 text-cva-gold"></i>
                </div>
                <div>
                    <h1 class="h4 mb-0 fw-bold text-cva-brown">Mi Perfil</h1>
                    <p class="x-small text-muted mb-0 text-uppercase fw-bold opacity-75">Configuración de cuenta</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-vivid btn-sm rounded-pill px-4 shadow-sm" id="btnEditar">
                    <i class="bi bi-pencil-square me-2"></i> EDITAR DATOS
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm d-none rounded-pill px-4 shadow-sm" id="btnCancelar">
                    <i class="bi bi-x-lg me-1"></i> CANCELAR
                </button>
            </div>
        </div>
    </div>

    <main class="container">
        <!-- ALERTAS DE SISTEMA -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('fail')): ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('fail') ?>
            </div>
        <?php endif; ?>

        <form id="formPerfil" method="post" action="<?= base_url('/guardarCambios') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4">
                <!-- Columna Usuario -->
                <div class="col-lg-4">
                    <div class="artisan-card-dynamic card-accent-gold h-100 p-4 text-center">
                        <div class="position-relative d-inline-block mb-4">
                            <?php if($hasImage): ?>
                                <img src="<?= $imagePath ?>" alt="Foto" class="avatar-circle-edit shadow" id="mainAvatarPreview" style="width: 150px; height: 150px;">
                            <?php else: ?>
                                <div class="avatar-circle-edit d-flex align-items-center justify-content-center bg-light mx-auto shadow" style="width: 150px; height: 150px;">
                                    <i class="bi bi-person-fill text-muted" style="font-size: 4rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Botón de Foto más Visible -->
                        <div class="mb-4 d-none" id="lblFileContainer">
                            <label for="formFileSm" class="btn btn-outline-gold rounded-pill px-4 fw-bold w-100">
                                <i class="bi bi-camera-fill me-2"></i> SUBIR NUEVA FOTO
                            </label>
                            <input class="form-control d-none" id="formFileSm" name="image" type="file" accept="image/*" disabled>
                        </div>
                        
                        <h4 class="fw-bold mb-1 text-cva-brown"><?= esc($name) . ' ' . esc($surname) ?></h4>
                        <p class="text-muted mb-3">@<?= esc($username) ?></p>
                        
                        <div class="badge bg-light text-cva-brown border px-3 py-2 rounded-pill text-uppercase mb-4" style="font-size: 0.65rem; letter-spacing: 1px;">
                            <i class="bi bi-shield-lock-fill me-1 text-cva-gold"></i> <?= $profile == 1 ? 'ADMINISTRADOR' : 'CLIENTE' ?>
                        </div>

                        <div class="mt-auto pt-3 border-top">
                            <button type="button" class="btn btn-link text-decoration-none text-cva-gold fw-bold small" data-bs-toggle="modal" data-bs-target="#modalPassword">
                                <i class="bi bi-key me-1"></i> Cambiar Contraseña
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Columna Datos -->
                <div class="col-lg-8">
                    <div class="artisan-card-dynamic card-accent-vivid h-100 p-4">
                        <h5 class="fw-bold text-cva-brown mb-4">Información de Contacto</h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted x-small text-uppercase">Nombre</label>
                                <input type="text" name="name" class="form-control artisan-input" value="<?= esc($name) ?>" disabled required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted x-small text-uppercase">Apellido</label>
                                <input type="text" name="surname" class="form-control artisan-input" value="<?= esc($surname) ?>" disabled required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted x-small text-uppercase">Email</label>
                                <input type="email" name="email" class="form-control artisan-input" value="<?= esc($email) ?>" disabled required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted x-small text-uppercase">Usuario</label>
                                <input type="text" name="username" class="form-control artisan-input" value="<?= esc($username) ?>" disabled required>
                            </div>
                        </div>

                        <div class="mt-5 d-none" id="save-container">
                            <button type="submit" class="btn btn-vivid w-100 py-3 fw-bold rounded-pill shadow">
                                <i class="bi bi-save me-2"></i> GUARDAR CAMBIOS
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas Dinámicas (Solo Admin) -->
                <?php if(intval($profile) === 1): ?>
                <div class="col-12">
                    <div class="artisan-card-dynamic bg-dynamic-gradient p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h4 class="fw-bold mb-1">Tu Actividad</h4>
                                <p class="mb-0 opacity-75 small">Resumen de gestión administrativa en tiempo real.</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 text-center border border-white border-opacity-10">
                                            <h2 class="fw-bold mb-0">--</h2>
                                            <p class="x-small text-uppercase mb-0 opacity-75">Productos</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 text-center border border-white border-opacity-10">
                                            <h2 class="fw-bold mb-0">--</h2>
                                            <p class="x-small text-uppercase mb-0 opacity-75">Ventas</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 text-center border border-white border-opacity-10">
                                            <h2 class="fw-bold mb-0">--</h2>
                                            <p class="x-small text-uppercase mb-0 opacity-75">Mensajes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </main>
</div>

<!-- MODAL CONTRASEÑA -->
<div class="modal fade" id="modalPassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white border-0 py-3">
                <h5 class="modal-title fw-bold">Seguridad de la Cuenta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('/cambiarPassword') ?>" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Clave Actual</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Nueva Clave</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Confirmar Nueva Clave</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-vivid w-100 rounded-pill">ACTUALIZAR CONTRASEÑA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnEditar = document.getElementById('btnEditar');
        const saveContainer = document.getElementById('save-container');
        const btnCancelar = document.getElementById('btnCancelar');
        const formInputs = document.querySelectorAll('#formPerfil input');
        const fileInput = document.getElementById('formFileSm');
        const lblFileContainer = document.getElementById('lblFileContainer');
        const mainAvatar = document.getElementById('mainAvatarPreview');

        btnEditar.addEventListener('click', function () {
            formInputs.forEach(input => input.disabled = false);
            btnEditar.classList.add('d-none');
            saveContainer.classList.remove('d-none');
            btnCancelar.classList.remove('d-none');
            if(lblFileContainer) lblFileContainer.classList.remove('d-none');
        });

        btnCancelar.addEventListener('click', function () {
            formInputs.forEach(input => input.disabled = true);
            btnEditar.classList.remove('d-none');
            saveContainer.classList.add('d-none');
            btnCancelar.classList.add('d-none');
            if(lblFileContainer) lblFileContainer.classList.add('d-none');
        });

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => mainAvatar.src = e.target.result;
                reader.readAsDataURL(file);
            }
        });
    });
</script>
<?= $this->endSection() ?>
