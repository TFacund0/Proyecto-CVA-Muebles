<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/contacto.css?v=7.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="container-contacto-wrapper">
    <!-- Cabecera Premium (FONDO FIJO) -->
    <header class="contact-header">
        <div class="container animate-fade-in">
            <span class="text-gold fw-bold text-uppercase x-small" style="letter-spacing: 3px;">Atención Personalizada</span>
            <h1 class="display-3 fw-bold font-lora">Contacto</h1>
            <div class="divider-artisan mx-auto mb-4"></div>
            <p class="lead">Estamos aquí para ayudarte a dar vida a tus proyectos en madera noble.</p>
        </div>
    </header>

    <!-- BLOQUE 1: DATOS DE CONTACTO (ARENA) -->
    <section class="section-contact-data py-5" style="background-color: var(--cva-sand);">
        <div class="container py-5">
            <!-- Título de Sección Agregado -->
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <span class="text-vivid fw-bold text-uppercase small" style="letter-spacing: 2px;">Vías Directas</span>
                    <h2 class="display-4 fw-bold font-lora text-cva-brown mt-2">Nuestros Canales</h2>
                    <div class="divider-artisan mx-auto"></div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Dirección -->
                <div class="col-md-4">
                    <div class="artisan-contact-card">
                        <div class="icon-contact-wrapper"><i class="bi bi-geo-alt"></i></div>
                        <h4 class="font-lora fw-bold">Dirección</h4>
                        <p class="text-muted mb-4">9 de Julio 1449<br>Mantilla, Corrientes</p>
                        <a href="https://maps.google.com/?q=9+de+Julio+1449,Mantilla,Corrientes" target="_blank" class="btn btn-premium-action">
                            <span>COMO LLEGAR</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Teléfonos -->
                <div class="col-md-4">
                    <div class="artisan-contact-card">
                        <div class="icon-contact-wrapper"><i class="bi bi-whatsapp"></i></div>
                        <h4 class="font-lora fw-bold">WhatsApp</h4>
                        <p class="text-muted mb-4">+54 9 3794 098511<br>Atención Inmediata</p>
                        <a href="https://wa.me/5493794098511" target="_blank" class="btn btn-premium-action w-whatsapp">
                            <span>HABLAR AHORA</span>
                            <i class="bi bi-chat-dots"></i>
                        </a>
                    </div>
                </div>
                <!-- Email -->
                <div class="col-md-4">
                    <div class="artisan-contact-card">
                        <div class="icon-contact-wrapper"><i class="bi bi-envelope-at"></i></div>
                        <h4 class="font-lora fw-bold">Email</h4>
                        <p class="text-muted mb-4">info@cvamuebles.com<br>ventas@cvamuebles.com</p>
                        <a href="mailto:info@cvamuebles.com" class="btn btn-premium-action w-email">
                            <span>ENVIAR CORREO</span>
                            <i class="bi bi-send"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOQUE 2: FORMULARIO Y LEGAL (BLANCO) -->
    <section class="section-form-contacto py-5 bg-white">
        <div class="container py-5">
            <!-- Título de Sección Solicitado -->
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <span class="text-vivid fw-bold text-uppercase small" style="letter-spacing: 2px;">Consultas</span>
                    <h2 class="display-4 fw-bold font-lora text-cva-brown mt-2">Canales de Atención</h2>
                    <div class="divider-artisan mx-auto"></div>
                </div>
            </div>

            <div class="row g-5 align-items-stretch">
                <!-- Info Institucional (REDiseño) -->
                <div class="col-lg-5">
                    <div class="institutional-box-premium p-4 p-xl-5 rounded-5 h-100 d-flex flex-column">
                        <span class="text-gold fw-bold text-uppercase x-small" style="letter-spacing: 3px;">CVA Muebles</span>
                        <h2 class="font-lora h1 fw-bold text-white mt-2 mb-4">Nuestra Identidad</h2>
                        
                        <div class="legal-item-premium mb-3">
                            <label>Razón Social</label>
                            <p>CVA Muebles S.R.L.</p>
                        </div>
                        <div class="legal-item-premium mb-3">
                            <label>Titular Responsable</label>
                            <p>Acevedo Cesar Victor</p>
                        </div>
                        <div class="legal-item-premium mb-4">
                            <label>Identificación Tributaria</label>
                            <p>CUIT 30-12345678-9</p>
                        </div>

                        <div class="horarios-premium-card p-4 rounded-4 bg-white shadow-sm mb-4">
                            <h6 class="fw-bold text-cva-brown mb-3 text-uppercase small">Horarios de Taller</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Lunes a Viernes</span>
                                <span class="fw-bold text-cva-brown">08:00 - 19:00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center opacity-50">
                                <span class="text-muted small">Sábados y Domingos</span>
                                <span class="fw-bold">Cerrado</span>
                            </div>
                        </div>

                        <div class="artisan-seal-quote mt-auto">
                            <i class="bi bi-quote h1 text-gold opacity-25"></i>
                            <p class="fst-italic text-white opacity-75 small">"La madera es un material vivo; responder a cada consulta es para nosotros el primer paso para darle una nueva forma."</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario (RECUADRO REDONDEADO) -->
                <div class="col-lg-7">
                    <div class="artisan-form-container-box h-100 p-4 p-xl-5">
                        <h3 class="font-lora h2 fw-bold mb-5 text-center text-cva-brown">Escribinos tu Consulta</h3>
                        <form action="<?= base_url('/enviar-consulta') ?>" method="post" class="row g-4">
                            <?= csrf_field() ?>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <input type="tel" class="form-control" name="telefono" placeholder="Teléfono" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <select class="form-select form-control" name="asunto" required>
                                    <option value="" disabled selected>Seleccioná un motivo</option>
                                    <option value="Presupuesto">Presupuesto para Mueble</option>
                                    <option value="Pedido">Consulta sobre mi Pedido</option>
                                    <option value="Garantia">Garantía y Soporte</option>
                                    <option value="Otro">Otros motivos</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="descripcion" rows="6" placeholder="¿Cómo podemos ayudarte hoy?" required></textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-vivid-premium w-100 py-3 rounded-pill">
                                    <span>ENVIAR CONSULTA</span>
                                    <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<?= $this->endSection() ?>
