<!-- Contenedor principal del formulario de registro -->
<div class="registro-contenedor container m-auto my-5 "> 
    
    <!-- Título de bienvenida -->
    <h2 class="text-center mb-2 pb-1 titulo-registro">¡Bienvenido! Comienza tu experiencia con nosotros</h2>

    <!-- Carga del servicio de validación de CodeIgniter -->
    <?php $validation = \Config\Services::validation(); ?>
    
    <!-- Fila principal que divide el contenido en dos columnas -->
    <div class="row info-registro my-4">
        
        <!-- Columna izquierda: información motivacional -->
        <div class="col-lg-6 col-sm-12 pb-1">
            <div class="m-auto p-1">
                <div class="text-center">
                    <!-- Imagen ilustrativa del registro -->
                    <img src="assets/img/iconos/registro.svg" class="img-fluid img-registro" alt="">
                    <h4 class="my-3">¡Crea tu cuenta y forma parte!</h4>
                </div>

                <!-- Lista de beneficios -->
                <ul>
                    <li>Registrate para acceder a beneficios exclusivos</li>
                    <li>Accedé a todos nuestros servicios</li>
                </ul>
            </div>

            <!-- Botón a sección de más información -->
            <div class="text-center">
                <a class="btn btn-primary" href="<?php echo base_url('/informacionContacto')?>">Más información</a>
            </div>
        </div>

        <!-- Columna derecha: formulario de registro -->
        <div class="col-lg-6 col-sm-10">

            <!-- Inicio del formulario: método POST y acción al controlador correspondiente -->
            <form class="registro-form m-auto me-2" method="post" action="<?php echo base_url('/enviar-form') ?>">

                <!-- Título del formulario -->
                <h4 class="text-center">Formulario de Registro</h4>

                <!-- Campo de nombre de usuario -->
                <div class="form-floating mb-3">
                    <input type="text" class="campo-registro form-control" id="nombreUser" name="user" placeholder="Nombre de Usuario" required>
                    <label for="nombreUser">Nombre de Usuario</label>

                    <!-- Validación del servidor para el campo "user" -->
                    <?php if($validation->getError('user')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?php echo $validation->getError('user') ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Fila para nombre y apellido -->
                <div class="row mb-3">
                    <div class="col-6">
                        <!-- Campo de nombre -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre" name="name" placeholder="Nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>

                        <!-- Validación del campo "name" -->
                        <?php if($validation->getError('name')) { ?>
                            <div class="alert alert-danger mt-2">
                                <?php echo $validation->getError('name') ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-6">
                        <!-- Campo de apellido -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="apellido" name="surname" placeholder="Apellido" required>
                            <label for="apellido">Apellido</label>
                        </div>

                        <!-- Validación del campo "surname" -->
                        <?php if($validation->getError('surname')) { ?>
                            <div class="alert alert-danger mt-2">
                                <?php echo $validation->getError('surname') ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Campo de correo electrónico -->
                <div class="mb-3">
                    <div class="form-floating">
                        <input class="campo-registro form-control" type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                        <label for="email">Correo Electrónico</label>
                    </div>

                    <!-- Validación del campo "email" -->
                    <?php if($validation->getError('email')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?php echo $validation->getError('email') ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Campo de contraseña -->
                <div class="mb-3">
                    <div class="form-floating">
                        <input class="campo-registro form-control" type="password" id="password" name="pass" placeholder="Contraseña" aria-describedby="passwordHelpBlock" required>
                        <label for="password">Contraseña</label>

                        <!-- Texto de ayuda para la contraseña -->
                        <div id="passwordHelpBlock" class="form-text">
                            Debe ser de 3 a 50 caracteres de largo
                        </div>
                    </div>

                    <!-- Validación del campo "pass" -->
                    <?php if($validation->getError('pass')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?php echo $validation->getError('pass') ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Casilla de verificación de Términos y Condiciones -->
                <div class="mb-3 form-check check-registro">
                    <input type="checkbox" class="form-check-input" id="check" name="terms">
                    <label class="form-check-label" for="check">
                        Estas de acuerdo con los 
                        <a href="<?php echo base_url('/terminosYCondiciones')?>" target="_blank">Términos y Condiciones</a>
                    </label>
                </div>

                <!-- Botón de envío del formulario -->
                <input class="btn btn-primary w-100 m-auto d-block boton-enviar-registro" type="submit" value="Registrarse">
            </form>
        </div>
    </div>

    <!-- Enlace para volver al login -->
    <div class="m-1 text-center volver-registro">
        <a href="<?php echo base_url('/login')?>">Volver</a>
    </div>
</div>
