<?php

$width = 800;
$height = 600;

$image = imagecreatetruecolor( $width, $height );
$white = imagecolorallocate( $image, 255, 255, 255 );

$first_node['x'] = $width / 2;
$first_node['y'] = 0;

$nodes[] = $first_node;

while ( $nodes ) {

	$top_node = array_shift( $nodes );

	if ( rand( 0, 1 ) ) {
		$left_node['x'] = $top_node['x'] - rand( 0, 10 );
		$left_node['y'] = $top_node['y'] + rand( 0, 10 );
		$nodes[] = $left_node;
		imageline( $image, $top_node['x'], $top_node['y'], $left_node['x'], $left_node['y'], $white );
	}

	if ( rand( 0, 1 ) ) {
		$right_node['x'] = $top_node['x'] + rand( 0, 10 );
		$right_node['y'] = $top_node['y'] + rand( 0, 10 );
		$nodes[] = $right_node;
		imageline( $image, $top_node['x'], $top_node['y'], $right_node['x'], $right_node['y'], $white );
	}
}

header( 'Content-Type: image/png' );

imagepng( $image );

imagedestroy( $image );