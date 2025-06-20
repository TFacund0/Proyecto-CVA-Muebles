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

            <!-- Selector de tipo de filtro -->
            <div class="col-md-4">
                <select name="filtro_tipo" class="form-select filtro-select">
                    <option value="">-- Filtrar por --</option>
                    <option value="id" <?= ($filtro_tipo ?? '') === 'id' ? 'selected' : '' ?>>ID Venta</option>
                    <option value="usuario" <?= ($filtro_tipo ?? '') === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                    <option value="descripcion" <?= ($filtro_tipo ?? '') === 'descripcion' ? 'selected' : '' ?>>Producto</option>
                </select>
            </div>

            <!-- Botón para aplicar filtros -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-filtrar w-100">Filtrar</button>
            </div>

            <!-- Botón para limpiar filtros -->
            <div class="col-md-2">
                <a href="<?= base_url('/ventas_detalle') ?>" class="btn btn-limpiar w-100">Ver Todos</a>
            </div>
        </form>

        <!-- 
          TABLA DE VENTAS
          Muestra el listado detallado de todas las ventas
        -->
        <table id="tablaVentas" class="table table-striped table-bordered tabla-ventas w-100">
            <!-- Cabecera de la tabla con las columnas -->
            <thead class="tabla-ventas-encabezado table-primary">
                <tr>
                    <th>ID Venta</th>
                    <th>Usuario</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            
            <!-- Cuerpo de la tabla con los datos -->
            <tbody>
                <?php foreach ($ventas as $item): ?>
                    <tr>
                        <td><?= esc($item['venta_id']) ?></td>
                        <td><?= esc($item['usuario']) ?></td>
                        <td><?= esc($item['nombre_prod']) ?></td>
                        <td><?= esc($item['cantidad']) ?></td>
                        <td>$<?= esc(number_format($item['precio'], 2)) ?></td>
                        <td>$<?= esc(number_format($item['subtotal'], 2)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>