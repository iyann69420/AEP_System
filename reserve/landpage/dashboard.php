<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    body {
        font-family: "Tilt Neon", sans-serif;
        margin: 0;
        padding: 0;
        background-color: #006400; /* Set background color to #006400 */
    }
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
    }
    nav ul li:first-child {
        margin-left: 0;
    }
    nav ul li a {
        color: #fff;
        text-decoration: none;
    }
    .button {
        background-color: blue;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-left: -700px;
    }
    .button:first-child {
        margin-left: 0; /* Remove margin from the first button */
    }
    .button:hover {
        background-color: red; /* Change background color to red on hover */
    }
    .buttos {
        background-color: blue;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-left: -800px;
    }
    .buttos:first-child {
        margin-left: 248px; 
        margin-top: 30px;/* Remove margin from the first button */
    }
    .buttos:hover {
        background-color: red; /* Change background color to red on hover */
    }
    .buttons {
        background-color: blue;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-left: 10px;
        margin-bottom: 40px ;
    }
    .buttons:first-child {
        margin-left: 0; /* Remove margin from the first button */
    }
    .buttons:hover {
        background-color: red; /* Change background color to red on hover */
    }
    h1 {
        margin-left: 18%;
        margin-top: 100px;
        font-size: 3.5em; /* Adjust the font size as needed */
        animation: moveUpDown 5s infinite; /* Apply animation */
    }
    p {
        margin-left: 18%;
    }

    @keyframes moveUpDown {
        0% {
            transform: translateY(0); /* Start at original position */
        }
        50% {
            transform: translateY(-20px); /* Move up */
        }
        100% {
            transform: translateY(0); /* Move back down */
        }
    }

    /* Footer styles moved here */
    footer .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: black;
        color: #fff;
        padding: 10px 0;
        overflow: hidden;
    }
    footer .footer img {
        max-width: 100px;
        height: auto;
        margin: 0 10px;
        animation: moveLeftToRight 10s linear infinite;
    }
    @keyframes moveLeftToRight {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(calc(100vw + 100%));
        }
    }
    </style>
</head>
<body>
    <?php include '../navbar.php'; ?> 
    <main>
        <!-- Your main content here -->
        <h1>ATHLETE EVENT PLACE</h1>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis ducimus molestias a illo nemo. Veniam.</p>
        <div> <a href="http://localhost/reserve/credentials/index.php/" class="buttos">Reserve Now</a></div>
    </main>
    <!-- Footer -->
    <footer>
        <div class="footer">
            <img src="image1.jpg" alt="Image 1">
            <img src="image2.jpg" alt="Image 2">
            <img src="image3.jpg" alt="Image 3">
            <!-- Add more images here if needed -->
        </div>
    </footer>
</body>
</html>
