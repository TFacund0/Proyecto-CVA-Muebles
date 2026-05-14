<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <style>
        :root {
            --auth-bg: #f8f5f0;
            --auth-card-shadow: 0 25px 50px -12px rgba(62, 39, 35, 0.15);
        }

        .auth-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--auth-bg);
        }

        .auth-card {
            background: white;
            width: 100%;
            max-width: 1000px;
            border-radius: 2rem;
            box-shadow: var(--auth-card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            border: 1px solid rgba(0,0,0,0.02);
        }

        /* Lado de Imagen/Branding */
        .auth-side-branding {
            flex: 1;
            background: linear-gradient(rgba(62, 39, 35, 0.8), rgba(62, 39, 35, 0.8)), 
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

        .auth-side-branding::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.1;
            pointer-events: none;
        }

        .auth-logo-circle {
            width: 80px;
            height: 80px;
            background: var(--cva-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            color: #1a0f0d;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .auth-quote {
            font-family: 'Lora', serif;
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            color: var(--cva-gold);
        }

        /* Lado de Formulario */
        .auth-side-form {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .auth-header {
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-weight: 800;
            color: var(--cva-brown);
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: #9c8e7e;
            font-weight: 600;
        }

        .artisan-input-group {
            margin-bottom: 1.5rem;
        }

        .artisan-input-group label {
            display: block;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #a08d7c;
            letter-spacing: 1px;
            margin-bottom: 0.6rem;
        }

        .artisan-control {
            width: 100%;
            border: 2px solid #eeebe6;
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
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
            margin-top: 1rem;
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

        @media (max-width: 991px) {
            .auth-wrapper { padding: 1rem; }
            .auth-card { flex-direction: column; max-width: 600px; border-radius: 1.5rem; }
            .auth-side-branding { padding: 2.5rem 2rem; min-height: 200px; text-align: center; align-items: center; }
            .auth-quote { font-size: 1.4rem; margin-bottom: 0.5rem; }
            .auth-side-branding p { font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
            .auth-side-form { padding: 2.5rem 2rem; }
            .auth-header { margin-bottom: 1.5rem; }
            .auth-header h2 { font-size: 1.5rem; }
        }

        @media (max-width: 480px) {
            .auth-wrapper { padding: 0.5rem; }
            .auth-card { border-radius: 1rem; }
            .auth-side-branding { padding: 2rem 1.5rem; min-height: 180px; }
            .auth-side-form { padding: 2rem 1.5rem; }
            .artisan-control { padding: 0.8rem 1rem; font-size: 0.9rem; }
            .btn-auth-primary { padding: 0.8rem; }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Branding Side -->
        <div class="auth-side-branding">
            <div class="auth-logo-circle">
                <i class="bi bi-hammer"></i>
            </div>
            <h1 class="auth-quote">La excelencia artesanal en cada detalle.</h1>
            <p class="opacity-75">Bienvenido al portal exclusivo de CVA Muebles. Gestiona tus pedidos y descubre piezas únicas diseñadas para durar toda la vida.</p>
        </div>

        <!-- Form Side -->
        <div class="auth-side-form">
            <div class="auth-header text-center text-lg-start">
                <h2>Iniciar Sesión</h2>
                <p>Ingresa tus credenciales para continuar.</p>
            </div>

            <!-- Mensajes de Estado Modularizados -->
            <?= view('components/alert_message') ?>

            <form method="post" action="<?= base_url('enviar-login') ?>">
                <?= csrf_field(); ?>
                
                <div class="artisan-input-group">
                    <label for="email">Usuario o Email</label>
                    <input type="text" class="artisan-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Ingresa tu usuario" required autofocus>
                </div>

                <div class="artisan-input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="artisan-control" id="password" name="pass" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-door-open-fill me-2"></i> Ingresar al Portal
                </button>
            </form>

            <div class="auth-footer">
                ¿Aún no eres parte? <a href="<?= base_url('/registro') ?>">Crea tu cuenta aquí</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
