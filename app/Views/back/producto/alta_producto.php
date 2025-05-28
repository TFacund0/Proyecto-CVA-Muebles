<div class="container my-5 w-50 p-5" id="alta-producto-contenedor">
    <h3 class="text-center mb-3 titulo-form-alta-producto">Formulario de Alta de producto</h3>
        <?php $validation = \Config\Services::validation(); ?>

        <?php if(session()->getFlashData('success')) {?>
            <div class="alert alert-primary text-center"><?php echo session()->getFlashData('success');?></div>
        <?php }?>

        <?php if(session()->getFlashData('fail')) {?>
            <div class="alert alert-danger text-center"><?php echo session()->getFlashData('fail');?></div>
        <?php }?>

        <form method="post" action="<?php echo base_url('/enviar-alta-producto') ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="producto-form-alta" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre_producto" class="form-control" id="producto-form-alta" placeholder="Ingrese el nombre del producto" required>
            </div>

            <?php if($validation->getError('nombre_producto')) {?>
                    <div class="alert alert-danger mt-2">
                        <?php echo $validation->getError('nombre_producto') ?>
                    </div>
            <?php }?>

            <div class="mb-3">
                <label for="select-categoria" class="form-label">Categorias</label>
                <select class="form-select" id="select-categoria" name="categoria_id" aria-label="Seleccionar categoría" required>
                    <option selected disabled>Selecciona una categoría</option>
                
                    <?php foreach ($categorias as $categoria) {?>
                        <option class="text-capitalize" value="<?= $categoria['id_categoria'] ?>">
                            <?= $categoria['descripcion'] ?>
                        </option>
                    <?php }?>
                </select>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="precio-form-alta" class="form-label" >Precio</label>
                    <input type="number" name="precio" class="form-control" id="precio-form-alta" placeholder="Ingrese el precio del producto" required>
                </div>

                <div class="col-6 mb-3">
                    <label for="precio-vta-form-alta" class="form-label">Precio venta</label>
                    <input type="number" name="precio-vta" class="form-control" id="precio-vta-form-alta" placeholder="Ingrese el precio de venta" required>
                </div>

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
            
                <div class="col-6 mb-3">
                    <label for="stock-form-alta" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock-form-alta" placeholder="Ingrese el stock del producto" required>
                </div>

                <div class="col-6 mb-3">
                    <label for="stock-min-form-alta" class="form-label">Stock Mínimo</label>
                    <input type="number" name="stock-min" class="form-control" id="stock-min-form-alta" placeholder="Ingrese el stock mínimo" required>
                </div>

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
            
            <div class="mb-4">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/png, image/jpg, image/jpeg" required>
            </div>

            <?php if($validation->getError('image')) {?>
                    <div class="alert alert-danger mb-4">
                        <?php echo $validation->getError('image') ?>
                    </div>
            <?php }?>

            <button type="reset" class="btn btn-outline-light mt-3 d-block w-100">Reset</button>
            
            <div class="d-flex justify-content-around mt-5">
                <button type="submit" class="ms-2 me-3 w-50 btn btn-outline-primary">Enviar</button>
                <a href="<?php echo base_url('/')?>" class="ms-3 me-2 w-50 btn btn-outline-danger">Salir</a>
            </div>
        </form>
</div>