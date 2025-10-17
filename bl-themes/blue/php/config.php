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


// =====================================================================
// Please specify if the debug mode is enabled (show errors).
// =====================================================================
$debug_mode = 0;


// =====================================================================
// Please specify the title for the 'posts' column (left sidebar).
// =====================================================================
$posts_title = "Newest Posts";


// =====================================================================
// Specify the number of posts to display in the 'posts' column.
// =====================================================================
$posts_number = 5;


// =====================================================================
// Please specify the title for the 'gallery' column (right sidebar).
// =====================================================================
$gallery_title = "Photo Gallery";


// =====================================================================
// Please specify the path to the image description file.
// =====================================================================
$description_file = THEME_DIR_IMG."right/description.txt";

?>
