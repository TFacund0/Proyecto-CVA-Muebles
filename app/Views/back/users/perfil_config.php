<!-- 
  =============================================
  ARTISAN PROFILE DASHBOARD - FINAL POLISH
  =============================================
-->

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

<div class="profile-config-wrapper py-4">
    <div class="container">
        
        <!-- ALERTAS PREMIUM REDISEÑADAS -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert premium-alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-circle bg-success text-white me-3">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div>
                        <strong class="d-block">¡Operación Exitosa!</strong>
                        <span class="small opacity-75"><?= session()->getFlashdata('success') ?></span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('fail')): ?>
            <div class="alert premium-alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-circle bg-danger text-white me-3">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div>
                        <strong class="d-block">Ha ocurrido un error</strong>
                        <span class="small opacity-75"><?= session()->getFlashdata('fail') ?></span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Cabecera de Identidad Suavizada -->
        <div class="profile-header p-4 text-white rounded-4 shadow mb-4" style="background: linear-gradient(135deg, #3e2723 0%, #4e342e 100%); position: relative; overflow: hidden;">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-md-8 d-flex align-items-center gap-3 flex-wrap flex-md-nowrap justify-content-center justify-content-md-start">
                    <div class="avatar-frame shadow-sm" style="width: 100px; height: 100px; border-radius: 50%; border: 3px solid rgba(184, 134, 11, 0.5); background: white; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <?php if($hasImage): ?>
                            <img src="<?= $imagePath ?>" alt="Foto de perfil" id="imgPerfilPreviewSuperior" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <div id="default-avatar-superior" class="text-muted">
                                <i class="bi bi-person-fill" style="font-size: 3.5rem; opacity: 0.5;"></i>
                            </div>
                            <img src="" id="imgPerfilPreviewSuperior" class="d-none" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                    </div>
                    <div class="text-center text-md-start">
                        <h2 class="h3 fw-bold font-lora mb-1"><?= esc($name) . ' ' . esc($surname) ?></h2>
                        <p class="opacity-75 mb-2 small"><i class="bi bi-envelope me-2 text-gold"></i><?= esc($email) ?></p>
                        <span class="badge rounded-pill px-3 py-1 text-uppercase" style="background: rgba(184, 134, 11, 0.8); font-size: 0.65rem; letter-spacing: 1px;">
                            <i class="bi bi-shield-lock-fill me-1"></i> <?= $profile == 1 ? 'ADMINISTRADOR' : 'CLIENTE' ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0 d-flex justify-content-center justify-content-md-end gap-2">
                    <button type="button" class="btn btn-gold-artisan btn-sm rounded-pill px-4 fw-bold shadow-sm" id="btnEditar">
                        <i class="bi bi-pencil-square me-1"></i> Editar Datos
                    </button>
                    <button type="button" class="btn btn-outline-light btn-sm rounded-pill px-4 fw-bold d-none" id="btnCancelar">
                        <i class="bi bi-x-circle me-1"></i> Descartar
                    </button>
                </div>
            </div>
        </div>

        <form id="formPerfil" method="post" action="<?= base_url('/guardarCambios') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4 align-items-stretch">
                <!-- COLUMNA IZQUIERDA: DATOS -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="card-header bg-artisan-soft border-0 py-3 px-4">
                            <h6 class="fw-bold text-brown mb-0 small">
                                <i class="bi bi-person-lines-fill me-2 text-gold"></i> INFORMACIÓN PERSONAL
                            </h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label x-small fw-bold text-muted text-uppercase">Nombre</label>
                                    <input type="text" name="name" class="form-control artisan-input-soft" 
                                           value="<?= esc($name) ?>" disabled required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small fw-bold text-muted text-uppercase">Apellido</label>
                                    <input type="text" name="surname" class="form-control artisan-input-soft" 
                                           value="<?= esc($surname) ?>" disabled required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small fw-bold text-muted text-uppercase">Usuario</label>
                                    <input type="text" name="username" class="form-control artisan-input-soft" 
                                           value="<?= esc($username) ?>" disabled required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small fw-bold text-muted text-uppercase">Email</label>
                                    <input type="email" name="email" class="form-control artisan-input-soft" 
                                           value="<?= esc($email) ?>" disabled required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: FOTO -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white h-100">
                        <div class="card-header bg-artisan-soft border-0 py-3 text-center">
                            <h6 class="mb-0 fw-bold text-brown small">FOTO DE PERFIL</h6>
                        </div>
                        <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                            <div class="mx-auto mb-3 p-1 shadow-sm" style="width: 140px; height: 140px; border-radius: 15px; border: 1px solid #eee; display: flex; align-items: center; justify-content: center; background: #fff;">
                                <?php if($hasImage): ?>
                                    <img src="<?= $imagePath ?>" alt="foto" class="rounded-3 img-fluid" id="imgPerfilPreviewInferior" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div id="default-avatar-inferior" class="text-muted opacity-25">
                                        <i class="bi bi-person-fill" style="font-size: 5rem;"></i>
                                    </div>
                                    <img src="" id="imgPerfilPreviewInferior" class="rounded-3 img-fluid d-none" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php endif; ?>
                            </div>

                            <label for="formFileSm" class="btn btn-outline-brown btn-sm rounded-pill px-3 mb-2 d-none shadow-sm mx-auto" id="lblFile">
                                <i class="bi bi-camera me-1"></i> Cambiar imagen
                            </label>
                            <input class="form-control d-none" id="formFileSm" name="image" type="file" accept="image/*" disabled>
                            
                            <p class="x-small text-muted mb-0">Imagen recomendada: JPG/PNG cuadrada.</p>
                        </div>
                    </div>
                </div>

                <!-- BOTÓN DE GUARDAR INTEGRADO -->
                <div class="col-12 d-none mb-4" id="save-container">
                    <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-4 shadow-sm">
                        <i class="bi bi-check2-circle me-2"></i> GUARDAR CAMBIOS DE PERFIL
                    </button>
                </div>
            </div>
        </form>

        <!-- SECCIÓN: SEGURIDAD Y ESTADÍSTICAS (DINÁMICA) -->
        <div class="row g-4 mt-2">
            <!-- Seguridad (Ancho dinámico según perfil) -->
            <div class="<?= $profile == 1 ? 'col-md-5' : 'col-12' ?>">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-brown mb-4 small"><i class="bi bi-shield-lock me-2 text-gold"></i> SEGURIDAD DE LA CUENTA</h6>
                        <div class="d-flex align-items-center justify-content-between p-3 bg-artisan-soft rounded-3 mb-3 border">
                            <div>
                                <p class="mb-0 fw-bold small">Contraseña</p>
                                <p class="mb-0 x-small text-muted">Gestión de clave de acceso</p>
                            </div>
                            <button type="button" class="btn btn-sm btn-artisan-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalPassword">Actualizar Clave</button>
                        </div>
                        <p class="x-small text-muted mb-0"><i class="bi bi-info-circle me-1"></i> Te recomendamos cambiar tu clave periódicamente para mantener tu cuenta segura.</p>
                    </div>
                </div>
            </div>

            <!-- Resumen de Gestión (SOLO PARA ADMINISTRADORES) -->
            <?php if(intval($profile) === 1): ?>
            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-brown mb-4 small"><i class="bi bi-graph-up-arrow me-2 text-gold"></i> RESUMEN DE GESTIÓN</h6>
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="p-2 text-center rounded-3 border bg-artisan-soft h-100">
                                    <i class="bi bi-box-seam text-gold fs-5 mb-1 d-block"></i>
                                    <span class="d-block fw-bold mb-0">--</span>
                                    <span class="x-small text-muted text-uppercase">Productos</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 text-center rounded-3 border bg-artisan-soft h-100">
                                    <i class="bi bi-cart-check text-success fs-5 mb-1 d-block"></i>
                                    <span class="d-block fw-bold mb-0">--</span>
                                    <span class="x-small text-muted text-uppercase">Ventas</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 text-center rounded-3 border bg-artisan-soft h-100">
                                    <i class="bi bi-people text-primary fs-5 mb-1 d-block"></i>
                                    <span class="d-block fw-bold mb-0">--</span>
                                    <span class="x-small text-muted text-uppercase">Clientes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5 opacity-50">
            <p class="x-small text-brown fw-bold mb-0">CVA MUEBLES - ARTISAN MANAGEMENT PLATFORM</p>
            <p class="x-small">Mueblería de Autor - 2026</p>
        </div>
    </div>
