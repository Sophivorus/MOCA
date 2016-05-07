<?php

// Find the greatest common divisor

$a = 124;
$b = 120;

while ( $a != $b ) {
	if ( $a > $b ) {
		$a = $a - $b;
	} else {
		$b = $b - $a;
	}
}

echo $a;