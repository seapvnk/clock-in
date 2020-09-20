<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?= APP_NAME ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-kit.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/styles.css">

    <?php if (isset($styles) && is_array($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="assets/css/<?= $style ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>

  </head>
  <body>
  
    <?php
      if (isset($templates) && is_array($templates)) {
        foreach ($templates as $template) {
          require_once VIEW_PATH . "/templates/${template}.php";
        }
      }
    ?>

    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>

    <script src="assets/js/plugins/bootstrap-switch.js"></script>

    <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <script src="assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
  </body>
</html>