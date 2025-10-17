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
$left_content = "none";
$right_content = "none";

// Load plugins - Hook: 'siteBodyBegin'.
Theme::plugins('pageBegin');

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

// Get the portfolio category object with all the data.
$category = getCategory('portfolio');

// Loop through the portfolio items.
foreach ($category->pages() as $page_key) {

  // Get a page object with the data of the portfolio item.
  $portfolio_item = new Page($page_key);

  // Display the portfolio item - Begin.
  echo "<div class=img-full>\n";

  // Display the page title.
  echo "<h4 class=post-title><a href=\"".$portfolio_item->permalink()."\">".$portfolio_item->title()."</a></h4>\n";

  // Add a link to the page - Begin.
  echo "<a href=\"".$portfolio_item->permalink()."\" title=\"".$portfolio_item->title()."\">\n";

  // Check if a cover image for this page is available.
  if ($portfolio_item->thumbCoverImage()) {

    // Display the cover image of the page.
    echo "<img src=\"".$portfolio_item->thumbCoverImage()."\" alt=\"".$portfolio_item->title()."\">\n";
  }

  // Add a link to the page - End.
  echo "</a>\n";

  // Display the portfolio item - Begin.
  echo "</div>\n";
}

// Load plugins - Hook: 'pageEnd'.
Theme::plugins('pageEnd');

?>
