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

// Check that there is no direct script access.
if(!defined('BLUE') || !BLUE) {die();}

// Specify the character set.
echo Theme::charset('utf-8');

// Specify the viewport.
echo Theme::viewport('width=device-width, initial-scale=1, shrink-to-fit=no');

// Specify the page title for the HTML header.
echo Theme::headTitle();

// Specify the page description for the HTML header.
echo Theme::headDescription();

// Add the path to the 'favicon'.
echo Theme::favicon('img/favicon.ico');

// Add a CSS area - Begin.
echo "<style>\n";

// Check if a minified version of the stylesheet exist.
if (file_exists(THEME_DIR_CSS."blue_header.min.css")) {

  // Include the minified version.
  include(THEME_DIR_CSS."blue_header.min.css");

  // A minified version of the stylesheet does not exist.
} else {

  // Include the 'normal' version.
  include(THEME_DIR_CSS."blue_header.css");
}

// Add a CSS area - End.
echo "</style>\n";

// Add a JavaScript area - Begin.
echo "<script>\n";

// Check if a minified version of the JavaScript file exist.
if (file_exists(THEME_DIR_JS."blue_header.min.js")) {

  // Include the minified version.
  include(THEME_DIR_JS."blue_header.min.js");

  // A minified version of the JavaScript file does not exist.
} else {

  // Include the 'normal' version.
  include(THEME_DIR_JS."blue_header.js");
}

// Add a JavaScript area - End.
echo "</script>\n";

// Load plugins with the hook 'siteHead'.
Theme::plugins('siteHead');
