<?php

require('pp.php');
require('inject.php');

function arity($function) {
	$r =  new ReflectionObject($function);
	return $r->getMethod('__invoke')->getNumberOfParameters();
}

function with_list($f) {
	$arity = arity($f);
	return function() use($f, $arity) {
		$args = func_get_args();
		if($arity > 0 && count($args) != $arity-1) throw new BadFunctionCallException('Oops');
		return function($xs) use($f, $args) {
			return $f($args[0], $args[1], $xs);
		};
	};
}

$injector = with_list($inject);

$sum = $injector(0, function($a, $b) {return $a + $b;});

pp('sum', $sum(array(4,1)));
