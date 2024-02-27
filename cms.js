// Get all modal images
var modalImages = document.querySelectorAll(".modal-image");
modalImages.forEach(function (img, index) {
  img.onclick = function () {
    var modal = document.querySelectorAll(".modal")[index];
    var modalImg = document.querySelectorAll(".modal-content")[index];
    modal.style.display = "flex";
    modalImg.src = this.src;
  };
});

// Get all close buttons
var closeButtons = document.querySelectorAll(".close");
closeButtons.forEach(function (btn) {
  btn.onclick = function () {
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
