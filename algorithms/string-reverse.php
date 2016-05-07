<?php

$string = 'abcdefghijklmnopqrstuvwxyz';

$reverse = '';

for ( $i = 1; $i <= strlen( $string ); $i++ ) {
	$reverse .= $string[ strlen( $string ) - $i ];
}

echo $reverse;


// With no temp string
/*
$string = 'abcdefghijklmnopqrstuvwxyz'; // 26

$length = strlen( $string );

for ( $i = 1; $i <= $length; $i++ ) {
	$string .= $string[ $length - $i ];
}

$string = substr( $string, $length, $length * 2 );

echo $string;
*/