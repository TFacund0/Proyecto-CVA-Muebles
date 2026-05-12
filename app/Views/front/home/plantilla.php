<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/section-artisan.css?v=2.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Section Carrusel -->
    <?= view('front/home/section-carrusel') ?>

    <!-- Section Catalogo -->
    <?= view('front/home/section-catalogo') ?>    
<?= $this->endSection() ?>
