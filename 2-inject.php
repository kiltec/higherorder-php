<?php
require('pp.php');
require('inject.php');

$sum = function($xs) use($inject) {
	return $inject(0, function($a, $b) { return $a + $b;}, $xs);
};

pp('sum', $sum(array(2,3)));

$prod = function($xs) use($inject) {
	return $inject(1, function($a, $b) { return $a * $b;}, $xs);
};

pp('prod', $prod(array(2,3,4)));

$grep = function($f, $xs) use($inject) {
	return $inject(array(), function($rs, $x) use($f) {
		if($f($x)) {
		 	$rs[] = $x;
		}
		return $rs;
	}
	, $xs);
};

$uneven = function($x) use($inject) { return $x % 2; };
pp('grep', $grep($uneven, array(2, 4, 3, 5, 2, 126, 123)));

$map = function($f, $xs) use($inject) {
	return $inject(array(), function($rs, $x) use($f) {
		$rs[] = $f($x);
		return $rs;
 	}, $xs);
};

$double = function($x) use($inject)  { return $x * 2; };
pp('map', $map($double, array(1, 124, 6)));

$each = function($f, $xs) use($inject) {
	return $inject(null, function($_, $x) use($f) {
		$f($x);
		return $_;
	}
	, $xs);
};

$double_echo = function($x) use($inject) { echo $x * 2; };
pp('each', $each($double_echo, array(1, 124, 6)));
