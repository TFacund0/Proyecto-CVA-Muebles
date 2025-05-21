


<div class="login-body d-flex justify-content-center align-items-center m-auto my-5 ">
    <div class="login-container shadow rounded p-4">
        <div class="row">
            <!-- Lado izquierdo -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center text-center p-4">
                <img src="assets/img/iconos/registro.svg"" alt="icono-usuario" style="width: 150px;">
                <h4 class="mt-3">¡Bienvenido de nuevo!</h4>
                <p>Iniciá sesión para acceder a tus beneficios exclusivos</p>
                <a href="<?= base_url('/registro') ?>" class="btn btn-primary mt-2">¿No tenés cuenta? Registrate</a>
            </div>

            <!-- Lado derecho: formulario -->
            <div class="col-md-6 p-4 rounded login-form " style="background-color: rgba(255,255,255,0.9);">
                <h3 class="text-center mb-3">Iniciar sesión</h3>

                <?php if(session()->getFlashdata('msg')): ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>

                <form  method="post" action="<?= base_url('enviar-login') ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Usuario o Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Tu email o usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="pass" placeholder="Tu contraseña" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
