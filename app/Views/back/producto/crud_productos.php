<div class="container my-5 p-3 bg-secondary rounded">
    <form action="<?php echo base_url('/crud-productos'); ?>" method="POST" class="mb-3">
        <label for="option">Mostrar</label>
        
        <select class="form-select w-auto d-inline-block" name="option" id="option">
            <option selected disabled> 
                <?php 
                    if($select == 10) {
                        echo 'Todos';
                    } else {
                        echo $select; 
                    }
                ?> 
            </option>
            
            <option value="1 producto">1 producto</option>
            <option value="2 productos">2 productos</option>
            <option value="3 productos">3 productos</option>
            <option value="4 productos">4 productos</option>
            <option value="5 productos">5 productos</option>
            <option value="6 productos">6 productos</option>
            <option value="7 productos">7 productos</option>
            <option value="8 productos">8 productos</option>
            <option value="9 productos">9 productos</option>
            <option value="Todos">Todos</option>
        </select>

        <button type="submit" class="btn btn-outline-primary" href="<?php echo base_url('/crud-productos') ?>">Actualizar</button>
        <a class="btn btn-outline-primary" href="<?php echo base_url('/alta-producto') ?>">Agregar</a>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle bg-white">
            <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>                
                
                <?php $cant = 0;
                foreach ($productos as $producto) {
                    $cant = $cant + 1;
                    
                    if($select >= $cant || $select == 10) {?>
                        <tr class="text-black">
                            <td> <?php echo $producto['id_producto'] ?> </td>
                            <td> <?php echo $producto['nombre_prod'] ?> </td>
                            <td> $<?php echo $producto['precio'] ?> </td>
                            <td> $<?php echo $producto['precio_vta'] ?> </td>
                            <td> <?php echo $producto['stock']?> </td>
                            <td class="text-center" style="width: 250px;">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" alt="Imagen producto" class="img-thumbnail" style="max-width: 200px; height: auto;">
                            </td>
                            <td>Modificar - Eliminar</td>
                        </tr>
                <?php }
                }?>

            </tbody>
        </table>
    </div>
</div>
