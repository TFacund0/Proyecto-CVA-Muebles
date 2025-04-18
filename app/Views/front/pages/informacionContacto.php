<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - CVA Muebles</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    
</head>
<body>
    
    <?= view('front/navbar') ?>

    <div class="contact-header">
        <div class="container">
            <h1>Contacto</h1>
            <p class="lead">Estamos aquí para ayudarte con tus proyectos en madera</p>
        </div>
    </div>

    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card contact-card text-center h-100">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Dirección</h5>
                        <p>9 de Julio 1449<br>Mantilla, Corrientes<br>Argentina</p>
                        <a href="https://maps.google.com/?q=9+de+Julio+1449,Mantilla,Corrientes" class="btn btn-sm" style="background-color: var(--color-madera-clara);">Ver en mapa</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card text-center h-100">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h5>Teléfonos</h5>
                        <p>+54 9 3794 098511<br>Lunes a Viernes<br>8:00 - 12:00 / 15:00 - 19:00</p>
                        <a href="tel:+5493794098511" class="btn btn-sm" style="background-color: var(--color-madera-clara);">Llamar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card text-center h-100">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Correo Electrónico</h5>
                        <p>info@cvamuebles.com<br>ventas@cvamuebles.com<br>soporte@cvamuebles.com</p>
                        <a href="mailto:info@cvamuebles.com" class="btn btn-sm" style="background-color: var(--color-madera-clara);">Enviar email</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-6">
                <div class="business-info">
                    <h4>Datos Legales</h4>
                    <p><strong>Razón Social:</strong> CVA Muebles S.R.L.</p>
                    <p><strong>Titular:</strong> Carlos Vega Acevedo</p>
                    <p><strong>CUIT:</strong> 30-12345678-9</p>
                    <p><strong>Horario de atención:</strong> Lunes a Viernes de 8:00 a 12:00 y de 15:00 a 19:00</p>
                    <p><strong>Días no laborales:</strong> Sábados, Domingos y feriados nacionales</p>
                </div>
                
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.123456789012!2d-58.987654321!3d-27.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA3JzI0LjQiUyA1OMKwNTknMTUuNiJX!5e0!3m2!1ses!2sar!4v1234567890123!5m2!1ses!2sar" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="contact-form">
                    <h4 class="text-center mb-4" style="color: var(--color-madera-oscura);">Formulario de Contacto</h4>
                    <form action="<?= base_url('contacto/enviar') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="asunto" required>
                                <option value="" disabled selected>Seleccione un asunto</option>
                                <option value="Consulta general">Consulta general</option>
                                <option value="Presupuesto">Solicitud de presupuesto</option>
                                <option value="Estado de pedido">Estado de mi pedido</option>
                                <option value="Garantía">Consulta sobre garantía</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-contact">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= view('front/footer') ?>

    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>