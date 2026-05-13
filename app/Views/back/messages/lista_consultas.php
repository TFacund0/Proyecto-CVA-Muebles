<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">BANDEJA DE CONSULTAS</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col-md-7">
        <h1 class="display-6 fw-bold text-cva-brown mb-0">Inbox de Consultas</h1>
        <p class="text-muted">Gestiona mensajes, presupuestos y oportunidades de venta directa.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <div class="badge bg-gold-soft text-gold px-4 py-2 rounded-pill fs-6 fw-bold border border-gold">
            <i class="bi bi-chat-left-dots me-2"></i><?= count($consultas) ?> MENSAJES RECIBIDOS
        </div>
    </div>
</div>

<!-- Filtros Inteligentes -->
<div class="admin-card-v2 mb-4">
    <div class="admin-card-body-v2 py-4">
        <form method="get" action="<?= base_url('/consultas') ?>">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="admin-label">Buscar por Cliente</label>
                    <input type="text" name="search" placeholder="Nombre o apellido..." 
                           value="<?= esc($_GET['search'] ?? '') ?>" class="form-control admin-control">
                </div>
                <div class="col-md-3">
                    <label class="admin-label">Filtrar por</label>
                    <select name="filtro_tipo" id="filtro-tipo" class="form-control admin-control">
                        <option value="">-- Sin filtro --</option>
                        <option value="nombre_apellido" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'nombre_apellido') ? 'selected' : '' ?>>Nombre o Apellido</option>
                        <option value="asunto" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'asunto') ? 'selected' : '' ?>>Asunto</option>
                    </select>
                </div>
                <div class="col-md-3" id="asunto-col" style="display: none;">
                    <label class="admin-label">Asunto Específico</label>
                    <select name="asunto" id="filtro-asunto" class="form-control admin-control">
                        <option value="">-- Todos --</option>
                        <option value="Consulta general" <?= ($_GET['asunto'] ?? '') == 'Consulta general' ? 'selected' : '' ?>>Consulta general</option>
                        <option value="Solicitud de presupuesto" <?= ($_GET['asunto'] ?? '') == 'Solicitud de presupuesto' ? 'selected' : '' ?>>Solicitud de presupuesto</option>
                        <option value="Estado de mi pedido" <?= ($_GET['asunto'] ?? '') == 'Estado de mi pedido' ? 'selected' : '' ?>>Estado de mi pedido</option>
                        <option value="Consulta sobre garantía" <?= ($_GET['asunto'] ?? '') == 'Consulta sobre garantía' ? 'selected' : '' ?>>Consulta sobre garantía</option>
                        <option value="Otro" <?= ($_GET['asunto'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-admin-primary w-100 justify-content-center">
                        <i class="bi bi-funnel"></i>
                    </button>
                    <?php if (!empty($_GET['search']) || !empty($_GET['asunto'])): ?>
                        <a href="<?= base_url('/lista-consultas') ?>" class="btn-admin-outline px-3" title="Limpiar">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Listado de Mensajes -->
<div class="admin-card-v2">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 admin-label border-0">Fecha</th>
                    <th class="py-3 admin-label border-0">Interesado</th>
                    <th class="py-3 admin-label border-0">Contacto</th>
                    <th class="py-3 admin-label border-0">Asunto</th>
                    <th class="py-3 admin-label border-0">Mensaje</th>
                    <th class="pe-4 py-3 admin-label border-0 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($consultas)): ?>
                    <?php foreach ($consultas as $index => $consulta): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-cva-brown small"><?= date('d/m/Y', strtotime($consulta['fecha'])) ?></div>
                            </td>
                            <td>
                                <div class="fw-bold text-cva-brown"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></div>
                            </td>
                            <td>
                                <div class="small"><i class="bi bi-envelope me-1 text-muted"></i> <?= esc($consulta['email']) ?></div>
                                <div class="small fw-bold"><i class="bi bi-phone me-1 text-muted"></i> <?= esc($consulta['telefono']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-sand text-brown border px-2 py-1 rounded-pill x-small fw-bold">
                                    <?= esc($consulta['asunto']) ?>
                                </span>
                            </td>
                            <td style="max-width: 250px;">
                                <div class="text-truncate small text-muted"><?= esc($consulta['descripcion']) ?></div>
                                <a href="#" class="text-gold x-small fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalConsulta<?= $index ?>">
                                    LEER COMPLETO <i class="bi bi-chevron-right"></i>
                                </a>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <?php 
                                        $num = preg_replace('/[^0-9]/', '', $consulta['telefono']);
                                        $msg = urlencode("Hola " . $consulta['nombre'] . "! Soy César de CVA Muebles, respondo a tu consulta sobre: " . $consulta['asunto']);
                                        $url_wa = "https://wa.me/" . (str_starts_with($num, '54') ? $num : "54" . $num) . "?text=" . $msg;
                                    ?>
                                    <a href="<?= $url_wa ?>" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-success" title="Responder por WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    
                                    <form action="<?= base_url('ventas/nuevo-personalizado') ?>" method="get" class="m-0">
                                        <input type="hidden" name="nombre" value="<?= esc($consulta['nombre'] . ' ' . $consulta['apellido']) ?>">
                                        <input type="hidden" name="detalle" value="<?= esc($consulta['asunto'] . ': ' . $consulta['descripcion']) ?>">
                                        <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-cva-brown" title="Convertir a Pedido">
                                            <i class="bi bi-hammer"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL DE LECTURA PREMIUM -->
                        <div class="modal fade" id="modalConsulta<?= $index ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-5 shadow-lg overflow-hidden">
                                    <div class="modal-header bg-brown text-white p-4">
                                        <div>
                                            <h5 class="modal-title fw-bold mb-1">Detalle del Mensaje</h5>
                                            <span class="x-small opacity-75">ID: <?= $consulta['id_consulta'] ?></span>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-parchment">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="avatar-md bg-gold text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 50px; height: 50px;">
                                                <?= substr($consulta['nombre'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-cva-brown mb-0"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></h5>
                                                <div class="x-small text-muted"><?= date('d M Y, H:i', strtotime($consulta['fecha'])) ?> hs</div>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-white border rounded-4 mb-4 shadow-sm">
                                            <div class="x-small fw-bold text-gold text-uppercase mb-2">Asunto: <?= esc($consulta['asunto']) ?></div>
                                            <p class="mb-0 text-dark lh-lg"><?= nl2br(esc($consulta['descripcion'])) ?></p>
                                        </div>
                                        <div class="d-flex gap-3 text-muted x-small">
                                            <div><i class="bi bi-envelope"></i> <?= esc($consulta['email']) ?></div>
                                            <div><i class="bi bi-phone"></i> <?= esc($consulta['telefono']) ?></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light p-3 border-0">
                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                                        <a href="<?= $url_wa ?>" target="_blank" class="btn btn-admin-primary rounded-pill px-4">
                                            <i class="bi bi-whatsapp me-2"></i> RESPONDER AHORA
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-chat-dots fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-3 fw-bold">No hay consultas pendientes en la bandeja.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const tipoFiltro = document.getElementById('filtro-tipo');
    const asuntoCol = document.getElementById('asunto-col');

    function toggleAsunto() {
        asuntoCol.style.display = (tipoFiltro.value === 'asunto') ? 'block' : 'none';
    }

    tipoFiltro.addEventListener('change', toggleAsunto);
    window.addEventListener('DOMContentLoaded', toggleAsunto);
</script>
<?= $this->endSection() ?>
