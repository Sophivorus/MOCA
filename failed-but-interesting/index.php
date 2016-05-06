<?php

require 'Image.php';

// There are 19682 possible rules
$RULES = array( 0, 100, 1200, 1500, 1800, 2500, 3200, 3400, 3600, 4200, 4300, 5200, 5600, 6100, 6400, 6600, 7500, 8200, 8600, 10500, 10700, 11500, 12300, 12600, 12900, 13400, 13600, 13700, 14000, 14200, 15000, 15500, 16500, 17000, 17200, 17800 );

foreach ( $RULES as $key => $rule ) {
	
	$ROW = array();
	$ROWS = array();
	
	$rule = base_convert( $rule, 10, 3 ); //Convert to ternary
	$rule = str_pad( $rule, 9, 0, STR_PAD_LEFT ); //Add leading zeroes
	
	$width = 1000;
	$height = 1000;
	
	//Define the first row
	$ROW[ 0 ] = 2;
	$ROWS[ 0 ] = $ROW;
	
	//Calculate the rest
	for ( $y = 1; $y < $height; $y++ ) {
		
		$PREVIOUS = $ROWS[ $y - 1 ];
		
		for ( $x = 0; $x < $width; $x++ ) {
			
			if ( $PREVIOUS[ $x ] == 2 and $PREVIOUS[ $x - 1 ] == 2 )
				$CURRENT[ $x ] = $rule[ 0 ];
			
			if ( $PREVIOUS[ $x ] == 2 and $PREVIOUS[ $x - 1 ] == 1 )
				$CURRENT[ $x ] = $rule[ 1 ];
			
			if ( $PREVIOUS[ $x ] == 2 and $PREVIOUS[ $x - 1 ] == 0 )
				$CURRENT[ $x ] = $rule[ 2 ];
			
			if ( $PREVIOUS[ $x ] == 1 and $PREVIOUS[ $x - 1 ] == 2 )
				$CURRENT[ $x ] = $rule[ 3 ];
			
			if ( $PREVIOUS[ $x ] == 1 and $PREVIOUS[ $x - 1 ] == 1 )
				$CURRENT[ $x ] = $rule[ 4 ];
			
			if ( $PREVIOUS[ $x ] == 1 and $PREVIOUS[ $x - 1 ] == 0 )
				$CURRENT[ $x ] = $rule[ 5 ];
			
			if ( $PREVIOUS[ $x ] == 0 and $PREVIOUS[ $x - 1 ] == 2 )
				$CURRENT[ $x ] = $rule[ 6 ];
			
			if ( $PREVIOUS[ $x ] == 0 and $PREVIOUS[ $x - 1 ] == 1 )
				$CURRENT[ $x ] = $rule[ 7 ];
			
			if ( $PREVIOUS[ $x ] == 0 and $PREVIOUS[ $x - 1 ] == 0 )
				$CURRENT[ $x ] = $rule[ 8 ];
		}
		
		$ROWS[ $y ] = $CURRENT;
	}
		
	$image = new Image( $width, $height );
	
	foreach ( $ROWS as $y => $ROW ) {
		foreach ( $ROW as $x => $value ) {
			if ( $value == 1 ) {
				$image->setColor( 0, 200, 0 );
				$image->drawPoint( $x, $y );
			}
			if ( $value == 2 ) {
				$image->setColor( 200, 0, 0 );
				$image->drawPoint( $x, $y );
			}
		}
	}
	
	//$image->draw();
	
	$rule = base_convert( $rule, 3, 10 );
	$image->save( $rule . '.png' );
}