// Get all modal images
var modalImages = document.querySelectorAll(".modal-image");
// Loop through each modal image
modalImages.forEach(function (img, index) {
  // Add click event listener to each modal image
  img.onclick = function () {
    // Get the corresponding modal for the clicked image
    var modal = document.querySelectorAll(".modal")[index];
    // Get the corresponding modal content for the clicked image
    var modalImg = document.querySelectorAll(".modal-content")[index];
    // Show the modal
    modal.style.display = "flex";
    // Set the image source in the modal
    modalImg.src = this.src;
  };
});

// Get all close buttons
var closeButtons = document.querySelectorAll(".close");
// Loop through each close button
closeButtons.forEach(function (btn) {
  // Add click event listener to each close button
  btn.onclick = function () {
    // Hide the modal
    this.parentElement.style.display = "none";
  };
});

var slideIndex = 1;
showSlides();

function showSlides(n) {
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  if (n != undefined) {
    slideIndex += n;
  }
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  if (slideIndex < 1) {
    slideIndex = slides.length;
  }

  slides[slideIndex - 1].style.display = "block";
  //setTimeout(showSlides, 2000); // Change image every 2 seconds
}

function plusSlides(n) {
  showSlides(n);
}
