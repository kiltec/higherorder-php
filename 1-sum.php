<?php
function sum($xs) {
	$init = 0;
	$f = function($a, $b) { return $a + $b; };
	$r = $init;
	foreach($xs as $x) {
		$r = $f($r, $x);
	}
	return $r;
}

echo sum(array(2, 3));
