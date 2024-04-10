

<style>

</style>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athelete Event Place Dashboard</title>

    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/admin.css">
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


        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="wrapper">
            <a href="index.php"> <!-- Add this line to make the title clickable -->
                <div class="sidebar-title">Athlete Event Place Dashboard</div>
            </a>
            <ul>
                <li>
                    <div class="icon-link" onclick="toggleSubMenu(this)">
                        <span class="link_name">Content Management</span>
                        <i class='bx bx-chevron-down arrow' id="contentManagementArrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <br>
                        <li><a href="sports.php">Sports</a></li>

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
            </ul>
        </div>
        <a href="logout.php" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
            </svg>
            <p>Logout</p>
        </a>
    </div>



</body>

</html>

<!-- script here -->
<script src="javascript/sidebar.js"></script>