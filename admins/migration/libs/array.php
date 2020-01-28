<?php
function in_arrayi($needle, $haystack) {
	return in_array(strtolower($needle), array_map('strtolower', $haystack));
}
function array_key_existsi($needle, $haystack) {
	return in_array(strtolower($needle), array_map('strtolower', array_keys($haystack)));
}
function array_keysi($haystack, $needle) {
	return array_keys(array_map('strtolower', $haystack), strtolower($needle));
}
function array_str_replace($search,$replace,$array){
	foreach($array as $k=>$c){
		$array[$k] = str_replace($search, $replace, $array[$k]);
	}
	return $array;
}
?>