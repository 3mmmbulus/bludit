  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php echo Theme::headTitle(); ?>
  <?php echo Theme::headDescription(); ?>
  <?php echo Theme::css('css/style.css'); ?>

  <?php echo Theme::favicon('img/favicon.png'); ?>

  <!-- Load Bludit Plugins: Site head -->
  <?php Theme::plugins('siteHead'); ?>
