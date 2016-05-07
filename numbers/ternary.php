<?php

$width = 100;
$height = 1280;

$image = imagecreatetruecolor( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 );

for ( $i = 0; $i < $height; $i++ ) {

	$ternary = base_convert( $i, 10, 3 );

	foreach ( str_split( $ternary ) as $t => $trit ) {

		$x1 = $width - ( strlen( $ternary ) * 10 ) + $t * 10;
		$y1 = $i * 10;
		$x2 = $x1 + 9;
		$y2 = $y1 + 9;

		if ( $trit == 1 ) {
			imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $white );
		} else if ( $trit == 2 ) {
			imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $white / 2 );
		}

		imagestring( $image, 0, 1, $y1, $i, $white ); // Write the decimal number to the left
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );