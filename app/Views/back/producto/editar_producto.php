<div class="container my-5 w-50 p-5 editar-prod-contenedor" id="editar-producto-contenedor">
    <h3 class="text-center mb-3 editar-prod-titulo">Editar Producto</h3>

    <?php $validation = \Config\Services::validation(); ?>

    <?php if(session()->getFlashData('success')) {?>
        <div class="alert alert-primary text-center"><?php echo session()->getFlashData('success'); ?></div>
    <?php }?>

    <form method="post" action="<?php echo base_url('/modificar-producto/' . $producto['id_producto']) ?>" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="producto-form-editar" class="form-label editar-prod-label">Nombre del Producto</label>
            <input type="text" name="nombre_producto" class="form-control editar-prod-input" id="producto-form-editar"
                value="<?= esc($producto['nombre_prod']) ?>" required> 
        </div>

        <div class="mb-3">
            <label for="select-categoria" class="form-label editar-prod-label">Categorías</label>
            <select class="form-select editar-prod-select" id="select-categoria" name="categoria_id" required>
                <option disabled>Selecciona una categoría</option>
                <?php foreach ($categorias as $categoria) {?>
                    <option value="<?= $categoria['id_categoria'] ?>" 
                        <?= $producto['categoria_id'] == $categoria['id_categoria'] ? 'selected' : '' ?>>
                        <?= $categoria['descripcion'] ?>
                    </option>
                <?php }?>
            </select>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="precio" class="form-label editar-prod-label">Precio</label>
                <input type="number" name="precio" class="form-control editar-prod-input" id="precio"
                    value="<?= esc($producto['precio']) ?>" required>
            </div>

            <div class="col-6 mb-3">
                <label for="precio-vta" class="form-label editar-prod-label">Precio venta</label>
                <input type="number" name="precio-vta" class="form-control editar-prod-input" id="precio-vta"
                    value="<?= esc($producto['precio_vta']) ?>" required>
            </div>

            <div class="col-6 mb-3">
                <label for="stock" class="form-label editar-prod-label">Stock</label>
                <input type="number" name="stock" class="form-control editar-prod-input" id="stock"
                    value="<?= esc($producto['stock']) ?>" required>
            </div>

            <div class="col-6 mb-3">
                <label for="stock-min" class="form-label editar-prod-label">Stock Mínimo</label>
                <input type="number" name="stock-min" class="form-control editar-prod-input" id="stock-min"
                    value="<?= esc($producto['stock_min']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label editar-prod-label">Imagen actual</label><br>
            <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" width="100" class="editar-prod-img">
        </div>

        <div class="mb-4">
            <label for="imagen" class="form-label editar-prod-label">Nueva Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control editar-prod-file" id="imagen" accept="image/png, image/jpg, image/jpeg">
        </div>

        <div class="d-flex justify-content-around mt-5">
            <button type="submit" class="ms-2 me-3 w-50 btn btn-outline-success editar-prod-btn-guardar">Guardar Cambios</button>
            <a href="<?php echo base_url('/crud-productos') ?>" class="ms-3 me-2 w-50 btn btn-outline-danger editar-prod-btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>