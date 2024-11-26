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

// function addedToCart() {
//   alert("added to cart!");
// }

function refreshForm() {
  alert('called');
  const profileForm = document.querySelector(".profileForm");
}

function resetSearch() {
  window.location = 'search_process.php';
}



const showPopupBtn = document.getElementById('showPopupBtn');
const closePopupBtn = document.getElementById('closePopupBtn');
const popup = document.getElementById('popup');
const overlay = document.getElementById('popupOverlay');
const form = document.getElementById('addToCartForm');

showPopupBtn.addEventListener('click', function(event) {
  event.preventDefault();  // Prevent form submission
  
  popup.classList.add('show');
  overlay.classList.add('show');
  
  // Submit the form after a short delay to show the popup
  setTimeout(function() {
      form.submit();
  }, 5000);  // Adjust delay as needed
});

// Close popup
closePopupBtn.addEventListener('click', () => {
  popup.classList.remove('show');
  overlay.classList.remove('show');
});

// Close popup when clicking outside of it
overlay.addEventListener('click', () => {
  popup.classList.remove('show');
  overlay.classList.remove('show');
});




