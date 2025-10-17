<?php

// ----0--9--8--7--6--5--4--3--2--1--1--2--3--4--5--6--7--8--9--0---- //
// ================================================================== //
//                                                                    //
//                             Blue Theme                             //
//                                                                    //
//        A blue, fast and responsive theme for the Maigewan CMS.       //
//                                                                    //
//                       For Maigewan version 3.x                       //
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

// Display the gallery title.
echo "<h1 class=column-title>".$gallery_title."</h1>\n";

// Initialize the descriptions array.
$descriptions = array();

// Check if a description file exist.
if (file_exists($description_file)) {

  // Get the content of the description file.
  $content = file($description_file);

  // Loop through the lines of the content.
  foreach($content as $value) {

    // Get the image name and description out of the line content.
    $parts = explode("<=D=>", $value);

    // Save the description into the 'descriptions' array.
    $descriptions[trim($parts[0])] = trim($parts[1]);
  }
}

// Loop through all the image files in the right sidebar.
foreach(glob(THEME_DIR_IMG."right/{*.[gG][iI][fF],*.[jJ][pP][gG],*.[jJ][pP][eE][gG],*.[pP][nN][gG]}", GLOB_BRACE) as $image) {

  // Check if no image description was specified.
  if (empty($descriptions) || !isset($descriptions[basename($image)])) {

    // Set the image description to an empty string.
    $descriptions[basename($image)] = "";
  }

  // Display the image in the right sidebar.
  echo "<div class=img-right>\n";
	echo "<img src=\"".HTML_PATH_THEME_IMG."right/".basename($image)."\" onclick=showImage(this) alt=\"".$descriptions[basename($image)]."\">\n";
  echo "</div>\n";
}

?>
