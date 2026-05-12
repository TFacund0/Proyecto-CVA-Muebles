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
    </div>

    <div class="mt-5 text-center">
        <a href="<?= base_url('/ventas-list') ?>" class="btn btn-outline-brown px-4 py-2 rounded-pill">
            <i class="bi bi-list-ul me-2"></i>Ver Listado Completo
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
