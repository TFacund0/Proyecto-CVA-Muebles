<!-- Contenedor principal del formulario de edición -->
<div class="container d-flex justify-content-center align-items-center py-5">
    <div class="editar-prod-contenedor p-4 p-md-5 w-75">

        <!-- Título del formulario -->
        <h3 class="text-center mb-4 editar-prod-titulo">Editar Producto</h3>

        <?php $validation = \Config\Services::validation(); ?>

        <?php if(session()->getFlashData('success')) { ?>
            <div class="alert alert-primary text-center">
                <?= session()->getFlashData('success'); ?>
            </div>
        <?php } ?>

        <!-- Formulario -->
        <form method="POST"
              action="<?= base_url('/modificar-producto/' . $producto['id_producto']) ?>"
              enctype="multipart/form-data">

            <!-- Nombre del Producto -->
            <div class="mb-3">
                <label for="producto-form-editar" class="form-label editar-prod-label">Nombre del Producto</label>
                <input type="text"
                       name="nombre_producto"
                       class="form-control editar-prod-input"
                       id="producto-form-editar"
                       value="<?= esc($producto['nombre_prod']) ?>"
                       required>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="select-categoria" class="form-label editar-prod-label">Categoría</label>
                <select class="form-select editar-prod-select"
                        id="select-categoria"
                        name="categoria_id"
                        required>
                    <option disabled>Selecciona una categoría</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria['id_categoria'] ?>"
                            <?= $producto['categoria_id'] == $categoria['id_categoria'] ? 'selected' : '' ?>>
                            <?= $categoria['descripcion'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Fila de precios y stock -->
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="precio" class="form-label editar-prod-label">Precio</label>
                    <input type="number"
                           name="precio"
                           class="form-control editar-prod-input"
                           id="precio"
                           value="<?= esc($producto['precio']) ?>"
                           required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="precio-vta" class="form-label editar-prod-label">Precio Venta</label>
                    <input type="number"
                           name="precio-vta"
                           class="form-control editar-prod-input"
                           id="precio-vta"
                           value="<?= esc($producto['precio_vta']) ?>"
                           required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="stock" class="form-label editar-prod-label">Stock</label>
                    <input type="number"
                           name="stock"
                           class="form-control editar-prod-input"
                           id="stock"
                           value="<?= esc($producto['stock']) ?>"
                           required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="stock-min" class="form-label editar-prod-label">Stock Mínimo</label>
                    <input type="number"
                           name="stock-min"
                           class="form-control editar-prod-input"
                           id="stock-min"
                           value="<?= esc($producto['stock_min']) ?>"
                           required>
                </div>
            </div>

            <!-- Imagen actual -->
            <div class="mb-3 text-center">
                <label class="form-label editar-prod-label">Imagen actual</label><br>
                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>"
                     class="editar-prod-img img-fluid mt-2"
                     alt="Imagen actual del producto"
                     style="max-width: 300px;">
            </div>

            <!-- Nueva imagen -->
            <div class="mb-4">
                <label for="imagen" class="form-label editar-prod-label">Nueva Imagen (opcional)</label>
                <input type="file"
                       name="imagen"
                       class="form-control editar-prod-file"
                       id="imagen"
                       accept="image/png, image/jpg, image/jpeg"
                       onchange="mostrarVistaPrevia(event)">
            </div>

            <!-- Vista previa de nueva imagen -->
            <div id="preview-container" class="mb-3 text-center d-none">
                <label class="form-label editar-prod-label">Vista previa</label><br>
                <img id="preview" class="editar-prod-img img-fluid mt-2" style="max-width: 300px;" alt="Vista previa de imagen">
            </div>

            <!-- Botones -->
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mt-4">
                <button type="submit"
                        class="btn btn-success w-100 editar-prod-btn-guardar">
                    Guardar Cambios
                </button>
                <a href="<?= base_url('/crud-productos') ?>"
                   class="btn btn-danger w-100 editar-prod-btn-cancelar">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Script para vista previa -->
<script>
    function mostrarVistaPrevia(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
