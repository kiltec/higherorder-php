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
