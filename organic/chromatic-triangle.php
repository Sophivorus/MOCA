<?php

$width = 510;
$height = $width / 2;
$image = imagecreatetruecolor( $width, $height );

// Draw the first pixel, notice the g = 1
$color = imagecolorallocate( $image, 0, 1, 0 );
imagesetpixel( $image, $width / 2, 0, $color );

for ( $y = 1; $y < $height; $y++ ) {

	for ( $x = 0; $x < $width; $x++ ) {

		$topLeftPixelRGB = @imagecolorat( $image, $x - 1, $y - 1 ); // Get the rgb of the top left pixel, supress errors
		if ( $topLeftPixelRGB ) {
			$topLeftPixelR = ( $topLeftPixelRGB >> 16 ) & 0xFF; // Extract the red from the rgb
			$r = $topLeftPixelR + 1;
		} else {
			$r = 0;
		}

		$topMiddlePixelRGB = @imagecolorat( $image, $x, $y - 1 );
		if ( $topMiddlePixelRGB ) {
			$topMiddlePixelG = ( $topMiddlePixelRGB >> 8 ) & 0xFF;
			$g = $topMiddlePixelG + 1;
		} else {
			$g = 0;
		}

		$topRightPixelRGB = @imagecolorat( $image, $x + 1, $y - 1 );
		if ( $topRightPixelRGB ) {
			$topRightPixelB = $topRightPixelRGB & 0xFF;
			$b = $topRightPixelB + 1;
		} else {
			$b = 0;
		}

		$color = imagecolorallocate( $image, $r, $g, $b );
		imagesetpixel( $image, $x, $y, $color );
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );