<?php
function pp($name, $result) {
	if(is_array($result)) $result = implode(',', $result);

	printf("Result %s: %s \n", $name, $result);
}
