<?php

$width = 100;

$height = 2430;

header( 'Content-Type: image/png' );

$image = imagecreate( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 ); // White background

$gray = imagecolorallocate( $image, 127, 127, 127 );

$black = imagecolorallocate( $image, 0, 0, 0 );

for ( $y = 0; $y < $height; $y++ ) {
	
	$ternary = base_convert( $y, 10, 3 );
	
	for ( $x = 0; $x < strlen( $ternary ); $x++ ) {
		
		$digit = substr( $ternary, $x , 1 );
		
		if ( $digit == 0 )
			$color = $white;
		if ( $digit == 1 )
			$color = $black;
		if ( $digit == 2 )
			$color = $gray;
		
		$x1 = $width - ( strlen( $ternary ) * 10 ) + $x * 10;
		$y1 = $y * 10;
		$x2 = $width - ( strlen( $ternary ) * 10 ) + $x1 + 10;
		$y2 = $y1 + 10;
		
		imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $color );
		
		imagestring( $image, 0, 1, $y1, $y, $black ); // Write the number to the left
	}
}

imagepng( $image );

imagedestroy( $image );