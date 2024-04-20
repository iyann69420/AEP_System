
document.addEventListener('DOMContentLoaded', function () {
    let isOpen = true; // Track the current size state
    // const sidebar = document.getElementById('sidebar');
    const sidebarBtn = document.getElementById('sidebarCollapse');

    sidebarBtn.addEventListener('click', function () {
        if (isOpen == true) {
            document.documentElement.style.setProperty('--sidebar-width', '0px');
            isOpen = false;
        } else {
            document.documentElement.style.setProperty('--sidebar-width', '250px');
            isOpen = true;
        }
    });



});

function toggleSubMenu(element) {
    const subMenu = element.nextElementSibling;
    const arrow = element.querySelector(".arrow");

    if (subMenu.style.display === 'block') {
        subMenu.style.display = 'none';
        arrow.classList.remove('rotate');
    } else {
        subMenu.style.display = 'block';
        arrow.classList.add('rotate');
    }
}

