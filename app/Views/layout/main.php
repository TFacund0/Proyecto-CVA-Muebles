<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'CVA Muebles' ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Design System & Global Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/base/global.css?v=3.0')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/layout/main-layout.css?v=3.0')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/miestilo.css?v=1.2')?>">

    <!-- Page Specific CSS Section -->
    <?= $this->renderSection('extra-css') ?>

    <script src="<?= base_url('assets/vendor/bootstrap/bootstrap.bundle.min.js')?>" ></script>
</head>
<body>
    <!-- Barra de Navegacion -->
    <?= view('partials/navbar') ?>

    <main>
        <?php if (isset($content)): ?>
            <?= $content ?>
        <?php else: ?>
            <?= $this->renderSection('content') ?>
        <?php endif; ?>
    </main>
    
    <!-- Footer -->
    <?= view('partials/footer') ?>

    <!-- Page Specific JS Section -->
    <?= $this->renderSection('extra-js') ?>
</body>
</html>
