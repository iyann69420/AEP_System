<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Left to Right Footer Images</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }
  .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    overflow: hidden;
  }
  .footer img {
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

<div class="content">
  <!-- Your page content goes here -->
  <h1>Welcome to My Website</h1>
  <p>This is the main content of your website.</p>
</div>

<div class="footer">
  <img src="image1.jpg" alt="Image 1">
  <img src="image2.jpg" alt="Image 2">
  <img src="image3.jpg" alt="Image 3">
  <!-- Add more images here if needed -->
</div>

</body>
</html>
