<body>
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
                <p class="intro-text">En CVA Muebles nos esforzamos por hacer que la adquisición de nuestros productos sea tan placentera como su uso. Aquí encontrarás toda la información necesaria para realizar tu compra.</p>
            </div>
        </div>

        <!-- Sección de métodos de pago y envíos -->
        <div class="row my-3 p-3 contenedor-seccion g-4">
            <!-- Métodos de pago -->
            <div class="col-md-6">
                <div class="card-style h-100 p-4">
                    <h3 class="text-center mb-4 subtitulo-comercializacion">Formas de Pago</h3>
                    <p class="text-center mb-4">Aceptamos diversas formas de pago para tu comodidad:</p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card-style text-center p-3 h-100">
                                <img src="assets/img/iconos/cash.svg" alt="Efectivo" class="icon-comercializacion">
                                <h5 class="mt-3">Efectivo</h5>
                                <p>Pago en nuestro taller o contra entrega (solo Corrientes)</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-style text-center p-3 h-100">
                                <img src="assets/img/iconos/credit-card.svg" alt="Targetas" class="icon-comercializacion">
                                <h5 class="mt-3">Tarjetas</h5>
                                <p>Visa, MasterCard y American Express (hasta 12 cuotas)</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-style text-center p-3 h-100">
                                <img src="assets/img/iconos/paypal.svg" alt="Transferencia" class="icon-comercializacion">
                                <h5 class="mt-3">Transferencia</h5>
                                <p>Bancaria o por Mercado Pago</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-style text-center p-3 h-100">
                                <img src="assets/img/iconos/wallet.svg" alt="Financiacion" class="icon-comercializacion">
                                <h5 class="mt-3">Financiación</h5>
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
                    <p class="text-center mb-4">Realizamos envíos a todo el país con los siguientes tiempos estimados:</p>
                    
                    <div class="pasos-envio">
                        <div class="card-style p-3 mb-3">
                            <h5 class="fw-bold">1. Proceso de Fabricación</h5>
                            <p>De 15 a 30 días hábiles según complejidad del mueble</p>
                        </div>
                        <div class="card-style p-3 mb-3">
                            <h5 class="fw-bold">2. Preparación para Envío</h5>
                            <p>3 días hábiles para embalaje especializado</p>
                        </div>
                        <div class="card-style p-3">
                            <h5 class="fw-bold">3. Tiempo de Tránsito</h5>
                            <ul class="ps-3">
                                <li>Corrientes y alrededores: 1-3 días</li>
                                <li>Resto del país: 5-10 días</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de cobertura y retiro -->
        <div class="row my-3 p-3 contenedor-seccion g-4">
            <!-- Cobertura -->
            <div class="col-md-6">
                <div class="card-style h-100 p-4">
                    <h3 class="text-center mb-4 subtitulo-comercializacion">Cobertura de Envíos</h3>
                    <ul class="ps-3 mb-4">
                        <li>Llegamos a cada rincón de Argentina a traves de trasportes especiales para garantizar que tus muebles lleguen en perfecto estado, sin importar la distancia</li>
                        <li>Para clientes fuera de Argentina ofrecemos: Uruguay, Paraguay y Chile: Envíos marítimos o terrestres con tiempos de 2-4 semanas.</li>
                        <li>Mercosur ampliado: Consultar por logística aérea:</li>
                    </ul>
                    
                    <div class="text-center">
                        <a href="<?= base_url('informacionContacto')?>" class="btn boton-comercializacion">Consultas envio y costo</a>
                    </div>
                </div>
            </div>
            
            <!-- Retiro en taller -->
            <div class="col-md-6">
                <div class="card-style h-100 p-4">
                    <h3 class="text-center mb-4 subtitulo-comercializacion">Retiro en Taller</h3>
                    <p class="text-center mb-4">Si resides en Corrientes o alrededores, puedes coordinar el retiro directo en nuestro taller:</p>
                    
                    <ul class="ps-3 mb-4">
                        <li>Horario de atención: Lunes a Viernes de 8:00 a 12:00 y de 15:00 a 19:00</li>
                        <li>Dirección: 9 de Julio 1449, Mantilla, Corrientes</li>
                        <li>Se recomienda coordinar previamente para preparar tu pedido</li>
                    </ul>
                    
                    <div class="text-center">
                        
                        <a href="<?= base_url('informacionContacto')?>" class="btn boton-comercializacion">Coordinar retiro</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Garantía -->
        <div class="row my-3 p-3 contenedor-seccion">
            <div class="col-12">
                <div class="card-style p-4 text-center">
                    <h3 class="mb-4 subtitulo-comercializacion">Garantía y Soporte</h3>
                    <p class="mb-4 mx-auto" style="max-width: 800px;">Todos nuestros productos cuentan con garantía de 1 año por defectos de fabricación. Para reclamos o consultas postventa, contamos con un equipo especializado que te acompañará durante todo el proceso.</p>
                    
                    <a href="<?= base_url('terminosYCondiciones') ?>" class="btn boton-comercializacion">Ver términos de garantía completos</a>
                </div>
            </div>
        </div>
    </section>
</body>