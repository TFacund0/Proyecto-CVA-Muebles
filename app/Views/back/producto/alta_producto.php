<div class="container bg-secondary my-5 w-50 p-5">
    <div class="">
        <h3 class="text-center">Formulario de Alta de producto</h3>
        
        <form class="" method="post" action="<?php echo base_url('/enviar-alta-producto') ?>">
            
            <div class="mb-3">
                <label for="select-categoria" class="form-label">Categorias</label>
                <select class="form-select" id="select-categoria" name="categoria_id" aria-label="Seleccionar categoría">
                <option selected disabled>Selecciona una categoría</option>
                
                <?php foreach ($categorias as $categoria) {?>
                    <option class="text-capitalize" value="<?= $categoria['id_categoria'] ?>">
                        <?= $categoria['descripcion'] ?>
                    </option>
                <?php }?>
            </select>

            </div>
            
            <div class="mb-3">
                <label for="producto-form-alta" class="form-label">Producto</label>
                <input type="text" class="form-control" id="producto-form-alta" >
            </div>

            <div class="mb-3">
                <label for="precio-form-alta" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio-form-alta">
            </div>

            <div class="mb-3">
                <label for="precio-vta-form-alta" class="form-label">Precio venta</label>
                <input type="number" class="form-control" id="precio-vta-form-alta">
            </div>

            <div class="mb-3">
                <label for="stock-form-alta" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock-form-alta">
            </div>

            <div class="mb-3">
                <label for="stock-min-form-alta" class="form-label">Stock Mínimo</label>
                <input type="number" class="form-control" id="stock-min-form-alta">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            <a href="<?php echo base_url('/')?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>