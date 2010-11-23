<?php
require('pp.php');

$fib = function($n) use(&$fib) {
			switch ($n) {
				case 0:
					return 0;
				case 1:
					return 1;
				default:
					return $fib($n-1) + $fib($n-2);
			}
};
pp('fib', $fib(7));

$calls = 0;
$counted = function($f) {
	return function($f) use($f) {
		global $calls;
		$args = func_get_args();
		$calls++;
		return $f($args[0]);
	};
};

$fib = $counted($fib);

//$calls = 0;
//printf("%d called 'fib' %d times\n", $fib(30), $calls);
//$calls = 0;
//printf("%d called 'fib' %d times\n", $fib(31), $calls);

$memoize = function($f) {
	$results = array();
	return function($arg) use($f, &$results) {
		if(isset($results[$arg])) {
			return $results[$arg];
		}else {
			return $results[$arg] = $f($arg);
		}
	};
};

$fib = $memoize($fib);
$calls = 0;
printf("%d called 'fib' %d times\n", $fib(30), $calls);
$calls = 0;
printf("%d called 'fib' %d times\n", $fib(31), $calls);