<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'titulo variable' ?></title>
    
    <link rel="stylesheet" href="assets/css/miestilo.css">
    <link rel="stylesheet" href="assets/css/carrusel.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/section.css">
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js" ></script>
    
</head>

<body>
    <!-- Barra de Navegacion -->
    <?= view('front/navbar') ?>

    <!-- Section Carrusel -->
    <?= view('front/section-carrusel', $footerData) ?>

    <!-- Section Carrusel -->
    <?= view('front/section-catalogo', $footerData) ?>

    <!-- Footer -->
    <?= view('front/footer', $footerData) ?>

</body>

</html>