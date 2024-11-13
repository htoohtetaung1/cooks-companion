function dropdownHeader() {
    document.getElementById("dropdown-content").classList.toggle("show");
}

function dropdownNavLinks() {
    document.getElementById("dropdown-navlinks").classList.toggle("show");
}

const carousel = document.querySelector(".carousel-container");
const slide = document.querySelector(".carousel-item");

function moveCarousel(positive = true) {
  const slideWidth = slide.clientWidth + 1;
  carousel.scrollLeft = positive ? carousel.scrollLeft + slideWidth : carousel.scrollLeft - slideWidth;
//   carousel.scrollLeft = positive ? alert("right") : alert("left");
}