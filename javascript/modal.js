// Get the modal
let modal = document.getElementById("addSportModal");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// Get the cancel button
let cancelBtn = document.getElementById("cancelBtn");

// Get the button that opens the modal
let addSportBtn = document.getElementById("addSportBtn");

// Function to open the modal
addSportBtn.onclick = function() {
  modal.style.display = "block";
}

// Function to close the modal when clicking on the cancel button
cancelBtn.onclick = function() {
  modal.style.display = "none";
}

// Function to close the modal when clicking on the <span> (x)
span.onclick = function() {
  modal.style.display = "none";
}

// Function to close the modal when clicking anywhere outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
