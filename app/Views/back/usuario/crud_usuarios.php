<!-- Contenedor principal -->
<div class="crud-productos container my-5 p-3">

    <!-- Formulario superior -->
    <form action="<?php echo base_url('/crud-usuarios'); ?>" method="POST" class="crud-formulario mb-3">
        <div class="row g-3 align-items-end">

            <!-- Filtro: Cantidad a mostrar -->
            <div class="col-md-auto">
                <select class="form-select" name="option" id="option">
                    <option selected disabled> 
                        <?php 
                            if($select > 1 && $select < 10) {
                                echo $select . ' usuarios';
                            } elseif ($select == 10){
                                echo 'Todos';
                            } else {
                                echo $select . ' usuario';
                            }
                        ?> 
                    </option>
                    
                    <?php for ($i = 1; $i <= 9; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?> usuario<?= $i > 1 ? 's' : '' ?></option>
                    <?php endfor; ?>
                    
                    <option value="Todos">Todos</option>
                </select>
            </div>
            
            <!-- Filtro: Estado (activos / eliminados) -->
            <div class="col-md-auto d-flex align-items-center mb-1">
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vista" id="activos" value="NO" <?= ($vista == 'NO') ? 'checked' : '' ?>>
                    <label class="form-check-label text-secondary" for="activos">Activos</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vista" id="eliminados" value="SI" <?= ($vista == 'SI') ? 'checked' : '' ?>>
                    <label class="form-check-label text-secondary" for="eliminados">Eliminados</label>
                </div>

            </div>

            <!-- Botón actualizar -->
            <div class="col-md-auto ms-auto">
                <button type="submit" class="btn btn-outline-light">Actualizar</button>
            </div>

        </div>
    </form>

    <!-- Tabla de usuarios -->
    <div class="crud-tabla table-responsive shadow-lg rounded border border-dark-subtle">
        <table class="table table-bordered text-center align-middle" style="background-color: #f8f9fa; border-color: #343a40;">
            <thead class="text-dark">
                <tr>
                    <th class="border-dark">ID</th>
                    <th class="border-dark">Nombre</th>
                    <th class="border-dark">Apellido</th>
                    <th class="border-dark">Usuario</th>
                    <th class="border-dark">Email</th>
                    <th class="border-dark">Perfil</th>
                    <th class="border-dark">Acción</th>
                </tr>
            </thead>
            <tbody>          
                <?php foreach ($usuarios as $usuario): ?>
                    <?php if (session()->get('id_usuario') == $usuario['id_usuario']): ?>
                        <tr class="text-black border-dark">
                            <td><?= $usuario['id_usuario'] ?></td>
                            <td><?= $usuario['nombre'] ?></td>
                            <td><?= $usuario['apellido'] ?></td>
                            <td><?= $usuario['usuario'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['perfil'] ?></td>
                            <td><a class="btn btn-outline-primary btn-sm" href="<?= base_url('/editar-usuario/' . $usuario['id_usuario']) ?>">Modificar perfil</a></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>      
                <?php $cant = 1;
                foreach ($usuarios as $usuario) {
                    if(($select > $cant || $select == 10) && ($usuario['baja'] == $vista) && (session()->get('id_usuario') != $usuario['id_usuario'])) { ?>
                        <tr class="text-black border-dark">
                            <td><?php echo $usuario['id_usuario'] ?></td>
                            <td><?php echo $usuario['nombre'] ?></td>
                            <td><?php echo $usuario['apellido'] ?></td>
                            <td><?php echo $usuario['usuario'] ?></td>
                            <td><?php echo $usuario['email'] ?></td>
                            <td><?php echo $usuario['perfil'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url('/editar-usuario/' . $usuario['id_usuario']) ?>">cambiar a admin/usuario</a>
                                    <?php if($vista == 'NO') { ?>
                                    <a class="btn btn-outline-danger btn-sm" href="<?= base_url('/delete-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>">Eliminar</a>
                                <?php } else { ?>
                                    <a class="btn btn-outline-success btn-sm" href="<?= base_url('/activar-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>">Activar</a> 
                                <?php } ?>
                                </div>
                                <?php $cant++; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

