<div class="container my-5">
    <h1 class="text-center mb-5" style="color: var(--color-madera-oscura);">Panel de Estadísticas (Artisan Panel)</h1>

    <div class="row g-4 text-center">
        <!-- Tarjeta: Pedidos Pendientes -->
        <div class="col-md-3">
            <div class="card border-warning h-100 shadow-sm">
                <div class="card-header bg-warning text-dark fw-bold">PENDIENTES</div>
                <div class="card-body">
                    <h2 class="display-4 fw-bold"><?= $stats['PENDIENTE'] ?></h2>
                    <p class="text-muted">Pedidos por iniciar</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta: En Proceso -->
        <div class="col-md-3">
            <div class="card border-primary h-100 shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">EN PROCESO</div>
                <div class="card-body">
                    <h2 class="display-4 fw-bold"><?= $stats['EN_PROCESO'] ?></h2>
                    <p class="text-muted">Actualmente en el taller</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Terminados -->
        <div class="col-md-3">
            <div class="card border-info h-100 shadow-sm">
                <div class="card-header bg-info text-white fw-bold">TERMINADOS</div>
                <div class="card-body">
                    <h2 class="display-4 fw-bold"><?= $stats['TERMINADO'] ?></h2>
                    <p class="text-muted">Listos para retiro/entrega</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Entregados -->
        <div class="col-md-3">
            <div class="card border-success h-100 shadow-sm">
                <div class="card-header bg-success text-white fw-bold">ENTREGADOS</div>
                <div class="card-body">
                    <h2 class="display-4 fw-bold"><?= $stats['ENTREGADO'] ?></h2>
                    <p class="text-muted">Histórico de entregas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <a href="<?= base_url('/ventas-list') ?>" class="btn btn-secondary px-4">Volver al Listado de Ventas</a>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
        border-width: 2px;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .display-4 {
        color: var(--color-madera-oscura);
    }
</style>