</div>

<!-- MODAL PARA CAMBIAR CONTRASEÑA -->
<div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-artisan-dark text-white rounded-top-4 py-3">
                <h5 class="modal-title font-lora small fw-bold"><i class="bi bi-key me-2"></i> ACTUALIZAR CONTRASEÑA</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/cambiarPassword') ?>" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">CONTRASEÑA ACTUAL</label>
                        <input type="password" name="current_password" class="form-control artisan-input-soft" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">NUEVA CONTRASEÑA</label>
                        <input type="password" name="new_password" class="form-control artisan-input-soft" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">CONFIRMAR NUEVA CONTRASEÑA</label>
                        <input type="password" name="confirm_password" class="form-control artisan-input-soft" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 btn-sm fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-artisan-dark rounded-pill px-4 btn-sm fw-bold">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&family=Lora:wght@700&display=swap');

    :root {
        --artisan-dark: #3e2723;
        --artisan-gold: #b8860b;
        --artisan-soft: #fcfaf7;
    }

    .profile-config-wrapper { background-color: #f8f5f0; font-family: 'Outfit', sans-serif; min-height: 100vh; }
    .font-lora { font-family: 'Lora', serif; }
    .bg-artisan-soft { background-color: var(--artisan-soft); }
    .bg-artisan-dark { background-color: var(--artisan-dark); }
    .text-brown { color: var(--artisan-dark); }
    .text-gold { color: var(--artisan-gold); }
    .x-small { font-size: 0.75rem; letter-spacing: 0.5px; }

    /* Alertas Premium */
    .premium-alert { border-radius: 15px !important; padding: 1rem 1.5rem !important; position: relative; }
    .alert-icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .btn-close-custom { position: absolute !important; top: 50% !important; right: 15px !important; transform: translateY(-50%) !important; padding: 0.5rem !important; opacity: 0.5; transition: opacity 0.3s; }
    .btn-close-custom:hover { opacity: 1; }

    .artisan-input-soft { 
        height: 42px; 
        border-radius: 8px;
        border: 1px solid #e0d5c5;
        font-size: 0.95rem;
        background-color: #ffffff;
    }
    
    .btn-gold-artisan { background-color: var(--artisan-gold); color: white; border: none; transition: all 0.3s; }
    .btn-gold-artisan:hover { background-color: #9c7b0a; color: white; transform: translateY(-1px); }

    .btn-artisan-dark { background-color: var(--artisan-dark); color: white; border: none; transition: all 0.3s; }
    .btn-artisan-dark:hover { background-color: #2b1b17; color: white; transform: translateY(-1px); }

    .btn-outline-brown {
        border: 1px solid #d7ccc8;
        color: #5d4037;
        font-size: 0.85rem;
    }
    .btn-outline-brown:hover {
        background-color: #5d4037;
        color: white;
    }

    input:disabled {
        background-color: #fcfcfc !important;
        border-color: #eee !important;
        color: #999 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnEditar = document.getElementById('btnEditar');
        const saveContainer = document.getElementById('save-container');
        const btnCancelar = document.getElementById('btnCancelar');
        const formInputs = document.querySelectorAll('#formPerfil input');
        const fileInput = document.getElementById('formFileSm');
        const lblFile = document.getElementById('lblFile');
        const imgPreviewSuperior = document.getElementById('imgPerfilPreviewSuperior');
        const imgPreviewInferior = document.getElementById('imgPerfilPreviewInferior');
        const defaultAvatarSuperior = document.getElementById('default-avatar-superior');
        const defaultAvatarInferior = document.getElementById('default-avatar-inferior');

        btnEditar.addEventListener('click', function () {
            formInputs.forEach(input => {
                input.disabled = false;
            });
            btnEditar.classList.add('d-none');
            saveContainer.classList.remove('d-none');
            btnCancelar.classList.remove('d-none');
            lblFile.classList.remove('d-none');
        });

        btnCancelar.addEventListener('click', function () {
            formInputs.forEach(input => {
                input.disabled = true;
            });
            fileInput.value = "";
            btnEditar.classList.remove('d-none');
            saveContainer.classList.add('d-none');
            btnCancelar.classList.add('d-none');
            lblFile.classList.add('d-none');
        });

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imgPreviewSuperior.src = e.target.result;
                    imgPreviewInferior.src = e.target.result;
                    
                    imgPreviewSuperior.classList.remove('d-none');
                    imgPreviewInferior.classList.remove('d-none');
                    
                    if(defaultAvatarSuperior) defaultAvatarSuperior.classList.add('d-none');
                    if(defaultAvatarInferior) defaultAvatarInferior.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
