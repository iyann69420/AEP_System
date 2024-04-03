<?php 




?>

<style>
    .menu {
        border-bottom: 1px solid grey;
        background-color: black;
        left: -250px;
    }

    .menu.open {
        right: 30px; /* Move the menu back on-screen when the 'open' class is applied */
    }

    .menu ul li a:hover {
        color: orange;
    }

    .text-center .menu {
        text-align: left;
    }

    .text-center #sidebarCollapse {
        text-align: left;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown:hover .sub-menu {
        display: block;
        position: absolute; /* Add this to position the sub-menu properly */
        top: 100%; /* Position the sub-menu below the parent */
        left: 0; /* Align the sub-menu with the left edge of the parent */
        background-color: #111 !important;
        min-width: 150px;
        z-index: 1;
    }
    .sub-menu {
        display: none;
    }

    .sub-menu li {
        padding: 0px 0;
    }

    .dropdown a {
        text-decoration: none;
        color: #fff !important;
        display: block;
        background-color: #111;
    }

    .dropdown a {
        text-decoration: none;
        color: #333;
        display: block;
    }

    .dropdown:hover a {
        color: #111;
    }

    .dropdown:hover .sub-menu {
        display: block;
    }
    .rotate {
        transform: rotate(180deg);
        transition: transform 0.3s ease; /* Add a smooth transition effect */
    }
    .sidebar ul li ul li a {
        cursor: pointer; /* Set the cursor to pointer (finger) */
        /* Add other styles as needed for your design */
    }

    .sidebar {
    width: 250px;
    height: 100%;
    position: fixed;
    top: 0;
    left: -250px;
    background-color: #111; /* Black background color */
    transition: left 0.3s ease;
    overflow-y: auto;
    font-family: Arial, sans-serif; /* Improved font */
    color: white; /* Text color */
    
}

.sidebar.active {
    left: 0;
}

.sidebar-title {
    font-size: 1.8rem; /* Larger title font size */
    padding: 10px 0;
    text-align: center;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}
.sidebar ul li {
    margin-bottom: 10px;
    padding-left: 10px; /* Adjust this value for the desired indentation */
}

.sidebar ul li a {
    padding: 5px 0; /* Adjust the top and bottom padding as needed */
}

.sidebar a {
    text-decoration: none;
    display: block;
    padding: 10px;
    transition: background-color 0.3s ease, color 0.3s ease; /* Add color transition */
    color: white;
}

.sidebar ul li div.icon-link:hover .link_name {
    color: #f39c12; /* Change the text color to orange on hover */
}

.sidebar a:hover {
    background-color: #f39c12; /* Orange hover color */
    color: black; /* Change text color on hover */
}

.content {
    margin-left: 0; /* Change this to 0 to fill the space when sidebar is open */
    padding: 20px;
    font-family: Arial, sans-serif;
    color: #333;
    transition: margin-left 0.3s ease; /* Add transition */
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.logout-button {
    
    bottom: 20px;
    left: 20px;
    /* Adjust the positioning as needed */
}


.logout-btn {
    background-color: #f39c12; /* Orange logout button color */
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    
}

.logout-btn:hover {
    background-color: #e67e22; /* Slightly darker orange on hover */
}

/* Style adjustments for sidebar links on hover */
.sidebar a:hover {
    background-color: #f39c12;
    color: black;
    padding-left: 15px;
    transition: background-color 0.3s ease, color 0.3s ease, padding-left 0.3s ease;
}



#sidebarCollapse {
    /* Button styles */
   
    top: 0px;
    left: 260px; /* Adjust this value to your preference */
    z-index: 999;
    cursor: pointer;
    background: transparent;
    border: none;
    color: white;
    left: 250px;
    position: absolute;

    /* Other styles */
}

/* Optional: Style to change the color of the SVG icon when hovered */
#sidebarCollapse:hover .svg-icon path {
    fill: #f39c12; /* Change this to the desired color */
}



.status-label.pending {
    background-color: #ffcc00; /* Yellow */
    color: #333; /* Text color */
}

.status-label.packed {
    background-color: #ff6600; /* Orange */
    color: #fff; /* Text color */
}

