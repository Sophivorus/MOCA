<?php

error_reporting( E_ALL );

ini_set( 'display_errors', 1 );
ini_set( 'memory_limit', '1024M' );
ini_set( 'max_execution_time', '9999' );

for ( $rule = 0; $rule < 16; $rule++ ) {

	$width = 256;
	$height = 128;

	$image = imagecreatetruecolor( $width, $height );

	$color = imagecolorallocate( $image, 255, 255, 255 );

	imagesetpixel( $image, $width / 2, 0, $color ); // Draw the initial cell

	$current = array( $width / 2 );
 	$next = array();

	for ( $y = 0; $y < $height; $y++ ) {

		// We need to calculate from way before the start of the image until way before the end
		// because if not the code will asume that everything beyond the image is just black
		// but under many rules it isn't
		for ( $x = -$width; $x < $width * 2; $x++ ) {

			$left = in_array( $x - 1, $current );
			$right = in_array( $x + 1, $current );

			$binary = sprintf( "%04d", decbin( $rule ) ); // Convert to binary keeping the leading zeros

			if ( $left and $right ) {
				$state = $binary[0];
			} else if ( $left and !$right ) {
				$state = $binary[1];
			} else if ( !$left and $right ) {
				$state = $binary[2];
			} else if ( !$left and !$right ) {
				$state = $binary[3];
			}

			if ( $state == 0 ) {
				continue;
			} else if ( $state == 1 ) {
				imagesetpixel( $image, $x, $y + 1, $color );
			}
			$next[] = $x;
		}
		$current = $next;
		$next = array();
	}
	imagepng( $image, "images/$rule.png" );
}