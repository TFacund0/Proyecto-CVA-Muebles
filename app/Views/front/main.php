<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'titulo variable' ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/navbar.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/miestilo.css')?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/productos.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/quienesSomos.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/contacto.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/comercializacion.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/condiciones.css')?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/usuario/registro.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/usuario/login.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/usuario/perfil_config.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/producto/crud_product.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/producto/alta_product.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/producto/editar_product.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/back/ventas/detalle_ventas.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/carrusel.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/section.css')?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/a-styles/footer.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>">

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>" ></script>
    
</head>
<body>
    <!-- Barra de Navegacion -->
    <?= view('front/navbar') ?>

    <main>
        <?= $content ?? '' ?>
    </main>
    
    <!-- Footer -->
    <?= view('front/footer') ?>
</body>
</body>