.status-label.for-delivery {
    background-color: #3399ff; /* Blue */
    color: #fff; /* Text color */
}

.status-label.cancelled {
    background-color: #ff3333; /* Red */
    color: #fff; /* Text color */
}

.status-label.delivered {
    background-color: #00cc66; /* Green */
    color: #fff; /* Text color */
}

.status-label.on-the-way {
    background-color: purple; /* Custom color for "On the Way" */
    color: #fff; /* Text color */
}
</style>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skid Alley Admin Dashboard</title>
    <link rel="stylesheet" href="../admin/css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8iZSL+poG6eA6q8QDH7g3uKEO/4F+sl5LU6I5LdQDO/1u2wnf50pdPw1x" crossorigin="anonymous">

</head>
<body>
    <div class="menu text-center">
        <div class="wrapper">
           
            <button id="sidebarCollapse">
                <svg class="svg-icon" style="width: 2em; height: 2em; vertical-align: middle; fill: currentColor; overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M232.369231 282.813046h559.261538a31.507692 31.507692 0 0 0 0-63.015384h-559.261538a31.507692 31.507692 0 0 0 0 63.015384zM791.630769 480.492308h-559.261538a31.507692 31.507692 0 0 0 0 63.015384h559.261538a31.507692 31.507692 0 0 0 0-63.015384zM791.630769 741.186954h-559.261538a31.507692 31.507692 0 0 0 0 63.015384h559.261538a31.507692 31.507692 0 0 0 0-63.015384z" />
                </svg>
            </button>

            <a href="notifications-admin.php" id="notificationLink" class="notifications">
                Notifications
                <span id="notificationCount" class="notification-count"></span>
            </a>
                            
        </div>
    </div>

    <div class="sidebar" id="sidebar">
    <br>
    <a href="index.php"> <!-- Add this line to make the title clickable -->
            <div class="sidebar-title">Skid Alley Admin Dashboard</div>
        </a>
    <div class="wrapper">
        <ul>
            <br>
            
            <li>
                <div class="icon-link" onclick="toggleSubMenu(this)">
                    <span class="link_name">Content Management</span>
                    <i class='bx bx-chevron-down arrow' id="contentManagementArrow"></i>
                </div>
                <ul class="sub-menu">
                    <br>
                    <li><a href="logo.php">Logo</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="carousel.php">Carousel(Home)</a></li>
                    <li><a href="gcash-info.php">Gcash Info</a></li>
                </ul>
            </li>
            

            
            <li>
                <div class="icon-link" onclick="toggleSubMenu(this)">
                    <span class="link_name">File Management</span>
                    <i class='bx bx-chevron-down arrow' id="productManagementArrow"></i>
                </div>
                <ul class="sub-menu">
                    <br>
                    <li><a href="product-list.php">Product List</a></li>
                    <li><a href="inventory.php">Inventory</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="colors-sizes.php">Colors And Sizes</a></li>
                    <li><a href="brands.php">Brands</a></li>
                    <li><a href="discounts.php">Discounts</a></li>
                    <li><a href="vouchers.php">Vouchers</a></li>
                    <li><a href="clients.php">Client List</a></li>
                </ul>
            </li>
            

            
            <li><a href="orders.php">Orders</a></li>
        

            
            <li><a href="reviews.php">Reviews</a></li>
        

            
            <li><a href="sales-report.php">Sales Report</a></li>
         

         
            
           
            <li><a href="admin.php">Admin</a></li>
         

            <div class="logout-button">
                <a href="logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>

        </ul>
    </div>
</div>






<script>

document.addEventListener('DOMContentLoaded', function () {
        
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });

       
        updateNotificationCount();

      
        setInterval(updateNotificationCount, 1000);
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
        function updateNotificationCount() {
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
               
                var count = parseInt(this.responseText);

               
                var notificationCountElement = document.getElementById('notificationCount');

                // Update the notification count in the HTML
                notificationCountElement.textContent = count;

                
                if (count === 0) {
                    notificationCountElement.style.display = 'none';
                } else {
                    notificationCountElement.style.display = 'block';
                }
            }
        };
        xhr.open("GET", "get-notification-count.php", true);
        xhr.send();
    }
    </script>
</body>

</html>

