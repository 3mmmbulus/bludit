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

<div class=footer-box>

  <div class=footer-links>
    <?php echo $site->footer()." | Theme by <a href=\"https://pb-soft.com\" target=_blank>PB-Soft</a>"; ?>
  </div>

</div>

<button onclick="jumpTop()" id=jump-top>
  <i class=arrow-top></i>
</button>
