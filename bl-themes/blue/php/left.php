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

// Display the posts title.
echo "<h1 class=column-title>".$posts_title."</h1>\n";

// Get the list of keys of all the posts.
$posts = $pages->getList(1, $posts_number, true);

// Loop through all the posts.
foreach ($posts as $postKey) {

  // Get a page object with the data.
  $post = buildPage($postKey);

  // Add a link to the post - Begin.
  echo "<a href=\"".$post->permalink()."\">\n";

  // Check if a cover image for this post is available.
  if ($post->coverImage()) {

    // Display the cover image of the post.
    echo "<img src=\"".$post->coverImage()."\" alt=\"".$post->title()."\">\n";
  }

  // Add a link to the post - End.
  echo "</a>\n";

  // Display the post title.
  echo "<h4 class=post-title><a href=\"".$post->permalink()."\">".$post->title()."</a></h4>\n";

  // Display the publishing date.
  echo "<p class=post-creation>".$post->date()."</p>\n";

  // Display the post description.
  echo "<h5 class=post-description>".$post->description()."</h5>\n";

  // Display the post division bar.
  echo "<hr class=post-divider>";
}

?>
