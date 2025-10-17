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

// Begin of the navigation bar container.
echo "<div id=nav-bar class=top>\n";

// Begin of the button bar.
echo "<div id=nav-button-bar class=bar-closed>\n";

// Site title on the left side of the button bar.
echo "<a class=title-link onclick=\"menu()\" href=#top>\n";
echo $site->title()."\n";
echo "</a>\n";

// Menu icon made with pure CSS.
echo "<a href=\"javascript:void(0);\" onclick=\"menu()\" title=Menu>\n";
echo "<div class=menu-button>\n";
echo "<div class=menu-line></div>\n";
echo "<div class=menu-line></div>\n";
echo "<div class=menu-line></div>\n";
echo "</div>\n";
echo "</a>\n";

// End of the button bar.
echo "</div>\n";

// Begin of the navigation list.
echo "<ul id=nav-list class=list-closed>\n";

// Initialize the item counter.
$item_counter = 1;

// Check if the default 'home' button should be displayed.
if ($display_home_button == 1) {

  // Add the 'Home' button.
  echo "<li class=nav-item-first>";
  echo "<a class=nav-link href=\"".HTML_PATH_ROOT."\">Home</a>";
  echo "</li>";
}

// Loop through all the static pages - Begin.
foreach ($staticContent as $staticPage) {

  // Increase the item counter.
  $item_counter++;

  // Check if the item counter is 1 (the first item).
  // If someone wants to remove the 'Home' button, the first static
  // page will be used as the 'home' link destination.
  if ($item_counter == 1) {

    // Insert the actual item and mark it as the first one.
    echo "<li class=nav-item-first>";

    // The actual item is not the first one.
  } else {

    // Insert the actual item.
    echo "<li class=nav-item>";
  }

  // Display the page title as a link.
  echo "<a class=nav-link href=\"".$staticPage->permalink()."\">".$staticPage->title()."</a>";

  // Close the list item element.
  echo "</li>";
}

// End of the navigation list.
echo "</ul>\n";

// Up arrow on the right side of the navigation bar.
echo "<a class=arrow-link href=#top>\n";
echo "<i class=arrow-up></i>\n";
echo "</a>\n";

// End of the navigation bar container.
echo "</div>\n";

?>
