<?php

$width = 100;
$height = 1280;

$image = imagecreatetruecolor( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 );

for ( $i = 0; $i < $height; $i++ ) {

	$binary = decbin( $i );

	foreach ( str_split( $binary ) as $b => $bit ) {

		if ( $bit == 1 ) {

			$x1 = $width - ( strlen( $binary ) * 10 ) + $b * 10;
			$y1 = $i * 10;
			$x2 = $x1 + 10;
			$y2 = $y1 + 10;

			imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $white ); // Draw a square for every 1
		}

		imagestring( $image, 0, 1, $y1, $i, $white ); // Write the number to the left
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );