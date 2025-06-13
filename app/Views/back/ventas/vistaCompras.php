<section class="factura-admin">
    <h1 class="factura-admin__titulo">Factura Nº <?= esc($cabecera['id']) ?></h1>

    <div class="factura-admin__info">
        <p><strong>Fecha:</strong> <?= esc($cabecera['fecha']) ?></p>
        <p><strong>Cliente:</strong> <?= esc($cabecera['usuario_nombre']) ?></p>
    </div>

    <table class="factura-admin__tabla">
        <thead>
            <tr>
                <th class="factura-admin__columna">Producto</th>
                <th class="factura-admin__columna">Cantidad</th>
                <th class="factura-admin__columna">Precio Unitario</th>
                <th class="factura-admin__columna">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $item): ?>
            <tr class="factura-admin__fila">
                <td><?= esc($item['nombre']) ?></td>
                <td><?= esc($item['cantidad']) ?></td>
                <td>$<?= number_format($item['precio'], 2) ?></td>
                <td>$<?= number_format($item['cantidad'] * $item['precio'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="factura-admin__total">
        <strong>Total:</strong> $<?= number_format($cabecera['total_venta'], 2) ?>
    </div>
</section>