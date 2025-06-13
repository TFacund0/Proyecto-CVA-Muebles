<section class="factura-usuario">
    <h1 class="factura-usuario__titulo">Detalle de la Factura</h1>

    <div class="factura-usuario__cabecera">
        <p><strong>Número de Factura:</strong> <?= esc($cabecera['id']) ?></p>
        <p><strong>Fecha:</strong> <?= esc($cabecera['fecha']) ?></p>
    </div>

    <table class="factura-usuario__tabla">
        <thead>
            <tr>
                <th class="factura-usuario__columna">Producto</th>
                <th class="factura-usuario__columna">Cantidad</th>
                <th class="factura-usuario__columna">Precio Unitario</th>
                <th class="factura-usuario__columna">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $item): ?>
            <tr class="factura-usuario__fila">
                <td><?= esc($item['nombre']) ?></td>
                <td><?= esc($item['cantidad']) ?></td>
                <td>$<?= number_format($item['precio'], 2) ?></td>
                <td>$<?= number_format($item['cantidad'] * $item['precio'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="factura-usuario__total">
        <strong>Total de la Compra:</strong> $<?= number_format($cabecera['total_venta'], 2) ?>
    </div>
</section>