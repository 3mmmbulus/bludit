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

// Loop through the different posts - Begin.
foreach ($content as $page) {

  // Display the page title link - Begin.
  echo "<a href=\"".$page->permalink()."\">\n";

  // Display the page title.
  echo "<h3 class=page-title>".$page->title()."</h3>\n";

  // Display the page title link - End.
  echo "</a>\n";

  // Check if the actual page has a description.
  if ($page->description()) {

    // Display the page description.
    echo "<h5 class=page-description>".$page->description()."</h5>\n";
  }

  // Display the page creation date.
  echo "<div class=page-creation>\n";
  echo $page->date()." - ".$language->get('Reading time').": ".$page->readingTime()."\n";
  echo "</div>\n";

  // Display the part of the content until the pagebreak.
  echo "<div class=page-content>\n";
  echo $page->contentBreak()."\n";
  echo "</div>\n";

  // Check if the page contains a pagebreak.
  if ($page->readMore()) {

    // Display the 'Read more' link.
    echo "<div class=read-more>\n";
    echo "<a href=\"".$page->permalink()."\">".$language->get('Read more')."</a>\n";
    echo "</div>\n";
  }

  // Add a divider to separate the posts.
  echo "<hr class=post-divider>";

} // Loop through the different posts - End.

?>
