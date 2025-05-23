<?php
    $session = session();
?>

<body>
    <?php if(!empty(session())) {?>
        <div class="alert alert-primary"><?php session()->getFlashData('msg_bienvenida')?></div>
    <?php }?>

    <!-- Section Carrusel -->
    <?= view('front/principal/section-carrusel') ?>

    <!-- Section Carrusel -->
    <?= view('front/principal/section-catalogo') ?>
    
</body>