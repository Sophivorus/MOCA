<?php

$numbers = array( 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30 );

$primes = array();

while ( $numbers ) {

	$first = array_shift( $numbers );

	$primes[] = $first;

	for ( $i = 0; $i < count( $numbers ); $i++ ) {
		if ( $numbers[ $i ] % $first === 0 ) {
			array_splice( $numbers , $i, 1 );
		}
	}
}

echo implode( ' ', $primes );