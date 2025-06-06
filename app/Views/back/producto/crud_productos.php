<!-- Contenedor principal con márgenes y estilos de fondo -->
<div class="container my-5 p-3 bg-secondary rounded">

    <!-- Formulario para seleccionar cantidad de productos y vista -->
    <form action="<?php echo base_url('/crud-productos'); ?>" method="POST" class="mb-3">
        
        <!-- Etiqueta del selector -->
        <label for="option">Mostrar</label>
        
        <!-- Selector de cantidad de productos a mostrar -->
        <select class="form-select w-auto d-inline-block" name="option" id="option">
            
            <!-- Opción seleccionada dinámicamente según valor de $select -->
            <option selected disabled> 
                <?php 
                    if($select > 1 && $select < 10) {
                        echo $select . ' productos'; // Plural
                    } elseif ($select == 10){
                        echo 'Todos'; // Mostrar todos los productos
                    } else {
                        echo $select . ' producto'; // Singular
                    }
                ?> 
            </option>

            <!-- Opciones fijas para seleccionar cantidad de productos -->
            <option value="1">1 producto</option>
            <option value="2">2 productos</option>
            <option value="3">3 productos</option>
            <option value="4">4 productos</option>
            <option value="5">5 productos</option>
            <option value="6">6 productos</option>
            <option value="7">7 productos</option>
            <option value="8">8 productos</option>
            <option value="9">9 productos</option>
            <option value="Todos">Todos</option>
        </select>

        <!-- Botón para enviar el formulario y actualizar la vista -->
        <button type="submit" class="btn btn-outline-primary" href="<?php echo base_url('/crud-productos') ?>">Actualizar</button>

        <!-- Botón para redirigir al formulario de alta de productos -->
        <a class="btn btn-outline-primary" href="<?php echo base_url('/alta-producto') ?>">Agregar</a>
        
        <!-- Opción para mostrar productos activos -->
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="vista" id="activos" value="NO" <?= ($vista == 'NO') ? 'checked' : '' ?>>
            <label class="form-check-label" for="activos">Activos</label>
        </div>

        <!-- Opción para mostrar productos eliminados -->
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="vista" id="eliminados" value="SI" <?= ($vista == 'SI') ? 'checked' : '' ?>>
            <label class="form-check-label" for="eliminados">Eliminados</label>
        </div>
    </form>

    <!-- Tabla para mostrar los productos -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle bg-white">
            
            <!-- Cabecera de la tabla -->
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
                <?php 
                $cant = 0; // Contador de productos mostrados

                foreach ($productos as $producto) {
                    // Condición: mostrar solo la cantidad seleccionada o todos (10) y según vista (activos o eliminados)
                    if(($select > $cant || $select == 10) && ($producto['eliminado'] == $vista)) {?>
                        
                        <!-- Fila de producto -->
                        <tr class="text-black">
                            <td> <?php echo $producto['id_producto'] ?> </td>
                            <td> <?php echo $producto['nombre_prod'] ?> </td>
                            <td> $<?php echo $producto['precio'] ?> </td>
                            <td> $<?php echo $producto['precio_vta'] ?> </td>
                            <td> <?php echo $producto['stock']?> </td>
                            
                            <!-- Imagen del producto -->
                            <td class="text-center" style="width: 250px;">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" alt="Imagen producto" class="img-thumbnail" style="max-width: 200px; height: auto;">
                            </td>
                            
                            <!-- Acciones: modificar, eliminar o activar -->
                            <td>
                                <a class="btn btn-outline-primary" href="<?= base_url('/editar-producto/' . $producto['id_producto'] ) ?>">editar</a>
                                
                                <!-- Botón condicional según estado del producto -->
                                <?php if($vista == 'NO')  {?>
                                    <a class="btn btn-outline-danger" href="<?= base_url('/delete-producto/' . $producto['id_producto'] . '?vista=' . $vista) ?>">Eliminar</a>
                                <?php } elseif($vista == 'SI')  {?>
                                    <a class="btn btn-outline-success" href="<?= base_url('/activar-producto/' . $producto['id_producto'] . '?vista=' . $vista) ?>">Activar</a> 
                                <?php } ?>
                            </td>
                        </tr>
                <?php 
                        $cant = $cant + 1; // Incrementa el contador de productos mostrados
                    }
                }?>
            </tbody>
        </table>
    </div>
</div>
