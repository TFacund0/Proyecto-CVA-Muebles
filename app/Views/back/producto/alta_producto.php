<div class="container my-5 w-50 p-5" id="alta-producto-contenedor">
    <!-- Contenedor principal del formulario de alta de productos -->

    <h3 class="text-center mb-3 titulo-form-alta-producto">Formulario de Alta de producto</h3>

    <?php $validation = \Config\Services::validation(); ?>
    <!-- Se carga el servicio de validación para mostrar errores si existen -->

    <!-- Mensaje de éxito si se establece una variable flash 'success' -->
    <?php if(session()->getFlashData('success')) {?>
        <div class="alert alert-primary text-center"><?php echo session()->getFlashData('success');?></div>
    <?php }?>

    <!-- Mensaje de error si se establece una variable flash 'fail' -->
    <?php if(session()->getFlashData('fail')) {?>
        <div class="alert alert-danger text-center"><?php echo session()->getFlashData('fail');?></div>
    <?php }?>

    <!-- Formulario de alta de producto -->
    <form method="post" id="form-alta-producto" action="<?php echo base_url('/enviar-alta-producto') ?>" enctype="multipart/form-data">
        
        <!-- Campo de texto: nombre del producto -->
        <div class="mb-3">
            <label for="producto-form-alta" class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre_producto" class="form-control" id="producto-form-alta" placeholder="Ingrese el nombre del producto" required>
        </div>

        <!-- Mensaje de error para el campo nombre_producto -->
        <?php if($validation->getError('nombre_producto')) {?>
            <div class="alert alert-danger mt-2">
                <?php echo $validation->getError('nombre_producto') ?>
            </div>
        <?php }?>

        <!-- Selección de categoría -->
        <div class="mb-3">
            <label for="select-categoria" class="form-label">Categorias</label>
            <select class="form-select" id="select-categoria" name="categoria_id" aria-label="Seleccionar categoría" required>
                <option selected disabled>Selecciona una categoría</option>
                <!-- Se listan las categorías disponibles -->
                <?php foreach ($categorias as $categoria) {?>
                    <option class="text-capitalize" value="<?= $categoria['id_categoria'] ?>">
                        <?= $categoria['descripcion'] ?>
                    </option>
                <?php }?>
            </select>
        </div>

        <div class="row">
            <!-- Campo de precio -->
            <div class="col-6 mb-3">
                <label for="precio-form-alta" class="form-label" >Precio</label>
                <input type="number" name="precio" class="form-control" id="precio-form-alta" placeholder="Ingrese el precio del producto" required>
            </div>

            <!-- Campo de precio de venta -->
            <div class="col-6 mb-3">
                <label for="precio-vta-form-alta" class="form-label">Precio venta</label>
                <input type="number" name="precio-vta" class="form-control" id="precio-vta-form-alta" placeholder="Ingrese el precio de venta" required>
            </div>

            <!-- Mensajes de error para los campos precio y precio-vta -->
            <?php if($validation->getError('precio')) {?>
                <div class="alert alert-danger mt-2">
                    <?php echo $validation->getError('precio') ?>
                </div>
            <?php }?>

            <?php if($validation->getError('precio-vta')) {?>
                <div class="alert alert-danger mt-2">
                    <?php echo $validation->getError('precio-vta') ?>
                </div>
            <?php }?>

            <!-- Campo de stock -->
            <div class="col-6 mb-3">
                <label for="stock-form-alta" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock-form-alta" placeholder="Ingrese el stock del producto" required>
            </div>

            <!-- Campo de stock mínimo -->
            <div class="col-6 mb-3">
                <label for="stock-min-form-alta" class="form-label">Stock Mínimo</label>
                <input type="number" name="stock-min" class="form-control" id="stock-min-form-alta" placeholder="Ingrese el stock mínimo" required>
            </div>

            <!-- Mensajes de error para los campos stock y stock mínimo -->
            <?php if($validation->getError('stock')) {?>
                <div class="alert alert-danger mt-2">
                    <?php echo $validation->getError('stock') ?>
                </div>
            <?php }?>

            <?php if($validation->getError('stock-min')) {?>
                <div class="alert alert-danger mt-2">
                    <?php echo $validation->getError('stock-min') ?>
                </div>
            <?php }?>
        </div>

        <!-- Subida de imagen del producto -->
        <div class="mb-4 text-center">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/png, image/jpg, image/jpeg" required>

            <!-- Imagen previa -->
            <img id="preview-image" alt="Vista previa"
            style="display:none; margin: 15px auto 0 auto; width: 200px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">

        </div>

        <!-- Mensaje de error para el campo imagen -->
        <?php if($validation->getError('image')) {?>
            <div class="alert alert-danger mb-4">
                <?php echo $validation->getError('image') ?>
            </div>
        <?php }?>

        <!-- Botón para limpiar el formulario -->
        <button type="reset" class="btn btn-outline-light mt-3 d-block w-100">Reset</button>
        
        <!-- Botones de acción: enviar y salir -->
        <div class="d-flex justify-content-around mt-5">
            <button type="submit" class="ms-2 me-3 w-50 btn btn-outline-primary">Enviar</button>
            <a href="<?php echo base_url('/crud-productos')?>" class="ms-3 me-2 w-50 btn btn-outline-danger">Salir</a>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview-image');
    const form = document.getElementById('form-alta-producto');

    imageInput.addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.removeAttribute('src');
            preview.style.display = 'none';
        }
    });

    form.addEventListener('reset', function() {
        preview.removeAttribute('src');
        preview.style.display = 'none';
    });
</script>




