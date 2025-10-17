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
if(!defined('FREELANCER') || !FREELANCER) {die();}

// Begin of the title header (banner).
echo "<div class=header>\n";

// Begin of the filter covering the banner.
echo "<div class=filter>\n";

// Begin of the title/subtitle box.
echo "<div class=title-box>\n";

// Display the page title.
echo "<h1 class=site-title>".$site->title()."</h1>\n";

// Display the page subtitle.
echo "<p class=subtitle>".$site->slogan()."</p>\n";

// End of the title/subtitle box.
echo "</div>\n";

// End of the filter covering the banner.
echo "</div>\n";

// End of the title header (banner).
echo "</div>\n";

?>
