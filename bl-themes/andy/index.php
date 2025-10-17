<!DOCTYPE html>
<html lang="en-EN">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <meta name="generator" content="Bludit">

  <!-- Dynamic title tag -->
  <?php echo Theme::metaTagTitle(); ?>

  <!-- Dynamic description tag -->
  <?php echo Theme::metaTagDescription(); ?>

  <!-- Include Favicon -->
  <?php echo Theme::favicon('assets/img/favicon.png'); ?>

  <!-- Include CSS Styles from this theme -->
  <?php echo Theme::css('assets/css/all.min.css'); ?>
  <?php echo Theme::css('assets/css/style.css'); ?>

  <!-- Load Bludit Plugins: Site head -->
  <?php Theme::plugins('siteHead'); ?>

</head>

<body class="home blog wp-embed-responsive right-sidebar nav-below-header fluid-header separate-containers active-footer-widgets-3 nav-aligned-left header-aligned-left dropdown-hover">
  <div class="wrapper">

    <!-- Load Bludit Plugins: Site Body Begin -->
    <?php Theme::plugins('siteBodyBegin'); ?> 
    <!-- ------------------------------------ -->


    <!-- header -->
    <header id="masthead" class="site-header">
      <div class="inside-header grid-container grid-parent">
        <div class="site-branding">
          <h1 class="main-title" itemprop="headline">
            <a href="<?php echo $site->url() ?>" rel="home">
              <?php echo $site->title() ?>
            </a>
          </h1>
          <p class="site-description" itemprop="description">
            <?php echo $site->slogan() ?>
          </p>
        </div>
      </div>
    </header>
    <!-- -------->


    <!-- include navigation bar -->
    <?php include(THEME_DIR_PHP . 'navbar.php'); ?>
    <!-- ---------------------- -->


    <div id="page" class="hfeed site grid-container container grid-parent">
      <div id="content" class="site-content">
        
        <?php
        // Bludit content are pages
        // But if you order the content by date
        // These pages works as posts

        // $WHERE_AM_I variable detect where the user is browsing
        // If the user is watching a particular page/post the variable takes the value "page"
        // If the user is watching the frontpage the variable takes the value "home"
        if ($WHERE_AM_I == 'page') {
          include(THEME_DIR_PHP . 'page.php');
        } else {
          include(THEME_DIR_PHP . 'home.php');
        }
        ?>

        <!-- right side bar include -->
        <div id="right-sidebar" class="widget-area grid-25 tablet-grid-25 grid-parent sidebar" itemtype="https://schema.org/WPSideBar" itemscope="">
          <div class="inside-right-sidebar">
            <?php include(THEME_DIR_PHP . 'sidebar.php'); ?>
          </div>
        </div>
        <!-- ---------------------- -->

      </div><!-- #content -->

    </div><!-- #page --> 
    
  </div><!-- .wrapper -->


  <?php Theme::plugins('siteBodyEnd'); ?>

  <?php include(THEME_DIR_PHP . 'footer.php'); ?>


  <?php
    echo Theme::js('assets/js/menu.min.js');
    echo Theme::js('assets/js/a11y.min.js');
  ?>

</body>
</html>