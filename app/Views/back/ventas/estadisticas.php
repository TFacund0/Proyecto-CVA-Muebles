<div class="container my-5">
    <h1 class="text-center mb-2" style="color: var(--color-madera-oscura); font-weight: 800; letter-spacing: -1px;">Panel de Control Artesanal</h1>
    <p class="text-center text-muted mb-5">Monitoreo de carga de trabajo y flujo de producción</p>

    <div class="row g-4 text-center">
        <!-- Tarjeta: Pedidos Pendientes -->
        <div class="col-md-3">
            <a href="<?= base_url('ventas-list?estado=PENDIENTE') ?>" class="text-decoration-none">
                <div class="card stat-card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #fff9c4 0%, #fff176 100%);">
                    <div class="card-body py-4">
                        <div class="stat-icon mb-3">⏳</div>
                        <h6 class="text-uppercase fw-bold text-dark mb-3">Pendientes</h6>
                        <h2 class="display-5 fw-bold text-dark"><?= $stats['PENDIENTE'] ?></h2>
                        <small class="text-dark opacity-75">Por iniciar</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta: En Proceso -->
        <div class="col-md-3">
            <a href="<?= base_url('ventas-list?estado=EN_PROCESO') ?>" class="text-decoration-none">
                <div class="card stat-card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #bbdefb 0%, #64b5f6 100%);">
                    <div class="card-body py-4 text-white">
                        <div class="stat-icon mb-3">🔨</div>
                        <h6 class="text-uppercase fw-bold mb-3">En Proceso</h6>
                        <h2 class="display-5 fw-bold"><?= $stats['EN_PROCESO'] ?></h2>
                        <small class="opacity-75">En el taller</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta: Terminados -->
        <div class="col-md-3">
            <a href="<?= base_url('ventas-list?estado=TERMINADO') ?>" class="text-decoration-none">
                <div class="card stat-card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #b2dfdb 0%, #4db6ac 100%);">
                    <div class="card-body py-4 text-white">
                        <div class="stat-icon mb-3">✨</div>
                        <h6 class="text-uppercase fw-bold mb-3">Terminados</h6>
                        <h2 class="display-5 fw-bold"><?= $stats['TERMINADO'] ?></h2>
                        <small class="opacity-75">Listos para entrega</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta: Entregados -->
        <div class="col-md-3">
            <a href="<?= base_url('ventas-list?estado=ENTREGADO') ?>" class="text-decoration-none">
                <div class="card stat-card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #cfd8dc 0%, #90a4ae 100%);">
                    <div class="card-body py-4 text-white">
                        <div class="stat-icon mb-3">🚚</div>
                        <h6 class="text-uppercase fw-bold mb-3">Entregados</h6>
                        <h2 class="display-5 fw-bold"><?= $stats['ENTREGADO'] ?></h2>
                        <small class="opacity-75">Histórico total</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta: Consultas (Inbox) -->
        <div class="col-12">
            <a href="<?= base_url('/consultas') ?>" class="text-decoration-none">
                <div class="card stat-card border-0 shadow-sm" style="background: linear-gradient(135deg, #fce4ec 0%, #f06292 100%);">
                    <div class="card-body py-3 text-white d-flex justify-content-between align-items-center px-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="stat-icon" style="font-size: 2rem;">📬</div>
                            <div class="text-start">
                                <h4 class="mb-0 fw-bold"><?= $total_consultas ?> Consultas Pendientes</h4>
                                <small class="opacity-75">Nuevas oportunidades de venta esperando respuesta</small>
                            </div>
                        </div>
                        <div class="btn btn-light btn-sm fw-bold px-3 py-2" style="color: #f06292; border-radius: 50px;">GESTIONAR INBOX</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="mt-5 text-center d-flex justify-content-center gap-3">
        <a href="<?= base_url('/ventas-list') ?>" class="btn btn-outline-brown px-4 py-2 rounded-pill">
            <i class="bi bi-list-ul me-2"></i>Ver Listado Completo
        </a>
        <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm" style="background-color: var(--color-madera-oscura); border: none;">
            <i class="bi bi-plus-lg me-2"></i>Registrar Pedido Manual
        </a>
    </div>
</div>

<style>
    :root {
        --color-madera-oscura: #5d4037;
    }
    .stat-card {
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        border-radius: 20px;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .stat-icon {
        font-size: 2.5rem;
    }
    .btn-outline-brown {
        color: var(--color-madera-oscura);
        border-color: var(--color-madera-oscura);
        font-weight: 600;
    }
    .btn-outline-brown:hover {
        background-color: var(--color-madera-oscura);
        color: white;
    }
</style>
