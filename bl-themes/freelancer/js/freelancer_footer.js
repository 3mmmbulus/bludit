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

// Function to toggle the navigation menu on mobile devices.
function menu() {

  // Use the strict pragma.
  "use strict";

  // Get the navigation button bar element.
  var bar = document.getElementById("nav-button-bar");

  // Get the navigation list element.
  var list = document.getElementById("nav-list");

  // Check if the navigation bar is open.
  if (bar.className.indexOf("bar-closed") === -1) {

    // Change the CSS style to close the navigation button bar.
    bar.className = bar.className.replace("bar-open", "bar-closed");

    // Change the CSS style to close the navigation list.
    list.className = list.className.replace("list-open", "list-closed");

    // The navigation bar is closed.
  } else {

    // Change the CSS style to open the navigation button bar.
    bar.className = bar.className.replace("bar-closed", "bar-open");

    // Change the CSS style to open the navigation list.
    list.className = list.className.replace("list-closed", "list-open");
  }
}

// Function to make the navigation bar sticky.
window.onscroll = function () {

  // Use the strict pragma.
  "use strict";

  // Get the navigation bar element.
  var navbar = document.getElementById("nav-bar");

  // Check if the document was scrolled more than 100 pixel and is not on top.
  if (document.body.scrollTop > 100 ||
    document.documentElement.scrollTop > 100) {

    // Change the CSS style to make the navigation bar sticky.
    navbar.className = "sticky";

    // Display the jump to top button.
    document.getElementById("jump-top").style.display = "block";

    // The document was not scrolled more than 100 pixel and is on top.
  } else {

    // Change the CSS style to make the navigation bar not sticky.
    navbar.className = navbar.className.replace("sticky", "top");

    // Hide the jump to top button.
    document.getElementById("jump-top").style.display = "none";
  }
};

// Function to jump to the top of the document.
function jumpTop() {

  // Use the strict pragma.
  "use strict";

  // Scroll to the top of the body.
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
