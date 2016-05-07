<?php

error_reporting( E_ALL );

ini_set( 'display_errors', 1 );
ini_set( 'memory_limit', '1024M' );
ini_set( 'max_execution_time', '9999' );

for ( $rule = 0; $rule <= 19682; $rule += 400 ) {

	$width = 128;
	$height = 64;

	$image = imagecreatetruecolor( $width, $height );

	$black = imagecolorallocate( $image, 0, 0, 0 );
	$blue = imagecolorallocate( $image, 0, 0, 255 );
	$red = imagecolorallocate( $image, 255, 0, 0 );

	imagesetpixel( $image, $width / 2, 0, $red ); // Draw the initial cell
	$current[ $width / 2 ] = $red;

	for ( $y = 0; $y < $height; $y++ ) {

		// We need to calculate from way before the start of the image until way before the end
		// because if not the code will asume that everything beyond the image is just black
		// but under many rules it isn't
		for ( $x = -$width; $x < $width * 2; $x++ ) {

			$left = @$current[ $x - 1 ];
			$right = @$current[ $x + 1 ];

			$ternary = base_convert( $rule, 10, 3 ); // Convert to ternary
			$ternary = str_pad( $ternary, 9, 0, STR_PAD_LEFT ); // Add leading zeroes

			if ( $left == $blue and $right == $blue ) {
				$state = $ternary[0];
			} else if ( $left == $blue and $right == $red ) {
				$state = $ternary[1];
			} else if ( $left == $blue and $right == $black ) {
				$state = $ternary[2];
			} else if ( $left == $red and $right == $blue ) {
				$state = $ternary[3];
			} else if ( $left == $red and $right == $red ) {
				$state = $ternary[4];
			} else if ( $left == $red and $right == $black ) {
				$state = $ternary[5];
			} else if ( $left == $black and $right == $blue ) {
				$state = $ternary[6];
			} else if ( $left == $black and $right == $red ) {
				$state = $ternary[7];
			} else if ( $left == $black and $right == $black ) {
				$state = $ternary[8];
			}

			if ( $state == 0 ) {
				continue;
			} else if ( $state == 1 ) {
				imagesetpixel( $image, $x, $y + 1, $red );
				$next[ $x ] = $red;
			} else if ( $state == 2 ) {
				imagesetpixel( $image, $x, $y + 1, $blue );
				$next[ $x ] = $blue;
			}
		}
		$current = $next;
		$next = array();
	}
	imagepng( $image, "images/$rule.png" );
}