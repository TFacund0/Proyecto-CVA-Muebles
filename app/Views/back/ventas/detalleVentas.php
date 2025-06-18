
<div class="ventas-container">
    <h1 class="ventas-titulo">Detalle de Ventas</h1>
    <table class="tabla-ventas">
        <thead class="tabla-ventas-encabezado">
            <tr class="tabla-ventas-fila-encabezado">
                <th class="col-id-venta">ID Venta</th>
                <th class="col-id-producto">Usuario</th>
                <th class="col-id-producto">ID Producto</th>
                <th class="col-nombre">Nombre</th>
                <th class="col-cantidad">Cantidad</th>
                <th class="col-precio">Precio</th>
                <th class="col-subtotal">Subtotal</th>
                <th class="col-Estado">Estado</th>
            </tr>
        </thead>
        <tbody class="tabla-ventas-cuerpo">
            <?php foreach ($ventas as $item): ?>
            <tr class="tabla-ventas-fila">
                <td class="col-id-venta"><?= esc($item['venta_id']) ?></td>
                <td class="col-id-usuario"><?= esc($item['usuario'])?></td>
                <td class="col-id-producto"><?= esc($item['producto_id']) ?></td>
                <td class="col-nombre"><?= esc($item['nombre_prod']) ?></td>
                <td class="col-cantidad"><?= esc($item['cantidad']) ?></td>
                <td class="col-precio">$<?= esc($item['precio']) ?></td>
                <td class="col-subtotal">$<?= esc($item['subtotal']) ?></td>
                <td class="col-estado"><button class="btn btn-outline-secondary" href="<?php base_url('/factura') . esc($item['venta_id']) ?>">Ver Factura</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>