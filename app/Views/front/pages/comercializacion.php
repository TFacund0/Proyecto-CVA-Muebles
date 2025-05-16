<!-- Sección de encabezado -->
<header class="comercializacion-header titulo-comercializacion">
    <h1>Comercialización</h1>
    <p class="lead">Cómo adquirir nuestros muebles artesanales</p>
</header>

<!-- Contenedor principal -->
<section class="container" id="container-comercializacion">

    <!-- Introducción -->
    <div class="row my-3 p-3 contenedor-seccion">
        <div class="col-lg-8 mx-auto text-center">
            <p class="intro-text">
                En CVA Muebles nos esforzamos por hacer que la adquisición de nuestros productos
                sea tan placentera como su uso. Aquí encontrarás toda la información necesaria para realizar tu compra.
            </p>
        </div>
    </div>

    <!-- Sección de métodos de pago y envíos -->
    <div class="row my-3 p-3 contenedor-seccion g-4">

        <!-- Formas de pago -->
        <div class="col-md-6">
            <div class="card-style h-100 p-4">
                <h3 class="text-center mb-4 subtitulo-comercializacion">Formas de Pago</h3>
                <p class="text-center mb-4">Aceptamos diversas formas de pago para tu comodidad:</p>

                <div class="row g-3">
                    <!-- Pago en efectivo -->
                    <div class="col-md-6">
                        <div class="card-style text-center p-3 h-100">
                            <img src="assets/img/iconos/cash.svg" alt="Efectivo" class="icon-comercializacion">
                            <h5 class="mt-3 subtitulo-comercializacion">Efectivo</h5>
                            <p>Pago en nuestro taller o contra entrega</p>
                        </div>
                    </div>

                    <!-- Pago con tarjeta -->
                    <div class="col-md-6">
                        <div class="card-style text-center p-3 h-100">
                            <img src="assets/img/iconos/credit-card.svg" alt="Tarjetas" class="icon-comercializacion">
                            <h5 class="mt-3 subtitulo-comercializacion">Tarjetas</h5>
                            <p>Visa, MasterCard y American Express (hasta 12 cuotas)</p>
                        </div>
                    </div>

                    <!-- Pago por transferencia -->
                    <div class="col-md-6">
                        <div class="card-style text-center p-3 h-100">
                            <img src="assets/img/iconos/paypal.svg" alt="Transferencia" class="icon-comercializacion">
                            <h5 class="mt-3 subtitulo-comercializacion">Transferencia</h5>
                            <p>Bancaria o por Mercado Pago</p>
                        </div>
                    </div>

                    <!-- Financiamiento -->
                    <div class="col-md-6">
                        <div class="card-style text-center p-3 h-100">
                            <img src="assets/img/iconos/wallet.svg" alt="Financiación" class="icon-comercializacion">
                            <h5 class="mt-3 subtitulo-comercializacion">Financiación</h5>
                            <p>Planes especiales para pedidos mayores a $500.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Envíos y entregas -->
        <div class="col-md-6">
            <div class="card-style h-100 p-4">
                <h3 class="text-center mb-4 subtitulo-comercializacion">Envíos y Entregas</h3>
                <p class="text-center mb-4">Realizamos envíos a todo la provincia con los siguientes tiempos estimados:</p>

                <div class="pasos-envio">
                    <!-- Fase 1: Fabricación -->
                    <div class="card-style p-3 mb-3">
                        <h5 class="fw-bold">1. Proceso de Fabricación</h5>
                        <p>De 15 a 30 días hábiles según complejidad del mueble</p>
                    </div>

                    <!-- Fase 2: Embalaje -->
                    <div class="card-style p-3 mb-3">
                        <h5 class="fw-bold">2. Preparación para Envío</h5>
                        <p>3 días hábiles para embalaje especializado</p>
                    </div>

                    <!-- Fase 3: Tiempo de tránsito -->
                    <div class="card-style p-3">
                        <h5 class="fw-bold">3. Tiempo de Tránsito</h5>
                        <ul class="ps-3">
                            <li>Localidades cercanas: 1-3 días</li>
                            <li>Corrientes y otras localidades: 5-15 días</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de cobertura de envíos y opción de retiro -->
    <div class="row my-3 p-3 contenedor-seccion g-4">

        <!-- Cobertura de envíos nacionales e internacionales -->
        <div class="col-md-6">
            <div class="card-style h-100 p-4">
                <h3 class="text-center mb-4 subtitulo-comercializacion">Cobertura de Envíos</h3>
                <p>Envíos seguros en toda la provincia de Corrientes.
                Nos especializamos en llevar tus muebles con cuidado y dedicación a cada rincón de la provincia. Utilizamos transporte especializado para garantizar que cada pieza llegue en perfecto estado, tal como salió de nuestro taller.</p>

                <!-- Botón para consultas de envíos -->
                <div class="text-center mt-4">
                    <a href="<?= base_url('informacionContacto')?>" class="btn boton-comercializacion text-dark">Consultas envio y costo</a>
                </div>
            </div>
        </div>

        <!-- Retiro en taller para clientes locales -->
        <div class="col-md-6">
            <div class="card-style h-100 p-4">
                <h3 class="text-center mb-4 subtitulo-comercializacion">Retiro en Taller</h3>
                <p class="text-center mb-4">Si resides en Corrientes o alrededores, puedes coordinar el retiro directo en nuestro taller:</p>

                <ul class="ps-3 mb-4">
                    <li>Horario de atención: Lunes a Viernes de 8:00 a 12:00 y de 15:00 a 19:00</li>
                    <li>Dirección: 9 de Julio 1449, Mantilla, Corrientes</li>
                    <li>Se recomienda coordinar previamente para preparar tu pedido</li>
                </ul>

                <!-- Botón para coordinar retiro -->
                <div class="text-center">
                    <a href="<?= base_url('informacionContacto')?>" class="btn boton-comercializacion text-dark">Coordinar retiro</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Garantía y soporte postventa -->
    <div class="row my-3 p-3 contenedor-seccion">
        <div class="col-12">
            <div class="card-style p-4 text-center">
                <h3 class="mb-4 subtitulo-comercializacion">Garantía y Soporte</h3>
                <p class="mb-4 mx-auto" style="max-width: 800px;">
                    Todos nuestros productos cuentan con garantía de 1 año por defectos de fabricación.
                    Para reclamos o consultas postventa, contamos con un equipo especializado que te acompañará durante todo el proceso.
                </p>

                <!-- Botón para ver términos de garantía -->
                <a href="<?= base_url('terminosYCondiciones') ?>" class="btn boton-comercializacion text-dark">Ver términos de garantía completos</a>
            </div>
        </div>
    </div>
</section>
