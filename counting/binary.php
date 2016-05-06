<?php

$width = 100;
$height = 1280;

$image = imagecreate( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 ); // White background

$black = imagecolorallocate( $image, 0, 0, 0 );

for ( $y = 0; $y < $height; $y++ ) {
	
	$binary = decbin( $y );
	
	for ( $x = 0; $x < strlen( $binary ); $x++ ) {
		
		$digit = substr( $binary, $x , 1 );
		
		if ( $digit == 1 )
			$color = $black;
		else
			$color = $white;
		
		$x1 = $width - ( strlen( $binary ) * 10 ) + $x * 10;
		$y1 = $y * 10;
		$x2 = $width - ( strlen( $binary ) * 10 ) + $x1 + 10;
		$y2 = $y1 + 10;
		
		imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $color ); // Draw a black square for every 1 and a white one for every 0
		
		imagestring( $image, 0, 1, $y1, $y, $black ); // Write the number to the left
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );