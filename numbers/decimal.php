<?php

$width = 100;
$height = 1000;

$image = imagecreatetruecolor( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 );

for ( $i = 0; $i < $height; $i++ ) {

	foreach ( str_split( $i ) as $d => $digit ) {

		$red = ( $digit / 10 ) * 255;
		$green = ( $digit / 10 ) * 255;
		$blue = ( $digit / 10 ) * 255;
		$color = imagecolorallocate( $image, $red, $green, $blue );

		$x1 = $width - ( strlen( $i ) * 10 ) + $d * 10;
		$y1 = $i * 10;
		$x2 = $x1 + 9;
		$y2 = $y1 + 9;

		imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $color );

		imagestring( $image, 0, 1, $y1, $i, $white ); // Write the number to the left
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );