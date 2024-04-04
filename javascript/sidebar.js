
document.addEventListener('DOMContentLoaded', function () {
        
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
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
       
