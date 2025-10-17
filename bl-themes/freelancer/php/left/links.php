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

// Please specify link 1.
$links[0]['url'] = "https://bitbucket.org/Blackneron/";
$links[0]['name'] = "Bitbucket Repositories";
$links[0]['target'] = "_blank";

// Please specify link 2.
$links[1]['url'] = "https://pbiegel.com/pbbitrepo/php/overview.php";
$links[1]['name'] = "Projects Overview";
$links[1]['target'] = "_blank";

// Please specify link 3.
$links[2]['url'] = "https://pb-soft.com";
$links[2]['name'] = "PB-Soft Website";
$links[2]['target'] = "_blank";

// Loop through all the links.
foreach ($links as $link) {

  // Display the actual link.
  echo "<div class=link-box>\n";
  echo "<a href=\"".$link['url']."\" title=\"".$link['name']."\" target=\"".$link['target']."\">\n";
  echo $link['name']."\n";
  echo "</a>\n";
  echo "</div>\n";
}

// Insert plugins for the sidebar.
Theme::plugins('siteSidebar');

?>
