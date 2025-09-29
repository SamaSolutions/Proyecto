<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SAMA Solutions' ?></title>
   <link rel="icon" href="/images/icono.ico" type"image/X-icon">
   <link rel="stylesheet" href="/css/styles.css" />
</head>
<body>
    <header>
        <?php $this->component('navigation') ?>
    </header>

    <main class="container">
        <?php $this->component('flash-messages') ?>
		<?= $content ?>
        </main>
     <footer class="footer">
      <?php $this->component('footer') ?>
     </footer>
</body>
</html>
