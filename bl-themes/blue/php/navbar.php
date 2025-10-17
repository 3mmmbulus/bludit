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

?>

<!-- Begin of the navigation bar container. -->
<div id=nav-bar class=top>

  <!-- Begin of the button bar. -->
  <div id=nav-button-bar class=bar-closed>

    <!-- Site title on the left side of the button bar. -->
    <a class=title-link onclick="menu()" href=#top>
      <?php echo $site->title() ?>
    </a>

    <!-- Menu icon made with pure CSS. -->
    <a href="javascript:void(0);" onclick="menu()" title=Menu>
      <div class=menu-button>
        <div class=menu-line></div>
        <div class=menu-line></div>
        <div class=menu-line></div>
      </div>
    </a>

  <!-- End of the button bar. -->
  </div>

  <!-- Begin of the navigation list. -->
  <ul id=nav-list class=list-closed>

    <?php

      // Initialize the item counter.
      $item_counter = 1;

      // Add the 'Home' button.
      echo "<li class=nav-item-first>";
      echo "<a class=nav-link href=\"".HTML_PATH_ROOT."\">Home</a>";
      echo "</li>";

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

    ?>

  <!-- End of the navigation list. -->
  </ul>

  <!-- Up arrow on the right side of the navigation bar. -->
  <a class=arrow-link href=#top>
    <i class=arrow-up></i>
  </a>

<!-- End of the navigation bar container. -->
</div>
