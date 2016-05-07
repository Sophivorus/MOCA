<?php

class Pixel {

	public $x;
	public $y;

	public $r;
	public $g;
	public $b;

	function __construct( $x, $y, $r, $g, $b ) {
		$this->x = $x;
		$this->y = $y;
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	function draw() {
		global $image;
		$color = imagecolorallocate( $image, $this->r, $this->g, $this->b );
		imagesetpixel( $image, $this->x, $this->y, $color );
	}
}

$width = 1000;
$height = 1000;
$image = imagecreatetruecolor( $width, $height );

$firstPixel = new Pixel( 0, 0, 0, 0, 0 );
$firstPixel->draw();

$currentRow = array( $firstPixel );

for ( $y = 0; $y < $height; $y++ ) {

	$previousRow = $currentRow;
	$currentRow = array();

	// Calculate the current row
	foreach ( $previousRow as $x => $previousPixel ) {

		// Left pixel
		if ( array_key_exists( $x - 1, $currentRow ) ) {
			$leftPixel = $currentRow[ $x - 1 ];
			$leftPixel->r++;
		} else {
			$leftX = $previousPixel->x - 1;
			$leftY = $previousPixel->y + 1;
			$leftR = $previousPixel->r + 1;
			$leftG = $previousPixel->g;
			$leftB = $previousPixel->b;
			$leftPixel = new Pixel( $leftX, $leftY, $leftR, $leftG, $leftB );
		}
		$currentRow[ $leftX ] = $leftPixel;

		// Middle pixel
		if ( array_key_exists( $x, $currentRow ) ) {
			$middlePixel = $currentRow[ $x ];
			$middlePixel->g++;
		} else {
			$middlePixel = clone $previousPixel;
			$middlePixel->y++;
			$middlePixel->g++;
		}
		$currentRow[ $middlePixel->x ] = $middlePixel;

		// Right pixel
		if ( array_key_exists( $x + 1, $currentRow ) ) {
			$rightPixel = $currentRow[ $x + 1 ];
			$rightPixel->b++;
		} else {
			$rightX = $previousPixel->x + 1;
			$rightY = $previousPixel->y + 1;
			$rightR = $previousPixel->r;
			$rightG = $previousPixel->g;
			$rightB = $previousPixel->b + 1;
			$rightPixel = new Pixel( $rightX, $rightY, $rightR, $rightG, $rightB );
		}
		$currentRow[ $rightX ] = $rightPixel;
	}

	foreach ( $currentRow as $currentPixel ) {
		$currentPixel->draw();
	}

	$previousRow = $currentRow;
}

header( 'Content-Type: image/png' );

imagepng( $image );