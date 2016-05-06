<?php

$width = 100;

$height = 1000;

header( 'Content-Type: image/png' );

$image = imagecreatetruecolor( $width, $height );

for ( $y = 0; $y < $height; $y++ ) {
	
	$decimal = $y;
	
	for ( $x = 0; $x < strlen( $decimal ); $x++ ) {
		
		$digit = substr( $decimal, $x , 1 );
		
		$red = ( $digit / 10 ) * 255;
		$green = ( $digit / 10 ) * 255;
		$blue = ( $digit / 10 ) * 255;
		$color = imagecolorallocate( $image, $red, $green, $blue );
		
		$x1 = $width - ( strlen( $decimal ) * 10 ) + $x * 10;
		$y1 = $y * 10;
		$x2 = $width - ( strlen( $decimal ) * 10 ) + $x1 + 10;
		$y2 = $y1 + 10;
		
		imagefilledrectangle( $image, $x1, $y1, $x2, $y2, $color );
	}
}

imagepng( $image );

imagedestroy( $image );