<!-- back/ventas/vistaCompras.php -->

<div class="facturas-contenedor">
    <h2 class="facturas-titulo">Mis Compras</h2>

    <?php if (!empty($ventas)): ?>
        <div class="facturas-lista">
            <?php foreach ($ventas as $venta): ?>
                <a href="<?= base_url('factura/' . $venta['id']) ?>" class="factura-item">
                    <div class="factura-id">Factura #<?= $venta['id'] ?></div>
                    <div class="factura-fecha">Fecha: <?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></div>
                    <div class="factura-total">Total: $<?= number_format($venta['total_venta'], 2) ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="factura-vacia">No tenés facturas registradas.</p>
    <?php endif; ?>
</div>
