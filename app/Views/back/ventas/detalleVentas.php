<!-- 
  =============================================
  PÁGINA DE DETALLE DE VENTAS
  Muestra el listado detallado de todas las ventas realizadas
  =============================================
-->

<!-- Contenedor principal de la sección -->
<div class="ventas-container container my-5">
    <!-- Título principal de la página -->
    <h1 class="ventas-titulo text-center mb-4">Detalle de Ventas</h1>

    <!-- Contenedor responsivo para la tabla -->
    <div class="table-responsive p-2">
        
        <!-- 
          FORMULARIO DE FILTRADO
          Permite buscar y filtrar las ventas por diferentes criterios
        -->
        <form method="get" class="row g-2 mb-4 filtro-ventas-form">
            <!-- Campo de búsqueda general -->
            <div class="col-md-4">
                <input type="text" 
                       name="search" 
                       class="form-control filtro-busqueda-input" 
                       placeholder="Buscar..." 
                       value="<?= esc($search ?? '') ?>">
            </div>

            <!-- Selector de estado -->
            <div class="col-md-3">
                <select name="estado" class="form-select filtro-select">
                    <option value="">-- Todos los estados --</option>
                    <option value="PENDIENTE" <?= ($estado_filtro ?? '') === 'PENDIENTE' ? 'selected' : '' ?>>PENDIENTE</option>
                    <option value="EN_PROCESO" <?= ($estado_filtro ?? '') === 'EN_PROCESO' ? 'selected' : '' ?>>EN PROCESO</option>
                    <option value="TERMINADO" <?= ($estado_filtro ?? '') === 'TERMINADO' ? 'selected' : '' ?>>TERMINADO</option>
                    <option value="ENTREGADO" <?= ($estado_filtro ?? '') === 'ENTREGADO' ? 'selected' : '' ?>>ENTREGADO</option>
                </select>
            </div>

            <!-- Botones de acción -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-filtrar w-100">Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="<?= base_url('/ventas-list') ?>" class="btn btn-limpiar w-100">Ver Todos</a>
            </div>
            <div class="col-md-1">
                <a href="<?= base_url('/ventas-stats') ?>" class="btn btn-info w-100" title="Ver Estadísticas">📊</a>
            </div>
        </form>

        <!-- 
          TABLA DE VENTAS
          Muestra el listado detallado de todas las ventas
        -->
        <table id="tablaVentas" class="table table-striped table-bordered tabla-ventas w-100">
            <!-- Cabecera de la tabla con las columnas -->
            <thead class="tabla-ventas-encabezado table-primary text-center">
                <tr>
                    <th>ID Venta</th>
                    <th>Usuario</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Estado de Pedido</th>
                </tr>
            </thead>
            
            <!-- Cuerpo de la tabla con los datos -->
            <tbody>
                <?php foreach ($ventas as $item): ?>
                    <tr class="align-middle">
                        <td class="text-center"><?= esc($item['venta_id']) ?></td>
                        <td><?= esc($item['usuario']) ?></td>
                        <td><?= esc($item['nombre_prod']) ?></td>
                        <td class="text-center"><?= esc($item['cantidad']) ?></td>
                        <td class="text-end">$<?= esc(number_format($item['precio'], 2)) ?></td>
                        <td class="text-end">$<?= esc(number_format($item['subtotal'], 2)) ?></td>
                        <td>
                            <form action="<?= base_url('ventas/actualizar_estado/' . $item['venta_id']) ?>" method="post" class="d-flex gap-2">
                                <?= csrf_field() ?>
                                <select name="estado" class="form-select form-select-sm">
                                    <option value="PENDIENTE" <?= $item['estado'] == 'PENDIENTE' ? 'selected' : '' ?>>PENDIENTE</option>
                                    <option value="EN_PROCESO" <?= $item['estado'] == 'EN_PROCESO' ? 'selected' : '' ?>>EN PROCESO</option>
                                    <option value="TERMINADO" <?= $item['estado'] == 'TERMINADO' ? 'selected' : '' ?>>TERMINADO</option>
                                    <option value="ENTREGADO" <?= $item['estado'] == 'ENTREGADO' ? 'selected' : '' ?>>ENTREGADO</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">✓</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>