<?php

$fibonacci = array( 0, 1 );

for ( $i = 0; $i < 30; $i++ ) {
	$fibonacci[] = $fibonacci[ $i ] + $fibonacci[ $i + 1 ];
}

echo implode( ' ', $fibonacci );