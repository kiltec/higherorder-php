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

$memoize = function($f, $normalize = null) {
	$results = array();
	if(!$normalize) $normalize = function($x) { return $x[0]; };
	return function() use($f, &$results, $normalize) {
		$args = func_get_args();
		$key = $normalize($args);
		if(isset($results[$key])) {
			return $results[$key];
		}else {
			return $results[$key] = $f($key);
		}
	};
};

$fib = $memoize($fib);
$calls = 0;
printf("%d called 'fib' %d times\n", $fib(30), $calls);
$calls = 0;
printf("%d called 'fib' %d times\n", $fib(31), $calls);