<!-- back/ventas/ver_factura_usuario.php -->

<div class="container my-4">
    <h2 class="mb-4">Factura Detallada</h2>

    <?php if (!empty($venta)): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Factura #<?= $venta[0]['venta_id'] ?></h5>
                <p class="card-text">Fecha: <?= date('d/m/Y H:i', strtotime($venta[0]['fecha'])) ?></p>
                <p class="card-text">Cliente: <?= $venta[0]['nombre'] ?? 'Sin nombre' ?></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-secondary">
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
                        <td><?= $item['nombre_producto'] ?? 'Producto' ?></td>
                        <td><?= $item['cantidad'] ?></td>
                        <td>$<?= number_format($item['precio'], 2) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-light">
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron detalles para esta factura.</p>
    <?php endif; ?>
</div>
