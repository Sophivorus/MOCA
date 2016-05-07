<?php

$number = rand();

$binary = decbin( $number );

$width = strlen( $binary );
$height = 100;

$image = imagecreatetruecolor( $width, $height );

$white = imagecolorallocate( $image, 255, 255, 255 );

for ( $x = 0; $x < $width; $x++ ) {
	if ( $binary[ $x ] == 1 ) {
		imagefilledrectangle( $image, $x, 0, $x, $height, $white );
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );