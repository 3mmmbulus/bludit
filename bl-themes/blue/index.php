<?php

// ----0--9--8--7--6--5--4--3--2--1--1--2--3--4--5--6--7--8--9--0---- //
// ================================================================== //
//                                                                    //
//                             Blue Theme                             //
//                                                                    //
//        A blue, fast and responsive theme for the Bludit CMS.       //
//                                                                    //
//                       For Bludit version 3.x                       //
//                                                                    //
// ================================================================== //
//                                                                    //
//                      Version 3.0 / 09.12.2018                      //
//                                                                    //
//                      Copyright 2018 - PB-Soft                      //
//                                                                    //
//                         https://pb-soft.com                        //
//                                                                    //
//                           Patrick Biegel                           //
//                                                                    //
// ================================================================== //

// Define that the Blue theme is active.
define("BLUE", true);

// Include the configuration file.
include(THEME_DIR_PHP.'config.php');

// Check if debugging should be enabled.
if ($debug_mode) {

  // Display all errors.
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

?>
<!-- Begin of the HTML page. -->
<!DOCTYPE html>
<html lang="<?php echo $language->currentLanguageShortVersion() ?>">

  <!-- Include the HTML header. -->
  <head>
    <?php include(THEME_DIR_PHP.'header.php'); ?>
  </head>

  <!-- Begin of the HTML body. -->
  <body>

    <!-- Load all plugins with the hook 'siteBodyBegin'. -->
    <?php Theme::plugins('siteBodyBegin') ?>

    <!-- Begin of the title header (banner). -->
    <div class=header>

      <!-- Begin of the blue filter covering the banner. -->
      <div class=filter>

        <!-- Begin of the title/subtitle box. -->
        <div class=title-box>

          <!-- Display the page title. -->
          <h1><?php echo $site->title() ?></h1>

          <!-- Display the page subtitle. -->
          <p class=subtitle><?php echo $site->slogan() ?></p>

        <!-- End of the title/subtitle box. -->
        </div>

      <!-- End of the blue filter covering the banner. -->
      </div>

    <!-- End of the title header (banner). -->
    </div>

    <!-- Include the top navigation bar. -->
    <?php include(THEME_DIR_PHP.'navbar.php'); ?>

    <!-- Begin of the content container. -->
    <div class=container>


      <!-- Begin of the middle column (main content). -->
      <div class=middle>

        <?php

          // Check if the actual page is a 'normal' page.
          if ($WHERE_AM_I == 'page') {

            // Include the template for the 'normal' page.
            include(THEME_DIR_PHP.'page.php');

            // The actual page has to be the 'home' page.
          } else {

            // Include the template for the 'home' page.
            include(THEME_DIR_PHP.'home.php');
          }

        ?>

      <!-- End of the middle column (main content). -->
      </div>

      <!-- Insert the left column (posts). -->
      <div class=left>
        <?php include(THEME_DIR_PHP.'left.php'); ?>
      </div>

      <!-- Insert the right column (gallery). -->
      <div class=right>
        <?php include(THEME_DIR_PHP.'right.php'); ?>
      </div>

    <!-- End of the content container. -->
    </div>

    <!-- Begin of the modal window for the big images. -->
    <div id=img-box>

      <!-- Close button for the modal window. -->
      <div class=close-x onclick="hideImage()"></div>

      <!-- Begin of the vie container (contains the image and description). -->
      <div class=img-view>

        <!-- Add the big image. -->
        <img id=img-big src="#" alt="Image">

        <!-- Add the image description. -->
        <p id=img-info></p>

      <!-- End of the vie container (contains the image and description). -->
      </div>

    <!-- End of the modal window for the big images. -->
    </div>

    <!-- Footer -->
    <?php include(THEME_DIR_PHP.'footer.php'); ?>

    <!-- Begin of the inline JavaScript area. -->
    <script>

      // Check if the page was loaded.
      window.onload = function() {

        // Function to include a CSS file after the page has loaded - Begin.
        function includeCss(file) {

          // Create a new stylesheet element.
          var stylesheet = document.createElement('link');

          // Specify the source of the CSS file.
          stylesheet.href = file;

          // Specify the type of link.
          stylesheet.rel = 'stylesheet';

          // Insert the stylesheet before the closing 'head' element.
          document.getElementsByTagName('head')[0].appendChild(stylesheet);

        }; // Function to include a CSS file after the page has loaded - End.

        <?php

          // Check if a minimized version of the stylesheet exist.
          if (file_exists(THEME_DIR_CSS."blue_footer.min.css")) {

            // Include the minimized version.
            echo "includeCss('".HTML_PATH_THEME_CSS."blue_footer.min.css');";

            // A minimized version of the stylesheet does not exist.
          } else {

            // Include the 'normal' version.
            echo "includeCss('".HTML_PATH_THEME_CSS."blue_footer.css');";
          }

        ?>

      } // Check if the page was loaded.

      <?php

        // Check if a minimized version of the JavaScript file exist.
        if (file_exists(THEME_DIR_JS."blue_footer.min.js")) {

          // Include the minimized version.
          include (THEME_DIR_JS."blue_footer.min.js");

          // A minimized version of the JavaScript file does not exist.
        } else {

          // Include the 'normal' version.
          include (THEME_DIR_JS."blue_footer.js");
        }

      ?>

    // End of the inline JavaScript area.
    </script>

    <!-- Load plugins with the hook siteBodyBegin -->
    <?php Theme::plugins('siteBodyEnd') ?>

  <!-- Begin of the HTML body. -->
  </body>

<!-- End of the HTML page. -->
</html>
