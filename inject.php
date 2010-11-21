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
	return inject(array(), function($rs, $x) use($pred){
		if($pred === $x) {
		 	$rs[] = $x;
		}
		return $rs;
	}
	, $xs);
};


pp('sum', $sum(array(2,3)));
pp('prod', $prod(array(2,3,4)));
pp('grep', implode(',', $grep('lars', array('bernd', 'karl', 'lars', 'tim', 'lars'))));
