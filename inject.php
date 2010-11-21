<?php
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

printf("Result %s: %s \n", 'sum', $sum(array(2,3)));
printf("Result %s: %s \n", 'prod', $prod(array(2,3,4)));
