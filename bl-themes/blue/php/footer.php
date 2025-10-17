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

<!-- Begin of the footer box. -->
<div class=footer-box>

  <!-- Add the links to the footer. -->
  <div class=footer-links>
    <?php echo $site->footer()." | Theme by <a href=\"https://pb-soft.com\" target=_blank>PB-Soft</a>"; ?>
  </div>

<!-- End of the footer box. -->
</div>

<!-- Add the arrow button for jumping to the top of the page. -->
<button onclick="jumpTop()" id=jump-top>
  <i class=arrow-top></i>
</button>
