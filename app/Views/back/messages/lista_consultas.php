<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin-panel.css?v=1.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-wrapper py-5">
    <div class="container card admin-card p-0">
        
        <!-- Cabecera -->
        <div class="admin-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold"><i class="bi bi-chat-dots me-2"></i> Inbox de Consultas</h2>
                    <p class="small opacity-75 mb-0">Gestión de oportunidades y presupuestos directos</p>
                </div>
                <div class="badge bg-white text-cva-brown px-3 py-2 rounded-4 border">
                    <span class="fs-5 fw-bold text-cva-gold"><?= count($consultas) ?></span> Mensajes
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- Filtros -->
            <div class="bg-light border-bottom p-4">
                <form method="get" action="<?= base_url('/lista-consultas') ?>" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-cva-brown">BUSCAR CLIENTE</label>
                        <input type="text" name="search" placeholder="Nombre o apellido..." 
                               value="<?= esc($_GET['search'] ?? '') ?>" class="form-control admin-input">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-cva-brown">TIPO DE FILTRO</label>
                        <select name="filtro_tipo" id="filtro-tipo" class="form-select admin-input">
                            <option value="">-- Sin filtro --</option>
                            <option value="nombre_apellido" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'nombre_apellido') ? 'selected' : '' ?>>Nombre o Apellido</option>
                            <option value="asunto" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'asunto') ? 'selected' : '' ?>>Asunto</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="asunto-col" style="display: none;">
                        <label class="form-label small fw-bold text-cva-brown">ASUNTO ESPECÍFICO</label>
                        <select name="asunto" id="filtro-asunto" class="form-select admin-input">
                            <option value="">-- Todos --</option>
                            <option value="Consulta general" <?= ($_GET['asunto'] ?? '') == 'Consulta general' ? 'selected' : '' ?>>Consulta general</option>
                            <option value="Solicitud de presupuesto" <?= ($_GET['asunto'] ?? '') == 'Solicitud de presupuesto' ? 'selected' : '' ?>>Solicitud de presupuesto</option>
                            <option value="Estado de mi pedido" <?= ($_GET['asunto'] ?? '') == 'Estado de mi pedido' ? 'selected' : '' ?>>Estado de mi pedido</option>
                            <option value="Consulta sobre garantía" <?= ($_GET['asunto'] ?? '') == 'Consulta sobre garantía' ? 'selected' : '' ?>>Consulta sobre garantía</option>
                            <option value="Otro" <?= ($_GET['asunto'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn bg-cva-brown text-white w-100 fw-bold py-2 rounded-3">Filtrar</button>
                        <?php if (!empty($_GET['search']) || !empty($_GET['asunto'])): ?>
                            <a href="<?= base_url('/lista-consultas') ?>" class="btn btn-outline-secondary px-3 py-2">X</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Tabla -->
            <div class="p-4 p-md-5 bg-white">
                <div class="admin-table-container">
                    <table class="table table-hover admin-table mb-0">
                        <thead>
                            <tr>
                                <th class="py-3">Fecha</th>
                                <th class="py-3">Cliente</th>
                                <th class="py-3">Email / Tel</th>
                                <th class="py-3">Asunto</th>
                                <th class="py-3">Mensaje</th>
                                <th class="py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($consultas as $index => $consulta): ?>
                                <tr class="align-middle">
                                    <td class="small text-muted"><?= date('d/m/y', strtotime($consulta['fecha'])) ?></td>
                                    <td>
                                        <div class="fw-bold text-cva-brown"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></div>
                                    </td>
                                    <td style="max-width: 150px;">
                                        <div class="text-break small"><i class="bi bi-envelope me-1"></i> <?= esc($consulta['email']) ?></div>
                                        <div class="small fw-bold"><i class="bi bi-phone me-1"></i> <?= esc($consulta['telefono']) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-cva-brown border badge-admin"><?= esc($consulta['asunto']) ?></span>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <div class="text-truncate small opacity-75" style="max-height: 3rem; overflow: hidden;"><?= esc($consulta['descripcion']) ?></div>
                                        <button class="btn btn-link btn-sm p-0 text-cva-gold fw-bold" data-bs-toggle="modal" data-bs-target="#modalConsulta<?= $index ?>">
                                            Leer más...
                                        </button>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <!-- WhatsApp -->
                                            <?php 
                                                $num = preg_replace('/[^0-9]/', '', $consulta['telefono']);
                                                $msg = urlencode("Hola " . $consulta['nombre'] . "! Soy César de CVA Muebles.");
                                                $url_wa = "https://wa.me/" . (str_starts_with($num, '54') ? $num : "54" . $num) . "?text=" . $msg;
                                            ?>
                                            <a href="<?= $url_wa ?>" target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                                                <i class="bi bi-whatsapp me-1"></i> Chat
                                            </a>

                                            <!-- Convertir a Pedido -->
                                            <form action="<?= base_url('ventas/nuevo-personalizado') ?>" method="get">
                                                <input type="hidden" name="nombre" value="<?= esc($consulta['nombre'] . ' ' . $consulta['apellido']) ?>">
                                                <input type="hidden" name="detalle" value="<?= esc($consulta['asunto'] . ': ' . $consulta['descripcion']) ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-brown rounded-pill px-3">⚒️ Pedido</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL DE LECTURA DETALLADA -->
                                <div class="modal fade" id="modalConsulta<?= $index ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                                            <div class="modal-header bg-cva-brown text-white border-0">
                                                <h5 class="modal-title fw-bold">Detalle de Consulta</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 bg-light">
                                                <div class="mb-3">
                                                    <span class="badge bg-cva-gold badge-admin mb-2"><?= esc($consulta['asunto']) ?></span>
                                                    <h4 class="fw-bold text-cva-brown"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></h4>
                                                    <div class="text-muted small"><?= date('d/m/Y', strtotime($consulta['fecha'])) ?></div>
                                                </div>
                                                <hr>
                                                <p class="lh-lg text-dark"><?= nl2br(esc($consulta['descripcion'])) ?></p>
                                            </div>
                                            <div class="modal-footer border-0 bg-light">
                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                                                <a href="<?= $url_wa ?>" target="_blank" class="btn btn-success rounded-pill px-4">Responder por WA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tipoFiltro = document.getElementById('filtro-tipo');
    const selectAsunto = document.getElementById('filtro-asunto');
    const asuntoCol = document.getElementById('asunto-col');

    function toggleAsunto() {
        if (tipoFiltro.value === 'asunto') {
            asuntoCol.style.display = 'block';
        } else {
            asuntoCol.style.display = 'none';
            selectAsunto.value = '';
        }
    }

    tipoFiltro.addEventListener('change', toggleAsunto);
    window.addEventListener('DOMContentLoaded', toggleAsunto);
</script>
<?= $this->endSection() ?>
