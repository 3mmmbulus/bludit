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

// Get the blog category object with all the data.
$category = getCategory('news');

// Display the blog title.
echo "<h1 class=column-title>".$blog_name."</h1>\n";

// Initialize the post counter.
$post_counter = 0;

// Loop through the blog items.
foreach ($category->pages() as $post_key) {

  // Increase the post counter.
  $post_counter++;

  // Get a page object with the data of the blog item.
  $blog_item = new Page($post_key);

  // Add a link to the post - Begin.
  echo "<a href=\"".$blog_item->permalink()."\" title=\"".$blog_item->title()."\">\n";

  // Check if a cover image for this post is available.
  if ($blog_item->thumbCoverImage()) {

    // Display the cover image of the post.
    echo "<img src=\"".$blog_item->thumbCoverImage()."\" alt=\"".$blog_item->title()."\">\n";
  }

  // Add a link to the post - End.
  echo "</a>\n";

  // Display the post title.
  echo "<h4 class=post-title><a href=\"".$blog_item->permalink()."\">".$blog_item->title()."</a></h4>\n";

  // Display the publishing date.
  echo "<p class=post-creation>".$blog_item->date()."</p>\n";

  // Display the post description.
  echo "<h5 class=post-description>".$blog_item->description()."</h5>\n";

  // Display the post division bar.
  echo "<hr class=post-divider>";

  // Check if the maximum posts are displayed.
  if ($post_counter >= $blog_number) {

    // Break the loop.
    break;
  }
}

// Insert plugins for the sidebar.
Theme::plugins('siteSidebar');

?>
