<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'titulo variable' ?></title>

    <link rel="stylesheet" href="assets/css/a-styles/navbar.css">

    <link rel="stylesheet" href="assets/css/a-styles/miestilo.css">
    
    <link rel="stylesheet" href="assets/css/a-styles/quienesSomos.css">
    <link rel="stylesheet" href="assets/css/a-styles/contacto.css">

    <link rel="stylesheet" href="assets/css/a-styles/carrusel.css">
    <link rel="stylesheet" href="assets/css/a-styles/section.css">

    
    <link rel="stylesheet" href="assets/css/a-styles/footer.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="assets/js/bootstrap.bundle.min.js" ></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    <!-- Barra de Navegacion -->
    <?= view('front/navbar') ?>

    <main>
        <?= $content ?? '' ?>
    </main>

    
    <!-- Footer -->
    <?= view('front/footer', ['footerData' => $footerData]) ?>
</body>
</body>
