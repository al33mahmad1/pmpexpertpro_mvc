<?php
    function redirect($page) {
		header("location: ". URLROOT ."/". $page);
		exit();
	}

	// function endsWith($haystack, $needle) {
	// 	$length = strlen($needle);
	// 	if ($length == 0)
	// 		return true;
	// 	return (substr($haystack, -$length) == $needle);
	// }