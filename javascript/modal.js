document.addEventListener("DOMContentLoaded", function () {
    // Add Sport Modal
    var addSportModal = document.getElementById("addSportModal");
    var addSportBtn = document.getElementById("addSportBtn");
    var addSportCloseBtn = addSportModal.querySelector('.close');
    var cancelAddBtn = document.getElementById('cancelBtn');

    addSportBtn.onclick = function () {
        addSportModal.style.display = "block";
    }

    addSportCloseBtn.onclick = function () {
        addSportModal.style.display = "none";
    }

    cancelAddBtn.onclick = function () {
        addSportModal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == addSportModal) {
            addSportModal.style.display = "none";
        }
    }

    // Update Sport Modal
    var updateSportModal = document.getElementById("updateSportModal");
    var updateSportBtns = document.querySelectorAll(".updateSportBtn"); 
    var updateSportCloseBtn = updateSportModal.querySelector('.close');
    var cancelUpdateBtn = document.getElementById('cancelUpdateBtn');

    updateSportBtns.forEach(function (btn) {
        btn.onclick = function () {
            updateSportModal.style.display = "block";
            var sportId = btn.getAttribute('data-sport-id'); 
            var row = btn.closest('tr');
            var sportName = row.querySelector('td:nth-child(2)').innerText;
            updateSportModal.querySelector('#sport_id').value = sportId;
            updateSportModal.querySelector('#sportName').value = sportName;
        }
    });

    updateSportCloseBtn.onclick = function () {
        updateSportModal.style.display = "none";
    }

    cancelUpdateBtn.onclick = function () {
        updateSportModal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == updateSportModal) {
            updateSportModal.style.display = "none";
        }
    }
});
