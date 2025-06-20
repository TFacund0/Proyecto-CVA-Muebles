<!-- 
  =============================================
  CRUD DE PRODUCTOS
  Interfaz para gestionar productos (Crear, Leer, Actualizar, Eliminar)
  =============================================
-->

<!-- Contenedor principal del CRUD -->
<div class="crud-productos container my-5 p-3">

    <!-- 
      FORMULARIO DE FILTROS
      Permite controlar qué productos se muestran
    -->
    <form action="<?php echo base_url('/crud-productos'); ?>" method="POST" class="crud-formulario mb-3">
        <div class="row g-3 align-items-end">
            
            <!-- Filtro: Cantidad de productos a mostrar -->
            <div class="col-md-auto">
                <select class="form-select" name="option" id="option">
                    <!-- Opción seleccionada actualmente -->
                    <option selected disabled> 
                        <?php 
                            if($select > 1 && $select < 10) {
                                echo $select . ' productos';
                            } elseif ($select == 10){
                                echo 'Todos';
                            } else {
                                echo $select . ' producto';
                            }
                        ?> 
                    </option>
                    
                    <!-- Opciones numéricas del 1 al 9 -->
                    <?php for ($i = 1; $i <= 9; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?> producto<?= $i > 1 ? 's' : '' ?></option>
                    <?php endfor; ?>
                    
                    <!-- Opción para mostrar todos -->
                    <option value="Todos">Todos</option>
                </select>
            </div>

            <!-- Filtro: Estado de productos (activos/eliminados) -->
            <div class="col-md-auto d-flex align-items-center mb-1">
                
                <!-- Radio button para productos activos -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vista" id="activos" value="NO" <?= ($vista == 'NO') ? 'checked' : '' ?>>
                    <label class="form-check-label text-secondary" for="activos">Activos</label>
                </div>
                
                <!-- Radio button para productos eliminados -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vista" id="eliminados" value="SI" <?= ($vista == 'SI') ? 'checked' : '' ?>>
                    <label class="form-check-label text-secondary" for="eliminados">Eliminados</label>
                </div>

            </div>

            <!-- Botones de acción -->
            <div class="col-md-auto ms-auto">
                <div class="d-flex gap-2">
                    <!-- Botón para aplicar filtros -->
                    <button type="submit" class="btn btn-outline-light">Actualizar</button>
                    <!-- Botón para agregar nuevo producto -->
                    <a class="btn btn-outline-light" href="<?php echo base_url('/alta-producto') ?>">Agregar</a>
                </div>
            </div>

        </div>
    </form>


    <!-- 
      TABLA DE PRODUCTOS
      Muestra los productos según los filtros aplicados
    -->
    <div class="crud-tabla table-responsive shadow-lg rounded border border-dark-subtle">
        <table class="table table-bordered text-center align-middle" style="background-color: #f8f9fa; border-color: #343a40;">
            <!-- Cabecera de la tabla -->
            <thead class="text-dark">
                <tr>
                    <th class="border-dark">ID</th>
                    <th class="border-dark">Producto</th>
                    <th class="border-dark">Precio</th>
                    <th class="border-dark">Precio Venta</th>
                    <th class="border-dark">Stock</th>
                    <th class="border-dark">Imagen</th>
                    <th class="border-dark">Acción</th>
                </tr>
            </thead>
            
            <!-- Cuerpo de la tabla -->
            <tbody>
                <?php 
                $cant = 0;
                foreach ($productos as $producto) {
                    // Filtra productos según selección y estado
                    if(($select > $cant || $select == 10) && ($producto['eliminado'] == $vista)) { ?>
                        <tr class="text-black border-dark">
                            <td><?php echo $producto['id_producto'] ?></td>
                            <td><?php echo $producto['nombre_prod'] ?></td>
                            <td>$<?php echo $producto['precio'] ?></td>
                            <td>$<?php echo $producto['precio_vta'] ?></td>
                            <td><?php echo $producto['stock'] ?></td>
                            <td class="text-center" style="width: 250px;">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                                     alt="Imagen producto" 
                                     class="img-producto img-thumbnail border border-dark" 
                                     style="max-width: 200px; width: 150px; height: auto;">
                            </td>
                            <td class="border-dark m-auto">
                                <!-- Botón de edición -->
                                <a class="btn btn-outline-primary btn-sm mb-1" 
                                   href="<?= base_url('/editar-producto/' . $producto['id_producto']) ?>">
                                   Editar
                                </a>
                                
                                <?php if($vista == 'NO') { ?>
                                    <!-- Botón para eliminar (si está viendo activos) -->
                                    <a class="btn btn-outline-danger btn-sm mb-1" 
                                       href="<?= base_url('/delete-producto/' . $producto['id_producto'] . '?vista=' . $vista) ?>">
                                       Eliminar
                                    </a>
                                <?php } else { ?>
                                    <!-- Botón para activar (si está viendo eliminados) -->
                                    <a class="btn btn-outline-success btn-sm mb-1" 
                                       href="<?= base_url('/activar-producto/' . $producto['id_producto'] . '?vista=' . $vista) ?>">
                                       Activar
                                    </a> 
                                <?php } ?>
                            </td>
                        </tr>
                <?php 
                        $cant++;
                    }
                } ?>
            </tbody>
        </table>
    </div>

</div>