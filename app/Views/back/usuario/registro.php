<div class="registro-contenedor container m-auto my-5"> 
    
    <h2 class="text-center mb-4 pb-3 titulo-registro">¡Bienvenido! Comienza tu experiencia con nosotros</h2>

    <?php $validation = \Config\Services::validation(); ?>
    
    <div class="row info-registro py-3">
        <div class="col-lg-6 col-sm-12 mb-4">
            <div class="m-auto p-2">
                <div class="text-center">
                    <img src="assets/img/iconos/registro.svg" class="img-fluid img-registro" alt="">
                    <h4 class="my-3">¡Crea tu cuenta y forma parte!</h4>
                </div>

                <ul>
                    <li>Al registrarte podrás guardar tus datos y acceder a beneficios exclusivos</li>
                    <li>Accedé a todos nuestros servicios</li>
                </ul>
            </div>
            <div class="text-center">
                <a class="btn btn-primary" href="<?php echo base_url('/informacionContacto')?>">Más información</a>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
        <form class="registro-form m-auto me-3" method="post" action="<?php echo base_url('/enviar-form') ?>">

            <h4 class="text-center mb-3">Formulario de Registro</h4>

            <?= csrf_field(); ?>
            <?php if (!empty(session()->getFlashdata('fail'))) {?>
                <div class="alert alert-danger"><?=session()->getFlashdata('fail'); ?></div>
            <?php }?>

            <?php if (!empty(session()->getFlashdata('success'))) {?>
                <div class="alert alert-danger"><?=session()->getFlashdata('success'); ?></div>
            <?php }?>
            
            <div class="form-floating mb-3">
                <!-- Campo para el nombre de usuario del formulario -->
                <input type="text" class="campo-registro form-control" id="nombreUser" name="user" placeholder="Nombre de Usuario" required>
                <label for="nombreUser">Nombre de Usuario</label>
    
                <!-- Validacion del campo nombre de usuario(Lado Servidor) -->
                <?php if($validation->getError('user')) {?>
                    <div class="alert alert-danger mt-2">
                        <?php $error = $validation->getError('user'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-floating">
                        <!-- Campo para el nombre del formulario -->
                        <input type="text" class="form-control" id="nombre" name="name" placeholder="Nombre" required>
                        <label for="nombre">Nombre</label>
                    </div>

                    <!-- Validacion del campo nombre (Lado Servidor) -->
                    <?php if($validation->getError('name')) {?>
                        <div class="alert alert-danger mt-2">
                            <?php $error = $validation->getError('name'); ?>
                        </div>
                    <?php }?>
                </div>

                <div class="col-6">
                    <div class="form-floating">
                        <!-- Campo para el apellido del formulario -->
                        <input type="text" class="form-control" id="apellido" name="surname" placeholder="Apellido" required>
                        <label for="apellido">Apellido</label>
                    </div>    
                    <!-- Validacion del campo apellido (Lado Servidor) -->
                    <?php if($validation->getError('surname')) {?>
                        <div class="alert alert-danger mt-2">
                            <?php $error = $validation->getError('surname'); ?>
                        </div>
                    <?php }?>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <!-- Campo para el correo del formulario -->
                    <input class="campo-registro form-control" type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                    <label for="email">Correo Electrónico</label>
                </div>  

                <!-- Validacion del campo correo (Lado Servidor) -->
                <?php if($validation->getError('email')) {?>
                    <div class="alert alert-danger mt-2">
                        <?php $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
            </div>
            
            <div class="mb-3">
                <!-- Campo para la contraseña del formulario -->
                <div class="form-floating">
                    <input class="campo-registro form-control" type="password" id="password" name="pass" placeholder="Contraseña" aria-describedby="passwordHelpBlock"  required>
                    <label for="password">Password</label>
                    
                    <div id="passwordHelpBlock" class="form-text">
                        Debe ser de 3 a 50 caracteres de largo
                    </div>    
                </div>

                <!-- Validacion del campo contraseña (Lado Servidor) -->
                <?php if($validation->getError('pass')) {?>
                    <div class="alert alert-danger mt-2">
                        <?php $error = $validation->getError('pass'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="mb-3 form-check check-registro">
                <input type="checkbox" class="form-check-input" id="check">
                <label class="form-check-label" for="check">Estas de acuerdo con los <a href="<?php echo base_url('/terminosYCondiciones')?>" target="_blank">Terminos y Condiciones</a></label>
            </div>
                    
            <input class="btn btn-primary w-100 m-auto d-block boton-enviar-registro" type="submit" value="Registrarse">
        </form>
        </div>
    </div>

    <div class="m-3 text-center volver-registro">
        <a href="<?php echo base_url('/login')?>">Volver</a>
    </div>
</div>