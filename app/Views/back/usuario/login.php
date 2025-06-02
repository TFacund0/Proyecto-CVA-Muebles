<!-- Contenedor general del login -->
<div class="login-body d-flex justify-content-center align-items-center m-auto my-5">
    
    <!-- Contenedor interno con bordes redondeados y padding -->
    <div class="login-container rounded p-5">
        <div class="row">
            
            <!-- Lado izquierdo: Bienvenida e invitación a registrarse -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center text-center p-4">
                <!-- Icono de usuario -->
                <img src="assets/img/iconos/registro.svg" alt="icono-usuario" style="width: 150px;">
                
                <!-- Mensaje de bienvenida -->
                <h4 class="mt-3">¡Bienvenido de nuevo!</h4>
                <p>Iniciá sesión para acceder a tus beneficios exclusivos</p>
                
                <!-- Botón para registrarse si no tiene cuenta -->
                <a href="<?= base_url('/registro') ?>" class="btn btn-primary mt-2">
                    ¿No tenés cuenta? Registrate
                </a>
            </div>

            <!-- Lado derecho: formulario de login -->
            <div class="col-md-6 p-4 rounded login-form" style="background-color: rgba(255,255,255,0.9);">
                
                <!-- Título del formulario -->
                <h3 class="text-center mb-3">Iniciar sesión</h3>

                <!-- Campo oculto para protección CSRF (CodeIgniter) -->
                <?= csrf_field(); ?>

                <!-- Alerta si hubo error en el login -->
                <?php if (!empty(session()->getFlashdata('fallo_login'))) { ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fallo_login'); ?>
                    </div>
                <?php } ?>

                <!-- Formulario de inicio de sesión -->
                <form method="post" action="<?= base_url('enviar-login') ?>">
                    
                    <!-- Campo para email o usuario -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Usuario o Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Tu email o usuario" required>
                    </div>
                    
                    <!-- Campo para contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="pass" placeholder="Tu contraseña" required>
                    </div>
                    
                    <!-- Botón para ingresar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>

                        <!-- Redirección si ya hay sesión activa -->
                        <?php if (isset($_SESSION['usuario'])) { ?>
                            <?php redirect()->to('/'); ?>
                        <?php } ?>
                    </div>

                    <!-- Enlace para recuperación de contraseña -->
                    <div class="mt-3 text-center">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
