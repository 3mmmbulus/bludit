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

// Check that there is no direct script access.
if (!defined('FREELANCER') || !FREELANCER) {die();}

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
if (file_exists(THEME_DIR_CSS."freelancer_header.min.css")) {

  // Include the minified version.
  include(THEME_DIR_CSS."freelancer_header.min.css");

  // A minified version of the stylesheet does not exist.
} else {

  // Include the 'normal' version.
  include(THEME_DIR_CSS."freelancer_header.css");
}

// Add a CSS area - End.
echo "</style>\n";

// Load plugins with the hook 'siteHead'.
Theme::plugins('siteHead');

?>
