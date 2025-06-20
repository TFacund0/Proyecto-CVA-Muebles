<!-- back/ventas/vistaCompras.php -->

<div class="container my-4">
    <h2 class="mb-4">Mis Facturas</h2>

    <?php if (!empty($ventas)): ?>
        <div class="list-group">
            <?php foreach ($ventas as $venta): ?>
                <a href="<?= base_url('factura/' . $venta['id']) ?>" class="list-group-item list-group-item-action">
                    <strong>Factura #<?= $venta['id'] ?></strong><br>
                    Fecha: <?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?><br>
                    Total: $<?= number_format($venta['total_venta'], 2) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No tenés facturas registradas.</p>
    <?php endif; ?>
</div>
