<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <style>
        :root {
            --auth-bg: #f8f5f0;
            --auth-card-shadow: 0 25px 50px -12px rgba(62, 39, 35, 0.15);
        }

        .auth-wrapper {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            background: var(--auth-bg);
        }

        .auth-card {
            background: white;
            width: 100%;
            max-width: 1100px;
            border-radius: 2rem;
            box-shadow: var(--auth-card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            border: 1px solid rgba(0,0,0,0.02);
        }

        /* Branding Side */
        .auth-side-branding {
            flex: 1;
            background: linear-gradient(rgba(62, 39, 35, 0.85), rgba(62, 39, 35, 0.85)), 
                        url('<?= base_url('assets/img/branding/wood-texture.jpg') ?>');
            background-size: cover;
            background-position: center;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
        }

        .auth-logo-circle {
            width: 70px;
            height: 70px;
            background: var(--cva-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            color: #1a0f0d;
        }

        .auth-quote {
            font-family: 'Lora', serif;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 2rem;
            color: var(--cva-gold);
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 1.2rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .benefit-item i {
            color: var(--cva-gold);
            font-size: 1.2rem;
        }

        /* Form Side */
        .auth-side-form {
            flex: 1.2;
            padding: 4rem;
            background: #fff;
            max-height: 90vh;
            overflow-y: auto;
        }

        .auth-header {
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-weight: 800;
            color: var(--cva-brown);
            margin-bottom: 0.5rem;
        }

        .artisan-input-group {
            margin-bottom: 1.2rem;
        }

        .artisan-label {
            display: block;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            color: #a08d7c;
            letter-spacing: 1.2px;
            margin-bottom: 0.5rem;
        }

        .artisan-control {
            width: 100%;
            border: 2px solid #eeebe6;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-weight: 600;
            color: var(--cva-brown);
            transition: all 0.3s ease;
        }

        .artisan-control:focus {
            border-color: var(--cva-gold);
            outline: none;
            box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.1);
        }

        .btn-auth-primary {
            background: var(--cva-brown);
            color: var(--cva-gold);
            border: none;
            border-radius: 50px;
            padding: 1rem;
            font-weight: 800;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-auth-primary:hover {
            background: #1a0f0d;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #9c8e7e;
        }

        .auth-footer a {
            color: var(--cva-brown);
            font-weight: 700;
            text-decoration: none;
            border-bottom: 2px solid var(--cva-gold);
        }

        /* Custom Checkbox */
        .artisan-check {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: #7d6b5d;
            margin-top: 1.5rem;
        }

        .artisan-check input {
            width: 18px;
            height: 18px;
            accent-color: var(--cva-brown);
        }

        @media (max-width: 991px) {
            .auth-wrapper { padding: 1.5rem 1rem; }
            .auth-card { flex-direction: column; max-width: 600px; border-radius: 1.5rem; }
            .auth-side-branding { padding: 2.5rem 2rem; min-height: 250px; text-align: center; align-items: center; }
            .auth-quote { font-size: 1.5rem; margin-bottom: 1rem; }
            .auth-side-branding .mt-4 { display: none; } /* Ocultar beneficios en móvil para ganar espacio */
            .auth-side-branding .mt-auto { padding-top: 1.5rem !important; }
            .auth-side-form { padding: 2.5rem 2rem; }
            .auth-header { margin-bottom: 1.5rem; }
            .auth-header h2 { font-size: 1.6rem; }
        }

        @media (max-width: 480px) {
            .auth-wrapper { padding: 0.5rem; }
            .auth-card { border-radius: 1rem; }
            .auth-side-branding { padding: 2rem 1.5rem; min-height: 180px; }
            .auth-side-form { padding: 2rem 1.5rem; }
            .artisan-control { padding: 0.8rem 1rem; font-size: 0.9rem; }
            .btn-auth-primary { padding: 0.8rem; margin-top: 1rem; }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $validation = \Config\Services::validation(); ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Branding Side -->
        <div class="auth-side-branding">
            <div class="auth-logo-circle">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h1 class="auth-quote">Únete a la comunidad de CVA Muebles.</h1>
            
            <div class="mt-4">
                <div class="benefit-item">
                    <i class="bi bi-patch-check-fill"></i>
                    <span>Acceso a lanzamientos exclusivos y piezas limitadas.</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-patch-check-fill"></i>
                    <span>Seguimiento detallado de tus pedidos artesanales.</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-patch-check-fill"></i>
                    <span>Gestión personalizada de tus obras a medida.</span>
                </div>
            </div>

            <div class="mt-auto pt-5">
                <a href="<?= base_url('/informacionContacto') ?>" class="btn btn-outline-light rounded-pill px-4 btn-sm fw-bold">
                    CONOCE NUESTRA HISTORIA
                </a>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-side-form">
            <div class="auth-header">
                <h2>Crear Cuenta</h2>
                <p class="text-muted">Completa tus datos para formar parte de la familia.</p>
            </div>

            <!-- Mensajes de Estado Modularizados -->
            <?= view('components/alert_message') ?>

            <form method="post" action="<?= base_url('/enviar-form') ?>">
                <?= csrf_field(); ?>
                
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="artisan-input-group">
                            <label>Nombre de Usuario</label>
                            <input type="text" class="artisan-control" name="user" value="<?= old('user') ?>" placeholder="Ej: artesano_maestro" required>
                            <?php if($validation->getError('user')): ?>
                                <div class="text-danger x-small mt-1 fw-bold"><?= $validation->getError('user') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="artisan-input-group">
                            <label>Nombre</label>
                            <input type="text" class="artisan-control" name="name" value="<?= old('name') ?>" placeholder="Tu nombre" required>
                            <?php if($validation->getError('name')): ?>
                                <div class="text-danger x-small mt-1 fw-bold"><?= $validation->getError('name') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="artisan-input-group">
                            <label>Apellido</label>
                            <input type="text" class="artisan-control" name="surname" value="<?= old('surname') ?>" placeholder="Tu apellido" required>
                            <?php if($validation->getError('surname')): ?>
                                <div class="text-danger x-small mt-1 fw-bold"><?= $validation->getError('surname') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="artisan-input-group">
                            <label>Email</label>
                            <input type="email" class="artisan-control" name="email" value="<?= old('email') ?>" placeholder="correo@ejemplo.com" required>
                            <?php if($validation->getError('email')): ?>
                                <div class="text-danger x-small mt-1 fw-bold"><?= $validation->getError('email') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="artisan-input-group">
                            <label>Contraseña</label>
                            <input type="password" class="artisan-control" name="pass" placeholder="Mínimo 3 caracteres" required>
                            <?php if($validation->getError('pass')): ?>
                                <div class="text-danger x-small mt-1 fw-bold"><?= $validation->getError('pass') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="artisan-check">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Acepto los <a href="<?= base_url('/terminosYCondiciones') ?>" class="fw-bold text-cva-brown" target="_blank">Términos y Condiciones</a></label>
                </div>

                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-check-lg me-2"></i> Finalizar Registro
                </button>
            </form>

            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="<?= base_url('/login') ?>">Inicia sesión aquí</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
