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

// Begin of the footer box.
echo "<div class=footer-box>\n";

// Add the links to the footer.
echo "<div class=footer-links>\n";
echo $site->footer()." | Theme by <a href=\"https://pb-soft.com\" target=_blank>PB-Soft</a>\n";
echo "</div>\n";

// End of the footer box.
echo "</div>\n";

// Add the arrow button for jumping to the top of the page.
echo "<button onclick=\"jumpTop()\" id=jump-top>\n";
echo "<i class=arrow-top></i>\n";
echo "</button>\n";

?>
