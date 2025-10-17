<!DOCTYPE html>
<html lang="<?php echo $language->currentLanguageShortVersion() ?>">
<head>
    <?php include(THEME_DIR_PHP.'head.php') ?>
</head>
  <body>

    <!-- Load plugins siteBodyBegin -->
    <?php Theme::plugins('siteBodyBegin') ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="<?php echo $site->url() ?>"><?php echo $site->title() ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <?php echo $language->get('Menu') ?><i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $site->url() ?>"><?php echo $language->get('Home') ?></a>
            </li>
            <?php
                foreach ($staticContent as $staticPage) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="'.$staticPage->permalink().'">'.$staticPage->title().'</a>';
                    echo '</li>';
                }
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <?php
        if ($WHERE_AM_I=='page') {
            include(THEME_DIR_PHP.'page.php');
        } else {
            include(THEME_DIR_PHP.'home.php');
        }
    ?>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
            <?php foreach ($socialNetworks as $key=>$label): ?>
                <?php if ($site->{$key}()): ?>
                <li class="list-inline-item">
                    <a href="<?php echo $site->{$key}() ?>" target="_blank">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-<?php echo $key ?>"></i>
                        </span>
                    </a>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
            <p class="copyright text-muted"><?php echo $site->footer() ?> - Powered by <a href="https://www.bludit.com">BLUDIT</a></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Javascript -->
    <?php echo Theme::jquery() ?>
    <?php echo Theme::jsBootstrap(); ?>
    <?php echo Theme::js('js/clean-blog.min.js') ?>

    <!-- Load plugins siteBodyEnd -->
    <?php Theme::plugins('siteBodyEnd') ?>

  </body>
</html>