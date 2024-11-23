function dropdownHeader() {
    document.getElementById("dropdown-content").classList.toggle("show");
}

function dropdownNavLinks() {
    document.getElementById("dropdown-navlinks").classList.toggle("show");
}


function moveCarousel(positive = true,containerID,itemID) {
  const carousel = document.querySelector("." + containerID);
  const slide = document.querySelector("." +itemID);
  const slideWidth = slide.clientWidth + 24;
  carousel.scrollLeft = positive ? carousel.scrollLeft + slideWidth : carousel.scrollLeft - slideWidth;
  // carousel.scrollLeft = positive ? alert("right") : alert("left");

  // debugging
  // alert (containerID+" "+ carousel);
  // alert (itemID+" "+slide);
  
}

function addedToCart() {
  alert("added to cart!");
}

function refreshForm() {
  alert('called');
  const profileForm = document.querySelector(".profileForm");
}

function resetSearch() {
  window.location = 'search_process.php';
}




