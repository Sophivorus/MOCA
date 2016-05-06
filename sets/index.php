<?php

$pixelWidth = 50;
$pixelHeight = 1;

$SETS = array();
for ( $dec = 0; $dec < 100000; $dec++ ) {
	$bin = decbin( $dec );
	if ( is_a_set( $bin ) ) {
		$SETS[] = $bin;
		$width = strlen( $bin ) * $pixelWidth;
	}
}

$height = count( $SETS ) * $pixelHeight;

$image = imagecreatetruecolor( $width, $height );

$black = imagecolorallocate( $image, 0, 0, 0 );
$green = imagecolorallocate( $image, 0, 255, 0 );
$red = imagecolorallocate( $image, 255, 0, 0 );

imagecolortransparent( $image, $black );

foreach ( $SETS as $i => $set ) {
	$y = $i * $pixelHeight + $pixelHeight;
	$len = strlen( $set );
	for ( $j = 0; $j < $len; $j++ ) {
		//$x = ( $width - $len * $pixelWidth ) + $j * $pixelWidth;
		$x = $j * $pixelWidth;
		$bit = (int) $set[ $j ];
		if ( $bit ) {
			$color = $green;
		} else {
			$color = $red;
		}
		imagefilledrectangle( $image, $x, $y, $x + $pixelWidth, $y + $pixelHeight, $color );
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

function is_a_set( $bin ) {
	$open = 0;
	$len = strlen( $bin );

	for ( $i = 0; $i < $len; $i++ ) {
		$remaining = (int) $len - $i - 1;
		$bit = (int) $bin[ $i ];
		if ( $bit ) {
			$open++;
		} else {
			$open--;
		}
		if ( $open > $remaining ) {
			return false; // There are more opened braces that can be closed
		}
		if ( $open < 0 ) {
			return false; // More braces have been closed than opened
		}
		if ( !$open and $remaining ) {
			return false; // All open braces have been closed but there are still bits remaining
		}
	}
	if ( $open ) {
		return false; // Some braces ended unclosed
	}
	return true;
}