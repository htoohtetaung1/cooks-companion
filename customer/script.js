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
  const forms = document.querySelectorAll('.popup-form');



  forms.forEach((form) => {
    const popup = form.querySelector('.popup');
    const overlay = form.querySelector('.popup-overlay');
    const closePopupBtn = form.querySelector('.close-popup-btn');

    // Handle form submission
    form.addEventListener('submit', function (event) {
      event.preventDefault(); // Stop form from submitting immediately

      // Check if the form is valid
      if (form.checkValidity()) {
        // Show the popup
        popup.classList.add('show');
        overlay.classList.add('show');

        // Optionally delay the form submission after showing the popup
        setTimeout(() => {
          form.submit(); // Submit the form after the popup
        }, 1000); // Adjust the delay as needed
      } else {
        // If the form is invalid, show default browser validation messages
        form.reportValidity();
      }
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