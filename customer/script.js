function dropdownHeader() {
  document.getElementById("dropdown-content").classList.toggle("show");
}

function dropdownNavLinks() {
  document.getElementById("dropdown-navlinks").classList.toggle("show");
}


function moveCarousel(positive = true, containerID, itemID) {
  const carousel = document.querySelector("." + containerID);
  const slide = document.querySelector("." + itemID);
  const slideWidth = slide.clientWidth + 24;
  carousel.scrollLeft = positive ? carousel.scrollLeft + slideWidth : carousel.scrollLeft - slideWidth;
  // carousel.scrollLeft = positive ? alert("right") : alert("left");

  // debugging
  // alert (containerID+" "+ carousel);
  // alert (itemID+" "+slide);

}

function addedToCart() {

}

function refreshForm() {
  alert('called');
  const profileForm = document.querySelector(".profileForm");
}

function resetSearch() {
  window.location = 'search_process.php';
}


document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('.add-to-cart-form');

  forms.forEach((form) => {
    const showPopupBtn = form.querySelector('.show-popup-btn');
    const closePopupBtn = form.querySelector('.close-popup-btn');
    const popup = form.querySelector('.popup');
    const overlay = form.querySelector('.popup-overlay');

    // Show popup
    showPopupBtn.addEventListener('click', function (event) {
      event.preventDefault(); // Prevent form submission

      popup.classList.add('show');
      overlay.classList.add('show');

      setTimeout(() => {
        form.submit();
      }, 2000);
    });

    // Close popup
    closePopupBtn.addEventListener('click', () => {
      popup.classList.remove('show');
      overlay.classList.remove('show');
    });

    // Close popup when clicking the overlay
    overlay.addEventListener('click', () => {
      popup.classList.remove('show');
      overlay.classList.remove('show');
    });
  });


});