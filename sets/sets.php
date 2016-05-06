<?php

$width = 800;
$height = 600;

$image = imagecreatetruecolor( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 );

$numbers = array( 2, 12, 52, 56, 212, 216, 228, 240, 852, 856, 868, 880, 916, 936, 944, 964, 968, 976, 992, 3412, 3416, 3428, 3440, 3476, 3480, 3504, 3524, 3668, 3672, 3760, 3780, 3860, 3880, 3920, 3936, 3984, 4032 );

foreach ( $numbers as $y => $number ) {

	$number = decbin( $number );

	for ( $i = 0; $i < strlen( $number ); $i++ ) {

		//$x = $width - strlen( $number ) + $i;
		//$x = $i;
		$x = ( $width / 2 ) - ( strlen( $number ) / 2 ) + $i;

		$digit = substr( $number, $i , 1 );

		if ( $digit == 1 ) {
			imageline( $image, $x, $y, $x, $y, $white ); //Draw a point
		}
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );