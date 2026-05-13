<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin-panel.css?v=1.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-wrapper py-5">
    <div class="container">
        <div class="card admin-card">
        
        <!-- Cabecera -->
        <div class="admin-card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="fw-bold"><i class="bi bi-box-seam me-2"></i> Gestión de Catálogo</h1>
                    <p class="small mb-0 opacity-75">Administra tus muebles y existencias con precisión artesanal</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('/alta-producto') ?>" class="btn btn-admin-gold shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> AGREGAR PRODUCTO
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Filtros Avanzados -->
            <form action="<?= base_url('/crud-productos'); ?>" method="get" class="admin-filter-bar">
                <div class="row g-3 align-items-end">
                    <!-- Buscador General -->
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Buscar Producto</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0 admin-input" 
                                   placeholder="Nombre del mueble..." value="<?= $_GET['search'] ?? '' ?>">
                        </div>
                    </div>

                    <!-- Filtro por Categoría -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Categoría</label>
                        <select name="categoria_id" class="form-select admin-input">
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
                        <label class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                        <select name="vista" class="form-select admin-input">
                            <option value="NO" <?= ($vista == 'NO') ? 'selected' : '' ?>>Activos</option>
                            <option value="SI" <?= ($vista == 'SI') ? 'selected' : '' ?>>Eliminados</option>
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn bg-cva-brown text-white w-100 fw-bold py-2 rounded-3">FILTRAR</button>
                        <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-secondary px-3 py-2">X</a>
                    </div>
                </div>
            </form>

            <!-- Tabla de Productos -->
            <div class="admin-table-container">
                <table class="table table-hover admin-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th class="text-center">Stock</th>
                            <th class="text-end">Precio Vta</th>
                            <th class="text-center">Imagen</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($productos)): ?>
                            <?php foreach ($productos as $p): ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?= $p['id_producto'] ?></td>
                                    <td>
                                        <div class="fw-bold text-cva-brown"><?= esc($p['nombre_prod']) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border badge-admin"><?= esc($p['categoria'] ?? 'Sin categoría') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold <?= $p['stock'] <= 5 ? 'text-danger' : 'text-success' ?>">
                                            <?= $p['stock'] ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold text-cva-brown">$<?= number_format($p['precio_vta'], 2, ',', '.') ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url('assets/uploads/' . $p['imagen']) ?>" 
                                             alt="Imagen producto" 
                                             class="rounded-3 shadow-sm border" 
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center gap-2 px-2">
                                            <a href="<?= base_url('/editar-producto/' . $p['id_producto']) ?>" class="btn btn-sm btn-outline-primary w-100 fw-bold rounded-pill" style="font-size: 0.7rem;">
                                                <i class="bi bi-pencil-square me-1"></i> EDITAR
                                            </a>
                                            <?php if($vista == 'NO'): ?>
                                                <a href="<?= base_url('/delete-producto/' . $p['id_producto'] . '?vista=' . $vista) ?>" class="btn btn-sm btn-outline-danger w-100 fw-bold rounded-pill" style="font-size: 0.7rem;">
                                                    <i class="bi bi-trash me-1"></i> ELIMINAR
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('/activar-producto/' . $p['id_producto'] . '?vista=' . $vista) ?>" class="btn btn-sm btn-outline-success w-100 fw-bold rounded-pill" style="font-size: 0.7rem;">
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
<?= $this->endSection() ?>
