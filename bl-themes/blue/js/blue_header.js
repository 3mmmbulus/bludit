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

// Function to show the big image in a window.
function showImage(element) {

  // Use the strict pragma.
  "use strict";

  // Get the image path of the clicked thumbnail.
  var imagePath = element.src;

  // Initialize the fileExtension variable.
  var fileExtension = "";

  // Check if the file is a GIF image.
  if (imagePath.search(/.gif/i) !== -1) {

    // Specify the file extension.
    fileExtension = "gif";

    // Check if the file is a JPG image.
  } else if (imagePath.search(/.jpg/i) !== -1) {

    // Specify the file extension.
    fileExtension = "jpg";

    // Check if the file is a JPEG image.
  } else if (imagePath.search(/.jpeg/i) !== -1) {

    // Specify the file extension.
    fileExtension = "jpeg";

    // Check if the file is a PNG image.
  } else if (imagePath.search(/.png/i) !== -1) {

    // Specify the file extension.
    fileExtension = "png";
  }

  // Alter the image path of the clicked thumbnail to get the big image.
  imagePath = element.src.replace("." + fileExtension, "_big." + fileExtension);

  // Replace the image path of the thumbnails with the path of the big images.
  imagePath = imagePath.replace("right", "right/big");

  // Set the big image as data source.
  document.getElementById("img-big").src = imagePath;

  // Hide the navigation bar.
  document.getElementById("nav-bar").style.display = "none";

  // Display the hidden image container.
  document.getElementById("img-box").style.display = "block";

  // Get the image information from the alt text.
  var imageInfo = document.getElementById("img-info");

  // Display the image information below the image.
  imageInfo.innerHTML = element.alt;
}
