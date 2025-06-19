<div class="container py-4" id="carrito">
    <div class="carrito-box d-flex flex-column rounded p-4 mx-auto" style="min-height: 600px; height: 100%;">
        <div class="flex-grow-1 d-flex flex-column">
            <div class="text-center mb-4">
                <h2 class="carrito-title">Productos en tu Carrito</h2>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success text-center">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (empty($cart)): ?>
                <div class="text-center">
                    <p>Para agregar productos al carrito, hacé clic en:</p>
                    <a class="btn btn-warning text-dark mt-2" href="<?= base_url('/todos_p') ?>">
                        <i class="fa-solid fa-circle-chevron-left"></i> Volver al catálogo
                    </a>
                </div>
            <?php else: ?>
                <form action="<?= base_url('carrito_actualiza') ?>" method="post" class="d-flex flex-column flex-grow-1">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-hover align-middle text-center table-carrito">
                            <thead class="table-dark">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $gran_total = 0; ?>
                                <?php foreach ($cart as $item): ?>
                                    <?php $gran_total += $item['price'] * $item['qty']; ?>
                                    <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][id]" value="<?= esc($item['id']) ?>">
                                    <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][name]" value="<?= esc($item['name']) ?>">
                                    <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][price]" value="<?= esc($item['price']) ?>">
                                    <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][imagen]" value="<?= esc($item['imagen']) ?>">

                                    <tr>
                                        <td><img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" class="img-thumbnail border border-dark carrito-img" alt="<?= esc($item['name']) ?>" style="max-width: 200px; width: 150px; height: auto;"></td>
                                        <td><?= esc($item['name']) ?></td>
                                        <td>$<?= esc($item['price']) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-sm btn-success" href="<?= base_url('carrito_suma/' . $item['rowid']) ?>">+</a>
                                                <span class="px-2"><?= esc($item['qty']) ?></span>
                                                <a class="btn btn-sm btn-danger" href="<?= base_url('carrito_resta/' . $item['rowid']) ?>">-</a>
                                            </div>
                                        </td>
                                        <td>$<?= number_format($item['subtotal'], 2) ?></td>
                                        <td><a class="btn btn-sm btn-outline-danger" href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>">Eliminar</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bloque al fondo -->
                    <div class="mt-auto d-flex flex-column flex-md-row justify-content-between align-items-center carrito-total-box">
                        <h4 class="mb-3 mb-md-0">Total: $<?= number_format($gran_total, 2) ?></h4>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a class="btn btn-outline-danger" href="<?= base_url('/borrar') ?>">Vaciar Carrito</a>
                            <a class="btn btn-outline-secondary" href="<?= base_url('/todos_p') ?>">Seguir comprando</a>
                            <a class="btn btn-primary" href="<?= base_url('carrito_comprar') ?>">Comprar</a>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>