<div class="container my-5 p-3 bg-secondary rounded">
    <form action="<?php echo base_url('/crud-usuarios'); ?>" method="POST" class="mb-3">
        <label for="option">Mostrar</label>
        
        <select class="form-select w-auto d-inline-block" name="option" id="option">
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
            
            <option value="1">1 usuarios</option>
            <option value="2">2 usuarios</option>
            <option value="3">3 usuarios</option>
            <option value="4">4 usuarios</option>
            <option value="5">5 usuarios</option>
            <option value="6">6 usuarios</option>
            <option value="7">7 usuarios</option>
            <option value="8">8 usuarios</option>
            <option value="9">9 usuarios</option>
            <option value="Todos">Todos</option>
        </select>

        <button type="submit" class="btn btn-outline-primary" href="<?php echo base_url('/crud-usuarios') ?>">Actualizar</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle bg-white">
            <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>email</th>
                    <th>perfil</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>                
                
                <?php $cant = 0;
                foreach ($usuarios as $usuario) {    

                    if($select > $cant || $select == 10) {?>
                        
                        <!--Si la session coincide con el id del usuario, no mostrar el botón de eliminar -->
                        <?php if (session()->get('id_usuario') == $usuario['id_usuario']) {?>
                            <tr class="text-black">
                                <td> <?php echo $usuario['id_usuario'] ?> </td>
                                <td> <?php echo $usuario['nombre'] ?> </td>
                                <td> <?php echo $usuario['apellido'] ?> </td>
                                <td> <?php echo $usuario['usuario'] ?> </td>
                                <td> <?php echo $usuario['email']?> </td>
                                <td> <?php echo $usuario['perfil']?> </td>
                                <td>Modificar</td>
                            </tr>
                        <?php } else { ?>
                            <tr class="text-black">
                                <td> <?php echo $usuario['id_usuario'] ?> </td>
                                <td> <?php echo $usuario['nombre'] ?> </td>
                                <td> <?php echo $usuario['apellido'] ?> </td>
                                <td> <?php echo $usuario['usuario'] ?> </td>
                                <td> <?php echo $usuario['email']?> </td>
                                <td> <?php echo $usuario['perfil']?> </td>
                                <td>Modificar - Eliminar</td>
                            </tr>
                            <?php $cant = $cant + 1;
                        <?php }?>
                    }
                }?>

            </tbody>
        </table>
    </div>
</div>
