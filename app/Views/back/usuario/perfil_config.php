<?php
    $name = session()->get('nombre');
    $username = session()->get('usuario');
    $surname = session()->get('apellido');
    $email = session()->get('email');
    $profile = session()->get('perfil_id');
    $image = session()->get('imagen');
    $imagePath = $image ? base_url('assets/uploads/perfil/' . $image) : base_url('assets/img/iconos/person.svg');    
?>

<div class="container my-3 px-4 py-5" id="contenedor-config-perfil">
    <div class="px-3">
        <div class="d-flex justify-content-between align-items-center bloque-titulo-perfil m-2 p-3">
            <div class="d-flex">
                <div class="me-4">
                    <!-- Imagen de arriba (principal) -->
                    <img src="<?= $imagePath ?>" alt="foto" class="img-perfil" id="imgPerfilPreviewSuperior">
                </div>
                
                <div class="my-auto">
                    <h4><?php echo $name . ' ' . $surname?></h4>
                    <p class="text-secondary"><?= $email ?></p>
                </div>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('fail')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
            <?php endif; ?>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                <button type="button" class="btn btn-secondary d-none" id="btnCancelar">Cancelar</button>
            </div>
        </div>

        <form class="row mt-4 mx-auto form-perfil me-3" id="formPerfil" method="post" action="<?= base_url('/guardarCambios') ?>" enctype="multipart/form-data">
            <div class="col-lg-9 col-md-12">    
                <div class="col-12 card form-datos-perfil mb-3">
                    <div class="card-body">
                        <h5 class="card-title form-title-perfil mb-3 pb-2">Datos personales</h5>
                    
                        <div class="mb-3 info-perfil">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo $username?>" value="<?php echo $username?>" disabled>
                            <div class="form-text text-muted">Este nombre se usa para iniciar sesión.</div>
                        </div>

                        <div class="mb-3 info-perfil">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" id="nombre" placeholder="<?php echo $name?>" value="<?php echo $name?>" disabled>
                        </div>

                        <div class="mb-3 info-perfil">
                            <label for="Apellido" class="form-label">Apellido</label>
                            <input type="text" name="surname" class="form-control" id="Apellido" placeholder="<?php echo $surname?>" value="<?php echo $surname?>" disabled>
                        </div>

                        <div class="mb-3 info-perfil">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $email?>" value="<?php echo $email?>" disabled>
                            <small class="form-text text-muted">Este correo se usa para iniciar sessión.</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-12 card mb-3">
                <h5 class="card-title form-title-perfil pb-2 my-3">Información</h5>
                
                <div class="text-center info-perfil mb-4">
                    <label class="form-label fw-semibold mb-2" for="perfil">Perfil</label>
                    
                    <div class="border rounded px-3 py-2 bg-light text-secondary" id="perfil" style="font-size: 1rem;">
                        <?= $profile == 1 ? 'Admin' : ($profile == 2 ? 'Cliente' : 'Desconocido') ?>
                    </div>
                    
                    <small class="form-text text-muted mt-2">Describe tu rol dentro del sistema.</small>
                </div>

                <div class="my-auto mb-5">
                    <div class="text-center mb-2">
                        <!-- Imagen de abajo (dentro de tarjeta lateral) -->
                        <div class="mx-auto " style="width: 250px; height: 175px; overflow: hidden;">
                            <img src="<?= $imagePath ?>"
                                alt="foto" 
                                class="img-thumbnail img-fluid" 
                                id="imgPerfilPreviewInferior"
                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                        </div>

                        <!-- Campo para cambiar imagen -->
                        <input class="form-control form-control-sm mt-2" id="formFileSm" name="image" type="file" disabled>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-success d-none w-50 mx-auto" id="btnGuardar">Guardar</button>
        </form>

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

                    btnEditar.classList.remove('d-none');
                    btnGuardar.classList.add('d-none');
                    btnCancelar.classList.add('d-none');
                });

                // ✅ Mostrar imagen en ambas vistas
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
