<?php
require('pp.php');

function inject($i, $f, $xs) {
	$r = $i;
	foreach($xs as $x) {
		$r = $f($r, $x);
	}
	return $r;
}

$sum = function($xs) {
	return inject(0, function($a, $b) { return $a + $b;}, $xs);
};

$prod = function($xs) {
	return inject(1, function($a, $b) { return $a * $b;}, $xs);
};

$grep = function($pred, $xs) {
	return inject(array(), function($rs, $x) use($pred) {
		if($pred($x)) {
		 	$rs[] = $x;
		}
		return $rs;
	}
	, $xs);
};

$map = function($f, $xs) {
	return inject(array(), function($rs, $x) use($f) {
		$rs[] = $f($x);
		return $rs;
 	}, $xs);
};

$each = function($f, $xs) {
	return inject(null, function($_, $x) use($f) {
		$f($x);
		return $_;
	}
	, $xs);
};

pp('sum', $sum(array(2,3)));

pp('prod', $prod(array(2,3,4)));

$uneven = function($x) { return $x % 2; };
pp('grep', $grep($uneven, array(2, 4, 3, 5, 2, 126, 123)));

$double = function($x) { return $x * 2; };
pp('map', $map($double, array(1, 124, 6)));

$double_echo = function($x) { echo $x * 2; };
pp('each', $each($double_echo, array(1, 124, 6)));
