<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header py-4 text-center" style="background-color: var(--artisan-dark); color: white;">
                    <h3 class="mb-0">Registrar Pedido Personalizado</h3>
                    <p class="small mb-0 opacity-75">Venta directa por WhatsApp o local</p>
                </div>
                <div class="card-body p-4 p-md-5 bg-artisan-cream">
                    <form action="<?= base_url('ventas/guardar-personalizado') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="row g-4">
                            <!-- Sección: Cliente -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3 text-brown">Información del Cliente</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombre Completo / Referencia</label>
                                    <input type="text" name="nombre_cliente" class="form-control artisan-input" required value="<?= esc($_GET['nombre'] ?? '') ?>" placeholder="Eje: Juan Pérez (3794...)">
                                </div>
                            </div>

                            <!-- Sección: El Mueble -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3 text-brown">Detalles del Trabajo</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Descripción del mueble a medida</label>
                                    <textarea name="detalles_obra" class="form-control artisan-input" rows="4" required placeholder="Eje: Mesa de comedor 2x1mt en madera de paraíso con patas de hierro..."><?= esc($_GET['detalle'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <!-- Sección: Dinero -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3 text-brown">Presupuesto</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Total Acordado ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="total_venta" class="form-control artisan-input" required placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3 text-brown">Pago Inicial</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Monto de Seña ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="monto_sena" class="form-control artisan-input" value="0.00">
                                    </div>
                                    <div class="form-text">Si el cliente ya entregó dinero, cárgalo aquí.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-3 mt-5">
                            <a href="<?= base_url('ventas-list') ?>" class="btn btn-outline-secondary px-4 py-2">Cancelar</a>
                            <button type="submit" class="btn btn-artisan-save px-5 py-2">
                                <i class="bi bi-save me-2"></i> REGISTRAR PEDIDO
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --artisan-dark: #3e2723;
        --artisan-cream: #fdfaf5;
        --artisan-gold: #b8860b;
    }
    .bg-artisan-cream {
        background-color: var(--artisan-cream);
    }
    .text-brown {
        color: var(--artisan-dark);
        font-family: 'Lora', serif;
    }
    .artisan-input {
        border: 1px solid #d7ccc8;
        border-radius: 8px;
        padding: 10px 15px;
    }
    .artisan-input:focus {
        border-color: var(--artisan-gold);
        box-shadow: 0 0 0 0.25rem rgba(184, 134, 11, 0.1);
    }
    .btn-artisan-save {
        background-color: var(--artisan-dark);
        color: white;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-artisan-save:hover {
        background-color: var(--artisan-gold);
        color: white;
        transform: translateY(-2px);
    }
</style>
