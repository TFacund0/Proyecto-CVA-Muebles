<!-- 
  =============================================
  ARTISAN PRODUCT MANAGEMENT - CRUD
  =============================================
-->

<div class="crud-productos-wrapper py-4">
    <div class="container card-container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Cabecera -->
        <div class="card-header bg-artisan-dark py-4 text-white">
            <div class="row align-items-center px-3">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold font-lora">Gestión de Catálogo</h2>
                    <p class="small mb-0 opacity-75">Administra tus muebles y existencias</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('/alta-producto') ?>" class="btn btn-success py-2 px-4 shadow-sm fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> AGREGAR PRODUCTO
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-4 bg-light">
            <!-- Filtros Avanzados -->
            <form action="<?= base_url('/crud-productos'); ?>" method="get" class="bg-white p-4 rounded-4 shadow-sm border mb-4">
                <div class="row g-3 align-items-end">
                    <!-- Buscador General -->
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">BUSCAR PRODUCTO</label>
                        <input type="text" name="search" class="form-control" placeholder="Nombre del mueble..." value="<?= $_GET['search'] ?? '' ?>">
                    </div>

                    <!-- Filtro por Categoría -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">CATEGORÍA</label>
                        <select name="categoria_id" class="form-select">
                            <option value="">Todas las categorías</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat['id_categoria'] ?>" <?= ($_GET['categoria_id'] ?? '') == $cat['id_categoria'] ? 'selected' : '' ?>>
                                    <?= esc($cat['descripcion']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Filtro Estado -->
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">ESTADO</label>
                        <select name="vista" class="form-select">
                            <option value="NO" <?= ($vista == 'NO') ? 'selected' : '' ?>>Activos</option>
                            <option value="SI" <?= ($vista == 'SI') ? 'selected' : '' ?>>Eliminados</option>
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-dark w-100">FILTRAR</button>
                        <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-secondary w-50">Limpiar</a>
                    </div>
                </div>
            </form>

            <!-- Tabla de Productos -->
            <div class="table-responsive bg-white rounded-4 shadow-sm border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-brown">
                            <th class="py-3 px-4 text-center">ID</th>
                            <th class="py-3">Producto</th>
                            <th class="py-3">Categoría</th>
                            <th class="py-3 text-center">Stock</th>
                            <th class="py-3 text-end">Precio Vta</th>
                            <th class="py-3 text-center">Imagen</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($productos)): ?>
                            <?php foreach ($productos as $p): ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?= $p['id_producto'] ?></td>
                                    <td>
                                        <div class="fw-bold"><?= esc($p['nombre_prod']) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?= esc($p['categoria'] ?? 'Sin categoría') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold <?= $p['stock'] <= 5 ? 'text-danger' : 'text-success' ?>">
                                            <?= $p['stock'] ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold">$<?= number_format($p['precio_vta'], 2, ',', '.') ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url('assets/uploads/' . $p['imagen']) ?>" 
                                             alt="Imagen producto" 
                                             class="rounded-3 shadow-sm border" 
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center gap-2 px-2">
                                            <a href="<?= base_url('/editar-producto/' . $p['id_producto']) ?>" class="btn btn-sm btn-outline-primary w-100 fw-bold py-1" style="font-size: 0.7rem;">
                                                <i class="bi bi-pencil-square me-1"></i> EDITAR
                                            </a>
                                            <?php if($vista == 'NO'): ?>
                                                <a href="<?= base_url('/delete-producto/' . $p['id_producto'] . '?vista=' . $vista) ?>" class="btn btn-sm btn-outline-danger w-100 fw-bold py-1" style="font-size: 0.7rem;">
                                                    <i class="bi bi-trash me-1"></i> ELIMINAR
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('/activar-producto/' . $p['id_producto'] . '?vista=' . $vista) ?>" class="btn btn-sm btn-outline-success w-100 fw-bold py-1" style="font-size: 0.7rem;">
                                                    <i class="bi bi-arrow-up-circle me-1"></i> ACTIVAR
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    No se encontraron productos.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-artisan-dark { background-color: #3e2723; }
    .text-brown { color: #3e2723; }
    .font-lora { font-family: 'Lora', serif; }
</style>