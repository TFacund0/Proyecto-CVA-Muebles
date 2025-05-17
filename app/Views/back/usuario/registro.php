<div class="container my-5 p-3"> 
    <h3 class="text-center">Registrarse</h3>

    <?php $validation = \Config\Services::validation(); ?>
    
    <form class="" method="post" action="<?php echo base_url('/enviar-form') ?>">
        
        <?= csrf_field(); ?>
        <?php if (!empty(session()->getFlashdata('fail'))) {?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail'); ?></div>
        <?php }?>

        <?php if (!empty(session()->getFlashdata('success'))) {?>
            <div class="alert alert-danger"><?=session()->getFlashdata('success'); ?></div>
        <?php }?>
        
        <div class="mb-2 p-2">
            <!-- Campo para el nombre del formulario -->
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="name" placeholder="Escribe tu nombre" required>

            <!-- Validacion del campo nombre (Lado Servidor) -->
            <?php if($validation->getError('name')) {?>
                <div class="alert alert-danger mt-2">
                    <?php $error = $validation->getError('name'); ?>
                </div>
            <?php }?>

            <!-- Campo para el apellido del formulario -->
            <label for="nombre">Apellido</label>
            <input type="text" id="nombre" name="surname" placeholder="Escribe tu apellido" required>
            
            <!-- Validacion del campo apellido (Lado Servidor) -->
            <?php if($validation->getError('surname')) {?>
                <div class="alert alert-danger mt-2">
                    <?php $error = $validation->getError('surname'); ?>
                </div>
            <?php }?>
        </div>

        <div class="mb-2 p-2">
            <!-- Campo para el nombre de usuario del formulario -->
            <label for="nombre">Nombre de Usuario</label>
            <input type="text" id="nombre" name="user" placeholder="Escribe tu nombre de usuario" required>
            
            <!-- Validacion del campo nombre de usuario(Lado Servidor) -->
            <?php if($validation->getError('user')) {?>
                <div class="alert alert-danger mt-2">
                    <?php $error = $validation->getError('user'); ?>
                </div>
            <?php }?>
        </div>

        <div class="mb-2 p-2">
            <!-- Campo para el correo del formulario -->
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" placeholder="Escribe tu correo electrónico" required>

            <!-- Validacion del campo correo (Lado Servidor) -->
            <?php if($validation->getError('email')) {?>
                <div class="alert alert-danger mt-2">
                    <?php $error = $validation->getError('email'); ?>
                </div>
            <?php }?>
        </div>
        
        <div class="mb-2 p-2">
            <!-- Campo para la contraseña del formulario -->
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="pass" placeholder="Escribe tu contraseña" required>

            <!-- Validacion del campo contraseña (Lado Servidor) -->
            <?php if($validation->getError('pass')) {?>
                <div class="alert alert-danger mt-2">
                    <?php $error = $validation->getError('pass'); ?>
                </div>
            <?php }?>
        </div>

        <div class="mb-2 p-2">
            <input type="checkbox" id="check" required>
            <label for="check">Estoy de acuerdo con los <a href="<?php echo base_url('/terminosYCondiciones')?>" target="_blank">Terminos y Condiciones</a></label>            
        </div>

        <input type="submit" value="Registrar">
        <a href="<?php echo base_url('/login')?>">Ya tengo una cuenta</a>
    </form>
</div>