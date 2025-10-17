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

// Specify the content of the left/right column.
$left_content = "news";
$right_content = "portfolio";

// Load plugins - Hook: 'siteBodyBegin'.
Theme::plugins('pageBegin');

// Display the whole page content - Begin.
echo "<div class=page-content>\n";

// Display the content box - Begin.
echo "<div class=content-box>\n";

// Check if a cover image for this post is available.
if ($page->coverImage()) {

  // Display the cover image of the post.
  echo "<img src=\"".$page->coverImage()."\" alt=\"".$page->title()."\">\n";
}

// Display the text content of the post.
echo $page->content()."\n";

// Display the content box - End.
echo "</div>\n";

// Display the whole page content - End.
echo "</div>\n";

// Load plugins - Hook: 'pageEnd'.
Theme::plugins('pageEnd');

?>
