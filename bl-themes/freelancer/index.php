<?php

// ----0--9--8--7--6--5--4--3--2--1--1--2--3--4--5--6--7--8--9--0---- //
// ================================================================== //
//                                                                    //
//                          Freelancer Theme                          //
//                                                                    //
//         A fast and responsive Bludit theme for freelancers.        //
//                                                                    //
//                       For Bludit version 3.x                       //
//                                                                    //
// ================================================================== //
//                                                                    //
//                      Version 3.0 / 03.07.2019                      //
//                                                                    //
//                      Copyright 2019 - PB-Soft                      //
//                                                                    //
//                         https://pb-soft.com                        //
//                                                                    //
//                           Patrick Biegel                           //
//                                                                    //
// ================================================================== //

// Define that the Freelancer theme is active.
define("FREELANCER", true);

// Include the theme configuration file.
include(THEME_DIR_PHP.'config/config.php');

// Check if the debug mode should be enabled.
if ($debug_mode) {

  // Display all errors.
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Begin of the HTML page.
echo "<!DOCTYPE html>\n";
echo "<html lang=\"".$language->currentLanguageShortVersion()."\">";

// Include the HTML head.
echo "<head>\n";
include(THEME_DIR_PHP.'top/head.php');
echo "</head>\n";

// Begin of the HTML body.
echo "<body>\n";

// Load all plugins with the hook 'siteBodyBegin'.
Theme::plugins('siteBodyBegin');

// Include the header (banner and title).
include(THEME_DIR_PHP.'top/header.php');

// Include the top navigation bar.
include(THEME_DIR_PHP.'top/navbar.php');

// Begin of the content container.
echo "<div class=container>\n";

// Check if the actual template is 'full width'.
if (substr($page->template(), -5) == "_full") {

  // Begin of the full column (main content).
  echo "<div class=full>\n";

  // The actual template is not 'full width'.
} else {

  // Begin of the middle column (main content).
  echo "<div class=middle>\n";
}

// Check if a special page template was specified and the template file exist.
if ($page->template() != "" && file_exists(THEME_DIR_PHP.'template/'.$page->template().'.php')) {

  // Include the specified template page.
  include(THEME_DIR_PHP.'template/'.$page->template().'.php');

  // Use the 'default' template.
} else {

    // Include the template for the 'default' page.
    include(THEME_DIR_PHP.'template/default.php');
}

// End of the full or middle column (main content).
echo "</div>\n";

// Check if the left column should be displayed.
if ($left_content != "none") {

  // Insert the left column.
  echo "<div class=left>\n";

  // Check if the content for the left column was specified and the template file exist.
  if ($left_content != "" && file_exists(THEME_DIR_PHP.'left/'.$left_content.'.php')) {

    // Include the specified template.
    include(THEME_DIR_PHP.'left/'.$left_content.'.php');

    // Use the 'default' template.
  } else {

      // Include the 'default' template.
      include(THEME_DIR_PHP.'left/default.php');
  }

  // Close the left column.
  echo "</div>\n";
}

// Check if the right column should be displayed.
if ($right_content != "none") {

  // Insert the right column.
  echo "<div class=right>\n";

  // Check if the content for the right column was specified and the template file exist.
  if ($right_content != "" && file_exists(THEME_DIR_PHP.'right/'.$right_content.'.php')) {

    // Include the specified template.
    include(THEME_DIR_PHP.'right/'.$right_content.'.php');

    // Use the 'default' template.
  } else {

      // Include the 'default' template.
      include(THEME_DIR_PHP.'right/default.php');
  }

  // Close the right column.
  echo "</div>\n";
}

// End of the content container.
echo "</div>\n";

// Footer
include(THEME_DIR_PHP.'bottom/footer.php');

// Begin of the inline JavaScript area.
echo "<script>\n";

// Check if the page was loaded.
echo "window.onload = function() {\n";

// Function to include a CSS file after the page has loaded - Begin.
echo "function includeCss(file) {\n";

// Create a new stylesheet element.
echo "var stylesheet = document.createElement('link');\n";

// Specify the source of the CSS file.
echo "stylesheet.href = file;\n";

// Specify the type of link.
echo "stylesheet.rel = 'stylesheet';\n";

// Insert the stylesheet before the closing 'head' element.
echo "document.getElementsByTagName('head')[0].appendChild(stylesheet);\n";

echo "};\n"; // Function to include a CSS file after the page has loaded - Begin.

// Check if a minimized version of the stylesheet exist.
if (file_exists(THEME_DIR_CSS."freelancer_footer.min.css")) {

  // Include the minimized version.
  echo "includeCss('".HTML_PATH_THEME_CSS."freelancer_footer.min.css');";

  // A minimized version of the stylesheet does not exist.
} else {

  // Include the 'normal' version.
  echo "includeCss('".HTML_PATH_THEME_CSS."freelancer_footer.css');";
}

// Check if the page was loaded.
echo "}\n";

// Check if a minimized version of the JavaScript file exist.
if (file_exists(THEME_DIR_JS."freelancer_footer.min.js")) {

  // Include the minimized version.
  include (THEME_DIR_JS."freelancer_footer.min.js");

  // A minimized version of the JavaScript file does not exist.
} else {

  // Include the 'normal' version.
  include (THEME_DIR_JS."freelancer_footer.js");
}

// End of the inline JavaScript area.
echo "</script>\n";

// Load plugins with the hook siteBodyBegin
Theme::plugins('siteBodyEnd');

// End of the HTML body.
echo "</body>\n";

// End of the HTML page.
echo "</html>\n";

?>
