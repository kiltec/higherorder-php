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

pp('sum', $sum(array(2,3)));
pp('prod', $prod(array(2,3,4)));
$uneven = function($x) { return $x % 2; };
pp('grep', implode(',', $grep($uneven, array(2, 4, 3, 5, 2, 126, 123))));
