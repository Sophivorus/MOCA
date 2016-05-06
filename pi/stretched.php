<?php

$pi = '110010010000111111011010101000100010000101101000110000100011010011000100110001100110001010001011100000001101110000011100110100010010100100000010010011100000100010001010011001111100110001110100000000100000101110111110101001100011101100010011100110110010001001';

define('WHITE', 16777215);

function imagepoint($image, $x, $y, $color) {
	imageline($image, $x, $y, $x, $y, $color);
	}

header('Content-Type: image/png');

//Create the image
$image = imagecreatetruecolor(1100, 1100);

for ($x=0; $x<256; $x++)
	for ($y=0; $y<256; $y++)
		if ($pi[$x] == '1')
			imageline($image, 0, 0, $x * 4, $y * 4, WHITE);

//Output the image
imagepng($image);

//Destroy the image
imagedestroy($image);