<?php
session_start();

$width = 200;
$height = 200;

// Generate the CAPTCHA grid
$gridSize = 3; // Number of squares in each row/column
$squareSize = $width / $gridSize;

// Create the image
$image = imagecreatetruecolor($width, $height);

// Set background color
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $backgroundColor);

// Add squares to the image
$squareColor = imagecolorallocate($image, 0, 0, 0);
for ($i = 0; $i < $gridSize; $i++) {
    for ($j = 0; $j < $gridSize; $j++) {
        $x1 = $i * $squareSize;
        $y1 = $j * $squareSize;
        $x2 = $x1 + $squareSize - 1;
        $y2 = $y1 + $squareSize - 1;
        imagerectangle($image, $x1, $y1, $x2, $y2, $squareColor);
    }
}

// Output the image
header('Content-type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>
