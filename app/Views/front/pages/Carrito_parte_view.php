<div class="container-fluid" id="carrito">
    <div class="cart">
        <div class="heading">
            <h2 class="text-center">Productos en tu Carrito</h2>
        </div>

        <!-- Mostrar alert -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Carrito vacío -->
        <div class="text-center">
            <?php if (empty($cart)): ?>
                <p>Para agregar productos al carrito, hacé clic en:</p>
                <a class="btn btn-warning text-dark mt-2" href="<?= base_url('/todos_p') ?>">
                    <i class="fa-solid fa-circle-chevron-left"></i> Volver al catálogo
                </a>
            <?php endif; ?>
        </div>

        <!-- Carrito lleno -->
        <?php if (!empty($cart)): ?>
            <form action="<?= base_url('carrito_actualiza') ?>" method="post">
                <div class="container my-3">
                    <table class="table table-hover table-dark table-responsive-md">
                        <thead class="table-dark">
                            <tr>
                                <th>IMAGEN</th>
                                <th>PRODUCTO</th>
                                <th>PRECIO</th>
                                <th>CANTIDAD</th>
                                <th>TOTAL</th>
                                <th>Cancelar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $gran_total = 0; ?>
                            <?php foreach ($cart as $item): ?>
                                <?php $gran_total += $item['price'] * $item['qty']; ?>

                                <!-- Inputs ocultos -->
                                <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][id]" value="<?= esc($item['id']) ?>">
                                <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][name]" value="<?= esc($item['name']) ?>">
                                <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][price]" value="<?= esc($item['price']) ?>">
                                <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][imagen]" value="<?= esc($item['imagen']) ?>">

                                <tr class="table-danger align-middle">
                                    <td>
                                        <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" width="80" alt="<?= esc($item['name']) ?>">
                                    </td>
                                    <td><?= esc($item['name']) ?></td>
                                    <td>$ <?= esc($item['price']) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="<?= base_url('carrito_suma/' . $item['rowid']) ?>">+</a>
                                        <?= esc($item['qty']) ?>
                                        <a class="btn btn-sm btn-danger" href="<?= base_url('carrito_resta/' . $item['rowid']) ?>">-</a>
                                    </td>
                                    <td>$ <?= number_format($item['subtotal'], 2) ?></td>
                                    <td>
                                            <a class="btn btn-danger" href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Total y acciones -->
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light border rounded">
                        <h4>Total: $ <?= number_format($gran_total, 2) ?></h4>
                        <div>
                            <a class="btn btn-danger" href="<?= base_url('/borrar') ?>">Vaciar Carrito</a>
                            <a class="btn btn-secondary" href="<?= base_url('/todos_p') ?>">Seguir comprando</a>
                            <a class="btn btn-primary" href="<?= base_url('carrito_comprar') ?>">Comprar</a>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
