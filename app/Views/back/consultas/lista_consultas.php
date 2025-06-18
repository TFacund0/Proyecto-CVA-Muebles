<div class="consulta-body">
    <div class="container consulta-container">
        <h1 class="consulta-titulo">Listado de Consultas</h1>

        <form method="get" action="<?= base_url('/consultas') ?>" class="consulta-busqueda-form row gy-2 gx-3 align-items-center" id="consulta-form">
            <div class="col-md-4">
                <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?= esc($_GET['search'] ?? '') ?>" class="form-control consulta-input">
            </div>
            <div class="col-md-3">
                <select name="filtro_tipo" id="filtro-tipo" class="form-select consulta-select">
                    <option value="">-- Elegir tipo de filtro --</option>
                    <option value="nombre_apellido" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'nombre_apellido') ? 'selected' : '' ?>>Nombre o Apellido</option>
                    <option value="asunto" <?= (isset($_GET['filtro_tipo']) && $_GET['filtro_tipo'] == 'asunto') ? 'selected' : '' ?>>Asunto</option>
                </select>
            </div>
            <div class="col-md-3" id="asunto-col" style="display: none;">
                <select name="asunto" id="filtro-asunto" class="form-select consulta-select">
                    <option value="">-- Seleccione un asunto --</option>
                    <option value="Consulta general" <?= ($_GET['asunto'] ?? '') == 'Consulta general' ? 'selected' : '' ?>>Consulta general</option>
                    <option value="Solicitud de presupuesto" <?= ($_GET['asunto'] ?? '') == 'Solicitud de presupuesto' ? 'selected' : '' ?>>Solicitud de presupuesto</option>
                    <option value="Estado de mi pedido" <?= ($_GET['asunto'] ?? '') == 'Estado de mi pedido' ? 'selected' : '' ?>>Estado de mi pedido</option>
                    <option value="Consulta sobre garantía" <?= ($_GET['asunto'] ?? '') == 'Consulta sobre garantía' ? 'selected' : '' ?>>Consulta sobre garantía</option>
                    <option value="Otro" <?= ($_GET['asunto'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>
            </div>
            <div class="col-auto d-flex gap-2">
                <button type="submit" class="btn consulta-boton">Buscar</button>
                <?php if (!empty($_GET['search']) || !empty($_GET['asunto']) || !empty($_GET['filtro_tipo'])): ?>
                    <a href="<?= base_url('/consultas') ?>" class="consulta-boton-restablecer">Ver todas</a>
                <?php endif; ?>
            </div>
        </form>

        <?php if (session()->getFlashdata('success')): ?>
            <p class="consulta-mensaje-exito"><?= session()->getFlashdata('success') ?></p>
        <?php endif; ?>

        <div class="table-responsive mt-4">
            <table class="table consulta-tabla">
                <thead class="consulta-thead">
                    <tr class="consulta-tr">
                        <th class="consulta-th">Fecha</th>
                        <th class="consulta-th">Nombre</th>
                        <th class="consulta-th">Apellido</th>
                        <th class="consulta-th">Email</th>
                        <th class="consulta-th">Teléfono</th>
                        <th class="consulta-th">Asunto</th>
                        <th class="consulta-th">Descripción</th>
                        <th class="consulta-th">Acción</th>
                    </tr>
                </thead>
                <tbody class="consulta-tbody">
                    <?php foreach ($consultas as $consulta): ?>
                        <tr class="consulta-tr">
                            <td class="consulta-td"><?= esc($consulta['fecha']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['nombre']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['apellido']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['email']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['telefono']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['asunto']) ?></td>
                            <td class="consulta-td"><?= esc($consulta['descripcion']) ?></td>
                            <td class="consulta-td">
                                <form action="<?= base_url('/consultas/eliminar/' . $consulta['id_consulta']) ?>" method="post" onsubmit="return confirm('¿Seguro que deseas eliminar esta consulta?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="consulta-btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
