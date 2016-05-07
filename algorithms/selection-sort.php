<?php

$list = array( 2, 7, 9, 4, 6, 1, 3, 0, 5, 8 );

for ( $i = 0; $i < count( $list ); $i++ ) {

	$iMin = $i;

	for ( $j = $i; $j < count( $list ); $j++ ) {
		if ( $list[ $iMin ] > $list[ $j ] ) {
			$iMin = $j;
		}
	}

	// Swap the element $i with the element $iMin
	$temp = $list[ $iMin ];
	$list[ $iMin ] = $list[ $i ];
	$list[ $i ] = $temp;
}

print_r( $list );