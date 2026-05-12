<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Cabecera con Color Madera Noble -->
        <div class="card-header py-4 text-white" style="background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);">
            <div class="row align-items-center px-3">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold font-lora"><i class="bi bi-receipt-cutoff me-2"></i> Listado de Ventas</h2>
                    <p class="small mb-0 opacity-75">Control de producción y facturación artesanal</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('ventas/nuevo-personalizado') ?>" class="btn btn-gold-artisan py-2 px-4 shadow-sm fw-bold">
                        <i class="bi bi-plus-lg me-2"></i> REGISTRAR PEDIDO MANUAL
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-4 bg-artisan-soft">
            <!-- Filtros con Estilo -->
            <form method="get" action="<?= base_url('/ventas-list') ?>" class="row g-3 align-items-end mb-4 bg-white p-4 rounded-4 shadow-sm border">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">FECHA INICIO</label>
                    <input type="date" name="fecha_desde" class="form-control artisan-input" value="<?= $_GET['fecha_desde'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">FECHA FIN</label>
                    <input type="date" name="fecha_hasta" class="form-control artisan-input" value="<?= $_GET['fecha_hasta'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">ESTADO ACTUAL</label>
                    <select name="estado" class="form-select artisan-input">
                        <option value="">Todos los estados</option>
                        <option value="PENDIENTE" <?= ($_GET['estado'] ?? '') == 'PENDIENTE' ? 'selected' : '' ?>>🟠 Pendiente</option>
                        <option value="EN_PROCESO" <?= ($_GET['estado'] ?? '') == 'EN_PROCESO' ? 'selected' : '' ?>>🔵 En Proceso</option>
                        <option value="TERMINADO" <?= ($_GET['estado'] ?? '') == 'TERMINADO' ? 'selected' : '' ?>>🟢 Terminado</option>
                        <option value="ENTREGADO" <?= ($_GET['estado'] ?? '') == 'ENTREGADO' ? 'selected' : '' ?>>🔘 Entregado</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-artisan-dark w-100 fw-bold">FILTRAR</button>
                    <a href="<?= base_url('/ventas-list') ?>" class="btn btn-outline-secondary w-100 fw-bold d-flex align-items-center justify-content-center">X</a>
                </div>
            </form>

            <!-- Tabla de Ventas -->
            <div class="table-responsive bg-white rounded-4 shadow-sm border overflow-hidden">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #fcfaf7;">
                        <tr class="text-brown">
                            <th class="py-3 px-4"># ID</th>
                            <th class="py-3">Fecha y Hora</th>
                            <th class="py-3">Cliente / Detalle</th>
                            <th class="py-3 text-end">Total Venta</th>
                            <th class="py-3 text-center">Estado Producción</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ventas)): ?>
                            <?php foreach ($ventas as $venta): ?>
                                <tr class="align-middle">
                                    <td class="px-4 fw-bold text-muted">#<?= $venta['id'] ?></td>
                                    <td>
                                        <div class="fw-bold"><?= date('d/m/Y', strtotime($venta['fecha'])) ?></div>
                                        <div class="small text-muted"><?= date('H:i', strtotime($venta['fecha'])) ?> hs</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-brown"><?= esc($venta['nombre_usuario'] ?? 'VENTA MANUAL') ?></div>
                                        <div class="small text-muted text-truncate" style="max-width: 200px;"><?= esc($venta['email_usuario'] ?? 'Pedido Directo WhatsApp') ?></div>
                                    </td>
                                    <td class="text-end fw-bold fs-5 text-dark">
                                        <span class="small opacity-50 fw-normal">$</span><?= number_format($venta['total_venta'], 2, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $style = "";
                                            if($venta['estado'] == 'PENDIENTE') $style = "background: #fff3e0; color: #e65100; border: 1px solid #ffe0b2;";
                                            if($venta['estado'] == 'EN_PROCESO') $style = "background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;";
                                            if($venta['estado'] == 'TERMINADO') $style = "background: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9;";
                                            if($venta['estado'] == 'ENTREGADO') $style = "background: #f5f5f5; color: #424242; border: 1px solid #e0e0e0;";
                                        ?>
                                        <span class="badge rounded-pill px-3 py-2 text-uppercase" style="<?= $style ?> font-size: 0.75rem; letter-spacing: 1px;">
                                            <?= $venta['estado'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <a href="<?= base_url('ventas/gestion/' . $venta['id']) ?>" class="btn btn-sm btn-artisan-manage w-100 shadow-sm py-1 px-3 fw-bold" style="font-size: 0.75rem;">
                                                <i class="bi bi-sliders2 me-1"></i> GESTIONAR
                                            </a>
                                            <a href="<?= base_url('ventas-list/factura/' . $venta['id']) ?>" class="btn btn-sm btn-outline-danger w-100 shadow-sm py-1 px-3 fw-bold" style="font-size: 0.75rem;">
                                                <i class="bi bi-file-earmark-pdf-fill me-1"></i> FACTURA
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="opacity-50 mb-3" style="font-size: 3rem;">📁</div>
                                    <h5 class="text-muted">No hay registros para mostrar</h5>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Lora:wght@700&display=swap');
    
    .font-lora { font-family: 'Lora', serif; }
    .bg-artisan-soft { background-color: #fdfaf7; }
    .text-brown { color: #3e2723; }
    
    .artisan-input {
        border: 1px solid #d7ccc8;
        border-radius: 10px;
    }
    
    .btn-artisan-dark {
        background-color: #3e2723;
        color: white;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-artisan-dark:hover { background-color: #5d4037; color: white; transform: scale(1.02); }

    .btn-gold-artisan {
        background-color: #c5a059;
        color: white;
        border: none;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-gold-artisan:hover { background-color: #b8860b; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(184, 134, 11, 0.4); }

    .btn-artisan-manage {
        background-color: #fdfaf7;
        border: 1px solid #3e2723;
        color: #3e2723;
    }
    .btn-artisan-manage:hover { background-color: #3e2723; color: white; }
</style>