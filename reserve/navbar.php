<header>
    <img src="../assets/img/logo.png" alt="Logo">
    <nav>
        <ul>
        <li class="dropdown">
                <a href="#">Sports</a>
                <div class="dropdown-content">
                    <a href="#">Table Tennis</a>
                    <a href="#">Badminton</a>
                    <a href="#">Billiard</a>
                    <a href="#">Taekwondo</a>


                </div>
            </li>
            <li class="dropdown">
                <a href="#">About</a>
                <div class="dropdown-content">
                    <a href="#">Company</a>
                    <a href="#">Team</a>
                    <a href="#">Contact</a>
                </div>
            </li>
            <li><a href="#">Available</a></li>
            <li><a href="#">Pricing</a></li>
        </ul>
    </nav>
    <a href="http://localhost/reserve/credentials/index.php/" class="button">Reserve Now</a>
    <a href="http://localhost/reserve/userlog/index.php" class="button">Login</a>
</header>


<style>
    header {
        background-color: #000; /* Set header background color to black */
        color: #fff;
        padding: 1px 20px; /* Adjusted padding */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header img {
        height: 100px; /* Adjusted height */
        transition: transform 0.3s; /* Add transition for smooth effect */
    }

    header img:hover {
        transform: scale(1.5); /* Enlarge the logo on hover */
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: right;
    }

    nav ul li {
        display: inline;
        margin-left: 20px;
        position: relative; /* Set position to relative for dropdown */
    }

    nav ul li:first-child {
        margin-left: 0;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .button,
    .buttos,
    .buttons {
        background-color: blue;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .button:first-child,
    .buttos:first-child,
    .buttons:first-child {
        margin-left: 0; /* Remove margin from the first button */
    }

    .buttos {
        margin-left: -800px;
    }

    .buttos:first-child {
        margin-left: 248px;
        margin-top: 30px;
    }

    .buttons {
        margin-left: 10px;
        margin-bottom: 40px;
    }

    .buttons:first-child {
        margin-left: 0; /* Remove margin from the first button */
    }

    /* Dropdown styles */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #000;
        min-width: 160px;
        z-index: 1;
        left: 0; /* Align the dropdown content to the left */
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left; /* Align the text to the left */
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>


