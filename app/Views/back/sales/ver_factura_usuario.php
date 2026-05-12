<!-- back/ventas/ver_factura_usuario.php -->

<div class="factura-detalle-contenedor">
    <h2 class="factura-detalle-titulo">Factura Detallada</h2>

    <?php if (!empty($venta)): ?>
        <div class="factura-detalle-cabecera">
            <div class="dato"><strong>Factura #<?= $venta[0]['venta_id'] ?></strong></div>
            <div class="dato">Fecha: <?= date('d/m/Y H:i', strtotime($venta[0]['fecha'])) ?></div>
            <div class="dato">Cliente: <?= $venta[0]['nombre'] ?? 'Sin nombre' ?></div>
        </div>

        <table class="factura-detalle-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total = 0;
                    foreach ($venta as $item): 
                        $subtotal = $item['cantidad'] * $item['precio'];
                        $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $item['nombre_prod'] ?? 'Producto' ?></td>
                        <td><?= $item['cantidad'] ?></td>
                        <td>$<?= number_format($item['precio'], 2) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="factura-detalle-total">
                    <td colspan="3">Total:</td>
                    <td>$<?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p class="factura-detalle-vacio">No se encontraron detalles para esta factura.</p>
    <?php endif; ?>
</div>
