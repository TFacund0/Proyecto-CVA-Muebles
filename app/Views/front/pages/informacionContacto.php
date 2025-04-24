<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - CVA Muebles</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/contacto.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/miestilo.css') ?>">
    
</head>
<body>
    
    <?= view('front/navbar') ?>

    <!-- Sección de encabezado de contacto -->
<div class="contact-header titulo-contacto">
    <div class="container">
        <h1>Contacto</h1>
        <p class="lead">Estamos aquí para ayudarte con tus proyectos en madera</p>
    </div>
</div>

<!-- Contenedor principal de contacto -->
<div class="container">
    <!-- Fila con tres tarjetas de contacto: dirección, teléfonos y correos -->
    <div class="row my-3 p-3 contenedor-datos">
        
        <!-- Tarjeta de Dirección -->
        <div class="col-md-4">
            <div class="card contact-card text-center h-100 card-style">
                
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5>Dirección</h5>
                    <p>9 de Julio 1449<br>Mantilla, Corrientes<br>Argentina</p>
                    <a href="https://maps.google.com/?q=9+de+Julio+1449,Mantilla,Corrientes" class="btn btn-sm boton-card">
                        Ver en mapa
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Teléfonos -->
        <div class="col-md-4">
            <div class="card contact-card text-center h-100 card-style">
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5>Teléfonos</h5>
                    <p>+54 9 3794 098511<br>Lunes a Viernes<br>8:00 - 12:00 / 15:00 - 19:00</p>
                    <a href="tel:+5493794098511" class="btn btn-sm boton-card">
                        Llamar ahora
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Correos -->
        <div class="col-md-4">
            <div class="card contact-card text-center h-100 card-style">
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Correo Electrónico</h5>
                    <p>
                        info@cvamuebles.com<br>
                        ventas@cvamuebles.com<br>
                        soporte@cvamuebles.com
                    </p>
                    <a href="mailto:info@cvamuebles.com" class="btn btn-sm boton-card" >
                        Enviar email
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fila con Datos Legales y Formulario de contacto -->
    <div class="row d-flex justify-content-around my-4 py-4 gap-4 px-5 contenedor-datos">
        <!-- Columna de datos legales -->
        <div class="col-lg-5 card-style">
            <div class="mx-3">
                <h4 class="text-center my-3 mb-4 fw-bold">Datos Legales</h4>
                <p><strong>Razón Social:</strong> CVA Muebles S.R.L.</p>
                <p><strong>Titular:</strong> Carlos Vega Acevedo</p>
                <p><strong>CUIT:</strong> 30-12345678-9</p>
                <p><strong>Horario de atención:</strong> Lunes a Viernes de 8:00 a 12:00 y de 15:00 a 19:00</p>
                <p><strong>Días no laborales:</strong> Sábados, Domingos y feriados nacionales</p>
            </div>
        </div>

        <!-- Columna de formulario de contacto -->
        <div class="col-lg-6 card-style  ">
            <div class="contact-form">
                <h4 class="text-center my-3" style="color: var(--color-madera-oscura);">Formulario de Contacto</h4>
                
                <!-- Formulario de contacto -->
                <form action="<?= base_url('contacto/enviar') ?>" method="post">
                    
                    <div class="row">    
                        <!-- Campo Nombre -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                            </div>
                        </div>
                    
                        <!-- Campo Apellido -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                            </div>
                        </div>
                    </div>

                    <!-- Campo Email -->
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="form-group">
                        <input type="tel" class="form-control" name="telefono" placeholder="Teléfono">
                    </div>

                    <!-- Campo Asunto -->
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

                    <!-- Campo Mensaje -->
                    <div class="form-group">
                        <textarea class="form-control" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>

                    <!-- Botón Enviar -->
                    <button type="submit" class="btn btn-contact boton-contacto mb-2">Enviar Mensaje</button>
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