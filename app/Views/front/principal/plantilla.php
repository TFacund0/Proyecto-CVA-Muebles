<?php $session = session(); ?>

<body>
    <?php if (!empty(session()->getFlashdata('msg_bienvenida'))) {?>
        <div class="alert alert-primary text-center"><?=session()->getFlashdata('msg_bienvenida'); ?></div>
    <?php }?>

    <!-- Section Carrusel -->
    <?= view('front/principal/section-carrusel') ?>

    <!-- Section Carrusel -->
    <?= view('front/principal/section-catalogo') ?>    
</body>