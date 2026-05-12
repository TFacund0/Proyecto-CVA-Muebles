<!-- 
  =============================================
  ARTISAN INBOX PRO - LISTADO DE CONSULTAS
  Diseño estructurado con Modal de lectura.
  =============================================
-->

<div class="inbox-wrapper py-5">
    <div class="container main-inbox-card shadow-lg p-0 overflow-hidden rounded-5 border-artisan">
        
        <!-- Cabecera -->
        <div class="inbox-header p-4 p-md-5 text-white" style="background-color: var(--artisan-dark);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="artisan-title-white mb-0">Inbox de Consultas</h1>
                    <p class="small opacity-75 mb-0">Gestión de oportunidades y presupuestos directos</p>
                </div>
                <div class="inbox-badge">
                    <span class="count"><?= count($consultas) ?></span> Mensajes
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-artisan-cream border-bottom p-4">
            <form method="get" action="<?= base_url('/consultas') ?>" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-brown">BUSCAR CLIENTE</label>
                    <input type="text" name="search" placeholder="Nombre o apellido..." 
                           value="<?= esc($_GET['search'] ?? '') ?>" class="form-control artisan-input-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-brown">TIPO DE FILTRO</label>
                    <select name="filtro_tipo" id="filtro-tipo" class="form-select artisan-input-sm">
                        <option value="">-- Sin filtro --</option>
                        <option value="nombre_apellido" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'nombre_apellido') ? 'selected' : '' ?>>Nombre o Apellido</option>
                        <option value="asunto" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'asunto') ? 'selected' : '' ?>>Asunto</option>
                    </select>
                </div>
                <div class="col-md-3" id="asunto-col" style="display: none;">
                    <label class="form-label small fw-bold text-brown">ASUNTO ESPECÍFICO</label>
                    <select name="asunto" id="filtro-asunto" class="form-select artisan-input-sm">
                        <option value="">-- Todos --</option>
                        <option value="Consulta general" <?= ($_GET['asunto'] ?? '') == 'Consulta general' ? 'selected' : '' ?>>Consulta general</option>
                        <option value="Solicitud de presupuesto" <?= ($_GET['asunto'] ?? '') == 'Solicitud de presupuesto' ? 'selected' : '' ?>>Solicitud de presupuesto</option>
                        <option value="Estado de mi pedido" <?= ($_GET['asunto'] ?? '') == 'Estado de mi pedido' ? 'selected' : '' ?>>Estado de mi pedido</option>
                        <option value="Consulta sobre garantía" <?= ($_GET['asunto'] ?? '') == 'Consulta sobre garantía' ? 'selected' : '' ?>>Consulta sobre garantía</option>
                        <option value="Otro" <?= ($_GET['asunto'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-artisan-dark w-100">Filtrar</button>
                    <?php if (!empty($_GET['search']) || !empty($_GET['asunto'])): ?>
                        <a href="<?= base_url('/consultas') ?>" class="btn btn-outline-secondary">X</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Tabla con Separación y Zebra -->
        <div class="inbox-content p-4 p-md-5 bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover border">
                    <thead class="text-brown" style="background-color: #f8f5f0;">
                        <tr>
                            <th class="py-3 border-end">Fecha</th>
                            <th class="py-3 border-end">Cliente</th>
                            <th class="py-3 border-end">Email / Tel</th>
                            <th class="py-3 border-end">Asunto</th>
                            <th class="py-3 border-end">Mensaje</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consultas as $index => $consulta): ?>
                            <tr class="align-middle">
                                <td class="small text-muted border-end"><?= date('d/m/y', strtotime($consulta['fecha'])) ?></td>
                                <td class="border-end">
                                    <div class="fw-bold text-brown"><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></div>
                                </td>
                                <td class="border-end" style="max-width: 150px;">
                                    <div class="text-break small"><i class="bi bi-envelope me-1"></i> <?= esc($consulta['email']) ?></div>
                                    <div class="small fw-bold"><i class="bi bi-phone me-1"></i> <?= esc($consulta['telefono']) ?></div>
                                </td>
                                <td class="border-end">
                                    <span class="badge-asunto"><?= esc($consulta['asunto']) ?></span>
                                </td>
                                <td class="border-end" style="max-width: 200px;">
                                    <div class="text-truncate-2 small"><?= esc($consulta['descripcion']) ?></div>
                                    <button class="btn btn-link btn-sm p-0 text-gold fw-bold" data-bs-toggle="modal" data-bs-target="#modalConsulta<?= $index ?>">
                                        Leer más...
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-2 p-1">
                                        <!-- WhatsApp -->
                                        <?php 
                                            $num = preg_replace('/[^0-9]/', '', $consulta['telefono']);
                                            $msg = urlencode("Hola " . $consulta['nombre'] . "! Soy César de CVA Muebles.");
                                            $url_wa = "https://wa.me/" . (str_starts_with($num, '54') ? $num : "54" . $num) . "?text=" . $msg;
                                        ?>
                                        <a href="<?= $url_wa ?>" target="_blank" class="btn btn-sm btn-success py-1">
                                            <i class="bi bi-whatsapp"></i> Chat
                                        </a>

                                        <!-- Convertir -->
                                        <form action="<?= base_url('ventas/nuevo-personalizado') ?>" method="get">
                                            <input type="hidden" name="nombre" value="<?= esc($consulta['nombre'] . ' ' . $consulta['apellido']) ?>">
                                            <input type="hidden" name="detalle" value="<?= esc($consulta['asunto'] . ': ' . $consulta['descripcion']) ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-brown py-1">⚒️ Pedido</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL DE LECTURA DETALLADA -->
                            <div class="modal fade" id="modalConsulta<?= $index ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow-lg">
                                        <div class="modal-header bg-artisan-dark text-white rounded-top-4">
                                            <h5 class="modal-title font-lora">Detalle de Consulta</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 bg-artisan-cream">
                                            <div class="mb-3">
                                                <span class="badge-asunto mb-2"><?= esc($consulta['asunto']) ?></span>
                                                <h4><?= esc($consulta['nombre']) ?> <?= esc($consulta['apellido']) ?></h4>
                                                <div class="text-muted small"><?= date('d/m/Y', strtotime($consulta['fecha'])) ?></div>
                                            </div>
                                            <hr>
                                            <p class="lh-lg text-brown"><?= nl2br(esc($consulta['descripcion'])) ?></p>
                                        </div>
                                        <div class="modal-footer border-0 bg-artisan-cream rounded-bottom-4">
                                            <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cerrar</button>
                                            <a href="<?= $url_wa ?>" target="_blank" class="btn btn-success rounded-3">Responder por WA</a>
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

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Lora:wght@700&display=swap');

    :root {
        --artisan-dark: #3e2723;
        --artisan-cream: #fdfaf5;
        --artisan-gold: #b8860b;
    }

    .font-lora { font-family: 'Lora', serif; }
    .inbox-wrapper { background-color: #f5f0e8; font-family: 'Outfit', sans-serif; min-height: 90vh; }
    .bg-artisan-dark { background-color: var(--artisan-dark); }
    .bg-artisan-cream { background-color: var(--artisan-cream); }
    .artisan-title-white { font-family: 'Lora', serif; font-size: 2.2rem; }
    .inbox-badge { background: rgba(255,255,255,0.1); padding: 8px 15px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); }
    .inbox-badge .count { font-size: 1.2rem; font-weight: 700; color: var(--artisan-gold); }
    .artisan-input-sm { border: 1px solid #d7ccc8; border-radius: 8px; }
    .btn-artisan-dark { background-color: var(--artisan-dark); color: white; border-radius: 8px; font-weight: 600; }
    .btn-artisan-dark:hover { background-color: var(--artisan-gold); color: white; }
    .badge-asunto { background: #f0ece2; color: #5d4037; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; border: 1px solid #d7ccc8; display: inline-block; }
    .text-truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .btn-outline-brown { border: 1px solid var(--artisan-dark); color: var(--artisan-dark); border-radius: 8px; font-weight: 600; }
    .btn-outline-brown:hover { background-color: var(--artisan-dark); color: white; }
    .text-brown { color: var(--artisan-dark); }
    .text-gold { color: var(--artisan-gold); }
</style>

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