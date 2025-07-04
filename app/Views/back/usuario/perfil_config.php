<?php
    // Obtener datos del perfil del usuario desde la sesión
    $name = session()->get('nombre');
    $username = session()->get('usuario');
    $surname = session()->get('apellido');
    $email = session()->get('email');
    $profile = session()->get('perfil_id');
    $image = session()->get('imagen');

    // Determinar la ruta de la imagen de perfil (usar imagen por defecto si no hay personalizada)
    $imagePath = $image ? base_url('assets/uploads/perfil/' . $image) : base_url('assets/img/iconos/person.svg');
?>

<div class="container my-3 px-4 py-5" id="contenedor-config-perfil">
    <div class="px-3">
        <!-- Título y resumen del perfil -->
        <div class="row bloque-titulo-perfil p-3 align-items-center">
            <div class="col-12 col-md-8 d-flex align-items-center mb-3 mb-md-0">
                <!-- Imagen superior del perfil -->
                <div class="me-4">
                    <img src="<?= $imagePath ?>" alt="foto" class="img-perfil" id="imgPerfilPreviewSuperior">
                </div>
                <!-- Información del usuario -->
                <div class="info-usuario">
                    <h4 class="nombre-info-usuario"><?= $name . ' ' . $surname ?></h4>
                    <p class="text-secondary mb-0 email-info-usuario"><?= $email ?></p>
                </div>
            </div>

            <div class="col-12 col-md-4 text-md-end container-fluid">
                <!-- Mensajes de éxito o error -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('fail')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('fail') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Botones de acción -->
                <div class="d-flex gap-2 justify-content-md-end justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                    <button type="button" class="btn btn-secondary d-none" id="btnCancelar">Cancelar</button>
                </div>
            </div>
        </div>

        <!-- Formulario de perfil -->
        <form class="row mt-4 mx-auto form-perfil me-3" id="formPerfil" method="post" action="<?= base_url('/guardarCambios') ?>" enctype="multipart/form-data">
            <!-- Columna principal (datos personales) -->
            <div class="col-lg-9 col-md-12">
                <div class="card form-datos-perfil mb-3">
                    <div class="card-body">
                        <h5 class="card-title form-title-perfil mb-3 pb-2">Datos personales</h5>

                        <!-- Campo: Nombre de usuario -->
                        <div class="mb-3 info-perfil">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="<?= $username ?>" value="<?= $username ?>" disabled>
                            <div class="form-text text-muted">Este nombre se usa para iniciar sesión.</div>
                        </div>

                        <!-- Campo: Nombre -->
                        <div class="mb-3 info-perfil">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" id="nombre" placeholder="<?= $name ?>" value="<?= $name ?>" disabled>
                        </div>

                        <!-- Campo: Apellido -->
                        <div class="mb-3 info-perfil">
                            <label for="Apellido" class="form-label">Apellido</label>
                            <input type="text" name="surname" class="form-control" id="Apellido" placeholder="<?= $surname ?>" value="<?= $surname ?>" disabled>
                        </div>

                        <!-- Campo: Email -->
                        <div class="mb-3 info-perfil">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="<?= $email ?>" value="<?= $email ?>" disabled>
                            <small class="form-text text-muted">Este correo se usa para iniciar sesión.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna lateral (perfil y foto) -->
            <div class="col-lg-3 col-md-12 card mb-3">
                <h5 class="card-title form-title-perfil pb-2 my-3">Información</h5>

                <!-- Campo: Perfil de usuario -->
                <div class="text-center info-perfil mb-4">
                    <label class="form-label fw-semibold mb-2" for="perfil">Perfil</label>
                    <div class="border rounded px-3 py-2 bg-light text-secondary" id="perfil" style="font-size: 1rem;">
                        <?= $profile == 1 ? 'Admin' : ($profile == 2 ? 'Cliente' : 'Desconocido') ?>
                    </div>
                    <small class="form-text text-muted mt-2">Describe tu rol dentro del sistema.</small>
                </div>

                <!-- Imagen inferior del perfil y carga de nueva imagen -->
                <div class="my-auto mb-5 text-center">
                    <div class="mx-auto" style="width: 100%; max-width: 250px; height: 175px; overflow: hidden; background-color: #f0f0f0;">
                        <img src="<?= $imagePath ?>" alt="foto" class="img-thumbnail img-fluid"
                            id="imgPerfilPreviewInferior"
                            style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                    </div>
                    <!-- Selector de archivo para cambiar imagen -->
                    <input class="form-control form-control-sm mt-2" id="formFileSm" name="image" type="file" disabled>
                </div>
            </div>

            <!-- Botón de guardar (solo visible en modo edición) -->
            <div class="text-center">
                <button type="submit" class="btn btn-success d-none w-50" id="btnGuardar">Guardar</button>
            </div>
        </form>

        <!-- Script de interacciones (modo edición, imagen, etc.) -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btnEditar = document.getElementById('btnEditar');
                const btnGuardar = document.getElementById('btnGuardar');
                const btnCancelar = document.getElementById('btnCancelar');
                const formInputs = document.querySelectorAll('#formPerfil input');
                const fileInput = document.getElementById('formFileSm');
                const imgPreviewSuperior = document.getElementById('imgPerfilPreviewSuperior');
                const imgPreviewInferior = document.getElementById('imgPerfilPreviewInferior');

                btnEditar.addEventListener('click', function () {
                    formInputs.forEach(input => {
                        input.disabled = false;
                        input.readOnly = false;
                    });
                    btnEditar.classList.add('d-none');
                    btnGuardar.classList.remove('d-none');
                    btnCancelar.classList.remove('d-none');
                });

                btnCancelar.addEventListener('click', function () {
                    formInputs.forEach(input => {
                        input.disabled = true;
                        input.readOnly = true;
                    });
                    fileInput.value = "";
                    btnEditar.classList.remove('d-none');
                    btnGuardar.classList.add('d-none');
                    btnCancelar.classList.add('d-none');
                });

                fileInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imgPreviewSuperior.src = e.target.result;
                            imgPreviewInferior.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    </div>
</div>