<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title ?? 'titulo variable' ?></title>
    
    <link rel="stylesheet" href="assets/css/miestilo.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js" ></script>
    
</head>

  <body>
      <!-- Barra de Navegacion -->
      <?= view('front/navbar') ?>

      <!-- Contenido principal -->
      <main>
          <h1 class="animation"><?= esc($title) ?></h1>
      </main>

      <!-- Footer -->
      <?= view('front/footer', $footerData) ?>

  </body>
  
</html>