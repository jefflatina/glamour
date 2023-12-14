// Get the modal
var modal = document.querySelector(".modal");

// Get the button that opens the modal
var btn = document.querySelector(".book-btn");

// Get the <span> element that closes the modal
var closeBtn = document.querySelector(".cancel-btn");

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
  modal.style.display = "none";
}
