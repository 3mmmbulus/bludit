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

?>

<div id=nav-bar class=top>

  <div id=nav-button-bar class=bar-closed>

    <a class=title-link onclick="menu()" href=#top>
      <?php echo $site->title() ?>
    </a>

    <a href="javascript:void(0);" onclick="menu()" title=Menu>
      <div class=menu-button>
        <div class=menu-line></div>
        <div class=menu-line></div>
        <div class=menu-line></div>
      </div>
    </a>

  </div>

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

  </ul>

  <a class=arrow-link href=#top>
    <i class=arrow-up></i>
  </a>

</div>
